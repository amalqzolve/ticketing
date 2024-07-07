<?php

namespace App\Http\Controllers\Procurement\EmailApprove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\procurement\PoApprovalTransactionModel;
use App\procurement\PoWorkflowModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;



class PoApprovalController extends Controller
{

    public function markPo(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = PoApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = PoApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = PoApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 4);
                $ifFind->update($data);
                $this->changeMainStatus($ifFind, 4); //change status to reject

            }
        }
        return back()->with('message', 'We have Marked Your decision Thankyou!');
    }

    public function updateNextApproval($data)
    {
        $poId = $data->po_id;
        $ifdata = PoApprovalTransactionModel::where('po_id', '=', $poId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            PoApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = PoWorkflowModel::select('poworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                ->where('poworkflow.id', '=', $ifdata->poworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('po', $ifdata->po_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprPoModel::find($poId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = PoApprovalTransactionModel::where('po_id', '=', $data->po_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeMainStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->po_id;
        $ifFind = EprPoModel::find($eprId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function removeOldRecords($data)
    {
        $products = EprPoProductsModel::where('epr_po_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprProduct = MaterialRequestProductsModel::find($value->epr_product_id);
            if ($eprProduct) {
                $newQty = $eprProduct->po_assigned_qty - $value->quantity;
                $eprProduct->update(['po_assigned_qty' => $newQty]);
            }
        }
    }


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'po', $docId, $toMailId, $transactionId, $userName, $date)
    {
        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now(),
        ];
        DB::table('email_verify_keys')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'PO';
        $data['document'] = 'PO';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

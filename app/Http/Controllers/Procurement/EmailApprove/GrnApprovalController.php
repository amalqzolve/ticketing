<?php

namespace App\Http\Controllers\Procurement\EmailApprove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\EprPoGrnModel;
use App\procurement\EprPoProductsModel;
use App\procurement\GrnApprovalTransactionModel;
use App\procurement\GrnWorkflowModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;



class GrnApprovalController extends Controller
{

    public function markGrn(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = GrnApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = GrnApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = GrnApprovalTransactionModel::find($id);
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
        $grnId = $data->grn_id;
        $ifdata = GrnApprovalTransactionModel::where('grn_id', '=', $grnId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            GrnApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = GrnWorkflowModel::select('grnworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                ->where('grnworkflow.id', '=', $ifdata->grnworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('grn', $ifdata->grn_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprPoGrnModel::find($grnId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = GrnApprovalTransactionModel::where('grn_id', '=', $data->grn_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeMainStatus($eprAthority, $status)
    {
        $grnId = $eprAthority->grn_id;
        $ifFind = EprPoGrnModel::find($grnId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function removeOldRecords($data)
    {
        $products = EprPoGrnProductsModel::where('epr_po_grn_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprPoProduct = EprPoProductsModel::find($value->epr_po_product_id);
            if ($eprPoProduct) {
                $newQty = $eprPoProduct->grn_generated_qty - $value->quantity;
                $eprPoProduct->update(['grn_generated_qty' => $newQty]);
            }
        }
    }


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'grn', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Goods Received Note';
        $data['document'] = 'GRN';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

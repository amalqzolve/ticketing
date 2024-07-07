<?php

namespace App\Http\Controllers\Tenders\EmailApprove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Tender\ApprovalTransactionModel;
use App\Tender\CategorySynthesisModel;
use App\Tender\TenderModel;

use App\procurement\MaterialRequestProductsModel;
use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class TenderApprovalController extends Controller
{
    public function markTransfer(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = ApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = ApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = ApprovalTransactionModel::find($id);
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
        $tenderId = $data->tender_id;
        $ifdata = ApprovalTransactionModel::where('tender_id', '=', $tenderId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            ApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = CategorySynthesisModel::select('category_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')
                ->where('category_synthesis.id', '=', $ifdata->category_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('TNDR', $ifdata->tender_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $tender = TenderModel::find($tenderId);
            if ($tender) {
                $dataStatus = array('status' => 6);
                $tender->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = ApprovalTransactionModel::where('tender_id', '=', $data->tender_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeMainStatus($athority, $status)
    {
        $tender_id = $athority->tender_id;
        $ifFind = TenderModel::find($tender_id);
        if ($ifFind) {
            // if ($status == 4)
            //     $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    // public function removeOldRecords($data)
    // {
    //     $products = StockTransferProductsModel::where('epr_stock_transfer_id', $data->id)->get();
    //     foreach ($products as $key => $value) {
    //         $eprProduct = MaterialRequestProductsModel::find($value->epr_product_id);
    //         if ($eprProduct) {
    //             $newQty = $eprProduct->po_assigned_qty - $value->quantity;
    //             $eprProduct->update(['po_assigned_qty' => $newQty]);
    //         }
    //     }
    // }


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'TNDR', $docId, $toMailId, $transactionId, $userName, $date)
    {
        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now()
        ];
        DB::table('email_verify_keys')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'Tender';
        $data['document'] = 'TNDR';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

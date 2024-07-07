<?php

namespace App\Http\Controllers\Tenders\EmailApprove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Tender\SalesProposalApprovalTransactionModel;
use App\Tender\SalesProposalCategorySynthesisModel;
use App\Tender\SalesProposalModel;

use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class SalesProposalApprovalController extends Controller
{
    public function markDesc(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = SalesProposalApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = SalesProposalApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = SalesProposalApprovalTransactionModel::find($id);
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
        $dataId = $data->sales_proposal_id;
        $ifdata = SalesProposalApprovalTransactionModel::where('sales_proposal_id', '=', $dataId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            SalesProposalApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = SalesProposalCategorySynthesisModel::select('sales_proposal_category_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')
                ->where('sales_proposal_category_synthesis.id', '=', $ifdata->sales_proposal_category_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('PROP', $ifdata->sales_proposal_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $tender = SalesProposalModel::find($dataId);
            if ($tender) {
                $dataStatus = array('status' => 6);
                $tender->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = SalesProposalApprovalTransactionModel::where('sales_proposal_id', '=', $data->sales_proposal_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeMainStatus($athority, $status)
    {
        $tenderId = $athority->sales_proposal_id;
        $ifFind = SalesProposalModel::find($tenderId);
        if ($ifFind) {
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

    public function sendMail($docType = 'PROPS', $docId, $toMailId, $transactionId, $userName, $date)
    {
        DB::table('email_verify_keys')->where('doc_type', 'PROPS')->where('doc_id', $docId)->delete();
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
        $data['document_name'] = 'Sales Proposal';
        $data['document'] = 'PROPS';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

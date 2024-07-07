<?php

namespace App\Http\Controllers\Procurement\EmailApprove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\procurement\EprPoInvoiceModel;
use App\procurement\EprPoProductsModel;
use App\procurement\InvoiceApprovalTransactionModel;
use App\procurement\InvoiceWorkflowModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;



class InvoiceApprovalController extends Controller
{

    public function markInvoice(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = InvoiceApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = InvoiceApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = InvoiceApprovalTransactionModel::find($id);
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
        $poId = $data->invoice_id;
        $ifdata = InvoiceApprovalTransactionModel::where('invoice_id', '=', $poId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            InvoiceApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = InvoiceWorkflowModel::select('invoiceworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                ->where('invoiceworkflow.id', '=', $ifdata->invoiceworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('invoice', $ifdata->invoice_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprPoInvoiceModel::find($poId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = InvoiceApprovalTransactionModel::where('invoice_id', '=', $data->invoice_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeMainStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->invoice_id;
        $ifFind = EprPoInvoiceModel::find($eprId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function removeOldRecords($data)
    {
        $products = EprPoInvoiceProductsModel::where('epr_po_invoice_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprPoProduct = EprPoProductsModel::find($value->epr_po_product_id);
            if ($eprPoProduct) {
                $newQty = $eprPoProduct->invoice_generated_amount_total - $value->amount;
                $eprPoProduct->update(['invoice_generated_amount_total' => $newQty]);
            }
        }
    }


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'invoice', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Supplier Invoice Booking';
        $data['document'] = 'S-INV';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

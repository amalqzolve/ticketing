<?php

namespace App\Http\Controllers\Procurement\EmailApprove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\EprSupplierPaymentProductsModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\SupplierPaymentApprovalTransactionModel;
use App\procurement\SupplierPaymentWorkflowModel;
use App\procurement\EprSupplierPaymentModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;



class SupplierPaymentApprovalController extends Controller
{

    public function markPayment(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = SupplierPaymentApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = SupplierPaymentApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = SupplierPaymentApprovalTransactionModel::find($id);
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
        $poId = $data->supplier_payment_id;
        $ifdata = SupplierPaymentApprovalTransactionModel::where('supplier_payment_id', '=', $poId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            SupplierPaymentApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = SupplierPaymentWorkflowModel::select('supplier_paymentworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                ->where('supplier_paymentworkflow.id', '=', $ifdata->supplier_paymentworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('payment', $ifdata->supplier_payment_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprSupplierPaymentModel::find($poId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = SupplierPaymentApprovalTransactionModel::where('supplier_payment_id', '=', $data->supplier_payment_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeMainStatus($eprAthority, $status)
    {
        $grnWarehouseId = $eprAthority->supplier_payment_id;
        $ifFind = EprSupplierPaymentModel::find($grnWarehouseId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function removeOldRecords($data)
    {
        $products = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprPoInvoiceProduct = EprPoInvoiceProductsModel::find($value->epr_po_invoice_product_id);
            if ($eprPoInvoiceProduct) {
                $newQty = $eprPoInvoiceProduct->payment_created_amount - $value->amount;
                $eprPoInvoiceProduct->update(['payment_created_amount' => $newQty]);
            }
        }
    }


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'payment', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Supplier Payment';
        $data['document'] = 'S-PAY';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

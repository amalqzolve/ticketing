<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\InvoiceApprovalTransactionModel;
use App\procurement\EprPoInvoiceModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\procurement\EprPoProductsModel;
use App\procurement\InvoiceWorkflowModel;
use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class InvoiceApprovalController  extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.id as id', 'epr_po_invoice.id as invoice_id', 'epr_po_invoice.created_at', 'qcrm_supplier.sup_name', 'epr_po_invoice.supplier_invoice_number', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.grandtotalamount', 'epr_po_invoice.po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'epr_po.request_type', 'epr_po_invoice.status as invoice_status', 'epr_po_invoice_approval_transaction.status')
                ->leftjoin('epr_po_invoice', 'epr_po_invoice_approval_transaction.invoice_id', '=', 'epr_po_invoice.id')
                ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
                ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
                ->where('epr_po_invoice_approval_transaction.status', '=', 1) //waiting for approval
                ->where('invoiceworkflow.user_id', '=', $currentUser)

                // ->whereIn('epr_po_invoice.status', [1, 3])
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('booked_amount', function ($row) {
                $created = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'booked_amount']);
            return $dtTble->make(true);
        } else
            return view('procurement.invoiceApproval.list');
    }
    public function listDepartment(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.id as id', 'epr_po_invoice.id as invoice_id', 'epr_po_invoice.created_at', 'qcrm_supplier.sup_name', 'epr_po_invoice.supplier_invoice_number', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.grandtotalamount', 'epr_po_invoice.po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'epr_po.request_type', 'epr_po_invoice.status as invoice_status')
                ->leftjoin('epr_po_invoice', 'epr_po_invoice_approval_transaction.invoice_id', '=', 'epr_po_invoice.id')
                ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
                ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
                ->groupBy('epr_po_invoice.id')
                // ->whereIn('epr_po_invoice_approval_transaction.status', [2, 3, 4])
                // ->where('invoiceworkflow.user_id', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('booked_amount', function ($row) {
                $created = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $row->id)->sum('amount');
                return $created;
            })->addColumn('last_action', function ($row) {
                $data = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.status', 'users.name')
                    ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
                    ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                    ->where('invoiceworkflow.user_id', '=', Auth::user()->id)
                    ->where('epr_po_invoice_approval_transaction.invoice_id', '=', $row->invoice_id)->orderBy('epr_po_invoice_approval_transaction.id', 'desc')->first();
                return isset($data->status) ? $data->status : $data;
            })->rawColumns(['action', 'booked_amount', 'last_action']);
            return $dtTble->make(true);
        } else
            return null;
    }
    public function approve(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = InvoiceApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'invoice')->where('transaction_id', $id)->delete();
                    $data = array('status' => 2, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->updateNextApproval($ifFind);
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function resubmit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = InvoiceApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'invoice')->where('transaction_id', $id)->delete();
                    $data = array('status' => 3, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->deleteNextApproval($ifFind);
                    $this->changeEprStatus($ifFind, 3); //change status to re sumbited
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = InvoiceApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'invoice')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to re sumbited
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
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

    public function changeEprStatus($eprAthority, $status)
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

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $invoiceId = $request->id;
            $data = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.status', 'epr_po_invoice_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(epr_po_invoice_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
                ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                ->where('epr_po_invoice_approval_transaction.invoice_id', '=', $invoiceId)->orderBy('epr_po_invoice_approval_transaction.id', 'asc')->get();
            $data = $data->map(function ($value, $key) {
                if ($value->status_changed_by != null)
                    $user = $this->getDescUser($value->status_changed_by);
                $outArray = array(
                    'status' => $value->status,
                    'name' => ($value->status_changed_by != null) ? $user->name : $value->name,
                    'status_changed' => $value->status_changed,
                );
                return $outArray;
            });
            $out = array(
                'status' => 1,
                'data' => $data
            );
            echo json_encode($out);
        } else
            return null;
    }

    public function getDescUser($id)
    {
        return User::find($id);
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

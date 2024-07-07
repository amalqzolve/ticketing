<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\SupplierPaymentApprovalTransactionModel;
use App\procurement\EprSupplierPaymentModel;
use App\procurement\EprSupplierPaymentProductsModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\SupplierPaymentWorkflowModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class SupplierPaymentApprovalController  extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id;
            $data = SupplierPaymentApprovalTransactionModel::select('epr_po_supplier_payment_approval_transaction.id', 'epr_supplier_payment.id as supplier_payment_id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status as supplier_payment_status', 'epr_po_supplier_payment_approval_transaction.status')
                ->leftjoin('epr_supplier_payment', 'epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', 'epr_supplier_payment.id')
                ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->where('supplier_paymentworkflow.user_id', '=', $currentUser)
                ->where('epr_po_supplier_payment_approval_transaction.status', 1)
                ->groupBy('epr_supplier_payment.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })
                ->addColumn('req_amount', function ($row) {
                    $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                    return $created;
                })->addColumn('last_status', function ($row) {
                    $data = SupplierPaymentApprovalTransactionModel::select('epr_po_supplier_payment_approval_transaction.status', 'users.name')
                        ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
                        ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', $row->supplier_payment_id)
                        ->where('epr_po_supplier_payment_approval_transaction.status', '!=', 0)
                        ->orderBy('epr_po_supplier_payment_approval_transaction.id', 'asc')
                        ->first();
                    $str = '';

                    if ($data->status == 0)
                        $statu = 'waiting';
                    else if ($data->status == 1)
                        $statu = 'Approval Pending';
                    else if ($data->status == 2)
                        $statu = 'Approved';
                    else if ($data->status == 3)
                        $statu = 'Resubmited';
                    else if ($data->status == 4)
                        $statu = 'rejected';

                    $str .= $data->name . '(' . $statu . ')</br>';

                    return $str;
                })
                ->rawColumns(['action', 'req_amount', 'last_status']);
            return $dtTble->make(true);
        } else
            return view('procurement.supplierPaymentApproval.list');
    }

    public function approvedList(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id;
            $data = SupplierPaymentApprovalTransactionModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status')
                ->leftjoin('epr_supplier_payment', 'epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', 'epr_supplier_payment.id')
                ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->where('supplier_paymentworkflow.user_id', '=', $currentUser)
                ->whereIn('epr_po_supplier_payment_approval_transaction.status', [2, 3, 4])
                ->groupBy('epr_supplier_payment.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'req_amount']);
            return $dtTble->make(true);
        } else
            return null;
    }

    public function approve(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = SupplierPaymentApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'payment')->where('transaction_id', $id)->delete();
                    $data = array('status' => 2, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->updateNextApproval($ifFind);
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function resubmit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = SupplierPaymentApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'payment')->where('transaction_id', $id)->delete();
                    $data = array('status' => 3, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->deleteNextApproval($ifFind);
                    $this->changeEprStatus($ifFind, 3); //change status to re sumbited
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = SupplierPaymentApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'payment')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to re sumbited
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
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

    public function changeEprStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->supplier_payment_id;
        $ifFind = EprSupplierPaymentModel::find($eprId);
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

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $supId = $request->id;
            $data = SupplierPaymentApprovalTransactionModel::select('epr_po_supplier_payment_approval_transaction.status', 'epr_po_supplier_payment_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(epr_po_supplier_payment_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
                ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                ->where('epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', $supId)
                ->orderBy('epr_po_supplier_payment_approval_transaction.id', 'asc')
                ->get();

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

<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\EprPoModel;
use App\procurement\EprSupplierPaymentModel;
use App\procurement\EprSupplierPaymentProductsModel;
use App\procurement\EprSupplierPaymentModelReviced;
use App\procurement\EprSupplierPaymentProductsModelReviced;
use App\procurement\SupplierPaymentWorkflowModel;
use App\procurement\SupplierPaymentApprovalTransactionModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\User;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;
use App\settings\BranchSettingsModel;


class SupplierPaymentController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = EprSupplierPaymentModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->whereIn('epr_supplier_payment.status', [1, 3])
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else {
            return view('procurement.supplierPayment.list');
        }
    }

    public function sendList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprSupplierPaymentModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->whereIn('epr_supplier_payment.status', [5, 2])
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else {
            $branch = Session::get('branch');
            $supplier =  DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $po = EprPoModel::select('id')->where('po_status', '=', 3)->get();
            return view('procurement.supplierPayment.list', compact('supplier', 'po'));
        }
    }


    public function approvedList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprSupplierPaymentModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->where('epr_supplier_payment.status', '=', 6)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else {
            $branch = Session::get('branch');
            $supplier =  DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $po = EprPoModel::select('id')->where('po_status', '=', 3)->get();
            return view('procurement.supplierPayment.list', compact('supplier', 'po'));
        }
    }

    public function rejectedList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprSupplierPaymentModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->where('epr_supplier_payment.status', '=', 4)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else {
            $branch = Session::get('branch');
            $supplier =  DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $po = EprPoModel::select('id')->where('po_status', '=', 3)->get();
            return view('procurement.supplierPayment.list', compact('supplier', 'po'));
        }
    }



    public function send(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $createdBy = Auth::user()->id;
                $id = $request->id;
                $materialReq = EprSupplierPaymentModel::select('epr_po.mr_category')->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')->find($id);
                if ($materialReq) {
                    $materialReq->mr_category;
                    $workflow =  SupplierPaymentWorkflowModel::select('supplier_paymentworkflow.id', 'users.email', 'users.name')
                        ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                        ->where('supplier_paymentworkflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
                    $supplierPayment = EprSupplierPaymentModel::find($id);
                    $i = 0;
                    foreach ($workflow as $key => $value) {
                        $status = ($key == 0) ? 1 : 0;
                        $data = array(
                            'supplier_paymentworkflow_id' => $value->id,
                            'supplier_payment_id' => $id,
                            'created_by' => $createdBy,
                            'status' => $status
                        );
                        $tData = SupplierPaymentApprovalTransactionModel::create($data);
                        if ($status == 1) {
                            $toMailId = $value->email;
                            $this->sendMail('payment', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                        }
                        $i++;
                    }
                    if ($i != 0) {
                        $data = array('status' => 2);
                        $supplierPayment->update($data);
                        $out = array(
                            'status' => 1,
                            'msg' => 'success',
                        );
                    } else {
                        $out = array(
                            'status' => 0,
                            'msg' => 'Supplier Payment Approval Sysnthesis Not Found Contact Admin !!',
                        );
                    }
                    echo json_encode($out);
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'error Please Try After Some time',
                    );
                    echo json_encode($out);
                }
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }


    public function save(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $currentUser = Auth::user()->id;
                $postID = $request->id;
                $data = array(
                    'po_id' => $request->po_id,
                    'epr_id' => $request->epr_id,
                    'invoice_id' => $request->invoice_id,
                    'payement_book_date' => Carbon::parse($request->payement_book_date)->format('Y-m-d  h:i'),
                    'terms' => $request->terms,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'grandtotalamount' => $request->grandtotalamount,
                    'user_id' => $currentUser,
                );

                $supplierPayment = EprSupplierPaymentModel::updateOrCreate(['id' => $postID], $data);
                $id = $supplierPayment->id;
                for ($i = 0; $i < count($request->eprPoProductId); $i++) {
                    $data = [
                        'epr_supplier_payment_id' => $id,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'epr_po_invoice_product_id' => $request->eprPoinvloiceProductId[$i],
                        'amount' => $request->payment[$i],
                    ];
                    $supplierPaymentProducts = EprSupplierPaymentProductsModel::Create($data);
                    $amount = $request->payment[$i] + $request->payed[$i];
                    $this->updateInvoiceProducts($request->eprPoinvloiceProductId[$i], $amount);
                }
                $out = array('status' => 1, 'data' => $id);
                echo json_encode($out);
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }



    public function view(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprSupplierPaymentModel::select('epr_po.*', 'ma_category.name as ma_categoryname', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as project', 'qcrm_supplier.sup_name', 'qcrm_termsandconditions.term', 'qcrm_termsandconditions.description', 'epr_supplier_payment.id', 'epr_supplier_payment.payement_book_date', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'epr_po_invoice.id as invoice_id', 'epr_po_invoice.supplier_invoice_date as invoice_date', 'epr_po.id as po_id', 'epr_po_invoice.supplier_invoice_number', 'epr_po_invoice.supplier_invoice_date', 'epr_supplier_payment.grandtotalamount', 'epr_supplier_payment.internalreference', 'epr_supplier_payment.notes')
            ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')

            ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'epr_po.client', '=', 'qcrm_customer_details.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_supplier_payment.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);
        $MaterialRequestProducts = EprSupplierPaymentProductsModel::select('epr_supplier_payment_products.*', 'epr_po_invoice_products.itemname', 'epr_po_invoice_products.description', 'epr_po_invoice_products.payment_created_amount', 'epr_po_invoice_products.amount as row_total')
            ->leftjoin('epr_po_invoice_products', 'epr_supplier_payment_products.epr_po_invoice_product_id', '=', 'epr_po_invoice_products.id')
            ->where('epr_supplier_payment_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                'epr_po_product_id' => $value->epr_po_product_id,
                'epr_po_invoice_product_id' => $value->epr_po_invoice_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'row_total' => $value->row_total,
                'payed' => ($value->payment_created_amount - $value->amount),
                'payment' => $value->amount,
                'balance' => $value->row_total - $value->amount,
            );
            return $outArray;
        });
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.supplierPayment.edit', compact('MaterialRequest', 'MaterialRequestProducts', 'termslist'));
    }


    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $postID = $request->id;

                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'payement_book_date' => Carbon::parse($request->payement_book_date)->format('Y-m-d  h:i'),
                    'terms' => $request->terms,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'grandtotalamount' => $request->grandtotalamount,
                );
                $supplierPayment = EprSupplierPaymentModel::updateOrCreate(['id' => $postID], $data);
                EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $postID)->delete();
                for ($i = 0; $i < count($request->eprPoProductId); $i++) {
                    $data = [
                        'epr_supplier_payment_id' => $postID,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'epr_po_invoice_product_id' => $request->eprPoinvloiceProductId[$i],
                        'amount' => $request->payment[$i],
                    ];
                    $supplierPaymentProducts = EprSupplierPaymentProductsModel::Create($data);
                    $amount = $request->payment[$i] + $request->payed[$i];
                    $this->updateInvoiceProducts($request->eprPoinvloiceProductId[$i], $amount);
                }
                $out = array('status' => 1, 'data' => $postID);
                echo json_encode($out);
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }

    public function reviceView(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $MaterialRequest = EprSupplierPaymentModel::select('epr_po.*', 'ma_category.name as ma_categoryname', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as project', 'qcrm_supplier.sup_name', 'qcrm_termsandconditions.term', 'qcrm_termsandconditions.description', 'epr_supplier_payment.id', 'epr_supplier_payment.payement_book_date', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'epr_po_invoice.id as invoice_id', 'epr_po_invoice.supplier_invoice_date as invoice_date', 'epr_po.id as po_id', 'epr_po_invoice.supplier_invoice_number', 'epr_po_invoice.supplier_invoice_date', 'epr_supplier_payment.grandtotalamount', 'epr_supplier_payment.internalreference', 'epr_supplier_payment.notes')
            ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
            ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'epr_po.client', '=', 'qcrm_customer_details.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_supplier_payment.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);
        $MaterialRequestProducts = EprSupplierPaymentProductsModel::select('epr_supplier_payment_products.*', 'epr_po_invoice_products.itemname', 'epr_po_invoice_products.description', 'epr_po_invoice_products.payment_created_amount', 'epr_po_invoice_products.amount as row_total')
            ->leftjoin('epr_po_invoice_products', 'epr_supplier_payment_products.epr_po_invoice_product_id', '=', 'epr_po_invoice_products.id')
            ->where('epr_supplier_payment_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                'epr_po_product_id' => $value->epr_po_product_id,
                'epr_po_invoice_product_id' => $value->epr_po_invoice_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'row_total' => $value->row_total,
                'payed' => ($value->payment_created_amount - $value->amount),
                'payment' => $value->amount,
                'balance' => $value->row_total -  $value->amount,
            );
            return $outArray;
        });
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.supplierPayment.resubmit', compact('MaterialRequest', 'MaterialRequestProducts', 'termslist'));
    }

    public function resend(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $postID = $request->id;
                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);
                $this->backupOldRequest($postID);
                $data = array(
                    'version' => $request->version + 1,
                    'payement_book_date' => Carbon::parse($request->payement_book_date)->format('Y-m-d  h:i'),
                    'terms' => $request->terms,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'grandtotalamount' => $request->grandtotalamount,
                );
                $supplierPayment = EprSupplierPaymentModel::updateOrCreate(['id' => $postID], $data);
                EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $postID)->delete();
                for ($i = 0; $i < count($request->eprPoProductId); $i++) {
                    $data = [
                        'epr_supplier_payment_id' => $postID,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'epr_po_invoice_product_id' => $request->eprPoinvloiceProductId[$i],
                        'amount' => $request->payment[$i],
                    ];
                    $supplierPaymentProducts = EprSupplierPaymentProductsModel::Create($data);
                    $amount = $request->payment[$i] + $request->payed[$i];
                    $this->updateInvoiceProducts($request->eprPoinvloiceProductId[$i], $amount);
                }
                $this->reSendPayment($postID);
                $out = array('status' => 1, 'data' => $postID);
                echo json_encode($out);
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function backupOldRequest($postID)
    {
        $base =  EprSupplierPaymentModel::find($postID);
        $data = array(
            'version' => $base->version,
            'epr_id' => $base->epr_id,
            'po_id' => $base->po_id,
            'invoice_id' => $base->invoice_id,
        );
        $inserted = EprSupplierPaymentModelReviced::updateOrCreate(['id' => $postID], $data);
        $newMrId = $inserted->id;
        $products = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', $postID)->get();
        foreach ($products as $key => $value) {
            $prData = array(
                'epr_supplier_payment_id' => $newMrId,
                'epr_po_product_id' => $value->epr_po_product_id,
                'epr_po_invoice_product_id' => $value->epr_po_invoice_product_id,
                'amount' => $value->amount
            );
            EprSupplierPaymentProductsModelReviced::updateOrCreate(['id' => $postID], $prData);
        }
    }


    public function reSendPayment($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = EprSupplierPaymentModel::select('epr_po.mr_category')->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')->find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  SupplierPaymentWorkflowModel::select('supplier_paymentworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                ->where('supplier_paymentworkflow.cat_id', '=', $materialReq->mr_category)
                ->orderBy('priority', 'asc')
                ->get();
            $supplierPayment = EprSupplierPaymentModel::find($id);
            $data = array('status' => 5);
            $supplierPayment->update($data);
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'supplier_paymentworkflow_id' => $value->id,
                    'supplier_payment_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = SupplierPaymentApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('payment', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            echo 1;
        } else
            echo 0;
    }

    public function updateInvoiceProducts($id, $amount)
    {
        EprPoInvoiceProductsModel::find($id)->update(['payment_created_amount' => $amount]);
    }

    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', $postID)->where('epr_po_invoice_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = EprPoInvoiceProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('payment_created_amount', $product->amount);
            }
        }
    }


    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprSupplierPaymentModel::select(
            'epr_supplier_payment.id',
            'epr_supplier_payment.payement_book_date',
            'epr_supplier_payment.internalreference',
            'epr_supplier_payment.notes',
            'epr_supplier_payment.grandtotalamount',
            'qcrm_termsandconditions.description',
            'qcrm_supplier.sup_name',
            'users.name as created_name',
            'epr_supplier_payment.status'
        )
            ->leftjoin('users', 'epr_supplier_payment.user_id', '=', 'users.id')
            ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_supplier_payment.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);


        $products = EprSupplierPaymentProductsModel::select('epr_supplier_payment_products.*', 'epr_po_products.itemname', 'epr_po_products.description')
            ->leftjoin('epr_po_products', 'epr_supplier_payment_products.epr_po_product_id', '=', 'epr_po_products.id')
            ->where('epr_supplier_payment_products.epr_supplier_payment_id', '=', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = SupplierPaymentApprovalTransactionModel::select('epr_po_supplier_payment_approval_transaction.updated_at', 'epr_po_supplier_payment_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_supplier_payment_approval_transaction.status')
                ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
                ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', $mainData->id)
                ->where('epr_po_supplier_payment_approval_transaction.status', '!=', 0)
                ->where('epr_po_supplier_payment_approval_transaction.status', '!=', 1)
                ->get();

            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                if ($value->status_changed_by != null) {
                    $user = $this->getDescUser($value->status_changed_by);
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $user->name,
                        'sign' => $user->sign,
                        'designation' => $user->designation,
                        'department' => $user->department,
                        'status' => $value->status,
                    );
                } else {
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $value->name,
                        'sign' => $value->sign,
                        'designation' => $value->designation,
                        'department' => $value->department,
                        'status' => $value->status,
                    );
                }
                return $outArray;
            });
        } else
            $approvalLevel = array();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'S-PAY ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->payement_book_date));
        $pdf = PDF::loadView('procurement.supplierPayment.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
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

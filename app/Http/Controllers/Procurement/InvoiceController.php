<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\MaterialCategoryModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\procurement\EprPoInvoiceModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\procurement\EprPoInvoiceRevicedModel;
use App\procurement\EprPoInvoiceProductsRevicedModel;
use App\crm\CustomerModel;
use App\procurement\InvoiceWorkflowModel;
use App\procurement\InvoiceApprovalTransactionModel;
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

class InvoiceController extends Controller
{
    public function invoiceList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoInvoiceModel::select('epr_po_invoice.id', 'epr_po_invoice.created_at', 'qcrm_supplier.sup_name', 'epr_po_invoice.supplier_invoice_number', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.grandtotalamount', 'epr_po_invoice.po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'epr_po.request_type', 'epr_po_invoice.status')
                ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
                ->whereIn('epr_po_invoice.status', [1, 3])
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
        } else {
            $branch = Session::get('branch');
            $supplier =  DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $po = EprPoModel::select('id')->where('po_status', '=', 3)->get();
            return view('procurement.invoice.list', compact('supplier', 'po'));
        }
    }

    public function invoiceListSend(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoInvoiceModel::select('epr_po_invoice.id', 'epr_po_invoice.created_at', 'qcrm_supplier.sup_name', 'epr_po_invoice.supplier_invoice_number', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.grandtotalamount', 'epr_po_invoice.po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'epr_po.request_type', 'epr_po_invoice.status')
                ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
                ->whereIn('epr_po_invoice.status', [5, 2])
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
            return null;
    }

    public function invoiceListApproved(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoInvoiceModel::select('epr_po_invoice.id', 'epr_po_invoice.created_at', 'qcrm_supplier.sup_name', 'epr_po_invoice.supplier_invoice_number', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.grandtotalamount', 'epr_po_invoice.po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'epr_po.request_type', 'epr_po_invoice.status')
                ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
                ->where('epr_po_invoice.status', 6)
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
            return null;
    }

    public function invoiceListRejected(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoInvoiceModel::select('epr_po_invoice.id', 'epr_po_invoice.created_at', 'qcrm_supplier.sup_name', 'epr_po_invoice.supplier_invoice_number', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.grandtotalamount', 'epr_po_invoice.po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'epr_po.request_type', 'epr_po_invoice.status')
                ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
                ->where('epr_po_invoice.status', 4)
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
            return null;
    }


    public function editView(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        // $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoInvoiceModel::select('epr_po_invoice.*', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date')
            ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);

        // $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $id)->get();

        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $EprPoProducts = EprPoProductsModel::find($value->epr_po_product_id);
            $outArray = array(
                'quantity' => $EprPoProducts->quantity,
                'total' => $EprPoProducts->total,
                'payed' => $EprPoProducts->invoice_generated_amount_total - $value->amount,
                'payment' => $value->amount,
                'balance' => $EprPoProducts->total - $EprPoProducts->invoice_generated_amount_total,
            );
            return $outArray;
        });

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        // unitlist
        // productlist
        return view('procurement.invoice.edit', compact('materialCategory',  'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'vatlist', 'reqProduct'));
    }
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');

                $postID = $request->id;
                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'epr_id' => $request->epr_id,
                    'po_id' => $request->po_id,
                    'supplier_invoice_number' => $request->supplier_invoice_number,
                    'supplier_invoice_date' => Carbon::parse($request->supplier_invoice_date)->format('Y-m-d  h:i'),
                    'supplier_invoice_over_due_date' => Carbon::parse($request->supplier_invoice_over_due_date)->format('Y-m-d  h:i'),
                    'supplier_invoice_credit_period' => $request->supplier_invoice_credit_period,
                    'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d  h:i'),
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'supplier_id' => $request->supplier,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    // 'totalamount' => $request->totalamount,
                    // 'discount' => $request->discount,
                    // 'amountafterdiscount' => $request->amountafterdiscount,
                    // 'totalvatamount' => $request->totalvatamount,
                    'grandtotalamount' => $request->grandtotalamount,
                    'user_id' => $useasr_id
                );


                $epr_id = EprPoInvoiceModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $mrId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_invoice_id' => $mrId,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'amount'   => $request->payment[$i]
                    ];
                    $eprRfqProducts = EprPoInvoiceProductsModel::Create($data);
                    $totalPayed = $request->payment[$i] + $request->payed[$i];
                    $this->poProductRateUpdate($request->eprPoProductId[$i], $totalPayed);
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
    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoInvoiceModel::select(
            'epr_po_invoice.id',
            'epr_po_invoice.supplier_invoice_number',
            'epr_po_invoice.supplier_invoice_date',
            'epr_po_invoice.supplier_invoice_over_due_date',
            'epr_po_invoice.supplier_invoice_credit_period',
            'epr_po_invoice.bill_entry_date',
            'epr_po_invoice.notes',
            'epr_po_invoice.grandtotalamount',
            'qcrm_termsandconditions.description',
            'qcrm_supplier.sup_name',
            'users.name as created_name',
            'epr_po_invoice.status'
        )
            ->leftjoin('users', 'epr_po_invoice.user_id', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po_invoice.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);

        $products = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.updated_at', 'epr_po_invoice_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_invoice_approval_transaction.status')
                ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
                ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('epr_po_invoice_approval_transaction.invoice_id', '=', $mainData->id)
                ->where('epr_po_invoice_approval_transaction.status', '!=', 0)
                ->where('epr_po_invoice_approval_transaction.status', '!=', 1)
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
        $pdfId = 'S-IN ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->supplier_invoice_date));
        $pdf = PDF::loadView('procurement.invoice.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
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

    public function send(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $createdBy = Auth::user()->id;
                $id = $request->id;

                $materialReq = EprPoInvoiceModel::find($id);
                if ($materialReq) {
                    $materialReq->mr_category;
                    $workflow =  InvoiceWorkflowModel::select('invoiceworkflow.id', 'users.email', 'users.name')
                        ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                        ->where('invoiceworkflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
                    $i = 0;
                    foreach ($workflow as $key => $value) {
                        $status = ($key == 0) ? 1 : 0;
                        $data = array(
                            'invoiceworkflow_id' => $value->id,
                            'invoice_id' => $id,
                            'created_by' => $createdBy,
                            'status' => $status
                        );
                        $tData = InvoiceApprovalTransactionModel::create($data);
                        if ($status == 1) {
                            $toMailId = $value->email;
                            $this->sendMail('invoice', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                        }
                        $i++;
                    }
                    if ($i != 0) {
                        $data = array('status' => 2);
                        $materialReq->update($data);
                        $out = array(
                            'status' => 1,
                            'msg' => 'success',
                        );
                    } else {
                        $out = array(
                            'status' => 0,
                            'msg' => 'Invoice Approval Sysnthesis Not Found Contact Admin !!',
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
            //     'msg' => 'Saved Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => 'Error while send'
            );
            echo json_encode($out);
        }
    }

    public function resubmit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        // $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoInvoiceModel::select('epr_po_invoice.*', 'qprojects_projects.projectname as projectname', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date')
            ->leftjoin('qprojects_projects', 'epr_po_invoice.project', '=', 'qprojects_projects.id')
            ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);

        // $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $id)->get();

        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $EprPoProducts = EprPoProductsModel::find($value->epr_po_product_id);
            if ($EprPoProducts) {
                // $poCreatedProduct = EprPoInvoiceProductsModel::where('epr_po_product_id', '=', $EprPoProducts->id)
                //     ->where('id', '!=', $value->id)
                //     ->sum('amount');
                $outArray = array(
                    'quantity' => $EprPoProducts->quantity,
                    'total' => $EprPoProducts->total,
                    'payed' => $EprPoProducts->invoice_generated_amount_total - $value->amount,
                    'payment' => $value->amount,
                    'balance' => $EprPoProducts->total - $EprPoProducts->invoice_generated_amount_total,
                );
            } else {
                $outArray = array(
                    'quantity' => $value->epr_po_product_id,
                    'total' => 0,
                    'payed' => 0,
                    'payment' => 0,
                    'balance' => 0,
                );
            }
            return $outArray;
        });

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        // unitlist
        // productlist
        return view('procurement.invoice.resubmit', compact('materialCategory',  'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'vatlist', 'reqProduct'));
    }
    public function resubmitUpdate(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                if ($request->id != '') {
                    $postID = $request->id;
                    $this->backupOldRequest($postID);
                } else
                    return 'false';


                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'version' => $request->version + 1,
                    'epr_id' => $request->epr_id,
                    'po_id' => $request->po_id,
                    'supplier_invoice_number' => $request->supplier_invoice_number,
                    'supplier_invoice_date' => Carbon::parse($request->supplier_invoice_date)->format('Y-m-d  h:i'),
                    'supplier_invoice_over_due_date' => Carbon::parse($request->supplier_invoice_over_due_date)->format('Y-m-d  h:i'),
                    'supplier_invoice_credit_period' => $request->supplier_invoice_credit_period,
                    'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d  h:i'),
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'supplier_id' => $request->supplier,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    // 'totalamount' => $request->totalamount,
                    // 'discount' => $request->discount,
                    // 'amountafterdiscount' => $request->amountafterdiscount,
                    // 'totalvatamount' => $request->totalvatamount,
                    'grandtotalamount' => $request->grandtotalamount,
                    'user_id' => $useasr_id,
                    'status' => 5
                );
                $postID = $request->id;

                $epr_id = EprPoInvoiceModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $mrId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_invoice_id' => $mrId,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'amount'   => $request->payment[$i]
                    ];
                    $eprRfqProducts = EprPoInvoiceProductsModel::Create($data);
                    $totalPayed = $request->payment[$i] + $request->payed[$i];
                    $this->poProductRateUpdate($request->eprPoProductId[$i], $totalPayed);
                }
                $this->sendReq($postID);
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

    public function backupOldRequest($postID)
    {
        $invoice = EprPoInvoiceModel::find($postID);
        $products = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $postID)->get();
        $data = array(
            'version' => $invoice->version,
            'epr_id' => $invoice->epr_id,
            'po_id' => $invoice->po_id,
            'quotedate' => $invoice->quotedate,
            'dateofsupply' => $invoice->dateofsupply,
            'request_type' => $invoice->request_type,
            'mr_category' => $invoice->mr_category,
            'request_priority' => $invoice->request_priority,
            'request_against' => $invoice->request_against,
            'client' => $invoice->client,
            'project' => $invoice->project,
            'supplier_id' => $invoice->supplier_id,
            'internalreference' => $invoice->internalreference,
            'notes' => $invoice->notes,
            'terms' => $invoice->terms,
            'totalamount' => $invoice->totalamount,
            'discount' => $invoice->discount,
            'amountafterdiscount' => $invoice->amountafterdiscount,
            'totalvatamount' => $invoice->totalvatamount,
            'grandtotalamount' => $invoice->grandtotalamount,
            'user_id' => $invoice->user_id,
            'status' => $invoice->status,
            'po_status' => $invoice->po_status
        );
        $reviced = EprPoInvoiceRevicedModel::create($data);
        // 
        foreach ($products as $key => $value) {
            $data = array(
                'epr_po_invoice_id' => $reviced->id,
                'epr_po_product_id' => $value->epr_po_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'quantity' => $value->quantity,
            );
            EprPoInvoiceProductsRevicedModel::create($data);
        }
        return true;
    }

    public function sendReq($id)
    {

        $createdBy = Auth::user()->id;
        $materialReq = EprPoInvoiceModel::find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  InvoiceWorkflowModel::select('invoiceworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                ->where('invoiceworkflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'invoiceworkflow_id' => $value->id,
                    'invoice_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = InvoiceApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('invoice', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            return  1;
        } else
            return  0;
    }

    public function poProductRateUpdate($id, $amount)
    {
        EprPoProductsModel::find($id)->update(['invoice_generated_amount_total' => $amount]);
    }

    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = EprPoInvoiceProductsModel::where('epr_po_invoice_id', $postID)->where('epr_po_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = EprPoProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('invoice_generated_amount_total', $product->amount);
            }
        }
    }

    public function generateSupplierPayment(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $MaterialRequest = EprPoInvoiceModel::select('epr_po.*', 'ma_category.name as ma_categoryname', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as project', 'qcrm_supplier.sup_name', 'qcrm_termsandconditions.term', 'qcrm_termsandconditions.description', 'epr_po_invoice.po_id', 'epr_po_invoice.id', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'epr_po_invoice.supplier_invoice_number', 'epr_po_invoice.supplier_invoice_date', 'epr_po_invoice.grandtotalamount')
            ->leftjoin('epr_po', 'epr_po_invoice.po_id', '=', 'epr_po.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'epr_po.client', '=', 'qcrm_customer_details.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po_invoice.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);
        $MaterialRequestProducts = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                'epr_po_product_id' => $value->epr_po_product_id,
                'epr_po_invoice_product_id' => $value->id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'row_total' => $value->amount,
                'payed' => $value->payment_created_amount,
                'payment' => 0,
                'balance' => $value->amount - $value->payment_created_amount,
            );
            return $outArray;
        });
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.supplierPayment.generate', compact('MaterialRequest', 'MaterialRequestProducts', 'termslist'));
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

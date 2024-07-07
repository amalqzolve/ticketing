<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\MaterialCategoryModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\procurement\EprPoGrnModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\EprPoInvoiceModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\crm\CustomerModel;

use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;

class PoOperationsController extends Controller
{

    public function listApproved(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', 'epr_po.po_status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.status',  6)
                ->where('epr_po.po_status', '!=', 3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('procurement.poOperations.listApproved');
    }

    public function listAck(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', 'epr_po.po_status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.status',  6)
                ->where('epr_po.po_status',  3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function listOpend(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', 'epr_po.po_status', 'epr_po.grn_status', 'epr_po.invoice_status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('material_request.request_type',  1)
                ->where('epr_po.status',  6)
                ->where('epr_po.po_status',  3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('grn_status', function ($row) {
                return $this->getGrnStatus($row->id);
            })->editColumn('invoice_status', function ($row) {
                return $this->getInvoiceStatus($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('procurement.poOperations.listOpend');
    }

    public function listOpendDepartment(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', 'epr_po.po_status', 'epr_po.grn_status', 'epr_po.invoice_status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('material_request.request_type',  2)
                ->where('epr_po.status',  6)
                ->where('epr_po.po_status',  3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('grn_status', function ($row) {
                return $this->getGrnStatus($row->id);
            })->editColumn('invoice_status', function ($row) {
                return $this->getInvoiceStatus($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function listOpendPersonal(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', 'epr_po.po_status', 'epr_po.grn_status', 'epr_po.invoice_status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('material_request.request_type',  3)
                ->where('epr_po.status',  6)
                ->where('epr_po.po_status',  3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('grn_status', function ($row) {
                return $this->getGrnStatus($row->id);
            })->editColumn('invoice_status', function ($row) {
                return $this->getInvoiceStatus($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function listOpendProject(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', 'epr_po.po_status', 'epr_po.grn_status', 'epr_po.invoice_status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('material_request.request_type',  4)
                ->where('epr_po.status',  6)
                ->where('epr_po.po_status',  3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('grn_status', function ($row) {
                return $this->getGrnStatus($row->id);
            })->editColumn('invoice_status', function ($row) {
                return $this->getInvoiceStatus($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function getInvoiceStatus($id)
    {
        $products =  EprPoProductsModel::select('total', 'invoice_generated_amount_total')->where('epr_po_id', $id)->get();
        $status = 0;
        $changed = 0;
        $j = 0;
        foreach ($products as $key => $value) {
            $j++;
            if ($value->total == $value->invoice_generated_amount_total)
                $status++;
            if ($value->invoice_generated_amount_total != 0)
                $changed++;
        }
        if ($j == $status)
            $out = 2;
        else if ($changed != 0)
            $out = 1;
        else
            $out = 0;
        return $out;
    }

    public function getGrnStatus($id)
    {
        $products =  EprPoProductsModel::select('quantity', 'grn_generated_qty')->where('epr_po_id', $id)->get();
        $status = 0;
        $changed = 0;
        $j = 0;
        foreach ($products as $key => $value) {
            $j++;
            if ($value->quantity == $value->grn_generated_qty)
                $status++;
            if ($value->grn_generated_qty != 0)
                $changed++;
        }
        if ($j == $status)
            $out = 2;
        else if ($changed != 0)
            $out = 1;
        else
            $out = 0;
        return $out;
    }

    public function sendForAck(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $id = $request->id;
                $po = EprPoModel::find($id);
                if ($po) {
                    $updateData = array('po_status' => 2);
                    $po->update($updateData);
                    $out = array('status' => 1);
                } else
                    $out = array('status' => 0, 'message' => 'cant find po');
                echo json_encode($out);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }
    public function acknowledge(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $id = $request->id;
                $po = EprPoModel::find($id);
                if ($po) {
                    $updateData = array('po_status' => 3);
                    $po->update($updateData);
                    $out = array('status' => 1);
                } else
                    $out = array('status' => 0, 'message' => 'cant find po');
                echo json_encode($out);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }
    public function grnAdd(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoModel::select('epr_po.*', 'epr_po.id as po_id', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprPoProductsModel::where('epr_po_id', '=', $id)->get();
        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            // $poCreatedProduct = EprPoGrnProductsModel::where('epr_po_product_id', '=', $value->id)
            //     ->sum('quantity');
            $outArray = array(
                'poQty' => $value->quantity,
                'deleiverdQty' => $value->grn_generated_qty, //$poCreatedProduct,
                'receivedQty' => 0,
                'balanceQty' => $value->quantity - $value->grn_generated_qty, //$poCreatedProduct,
            );
            return $outArray;
        });

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.poOperations.grn', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'supplier', 'vatlist', 'reqProduct'));
    }

    public function saveGrn(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');

                $data = array(
                    'epr_id' => $request->epr_id,
                    'po_id' => $request->po_id,
                    'mr_category' => $request->mr_category,
                    'supplier_id' => $request->supplier,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'grn_created_date' => Carbon::parse($request->grn_created_date)->format('Y-m-d  h:i'),
                    'grn_date' => Carbon::parse($request->grn_date)->format('Y-m-d  h:i'),
                    'total_qty' => $request->total_qty,
                    'user_id' => $useasr_id
                );
                $postID = '';

                $epr_id = EprPoGrnModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                // EprPoGrnProductsModel::where('epr_po_id', '=', $mrId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_grn_id' => $mrId,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    $eprRfqProducts = EprPoGrnProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->deleiverdQty[$i];
                    $this->poProductQtyUpdate($request->eprPoProductId[$i], $qty);
                }
                $out = array('status' => 1, 'data' => $mrId);
                echo json_encode($out);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function  invoiceBooking(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoModel::select('epr_po.*', 'qprojects_projects.projectname as projectname', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date')
            ->leftjoin('qprojects_projects', 'epr_po.project', '=', 'qprojects_projects.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);

        // $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();
        $MaterialRequestProducts = EprPoProductsModel::where('epr_po_id', '=', $id)->get();

        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                'payed' => $value->invoice_generated_amount_total,
                'payment' => 0,
                'balance' => $value->total - $value->invoice_generated_amount_total,
            );
            return $outArray;
        });

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.poOperations.invoice', compact('materialCategory',  'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'vatlist', 'reqProduct'));
    }



    public function saveInvoice(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');

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
                $postID = '';

                $epr_id = EprPoInvoiceModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                // EprPoGrnProductsModel::where('epr_po_id', '=', $mrId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_invoice_id' => $mrId,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'amount'   => $request->payment[$i]
                    ];
                    $eprRfqProducts = EprPoInvoiceProductsModel::Create($data);
                    $amount = $request->payment[$i] + $request->payed[$i];
                    $this->poProductRateUpdate($request->eprPoProductId[$i], $amount);
                }

                $out = array('status' => 1, 'data' => $mrId);
                echo json_encode($out);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function poProductQtyUpdate($id, $qty)
    {
        EprPoProductsModel::find($id)->update(['grn_generated_qty' => $qty]);
    }
    public function poProductRateUpdate($id, $amount)
    {
        EprPoProductsModel::find($id)->update(['invoice_generated_amount_total' => $amount]);
    }
}

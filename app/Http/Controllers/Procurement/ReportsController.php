<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use Auth;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;


class ReportsController extends Controller
{
    public function eprStatistics(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 1)
                ->where('material_request.status', 6)
                ->where('material_request.user_id', '=', $currentUser)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('epr_id', function ($row) {
                $url = URL::to('epr-product-list', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab"> #EPR-' . $row->id . '</a>';
            })->rawColumns(['action', 'epr_id']);
            return  $dtTble->make(true);
        } else
            return view('procurement.reports.eprStatistics');
    }
    public function eprStatisticsNonBoq(Request $request) //list nonBoq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 2)
                ->where('material_request.status', 6)
                ->where('material_request.user_id', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('epr_id', function ($row) {
                $url = URL::to('epr-product-list', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab"> #EPR-' . $row->id . '</a>';
            })->rawColumns(['action', 'epr_id']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function eprStatisticsStockReq(Request $request) //list nonBoq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->where('material_request.request_against', '=', 3)
                ->where('material_request.status', 6)
                ->where('material_request.user_id', '=', $currentUser)
                ->whereNull('sorce')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('epr_id', function ($row) {
                $url = URL::to('epr-product-list', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab"> #EPR-' . $row->id . '</a>';
            })->rawColumns(['action', 'epr_id']);
            return  $dtTble->make(true);
        } else
            return null;
    }


    public function eprProductList(Request $request, $id)
    {
        // die();
        if ($request->ajax()) {
            $data = MaterialRequestProductsModel::select('material_request_products.*', 'boqs.quantity as totalqty', 'boqs.epr_requested_quantity', 'qinventory_product_unit.unit_name')
                ->leftJoin('boqs', 'material_request_products.product_id', 'boqs.id')
                ->leftjoin('qinventory_product_unit', 'material_request_products.unit', '=', 'qinventory_product_unit.id')
                ->where('mr_id', '=', $request->epr_id)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else {
            $eprId =  Crypt::decryptString($id);
            return view('procurement.reports.eprStatisticsProduct', compact('eprId'));
        }
    }


    // ........................... po
    public function poStatistics(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.status',  6)
                ->where('material_request.request_against', '=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('po_id', function ($row) {
                $url = URL::to('po-product-list', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab"> #PO-' . $row->id . '</a>';
            })->rawColumns(['action', 'po_id']);
            return  $dtTble->make(true);
        } else
            return view('procurement.reports.poStatistics');
    }
    public function poStatisticsNonBoq(Request $request)
    {
        if ($request->ajax()) {

            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('material_request.request_against', '=', 2)
                ->where('epr_po.status', 6)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('po_id', function ($row) {
                $url = URL::to('po-product-list', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab"> #PO-' . $row->id . '</a>';
            })->rawColumns(['action', 'po_id']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function poStatisticsStockReq(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.status',  6)
                ->where('material_request.request_against', '=', 3)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('po_id', function ($row) {
                $url = URL::to('po-product-list', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab"> #PO-' . $row->id . '</a>';
            })->rawColumns(['action', 'po_id']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }

    public function poProductList(Request $request, $id)
    {
        if ($request->ajax()) {
            // $data = MaterialRequestProductsModel::select('material_request_products.*', 'boqs.quantity as totalqty', 'boqs.epr_requested_quantity', 'qinventory_product_unit.unit_name')
            //     ->leftJoin('boqs', 'material_request_products.product_id', 'boqs.id')
            //     ->leftjoin('qinventory_product_unit', 'material_request_products.unit', '=', 'qinventory_product_unit.id')
            //     ->where('mr_id', '=', $request->po_id)->get();

            $data = EprPoProductsModel::select('epr_po_products.id', 'epr_po_products.itemname', 'epr_po_products.description', 'qinventory_product_unit.unit_name', 'epr_po_products.quantity', 'epr_po_products.grn_generated_qty', 'purchase_index_products.purchased')
                ->leftJoin('qinventory_product_unit', 'epr_po_products.unit', 'qinventory_product_unit.id')
                ->leftJoin('purchase_index_products', 'epr_po_products.id', 'purchase_index_products.epr_po_product_id')
                ->where('epr_po_products.epr_po_id', '=', $request->po_id)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else {
            $poId =  Crypt::decryptString($id);
            return view('procurement.reports.poStatisticsProduct', compact('poId'));
        }
    }

    // ........................... po
}

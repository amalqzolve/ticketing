<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Session;
use DB;
use App\Boq;
use App\boq\MaterialDirectoryModel;


class DataListingController extends Controller
{

    /**
     * Display a listing of Various Products.
     */

    public function ProductpurchaseListing(Request $request)
    {
        $branch = Session::get('branch');
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
        foreach ($ccd as $cus) {
            $common_customer_database = $cus->common_customer_database;
        }
        if ($request->ajax()) {
            if ($common_customer_database == 1) {
                $query = DB::table('qinventory_products')
                    ->select('qinventory_products.*', 'qinventory_warehouse.warehouse_name as warehouse', 'qinventory_products.product_id as product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinventory_products.available_stock')
                    ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
                    ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                    ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
                    ->orderby('qinventory_products.product_id', 'desc');
                // , 'qinventory_products.category_name'
                $query->where('qinventory_products.del_flag', 1);
                $data = $query->get();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            } else {
                $query = DB::table('qinventory_products')
                    ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                    ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
                    ->select('qinventory_products.*', 'qinventory_products.product_id as product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinvoice_category.category_name', 'qinventory_products.available_stock')->orderby('qinventory_products.product_id', 'desc');
                $query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
                $data = $query->get();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            }
        } else
            return null;
    }

    public function getMaterialDirectoryList(Request $request)
    {
        if ($request->ajax()) {
            $data = MaterialDirectoryModel::get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return null;
    }

    public function getMaterialDirectoryData(Request $request)
    {
        $id = $request->id;
        $data = MaterialDirectoryModel::select('id', 'material_name as product_name', 'unit')->where('id', $id)->get();
        return response()->json($data);
    }


    public function getproduct(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qinventory_products')
            ->select('qinventory_products.product_id as id', 'qinventory_products.description', 'qinventory_products.product_name', 'qinventory_products.unit', 'qinventory_warehouse.warehouse_name as warehouse', 'qinventory_warehouse.id as warehouse_id')
            ->where('qinventory_products.product_id', $id)
            ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
            ->get();
        return response()->json($data);
    }


    public function loadBOQList(Request $request)
    {
        $projectId = $request->projectId;
        $parent_boq = BOQ::where('projectname', $projectId)->value('id');
        if ($parent_boq) {
            $node = Boq::findOrFail($parent_boq);
            $data = BOQ::select('boqs.id', 'boqs.ref', 'boqs.category_name', 'boqs.description', 'qinventory_product_unit.unit_name as unit', 'boqs.amount', 'boqs.quantity', 'boqs.epr_requested_quantity')
                ->leftJoin('qinventory_product_unit', 'boqs.unit', '=', 'qinventory_product_unit.id')
                ->where('is_parent', '=', null)
                ->whereDescendantOf($node)->get();
        } else
            $data = array();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
            return $row->id;
        })->rawColumns(['action'])->make(true);
    }

    public function getBoqProduct(Request $request)
    {
        $id = $request->id;
        $data = BOQ::select('id', 'description', 'category_name as product_name', 'unit', 'quantity', 'epr_requested_quantity')->where('id', $id)->get();
        return response()->json($data);
    }

    public function loadProject(Request $request)
    {
        $clientId = $request->id;
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $clientId)->get();
        $out = array(
            'status' => 1,
            'data' => $projects
        );
        echo json_encode($out);
    }
}

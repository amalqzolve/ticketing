<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\EprPoGrnWareHouseProductsModel;

use App\procurement\QinventoryProductsModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\projects\ProjectStockModel;
use App\projects\ProjectStockAllocatedModel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use Session;
use Auth;
use Carbon;
use DataTables;

class ReceiveStockToProjectController extends Controller
{

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $qry = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'epr_po_grn_warehouse.transfer_type', 'qprojects_projects.projectname')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_po_grn_warehouse.status', 6)
                ->where('epr_po_grn_warehouse.warehouse_receive_status', 0)
                ->whereIn('epr_po_grn_warehouse.transfer_type', ['Allocate To Project', 'Send To Project']);

            if (!$user->can('project view-all-projects'))
                $qry->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $qry->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $j = '<a href="epr-po-grn-stock-in-pdf?id=' . $row->id  . '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id  . '" >PDF</span>
                    </span></li></a>';

                if ($user->can('project receive-items-direct-epr-to-project')) {
                    $j .= '<a href="epr-po-grn-receive-stock-project?id=' . $row->id  . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id  . '" >Receive Stock</span>
                    </span></li></a>';
                }

                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('projects.receiveStockToProject.list');
    }

    public function listReceived(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $qry = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'epr_po_grn_warehouse.transfer_type', 'qprojects_projects.projectname')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_po_grn_warehouse.status', 6)
                ->where('epr_po_grn_warehouse.warehouse_receive_status', 1)
                ->whereIn('epr_po_grn_warehouse.transfer_type', ['Allocate To Project', 'Send To Project']);
            if (!$user->can('project view-all-projects'))
                $qry->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $qry->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $j = '<a href="epr-po-grn-stock-in-pdf?id=' . $row->id  . '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id  . '" >PDF</span>
                    </span></li></a>';

                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('projects.receiveStockToProject.list');
    }

    public function receiveStock(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnWarehouseModel::select('epr_po_grn.id as grn_id', 'epr_po_grn.epr_id', 'epr_po_grn.po_id', 'epr_po.quotedate', 'epr_po.dateofsupply', 'epr_po.request_type', 'epr_po.request_priority', 'epr_po.request_against', 'ma_category.name as ma_category_name', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname', 'qcrm_supplier.sup_name', 'epr_po_grn_warehouse.warehouse_id', 'epr_po_grn_warehouse.id', 'epr_po.supplier_id', 'epr_po_grn_warehouse.transfer_type', 'epr_po.project as project_id')
            ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', 'epr_po_grn.id')
            ->leftjoin('epr_po', 'epr_po_grn.po_id', 'epr_po.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', 'ma_category.id')
            ->leftJoin('qcrm_customer_details', 'epr_po.client', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_supplier', 'epr_po.supplier_id', 'qcrm_supplier.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_po_grn_warehouse.terms', 'qcrm_termsandconditions.id')
            ->find($id);

        $MaterialRequestProducts = EprPoGrnWareHouseProductsModel::select('qinventory_product_unit.unit_name', 'epr_po_grn_warehouse_products.*', 'epr_po_grn_products.quantity as totalqty', 'epr_po_grn_products.send_to_warehouse_qty', 'material_request_products.product_id as qinventory_product_id', 'epr_po_products.rate')
            ->leftjoin('epr_po_grn_products', 'epr_po_grn_warehouse_products.epr_po_grn_product_id', 'epr_po_grn_products.id')
            ->leftjoin('qinventory_product_unit', 'epr_po_grn_products.unit', 'qinventory_product_unit.id')
            ->leftjoin('epr_po_products', 'epr_po_grn_warehouse_products.epr_po_product_id', 'epr_po_products.id')
            ->leftjoin('material_request_products', 'epr_po_products.epr_product_id', 'material_request_products.id')

            ->where('epr_po_grn_warehouse_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                "rate" => $value->rate,
                "qinventory_product_id" => $value->qinventory_product_id,
                "grn_product_id" => $value->epr_po_grn_product_id,
                "epr_po_product_id" => $value->epr_po_product_id,
                "itemname" => $value->itemname,
                "description" => $value->description,
                "unit" => $value->unit,
                'unit_name' => $value->unit_name,
                "totalquantity" => $value->totalqty,
                'deliverdquantity' => $value->send_to_warehouse_qty - $value->quantity, //$ceatedProduct,
                'receivedquantity' => $value->quantity,
                'balancequantity' => $value->totalqty -  $value->send_to_warehouse_qty
            );
            return $outArray;
        });
        $warehouses = DB::table('qinventory_warehouse')->select('*')->get(); //->where('branch',$branch)
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('projects.receiveStockToProject.add', compact('MaterialRequest', 'MaterialRequestProducts', 'warehouses', 'termslist'));
    }
    public function add(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $branch = Session::get('branch');
                for ($i = 0; $i < count($request->qinventory_product_id); $i++) {
                    $inData = array(
                        'main_product_id' => $request->qinventory_product_id[$i],
                        'rate' => $request->rate[$i],
                        'product_name' => $request->productname[$i],
                        'unit' => $request->unit[$i],
                        'available_stock' => $request->quantity[$i],
                        'description' => $request->product_description[$i],
                        'branch' => $branch,
                        'project_id' => $request->project_id
                    );
                    $this->chekProductFoundOrNot($inData, $request->transfer_type);
                }
                $ifPoFind =  EprPoModel::find($request->po_id);
                if ($ifPoFind) {
                    $ifPoFind->increment('warehouse_received_qty', $request->total_qty);
                    $this->updatePOstatus($request->po_id);
                }
                EprPoGrnWarehouseModel::find($request->stock_in_id)->update(['warehouse_receive_status' => 1]);
            });
            $out = array(
                'status' => 1,
                'message' => 'Success',
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => 'Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function updatePOstatus($id)
    {
        $products = EprPoProductsModel::select('quantity', 'amount')->where('epr_po_id', $id)->get();
        $qtyTotal = 0;
        $amountTotal = 0;
        foreach ($products as $key => $value) {
            $qtyTotal += $value->quantity;
            $amountTotal += $value->amount;
        }
        $po = EprPoModel::find($id);
        if ($po) {
            if (($po->warehouse_received_qty == $qtyTotal) && ($po->issued_payemnts_amount == $amountTotal)) {
                $po->update(['po_closed' => 1]);
            }
        }
    }

    public function chekProductFoundOrNot($inData, $transfer_type)
    {
        $ifFound = QinventoryProductsModel::where('product_id', $inData['main_product_id'])->first();
        if ($ifFound) {
            // $ifFound->increment('available_stock', $inData['available_stock']);
            $product_id = $ifFound->product_id;
        } else {
            $product_id =  $this->insertProduct($inData);
            $product_id = $product_id->product_id;
        }
        if ($transfer_type == 'Send To Project') {
            // $currentStock = ProjectStockModel::select('id')->where('project_id', $inData['project_id'])->where('product_id', $product_id)->first();
            // if (isset($currentStock->id))
            //     ProjectStockModel::where('id', $currentStock->id)->increment('quantity', $inData['available_stock']);
            // else {
            $data = array(
                'project_id' => $inData['project_id'],
                'product_id' => $product_id,
                'quantity' => $inData['available_stock'],
                'rate' => $inData['rate']
            );
            ProjectStockModel::Create($data);
            // }
        } else if ($transfer_type == 'Allocate To Project') {
            // $currentStock = ProjectStockAllocatedModel::select('id')->where('project_id', $inData['project_id'])->where('product_id', $product_id)->first();
            // if (isset($currentStock->id))
            //     ProjectStockAllocatedModel::where('id', $currentStock->id)->increment('quantity', $inData['available_stock']);
            // else {
            $data = array(
                'project_id' => $inData['project_id'],
                'product_id' => $product_id,
                'quantity' => $inData['available_stock'],
                'rate' => $inData['rate']
            );
            ProjectStockAllocatedModel::Create($data);
            // }
        }
    }
    public function insertProduct($inData)
    {
        $id = IdGenerator::generate(['table' => 'qpurchase_autoincrement', 'field' => 'number', 'length' => 10, 'prefix' => 'P']);
        $data = array('number' => $id);
        $dser = DB::table('qpurchase_autoincrement')->insert($data);
        $inValue = array(
            'product_name' => $inData['product_name'],
            'unit' => $inData['unit'],
            'available_stock' => 0,
            'selling_price' => $inData['rate'],
            'description' => $inData['description'],
            'opening_stock' => 0,
            'branch' => $inData['branch'],
            'product_code' => $id
        );
        $ifAdd = QinventoryProductsModel::create($inValue);
        return $ifAdd;
    }
}

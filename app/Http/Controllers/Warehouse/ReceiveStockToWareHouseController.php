<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\EprPoGrnWareHouseProductsModel;

use App\procurement\QinventoryProductsModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use DB;
use Session;
use Auth;
use Carbon;
use DataTables;

class ReceiveStockToWareHouseController extends Controller
{


    public function list(Request $request)
    {

        if ($request->ajax()) {
            $warehouse = Session::get('warehouse');
            $data = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'qinventory_warehouse.warehouse_name')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
                ->where('epr_po_grn_warehouse.status', 6)
                ->where('epr_po_grn_warehouse.warehouse_receive_status', 0)
                ->where('epr_po_grn_warehouse.transfer_type', 'Send To Warehouse')
                ->where('epr_po_grn_warehouse.warehouse_id', $warehouse)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('warehouse.receiveStock.list');
    }

    public function listReceived(Request $request)
    {
        if ($request->ajax()) {
            $warehouse = Session::get('warehouse');
            $data = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'qinventory_warehouse.warehouse_name')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
                ->where('epr_po_grn_warehouse.status', 6)
                ->where('epr_po_grn_warehouse.warehouse_receive_status', 1)
                ->where('epr_po_grn_warehouse.transfer_type', 'Send To Warehouse')
                ->where('epr_po_grn_warehouse.warehouse_id', $warehouse)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('warehouse.receiveStock.list');
    }

    public function receiveStock(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnWarehouseModel::select('epr_po_grn.id as grn_id', 'epr_po_grn.epr_id', 'epr_po_grn.po_id', 'epr_po.quotedate', 'epr_po.dateofsupply', 'epr_po.request_type', 'epr_po.request_priority', 'epr_po.request_against', 'ma_category.name as ma_category_name', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname', 'qcrm_supplier.sup_name', 'epr_po_grn_warehouse.warehouse_id', 'epr_po_grn_warehouse.id', 'epr_po.supplier_id', 'qprojects_projects.projectname')
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
        return view('warehouse.receiveStock.add', compact('MaterialRequest', 'MaterialRequestProducts', 'warehouses', 'termslist'));
    }
    public function add(Request $request)
    {
        $branch = Session::get('branch');
        for ($i = 0; $i < count($request->eprPoProductId); $i++) {
            $inData = array(
                'main_product_id' => $request->qinventory_product_id[$i],
                'rate' => $request->rate[$i],
                'product_name' => $request->productname[$i],
                'unit' => $request->unit[$i],
                'available_stock' => $request->quantity[$i],
                'description' => $request->product_description[$i],
                'branch' => $branch,
                'warehouse' => $request->warehouses_id
            );
            if ($request->request_against == 3) {
                $this->chekProductFoundOrNot($inData);
            } else
                $this->insertProduct($inData);
        }
        $ifPoFind =  EprPoModel::find($request->po_id);
        if ($ifPoFind) {
            $ifPoFind->increment('warehouse_received_qty', $request->total_qty);
            $this->updatePOstatus($request->po_id);
        }
        EprPoGrnWarehouseModel::find($request->stock_in_id)->update(['warehouse_receive_status' => 1]);

        $out = array(
            'status' => 1,
            'message' => 'Success',
        );
        echo json_encode($out);
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

    public function chekProductFoundOrNot($inData)
    {
        $ifFound = QinventoryProductsModel::where('product_id', $inData['main_product_id'])->where('warehouse', $inData['warehouse'])->first();
        if ($ifFound) {
            $ifFound->increment('available_stock', $inData['available_stock']);
        } else {
            $this->insertProduct($inData);
        }
    }

    public function insertProduct($inData)
    {
        $inValue = array(
            'product_name' => $inData['product_name'],
            'unit' => $inData['unit'],
            'available_stock' => $inData['available_stock'],
            'selling_price' => $inData['rate'],
            'description' => $inData['description'],
            'opening_stock' => $inData['available_stock'],
            'branch' => $inData['branch'],
            'warehouse' => $inData['warehouse']
        );

        $ifAdd = QinventoryProductsModel::insert($inValue);
    }
}

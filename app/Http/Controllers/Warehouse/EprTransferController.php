<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;


use App\procurement\StockTransferModel;
use App\procurement\StockTransferProductsModel;

use App\procurement\TransferStockModel;
use App\procurement\TransferStockProductsModel;
use DataTables;
use Auth;
use PDF;
use App\User;
use App\settings\BranchSettingsModel;



class EprTransferController extends Controller
{

    public function list(Request $request)
    {

        if ($request->ajax()) {
            $warehouse = Session::get('warehouse');
            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status', 'epr_stock_transfer.transfer_status')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_stock_transfer.status',  6)
                ->where('epr_stock_transfer.transfer_status', '!=',  2)
                ->where('epr_stock_transfer.warehouse', '=', $warehouse)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('warehouse.epr.list');
    }

    public function listCompleted(Request $request)
    {
        if ($request->ajax()) {
            $warehouse = Session::get('warehouse');
            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status', 'epr_stock_transfer.transfer_status')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_stock_transfer.status',  6)
                ->where('epr_stock_transfer.transfer_status', '=',  2)
                ->where('epr_stock_transfer.warehouse', '=', $warehouse)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function listApprove(Request $request) //list Boq
    {
        if ($request->ajax()) {
        } else
            return view('warehouse.epr.listApprove');
    }
    public function transferStock(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $MaterialRequest = StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'epr_stock_transfer.warehouse', 'epr_stock_transfer.t_req_date', 'epr_stock_transfer.delivery_terms', 'epr_stock_transfer.total_qty', 'epr_stock_transfer.internalreference', 'epr_stock_transfer.notes', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.description', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'material_request.request_priority', 'material_request.request_against', 'ma_category.name as mr_category_name', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname', 'qinventory_warehouse.warehouse_name')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.id')
            ->leftJoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', 'qinventory_warehouse.id')
            ->find($id);


        $products = StockTransferProductsModel::select('epr_stock_transfer_products.id', 'epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'epr_stock_transfer_products.trns_qty', 'qinventory_product_unit.unit_name')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->where('epr_stock_transfer_id', $id)->get();
        $products = $products->map(function ($value, $key) {
            $maProduct = 0; //StockTransferProductsModel::where('epr_stock_transfer_id', '=', $value->epr_stock_transfer_id)->sum('quantity');
            $outArray = array(
                'epr_product_id' => $value->epr_product_id,
                'stock_transfer_product_id' => $value->id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'unit_name' => $value->unit_name,
                'total_quantity' => $value->quantity,
                'assigned_qty' =>  $value->trns_qty,
                'balance' => $value->quantity - $value->trns_qty,
                'quantity' => 0
            );
            return $outArray;
        });
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        // $warehouses = DB::table('qinventory_warehouse')->select('*')->get(); //->where('branch',$branch)
        return view('warehouse.eprTransferstock.add ', compact('termslist', 'MaterialRequest', 'products'));
    }

    public function transferStockSave(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');

        $data = array(
            'epr_id' => $request->epr_id,
            'stock_transfer_id' => $request->stock_transfer_id,
            'transfer_date' => Carbon::parse($request->transfer_date)->format('Y-m-d  h:i'),
            'delivery_terms' => $request->delivery_terms,
            'total_qty' => $request->total_qty,
            'internalreference' => $request->internalreference,
            'notes' => $request->notes,
            'terms' => $request->terms,
            'user_id' => $useasr_id,
        );
        $postID = '';

        $trnsfer = TransferStockModel::updateOrCreate(['id' => $postID], $data);
        $trnsferId = $trnsfer->id;
        for ($i = 0; $i < count($request->eprProductId); $i++) {
            $data = [
                'epr_transfer_stock_id' => $trnsferId,
                'epr_product_id' => $request->eprProductId[$i],
                'stock_transfer_product_id' => $request->stock_transfer_product_id[$i],
                'quantity'   => $request->quantity[$i],
                'branch' => $branch
            ];
            $eprRfqProducts = TransferStockProductsModel::Create($data);
            $qty = $request->quantity[$i] + $request->assigned_qty[$i];
            $this->updateStockTransferQty($request->stock_transfer_product_id[$i], $qty);
        }
        $this->updateStockTrnansfer($request->stock_transfer_id);
        $out = array('status' => 1, 'data' => $trnsferId);
        echo json_encode($out);
    }


    public function editView(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = TransferStockModel::select('epr_transfer_stock.*', 'epr_stock_transfer.id as epr_stock_transfer_id', 'epr_stock_transfer.epr_id', 'epr_stock_transfer.warehouse', 'epr_stock_transfer.t_req_date', 'epr_transfer_stock.delivery_terms', 'epr_transfer_stock.total_qty', 'epr_transfer_stock.internalreference', 'epr_transfer_stock.notes', 'epr_transfer_stock.terms', 'qcrm_termsandconditions.description', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'material_request.request_priority', 'material_request.request_against', 'ma_category.name as mr_category_name', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname', 'qinventory_warehouse.warehouse_name')
            ->leftjoin('epr_stock_transfer', 'epr_transfer_stock.stock_transfer_id', '=', 'epr_stock_transfer.id')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_transfer_stock.terms', 'qcrm_termsandconditions.id')
            ->leftJoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', 'qinventory_warehouse.id')
            ->find($id);
        // TransferStockProductsModel
        $products = TransferStockProductsModel::select('epr_stock_transfer_products.id as stock_transfer_product_id', 'epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_transfer_stock_products.quantity', 'epr_stock_transfer_products.trns_qty', 'epr_stock_transfer_products.quantity as total_qty', 'qinventory_product_unit.unit_name')
            ->leftJoin('epr_stock_transfer_products', 'epr_transfer_stock_products.stock_transfer_product_id', 'epr_stock_transfer_products.id')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->where('epr_transfer_stock_id', $id)->get();

        $products = $products->map(function ($value, $key) {
            $outArray = array(
                'epr_product_id' => $value->epr_product_id,
                'stock_transfer_product_id' => $value->stock_transfer_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'unit_name' => $value->unit_name,
                'total_quantity' => $value->total_qty,
                'assigned_qty' =>  $value->trns_qty - $value->quantity,
                'balance' => $value->total_qty - $value->trns_qty, //- ($value->trns_qty - $value->quantity),
                'quantity' => $value->quantity
            );
            return $outArray;
        });
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('warehouse.eprTransferstock.edit ', compact('termslist', 'MaterialRequest', 'products'));
    }

    public function update(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');

        $data = array(
            // 'epr_id' => $request->epr_id,
            // 'stock_transfer_id' => $request->stock_transfer_id,
            'transfer_date' => Carbon::parse($request->transfer_date)->format('Y-m-d  h:i'),
            'delivery_terms' => $request->delivery_terms,
            'total_qty' => $request->total_qty,
            'internalreference' => $request->internalreference,
            'notes' => $request->notes,
            'terms' => $request->terms,
            // 'user_id' => $useasr_id,
        );
        $postID = $request->id;

        $trnsfer = TransferStockModel::updateOrCreate(['id' => $postID], $data);
        // $trnsferId = $trnsfer->id;
        TransferStockProductsModel::where('epr_transfer_stock_id', $postID)->delete();
        for ($i = 0; $i < count($request->eprProductId); $i++) {
            $data = [
                'epr_transfer_stock_id' => $postID,
                'epr_product_id' => $request->eprProductId[$i],
                'stock_transfer_product_id' => $request->stock_transfer_product_id[$i],
                'quantity'   => $request->quantity[$i],
                'branch' => $branch
            ];
            $eprRfqProducts = TransferStockProductsModel::Create($data);
            $qty = $request->quantity[$i] + $request->assigned_qty[$i];
            $this->updateStockTransferQty($request->stock_transfer_product_id[$i], $qty);
        }
        $this->updateStockTrnansfer($request->stock_transfer_id);
        $out = array('status' => 1, 'data' => $postID);
        echo json_encode($out);
    }

    public function listTransferStock(Request $request)
    {
        if ($request->ajax()) {
            $data =  TransferStockModel::select('epr_transfer_stock.id', 'epr_stock_transfer.id as stock_transfer_id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_transfer_stock.transfer_date, '%d-%m-%Y') as transfer_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_transfer_stock.status')
                ->leftjoin('epr_stock_transfer', 'epr_transfer_stock.stock_transfer_id', '=', 'epr_stock_transfer.id')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_transfer_stock.status',  1)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('warehouse.eprTransferstock.list');
    }

    public function listTransferStockSend(Request $request)
    {
        if ($request->ajax()) {
            $data =  TransferStockModel::select('epr_transfer_stock.id', 'epr_stock_transfer.id as stock_transfer_id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_transfer_stock.transfer_date, '%d-%m-%Y') as transfer_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_transfer_stock.status')
                ->leftjoin('epr_stock_transfer', 'epr_transfer_stock.stock_transfer_id', '=', 'epr_stock_transfer.id')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_transfer_stock.status',  2)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainDataBefore = TransferStockModel::select(
            'epr_transfer_stock.id',
            'epr_transfer_stock.transfer_date',
            'epr_transfer_stock.delivery_terms',
            'epr_transfer_stock.total_qty',
            'epr_transfer_stock.notes',
            'epr_transfer_stock.terms',
            'qcrm_termsandconditions.description',
            'qinventory_warehouse.warehouse_name',
            'users.name as created_name',
            'qprojects_projects.projectname as project',
            'material_request.user_id as requested_by'
        )
            ->leftjoin('users', 'epr_transfer_stock.user_id', '=', 'users.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_transfer_stock.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('epr_stock_transfer', 'epr_transfer_stock.stock_transfer_id', '=', 'epr_stock_transfer.id')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->find($id);
        $mainData = array(
            'id' => $mainDataBefore->id,
            'transfer_date' => $mainDataBefore->transfer_date,
            'delivery_terms' => $mainDataBefore->delivery_terms,
            'total_qty' => $mainDataBefore->total_qty,
            'notes' => $mainDataBefore->notes,
            'terms' => $mainDataBefore->terms,
            'description' => $mainDataBefore->description,
            'warehouse_name' => $mainDataBefore->warehouse_name,
            'created_name' => $mainDataBefore->created_name,
            'project' => $mainDataBefore->project,
            'requested_by' => User::select('name')->where('id', $mainDataBefore->requested_by)->first(),
        );
        $products = TransferStockProductsModel::select('epr_stock_transfer_products.id as stock_transfer_product_id', 'epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_transfer_stock_products.quantity', 'epr_stock_transfer_products.trns_qty', 'epr_stock_transfer_products.quantity as total_qty', 'qinventory_product_unit.unit_name')
            ->leftJoin('epr_stock_transfer_products', 'epr_transfer_stock_products.stock_transfer_product_id', 'epr_stock_transfer_products.id')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->where('epr_transfer_stock_id', $id)->get();

        $approvalLevel = array();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $idData = 'TS ' . $mainDataBefore->id . '_' . date('d-m-Y', strtotime($mainDataBefore->transfer_date));
        $pdf = PDF::loadView('warehouse.eprTransferstock.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $idData,
            'margin_top' => 0
        ]);
        return $pdf->stream($idData . '.pdf');
    }

    public function send(Request $request)
    {
        $ifFind = TransferStockModel::find($request->id);
        if ($ifFind) {
            $data = array('status' => 2);
            $ifFind->update($data);
            $this->updateStockProducts($request->id);
            $out = array(
                'status' => 1,
                'msg' => 'success',
            );
        } else {
            $out = array(
                'status' => 0,
                'msg' => 'error Please Try After Some time',
            );
        }
        echo json_encode($out);
    }
    public function updateStockProducts($id)
    {
        $products = TransferStockProductsModel::select('epr_transfer_stock_products.quantity', 'material_request_products.product_id')
            ->leftJoin('material_request_products', 'epr_transfer_stock_products.epr_product_id', 'material_request_products.id')
            ->where('epr_transfer_stock_id', $id)->get();
        foreach ($products as $key => $value) {
            $this->decrementStockProduct($value->product_id, $value->quantity);
        }
    }
    public function decrementStockProduct($pId, $qty)
    {
        DB::table('qinventory_products')->where('product_id', $pId)->decrement('available_stock', $qty);
    }

    public function updateStockTransferQty($id, $qty)
    {
        StockTransferProductsModel::find($id)->update(['trns_qty' => $qty]);
    }

    public function updateStockTrnansfer($id)
    {
        $partialFlg = 0;
        $products = StockTransferProductsModel::select('quantity', 'trns_qty')->where('epr_stock_transfer_id', $id)->get();
        $eqal = 0;
        $i = 0;
        foreach ($products as $key => $value) {
            if ($value->trns_qty != 0)
                $partialFlg = 1;
            if ($value->trns_qty == $value->quantity)
                $eqal++;
            $i++;
        }
        $transfer = StockTransferModel::find($id);
        if ($transfer) {
            if ($eqal == $i)
                $transfer->update(['transfer_status' => 2]); //close status
            else if ($partialFlg == 1)
                $transfer->update(['transfer_status' => 1]);
        }
    }
}

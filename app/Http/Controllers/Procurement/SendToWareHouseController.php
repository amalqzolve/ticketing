<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\EprPoGrnModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\EprPoGrnWareHouseProductsModel;

use App\procurement\StockInWorkflowModel;
use App\procurement\StockInApprovalTransactionModel; //aaa
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

class SendToWareHouseController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'epr_po_grn_warehouse.transfer_type', 'qprojects_projects.projectname', 'qinventory_warehouse.warehouse_name')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->whereIn('epr_po_grn_warehouse.status', [1, 3])
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('warehouse_project', function ($row) {
                if ($row->transfer_type == 'Send To Warehouse')
                    $out = $row->warehouse_name;
                else if (($row->transfer_type == 'Send To Project') || (($row->transfer_type == 'Alocate To Project')))
                    $out = $row->projectname;
                else
                    $out = '';

                return $out;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('procurement.sendToWareHouse.list');
    }

    public function listSend(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'epr_po_grn_warehouse.transfer_type', 'qprojects_projects.projectname', 'qinventory_warehouse.warehouse_name')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->whereIn('epr_po_grn_warehouse.status', [2, 5])
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('warehouse_project', function ($row) {
                if ($row->transfer_type == 'Send To Warehouse')
                    $out = $row->warehouse_name;
                else if (($row->transfer_type == 'Send To Project') || (($row->transfer_type == 'Alocate To Project')))
                    $out = $row->projectname;
                else
                    $out = '';

                return $out;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return Null;
    }

    public function listApproved(Request $request)
    {
        if ($request->ajax()) {


            $data = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'epr_po_grn_warehouse.transfer_type', 'qprojects_projects.projectname', 'qinventory_warehouse.warehouse_name')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->where('epr_po_grn_warehouse.status', 6)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('warehouse_project', function ($row) {
                if ($row->transfer_type == 'Send To Warehouse')
                    $out = $row->warehouse_name;
                else if (($row->transfer_type == 'Send To Project') || (($row->transfer_type == 'Alocate To Project')))
                    $out = $row->projectname;
                else
                    $out = '';

                return $out;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return Null;
    }

    public function listRejected(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status', 'epr_po_grn_warehouse.warehouse_receive_status', 'epr_po_grn_warehouse.transfer_type', 'qprojects_projects.projectname', 'qinventory_warehouse.warehouse_name')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->where('epr_po_grn_warehouse.status', 4)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('warehouse_project', function ($row) {
                if ($row->transfer_type == 'Send To Warehouse')
                    $out = $row->warehouse_name;
                else if (($row->transfer_type == 'Send To Project') || (($row->transfer_type == 'Alocate To Project')))
                    $out = $row->projectname;
                else
                    $out = '';

                return $out;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return Null;
    }


    public function add(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnModel::select('epr_po_grn.id as grn_id', 'epr_po_grn.epr_id', 'epr_po_grn.po_id', 'epr_po.quotedate', 'epr_po.dateofsupply', 'epr_po.request_type', 'epr_po.request_priority', 'epr_po.request_against', 'ma_category.name as ma_category_name', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname', 'qcrm_supplier.sup_name', 'epr_po.internalreference', 'epr_po.notes', 'qcrm_termsandconditions.term', 'qcrm_termsandconditions.description',)
            ->leftjoin('epr_po', 'epr_po_grn.po_id', 'epr_po.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', 'ma_category.id')
            ->leftJoin('qcrm_customer_details', 'epr_po.client', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_supplier', 'epr_po.supplier_id', 'qcrm_supplier.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_po.terms', 'qcrm_termsandconditions.id')
            ->find($id);

        $MaterialRequestProducts = EprPoGrnProductsModel::select('epr_po_grn_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_po_grn_products.unit', 'qinventory_product_unit.id')
            ->where('epr_po_grn_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                "grn_product_id" => $value->id,
                "epr_po_product_id" => $value->epr_po_product_id,
                "itemname" => $value->itemname,
                "description" => $value->description,
                "unit" => $value->unit,
                'unit_name' => $value->unit_name,
                "totalquantity" => $value->quantity,
                'deliverdquantity' => $value->send_to_warehouse_qty, //$ceatedProduct,
                'receivedquantity' => 0,
                'balancequantity' => $value->quantity - $value->send_to_warehouse_qty

            );
            return $outArray;
        });
        $warehouses = DB::table('qinventory_warehouse')->select('*')->get(); //->where('branch',$branch)
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();

        return view('procurement.sendToWareHouse.add', compact('MaterialRequest', 'MaterialRequestProducts', 'warehouses', 'termslist'));
    }

    public function save(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $postID = $request->id;
                $indata = array(
                    'epr_id' => $request->epr_id,
                    'po_id' => $request->po_id,
                    'grn_id' => $request->grn_id,
                    'transfer_type' => $request->transfer_type,
                    'warehouse_id' => $request->ware_house_id,
                    'warehouse_transfer_date' => Carbon::parse($request->warehouse_transfer_date)->format('Y-m-d  h:i'),
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'total_qty' => $request->total_qty,
                    'user_id' => $useasr_id,
                    'branch' => $branch,
                );
                $ifCrated = EprPoGrnWarehouseModel::updateOrCreate(['id' => $postID], $indata);

                for ($i = 0; $i < count($request->eprPoProductId); $i++) {
                    $inData = array(
                        'epr_po_grn_warehouse_id' => $ifCrated->id,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'epr_po_grn_product_id' => $request->grnProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit' => $request->unit[$i],
                        'quantity' => $request->quantity[$i],
                    );
                    EprPoGrnWareHouseProductsModel::create($inData);
                    $qty = $request->quantity[$i] + $request->deleiverdQty[$i];
                    $this->grnProductsUpdate($request->grnProductId[$i], $qty);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnWarehouseModel::select('epr_po_grn.id as grn_id', 'epr_po_grn.epr_id', 'epr_po_grn.po_id', 'epr_po.quotedate', 'epr_po.dateofsupply', 'epr_po.request_type', 'epr_po.request_priority', 'epr_po.request_against', 'ma_category.name as ma_category_name', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname', 'qcrm_supplier.sup_name', 'epr_po.internalreference', 'epr_po.notes', 'qcrm_termsandconditions.id as terms', 'qcrm_termsandconditions.description', 'epr_po_grn_warehouse.warehouse_id', 'epr_po_grn_warehouse.id', 'epr_po_grn_warehouse.warehouse_transfer_date', 'epr_po_grn_warehouse.internalreference', 'epr_po_grn_warehouse.notes', 'epr_po_grn_warehouse.transfer_type')
            ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', 'epr_po_grn.id')
            ->leftjoin('epr_po', 'epr_po_grn.po_id', 'epr_po.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', 'ma_category.id')
            ->leftJoin('qcrm_customer_details', 'epr_po.client', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_supplier', 'epr_po.supplier_id', 'qcrm_supplier.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_po_grn_warehouse.terms', 'qcrm_termsandconditions.id')
            ->find($id);
        $MaterialRequestProducts = EprPoGrnWareHouseProductsModel::select('qinventory_product_unit.unit_name', 'epr_po_grn_warehouse_products.*', 'epr_po_grn_products.quantity as totalqty', 'epr_po_grn_products.send_to_warehouse_qty')
            ->leftjoin('epr_po_grn_products', 'epr_po_grn_warehouse_products.epr_po_grn_product_id', 'epr_po_grn_products.id')
            ->leftjoin('qinventory_product_unit', 'epr_po_grn_products.unit', 'qinventory_product_unit.id')
            ->where('epr_po_grn_warehouse_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
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
        return view('procurement.sendToWareHouse.edit', compact('MaterialRequest', 'MaterialRequestProducts', 'warehouses', 'termslist'));
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

                $indata = array(
                    'epr_id' => $request->epr_id,
                    'po_id' => $request->po_id,
                    'grn_id' => $request->grn_id,
                    'transfer_type' => $request->transfer_type,
                    'warehouse_id' => $request->ware_house_id,
                    'warehouse_transfer_date' => Carbon::parse($request->warehouse_transfer_date)->format('Y-m-d  h:i'),
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'total_qty' => $request->total_qty,
                    'user_id' => $useasr_id,
                    'branch' => $branch,
                );
                $ifCrated = EprPoGrnWarehouseModel::updateOrCreate(['id' => $postID], $indata);
                EprPoGrnWareHouseProductsModel::where('epr_po_grn_warehouse_id', $postID)->delete();
                for ($i = 0; $i < count($request->eprPoProductId); $i++) {
                    $inData = array(
                        'epr_po_grn_warehouse_id' => $ifCrated->id,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'epr_po_grn_product_id' => $request->grnProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit' => $request->unit[$i],
                        'quantity' => $request->quantity[$i],
                    );
                    EprPoGrnWareHouseProductsModel::create($inData);
                    $qty = $request->quantity[$i] + $request->deleiverdQty[$i];
                    $this->grnProductsUpdate($request->grnProductId[$i], $qty);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function editResend(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnWarehouseModel::select('epr_po_grn.id as grn_id', 'epr_po_grn.epr_id', 'epr_po_grn.po_id', 'epr_po.quotedate', 'epr_po.dateofsupply', 'epr_po.request_type', 'epr_po.request_priority', 'epr_po.request_against', 'ma_category.name as ma_category_name', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname', 'qcrm_supplier.sup_name', 'epr_po.internalreference', 'epr_po.notes', 'qcrm_termsandconditions.id as terms', 'qcrm_termsandconditions.description', 'epr_po_grn_warehouse.warehouse_id', 'epr_po_grn_warehouse.id', 'epr_po_grn_warehouse.warehouse_transfer_date', 'epr_po_grn_warehouse.internalreference', 'epr_po_grn_warehouse.notes')
            ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', 'epr_po_grn.id')
            ->leftjoin('epr_po', 'epr_po_grn.po_id', 'epr_po.id')
            ->leftjoin('ma_category', 'epr_po.mr_category', 'ma_category.id')
            ->leftJoin('qcrm_customer_details', 'epr_po.client', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'epr_po.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_supplier', 'epr_po.supplier_id', 'qcrm_supplier.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_po_grn_warehouse.terms', 'qcrm_termsandconditions.id')
            ->find($id);


        $MaterialRequestProducts = EprPoGrnWareHouseProductsModel::select('qinventory_product_unit.unit_name', 'epr_po_grn_warehouse_products.*', 'epr_po_grn_products.quantity as totalqty', 'epr_po_grn_products.send_to_warehouse_qty')
            ->leftjoin('epr_po_grn_products', 'epr_po_grn_warehouse_products.epr_po_grn_product_id', 'epr_po_grn_products.id')
            ->leftjoin('qinventory_product_unit', 'epr_po_grn_products.unit', 'qinventory_product_unit.id')
            ->where('epr_po_grn_warehouse_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
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
        return view('procurement.sendToWareHouse.reSend', compact('MaterialRequest', 'MaterialRequestProducts', 'warehouses', 'termslist'));
    }
    public function updateAndResend(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $postID = $request->id;

                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $indata = array(
                    'epr_id' => $request->epr_id,
                    'po_id' => $request->po_id,
                    'grn_id' => $request->grn_id,
                    'transfer_type' => $request->transfer_type,
                    'warehouse_id' => $request->ware_house_id,
                    'warehouse_transfer_date' => Carbon::parse($request->warehouse_transfer_date)->format('Y-m-d  h:i'),
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'total_qty' => $request->total_qty,
                    'user_id' => $useasr_id,
                    'branch' => $branch,
                    'status' => 5,
                );
                $ifCrated = EprPoGrnWarehouseModel::updateOrCreate(['id' => $postID], $indata);
                EprPoGrnWareHouseProductsModel::where('epr_po_grn_warehouse_id', $postID)->delete();
                for ($i = 0; $i < count($request->eprPoProductId); $i++) {
                    $inData = array(
                        'epr_po_grn_warehouse_id' => $ifCrated->id,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'epr_po_grn_product_id' => $request->grnProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit' => $request->unit[$i],
                        'quantity' => $request->quantity[$i],
                    );
                    EprPoGrnWareHouseProductsModel::create($inData);
                    $qty = $request->quantity[$i] + $request->deleiverdQty[$i];
                    $this->grnProductsUpdate($request->grnProductId[$i], $qty);
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoGrnWarehouseModel::select(
            'epr_po_grn_warehouse.id',
            'epr_po_grn_warehouse.warehouse_transfer_date',
            'qinventory_warehouse.warehouse_name',
            'epr_po_grn_warehouse.notes',
            'qcrm_termsandconditions.description',
            'qcrm_supplier.sup_name',
            'users.name as created_name',
            'epr_po_grn_warehouse.status'
        )
            ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
            ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')

            ->leftjoin('epr_po', 'epr_po_grn_warehouse.po_id', '=', 'epr_po.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po_grn_warehouse.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);


        $products = EprPoGrnWareHouseProductsModel::select('epr_po_grn_warehouse_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_po_grn_warehouse_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_po_grn_warehouse_id', '=', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = StockInApprovalTransactionModel::select('stock_in_approval_transaction.updated_at', 'stock_in_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'stock_in_approval_transaction.status')
                ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
                ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', $mainData->id)
                ->where('stock_in_approval_transaction.status', '!=', 0)
                ->where('stock_in_approval_transaction.status', '!=', 1)
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
        $pdfId = 'S-IN ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->warehouse_transfer_date));
        $pdf = PDF::loadView('procurement.sendToWareHouse.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
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
                $id = $request->id;
                $createdBy = Auth::user()->id;

                $materialReq = EprPoGrnWarehouseModel::select('epr_po_grn_warehouse.id', 'epr_po.mr_category')
                    ->leftjoin('epr_po', 'epr_po_grn_warehouse.po_id', 'epr_po.id')->find($id);
                if ($materialReq) {
                    $materialReq->mr_category;
                    $workflow =  StockInWorkflowModel::select('stock_in_workflow.id', 'users.email', 'users.name')
                        ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                        ->where('stock_in_workflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
                    $i = 0;
                    foreach ($workflow as $key => $value) {
                        $status = ($key == 0) ? 1 : 0;
                        $data = array(
                            'stock_in_workflow_id' => $value->id,
                            'epr_po_grn_warehouse_id' => $id,
                            'created_by' => $createdBy,
                            'status' => $status
                        );
                        $tData = StockInApprovalTransactionModel::create($data);
                        if ($status == 1) {
                            $toMailId = $value->email;
                            $this->sendMail('stock-in', $id, $toMailId, $tData->id, $value->name, Carbon::now());
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
                            'msg' => 'Stock In Approval Sysnthesis Not Found Contact Admin !!',
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
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function sendReq($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = EprPoGrnWarehouseModel::select('epr_po.mr_category')->leftjoin('epr_po', 'epr_po_grn_warehouse.po_id', '=', 'epr_po.id')->find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  StockInWorkflowModel::select('stock_in_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                ->where('stock_in_workflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'stock_in_workflow_id' => $value->id,
                    'epr_po_grn_warehouse_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = StockInApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('stock-in', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            return 1;
        }
    }

    public function grnProductsUpdate($id, $qty)
    {
        EprPoGrnProductsModel::find($id)->update(['send_to_warehouse_qty' => $qty]);
    }
    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = EprPoGrnWareHouseProductsModel::where('epr_po_grn_warehouse_id', $postID)->where('epr_po_grn_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = EprPoGrnProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('send_to_warehouse_qty', $product->quantity);
            }
        }
    }

    public function sendMail($docType = 'stock-in', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Stock In';
        $data['document'] = 'S-IN';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

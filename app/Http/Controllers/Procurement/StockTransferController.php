<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\PoApprovalTransactionModel;
use App\MaterialCategoryModel;
use App\procurement\MaterialRequestProductsModel;

use App\crm\CustomerModel;

use App\procurement\StockTransferModel;
use App\procurement\StockTransferProductsModel;

use App\procurement\StockTransferRevisedModel;
use App\procurement\StockTransferProductsRevicedModel;

use App\procurement\StockTransferWorkflowModel;
use App\procurement\StockTransferApprovalTransactionModel;
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


class StockTransferController extends Controller
{

    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status')

                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->whereIn('epr_stock_transfer.status',  [1, 3])->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.stockTransfer.list');
    }

    public function sendList(Request $request)
    {
        if ($request->ajax()) {
            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status')

                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->whereIn('epr_stock_transfer.status',  [2, 5])->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function approvedList(Request $request)
    {
        if ($request->ajax()) {
            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_stock_transfer.status',  6)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function rejectedList(Request $request)
    {
        if ($request->ajax()) {
            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status')

                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_stock_transfer.status',  4)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }


    public function generate(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = MaterialRequestModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where(
            'client',
            '=',
            $MaterialRequest->client
        )->get();

        //$productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = MaterialRequestProductsModel::select('material_request_products.*', 'qinventory_product_unit.unit_name', 'qinventory_warehouse.warehouse_name', 'qinventory_warehouse.id as warehouse_id')
            ->leftJoin('qinventory_product_unit', 'material_request_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('qinventory_products', 'material_request_products.product_id', 'qinventory_products.product_id')
            ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
            ->where('material_request_products.mr_id', '=', $id)
            ->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                'id' => $value->id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'unit_name' => $value->unit_name,
                'epr_quantity' => $value->quantity,
                'po_assigned_qty' => $value->po_assigned_qty,
                'balance' => $value->quantity - $value->po_assigned_qty,
                'warehouse_name' => $value->warehouse_name,
                'warehouse_id' => $value->warehouse_id,
                'quantity' => 0,
            );
            return $outArray;
        });
        // 'productlist',
        $warehouses = DB::table('qinventory_warehouse')->select('*')->get(); //->where('branch',$branch)
        return view('procurement.stockTransfer.generate', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'warehouses',  'projects'));
    }

    public function save(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');

                $data = array(
                    'epr_id' => $request->epr_id,
                    'warehouse' => $request->warehouse,
                    't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
                    'delivery_terms' => $request->delivery_terms,
                    'total_qty' => $request->total_qty,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'user_id' => $useasr_id,
                );
                $postID = '';

                $trnsfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
                $trnsferId = $trnsfer->id;
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_stock_transfer_id' => $trnsferId,
                        'epr_product_id' => $request->eprProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    $eprRfqProducts = StockTransferProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->po_assigned_qty[$i];
                    $this->updateEprQty($request->eprProductId[$i], $qty);
                }
                $out = array('status' => 1, 'data' => $trnsferId);
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


    public function editView(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $MaterialRequest = StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'epr_stock_transfer.warehouse', 'epr_stock_transfer.t_req_date', 'epr_stock_transfer.delivery_terms', 'epr_stock_transfer.total_qty', 'epr_stock_transfer.internalreference', 'epr_stock_transfer.notes', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.description', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'material_request.request_priority', 'material_request.request_against', 'ma_category.name as mr_category_name', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.id')
            ->find($id);


        $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name', 'qinventory_warehouse.warehouse_name', 'qinventory_warehouse.id as warehouse_id')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('material_request_products', 'epr_stock_transfer_products.epr_product_id', 'material_request_products.id')
            ->leftJoin('qinventory_products', 'material_request_products.product_id', 'qinventory_products.product_id')
            ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
            ->where('epr_stock_transfer_id', $id)->get();
        $products = $products->map(function ($value, $key) {
            $maProduct = MaterialRequestProductsModel::find($value->epr_product_id);
            $outArray = array(
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'unit_name' => $value->unit_name,
                'epr_quantity' => $maProduct->quantity,
                'po_assigned_qty' => $maProduct->po_assigned_qty - $value->quantity,
                'balance' => ($maProduct->quantity - $maProduct->po_assigned_qty),
                'quantity' => $value->quantity,
                'warehouse_name' => $value->warehouse_name,
                'warehouse_id' => $value->warehouse_id,
            );
            return $outArray;
        });
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $warehouses = DB::table('qinventory_warehouse')->select('*')->get(); //->where('branch',$branch)
        return view('procurement.stockTransfer.edit ', compact('termslist', 'MaterialRequest', 'products', 'warehouses'));
    }

    public function Update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $postID = $request->id;
                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);


                $data = array(
                    'warehouse' => $request->warehouse,
                    't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
                    'delivery_terms' => $request->delivery_terms,
                    'total_qty' => $request->total_qty,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                );



                $trnsid = StockTransferModel::updateOrCreate(['id' => $postID], $data);
                $trnsferId = $trnsid->id;
                StockTransferProductsModel::where('epr_stock_transfer_id', '=', $trnsferId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_stock_transfer_id' => $trnsferId,
                        'epr_product_id' => $request->eprProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    $eprRfqProducts = StockTransferProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->po_assigned_qty[$i];
                    $this->updateEprQty($request->eprProductId[$i], $qty);
                }
                $out = array('status' => 1, 'data' => $trnsferId);
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


    public function resubmit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $MaterialRequest = StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'epr_stock_transfer.warehouse', 'epr_stock_transfer.t_req_date', 'epr_stock_transfer.delivery_terms', 'epr_stock_transfer.total_qty', 'epr_stock_transfer.internalreference', 'epr_stock_transfer.notes', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.description', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'material_request.request_priority', 'material_request.request_against', 'ma_category.name as mr_category_name', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.id')
            ->find($id);


        // $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name')
        //     ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
        //     ->where('epr_stock_transfer_id', $id)->get();
        // $products = $products->map(function ($value, $key) {
        //     $maProduct = MaterialRequestProductsModel::find($value->epr_product_id);
        //     $outArray = array(
        //         'epr_product_id' => $value->epr_product_id,
        //         'itemname' => $value->itemname,
        //         'description' => $value->description,
        //         'unit' => $value->unit,
        //         'unit_name' => $value->unit_name,
        //         'epr_quantity' => $maProduct->quantity,
        //         'po_assigned_qty' => $maProduct->po_assigned_qty - $value->quantity,
        //         'balance' => ($maProduct->quantity - $maProduct->po_assigned_qty),
        //         'quantity' => $value->quantity,
        //     );
        //     return $outArray;
        // });
        $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name', 'qinventory_warehouse.warehouse_name', 'qinventory_warehouse.id as warehouse_id')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('material_request_products', 'epr_stock_transfer_products.epr_product_id', 'material_request_products.id')
            ->leftJoin('qinventory_products', 'material_request_products.product_id', 'qinventory_products.product_id')
            ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
            ->where('epr_stock_transfer_id', $id)->get();
        $products = $products->map(function ($value, $key) {
            $maProduct = MaterialRequestProductsModel::find($value->epr_product_id);
            $outArray = array(
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'unit_name' => $value->unit_name,
                'epr_quantity' => $maProduct->quantity,
                'po_assigned_qty' => $maProduct->po_assigned_qty - $value->quantity,
                'balance' => ($maProduct->quantity - $maProduct->po_assigned_qty),
                'quantity' => $value->quantity,
                'warehouse_name' => $value->warehouse_name,
                'warehouse_id' => $value->warehouse_id,
            );
            return $outArray;
        });
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $warehouses = DB::table('qinventory_warehouse')->select('*')->get(); //->where('branch',$branch)
        return view('procurement.stockTransfer.resubmit ', compact('termslist', 'MaterialRequest', 'products', 'warehouses'));
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
                    'warehouse' => $request->warehouse,
                    't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
                    'delivery_terms' => $request->delivery_terms,
                    'total_qty' => $request->total_qty,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'status' => 5,
                );

                $trnsfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
                $trnsferId = $trnsfer->id;
                StockTransferProductsModel::where('epr_stock_transfer_id', '=', $trnsferId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_stock_transfer_id' => $trnsferId,
                        'epr_product_id' => $request->eprProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    $eprRfqProducts = StockTransferProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->po_assigned_qty[$i];
                    $this->updateEprQty($request->eprProductId[$i], $qty);
                }
                $this->sendReq($postID);
                $out = array('status' => 1, 'data' => $trnsferId);
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

    public function backupOldRequest($eprId)
    {
        $materialReq = StockTransferModel::find($eprId);
        $data = array(
            'version' => $materialReq->version,
            'warehouse' => $materialReq->warehouse,
            't_req_date' => $materialReq->t_req_date,
            'delivery_terms' => $materialReq->delivery_terms,
            'total_qty' => $materialReq->total_qty,
            'internalreference' => $materialReq->internalreference,
            'notes' => $materialReq->notes,
            'terms' => $materialReq->terms,
        );
        $postID = '';
        $inserted = StockTransferRevisedModel::updateOrCreate(['id' => $postID], $data);
        $newMrId = $inserted->id;
        $products = StockTransferProductsModel::where('epr_stock_transfer_id', $eprId)->get();
        foreach ($products as $key => $value) {
            $prData = array(
                'epr_stock_transfer_id' => $newMrId,
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit'   => $value->unit,
                'quantity' => $value->quantity,
                'branch' => $value->branch
            );
            StockTransferProductsRevicedModel::insert($prData);
        }
        $this->sendReq($postID);
        return 'true';
    }

    public function pdf(Request $request)
    {

        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = StockTransferModel::select(
            'epr_stock_transfer.id',
            'epr_stock_transfer.t_req_date',
            'epr_stock_transfer.delivery_terms',
            'epr_stock_transfer.total_qty',
            'epr_stock_transfer.notes',
            'epr_stock_transfer.terms',
            'qcrm_termsandconditions.description',
            'qinventory_warehouse.warehouse_name',
            'users.name as created_name',
            'epr_stock_transfer.status'
        )
            ->leftjoin('users', 'epr_stock_transfer.user_id', '=', 'users.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
            ->find($id);
        $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->where('epr_stock_transfer_id', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.updated_at')
                ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('epr_stock_transfer_approval_transaction.stock_transfer_id', '=', $id)
                ->whereIn('epr_stock_transfer_approval_transaction.status', [2, 3, 4])
                ->orderBy('epr_stock_transfer_approval_transaction.id', 'asc')
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
        $idData = 'ST ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->t_req_date));
        $pdf = PDF::loadView('procurement.stockTransfer.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $idData,
            'margin_top' => 0
        ]);
        return $pdf->stream($idData . '.pdf');
    }


    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }

    public function send(Request $request)
    {
        $createdBy = Auth::user()->id;
        $id = $request->id;

        $materialReq = StockTransferModel::select('material_request.mr_category')->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')->find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  StockTransferWorkflowModel::select('epr_stock_transfer_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->where('epr_stock_transfer_workflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            $i = 0;
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'stock_transfer_workflow_id' => $value->id,
                    'stock_transfer_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = StockTransferApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('stock-transfer', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
                $i++;
            }
            if ($i != 0) {
                $data = array('status' => 2);
                StockTransferModel::find($id)->update($data);
                $out = array(
                    'status' => 1,
                    'msg' => 'success',
                );
            } else {
                $out = array(
                    'status' => 0,
                    'msg' => 'Stock Transfer Sysnthesis Not Found Contact Admin !!',
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
    }

    public function sendReq($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = StockTransferModel::select('material_request.mr_category')->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')->find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  StockTransferWorkflowModel::select('epr_stock_transfer_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->where('epr_stock_transfer_workflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'stock_transfer_workflow_id' => $value->id,
                    'stock_transfer_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = StockTransferApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('stock-transfer', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            return 1;
        }
    }


    public function updateEprQty($id, $qty)
    {
        MaterialRequestProductsModel::find($id)->update(['po_assigned_qty' => $qty]);
    }

    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = StockTransferProductsModel::where('epr_stock_transfer_id', $postID)->where('epr_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = MaterialRequestProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('po_assigned_qty', $product->quantity);
            }
        }
    }

    public function sendMail($docType = 'stock-transfer', $docId, $toMailId, $transactionId, $userName, $date)
    {

        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now()
        ];
        DB::table('email_verify_keys')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'Stock Transfer';
        $data['document'] = 'ST';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

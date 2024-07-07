<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use Session;
use DB;
use App\projects\ProjectModel;
use App\procurement\TransferStockModel;
use App\procurement\TransferStockProductsModel;
use App\projects\ProjectStockModel;
use Auth;


class WarehouseInboundController extends Controller
{
    public function warehouseInboundList(Request $request)
    {
        if ($request->ajax()) {
            $branch = Session::get('branch');
            $user = Auth::user();
            $qry =  TransferStockModel::select('epr_transfer_stock.id', 'epr_stock_transfer.id as stock_transfer_id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_transfer_stock.transfer_date, '%d-%m-%Y') as transfer_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_transfer_stock.status', 'epr_transfer_stock.received_status')
                ->leftjoin('epr_stock_transfer', 'epr_transfer_stock.stock_transfer_id', '=', 'epr_stock_transfer.id')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_transfer_stock.status',  2)
                ->where('epr_transfer_stock.received_status',  0)
                ->where('qprojects_projects.branch',  $branch);

            if (!$user->can('project view-all-projects'))
                $qry->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $qry->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '<a href="../transfer-stock-pdf?id=' . $row->id . '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delivery Note</span>
                    </span></li></a>';
                if (($row->received_status != 1) && ($user->can('project receive-items-warehouse-to-project'))) {
                    $j .= '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item receive_products" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-piggy-bank"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Receive Items</span>
                </span></li></a>';
                }
                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else {
            return view('projects.warehouseInbound.list');
        }
    }

    public function warehouseInboundListDone(Request $request)
    {
        if ($request->ajax()) {
            $branch = Session::get('branch');
            $data =  TransferStockModel::select('epr_transfer_stock.id', 'epr_stock_transfer.id as stock_transfer_id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_transfer_stock.transfer_date, '%d-%m-%Y') as transfer_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_transfer_stock.status', 'epr_transfer_stock.received_status')
                ->leftjoin('epr_stock_transfer', 'epr_transfer_stock.stock_transfer_id', '=', 'epr_stock_transfer.id')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('epr_transfer_stock.status',  2)
                ->where('epr_transfer_stock.received_status',  1)
                ->where('qprojects_projects.branch',  $branch)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }

    public function reciveToProject(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $id = $request->id;
                    $ifFound = TransferStockModel::find($id);
                    $upArray = array(
                        'received_status' => 1,
                        'received_comment' => $request->comment,
                        'received_at' => isset($request->received_date) ? Carbon::parse($request->received_date)->format('Y-m-d') : NULL
                    );
                    $ifFound->update($upArray);
                    $products = TransferStockProductsModel::select('epr_transfer_stock_products.quantity', 'material_request_products.product_id')
                        ->leftJoin('material_request_products', 'epr_transfer_stock_products.epr_product_id', 'material_request_products.id')
                        ->where('epr_transfer_stock_id', $id)
                        ->get();

                    foreach ($products as $key => $value) {
                        $currentStock = ProjectStockModel::select('id')->where('project_id', $request->project_id)->where('product_id', $value->product_id)->first();
                        if (isset($currentStock->id))
                            ProjectStockModel::where('id', $currentStock->id)->increment('quantity', $value->quantity);
                        else {
                            $data = array(
                                'project_id' => $request->project_id,
                                'product_id' => $value->product_id,
                                'quantity' => $value->quantity
                            );
                            ProjectStockModel::Create($data);
                        }
                    }
                });

                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Successfully'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Delete'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }
}

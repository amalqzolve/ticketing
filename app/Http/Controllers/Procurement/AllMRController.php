<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\EprApprovalTransactionModel;
use DB;
use Auth;
use phpDocumentor\Reflection\Types\Null_;

class AllMRController extends Controller
{
    public function index(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 1)
                ->where('material_request.status', '!=', 0)
                // ->where('material_request.user_id', '=', $currentUser)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '!=', 0)
                        ->limit(1)
                        ->orderBy('epr_approval_transaction.id', 'desc')->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting ';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending from ';
                        else if ($value->status == 2)
                            $statu = 'Approved ';
                        else if ($value->status == 3)
                            $statu = 'Returned From ';
                        else if ($value->status == 4)
                            $statu = 'rejected ';

                        $str .= $statu . $value->name;
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.epr.all.listing');
    }
    public function listNonBoq(Request $request) //list nonBoq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 2)
                ->where('material_request.status', '!=', 0)
                // ->where('material_request.user_id', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if ($row->status != 0) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '!=', 0)
                        ->limit(1)
                        ->orderBy('epr_approval_transaction.id', 'desc')->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting ';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending from ';
                        else if ($value->status == 2)
                            $statu = 'Approved ';
                        else if ($value->status == 3)
                            $statu = 'Returned From ';
                        else if ($value->status == 4)
                            $statu = 'rejected ';

                        $str .= $statu . $value->name;
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function listStockReq(Request $request) //list nonBoq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->where('material_request.request_against', '=', 3)
                ->where('material_request.status', '!=', 0)
                // ->where('material_request.user_id', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if ($row->status != 0) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '!=', 0)
                        ->limit(1)
                        ->orderBy('epr_approval_transaction.id', 'desc')->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting ';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending from ';
                        else if ($value->status == 2)
                            $statu = 'Approved ';
                        else if ($value->status == 3)
                            $statu = 'Returned From ';
                        else if ($value->status == 4)
                            $statu = 'rejected ';

                        $str .= $statu . $value->name;
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
}

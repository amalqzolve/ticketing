<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\MaterialCategoryModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\MrWorkflowModel;
use App\procurement\EprApprovalTransactionModel;
use App\procurement\MaterialRequestModelRevised;
use App\procurement\EPRAttachmentsModel;
use App\crm\CustomerModel;
use App\projects\ProjectModel;
use App\User;
use App\Boq;
use File;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;
use Illuminate\Support\Facades\URL;
use App\settings\BranchSettingsModel;


class MaterialRequestController extends Controller
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
                ->where('material_request.user_id', '=', $currentUser)
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
            return view('procurement.epr.listing');
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
                ->where('material_request.user_id', '=', $currentUser)
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
            return view('procurement.epr.listingNonBoq');
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
                ->where('material_request.user_id', '=', $currentUser)
                ->whereNull('sorce')
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
            return view('procurement.epr.listingStockReq');
    }
    // 1=>Draft       
    // 3=>Returned
    public function listBoqDraft(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 1)
                ->whereIn('material_request.status', [1, 3])
                ->where('material_request.user_id', '=', $currentUser)
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
            return view('procurement.epr.listingBoq');
    }
    // 2=>send
    // 5=>Resubmited
    public function listBoqSend(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 1)
                ->whereIn('material_request.status',  [2, 5])
                ->where('material_request.user_id', '=', $currentUser)
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
            return null;
    }
    // 6=>Approved
    public function listBoqApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 1)
                ->where('material_request.status', [6])
                ->where('material_request.user_id', '=', $currentUser)
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
            return null;
    }
    // 4=>Rejected
    public function listBoqRejected(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 1)
                ->where('material_request.status', 4)
                ->where('material_request.user_id', '=', $currentUser)
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
            return null;
    }

    // 1=>Draft       
    // 3=>Returned
    public function listNonBoqDraft(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 2)
                ->whereIn('material_request.status', [1, 3])
                ->where('material_request.user_id', '=', $currentUser)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }
    // 2=>send
    // 5=>Resubmited
    public function listNonBoqSend(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 2)
                ->whereIn('material_request.status', [2, 5])
                ->where('material_request.user_id', '=', $currentUser)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }

    // 6=>Approved
    public function listNonBoqApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 2)
                ->where('material_request.status',  6)
                ->where('material_request.user_id', '=', $currentUser)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }
    // 4=>Rejected
    public function listNonBoqRejected(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 2)
                ->where('material_request.status',  4)
                ->where('material_request.user_id', '=', $currentUser)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }

    // 1=>Draft       
    // 3=>Returned
    public function listStockDraft(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 3)
                ->whereIn('material_request.status',  [1, 3])
                ->where('material_request.user_id', '=', $currentUser)
                ->whereNull('sorce')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }
    // 2=>send
    // 5=>Resubmited
    public function listStockSend(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 3)
                ->whereIn('material_request.status', [5, 2])
                ->where('material_request.user_id', '=', $currentUser)
                ->whereNull('sorce')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }
    // 6=>Approved
    public function listStockApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 3)
                ->where('material_request.status', [6])
                ->where('material_request.user_id', '=', $currentUser)
                ->whereNull('sorce')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }
    // 4=>Rejected
    public function listStockRejected(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftJoin('qcrm_customer_details', 'material_request.client', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->where('material_request.request_against', '=', 3)
                ->where('material_request.status', [4])
                ->where('material_request.user_id', '=', $currentUser)
                ->whereNull('sorce')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('epr_approval_transaction.epr_id', '=', $row->id)
                        ->where('epr_approval_transaction.status', '=', 0)
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
            return null;
    }

    public function listTrashedEpr(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status')->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')->where('material_request.status', '=', 0)
                ->where('material_request.user_id', '=', $currentUser)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return view('procurement.epr.listingTrash');
    }


    public function add(Request $request)
    {
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        return view('procurement.epr.add', compact('materialCategory', 'unitlist', 'termslist', 'customers'));
    }

    public function attachmentsUpload(Request $request)
    {

        $uploded_by = Auth::user()->id;
        $epr_id = $request->epr_id;
        $path = public_path('epr_attachments/');
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $inArray = array(
                    'epr_id' => $epr_id,
                    'file' => $name,
                    'file_path' => $path,
                    'description' => $request->description,
                    'uploded_by' => $uploded_by,
                    'uploded_date' => Carbon::now(),
                );
                $attchment =  EPRAttachmentsModel::Create($inArray);
                if ($epr_id == '') {
                    $attachmentSession =  Session::get('attachment');
                    if ($attachmentSession != '') {
                        $attachmentArray = json_decode($attachmentSession);
                        array_push($attachmentArray, $attchment->id);
                        $attachmentVal = json_encode($attachmentArray);
                        Session::put('attachment', $attachmentVal);
                    } else {
                        $attachmentArray = array($attchment->id);
                        $attachmentVal = json_encode($attachmentArray);
                        Session::put('attachment', $attachmentVal);
                    }
                }
            }
        }

        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }


    public function attachmentsList(Request $request, $id)
    {

        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = EPRAttachmentsModel::select('epr_attachments.id', 'epr_attachments.epr_id', 'epr_attachments.description', 'epr_attachments.file_path', 'file', DB::raw("DATE_FORMAT(epr_attachments.uploded_date, '%d-%m-%Y') as uploded_date"), 'users.name')
                ->leftjoin('users', 'epr_attachments.uploded_by', 'users.id')
                ->where('epr_attachments.epr_id', $request->epr_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {

                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                $path = URL::to($filePath);
                $j = '';
                // $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                // <span class="kt-nav__link">
                // <i class="kt-nav__link-icon flaticon-edit-1"></i>
                // <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                // </span></li></a>';

                $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                $j .= '<a href="' . $path . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-arrow-down"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Download</span>
                </span></li></a>';

                return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else
            return null;
    }

    public function attachmentsDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $if_found = EPRAttachmentsModel::find($request->id);
                    if ($if_found) {
                        if (File::exists($if_found->file_path . '/' . $if_found->file))
                            File::delete($if_found->file_path . '/' . $if_found->file);
                        $if_found->delete();
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Deleted Successfully'
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


    public function editView(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = MaterialRequestModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        if ($MaterialRequest->request_against == 1) {
            $MaterialRequestProducts = MaterialRequestProductsModel::select('material_request_products.*', 'boqs.quantity as totalqty', 'boqs.epr_requested_quantity')
                ->leftJoin('boqs', 'material_request_products.product_id', 'boqs.id')
                ->where('mr_id', '=', $id)->get();
        } else
            $MaterialRequestProducts = MaterialRequestProductsModel::where('mr_id', '=', $id)->get();

        return view('procurement.epr.edit', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'projects'));
    }

    public function reSendView(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = MaterialRequestModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        if ($MaterialRequest->request_against == 1) {
            $MaterialRequestProducts = MaterialRequestProductsModel::select('material_request_products.*', 'boqs.quantity as totalqty', 'boqs.epr_requested_quantity')
                ->leftJoin('boqs', 'material_request_products.product_id', 'boqs.id')
                ->where('mr_id', '=', $id)->get();
        } else
            $MaterialRequestProducts = MaterialRequestProductsModel::where('mr_id', '=', $id)->get();
        return view('procurement.epr.resend', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'projects'));
    }


    public function view(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = MaterialRequestModel::find($id);

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = MaterialRequestProductsModel::where('mr_id', '=', $id)->get();
        return view('procurement.epr.view', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist'));
    }
    public function viewpdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = MaterialRequestModel::select('material_request.id', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'ma_category.name as mr_category_name', 'qcrm_termsandconditions.description', 'material_request.notes', 'users.name as created_name', 'material_request.status', 'qprojects_projects.projectname')
            ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qprojects_projects', 'material_request.project', '=', 'qprojects_projects.id')
            ->leftjoin('qcrm_termsandconditions', 'material_request.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);


        $MaterialRequestProducts = MaterialRequestProductsModel::select('material_request_products.itemname', 'material_request_products.description', 'material_request_products.quantity', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'material_request_products.unit', '=', 'qinventory_product_unit.id')->where('mr_id', '=', $id)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        if (($MaterialRequest->status != 1) || $MaterialRequest->status != 0) {
            $approvalLevel = EprApprovalTransactionModel::select('epr_approval_transaction.updated_at', 'epr_approval_transaction.status_changed_by', 'epr_approval_transaction.comments', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_approval_transaction.status', 'mrworkflow.if_accepted_note', 'mrworkflow.if_rejected_note')
                ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('epr_approval_transaction.epr_id', '=', $MaterialRequest->id)
                ->where('epr_approval_transaction.status', '!=', 0)
                ->where('epr_approval_transaction.status', '!=', 1)
                ->get();

            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                if ($value->status_changed_by != null) {
                    $user = $this->getDescUser($value->status_changed_by);
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => isset($user->name) ? $user->name : $value->name,
                        'sign' => isset($user->sign) ? $user->sign : $value->sign,
                        'designation' => $user->designation,
                        'department' => $user->department,
                        'status' => $value->status,
                        'if_accepted_note' => $value->if_accepted_note,
                        'if_rejected_note' => $value->if_rejected_note,
                        'comments' => $value->comments,
                    );
                } else {
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $value->name,
                        'sign' => $value->sign,
                        'designation' => $value->designation,
                        'department' => $value->department,
                        'status' => $value->status,
                        'if_accepted_note' => $value->if_accepted_note,
                        'if_rejected_note' => $value->if_rejected_note,
                        'comments' => $value->comments,
                    );
                }
                return $outArray;
            });
        } else
            $approvalLevel = array();


        $eprId = 'EPR ' . $MaterialRequest->id . '_' . date('d-m-Y', strtotime($MaterialRequest->quotedate));
        $configuration = [];
        $pdf = PDF::loadView('procurement.epr.preview1', compact('MaterialRequest', 'MaterialRequestProducts', 'approvalLevel', 'branchsettings'), $configuration,  [
            'title'      => $eprId,
            'margin_top' => 0
        ]);

        return $pdf->stream($eprId . '.pdf');
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }

    public function getqrCode()
    {
    }

    public function newEpr(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $postID = $request->id;
                $data = [
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                ];

                if ($postID == '')
                    $data['user_id'] = $useasr_id;

                $mr = MaterialRequestModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $mr->id;
                // DB::table('qsales_enquiry_products')->where('enquiryid', $enquiryid)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'mr_id' => $mrId,
                        'product_id' => $request->product_id[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    if ($request->request_against == 1) {
                        $upQty = $request->reqQty[$i] + $request->quantity[$i];
                        $this->updateBoq($request->product_id[$i], $upQty);
                    }
                    $materialRequestProducts = MaterialRequestProductsModel::Create($data);
                }
                $attachment =   Session::get('attachment');
                if ($attachment != '') {
                    $attachmentArray = json_decode($attachment);
                    EPRAttachmentsModel::whereNull('epr_id')->whereIn('id', $attachmentArray)->update(array('epr_id' => $mrId));
                    Session::put('attachment', '');
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


    public function updateBoq($id, $qty)
    {
        $ifUpdated = BOQ::find($id)->update(['epr_requested_quantity' => $qty]);
        if ($ifUpdated)
            return 1;
    }

    public function trashedBoqUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = MaterialRequestProductsModel::where('mr_id', $postID)->where('product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = BOQ::find($value);
                if ($ifFind) {
                    $oldQty = $ifFind->epr_requested_quantity;
                    $newQty = $oldQty - $product->quantity;
                    $ifFind->update(['epr_requested_quantity' => $newQty]);
                }
            }
        }
    }



    public function materialRequestUpdate(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                if ($request->id != '')
                    $postID = $request->id;
                else
                    return 'false';

                if (($request->deleted_elements != '') && ($request->request_against == 1)) {
                    $this->trashedBoqUpdate($postID, $request->deleted_elements);
                }

                $data = [
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'user_id' => $useasr_id
                ];

                $mr = MaterialRequestModel::updateOrCreate(['id' => $postID], $data);
                MaterialRequestProductsModel::where('mr_id', $postID)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'mr_id' => $postID,
                        'product_id' => $request->product_id[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    if ($request->request_against == 1) {
                        $upQty = $request->reqQty[$i] + $request->quantity[$i];
                        $this->updateBoq($request->product_id[$i], $upQty);
                    }
                    $materialRequestProducts = MaterialRequestProductsModel::Create($data);
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
                'msg' => ' Error While Update'
            );
            echo json_encode($out);
        }
    }

    public function materialRequestSend(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $createdBy = Auth::user()->id;
                $id = $request->id;
                $materialReq = MaterialRequestModel::find($id);
                if ($materialReq) {
                    $materialReq->mr_category;
                    $workflow =  MrWorkflowModel::select('mrworkflow.id', 'users.email', 'users.name')
                        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                        ->where('cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
                    $i = 0;
                    foreach ($workflow as $key => $value) {
                        $status = ($key == 0) ? 1 : 0;
                        $data = array(
                            'mrworkflow_id' => $value->id,
                            'epr_id' => $id,
                            'created_by' => $createdBy,
                            'status' => $status
                        );
                        $tData = EprApprovalTransactionModel::create($data);
                        if ($status == 1) {
                            $toMailId = $value->email;
                            $this->sendMail('epr', $id, $toMailId, $tData->id, $value->name, Carbon::now());
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
                            'msg' => 'Epr Sysnthesis Not Found Contact Admin !!',
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
                'msg' => ' Error While Send'
            );
            echo json_encode($out);
        }
    }
    public function materialRequestReSend(Request $request)
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
                if (($request->deleted_elements != '') && ($request->request_against == 1)) {
                    $this->trashedBoqUpdate($postID, $request->deleted_elements);
                }
                $data = array(
                    'version' => $request->version + 1,
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'user_id' => $useasr_id,
                    'status' => 5,
                );

                $mr = MaterialRequestModel::updateOrCreate(['id' => $postID], $data);
                MaterialRequestProductsModel::where('mr_id', $postID)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'mr_id' => $postID,
                        'product_id' => $request->product_id[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    if ($request->request_against == 1) {
                        $upQty = $request->reqQty[$i] + $request->quantity[$i];
                        $this->updateBoq($request->product_id[$i], $upQty);
                    }
                    $materialRequestProducts = MaterialRequestProductsModel::Create($data);
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
                'msg' => ' Error While Send'
            );
            echo json_encode($out);
        }
    }



    public function backupOldRequest($eprId)
    {
        $materialReq = MaterialRequestModel::find($eprId);
        $data = array(
            'version' => $materialReq->version,
            'quotedate' => $materialReq->quotedate,
            'dateofsupply' => $materialReq->dateofsupply,
            'request_type' => $materialReq->request_type,
            'mr_category' => $materialReq->mr_category,
            'request_priority' => $materialReq->request_priority,
            'request_against' => $materialReq->request_against,
            'client' => $materialReq->client,
            'project' => $materialReq->project,
            'internalreference' => $materialReq->internalreference,
            'notes' => $materialReq->notes,
            'terms' => $materialReq->terms,
            'user_id' => $materialReq->user_id
        );
        $postID = '';
        $inserted = MaterialRequestModelRevised::updateOrCreate(['id' => $postID], $data);
        $newMrId = $inserted->id;
        $products = MaterialRequestProductsModel::where('mr_id', $eprId)->get();
        foreach ($products as $key => $value) {
            $prData = array(
                'mr_id' => $newMrId,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'quantity' => $value->quantity,
                'branch' => $value->branch
            );
            DB::table('material_request_products_revised')->insert($prData);
        }
    }

    public function materialRequestTrash(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $data = array('status' => 0);
                $materialReq = MaterialRequestModel::find($id);
                $materialReq->update($data);
            });
            $out = array(
                'status' => 1,
                'msg' => 'Deleted Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Deleted'
            );
            echo json_encode($out);
        }
    }

    public function sendReq($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = MaterialRequestModel::find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  MrWorkflowModel::select('mrworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                ->where('cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'mrworkflow_id' => $value->id,
                    'epr_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = EprApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('epr', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            return 1;
        }
    }

    public function sendMail($docType = 'epr', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Electronic Purchase Request';
        $data['document'] = 'EPR';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\projects\LabelModel;
use App\projects\ProjectModel;
use App\projects\ProjectCategoryModel;
use App\projects\ProjectCategorySynthesisModel;
use App\projects\ProjectApprovalTransactionModel;
use App\crm\CustomerModel;
use DataTables;
use Carbon\Carbon;
use Auth;
use PDF;
use App\User;

use Illuminate\Support\Str;
use App\Mail\ActionRequired;
use Illuminate\Support\Facades\URL;
use Mail;
use Illuminate\Support\Facades\Crypt;
use App\settings\BranchSettingsModel;


class ProjectController extends Controller
{
    // 1=>  Draft;
    // 2=> Send
    // 3=>  Returned
    // 4=>  Rejected
    // 5=> Resubmited
    // 6=> Approved
    // 0=> Trashed

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectlist(Request $request) //draft
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $user = Auth::user();
            $query = DB::table('qprojects_projects')->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qprojects_projects.client')
                ->select('qprojects_projects.*', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"))
                ->orderby('qprojects_projects.id', 'desc')
                ->where('qprojects_projects.del_flag', 1)
                ->where('qprojects_projects.branch', $branch)
                ->whereIn('qprojects_projects.status',  [1, 3]);
            if (!$user->can('project view-all-projects'))
                $query->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $out = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">';
                if ($user->can('project edit-project'))
                    $out .= '<a href="projectupdate?id=' . $row->id . '" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-edit"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" >Edit</span>
                        </span></li></a>';

                $out .= '<a href="project-pdf?id=' . $row->id . '" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" >PDF</span>
                        </span></li></a>
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Synthesis Milestone </span>
                        </span></li></a>';
                if ($user->can('project send-project'))
                    $out .= '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item sendBtn" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Send</span>
                        </span></li></a>';

                if ($user->can('project delete-project'))
                    $out .= '<li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text delprojects" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span>
                        </li>';

                $out .= '</ul></div></div></span>';
                return $out;
            })->rawColumns(['action'])->make(true);
        } else
            return view('projects.projects.index');
    }

    public function projectlistSend(Request $request) //send
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = DB::table('qprojects_projects')->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qprojects_projects.client')
                ->select('qprojects_projects.*', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"))
                ->orderby('qprojects_projects.id', 'desc')
                ->where('qprojects_projects.del_flag', 1)
                ->where('qprojects_projects.branch', $branch)
                ->whereIn('qprojects_projects.status',  [2, 5]);
            if (!$user->can('project view-all-projects'))
                $query->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return null;
    }
    public function projectlistApproved(Request $request) //Approved
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $user = Auth::user();
            $query = DB::table('qprojects_projects')->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qprojects_projects.client')
                ->select('qprojects_projects.*', 'qprojects_projects.projectname', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"))
                ->orderby('qprojects_projects.id', 'desc')
                ->where('qprojects_projects.del_flag', 1)
                ->where('qprojects_projects.branch', $branch)
                ->where('qprojects_projects.status',  6);
            if (!$user->can('project view-all-projects'))
                $query->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return null;
    }

    public function projectlistRejected(Request $request) //rejected
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $user = Auth::user();
            $query = DB::table('qprojects_projects')->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qprojects_projects.client')
                ->select('qprojects_projects.*', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"))
                ->orderby('qprojects_projects.id', 'desc')
                ->where('qprojects_projects.del_flag', 1)
                ->where('qprojects_projects.branch', $branch)
                ->where('qprojects_projects.status',  4);
            if (!$user->can('project view-all-projects'))
                $query->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return null;
    }

    public function addprojects()
    {
        $labels = LabelModel::select('*')->where('del_flag', 1)->get();
        $salesorder = DB::table('qsales_salesorder')->select('id')->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $category = ProjectCategoryModel::select('id', 'name')->get();
        return view('projects.projects.add', compact('labels', 'customers', 'salesorder', 'category'));
    }

    public function projectsubmit(Request $request)
    {
        $branch = Session::get('branch');
        $user = Auth::user();
        $postID = $request->info_id;
        $data = [
            'client' => $request->client,
            'projectname' => $request->projectname,
            'description' => $request->description,
            'startdate' => Carbon::parse($request->startdate)->format('Y-m-d'),
            'enddate' => Carbon::parse($request->enddate)->format('Y-m-d'),
            'poject_category_id' => $request->poject_category_id,
            'ponumber' => $request->ponumber,
            'povalue' => $request->bidvalue,
            'podate' => Carbon::parse($request->podate)->format('Y-m-d'),
            'internal_ref' => $request->internal_ref,
            'notes' => $request->notes,
            'branch' => $branch
        ];
        if ($postID == '')
            $data['user_id'] = $user->id;
        $userInfo = ProjectModel::updateOrCreate(['id' => $postID], $data);
        $projectid = $userInfo->id;
        DB::table('qprojects_projects_labels')->where('id', $projectid)->delete();
        for ($i = 0; $i < count($request->labels); $i++) {
            $data1 = [
                'projectid' => $projectid,
                'labels' => (int)$request->labels[$i],

            ];
            DB::table('qprojects_projects_labels')->insert($data1);
        }

        return 'true';
    }

    public function projectupdate(Request $request)
    {
        $id = $request->id;
        $labels = LabelModel::select('*')->where('del_flag', 1)->get();
        $salesorder = DB::table('qsales_salesorder')->select('id')->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = DB::table('qprojects_projects')->select('qprojects_projects.*', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"))->where('del_flag', 1)->where('id', $id)->get();
        foreach ($projects as $projectsss) {
            $po = $projectsss->ponumber;
        }
        $ponum = DB::table('qsales_salesorder')->select('*')->where('del_flag', 1)->where('id', $po)->count();
        $projectlabels = DB::table('qprojects_projects_labels')->select('*')->where('projectid', $id)->get();
        $category = ProjectCategoryModel::select('id', 'name')->get();

        return view('projects.projects.edit', compact('labels', 'customers', 'salesorder', 'projects', 'ponum', 'projectlabels', 'category'));
    }

    public function projectSend(Request $request)
    {
        if ($request->ajax()) {
            $createdBy = Auth::user()->id;
            $id = $request->id;
            $mainData = ProjectModel::find($id);
            if ($mainData) {
                $workflow =  ProjectCategorySynthesisModel::select('project_category_synthesis.id', 'users.email', 'users.name')
                    ->leftjoin('users', 'project_category_synthesis.user_id', '=', 'users.id')
                    ->where('cat_id', '=', $mainData->poject_category_id)->orderBy('priority', 'asc')->get();
                $i = 0;
                foreach ($workflow as $key => $value) {
                    $status = ($key == 0) ? 1 : 0;
                    $data = array(
                        'project_category_synthesis_id' => $value->id,
                        'project_id' => $id,
                        'created_by' => $createdBy,
                        'status' => $status
                    );
                    $tData = ProjectApprovalTransactionModel::create($data);
                    if ($status == 1) {
                        $toMailId = $value->email;
                        $this->sendMail('PROJECT', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                    }

                    $i++;
                }
                if ($i != 0) {
                    $data = array('status' => 2);
                    $mainData->update($data);
                    $out = array(
                        'status' => 1,
                        'msg' => 'success',
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Sysnthesis Not Found Contact Admin !!',
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
        } else
            return NULL;
    }

    public function pdf(Request $request)
    {

        $id = $request->id;
        $branch = Session::get('branch');
        $projects = ProjectModel::select('qprojects_projects.id', 'qprojects_projects.status', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"), 'qprojects_projects.notes', 'qcrm_customer_details.cust_name as client', 'poject_category.name as poject_category', 'users.name as created_name', DB::raw("DATE_FORMAT(qprojects_projects.created_at, '%d-%m-%Y') as created_on"))
            ->leftjoin('qcrm_customer_details', 'qprojects_projects.client',  'qcrm_customer_details.id')
            ->leftjoin('poject_category', 'qprojects_projects.poject_category_id',  'poject_category.id')
            ->leftjoin('users', 'qprojects_projects.user_id', '=', 'users.id')
            ->where('qprojects_projects.id', $id)
            ->first();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        if (($projects->status != 1) || $projects->status != 0) {
            $approvalLevel = ProjectApprovalTransactionModel::select('project_approval_transaction.id', 'project_approval_transaction.updated_at', 'project_approval_transaction.status_changed_by', 'project_approval_transaction.comment', 'project_category_synthesis.if_accepted_note', 'project_category_synthesis.if_rejected_note', 'project_approval_transaction.status')
                ->leftjoin('qprojects_projects', 'project_approval_transaction.project_id', '=', 'qprojects_projects.id')
                ->leftjoin('project_category_synthesis', 'project_approval_transaction.project_category_synthesis_id', '=', 'project_category_synthesis.id')
                ->leftjoin('users', 'qprojects_projects.user_id', '=', 'users.id')
                ->where('project_approval_transaction.project_id', '=', $id)
                ->where('project_approval_transaction.status', '!=', 0)
                ->where('project_approval_transaction.status', '!=', 1)
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
                        'if_accepted_note' => $value->if_accepted_note,
                        'if_rejected_note' => $value->if_rejected_note,
                        'comments' => $value->comment,
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


        $projectId = 'PRJ ' . $projects->id . '_' . date('d-m-Y', strtotime($projects->startdate));
        $configuration = [];
        $pdf = PDF::loadView('projects.projects.preview', compact('projects', 'approvalLevel', 'branchsettings'), $configuration,  [
            'title'      => $projectId,
            'margin_top' => 0
        ]);

        return $pdf->stream($projectId . '.pdf');
    }

    public function sendMail($docType = 'PROJECT', $docId, $toMailId, $transactionId, $userName, $date)
    {
        DB::table('email_verify_keys')->where('doc_type', 'PROJECT')->where('doc_id', $docId)->delete();
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
        $data['document_name'] = 'Project';
        $data['document'] = 'PROJECT';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }


    public function managelabels(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $user = Auth::user();
            $query = LabelModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = LabelModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {

                $j = '';
                $k = 0;
                if ($user->can('project edit-label')) {
                    $j .= '<a href="#?id=' . $row->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-edit"></i>
                            <span class="kt-nav__link-text labelupdate" data-id="' . $row->id . '" >Edit</span>
                            </span></li></a>';
                    $k++;
                }
                if ($user->can('project delete-label')) {
                    $j .= '<li class="kt-nav__item">
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-trash"></i>
                            <span class="kt-nav__link-text dellabels" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span></li>';
                    $k++;
                }
                if ($k) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                             <i class="fa fa-cog"></i></a>
                             <div class="dropdown-menu dropdown-menu-right">
                             <ul class="kt-nav">' . $j . '</ul></div></div></span>';
                } else
                    return '';
            })->rawColumns(['action'])->make(true);
        }
        return view('projects.labels.index', compact('branch'));
    }
    public function labelsubmit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->title, 'title', 'qprojects_labels');
        } else {
            $check = $this->check_exists($request->title, 'title', 'qprojects_labels');
        }

        // $check = $this->check_exists($request->title,'title','qprojects_labels');
        if ($check < 1) {
            $data = [
                'title' => $request->title,
                'color' => $request->color, 'branch' => $branch
            ];
            $userInfo = LabelModel::updateOrCreate(['id' => $postID], $data);

            return 'true';
        } else {
            return 'false';
        }
    }
    public function getlabelupdate(Request $request)
    {
        $data['users'] = LabelModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function deletelabels(Request $request)
    {
        $delete = $request->id;

        LabelModel::where('id', $delete)->update(['del_flag' => 0]);
        return 'true';
    }
    public function getsalesorder(Request $request)
    {
        $id = $request->salesorder;
        $data = DB::table('qsales_salesorder')->select('id', 'quotedate1', 'grandtotalamount')->where('del_flag', 1)->where('id', $id)->get();
        // dd($data);


        return response()->json($data);
    }

    public function check_exists($value, $field, $table)
    {
        $branch = Session::get('branch');

        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
        return $query->count();
    }
    public function check_exists_edit($id, $value, $field, $table)
    {
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->whereNotIn('id', [$id])->get();
        // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
        return $query->count();
    }
    public function deleteprojects(Request $request)
    {
        $delete = $request->id;
        ProjectModel::where('id', $delete)->update(['del_flag' => 0]);
        return 'true';
    }


    public function awardedList(Request $request) //Approved
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = DB::table('qprojects_projects')->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qprojects_projects.client')
                ->select('qprojects_projects.*', 'qprojects_projects.projectname', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"))
                ->orderby('qprojects_projects.id', 'desc')
                ->where('qprojects_projects.del_flag', 1)
                ->where('qprojects_projects.branch', $branch)
                ->where('qprojects_projects.status',  6);
            if (!$user->can('project view-all-projects'))
                $query->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });

            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('projectname', function ($row) use ($user) {
                if ($user->can('project view-project-assets')) {
                    $url = URL::to('project-overview', Crypt::encryptString($row->id));
                    return '<a  href="' . $url . '" role="tab">' . $row->projectname . '</a>';
                } else
                    return $row->projectname;
            })->rawColumns(['action'])->make(true);
        } else
            return view('projects.projects.awarded');
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }
}

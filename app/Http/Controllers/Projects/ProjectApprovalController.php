<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\projects\ProjectModel;
use App\projects\ProjectApprovalTransactionModel;
use App\projects\ProjectCategorySynthesisModel;

use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class ProjectApprovalController extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user(); //current user Id
            $data = ProjectApprovalTransactionModel::select('project_approval_transaction.id', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"), 'qprojects_projects.ponumber', 'qprojects_projects.povalue', 'project_approval_transaction.status', 'project_approval_transaction.project_id')
                ->leftjoin('qprojects_projects', 'project_approval_transaction.project_id', '=', 'qprojects_projects.id')
                ->leftjoin('project_category_synthesis', 'project_approval_transaction.project_category_synthesis_id', '=', 'project_category_synthesis.id')
                ->leftJoin('qcrm_customer_details', 'qprojects_projects.client', 'qcrm_customer_details.id')
                ->leftjoin('users', 'qprojects_projects.user_id', '=', 'users.id')
                ->where('project_category_synthesis.user_id', '=', $currentUser->id)
                ->where('project_approval_transaction.status', '=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '<a href="project-pdf?id=' . $row->project_id . '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon-background"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id . '" >PDF</span>
                    </span></li></a>
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' . $row->project_id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->project_id . '" id=' . $row->project_id . '>Synthesis Milestone </span>
                        </span></li></a>';
                if (($row->status == 1) && ($currentUser->can('project approve-project'))) //approval pending
                    $j .= '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item approveBtn" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . ' > Approve </span>
                        </span></li></a>';
                if (($row->status == 1) && ($currentUser->can('project reject-project'))) //approval pending
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item rejectBtn" id=' . $row->id . ' >
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" >Reject</span>
                        </span></li></a>';

                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';


                // return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('projects.approval.list');
    }
    public function listApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = ProjectApprovalTransactionModel::select('project_approval_transaction.id', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"), 'qprojects_projects.ponumber', 'qprojects_projects.povalue', 'project_approval_transaction.status', 'project_approval_transaction.project_id')
                ->leftjoin('qprojects_projects', 'project_approval_transaction.project_id', '=', 'qprojects_projects.id')
                ->leftjoin('project_category_synthesis', 'project_approval_transaction.project_category_synthesis_id', '=', 'project_category_synthesis.id')
                ->leftJoin('qcrm_customer_details', 'qprojects_projects.client', 'qcrm_customer_details.id')
                ->leftjoin('users', 'qprojects_projects.user_id', '=', 'users.id')
                ->where('project_category_synthesis.user_id', '=', $currentUser)
                ->whereIn('project_approval_transaction.status',  [2, 3, 4, 5, 6])
                ->groupBy('qprojects_projects.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $j = '<a href="tender-pdf?id=' . $row->project_id . '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon-background"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->project_id . '" >PDF</span>
                    </span></li></a>
                    <a href="../suggestion-send?id=' . $row->project_id . '&type=TNDR" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>
                    <span class="kt-nav__link-text">Suggestion</span>
                    </span></li></a>
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' . $row->project_id . '>
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->project_id . '" id=' . $row->project_id . '>Synthesis Milestone </span>
                    </span></li></a>';
                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
            })->addColumn('heyrarchy', function ($row) use ($currentUser) {
                $data = ProjectApprovalTransactionModel::select('status')
                    ->orderBy('id', 'desc')
                    ->where('project_approval_transaction.status', '!=', 1)
                    ->where('project_approval_transaction.status', '!=', 0)
                    ->where('project_approval_transaction.project_id', $row->project_id)
                    ->where('project_approval_transaction.status_changed_by', $currentUser)
                    ->first();
                return $data->status;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function approve(Request $request)
    {
        $id = $request->id;
        $ifFind = ProjectApprovalTransactionModel::find($id);
        if ($ifFind) {
            $currentUser = Auth::user()->id;
            EmailVerifyKeysModel::where('doc_type', '=', 'PROJECT')->where('transaction_id', $id)->delete();
            $data = array('status' => 2, 'comment' => $request->comment, 'status_changed_by' => $currentUser);
            $ifFind->update($data);
            $this->updateNextApproval($ifFind);
        }
        return 1;
    }
    // public function resubmit(Request $request)
    // {
    //     $id = $request->id;
    //     $ifFind = ProjectApprovalTransactionModel::find($id);
    //     if ($ifFind) {
    //         $currentUser = Auth::user()->id;
    //         EmailVerifyKeysModel::where('doc_type', '=', 'PROJECT')->where('transaction_id', $id)->delete();
    //         $data = array('status' => 3, 'comment' => $request->comment, 'status_changed_by' => $currentUser);
    //         $ifFind->update($data);
    //         $this->deleteNextApproval($ifFind);
    //         $this->changeEprStatus($ifFind, 3); //change status to re sumbited
    //     }
    //     return 1;
    // }
    public function reject(Request $request)
    {
        $id = $request->id;
        $ifFind = ProjectApprovalTransactionModel::find($id);
        if ($ifFind) {
            $currentUser = Auth::user()->id;
            EmailVerifyKeysModel::where('doc_type', '=', 'PROJECT')->where('transaction_id', $id)->delete();
            $data = array('status' => 4, 'comment' => $request->comment, 'status_changed_by' => $currentUser);
            $ifFind->update($data);
            $this->changeEprStatus($ifFind, 4); //change status to re sumbited
        }
        return 1;
    }
    public function updateNextApproval($data)
    {
        $projectId = $data->project_id;
        $ifdata = ProjectApprovalTransactionModel::where('project_id', '=', $projectId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            ProjectApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = ProjectCategorySynthesisModel::select('project_category_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'project_category_synthesis.user_id', '=', 'users.id')
                ->where('project_category_synthesis.id', '=', $ifdata->project_category_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('PROJECT', $ifdata->project_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $tender = ProjectModel::find($projectId);
            if ($tender) {
                $dataStatus = array('status' => 6);
                $tender->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = ProjectApprovalTransactionModel::where('project_id', '=', $data->project_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $projectId = $eprAthority->project_id;
        $ifFind = ProjectModel::find($projectId);
        if ($ifFind) {
            $data = array('status' => $status);
            $ifFind->update($data);
        }
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


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $projectId = $request->id;
            $data = ProjectApprovalTransactionModel::select('project_approval_transaction.status', 'project_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(project_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('project_category_synthesis', 'project_approval_transaction.project_category_synthesis_id', '=', 'project_category_synthesis.id')
                ->leftjoin('users', 'project_category_synthesis.user_id', '=', 'users.id')
                ->where('project_approval_transaction.project_id', '=', $projectId)
                ->orderBy('project_approval_transaction.id', 'asc')
                ->get();
            $data = $data->map(function ($value, $key) {
                if ($value->status_changed_by != null)
                    $user = $this->getDescUser($value->status_changed_by);
                $outArray = array(
                    'status' => $value->status,
                    'name' => ($value->status_changed_by != null) ? $user->name : $value->name,
                    'status_changed' => $value->status_changed,
                );
                return $outArray;
            });
            $out = array(
                'status' => 1,
                'data' => $data
            );
            echo json_encode($out);
        } else
            return null;
    }
    public function getDescUser($id)
    {
        return User::find($id);
    }
}

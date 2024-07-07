<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\User;
use App\projects\LabelModel;
use App\projects\ProjectModel;
use App\projects\ProjectMilestoneModel;
use App\projects\ProjectNoteModel;
use App\projects\ProjectNoteLebalModel;
use App\projects\ProjectFileModel;
use App\projects\ProjectContractsModel;
use App\projects\TaskModel;
use App\projects\TaskStateModel;
use App\projects\ProjectCommentsModel;
use App\projects\ProjectSubCommentsModel;
use App\projects\ProjectCustomerFeedbackModel;
use App\projects\ProjectSubCustomerFeedbackModel;
use App\projects\ProjectStockAllocatedModel;
use App\projects\ProjectTimeSheetModel;
use App\projects\ProjectStockModel;
use App\ResourceManagement\EmployeesModel;
use App\ResourceManagement\ProjectMembersModel;
use App\procurement\StockTransferModel;
use DataTables;
use Carbon\Carbon;
use Auth;
use File;



use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;


class ProjectFunctionsController extends Controller
{

    public function overView(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('qprojects_projects.id', 'qprojects_projects.projectname', DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"), 'users.name as lead_name')
                ->leftjoin('users', 'qprojects_projects.project_leader', 'users.id')
                ->where('qprojects_projects.id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                $currentUser = Auth::user()->id;
                $employees = EmployeesModel::select('id', 'employee_name_field', 'employeeid')->get();
                $members = ProjectMembersModel::select('project_members.id as project_members_id', 'employees.id', 'employees.category', 'employees.employee_name_field', 'qcrm_department.name',  'employees.employeeid', 'employees.id', 'jobtitle')
                    ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                    ->leftjoin('qcrm_department', 'employees.department',  'qcrm_department.id')
                    ->where('project_members.project_id', Crypt::decryptString($id))
                    ->get();
                return view('projects.projectFunctions.overview', compact('project', 'projectId', 'employees', 'members'));
            } else
                return 'project Not Found';
        } else
            return null;
    }


    public function addMemeber(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $data =  array(
                        'project_id' => $request->project_id,
                        'member_id' => $request->new_member
                    );
                    $projectMembers = ProjectMembersModel::updateOrCreate(['id' => null], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }
    public function removeMemeber(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $projectMembers = ProjectMembersModel::find($request->id)->delete();
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function taskList(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                $state = TaskStateModel::select('id', 'name', 'style')->orderBy('data_order', 'asc')->get();
                $labels = LabelModel::select('*')->where('del_flag', 1)->get();
                $milestone = ProjectMilestoneModel::select('id', 'milestone_title')
                    ->where('project_id', Crypt::decryptString($id))
                    ->get();
                $members = ProjectMembersModel::select('employees.id', 'employees.employee_name_field')
                    ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                    ->where('project_members.project_id', Crypt::decryptString($id))
                    ->get();
                return view('projects.projectFunctions.taskList', compact('project', 'projectId', 'state', 'labels', 'milestone', 'members'));
            } else
                return 'project Not Found';
        } else
            return null;
    }

    public function taskListKanaban(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                $state = TaskStateModel::select('id', 'name', 'style')->orderBy('data_order', 'asc')->get();
                $taskStates = $state->map(function ($state) {
                    $out = array(
                        'id' => "_" . $state->id,
                        'title' => $state->name,
                        'class' => $state->style,
                        'item' => array(),
                        // 'dragTo' => [1, 2, 3, 4, 5],
                    );
                    return $out;
                });
                $labels = LabelModel::select('*')->where('del_flag', 1)->get();
                $milestone = ProjectMilestoneModel::select('id', 'milestone_title')
                    ->where('project_id', Crypt::decryptString($id))
                    ->get();
                $members = ProjectMembersModel::select('employees.id', 'employees.employee_name_field')
                    ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                    ->where('project_members.project_id', Crypt::decryptString($id))
                    ->get();
                return view('projects.projectFunctions.taskListKanaban', compact('project', 'projectId', 'taskStates', 'state', 'labels', 'milestone', 'members'));
            } else
                return 'project Not Found';
        } else
            return null;
    }

    public function taskListGantt(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                $initalSelect = array(
                    'key' => '',
                    'label' => '---Select---'
                );
                $state = TaskStateModel::select('id as key', 'name as label')->orderBy('data_order', 'asc')->get();
                $state->prepend($initalSelect);
                $labels = LabelModel::select('id as key', 'title as label')->where('del_flag', 1)->get();
                $labels->prepend($initalSelect);
                $milestone = ProjectMilestoneModel::select('id as key', 'milestone_title as label')
                    ->where('project_id', Crypt::decryptString($id))
                    ->get();
                $milestone->prepend($initalSelect);
                $members = ProjectMembersModel::select('employees.id as key', 'employees.employee_name_field as label')
                    ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                    ->where('project_members.project_id', Crypt::decryptString($id))
                    ->get();
                $members->prepend($initalSelect);
                return view('projects.projectFunctions.taskListGantt', compact('project', 'projectId', 'state', 'labels', 'milestone', 'members'));
            } else
                return 'project Not Found';
        } else
            return null;
    }

    public function milestones(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $data = ProjectMilestoneModel::select('id', 'milestone_description', 'milestone_title', DB::raw("DATE_FORMAT(project_milestones.milestone_due_date, '%d-%m-%Y') as milestone_due_date"))
                ->where('project_id', $request->project_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $k = 0;
                if ($user->can('project edit-project-milestone')) {
                    $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';
                    $k++;
                }

                if ($user->can('project delete-project-milestone')) {
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                    $k++;
                }
                if ($k)
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
                else
                    return '';
                //return $row->id;
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.milestones', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }

    public function projectMilestoneSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'milestone_title' => $request->milestone_title,
                        'milestone_description' => $request->milestone_description,
                        'milestone_due_date' => isset($request->milestone_due_date) ? Carbon::parse($request->milestone_due_date)->format('Y-m-d  h:i') : NULL,
                        'created_by' => $createdBy
                    );
                    $projectMilestone = ProjectMilestoneModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function getProjectMilestone(Request $request)
    {
        if ($request->ajax()) {
            $value = ProjectMilestoneModel::select('id', 'milestone_title', 'milestone_description', DB::raw("DATE_FORMAT(project_milestones.milestone_due_date, '%d-%m-%Y') as milestone_due_date"))
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function projectMilestoneDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    ProjectMilestoneModel::find($request->id)->delete();
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


    public function notes(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = ProjectNoteModel::select('id', 'note_description', 'note_title', DB::raw("DATE_FORMAT(project_notes.note_date, '%d-%m-%Y') as note_date"), 'public_flg')
                ->where('project_id', $request->project_id)
                ->where(function ($query) use ($currentUser) {
                    $query->orwhere('public_flg', 1)
                        ->orWhere('created_by', $currentUser->id);
                })
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '';
                $k = 0;
                if ($currentUser->can('project edit-project-note')) {
                    $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';
                    $k++;
                }
                if ($currentUser->can('project delete-project-note')) {
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                    $k++;
                }
                if ($k)
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
                else
                    return '';
            })->addColumn('lebals', function ($row) {
                $projectLebals = ProjectNoteLebalModel::select('qprojects_labels.title', 'qprojects_labels.color')
                    ->leftjoin('qprojects_labels', 'project_note_lebals.lebal_id', 'qprojects_labels.id')
                    ->where('project_note_lebals.project_note_id', $row->id)
                    ->get();
                $lebals = '';
                foreach ($projectLebals as $key => $value) {
                    $lebals .= '<div style="width:fit-content;display: inline; margin-left: 5px; border-radius: 17px;heigt:10px;background:#' . $value->color . '">' . $value->title . '</div>';
                }
                return  $lebals;
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.notes', compact('project', 'projectId', 'labels'));
            } else
                return 'project Not Found';
        }
    }

    public function projectNotesSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'note_title' => $request->note_title,
                        'note_description' => $request->note_description,
                        'note_date' => isset($request->note_date) ? Carbon::parse($request->note_date)->format('Y-m-d  h:i') : NULL,
                        'public_flg' => $request->public_flg,
                        'created_by' => $createdBy
                    );

                    $projectNote = ProjectNoteModel::updateOrCreate(['id' => $postID], $data);
                    ProjectNoteLebalModel::where('project_note_id', $projectNote->id)->delete();
                    $lblArray = array();
                    if (is_array($request->labels)) {
                        foreach ($request->labels as $key => $value) {
                            $tempArray = array(
                                'lebal_id' => $value,
                                'project_note_id' => $projectNote->id,
                                'created_at' => Carbon::now()
                            );
                            array_push($lblArray, $tempArray);
                        }
                        ProjectNoteLebalModel::insert($lblArray);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function getProjectNotes(Request $request)
    {
        if ($request->ajax()) {
            $value = ProjectNoteModel::select('id', 'note_title', 'note_description', DB::raw("DATE_FORMAT(note_date, '%d-%m-%Y') as note_date"), 'public_flg')
                ->where('id', $request->id)
                ->first();
            $lebals = ProjectNoteLebalModel::where('project_note_id', $request->id)->pluck('lebal_id');
            $out = array(
                'status' => 1,
                'data' => $value,
                'lebals' => $lebals
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function projectNotesDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    ProjectNoteModel::find($request->id)->delete();
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


    public function files(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = ProjectFileModel::select('project_files.id', 'project_files.project_id', 'project_files.description', 'project_files.file_path', 'file', DB::raw("DATE_FORMAT(project_files.uploded_date, '%d-%m-%Y') as uploded_date"), 'users.name')
                ->leftjoin('users', 'project_files.uploded_by', 'users.id')
                ->where('project_id', $request->project_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '';
                $k = 0;
                if ($currentUser->can('project edit-project-file')) {
                    $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';
                    $k++;
                }
                if ($currentUser->can('project delete-project-file')) {
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                    $k++;
                }
                if ($currentUser->can('project download-project-file')) {
                    $j .= '<a href="' . $row->file_path . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-arrow-down"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Download</span>
                </span></li></a>';
                    $k++;
                }

                if ($k) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
                } else
                    return '';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.files', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }

    public function projectFilesUpload(Request $request)
    {

        $uploded_by = Auth::user()->id;
        $project_id = $request->project_id;
        $path = public_path('project_files/' . $project_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {

                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $inArray = array(
                    'project_id' => $project_id,
                    'file' => $name,
                    'file_path' => $path,
                    'description' => $request->description,
                    'uploded_by' => $uploded_by,
                    'uploded_date' => Carbon::now(),
                );
                ProjectFileModel::Create($inArray);
            }
        }
        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function getProjectFileDetails(Request $request)
    {
        if ($request->ajax()) {
            $value = ProjectFileModel::select('id', 'description')
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value,
            );
            echo json_encode($out);
        } else
            return Null;
    }
    public function projectFileDetailsUpdate(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $postID = $request->id;
                    $data =  array(
                        'description' => $request->description,
                    );
                    $projectNote = ProjectFileModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function projectFileDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $if_found = ProjectFileModel::find($request->id);
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





    public function comments(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                $projectComments = ProjectCommentsModel::select('project_comments.id', 'project_comments.comment', 'project_comments.file_path', 'project_comments.project_id', 'project_comments.entry_date', 'users.name', 'users.image')
                    ->leftjoin('users', 'project_comments.created_by', 'users.id')
                    ->where('project_comments.project_id', Crypt::decryptString($id))
                    ->orderBy('project_comments.id', 'desc')
                    ->with(['sub_comments' => function ($q) {
                        // , 'project_sub_comments.sub_comment', 'project_sub_comments.sub_file_path', 'project_sub_comments.created_by', 'project_sub_comments.entry_date', 'users.name', 'users.image'
                        $q->select('project_sub_comments.*', 'users.*')
                            ->leftjoin('users', 'project_sub_comments.created_by', 'users.id')
                            ->orderBy('project_sub_comments.id', 'asc');
                    }])
                    ->get();
                // echo "<pre>";
                // print_r($projectComments);
                // echo "</pre>";
                // die();
                return view('projects.projectFunctions.comments', compact('project', 'projectId', 'projectComments'));
            } else
                return 'project Not Found';
        } else
            return null;
    }


    public function projectCommentFilesUpload(Request $request)
    {
        $uploded_by = Auth::user()->id;
        $project_id = $request->project_id;
        $path = public_path('project_comment_files/' . $project_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
            }
        }
        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function projectCommentSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {

                DB::transaction(function () use ($request) {
                    $created_by = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'comment' => $request->comment,
                        'file_path' => $request->projectCommentFileData,
                        'created_by' => $created_by,
                        'entry_date' => Carbon::now(),
                    );
                    $projectComments = ProjectCommentsModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function projectCommentDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $ifFound = ProjectCommentsModel::find($id);
                if ($ifFound) {
                    $ifFound->delete();
                    $out = array(
                        'status' => 1,
                        'msg' => 'Deleted Success'
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not Found'
                    );
                }
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


    public function projectSubCommentSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                $project_id = $request->project_id;
                $path = public_path('project_sub_comment_files/' . $project_id);
                File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

                if ($request->hasfile('replayFiles')) {
                    $file = $request->file('replayFiles');
                    $name = $file->getClientOriginalName();
                    $file->move($path, $name);
                } else
                    $name = '';
                DB::transaction(function () use ($request, $name) {
                    $created_by = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'comment_id' => $request->comment_id,
                        'sub_comment' => $request->sub_comment,
                        'sub_file_path' => $name,
                        'created_by' => $created_by,
                        'entry_date' => Carbon::now(),
                    );
                    $projectComments = ProjectSubCommentsModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function projectSubCommentDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $ifFound = ProjectSubCommentsModel::find($id);
                if ($ifFound) {
                    $ifFound->delete();
                    $out = array(
                        'status' => 1,
                        'msg' => 'Deleted Success'
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not Found'
                    );
                }
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
    // customer Feedback

    public function customerFeedback(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                $projectCustomerComments = ProjectCustomerFeedbackModel::select('project_customer_feedback.id', 'project_customer_feedback.comment', 'project_customer_feedback.file_path', 'project_customer_feedback.project_id', 'project_customer_feedback.entry_date', 'users.name', 'users.image')
                    ->leftjoin('users', 'project_customer_feedback.created_by', 'users.id')
                    ->where('project_customer_feedback.project_id', Crypt::decryptString($id))
                    ->orderBy('project_customer_feedback.id', 'desc')
                    ->with(['sub_comments' => function ($q) {
                        $q->select('project_sub_customer_feedback.*', 'users.*')
                            ->leftjoin('users', 'project_sub_customer_feedback.created_by', 'users.id')
                            ->orderBy('project_sub_customer_feedback.id', 'asc');
                    }])
                    ->get();
                return view('projects.projectFunctions.customerFeedback', compact('project', 'projectId', 'projectCustomerComments'));
            } else
                return 'project Not Found';
        } else
            return null;
    }


    public function projectCustomerFeedbackFilesUpload(Request $request)
    {
        $uploded_by = Auth::user()->id;
        $project_id = $request->project_id;
        $path = public_path('project_customer_feedback_files/' . $project_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
            }
        }
        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function projectCustomerFeedbackSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {

                DB::transaction(function () use ($request) {
                    $created_by = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'comment' => $request->comment,
                        'file_path' => $request->projectCommentFileData,
                        'created_by' => $created_by,
                        'entry_date' => Carbon::now(),
                    );
                    $projectComments = ProjectCustomerFeedbackModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function projectCustomerFeedbackDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $ifFound = ProjectCustomerFeedbackModel::find($id);
                if ($ifFound) {
                    $ifFound->delete();
                    $out = array(
                        'status' => 1,
                        'msg' => 'Deleted Success'
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not Found'
                    );
                }
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


    public function projectSubCustomerFeedbackSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                $project_id = $request->project_id;
                $path = public_path('project_sub_customer_feedback_files/' . $project_id);
                File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

                if ($request->hasfile('replayFiles')) {
                    $file = $request->file('replayFiles');
                    $name = $file->getClientOriginalName();
                    $file->move($path, $name);
                } else
                    $name = '';
                DB::transaction(function () use ($request, $name) {
                    $created_by = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'comment_id' => $request->comment_id,
                        'sub_comment' => $request->sub_comment,
                        'sub_file_path' => $name,
                        'created_by' => $created_by,
                        'entry_date' => Carbon::now(),
                    );
                    $projectComments = ProjectSubCustomerFeedbackModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function projectSubCustomerFeedbackDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $ifFound = ProjectSubCustomerFeedbackModel::find($id);
                if ($ifFound) {
                    $ifFound->delete();
                    $out = array(
                        'status' => 1,
                        'msg' => 'Deleted Success'
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not Found'
                    );
                }
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

    // ./customer Feedback


    public function materialRequest(Request $request, $id) //asigned materials
    {
        if ($request->ajax()) {
            // $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status', 'epr_stock_transfer.transfer_status')
            //     ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
            //     ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            //     ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
            //     ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            //     ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            //     ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            //     // ->where('epr_stock_transfer.status',  6)
            //     ->where('epr_stock_transfer.transfer_status', '!=',  2)
            //     // ->where('epr_stock_transfer.warehouse', '=', $warehouse)
            //     ->where('material_request.project', $request->project_id)
            //     ->get();
            // $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
            //     return $row->id;
            // })->rawColumns(['action', 'heyrarchy']);
            // return  $dtTble->make(true);

            $data =  StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer.status')

                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                // ->whereIn('epr_stock_transfer.status',  [1, 3])
                ->where('material_request.project', $request->project_id)
                ->where('epr_stock_transfer.source', 'From Direct Project')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $str = '--';
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.materialRequest', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }



    public function material(Request $request, $id) //asigned materials
    {
        if ($request->ajax()) {
            $query = ProjectStockModel::select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.description as description', 'project_stocks.quantity')
                ->leftJoin('qinventory_products', 'project_stocks.product_id', 'qinventory_products.product_id')
                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', 'qinventory_product_unit.id')
                ->where('project_stocks.project_id', $request->project_id);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.material', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }

    public function materialAlocated(Request $request, $id) //alocated materials
    {
        if ($request->ajax()) {
            $query = ProjectStockAllocatedModel::select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.description as description', 'project_stocks_allocated.quantity')
                ->leftJoin('qinventory_products', 'project_stocks_allocated.product_id', 'qinventory_products.product_id')
                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', 'qinventory_product_unit.id')
                ->where('project_stocks_allocated.project_id', $request->project_id);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.materialAlocated', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }


    public function invoices(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.invoices', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }

    public function payments(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.payments', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }

    public function expences(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.expences', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }

    public function contracts(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $data = ProjectContractsModel::select('project_contracts.id', 'project_contracts.project_id', 'project_contracts.description', 'project_contracts.file_path', 'file', DB::raw("DATE_FORMAT(project_contracts.uploded_date, '%d-%m-%Y') as uploded_date"), 'users.name')
                ->leftjoin('users', 'project_contracts.uploded_by', 'users.id')
                ->where('project_id', $request->project_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $k = 0;
                if ($user->can('project edit-project-contracts')) {
                    $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';
                    $k++;
                }
                if ($user->can('project delete-project-contracts')) {
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                    $k++;
                }
                if ($user->can('project download-project-contracts')) {
                    $j .= '<a href="' . $row->file_path . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-arrow-down"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Download</span>
                </span></li></a>';
                    $k++;
                }
                if ($k) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
                } else
                    return '';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.contracts', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }



    public function projectContractsUpload(Request $request)
    {

        $uploded_by = Auth::user()->id;
        $project_id = $request->project_id;
        $path = public_path('project_contracts/' . $project_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {

                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $inArray = array(
                    'project_id' => $project_id,
                    'file' => $name,
                    'file_path' => $path,
                    'description' => $request->description,
                    'uploded_by' => $uploded_by,
                    'uploded_date' => Carbon::now(),
                );
                ProjectContractsModel::Create($inArray);
            }
        }
        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function getProjectContractDetails(Request $request)
    {
        if ($request->ajax()) {
            $value = ProjectContractsModel::select('id', 'description')
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value,
            );
            echo json_encode($out);
        } else
            return Null;
    }
    public function projectContractDetailsUpdate(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $postID = $request->id;
                    $data =  array(
                        'description' => $request->description,
                    );
                    $projectContract = ProjectContractsModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }

    public function projectContractDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $if_found = ProjectContractsModel::find($request->id);
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


    public function costCentre(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = ProjectStockAllocatedModel::select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.description as description', 'project_stocks_allocated.quantity', 'project_stocks_allocated.rate')
                ->leftJoin('qinventory_products', 'project_stocks_allocated.product_id', 'qinventory_products.product_id')
                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', 'qinventory_product_unit.id')
                ->where('project_stocks_allocated.project_id', $request->project_id);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('amount', function ($row) {
                $amount = $row->quantity * $row->rate;
                return  number_format((float)$amount, 2, '.', '');
            })->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.costCenter', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        }
    }

    public function costCentreManPower(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = ProjectTimeSheetModel::select('project_time_sheets.id', 'project_time_sheets.from', 'project_time_sheets.to', 'project_time_sheets.description', 'tasks.title', 'employees.employee_name_field', 'employees.overhead')
                ->leftJoin('tasks', 'project_time_sheets.task', 'tasks.id')
                ->leftjoin('employees', 'project_time_sheets.employee',  'employees.id')
                ->where('project_time_sheets.project_id', $request->project_id);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('hr_worked', function ($row) {
                $finishTime = new Carbon($row->to);
                $startTime = new Carbon($row->from);
                $totalDuration = $finishTime->diffInSeconds($startTime);
                $inH_i = gmdate('H:i:s', $totalDuration);
                return $inH_i;
            })->addColumn('amount', function ($row) {
                $finishTime = new Carbon($row->to);
                $startTime = new Carbon($row->from);
                $totalDuration = $finishTime->diffInSeconds($startTime);
                $oneSecondOverHead = $row->overhead / 3600;
                $amount = $totalDuration * $oneSecondOverHead;
                return $amount;
            })->make(true);
        } else
            return null;
    }


    public function timeSheet(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $query = ProjectTimeSheetModel::select('project_time_sheets.id', 'project_time_sheets.from', 'project_time_sheets.to', 'project_time_sheets.description', 'tasks.title', 'employees.employee_name_field')
                ->leftJoin('tasks', 'project_time_sheets.task', 'tasks.id')
                ->leftjoin('employees', 'project_time_sheets.employee',  'employees.id')
                ->where('project_time_sheets.project_id', $request->project_id);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('hr_worked', function ($row) {
                $finishTime = new Carbon($row->to);
                $startTime = new Carbon($row->from);
                $totalDuration = $finishTime->diffInSeconds($startTime);
                $inH_i = gmdate('H:i:s', $totalDuration);
                return $inH_i;
            })->addColumn('from', function ($row) {
                $from = isset($row->from) ? Carbon::parse($row->from)->format('d-m-Y  H:i:s') : NULL;
                return $from;
            })->addColumn('to', function ($row) {
                $to = isset($row->to) ? Carbon::parse($row->to)->format('d-m-Y  H:i:s') : NULL;
                return $to;
            })->addColumn('action', function ($row) use ($user) {
                $j = '';
                $k = 0;
                if ($user->can('project edit-project-time-sheet')) {
                    $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-edit-1"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                            </span></li></a>';
                    $k++;
                }
                if ($user->can('project delete-project-time-sheet')) {
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-delete"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                            </span></li></a>';
                    $k++;
                }
                if ($k) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                    <i class="fa fa-cog"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">' . $j . '
                                </ul></div></div></span>';
                } else
                    return '';
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            $members = ProjectMembersModel::select('project_members.id as project_members_id', 'employees.id', 'employees.category', 'employees.employee_name_field', 'qcrm_department.name',  'employees.employeeid', 'employees.id', 'jobtitle')
                ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                ->leftjoin('qcrm_department', 'employees.department',  'qcrm_department.id')
                ->where('project_members.project_id', Crypt::decryptString($id))
                ->get();
            $tasks = TaskModel::select('tasks.id', 'tasks.title')->where('tasks.project_id', Crypt::decryptString($id))->get();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.timeSheet', compact('project', 'projectId', 'members', 'tasks'));
            } else
                return 'project Not Found';
        }
    }

    public function getTimeSheet(Request $request)
    {
        if ($request->ajax()) {
            $dataTemp = ProjectTimeSheetModel::select('id', 'project_id', 'task', 'employee', 'description', 'from', 'to')
                ->where('id', $request->id)
                ->first();
            if (isset($dataTemp->id)) {
                $data = array(
                    'id' => $dataTemp->id,
                    'project_id' => $dataTemp->project_id,
                    'task' => $dataTemp->task,
                    'employee' => $dataTemp->employee,
                    'description' => $dataTemp->description,
                    'from' => isset($dataTemp->from) ? Carbon::parse($dataTemp->from)->format('d-m-Y  H:i:s') : NULL,
                    'to' => isset($dataTemp->to) ? Carbon::parse($dataTemp->to)->format('d-m-Y  H:i:s') : NULL,
                );
                $out = array(
                    'status' => 1,
                    'data' => $data,
                );
            } else
                $out = array(
                    'status' => 0,
                    'msg' => 'data Not found',
                );
            echo json_encode($out);
        } else
            return null;
    }

    public function deleteTimeSheet(Request $request)
    {
        if ($request->ajax()) {
            $data = ProjectTimeSheetModel::find($request->id);
            if ($data) {
                $data->delete();
                $out = array(
                    'status' => 1,
                    'msg' => 'deleted Successfully'
                );
            } else
                $out = array(
                    'status' => 0,
                    'msg' => 'data Not found',
                );
            echo json_encode($out);
        } else
            return null;
    }



    public function timeSheetSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'project_id' => $request->project_id,
                        'task' => $request->task,
                        'employee' => $request->employee,
                        'from' => isset($request->from) ? Carbon::parse($request->from)->format('Y-m-d  H:i:s') : NULL,
                        'to' => isset($request->to) ? Carbon::parse($request->to)->format('Y-m-d  H:i:s') : NULL,
                        'description' => $request->description,
                        'created_by' => $createdBy
                    );
                    $projectTimeSheet = ProjectTimeSheetModel::updateOrCreate(['id' => $postID], $data);
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
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }
    public function debitNote(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.debitNote', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }
    public function creditNote(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.creditNote', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }
    public function adwance(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.adwance', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }
    public function receipt(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.receipt', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }
    public function progressiveReport(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.progressiveReport', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }
    public function completionReport(Request $request, $id)
    {
        if (!$request->ajax()) {
            $projectId = $id;
            $project = ProjectModel::select('id', 'projectname')->where('id', Crypt::decryptString($id))->first();
            if (isset($project->projectname)) {
                return view('projects.projectFunctions.completionReport', compact('project', 'projectId'));
            } else
                return 'project Not Found';
        } else
            return null;
    }
}

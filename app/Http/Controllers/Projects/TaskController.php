<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Session;
use Carbon\Carbon;
use Auth;
use App\projects\LabelModel;
use App\projects\TaskStateModel;
use App\projects\TaskModel;
use App\projects\ProjectModel;
use App\projects\TaskStateChangeTransactionModel;
use App\projects\ProjectMilestoneModel;
use App\ResourceManagement\ProjectMembersModel;
use App\projects\TaskLabelModel;

class TaskController extends Controller
{

    public function list(Request $request) //draft
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = TaskModel::select('tasks.id', 'tasks.title', 'tasks.description', 'qprojects_projects.projectname as project', 'tasks.points', 'project_milestones.milestone_title as milestone', 'employees.employee_name_field as assign_to',  'task_state.name as state_name', 'tasks.priority', DB::raw("DATE_FORMAT(tasks.start_date, '%d-%m-%Y') as start_date"), DB::raw("DATE_FORMAT(tasks.deadline, '%d-%m-%Y') as deadline"), 'tasks.created_by')
                ->leftjoin('qprojects_projects', 'tasks.project_id',  'qprojects_projects.id')
                ->leftjoin('project_milestones', 'tasks.milestone',  'project_milestones.id')
                ->leftjoin('employees', 'tasks.assign_to',  'employees.id')
                ->leftjoin('task_state', 'tasks.state_id',  'task_state.id');
            if ($request->project_id != '')
                $query->where('tasks.project_id', $request->project_id);

            if (!$user->can('project view-all-projects'))
                $query->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });

            $data = $query->get();
            // $data = array();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $k = 0;
                if ($user->can('project edit-task')) {
                    $j = ' <li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-edit"></i>
                <span class="kt-nav__link-text viewTask " id=' . $row->id . ' data-id=' . $row->id . '>Edit</span></span></li>';
                    $k++;
                }
                if ($user->can('project delete-task')) {
                    $j .= '<li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-trash"></i>
                <span class="kt-nav__link-text taskDelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span></li>';
                    $k++;
                }

                return '<span style="overflow: visible; position: relative; width: 80px;">
                          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '</ul></div></div></span>';

                // return $row->id;
            })->addColumn('collaborators', function ($row) {
                return 'ccccc';
            })->rawColumns(['action'])->make(true);
        } else {
            $user = Auth::user();
            $projectQry = ProjectModel::select('id', 'projectname');
            if (!$user->can('project view-all-projects'))
                $projectQry->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $project = $projectQry->get();
            $state = TaskStateModel::select('id', 'name')->get();
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();
            return view('projects.task.list', compact('project', 'labels', 'state'));
        }
    }
    public function  submit(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'title' => $request->title,
                        'description' => $request->description,
                        'project_id' => $request->project_id,
                        'points' => $request->points,
                        'milestone' => $request->milestone,
                        'assign_to' => $request->assign_to,
                        'state_id' => $request->state_id,
                        'priority' => $request->priority,
                        'start_date' =>  isset($request->start_date) ? Carbon::parse($request->start_date)->format('Y-m-d  h:i') : NULL,
                        'deadline' =>  isset($request->deadline) ? Carbon::parse($request->deadline)->format('Y-m-d  h:i') : NULL,
                        'created_by' => $createdBy
                    );
                    $task = TaskModel::updateOrCreate(['id' => $postID], $data);
                    $taskId = $task->id;
                    TaskLabelModel::where('taskid', $taskId)->delete();
                    if (is_array($request->labels)) {
                        $dataArray = array();
                        foreach ($request->labels as $key => $value) {
                            $dataSub = array(
                                'taskid' => $taskId,
                                'labels' => $value
                            );
                            array_push($dataArray, $dataSub);
                        }
                        TaskLabelModel::insert($dataArray);
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
    public function view(Request $request)
    {
        if ($request->ajax()) {
            $data = TaskModel::select('tasks.*', DB::raw("DATE_FORMAT(tasks.start_date, '%d-%m-%Y') as start_date"), DB::raw("DATE_FORMAT(tasks.deadline, '%d-%m-%Y') as deadline"))
                ->where('id', $request->id)
                ->first();
            if ($data->id) {
                $milestone = ProjectMilestoneModel::select('id', 'milestone_title')
                    ->where('project_id', $data->project_id)
                    ->get();
                $members = ProjectMembersModel::select('employees.id', 'employees.employee_name_field')
                    ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                    ->where('project_members.project_id', $data->project_id)
                    ->get();
                $labels =  TaskLabelModel::where('taskid', $request->id)->pluck('labels');
            }
            $out = array(
                'status' => 1,
                'data' => $data,
                'milestone' => $milestone,
                'members' => $members,
                'labels' => $labels
            );
            echo json_encode($out);
        } else
            return Null;
    }
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ifFound = TaskModel::find($request->id);
            if ($ifFound) {
                $ifFound->delete();
                $out = array(
                    'status' => 1,
                    'msg' => 'success'
                );
            } else
                $out = array(
                    'status' => 0,
                    'msg' => 'Data not Found'
                );
            echo json_encode($out);
        } else
            return Null;
    }

    public function getProjectMilestoneAndMembers(Request $request)
    {
        if ($request->ajax()) {
            $milestone = ProjectMilestoneModel::select('id', 'milestone_title')
                ->where('project_id', $request->id)
                ->get();
            $members = ProjectMembersModel::select('employees.id', 'employees.employee_name_field')
                ->leftjoin('employees', 'project_members.member_id',  'employees.id')
                ->where('project_members.project_id', $request->id)
                ->get();
            $out = array(
                'status' => 1,
                'milestone' => $milestone,
                'members' => $members
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function listKanaban(Request $request)
    {
        if ($request->ajax()) {
            $data = TaskModel::select('tasks.id', 'tasks.title',  'tasks.state_id')
                ->leftjoin('qprojects_projects', 'tasks.project_id',  'qprojects_projects.id')
                ->where('tasks.project_id', $request->project_id)
                ->get();
            $out = array(
                'status' => 1,
                'data' => $data
            );
            echo json_encode($out);
        } else {
            $projectQry = ProjectModel::select('id', 'projectname');
            $user = Auth::user();
            if (!$user->can('project view-all-projects'))
                $projectQry->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $project = $projectQry->get();
            $state = TaskStateModel::select('id', 'name', 'style')->orderBy('data_order', 'asc')->get();
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();

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

            return view('projects.task.taskKanbanBoard', compact('project', 'state', 'labels', 'taskStates'));
        }
    }


    public function listGantt(Request $request)
    {
        if ($request->ajax()) {
            return null;
        } else {
            $projectQry = ProjectModel::select('id', 'projectname');
            $user = Auth::user();
            if (!$user->can('project view-all-projects'))
                $projectQry->where(function ($query) use ($user) {
                    $query->orWhere('qprojects_projects.project_leader', $user->id);
                    $query->orWhere('qprojects_projects.user_id', $user->id);
                });
            $project = $projectQry->get();
            $state = TaskStateModel::select('id', 'name', 'style')->orderBy('data_order', 'asc')->get();
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();

            // $taskStates = $state->map(function ($state) {
            //     $out = array(
            //         "id" => -1,
            //         "name" => "Gantt editor",
            //         "progress" => 0,
            //         "progressByWorklog" => false,
            //         "relevance" => 0,
            //         "type" => "",
            //         "typeId" => "",
            //         "description" => "",
            //         "code" => "",
            //         "level" => 0,
            //         "status" => "STATUS_ACTIVE",
            //         "depends" => "",
            //         "canWrite" => true,
            //         "start" => 1396994400000,
            //         "duration" => 20,
            //         "end" => 1399586399999,
            //         "startIsMilestone" => false,
            //         "endIsMilestone" => false,
            //         "collapsed" => false,
            //         "assigs" => [],
            //         "hasChild" => true
            //     );
            //     return $out;
            // });


            $taskStates = array(
                "tasks" => array(
                    array(
                        "id" => -1,
                        "name" => "Gantt editor",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 0,
                        "status" => "STATUS_ACTIVE",
                        // "depends" => "",
                        // "canWrite" => true,
                        "start" => 1396994400000,
                        "duration" => 20,
                        "end" => 1399586399999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => true
                    ),
                    array(
                        "id" => -2,
                        "name" => "coding",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 1,
                        "status" => "STATUS_ACTIVE",
                        // "depends" => "",
                        // "canWrite" => true,
                        "start" => 1396994400000,
                        "duration" => 10,
                        "end" => 1398203999999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => true
                    ),
                    array(
                        "id" => -3,
                        "name" => "gantt part",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 2,
                        "status" => "STATUS_ACTIVE",
                        // "depends" => "",
                        // "canWrite" => true,
                        "start" => 1396994400000,
                        "duration" => 2,
                        "end" => 1397167199999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => false
                    ),
                    array(
                        "id" => -4,
                        "name" => "editor part",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 2,
                        "status" => "STATUS_SUSPENDED",
                        // "depends" => "3",
                        // "canWrite" => true,
                        "start" => 1397167200000,
                        "duration" => 4,
                        "end" => 1397685599999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => false
                    ),
                    array(
                        "id" => -5,
                        "name" => "testing",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 1,
                        "status" => "STATUS_SUSPENDED",
                        // "depends" => "2:5",
                        // "canWrite" => true,
                        "start" => 1398981600000,
                        "duration" => 5,
                        "end" => 1399586399999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => true
                    ),

                    array(
                        "id" => -6,
                        "name" => "test on safari",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 2,
                        "status" => "STATUS_SUSPENDED",
                        // "depends" => "",
                        // "canWrite" => true,
                        "start" => 1398981600000,
                        "duration" => 2,
                        "end" => 1399327199999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => false
                    ),
                    array(
                        "id" => -7,
                        "name" => "test on ie",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 2,
                        "status" => "STATUS_SUSPENDED",
                        // "depends" => "6",
                        // "canWrite" => true,
                        "start" => 1399327200000,
                        "duration" => 3,
                        "end" => 1399586399999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => false
                    ),

                    array(
                        "id" => -8,
                        "name" => "test on chrome",
                        // "progress" => 0,
                        // "progressByWorklog" => false,
                        // "relevance" => 0,
                        // "type" => "",
                        // "typeId" => "",
                        // "description" => "",
                        // "code" => "",
                        // "level" => 2,
                        "status" => "STATUS_SUSPENDED",
                        // "depends" => "6",
                        // "canWrite" => true,
                        "start" => 1399327200000,
                        "duration" => 2,
                        "end" => 1399499999999,
                        "startIsMilestone" => false,
                        "endIsMilestone" => false,
                        "collapsed" => false,
                        "assigs" => [],
                        "hasChild" => false
                    )

                ),
                "selectedRow" => 2,
                "deletedTaskIds" => array(),
                "resources" => array(
                    array(
                        "id" => "tmp_1",
                        "name" => "Resource 1"
                    ),

                    array(
                        "id" => "tmp_2",
                        "name" => "Resource 2"
                    ),

                    array(
                        "id" => "tmp_3",
                        "name" => "Resource 3"
                    ),

                    array(
                        "id" => "tmp_4",
                        "name" => "Resource 4"
                    )
                ),
                "roles" => array(
                    array(
                        array(
                            "id" => "tmp_1",
                            "name" => "Project Manager"
                        ),
                        array(
                            "id" => "tmp_2",
                            "name" => "Worker"
                        ),
                        array(
                            "id" => "tmp_3",
                            "name" => "Stakeholder"
                        ),
                        array(
                            "id" => "tmp_4",
                            "name" => "Customer"
                        )
                    )
                ),
                "canWrite" => false,
                "canDelete" => true,
                "canWriteOnParent" => false,
                "canAdd" => false
            );



            return view('projects.task.taskGantt', compact('project', 'state', 'labels', 'taskStates'));
        }
    }

    public function loadTaskState(Request $request)
    {
        if ($request->ajax()) {
            $state = TaskStateModel::select('id', 'name', 'style')->orderBy('data_order', 'asc')->get();
            $taskStates = $state->map(function ($state) {
                $out = array(
                    'id' => $state->id,
                    'title' => $state->name,
                    'class' => $state->style,
                    'item' => array(),
                    // 'dragTo' => ['*'],
                );
                return $out;
            });
            echo json_encode($taskStates);
        } else
            return null;
    }

    public function taskSateChange(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = Auth::user();
                if ($user->can('project edit-task')) {
                    DB::transaction(function () use ($request) {
                        $userId = Auth::user()->id;
                        $data = array('state_id' => str_replace('_', '', $request->state_id_to));
                        TaskModel::updateOrCreate(['id' => $request->task_id], $data);
                        $dataTransaction = array(
                            'task_id' => $request->task_id,
                            'state_id_from' => str_replace('_', '', $request->state_id_from),
                            'state_id_to' => str_replace('_', '', $request->state_id_to),
                            'changed_by' => $userId
                        );
                        TaskStateChangeTransactionModel::updateOrCreate(['id' => null], $dataTransaction);
                    });
                    $out = array(
                        'status' => 1,
                        'msg' => 'Saved Success'
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'No permission To change task state'
                    );
                }
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
}

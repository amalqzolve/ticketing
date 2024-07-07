<?php

namespace App\Http\Controllers\Projects\gantt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\projects\TaskModel;
use App\projects\TaskLabelModel;
use Carbon\Carbon;
use Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $createdBy = Auth::user()->id;
                $postID = null;
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
                // TaskLabelModel::where('taskid', $taskId)->delete();
                // if (is_array($request->labels)) {
                //     $dataArray = array();
                //     foreach ($request->labels as $key => $value) {
                //         $dataSub = array(
                //             'taskid' => $taskId,
                //             'labels' => $value
                //         );
                //         array_push($dataArray, $dataSub);
                //     }
                //     TaskLabelModel::insert($dataArray);
                // }
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
    }

    public function update($id, Request $request)
    {
        try {
            DB::transaction(function () use ($request, $id) {
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
                );
                $task = TaskModel::updateOrCreate(['id' => $id], $data);
                $taskId = $task->id;
                // TaskLabelModel::where('taskid', $taskId)->delete();
                // if (is_array($request->labels)) {
                //     $dataArray = array();
                //     foreach ($request->labels as $key => $value) {
                //         $dataSub = array(
                //             'taskid' => $taskId,
                //             'labels' => $value
                //         );
                //         array_push($dataArray, $dataSub);
                //     }
                //     TaskLabelModel::insert($dataArray);
                // }
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

        return response()->json([
            "action" => "updated"
        ]);
    }

    public function destroy($id)
    {
        $task = TaskModel::find($id);
        $task->delete();

        return response()->json([
            "action" => "deleted"
        ]);
    }
}

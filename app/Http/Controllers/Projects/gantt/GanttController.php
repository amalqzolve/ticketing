<?php

namespace App\Http\Controllers\Projects\gantt;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
// use App\Task;
// use App\Link;
use App\projects\TaskModel;

class GanttController extends Controller
{
    public function get(Request $request, $id)
    {
        $data = TaskModel::select('tasks.id', 'tasks.title', 'tasks.start_date', 'tasks.deadline', 'tasks.description', 'tasks.points', 'tasks.milestone', 'tasks.assign_to', 'tasks.state_id', 'tasks.priority')
            ->leftjoin('qprojects_projects', 'tasks.project_id',  'qprojects_projects.id')
            // ->where('tasks.project_id', $id)
            ->get();
        $task = $data->map(function ($state) {

            $date = Carbon::parse($state->start_date);
            $now = Carbon::parse($state->deadline);

            $diff = $date->diffInDays($now);
            $out = array(
                'id' => $state->id,
                'text' => $state->title,
                'start_date' => $state->start_date,
                'duration' => $diff,
                'progress' => 0.0,
                'open' => false,
                'description' => 'ddddddddddddddddd',
                'points' => 'pppppppp',
                'milestone' => 1,
                'assign_to' => 1,
                'status' => 1,
                'priority' => 1,
                'labels' => 1,
                // "parent" => 0,
                // "open" => true
            );
            return $out;
        });
        return response()->json([
            "data" => $task,
            "links" => []
        ]);
    }
}

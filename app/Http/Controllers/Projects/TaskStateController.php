<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\projects\TaskStateModel;
use Session;

class TaskStateController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $branch = Session::get('branch');
            $query = TaskStateModel::select('*');
            $query->where('branch', $branch);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                if ($user->can('project edit-task-state')) {
                    $j = '<a href="task-state-edit?id=' . $row->id  . '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-edit"></i>
                      <span class="kt-nav__link-text" data-id="' . $row->id  . '" >Edit</span>
                      </span></li></a>
                      <li class="kt-nav__item">';
                }
                if ($user->can('project delete-task-state')) {
                    $j .= '<span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-trash"></i>
                      <span class="kt-nav__link-text mrCatdelete" id=' . $row->id  . ' data-id=' . $row->id  . '>Delete</span></span></li>';
                }
                return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '</ul></div></div></span>';
            })->rawColumns(['action'])->make(true);
        }
        return view('projects.taskState.listing');
    }
    public function add(Request $request)
    {
        return view('projects.taskState.add');
    }
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $branch = Session::get('branch');
            $query = TaskStateModel::orderby('id', 'desc');
            $query->where('branch', $branch);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('projects.taskState.trashlisting');
    }
    public function submit(Request $request)
    {
        $postID = $request->info_id;
        $branch = Session::get('branch');
        $data = [
            'name' => $request->name,
            'decription' => $request->decription,
            'data_order' => $request->data_order,
            'style' => $request->style,
            'branch' => $branch
        ];

        $TaskState = TaskStateModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $data = TaskStateModel::where('id', $id)->get();
        return view('projects.taskState.edit', compact('data', 'branch'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = TaskStateModel::find($request->id);
        if (1) {
            TaskStateModel::where('id', $id)->delete();
            $data = array(
                'status' => 1,
                'msg' => "Your Entry has been deleted",
            );
        } else {
            $data = array(
                'status' => 0,
                'msg' => "Already Used Can't Delete!! ",
            );
        }
        echo json_encode($data);
    }
    public function restore(Request $request)
    {
        $id = $request->id;
        TaskStateModel::where('id', $id)->update(['deleted_at' => NULL]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        TaskStateModel::where('id', $id)->forceDelete();
        return 'true';
    }
}

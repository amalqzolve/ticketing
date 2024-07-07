<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\projects\ProjectCategoryModel;
use Session;
use Auth;

class ProjectCategoryController extends Controller
{
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = ProjectCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $k = 0;
                if ($user->can('project edit-project-category')) {
                    $j .= '<a href="sales-proposal-category-edit?id=' . $row->id . '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-edit"></i>
                      <span class="kt-nav__link-text" data-id="' . $row->id . '" >Edit</span>
                      </span></li></a>';
                    $k++;
                }
                if ($user->can('project delete-project-category')) {
                    $j .= '<li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-trash"></i>
                      <span class="kt-nav__link-text mrCatdelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span></li>';
                    $k++;
                }
                if ($k)
                    return '<span style="overflow: visible; position: relative; width: 80px;">
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                      <i class="fa fa-cog"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                      <ul class="kt-nav">' . $j . '</ul></div></div></span>';
                else
                    return '';
            })->rawColumns(['action'])->make(true);
        }
        return view('projects.projectCategory.listing');
    }
    public function add(Request $request)
    {
        return view('projects.projectCategory.add');
    }
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $query = ProjectCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('projects.projectCategory.trashlisting');
    }
    public function submit(Request $request)
    {
        $postID = $request->info_id;
        $branch = Session::get('branch');
        $data = [
            'name' => $request->name,
            'decription' => $request->decription,
            'branch' => $branch
        ];

        $purchase = ProjectCategoryModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $data = ProjectCategoryModel::where('id', $id)->get();
        return view('projects.projectCategory.edit', compact('data', 'branch'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = ProjectCategoryModel::find($request->id);
        if ($MaterialCategory->flow_created == 0) {
            ProjectCategoryModel::where('id', $id)->update(['del_flag' => 0]);
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
        ProjectCategoryModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        ProjectCategoryModel::where('id', $id)->delete();
        return 'true';
    }
}

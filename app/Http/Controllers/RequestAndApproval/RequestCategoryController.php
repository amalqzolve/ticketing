<?php

namespace App\Http\Controllers\RequestAndApproval;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RequestAndApproval\RequestCategoryModel;
use DataTables;
use DB;
use Session;


class RequestCategoryController extends Controller
{
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = RequestCategoryModel::orderby('id', 'desc');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('request_and_approval.request_category.listing');
    }
    public function add(Request $request)
    {
        return view('request_and_approval.request_category.add');
    }
    public function trash(Request $request)
    {

        if ($request->ajax()) {
            $query = RequestCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('request_and_approval.request_category.trashlisting');
    }
    public function submit(Request $request)
    {
        $postID = $request->info_id;
        $branch = Session::get('branch');
        $exist = RequestCategoryModel::where('name', $request->name)->where('branch', $branch)->where('id', '!=', $postID)->count();
        if (!$exist) {
            $data = [
                'name' => $request->name,
                'decription' => $request->decription,
                'branch' => $branch
            ];

            $purchase = RequestCategoryModel::updateOrCreate(['id' => $postID], $data);
            return 'true';
        } else
            return 'false';
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $data = RequestCategoryModel::where('id', $id)->get();
        return view('request_and_approval.request_category.edit', compact('data', 'branch'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = RequestCategoryModel::find($request->id);
        if ($MaterialCategory->flow_created == 0) {
            RequestCategoryModel::where('id', $id)->delete();
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
        RequestCategoryModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        RequestCategoryModel::where('id', $id)->delete();
        return 'true';
    }
    public function check_exists($value, $field, $table)
    {
        $branch = Session::get('branch');
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
        return $query->count();
    }
}

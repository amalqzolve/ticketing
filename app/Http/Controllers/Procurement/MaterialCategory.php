<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\MaterialCategoryModel;
use Session;

class MaterialCategory extends Controller
{
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = MaterialCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('procurement.MaterialCategory.listing');
    }
    public function add(Request $request)
    {
        return view('procurement.MaterialCategory.add');
    }
    public function trash(Request $request)
    {

        if ($request->ajax()) {
            $query = MaterialCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            // $count_filter = $query->count();
            // $count_total = MaterialCategoryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('procurement.MaterialCategory.trashlisting');
    }
    public function submit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $postID = $request->info_id;
                $branch = Session::get('branch');
                $data = [
                    'name' => $request->name,
                    'decription' => $request->decription,
                    'branch' => $branch
                ];
                $purchase = MaterialCategoryModel::updateOrCreate(['id' => $postID], $data);
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $data = MaterialCategoryModel::where('id', $id)->get();
        return view('procurement.MaterialCategory.edit', compact('data', 'branch'));
    }


    public function delete(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $id = $request->id;
                $MaterialCategory = MaterialCategoryModel::find($request->id);
                if ($MaterialCategory->flow_created == 0) {
                    MaterialCategoryModel::where('id', $id)->update(['del_flag' => 0]);
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                MaterialCategoryModel::where('id', $id)->update(['del_flag' => 1]);
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function trashdelete(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                MaterialCategoryModel::where('id', $id)->delete();
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function check_exists($value, $field, $table)
    {
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
        return $query->count();
    }
}

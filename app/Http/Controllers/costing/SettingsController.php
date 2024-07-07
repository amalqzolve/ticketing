<?php

namespace App\Http\Controllers\costing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\costing\CostCategoryModel;
use Session;

class SettingsController extends Controller
{
    // columns
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $data = CostCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('costing.settings.colums.listing');
    }

    public function add(Request $request)
    {
        return view('costing.settings.colums.add');
    }
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $query = CostCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('costing.settings.colums.trashlisting');
    }
    public function submit(Request $request)
    {
        $postID = $request->info_id;
        $branch = Session::get('branch');
        $data = [
            'name' => $request->name,
            'decription' => $request->decription,
            'percentage' => $request->percentage,
            'branch' => $branch
        ];

        $purchase = CostCategoryModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $data = CostCategoryModel::where('id', $id)->get();
        return view('costing.settings.colums.edit', compact('data', 'branch'));
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $data = CostCategoryModel::where('id', $id)->get();
        return view('costing.settings.colums.view', compact('data'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = CostCategoryModel::find($request->id);
        if ($MaterialCategory->flow_created == 0) {
            CostCategoryModel::where('id', $id)->update(['del_flag' => 0]);
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
    // ./columns

    // public function restore(Request $request)
    // {
    //     $id = $request->id;
    //     CostCategoryModel::where('id', $id)->update(['del_flag' => 1]);
    //     return 'true';
    // }
    // public function trashdelete(Request $request)
    // {
    //     $id = $request->id;
    //     CostCategoryModel::where('id', $id)->delete();
    //     return 'true';
    // }
}

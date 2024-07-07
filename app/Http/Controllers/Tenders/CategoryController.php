<?php

namespace App\Http\Controllers\Tenders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Tender\CategoryModel;
use Session;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = CategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('tenders.category.listing');
    }
    public function add(Request $request)
    {
        return view('tenders.category.add');
    }
    public function trash(Request $request)
    {

        if ($request->ajax()) {
            $query = CategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            // $count_filter = $query->count();
            // $count_total = CategoryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('tenders.category.trashlisting');
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

        $purchase = CategoryModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $data = CategoryModel::where('id', $id)->get();
        return view('tenders.category.edit', compact('data', 'branch'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = CategoryModel::find($request->id);
        if ($MaterialCategory->flow_created == 0) {
            CategoryModel::where('id', $id)->update(['del_flag' => 0]);
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
        CategoryModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        CategoryModel::where('id', $id)->delete();
        return 'true';
    }
}

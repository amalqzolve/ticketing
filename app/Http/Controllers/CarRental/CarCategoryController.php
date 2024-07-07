<?php

namespace App\Http\Controllers\CarRental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\CarRental\CarCategoryModel;
use Session;
use Auth;
use Validator;

class CarCategoryController extends Controller
{
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = CarCategoryModel::orderby('id', 'desc');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $j .= '<a href="car-category-edit?id=' . $row->id . '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-edit"></i>
                      <span class="kt-nav__link-text" data-id="' . $row->id . '" >Edit</span>
                      </span></li></a>';
                $j .= '<li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-trash"></i>
                      <span class="kt-nav__link-text mrCatdelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span></li>';
                return '<span style="overflow: visible; position: relative; width: 80px;">
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                      <i class="fa fa-cog"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                      <ul class="kt-nav">' . $j . '</ul></div></div></span>';
            })->rawColumns(['action'])->make(true);
        }
        return view('carRental.carCategory.listing');
    }
    public function add(Request $request)
    {
        return view('carRental.carCategory.add');
    }
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $query = CarCategoryModel::orderby('id', 'desc');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('carRental.carCategory.trashlisting');
    }
    public function submit(Request $request)
    {

        // $this->validate($request, [
        //     'name' => 'required|unique:car_category,name',
        // ]);

        $branch = Session::get('branch');
        $postID = $request->info_id;
        if (($postID == null) || ($postID == ''))
            $nameAlreadyExist = CarCategoryModel::where('name', $request->name)->count();
        else
            $nameAlreadyExist = CarCategoryModel::where('name', $request->name)->where('id', '!=', $postID)->count();
        // echo $nameAlreadyExist;
        if ($nameAlreadyExist == 0) {
            $data = [
                'name' => $request->name,
                'decription' => $request->decription,
                'branch' => $branch
            ];
            $CarCategory = CarCategoryModel::updateOrCreate(['id' => $postID], $data);
            $out = array(
                'status' => 1
            );
        } else
            $out = array(
                'status' => 0,
                'msg' => 'Category Name is already exist'
            );
        echo json_encode($out);
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $data = CarCategoryModel::where('id', $id)->get();
        return view('carRental.carCategory.edit', compact('data', 'branch'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = CarCategoryModel::find($request->id);
        CarCategoryModel::where('id', $id)->delete();
        $data = array(
            'status' => 1,
            'msg' => "Your Entry has been deleted",
        );
        echo json_encode($data);
    }
    public function restore(Request $request)
    {
        $id = $request->id;
        CarCategoryModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        CarCategoryModel::where('id', $id)->delete();
        return 'true';
    }
}

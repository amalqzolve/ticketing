<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\DepartmentModel;
use DB;
use DataTables;
use Session;
class DepartmentController extends Controller
{
/**
*Department Listing Function
*/
    public function index(Request $request)
    {
                   $branch=Session::get('branch');

    	if ($request->ajax()) {
            $query = DepartmentModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = DepartmentModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	return view('settings.department.index',compact('branch'));
    }
/**
*Department Form Field add Function
*/
    public function add()
    {
        $branch=Session::get('branch');

    	return view('settings.department.add',compact('branch'));

    }
/**
*Department submission through the data table Function
*/
    public function save(Request $request)
    {
        $branch = $request->branch;
    	$request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required'
        ]);
        $user = auth()->user();
        $postID = $request->id;
        $data   = [
                'name'            => $request->name,
                'note'            => $request->note,
                'branch'          => $branch
                
            ];
        $userInfo= DepartmentModel::updateOrCreate(['id' => $postID],$data);
        return 'true';
    }
/**
*Deparment edit shows the data 
*/    
    public function edit_department(Request $request)
    {
                   $branch=Session::get('branch');
       

    	$id=$request->id;
    	$department=DepartmentModel::where('id',$id)->limit(1)
            ->first();
    	return view('settings.department.edit',['data' => $department],compact('branch'));
    }
 /**
*Deparment deleted record from a table 
*/     
    public function delete(Request $request)
    {
    	$id = $request->id;
        DepartmentModel::where('id', $id)
            ->update(['del_flag' => 0]);
        return 'true';
/**
*Deparment trash listing datas 
*/  
    }
    public function trash(Request $request)
    {
                   $branch=Session::get('branch');
        
    	 if ($request->ajax()) {
            $query = DepartmentModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = DepartmentModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	return view('settings.department.trash');
    }
/**
*Deparment restored data 
*/      
    public function departmenttrashlist(Request $request)
    {
    	 $id = $request->id;
        DepartmentModel::where('id', $id)
            ->update(['del_flag' => 1]);
        return 'true';
    }
}

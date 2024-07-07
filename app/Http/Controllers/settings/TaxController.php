<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\settings\TaxModel;
use Session;
class TaxController extends Controller
{
    public function list(Request $request)
    {
           $branch=Session::get('branch');

    	if ($request->ajax()) {
            $query = TaxModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = TaxModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	return view('settings.tax.listing');
	}
	public function add(Request $request)
    {
           $branch=Session::get('branch');

    	return view('settings.tax.add',compact('branch'));
	}
    public function trash(Request $request)
    {
           $branch=Session::get('branch');
        
        if ($request->ajax()) {
            $query = TaxModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = TaxModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('settings.tax.trashlisting');
    }
    public function submit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
       
        $data = [
                'taxname' => $request->tax_name,        
                'tax_percentage' =>$request->tax_percentage,
                'branch' =>$branch
                 ];
               
        $purchase = TaxModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
        
        
    }
    public function edit(Request $request)
    {
           $branch=Session::get('branch');

        $id = $request->id;
        $data = TaxModel::where('id',$id)->get();
        return view ('settings.tax.edit',compact('data','branch'));

    }

    public function TaxView(Request $request)
    {
        $id = $request->id;
        $data = TaxModel::where('id',$id)->get();
        return view ('settings.tax.view',compact('data'));

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        TaxModel::where('id', $id)->update(['del_flag' => 0]);
        return 'true';

    }
    public function restore(Request $request)
    {
        $id = $request->id;
        TaxModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        TaxModel::where('id', $id)->delete();
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
           $branch=Session::get('branch');

        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->where('branch',$branch)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}

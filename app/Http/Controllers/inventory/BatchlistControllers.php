<?php

namespace App\Http\Controllers\inventory;

use Illuminate\Http\Request;
use DB;
use App\inventory\BatchlistModel;
use Session;
use DataTables;
use Spatie\Activitylog\Models\Activity;
class BatchlistControllers extends Controller
{
    public function Batchlist(Request $request)
    {   
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
           $branch=Session::get('branch');

        if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query = BatchlistModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BatchlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = BatchlistModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BatchlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.batch.listing');
    }
    public function Trash(Request $request)
    {   
           $branch=Session::get('branch');
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
        if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query = BatchlistModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BatchlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = BatchlistModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BatchlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.batch.trash');
    }
    public function addbatch()
    {
           $branch=Session::get('branch');

         return view('inventory.batch.add',compact('branch'));
    }
    public function submit(Request $request)
    {
        $branch = $request->branch;
        $id         = $request->id;
            if(isset($id)&&!empty($id)){
                 $check = $this->check_exists_edit($id,$request->batchname,'batchname','qpurchase_batch');
            }
            else
            {
                $check = $this->check_exists($request->batchname,'batchname','qpurchase_batch');
            }
        
        if($check<1)
        {
        $data       = ['batchname'    => $request->batchname, 
                       'description'      => $request->description,
                       'branch'         => $branch
                      ];

        $unitid = BatchlistModel::updateOrCreate(['id' => $id], $data);
       return 1;
        }
        else
        {
            return 0;
        }
    }
     public function delete(Request $request)
    {
        $id=$request->id;
        BatchlistModel::where('id',$id)->update(['del_flag'=>0]);
        return 'true';
    }
    public function edit(Request $request)
    {
           $branch=Session::get('branch');

        $id = $request->id;
        $batch = BatchlistModel::where('id', $id)
                                ->limit(1)
                                ->first();
        return view('inventory.batch.edit',compact('batch','branch'));
    }
    public function restore(Request $request)
    {
        $id=$request->id;
        BatchlistModel::where('id',$id)->update(['del_flag'=>1]);
        return 'true';
    }
     public function trashdeletecategory(Request $request)
    {
        $id=$request->id;
        BatchlistModel::where('id',$id)->delete();
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function check_exists_edit($id,$value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->whereNotIn('id',[$id])->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}

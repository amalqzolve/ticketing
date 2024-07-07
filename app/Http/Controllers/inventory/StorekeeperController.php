<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\StorekeepersModel;
use App\inventory\CountrieslistModel;
use DataTables;
use DB;
use Spatie\Activitylog\Models\Activity;
use Session;
class StorekeeperController extends Controller
{
    //
    public function Storekeepers(Request $request)
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
                $query = StorekeepersModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StorekeepersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = StorekeepersModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StorekeepersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.storekeeper.listing');
    }
    public function trash(Request $request)
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
                $query = StorekeepersModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StorekeepersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = StorekeepersModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StorekeepersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.storekeeper.trash');
    }
     public function add()
    {
           $branch=Session::get('branch');

        $countries = CountrieslistModel::all();
    	return view('inventory.storekeeper.add',compact('countries','branch'));	
    }
    public function storekeepersubmit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
        $check = $this->check_exists($request->code,'code','qinventory_storekeepers');
        if($check<1)
        {
        $data = [
            'name' => $request->storekeepername, 
            'code'          => $request->code,
            'city'          => $request->city,
            'country_region'=> $request->country,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'branch'        => $branch
        ];
        $userInfo = StorekeepersModel::updateOrCreate(['id' => $postID], $data);

        return 'true';
        }
        else
        {
            return 'false';
        }
    }
     public function deletestorekeeper(Request $request)
    {
        $postID = $request->id;
        StorekeepersModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function storekeeperupdate(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $storekeeper = StorekeepersModel::where('id', $id)->limit(1)->first();
        return view('inventory.storekeeper.edit',['data' => $storekeeper,'countries'=>$countries],compact('branch'));
    }
    public function storekeepertrashrestore(Request $request)
    {
        $postID = $request->id;
        StorekeepersModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function storekeepertrashdelete(Request $request)
    {
        $id=$request->id;
        StorekeepersModel::where('id',$id)->delete();
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     
     public function view_storekeeper(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $storekeeper = StorekeepersModel::where('id', $id)->limit(1)->first();
        return view('inventory.storekeeper.view',['data' => $storekeeper,'countries'=>$countries],compact('branch'));
    }
}

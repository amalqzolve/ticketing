<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\StoremanagersModel;
use App\inventory\CountrieslistModel;
use DataTables;
use DB;
use Spatie\Activitylog\Models\Activity;
use Session;

class StoremanagerController extends Controller
{
    //
    public function StoreManagers(Request $request)
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
                $query = StoremanagersModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = StoremanagersModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.storemanager.listing');
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
                $query = StoremanagersModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = StoremanagersModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagersModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.storemanager.trash');
    }
    public function add()
    {
           $branch=Session::get('branch');

         $countries = CountrieslistModel::all();
    	 return view('inventory.storemanager.add',compact('countries','branch'));	
    }
    public function storemanagersubmit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
        
        $data = [
            'name'          => $request->managername, 
            'manager_code'  => $request->code,
            'city'          => $request->city,
            'country_region'=> $request->country,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'branch'        => $branch
        ];
        $userInfo = StoremanagersModel::updateOrCreate(['id' => $postID], $data);

        return 'true';
        
    }
    public function deletestoremanager(Request $request)
    {
        $postID = $request->id;
        StoremanagersModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function storemanagerupdate(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $storemanager = StoremanagersModel::where('id', $id)->limit(1)->first();
        return view('inventory.storemanager.edit',['data' => $storemanager,'countries' => $countries],compact('branch'));
    }
    public function storemanagertrashrestore(Request $request)
    {
        $postID = $request->id;
        StoremanagersModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
     public function storemanagertrashdelete(Request $request)
    {
        $id=$request->id;
        StoremanagersModel::where('id',$id)->delete();
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function view_storemanager(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $storemanager = StoremanagersModel::where('id', $id)->limit(1)->first();
        return view('inventory.storemanager.view',['data' => $storemanager,'countries' => $countries],compact('branch'));
    }
    
}

<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\StoreinchargeModel;
use App\inventory\CountrieslistModel;
use DataTables;
use DB;
use Spatie\Activitylog\Models\Activity;
use Session;
class StoreinchargeController extends Controller
{
    //
	 public function Storeincharge(Request $request)
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
                $query = StoreinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoreinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
               $query = StoreinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoreinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true); 
            }
            
        }
         return view('inventory.storeincharge.listing');
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
                $query = StoreinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoreinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = StoreinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoreinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);   
            }
            
        }
         return view('inventory.storeincharge.trash');
    }
    public function add()
    {
           $branch=Session::get('branch');

         $countries = CountrieslistModel::all();
    	 return view('inventory.storeincharge.add',compact('countries','branch'));	
    }
    public function storeinchargesubmit(Request $request)
    {
        $branch = $request->branch;
        //dd($request);
        $postID = $request->info_id;
        $check = $this->check_exists($request->code,'code','qinventory_storeincharge');
        if($check<1)
        {
        $data = [
            'name' => $request->storeinchargename, 
            'code'  => $request->code,
            'city'          => $request->city,
            'country_region'=> $request->country,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'branch'        => $branch
        ];
        $userInfo = StoreinchargeModel::updateOrCreate(['id' => $postID], $data);

        return 'true';
        }
        else
        {
            return 'false';
        }
    }
    public function deletestoreincharge(Request $request)
    {
        $postID = $request->id;
        StoreinchargeModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function storeinchargeupdate(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $storemanager = StoreinchargeModel::where('id', $id)->limit(1)->first();
        return view('inventory.storeincharge.edit',['data' => $storemanager,'countries' =>$countries],compact('branch'));
    }
    public function storeinchargetrashrestore(Request $request)
    {
        $postID = $request->id;
        StoreinchargeModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function storeinchargetrashdelete(Request $request)
    {
        $id=$request->id;
        StoreinchargeModel::where('id',$id)->delete();
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function view_storeincharge(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $storemanager = StoreinchargeModel::where('id', $id)->limit(1)->first();
        return view('inventory.storeincharge.view',['data' => $storemanager,'countries' =>$countries],compact('branch'));
    }
    
}

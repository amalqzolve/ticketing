<?php

namespace App\Http\Controllers\inventory;

use Illuminate\Http\Request;
use App\inventory\RackinchargeModel;
use App\inventory\CountrieslistModel;
use DataTables;
use DB;
use Session;
class RackinchargeController extends Controller
{
    //
    public function listing(Request $request)
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
                $query = RackinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = RackinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.rackincharge.listing');
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
                $query = RackinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query = RackinchargeModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.rackincharge.trash');
    }
    public function add()
    {
           $branch=Session::get('branch');

         $countries = CountrieslistModel::all();
    	 return view('inventory.rackincharge.add',compact('countries','branch'));	
    }
    public function rackinchargesubmit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
        $check = $this->check_exists($request->code,'code','qinventory_rackincharge');
        if($check<1)
        {
        $data = [
            'name'          => $request->name, 
            'code'          => $request->code,
            'city'          => $request->city,
            'country_region'=> $request->country,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'branch'        => $branch,
        ];
        $userInfo = RackinchargeModel::updateOrCreate(['id' => $postID], $data);

        return 'true';
        }
        else
        {
            return 'false';
        }
    }
    public function rackinchargeupdate(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $rackincharge = RackinchargeModel::where('id', $id)->limit(1)->first();
        return view('inventory.rackincharge.edit',['data' => $rackincharge,'countries' => $countries],compact('branch'));
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function deleterackincharge(Request $request)
    {
        $postID = $request->id;
        RackinchargeModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function rackinchargetrashrestore(Request $request)
    {
        $postID = $request->id;
        RackinchargeModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
     public function rackinchargetrashdelete(Request $request)
    {
        $id=$request->id;
        RackinchargeModel::where('id',$id)->delete();
    }
    public function view_rackincharge(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $rackincharge = RackinchargeModel::where('id', $id)->limit(1)->first();
        return view('inventory.rackincharge.view',['data' => $rackincharge,'countries' => $countries],compact('branch'));
    }
}

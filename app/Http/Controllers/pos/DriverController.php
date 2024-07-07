<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\pos\DriverModel;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use PDF;
use App\settings\BranchSettingsModel;
use App\crm\countryModel;
class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('qpos_driver')
                ->select('qpos_driver.*')
                ->orderby('id', 'desc');
                $query->where('qpos_driver.del_flag', 1)->where('qpos_driver.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = DriverModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('pos.driver.listing');
    }
    public function Add_driver()
    {

        $user_id = Auth::user()->id;
        $country = countryModel::select('id', 'cntry_name')->get();
       
         return view('pos.driver.add',compact('country'));
    }
     public function submit_driver(Request $request)
    {
        $branch=Session::get('branch');
        $postID = $request->id;  
        $check = $this->check_exists($request->drivername,$request->phoneno);
       //dd($check); 
        if($check<1)
       { 
        $data = [
                'name' =>$request->drivername,
                'phoneno' =>$request->phoneno,
                'notes' => $request->notes,
                'branch' =>$branch,
                'nationalid' =>$request->nationalid,
                'employeeid' => $request->employeeid,  
                'country' => $request->country
                  ];      

                $van = DriverModel::updateOrCreate(['id'=>$postID],$data);
                $vanid = $van->id;
             return 'true';
       }
       else
       {
        return 'false';
       }  
        
                               
    }
    public function check_exists($value1,$value2)
     {
           $branch=Session::get('branch');

        $query = DB::table('qpos_driver')->select('name','phoneno')->where('name',$value1)->where('phoneno',$value2)->where('del_flag',1)->where('branch',$branch)->get();
        
         return $query->count();
     }
}
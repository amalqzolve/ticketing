<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\WarehousemanagerslistModel;
use App\inventory\CountrieslistModel;
use App\inventory\WarehouselistModel;
use DataTables;
use DB;
use Spatie\Activitylog\Models\Activity;
use Session;
class WarehouseManagerController extends Controller
{

    
     /**
     * Display a listing of Various WareHouse Manager.
     */

    public function WarehouseManagerListing(Request $request)
    {
           $branch=Session::get('branch');
 $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
         if ($request->ajax()) 
            {
                if($common_customer_database == 1)
                {
                     $query  = DB::table('qinventory_warehouse_manager')->leftJoin('countries', 'qinventory_warehouse_manager.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_manager.id as id','qinventory_warehouse_manager.manager_name as manager_name','qinventory_warehouse_manager.manager_code as manager_code','qinventory_warehouse_manager.city as city','qinventory_warehouse_manager.phone as phone','qinventory_warehouse_manager.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_manager.del_flag', 1);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = WarehousemanagerslistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true); 
                }
                else
                {
                  $query  = DB::table('qinventory_warehouse_manager')->leftJoin('countries', 'qinventory_warehouse_manager.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_manager.id as id','qinventory_warehouse_manager.manager_name as manager_name','qinventory_warehouse_manager.manager_code as manager_code','qinventory_warehouse_manager.city as city','qinventory_warehouse_manager.phone as phone','qinventory_warehouse_manager.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_manager.del_flag', 1)->where('qinventory_warehouse_manager.branch',$branch);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = WarehousemanagerslistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
                }
                 
            }

         return view('inventory.warehousemanager.listing');
    }


    /**
     * Add New WareHouse Manager Form.
     */

    public function NewWarehouseManager()
    {
           $branch=Session::get('branch');

         $countries = CountrieslistModel::all();

         return view('inventory.warehousemanager.add',compact('countries','branch'));
    }
 /**
     *  WareHouse Manager Submission Form.
     */    
   
 public function warehousemanagersubmit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->id;
       // dd($postID);
        $check = $this->check_exists($request->code,'manager_code','qinventory_warehouse_manager');
        if($check<1)
        {
        $data = [
                    'manager_name' => $request->name,
                    'manager_code' => $request->code,
                    'city'          => $request->city,
                    'country_region'=> $request->country,
                    'phone'         => $request->phone,
                    'email'         => $request->email,
                    'branch'        => $branch,
            
                 ];
                // print_r($data);

        $userInfo = WarehousemanagerslistModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
        }
        else
        {
            return 'false';
        }
    }
/**
  * Display a edit details for Various WareHouse manager.
  */    
    public function edit_warehouse_manger(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
       // echo $id;
         $countries = CountrieslistModel::all();

        $NewWarehouseManager = WarehousemanagerslistModel::where('id', $id)->limit(1)
            ->first();
          

        return view('inventory.warehousemanager.edit', ['data' => $NewWarehouseManager],compact('countries','branch'));
    }
    
/**
  *Warehouse Manager Delete
*/      
    public function deletewarehousemanager(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        WarehousemanagerslistModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
/**
  *Warehouse Manager trash
*/    
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
                 $query  = DB::table('qinventory_warehouse_manager')->leftJoin('countries', 'qinventory_warehouse_manager.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_manager.id as id','qinventory_warehouse_manager.manager_name as manager_name','qinventory_warehouse_manager.manager_code as manager_code','qinventory_warehouse_manager.city as city','qinventory_warehouse_manager.phone as phone','qinventory_warehouse_manager.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_manager.del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = WarehousemanagerslistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query  = DB::table('qinventory_warehouse_manager')->leftJoin('countries', 'qinventory_warehouse_manager.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_manager.id as id','qinventory_warehouse_manager.manager_name as manager_name','qinventory_warehouse_manager.manager_code as manager_code','qinventory_warehouse_manager.city as city','qinventory_warehouse_manager.phone as phone','qinventory_warehouse_manager.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_manager.del_flag', 0)->where('qinventory_warehouse_manager.branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = WarehousemanagerslistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true); 
            }
           
        }
       
         return view('inventory.warehousemanager.trash');
    }
    
     
/**
  * Warehouse Manager restore
*/      
    public function restorewarehousemanager(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        WarehousemanagerslistModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
/**
  * Warehouse Manager trash delete
*/     
    public function deletewarehousemanagertrashlist(Request $request)
    {
        $postID = $request->id;
        $rows = WarehouselistModel::where('manager', $postID)->get();
        $a = $rows->count();
        

         if($a == 0)
         {
           WarehousemanagerslistModel::where('id', $postID)->delete();
            
            return 's';
         }  
         else
         {
            return 'N';

         }
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function view_warehouse_manger(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $countries = CountrieslistModel::all();
        $NewWarehouseManager = WarehousemanagerslistModel::where('id', $id)->limit(1)->first();
        return view('inventory.warehousemanager.view', ['data' => $NewWarehouseManager],compact('countries','branch'));
    }

}

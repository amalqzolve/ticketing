<?php

namespace App\Http\Controllers\inventory;

use App\inventory\WarehouseinchargeModel;
use App\inventory\CountrieslistModel;
use App\inventory\WarehouselistModel;
use DB;
use yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Session;
class WarehouseInchargeController extends Controller
{

     /**
     * Display a listing of Various WareHouse Incharge.
     */

    public function WarehouseInchargeListing(Request $request)
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
                    $query  = DB::table('qinventory_warehouse_incharge')->leftJoin('countries', 'qinventory_warehouse_incharge.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_incharge.id as id','qinventory_warehouse_incharge.incharge_name as incharge_name','qinventory_warehouse_incharge.incharge_code as incharge_code','qinventory_warehouse_incharge.city as city','qinventory_warehouse_incharge.phone as phone','qinventory_warehouse_incharge.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_incharge.del_flag', 1);
                $data = $query->get();
                  // dd($data);
                $count_filter = $query->count();
                $count_total = WarehouseinchargeModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);
                }
                else
                {
                    $query  = DB::table('qinventory_warehouse_incharge')->leftJoin('countries', 'qinventory_warehouse_incharge.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_incharge.id as id','qinventory_warehouse_incharge.incharge_name as incharge_name','qinventory_warehouse_incharge.incharge_code as incharge_code','qinventory_warehouse_incharge.city as city','qinventory_warehouse_incharge.phone as phone','qinventory_warehouse_incharge.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_incharge.del_flag', 1)->where('qinventory_warehouse_incharge.branch',$branch);
                $data = $query->get();
                  // dd($data);
                $count_filter = $query->count();
                $count_total = WarehouseinchargeModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);
                }
                    
            }

         return view('inventory.warehouseincharge.listing',compact('branch'));
    }


    /**
     * Add New WareHouse Incharge Form.
     */

    public function NewWarehouseIncharge()
    {
           $branch=Session::get('branch');

         $countries = CountrieslistModel::all();
         return view('inventory.warehouseincharge.add',compact('countries','branch'));
    }
/**
 *Datatable for Warehouse Incharge submission
 */
    public function incharge_submit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->id;
        // dd($request);
        $check = $this->check_exists($request->code,'incharge_code','qinventory_warehouse_incharge');
        if($check<1)
        {
        $data = [
                    'incharge_name' => $request->name,
                    'incharge_code' => $request->code,
                    'city'          => $request->city,
                    'country_region'=> $request->country,
                    'phone'         => $request->phone,
                    'email'         => $request->email,
                    'branch'        => $branch
            
                 ];
                // print_r($data);

        $userInfo = WarehouseinchargeModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
        }
        else
        {
            return 'false';
        }
    }

 /**
     * Display a edit details for  Various WareHouses.
     */   
    
    public function warehouseincharge_update(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
       // echo $id;
         $countries = CountrieslistModel::all();

        $NewWarehouseIncharge = WarehouseinchargeModel::where('id', $id)->limit(1)
            ->first();
          

        return view('inventory.warehouseincharge.edit', ['data' => $NewWarehouseIncharge],compact('countries','branch'));
    }

  /**
  * Warehouse incharge delete
*/  
    public function deletewarehouseincharge(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        WarehouseinchargeModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
/**
  * Warehouse incharge trash
*/
    public function trash(Request $request)
    {
         if ($request->ajax()) {
            $query  = DB::table('qinventory_warehouse_incharge')->leftJoin('countries', 'qinventory_warehouse_incharge.country_region', '=', 'countries.id')
                ->select('qinventory_warehouse_incharge.id as id','qinventory_warehouse_incharge.incharge_name as incharge_name','qinventory_warehouse_incharge.incharge_code as incharge_code','qinventory_warehouse_incharge.city as city','qinventory_warehouse_incharge.phone as phone','qinventory_warehouse_incharge.email as email','countries.cntry_name as country')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse_incharge.del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = WarehouseinchargeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('inventory.warehouseincharge.trash');
    }
    
    /**
  * Warehouse incharge restore
*/
     public function restoreincharge(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        WarehouseinchargeModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
/**
  * trash method to update datable delete Various WareHouses.
  */
    public function trashdeletewarehouseincharge(Request $request)
    {

        $postID = $request->id;
        $rows = WarehouselistModel::where('incharge', $postID)->get();
        $a = $rows->count();
        

         if($a == 0)
         {
           WarehouseinchargeModel::where('id', $postID)->delete();
            
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
     
     public function view_warehouse_incharge(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
       // echo $id;
         $countries = CountrieslistModel::all();

        $NewWarehouseIncharge = WarehouseinchargeModel::where('id', $id)->limit(1)
            ->first();
        return view('inventory.warehouseincharge.view', ['data' => $NewWarehouseIncharge],compact('countries','branch'));
    }

   
}

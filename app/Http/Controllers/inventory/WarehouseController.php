<?php

namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\WarehouselistModel;
use App\inventory\CountrieslistModel;
use App\inventory\WarehousemanagerslistModel;
use App\inventory\WarehouseinchargeModel;
use yajra\Datatables\Datatables;
use DB;
use Spatie\Activitylog\Models\Activity;
use Session;
class WarehouseController extends Controller
{
    /**
     * Display a listing of Various WareHouses.
     */

    public function WarehouseListing(Request $request)
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
                    $query  = DB::table('qinventory_warehouse')->leftJoin('qinventory_warehouse_manager', 'qinventory_warehouse.manager', '=', 'qinventory_warehouse_manager.id')
                ->leftJoin('qinventory_warehouse_incharge', 'qinventory_warehouse.incharge', '=', 'qinventory_warehouse_incharge.id')
                ->select('qinventory_warehouse.id as id','qinventory_warehouse.warehouse_name as warehouse_name','qinventory_warehouse.warehouse_code as warehouse_code','qinventory_warehouse.address_1 as address_1','qinventory_warehouse.phone as phone','qinventory_warehouse.email as email','qinventory_warehouse_manager.manager_name as manager','qinventory_warehouse_incharge.incharge_name as incharge')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse.del_flag', 1);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = WarehouselistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true); 
                }
                else
                {
                  $query  = DB::table('qinventory_warehouse')->leftJoin('qinventory_warehouse_manager', 'qinventory_warehouse.manager', '=', 'qinventory_warehouse_manager.id')
                ->leftJoin('qinventory_warehouse_incharge', 'qinventory_warehouse.incharge', '=', 'qinventory_warehouse_incharge.id')
                ->select('qinventory_warehouse.id as id','qinventory_warehouse.warehouse_name as warehouse_name','qinventory_warehouse.warehouse_code as warehouse_code','qinventory_warehouse.address_1 as address_1','qinventory_warehouse.phone as phone','qinventory_warehouse.email as email','qinventory_warehouse_manager.manager_name as manager','qinventory_warehouse_incharge.incharge_name as incharge')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse.del_flag', 1)->where('qinventory_warehouse.branch',$branch);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = WarehouselistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);   
                }
                   
            }

         return view('inventory.warehouse.listing');
    }


    /**
     * Add New WareHouse Form.
     */

    public function NewWarehouse()
    {
           $branch=Session::get('branch');
 $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->where('del_flag',1)->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->where('del_flag',1)->get();
        $branchs  = DB::table('a_accounts')->select('id','label')->get();
    }
    else
    {
        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->where('del_flag',1)->where('branch',$branch)->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->where('del_flag',1)->where('branch',$branch)->get();
        $branchs  = DB::table('a_accounts')->select('id','label')->get();
    }
        

        return view('inventory.warehouse.add',compact('countries','manager','incharge','branch','branchs'));
        

    }
/**
 *Datatable for Warehouse lists submission
 */    
      public function warehouse_submit(Request $request)
    {
         
     $branch=Session::get('branch');
        $postID = $request->id;
        if(isset($id)&&!empty($id)){
            $check = $this->check_exists_edit($postID,$request->warehousename,'warehouse_name','qinventory_warehouse');
            }
            else
            {
                $check = $this->check_exists($request->warehousename,'warehouse_name','qinventory_warehouse');
            }
        
        if($check<1)
        {
            
if($request->checkedValue == "true")
{
    $value = 1;
     WarehouselistModel::where('branch',$branch)->update(['warehouse_default' => 0]);
    // dd(DB::getQueryLog());

}
else
{
    $value = 0;
}
       // dd($postID);
        $data = [
                    'warehouse_name' => $request->warehousename,
                    'warehouse_code' => $request->warehousecode,
                    'address_1'      => $request->address1,
                    'address_2'      => $request->address2,
                    'city'           => $request->city,
                    'country'        => $request->country,
                    'region'         => $request->region,
                    'state'          => $request->state,
                    'zipcode'        => $request->zipcode,
                    'phone'          => $request->phone,
                    'email'          => $request->email,
                    'manager'        => $request->manager_name,
                    'incharge'       => $request->incharge_name,
                    'branch'         => $request->branch,
                    'warehouse_default'=> $value,
                    'branch'=>$branch
            
                 ];
                // print_r($data);

        $userInfo = WarehouselistModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
     }
     else
     {

        return 'false';
     }
    }

/**
  * Display a edit of Various WareHouses.
  */   
     public function edit_warehouse(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
       // echo $id;
 $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $NewWarehouse = WarehouselistModel::where('id', $id)->limit(1)
            ->first();
           

       // return view('inventory.warehouse.edit', ['data' => $NewWarehouse]);

        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->get();
        $branchs  = DB::table('a_accounts')->select('id','label')->get();
    }
    else
    {
        $NewWarehouse = WarehouselistModel::where('id', $id)->limit(1)
            ->first();
           

       // return view('inventory.warehouse.edit', ['data' => $NewWarehouse]);

        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->where('branch',$branch)->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->where('branch',$branch)->get();
        $branchs  = DB::table('a_accounts')->select('id','label')->get();
    }
        

        return view('inventory.warehouse.edit',['data' => $NewWarehouse],compact('countries','manager','incharge','branch','branchs'));


    }
/**
  * Delete Various WareHouses.
  */    
    public function deletewarehouse(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        WarehouselistModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
/**
   *Warehouse  Information trash 
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
                $query  = DB::table('qinventory_warehouse')->leftJoin('qinventory_warehouse_manager', 'qinventory_warehouse.manager', '=', 'qinventory_warehouse_manager.id')
                ->leftJoin('qinventory_warehouse_incharge', 'qinventory_warehouse.incharge', '=', 'qinventory_warehouse_incharge.id')
                ->select('qinventory_warehouse.id as id','qinventory_warehouse.warehouse_name as warehouse_name','qinventory_warehouse.warehouse_code as warehouse_code','qinventory_warehouse.address_1 as address_1','qinventory_warehouse.phone as phone','qinventory_warehouse.email as email','qinventory_warehouse_manager.manager_name as manager','qinventory_warehouse_incharge.incharge_name as incharge')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse.del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = WarehouselistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
              $query  = DB::table('qinventory_warehouse')->leftJoin('qinventory_warehouse_manager', 'qinventory_warehouse.manager', '=', 'qinventory_warehouse_manager.id')
                ->leftJoin('qinventory_warehouse_incharge', 'qinventory_warehouse.incharge', '=', 'qinventory_warehouse_incharge.id')
                ->select('qinventory_warehouse.id as id','qinventory_warehouse.warehouse_name as warehouse_name','qinventory_warehouse.warehouse_code as warehouse_code','qinventory_warehouse.address_1 as address_1','qinventory_warehouse.phone as phone','qinventory_warehouse.email as email','qinventory_warehouse_manager.manager_name as manager','qinventory_warehouse_incharge.incharge_name as incharge')
                ->orderby('id', 'desc');
                $query->where('qinventory_warehouse.del_flag', 0)->where('qinventory_warehouse.branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = WarehouselistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);  
            }
           
        }
         return view('inventory.warehouse.trash');
    }

    
    /**
 *Warehouse  Information DataTable restore
 */
     public function restorewarehouse(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        WarehouselistModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
/**
 *Warehouse  Information delete trash
 */    
    public function deletewarehousetrashdetails(Request $request)
    {
        $postID = $request->id;
        WarehouselistModel::where('id', $postID)->delete();
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
     public function view_warehouse(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
       // echo $id;
 $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $NewWarehouse = WarehouselistModel::where('id', $id)->limit(1)
            ->first();

        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->get();
    }
    else
    {
        $NewWarehouse = WarehouselistModel::where('id', $id)->limit(1)
            ->first();

        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->where('branch',$branch)->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->where('branch',$branch)->get();
    }
        

        return view('inventory.warehouse.view',['data' => $NewWarehouse],compact('countries','manager','incharge','branch'));


    }

    }

    ?>

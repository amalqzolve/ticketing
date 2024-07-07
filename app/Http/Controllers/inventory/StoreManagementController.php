<?php
namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\StoremanagementlistModel;
use App\inventory\WarehouselistModel;
use App\inventory\RackmanagementlistModel;
use App\inventory\StoremanagersModel;
use App\inventory\StorekeepersModel;
use App\inventory\StoreinchargeModel;
use DB;
use Session;
use DataTables;
use Spatie\Activitylog\Models\Activity;

class StoreManagementController extends Controller
{
     /**
     * Display a listing of Various Accounts.
     */
    public function StoreManagementListing(Request $request)
    {
        $warehouse=Session::get('warehouse');
           $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
        if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query =  DB::table('qinventory_store_management')
                    ->leftJoin('qinventory_warehouse', 'qinventory_store_management.warehouse', '=', 'qinventory_warehouse.id')
                    ->leftJoin('qinventory_storeincharge', 'qinventory_store_management.store_incharge', '=', 'qinventory_storeincharge.id')
                    ->leftJoin('qinventory_storekeepers', 'qinventory_store_management.store_keeper', '=', 'qinventory_storekeepers.id')
                     ->leftJoin('qinventory_storemanagers', 'qinventory_store_management.store_manager', '=', 'qinventory_storemanagers.id')
                    ->select('qinventory_store_management.*', 'qinventory_warehouse.warehouse_name','qinventory_storeincharge.name as incharge','qinventory_storekeepers.name as keeper','qinventory_storemanagers.name as manager')
                    ->orderby('qinventory_store_management.id', 'desc');
            $query->where('qinventory_store_management.del_flag',1);
            $query->where('qinventory_store_management.warehouse',$warehouse);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
               $query =  DB::table('qinventory_store_management')
                    ->leftJoin('qinventory_warehouse', 'qinventory_store_management.warehouse', '=', 'qinventory_warehouse.id')
                    ->leftJoin('qinventory_storeincharge', 'qinventory_store_management.store_incharge', '=', 'qinventory_storeincharge.id')
                    ->leftJoin('qinventory_storekeepers', 'qinventory_store_management.store_keeper', '=', 'qinventory_storekeepers.id')
                     ->leftJoin('qinventory_storemanagers', 'qinventory_store_management.store_manager', '=', 'qinventory_storemanagers.id')
                    ->select('qinventory_store_management.*', 'qinventory_warehouse.warehouse_name','qinventory_storeincharge.name as incharge','qinventory_storekeepers.name as keeper','qinventory_storemanagers.name as manager')
                    ->orderby('qinventory_store_management.id', 'desc');
            $query->where('qinventory_store_management.del_flag',1)->where('qinventory_store_management.branch',$branch);
            $warehouse=Session::get('warehouse');
 $query->where('qinventory_store_management.warehouse',$warehouse);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true); 
            }
            
        }
        return view('inventory.store.listing');
    }
    /**
     * Add New store managements Form.
     */

       public function warehouse_select()
    {
$branch=Session::get('branch');

        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

         return view('warehouse.dashboard.select', compact('warehouses','branch'));
    }

    
    public function Newstoremanagement()
    {


        if(session()->has('warehouse')){

            $warehouse=Session::get('warehouse');

           $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->get();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->get();
    }
    else
    {
     $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();   
    }
        
         return view('inventory.store.addstore',compact('warehouse','manager','keeper','incharge','branch'));


}else{

  return $this->warehouse_select();
}


        
    }
    
     public function storemanagement_submit(Request $request)
    {
        // dd($request);
        $branch = $request->branch;
        $postID = $request->id;
         $warehouse=Session::get('warehouse');
if($request->checkedValue == "true")
{
    $value = 1;
     StoremanagementlistModel::where('branch',$branch)->update(['store_default' => 0]);
    // dd(DB::getQueryLog());

}
else
{
    $value = 0;
}
        
        $data = [
                    'warehouse'               => $warehouse,
                    'store_name'              => $request->storename,
                    'store_manager'           => $request->storemanager,
                    'store_incharge'          => $request->storeincharge,
                    'store_location'          => $request->storelocation,
                    'store_keeper'            => $request->storekeeper,
                    'total_rack_availability' => $request->rackavailability,
                    'branch'                  => $branch,
                    'store_default'           => $value,
            
                 ];
        $userInfo = StoremanagementlistModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
        
        
    }
    // public function storemanagement_list(Request $request)
    // {
    //     $totalFiltered = 0;
    //     $totalData = StoremanagementlistModel::count();
    //   $query =  DB::table('qinventory_store_management')
    //             ->leftJoin('qinventory_warehouse', 'qinventory_store_management.warehouse', '=', 'qinventory_warehouse.id')->where('qinventory_store_management.del_flag',1)
    //             ->select('qinventory_store_management.*', 'qinventory_warehouse.warehouse_name')
    //             ->orderby('qinventory_store_management.id', 'desc');
    //         //     echo "<pre>";
    //         // print_r($list);
    //         // exit();
        
    //     //$query = StoremanagementlistModel::orderby('id', 'desc');
    //      $query->where('qinventory_store_management.del_flag',1);
    //     // $query->where('del_flag', 1);
    //     $totalFiltered = $query->count();

    //     if (!empty($request->input('search.value')))
    //     {
    //         $search = $request->input('search.value');
    //         $query->Where('qinventory_store_management.id', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_warehouse.warehouse_name', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_store_management.store_name', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_store_management.store_manager', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_store_management.store_incharge', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_store_management.store_location', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_store_management.store_keeper', 'LIKE', "%{$search}%");
    //         $query->orWhere('qinventory_store_management.total_rack_availability', 'LIKE', "%{$search}%");
           
    //     }

    //     if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
    //     {
    //         $search_3 = $_POST['columns'][3]['search']['value'];
    //         $query->Where('qinventory_warehouse.warehouse_name', 'LIKE', "%{$search_3}%");
    //         $query->Where('qinventory_store_management.store_name', 'LIKE', "%{$search_3}%");
    //         $query->Where('qinventory_store_management.store_manager', 'LIKE', "%{$search_3}%");
    //         $query->Where('qinventory_store_management.store_incharge', 'LIKE', "%{$search_3}%");
    //         $query->Where('qinventory_store_management.store_location', 'LIKE', "%{$search_3}%");
    //         $query->Where('qinventory_store_management.store_keeper', 'LIKE', "%{$search_3}%");
    //         $query->Where('qinventory_store_management.total_rack_availability', 'LIKE', "%{$search_3}%");
            
    //         echo "test";
    //     }

    //     $query->skip($_POST['start'])->take($_POST['length']);
    //     $list = $query->get();
    //     $data = array();
    //     $no = $_POST['start'];
    //     $i = 0;
    //     $row = array();

        

    //     foreach ($list as $lists)
    //     {
    //         // echo "<pre>";
    //         // print_r($lists);
    //         // exit();
    //         $no++;

    //         $row[0] = $no;
    //         $row[1] = $lists->warehouse_name;
    //         $row[2] = $lists->store_name;
    //         $row[3] = $lists->store_manager;
    //         $row[4] = $lists->store_incharge;
    //         $row[5] = $lists->store_location;
    //         $row[6] = $lists->store_keeper;
    //         $row[7] = $lists->total_rack_availability;
    //         $row[8] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
                        

    //                    <a href="edit_store?id=' . $lists->id . '"><li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-contract"></i>
    //                     <span class="kt-nav__link-text " data-id="' . $lists->id . '" >Edit</span>
    //                     </span></li></a>

    //                       <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_store_management_delete" id=' . $lists->id . ' data-id=' . $lists->id . '>Delete</span></span></li>

    //                    </ul></div></div></span>';


    //         $data[$i] = $row;
    //         $i++;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $totalData,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data,
    //     );
    //     echo json_encode($output);

    // }
    /**
     *Store Management Edit Function
     */
    public function edit_store(Request $request)
    {
           $branch=Session::get('branch');

        $id = $_REQUEST['id'];
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->get();
        $store     = StoremanagementlistModel::where('id', $id)->limit(1)
                     ->first();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->get();
    }
    else
    {
     $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $store     = StoremanagementlistModel::where('id', $id)->limit(1)
                     ->first();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();   
    }
        
           // $data1 = $NewWarehouseIncharge->get();
           //  echo "<pre>";
           // print_r($NewWarehouseIncharge);

        return view('inventory.store.edit', ['data' => $store],compact('warehouse','manager','keeper','incharge','branch'));
    }
    /**
     *Store Management Delete Function
     */
    public function deletestore(Request $request)
    {
        $postID = $request->id;
        StoremanagementlistModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    /**
     *Store Management Trash Delete Function
     */
    public function deletestoredetails(Request $request)
    {
        $postID = $request->id;

        $rows = RackmanagementlistModel::where('store', $postID)->get();
        $a = $rows->count();
         if($a == 0)
         {
           StoremanagementlistModel::where('id', $postID)->delete();
            return 's';
         }  
         else
         {
            return 'N';
         }

        // StoremanagementlistModel::where('id', $postID)->delete();
        // return 'true';
    }
    /**
     *Store Management Trash Listing Function
     */
    public function trash(Request $request)
    {
           $branch=Session::get('branch');
           $warehouse=Session::get('warehouse');
 
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
        if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query =  DB::table('qinventory_store_management')
                    ->leftJoin('qinventory_warehouse', 'qinventory_store_management.warehouse', '=', 'qinventory_warehouse.id')
                    ->leftJoin('qinventory_storeincharge', 'qinventory_store_management.store_incharge', '=', 'qinventory_storeincharge.id')
                    ->leftJoin('qinventory_storekeepers', 'qinventory_store_management.store_keeper', '=', 'qinventory_storekeepers.id')
                     ->leftJoin('qinventory_storemanagers', 'qinventory_store_management.store_manager', '=', 'qinventory_storemanagers.id')
                    ->select('qinventory_store_management.*', 'qinventory_warehouse.warehouse_name','qinventory_storeincharge.name as incharge','qinventory_storekeepers.name as keeper','qinventory_storemanagers.name as manager')
                    ->orderby('qinventory_store_management.id', 'desc');
            $query->where('qinventory_store_management.del_flag',0);
            $query->where('qinventory_store_management.warehouse',$warehouse);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query =  DB::table('qinventory_store_management')
                    ->leftJoin('qinventory_warehouse', 'qinventory_store_management.warehouse', '=', 'qinventory_warehouse.id')
                    ->leftJoin('qinventory_storeincharge', 'qinventory_store_management.store_incharge', '=', 'qinventory_storeincharge.id')
                    ->leftJoin('qinventory_storekeepers', 'qinventory_store_management.store_keeper', '=', 'qinventory_storekeepers.id')
                     ->leftJoin('qinventory_storemanagers', 'qinventory_store_management.store_manager', '=', 'qinventory_storemanagers.id')
                    ->select('qinventory_store_management.*', 'qinventory_warehouse.warehouse_name','qinventory_storeincharge.name as incharge','qinventory_storekeepers.name as keeper','qinventory_storemanagers.name as manager')
                    ->orderby('qinventory_store_management.id', 'desc');
            $query->where('qinventory_store_management.del_flag',0)->where('qinventory_store_management.branch',$branch);
            $query->where('qinventory_store_management.warehouse',$warehouse);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.store.trash');
    }
    // public function trash_list()
    // {
    //     $totalFiltered = 0;
    //     $totalData = StoremanagementlistModel::count();
    //     $query = StoremanagementlistModel::orderby('id', 'desc');
    //     $query->where('del_flag', 0);
    //     $totalFiltered = $query->count();
    //     $query->skip($_POST['start'])->take($_POST['length']);
    //     $list = $query->get();
    //     $data = array();
    //     $no = $_POST['start'];
    //     $i = 0;
    //     $row = array();

    //     foreach ($list as $lists)
    //     {
    //         // echo "<pre>";
    //         // print_r($lists);
    //         // exit();
    //         $no++;

    //         $row[0] = $no;
    //         $row[1] = $lists->warehouse;
    //         $row[2] = $lists->store_name;
    //         $row[3] = $lists->store_manager;
    //         $row[4] = $lists->store_incharge;
    //         $row[5] = $lists->store_location;
    //         $row[6] = $lists->store_keeper;
    //         $row[7] = $lists->total_rack_availability;
    //         $row[8] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
                        

    //                       <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_store_management_recover" id=' . $lists->id . ' data-id=' . $lists->id . '>Recover</span></span></li>

    //                     <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_del_store_management_trashdelete" id=' . $lists->id . ' data-id=' . $lists->id . '>Delete</span></span></li>

    //                    </ul></div></div></span>';


    //         $data[$i] = $row;
    //         $i++;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $totalData,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data,
    //     );
    //     echo json_encode($output);

    // }
    /**
     *Store Management Restore Function
     */    
    public function restorestore(Request $request)
    {
        $postID = $request->id;
        StoremanagementlistModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function view_store(Request $request)
    {
           $branch=Session::get('branch');
        $id = $_REQUEST['id'];
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->get();
        $store     = StoremanagementlistModel::where('id', $id)->limit(1)
                     ->first();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->get();
    }
    else
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $store     = StoremanagementlistModel::where('id', $id)->limit(1)
                     ->first();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
    }
        
           // $data1 = $NewWarehouseIncharge->get();
           //  echo "<pre>";
           // print_r($NewWarehouseIncharge);

        return view('inventory.store.view', ['data' => $store],compact('warehouse','manager','keeper','incharge','branch'));
    }
    
}

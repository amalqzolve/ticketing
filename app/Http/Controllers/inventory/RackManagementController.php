<?php
namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\RackmanagementlistModel;
use App\inventory\RackinchargeModel;
use App\inventory\RackmanagerModel;
use App\inventory\StoremanagementlistModel;
use App\inventory\WarehouselistModel;
use Session;
use DataTables;
use DB;
use Spatie\Activitylog\Models\Activity;

class RackManagementController extends Controller
{
     /**
     * Display a listing of Various Accounts.
     */

    public function RackManagementListing(Request $request)
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
                $query  = DB::table('qinventory_rack_management')->leftJoin('qinventory_warehouse','qinventory_rack_management.warehouse', '=', 'qinventory_warehouse.id')
                ->leftJoin('qinventory_store_management', 'qinventory_rack_management.store', '=', 'qinventory_store_management.id')
                ->leftJoin('qinventory_rackincharge', 'qinventory_rack_management.rack_in_charge', '=', 'qinventory_rackincharge.id')
                ->leftJoin('qinventory_rackmanagers', 'qinventory_rack_management.rack_manager', '=', 'qinventory_rackmanagers.id')
                ->select('qinventory_warehouse.warehouse_name as name','qinventory_store_management.store_name as storename','qinventory_rack_management.id as id', 'qinventory_rack_management.rack_name as rack_name','qinventory_rack_management.*')
                ->orderby('id', 'desc');
            $query->where('qinventory_rack_management.del_flag', 1);
             $query->where('qinventory_rack_management.warehouse',$warehouse);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackmanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
             $query  = DB::table('qinventory_rack_management')->leftJoin('qinventory_warehouse','qinventory_rack_management.warehouse', '=', 'qinventory_warehouse.id')
                ->leftJoin('qinventory_store_management', 'qinventory_rack_management.store', '=', 'qinventory_store_management.id')
                ->leftJoin('qinventory_rackincharge', 'qinventory_rack_management.rack_in_charge', '=', 'qinventory_rackincharge.id')
                ->leftJoin('qinventory_rackmanagers', 'qinventory_rack_management.rack_manager', '=', 'qinventory_rackmanagers.id')
                ->select('qinventory_warehouse.warehouse_name as name','qinventory_store_management.store_name as storename','qinventory_rack_management.id as id', 'qinventory_rack_management.rack_name as rack_name','qinventory_rack_management.*')
                ->orderby('id', 'desc');
            $query->where('qinventory_rack_management.del_flag', 1)->where('qinventory_rack_management.branch',$branch);
              $query->where('qinventory_rack_management.warehouse',$warehouse);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackmanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);   
            }
            
        }
         return view('inventory.rack.listing');
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



    public function Newrackmanagement()
    {

          if(session()->has('warehouse')){

           $branch=Session::get('branch');
            $warehouse=Session::get('warehouse');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->get();
            $store = StoremanagementlistModel::select('id','store_name')->get();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->get();
    }

    else
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $store = StoremanagementlistModel::select('id','store_name')->Where('del_flag', 1)->where('branch',$branch)->Where('warehouse', $warehouse)->get();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
    }
      
         return view('inventory.rack.addrack',compact('warehouse','store','branch','rackmanager','rackincharge'));
     }else{

  return $this->warehouse_select();
}

    }
    /**
    * Add New store managements Form.
    */
    public function rackmanagement_submit(Request $request)
    {
        $branch = $request->branch;
        $warehouse=Session::get('warehouse');
        $postID = $request->id;
        $check = $this->check_exists($request->rackmanger,'rack_manager','qinventory_rack_management');
        if($check<1)
        {
if($request->checkedValue == "true")
{
    $value = 1;
     RackmanagementlistModel::where('branch',$branch)->update(['rack_default' => 0]);
    // dd(DB::getQueryLog());

}
else
{
    $value = 0;
}
        $data = [
                    'warehouse'          => $warehouse,
                    'store'              => $request->store,
                    'rack_name'          => $request->rackname,
                    'rack_manager'       => $request->rackmanger,
                    'rack_in_charge'     => $request->rackincharge,
                    'branch'             => $branch,
                    'rack_default'       => $value,
                 ];
        $userInfo = RackmanagementlistModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
     }
     else
     {
        return 'false';
     }
    }
    // public function rackmanagement_list()
    // {
    //     $totalFiltered = 0;
    //     $totalData = RackmanagementlistModel::count();
    //     $query = RackmanagementlistModel::orderby('id', 'desc');
    //     $query->where('del_flag', 1);
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
    //         $row[2] = $lists->store;
    //         $row[3] = $lists->rack_name;
    //         $row[4] = $lists->rack_manager;
    //         $row[5] = $lists->rack_in_charge;
    //         $row[6] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
                       

    //                    <a href="edit_rack?id=' . $lists->id . '"><li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-contract"></i>
    //                     <span class="kt-nav__link-text " data-id="' . $lists->id . '" >Edit</span>
    //                     </span></li></a>

    //                       <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_rack_management_delete" id=' . $lists->id . ' data-id=' . $lists->id . '>Delete</span></span></li>

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
    
    public function edit_rack(Request $request)
    {
           $branch=Session::get('branch');
            $warehouse=Session::get('warehouse');
        $id = $_REQUEST['id'];
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->get();
            $store = StoremanagementlistModel::select('id','store_name')->Where('del_flag', 1)->Where('warehouse', $warehouse)->get();
         $rack = RackmanagementlistModel::where('id', $id)->limit(1)
            ->first();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->get();
    }
    else
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $store = StoremanagementlistModel::select('id','store_name')->Where('del_flag', 1)->where('branch',$branch)->Where('warehouse', $warehouse)->get();
         $rack = RackmanagementlistModel::where('id', $id)->limit(1)
            ->first();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
    }
        
         return view('inventory.rack.edit', ['data' => $rack],compact('warehouse','store','branch','rackmanager','rackincharge'));
    
    }
    
    public function deleterack(Request $request)
    {
        $postID = $request->id;
        RackmanagementlistModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
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
                $query  = DB::table('qinventory_rack_management')->leftJoin('qinventory_warehouse','qinventory_rack_management.warehouse', '=', 'qinventory_warehouse.id')
                ->leftJoin('qinventory_store_management', 'qinventory_rack_management.store', '=', 'qinventory_store_management.id')
                ->leftJoin('qinventory_rackincharge', 'qinventory_rack_management.rack_in_charge', '=', 'qinventory_rackincharge.id')
                ->leftJoin('qinventory_rackmanagers', 'qinventory_rack_management.rack_manager', '=', 'qinventory_rackmanagers.id')
                ->select('qinventory_warehouse.warehouse_name as name','qinventory_store_management.store_name as storename','qinventory_rack_management.id as id', 'qinventory_rack_management.rack_name as rack_name','qinventory_rack_management.*')
                ->orderby('id', 'desc');
            $query->where('qinventory_rack_management.del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackmanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query  = DB::table('qinventory_rack_management')->leftJoin('qinventory_warehouse','qinventory_rack_management.warehouse', '=', 'qinventory_warehouse.id')
                ->leftJoin('qinventory_store_management', 'qinventory_rack_management.store', '=', 'qinventory_store_management.id')
                ->leftJoin('qinventory_rackincharge', 'qinventory_rack_management.rack_in_charge', '=', 'qinventory_rackincharge.id')
                ->leftJoin('qinventory_rackmanagers', 'qinventory_rack_management.rack_manager', '=', 'qinventory_rackmanagers.id')
                ->select('qinventory_warehouse.warehouse_name as name','qinventory_store_management.store_name as storename','qinventory_rack_management.id as id', 'qinventory_rack_management.rack_name as rack_name','qinventory_rack_management.*')
                ->orderby('id', 'desc');
            $query->where('qinventory_rack_management.del_flag', 0)->where('qinventory_rack_management.branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackmanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.rack.trash');
    }
    
    // public function trash_list()
    // {
    //     $totalFiltered = 0;
    //     $totalData = RackmanagementlistModel::count();
    //     $query = RackmanagementlistModel::orderby('id', 'desc');
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
    //         $row[2] = $lists->store;
    //         $row[3] = $lists->rack_name;
    //         $row[4] = $lists->rack_manager;
    //         $row[5] = $lists->rack_in_charge;
    //         $row[6] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
    //                       <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_rack_management_recover" id=' . $lists->id . ' data-id=' . $lists->id . '>Recover</span></span></li>
    //                     <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_rack_management_trashdelete" id=' . $lists->id . ' data-id=' . $lists->id . '>Delete</span></span></li>

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
    
    public function restorerack(Request $request)
    {
        $postID = $request->id;
        RackmanagementlistModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function deleterackdetails(Request $request)
    {
        $postID = $request->id;
        RackmanagementlistModel::where('id', $postID)->delete();
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
     public function view_rack(Request $request)
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
            $store = StoremanagementlistModel::select('id','store_name')->Where('del_flag', 1)->get();
         $rack = RackmanagementlistModel::where('id', $id)->limit(1)
            ->first();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->get();
    }
    else
    {
        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $store = StoremanagementlistModel::select('id','store_name')->Where('del_flag', 1)->where('branch',$branch)->get();
         $rack = RackmanagementlistModel::where('id', $id)->limit(1)
            ->first();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
    }
        
         return view('inventory.rack.view', ['data' => $rack],compact('warehouse','store','branch','rackmanager','rackincharge'));
    
    }
}

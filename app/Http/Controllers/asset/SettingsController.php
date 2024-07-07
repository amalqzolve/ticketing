<?php

namespace App\Http\Controllers\asset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use File;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AssetmainImport;
use App\inventory\WarehousemanagerslistModel;
use App\inventory\WarehouseinchargeModel;
use App\inventory\CountrieslistModel;
use App\inventory\StoremanagersModel;
use App\inventory\StorekeepersModel;
use App\inventory\StoreinchargeModel;
use App\asset\StoremanagementlistModel;
use App\asset\WarehouselistModel;
use App\asset\RackmanagementlistModel;
use App\inventory\RackinchargeModel;
use App\inventory\RackmanagerModel;
use App\settings\ProductUnitModel;
use App\asset\GeolocationModel;
use App\asset\TypeModel;
use App\asset\CategoryModel;
use App\asset\GroupModel;
use App\asset\AreaModel;
use App\asset\DepartmentModel;
use App\asset\ProjectModel;
use App\asset\PartsModel;
use App\asset\ComponentModel;
use App\asset\UnitModel;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function asset_list()
    // {
    // 	$assets = DB::table('assets')->select('*')->get();
    //      return view('asset.asset.list',compact('assets'));
    // }
   
public function geolocationlisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_geolocation')
                ->select('assets_geolocation.*')
                ->orderby('id', 'desc');
                $query->where('assets_geolocation.del_flag', 1)->where('assets_geolocation.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = GeolocationModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.geolocation.listing');
    }
   public function geolocation_addd()
    {

        return view('asset.geolocation.add');
      
    }
    
    public function submit_geolocation(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;  
        $check = $this->check_exists($request->name,'name','assets_geolocation');
        if($check<1)
        {
            $data = [
                'name' =>$request->name,
                'location' =>$request->location,
                'branch' => $branch
                  ];      
                $geolocation = GeolocationModel::updateOrCreate(['id'=>$postID],$data);
                $geolocationid = $geolocation->id;
                return 'true';
        }
        else
        {
            return 'false';
        }   
        
                               
    }
    
    public function editgeolocation(Request $request)
    {
        $id = $request->id;
        $geolocation = DB::table('assets_geolocation')->select('assets_geolocation.*')->where('assets_geolocation.id',$id)->get();
        return view('asset.geolocation.edit',compact('geolocation'));
      
    }
    public function arealisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_area')
                ->select('assets_area.*')
                ->orderby('id', 'desc');
                $query->where('assets_area.del_flag', 1)->where('assets_area.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = AreaModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.area.listing');
    }
    public function assetarea_addd()
    {

        return view('asset.area.add');
      
    }
    
     public function submit_assetarea(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;  
        $check = $this->check_exists($request->name,'name','assets_area');
        if($check<1)
        {
             $data = [
                'name' =>$request->name,
                'description' =>$request->description,
                'branch' => $branch
                  ];      
                $area = AreaModel::updateOrCreate(['id'=>$postID],$data);
                $areaid = $area->id;
                return 'true';
        }
        else
        {
            return 'false';
        }   
       
                               
    }
    
    public function editassetarea(Request $request)
    {
        $id = $request->id;
        $areas = DB::table('assets_area')->select('assets_area.*')->where('assets_area.id',$id)->get();
        return view('asset.area.edit',compact('areas'));
      
    }
    public function departmentlisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_department')
                ->select('assets_department.*')
                ->orderby('id', 'desc');
                $query->where('assets_department.del_flag', 1)->where('assets_department.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = AreaModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.department.listing');
    }
    public function assetdepartment_addd()
    {

        return view('asset.department.add');
      
    }
    
    public function submit_assetdepartment(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;  
         $check = $this->check_exists($request->name,'name','assets_department');
        if($check<1)
        {
            $data = [
                'name' =>$request->name,
                'description' =>$request->description,
                'branch' => $branch
                  ];      
                $area = DepartmentModel::updateOrCreate(['id'=>$postID],$data);
                $areaid = $area->id;
                return 'true';
        }
        else
        {
            return 'false';
        }  
        
                               
    }
    
    public function editassetdepartment(Request $request)
    {
        $id = $request->id;
        $department = DB::table('assets_department')->select('assets_department.*')->where('assets_department.id',$id)->get();
        return view('asset.department.edit',compact('department'));
      
    }
    public function componentslisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_components')
                ->select('assets_components.*')
                ->orderby('id', 'desc');
                $query->where('assets_components.del_flag', 1);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ComponentModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.component.listing');
    }
    public function assetcomponent_addd()
    {

        return view('asset.component.add');
      
    }
    public function submit_assetcomponent(Request $request)
    {
        // $user_id = Auth::user()->id;
       
        $branch=Session::get('branch');
        $postID = $request->id;     
        $data = [
                'component_name' =>$request->name,
                'component_date' =>$request->componentdate,
                'reminderdays' => $request->days
                  ];      
                $component = ComponentModel::updateOrCreate(['id'=>$postID],$data);
                $componentid = $component->id;
                return 'true';
                               
    }
    public function partslisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_parts')
                ->select('assets_parts.*')
                ->orderby('id', 'desc');
                $query->where('assets_parts.del_flag', 1);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = PartsModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.parts.listing');
    }
    public function assetparts_addd()
    {

        return view('asset.parts.add');
      
    }
    public function submit_assetparts(Request $request)
    {

        // $user_id = Auth::user()->id;
       $branch=Session::get('branch');
        $postID = $request->id;     
        $data = [
                'part_name' =>$request->name,
                'part_date' =>$request->partdate,
                'reminderdays' => $request->days
                
                  ];  

                $parts = PartsModel::updateOrCreate(['id'=>$postID],$data);
                $partsid = $parts->id;
                return 'true';
                               
    }
    public function projectlisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_projects')
                ->select('assets_projects.*')
                ->orderby('id', 'desc');
                $query->where('assets_projects.del_flag', 1);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProjectModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.project.listing');
    }
    public function assetproject_addd()
    {

        return view('asset.project.add');
      
    }
    public function submit_assetproject(Request $request)
    {
        // $user_id = Auth::user()->id;
       $branch=Session::get('branch');
        $postID = $request->id;     
        $data = [
                'project_name' =>$request->name,
                  ];      
                $project = ProjectModel::updateOrCreate(['id'=>$postID],$data);
                $projectid = $project->id;
                return 'true';
                               
    }
    public function unitlisting(Request $request)
    {
           $branch=Session::get('branch');

            if ($request->ajax()) {
            $query  = UnitModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    return view('asset.unit.listing');
    }
    public function assetunit_addd()
    {
        $branch=Session::get('branch');

        $parent_unit=UnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->where('branch',$branch)->get();
        return view('asset.unit.add',compact('parent_unit','branch'));
      
    }
     public function assetunitSubmit(Request $request)
    {
         $branch=Session::get('branch');
         

        $prounit_id = $request->prounit_id;
$check = $this->check_exists($request->unit_name,'unit_name','assets_unit');
        if($check<1)
        {
             $data       = ['unit_name'  => $request->unit_name, 
                       'unit_code'  => $request->unit_code, 
                       'base_unit'  => $request->base_unit,
                       'parent_unit'=> $request->parent_unit,
                       'unit_value' => $request->unit_value,
                       'description'=> $request->description,
                       'branch'     => $branch
                      ];

        $unitid = UnitModel::updateOrCreate(['id' => $prounit_id], $data);
        return 'true';
        }
        else
        {
            return 'false';
        }
       

    
    }
    public function grouplisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_groups')
                ->select('assets_groups.*')
                ->orderby('id', 'desc');
                $query->where('assets_groups.del_flag', 1)->where('assets_groups.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = GroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.group.listing');
    }
    public function assetgroup_addd()
    {

        return view('asset.group.add');
      
    }
    
    public function submit_assetgroup(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;
        $check = $this->check_exists($request->name,'name','assets_groups');
        if($check<1)
        {
            $data = [
                'name' =>$request->name,
                'description' =>$request->description,
                'branch' => $branch
                  ];      
                $group = GroupModel::updateOrCreate(['id'=>$postID],$data);
                $groupid = $group->id;
                return 'true';
        }
        else
        {
            return 'false';
        }     
        
                               
    }
    
     public function editassetgroup(Request $request)
    {
        $id = $request->id;
        $group = DB::table('assets_groups')->select('assets_groups.*')->where('assets_groups.id',$id)->get();
        return view('asset.group.edit',compact('group'));
      
    }
    public function categorylisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_category')
                ->select('assets_category.*')
                ->orderby('id', 'desc');
                $query->where('assets_category.del_flag', 1)->where('assets_category.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = CategoryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.category.listing');
    }
    public function assetcategory_addd()
    {

        return view('asset.category.add');
      
    }
    
    public function submit_assetcategory(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;
        $check = $this->check_exists($request->name,'name','assets_category');
        if($check<1)
        {
            $data = [
                'name' =>$request->name,
                'description' =>$request->description,
                'branch' => $branch
                  ];      
                $category = CategoryModel::updateOrCreate(['id'=>$postID],$data);
                $categoryid = $category->id;
                return 'true';
        }
        else
        {
            return 'false';
        }     
        
                               
    }
    
     public function editassetcategory(Request $request)
    {
        $id = $request->id;
        $areas = DB::table('assets_category')->select('assets_category.*')->where('assets_category.id',$id)->get();
        return view('asset.category.edit',compact('areas'));
      
    }
     public function typelisting(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) {
            $query  = DB::table('assets_type')
                ->select('assets_type.*')
                ->orderby('id', 'desc');
                $query->where('assets_type.del_flag', 1)->where('assets_type.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = TypeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.type.listing');
    }
    public function assettype_addd()
    {

        return view('asset.type.add');
      
    }
    
    public function submit_assettype(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;  
        $check = $this->check_exists($request->name,'name','assets_type');
        if($check<1)
        {
            $data = [
                'name' =>$request->name,
                'description' =>$request->description,
                'branch' => $branch
                  ];      
                $type = TypeModel::updateOrCreate(['id'=>$postID],$data);
                $typeid = $type->id;
                return 'true';
        }
        else
        {
            return 'false';
        }   
        
                               
    }
    
    public function editassettype(Request $request)
    {
        $id = $request->id;
        $type = DB::table('assets_type')->select('assets_type.*')->where('assets_type.id',$id)->get();
        return view('asset.type.edit',compact('type'));
      
    }
    public function assetWarehouseList(Request $request)
    {
           $branch=Session::get('branch');

         if ($request->ajax()) 
            {
                $query  = DB::table('assets_warehouse')->leftJoin('qinventory_warehouse_manager', 'assets_warehouse.manager', '=', 'qinventory_warehouse_manager.id')
                ->leftJoin('qinventory_warehouse_incharge', 'assets_warehouse.incharge', '=', 'qinventory_warehouse_incharge.id')
                ->select('assets_warehouse.id as id','assets_warehouse.warehouse_name as warehouse_name','assets_warehouse.warehouse_code as warehouse_code','assets_warehouse.address_1 as address_1','assets_warehouse.phone as phone','assets_warehouse.email as email','qinventory_warehouse_manager.manager_name as manager','qinventory_warehouse_incharge.incharge_name as incharge')
                ->orderby('id', 'desc');
                $query->where('assets_warehouse.del_flag', 1)->where('assets_warehouse.branch',$branch);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = WarehouselistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }

         return view('asset.warehouse.listing');
    }
    public function assetwarehouse_addd()
    {
           $branch=Session::get('branch');

        $countries = CountrieslistModel::all();
        $manager   = WarehousemanagerslistModel::select('id','manager_name')->where('del_flag',1)->where('branch',$branch)->get();
        $incharge  = WarehouseinchargeModel::select('id','incharge_name')->where('del_flag',1)->where('branch',$branch)->get();

        return view('asset.warehouse.add',compact('countries','manager','incharge','branch'));
        

    }
     public function assetwarehouse_submit(Request $request)
    {
       
      $branch = $request->branch;
        $postID = $request->id;
if($request->checkedValue == "true")
{
    $value = 1;
     WarehouselistModel::where('branch',$branch)->update(['warehouse_default' => 0]);
   
}
else
{
    $value = 0;
}
$check = $this->check_exists($request->warehousename,'warehouse_name','assets_warehouse');
        if($check<1)
        {
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
                    'branch'         => $branch,
                    'warehouse_default'=> $value
            
                 ];
                 // dd($data);

        $userInfo = WarehouselistModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
            }
            else
            {
                return 'false';
            }
       
    
    }
     public function assetStoreManagement(Request $request)
    {
           $branch=Session::get('branch');

        if ($request->ajax()) {
            $query =  DB::table('assets_store_management')->leftJoin('qinventory_warehouse', 'assets_store_management.warehouse', '=', 'qinventory_warehouse.id')->leftJoin('qinventory_storeincharge', 'assets_store_management.store_incharge', '=', 'qinventory_storeincharge.id')->leftJoin('qinventory_storekeepers', 'assets_store_management.store_keeper', '=', 'qinventory_storekeepers.id')->leftJoin('qinventory_storemanagers', 'assets_store_management.store_manager', '=', 'qinventory_storemanagers.id')->select('assets_store_management.*', 'qinventory_warehouse.warehouse_name','qinventory_storeincharge.name as incharge','qinventory_storekeepers.name as keeper','qinventory_storemanagers.name as manager')->orderby('assets_store_management.id', 'desc');
            $query->where('assets_store_management.del_flag',1)->where('assets_store_management.branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = StoremanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('asset.store.listing');
    }
    public function assetstore_addd()
    {
           $branch=Session::get('branch');

        $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $manager   = StoremanagersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $keeper   = StorekeepersModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
        $incharge   = StoreinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
         return view('asset.store.add',compact('warehouse','manager','keeper','incharge','branch'));
    }

     public function assetstoremanagement_submit(Request $request)
    {
        // dd($request);
        $branch = $request->branch;
        $postID = $request->id;
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
                    'warehouse'               => $request->warehouse,
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
    public function assetRackManagement(Request $request)
    {
           $branch=Session::get('branch');

        if ($request->ajax()) {
            $query  = DB::table('assets_rack_management')->leftJoin('qinventory_warehouse','assets_rack_management.warehouse', '=', 'qinventory_warehouse.id')
                ->leftJoin('qinventory_store_management', 'assets_rack_management.store', '=', 'qinventory_store_management.id')
                ->leftJoin('qinventory_rackincharge', 'assets_rack_management.rack_in_charge', '=', 'qinventory_rackincharge.id')
                ->leftJoin('qinventory_rackmanagers', 'assets_rack_management.rack_manager', '=', 'qinventory_rackmanagers.id')
                ->select('qinventory_warehouse.warehouse_name as name','qinventory_store_management.store_name as storename','assets_rack_management.id as id', 'assets_rack_management.rack_name as rack_name', 'qinventory_rackmanagers.name as rack_manager', 'qinventory_rackincharge.name as incharge')
                ->orderby('id', 'desc');
            $query->where('assets_rack_management.del_flag', 1)->where('assets_rack_management.branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = RackmanagementlistModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('asset.rack.listing');
    }
    public function assetrack_addd()
    {
           $branch=Session::get('branch');

         $warehouse = WarehouselistModel::select('id','warehouse_name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $store = StoremanagementlistModel::select('id','store_name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $rackmanager = RackmanagerModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
            $rackincharge = RackinchargeModel::select('id','name')->Where('del_flag', 1)->where('branch',$branch)->get();
         return view('asset.rack.add',compact('warehouse','store','branch','rackmanager','rackincharge'));
    }
     public function assetrackmanagement_submit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->id;
       
if($request->checkedValue == "true")
{
    $value = 1;
     RackmanagementlistModel::where('branch',$branch)->update(['rack_default' => 0]);
   
}
else
{
    $value = 0;
}
        $data = [
                    'warehouse'          => $request->warehouse,
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
    public function check_exists($value,$field,$table)
     {
           $branch=Session::get('branch');

        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->where('branch',$branch)->get();
        
         return $query->count();
     }
    
    
    
    
}

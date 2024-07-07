<?php
namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use DB;
use App\inventory\BrandModel;
use Spatie\Activitylog\Models\Activity;
use PDF;
use App\inventory\vendor;
use DataTables;
use Session;
class BrandController extends Controller
{
     /**
     * Display a listing of Various brands.
     */
  
    public function BrandListing(Request $request)
    {
    $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
           $branch=Session::get('branch');
         if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query  = DB::table('qinventory_brand')->leftJoin('qcrm_vendors', 'qinventory_brand.vendor', '=', 'qcrm_vendors.id')
                ->select('qinventory_brand.id as id','qinventory_brand.brand_name as brand_name','qinventory_brand.brand_code as brand_code','qinventory_brand.logo as logo','qcrm_vendors.vendor_name as vendor')
                ->orderby('id', 'desc');
                $query->where('qinventory_brand.del_flag', 1);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BrandModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('logo', function ($row) {
                return $row->logo;
            })->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action','logo'])->make(true);
            }
            else
            {
                $query  = DB::table('qinventory_brand')->leftJoin('qcrm_vendors', 'qinventory_brand.vendor', '=', 'qcrm_vendors.id')
                ->select('qinventory_brand.id as id','qinventory_brand.brand_name as brand_name','qinventory_brand.brand_code as brand_code','qinventory_brand.logo as logo','qcrm_vendors.vendor_name as vendor')
                ->orderby('id', 'desc');
                $query->where('qinventory_brand.del_flag', 1)->where('qinventory_brand.branch',$branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BrandModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('logo', function ($row) {
                return $row->logo;
            })->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action','logo'])->make(true);
            }
            
        }
         return view('inventory.brand.listing');
    }
    /**
     * Add New brand Form.
    */
    public function NewBrand()
    {
           $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $vendor = vendor::select('id','vendor_name')->get();
    }
    else
    {
        $vendor = vendor::select('id','vendor_name')->where('branch',$branch)->get();
    }
         
         return view('inventory.brand.add',compact('vendor','branch'));
    }
    /**
     *  Trash brand list.
     */
    public function brandtrashlist(Request $request)
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
        $query  = DB::table('qinventory_brand')->leftJoin('qcrm_vendors', 'qinventory_brand.vendor', '=', 'qcrm_vendors.id')
                ->select('qinventory_brand.id as id','qinventory_brand.brand_name as brand_name','qinventory_brand.brand_code as brand_code','qinventory_brand.logo as logo','qcrm_vendors.vendor_name as vendor')
                ->orderby('id', 'desc');
                $query->where('qinventory_brand.del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BrandModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        print_r($data);
    }
    else
    {
        $query  = DB::table('qinventory_brand')->leftJoin('qcrm_vendors', 'qinventory_brand.vendor', '=', 'qcrm_vendors.id')
                ->select('qinventory_brand.id as id','qinventory_brand.brand_name as brand_name','qinventory_brand.brand_code as brand_code','qinventory_brand.logo as logo','qcrm_vendors.vendor_name as vendor')
                ->orderby('id', 'desc');
                $query->where('qinventory_brand.del_flag', 0)->where('qinventory_brand.branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = BrandModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        print_r($data);
    }
            
        }
         return view('inventory.brand.trash');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editbrand(Request $request)
    {
           $branch=Session::get('branch');

        $id=$request->id;
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }  
    if($common_customer_database == 1)
    {
$vendors = vendor::select('id','vendor_name')->get();
    }
    else
    {
       $vendors = vendor::select('id','vendor_name')->where('branch',$branch)->get(); 
    }
        
        $data = BrandModel::where('id',$id)->limit(1)->first();
        return view('inventory.brand.edit',['data'=>$data],compact('vendors','branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stores(Request $request)
    {
       
        $branch = $request->branch;
        $id                 = $request->id;
       
            if(isset($id)&&!empty($id)){
                 $check = $this->check_exists_edit($id,$request->brand_name,'brand_name','qinventory_brand');
            }else{
                $check = $this->check_exists($request->brand_name,'brand_name','qinventory_brand'); 
            }
        


        if($check<1)
        {
        $data               = [
                               'brand_name' =>$request->brand_name,
                               'brand_code' =>$request->brand_code,
                               'logo'       =>$request->fileData,
                               'vendor'     =>$request->vendor,
                               'description'=>$request->description,
                               'branch'     =>$branch
                              ];

        $brand = BrandModel::updateOrCreate(['id'=>$id],$data);
        return 1;
        }
        else
        {
            return 0;
        }
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        BrandModel::where('id',$id)->update(['del_flag' =>0]);
        return 'true';
    }
/**
  *restore brand details
  */
    public function restorebrand(Request $request)
    {
        $id = $request->id;
        BrandModel::where('id',$id)->update(['del_flag' =>1]);
        return 'true';
    }

    public function DeleteTrashProdctbrand(Request $request)
    {
        $id=$request->id;
        BrandModel::where('id',$id)->delete();
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         
         return $query->count();
     }

       public function check_exists_edit($id,$value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->whereNotIn('id',[$id])->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }


}

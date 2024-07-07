<?php

namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\ProductUnitModel;
use App\inventory\ProductdetailslistModel;
use DB;
use Session;
use DataTables;
use Spatie\Activitylog\Models\Activity;

class UnitController extends Controller
{

     /**
     * Display a listing of Various units.
     */

    public function UnitListing(Request $request)
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
                    $query  = ProductUnitModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
                }
                else
                {
                    $query  = ProductUnitModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
                }
            
        }
    return view('inventory.unit.listing');
    } 
    /**
     * Display a listing of deleted datas.
     */

    public function unittrash(Request $request)
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
                $query  = ProductUnitModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query  = ProductUnitModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.unit.tash');
    }    
    
    

    /**
     * Add New unit Form.
     */

    public function NewUnit()
    {
           $branch=Session::get('branch');
 $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
        $parent_unit=ProductUnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->get();
    }
    else
    {
        $parent_unit=ProductUnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->where('branch',$branch)->get();
    }
        

        // dd($parent_unit);
         return view('inventory.unit.add',compact('parent_unit','branch'));
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
    public function creates(Request $request)
    {
        $branch = $request->branch;
        $prounit_id = $request->prounit_id;
        $check = $this->check_exists($request->unit_name,'unit_name','qinventory_product_unit');
        if($check<1)
        {

       $codecheck = $this->check_exists($request->unit_code,'unit_code','qinventory_product_unit');
       
       if($codecheck<1)
        {
        $data       = ['unit_name'  => $request->unit_name, 
                       'unit_code'  => $request->unit_code, 
                       'base_unit'  => $request->base_unit,
                       'parent_unit'=> $request->parent_unit,
                       'unit_value' => $request->unit_value,
                       'description'=> $request->description,
                       'branch'     => $branch
                      ];

        $unitid = ProductUnitModel::updateOrCreate(['id' => $prounit_id], $data);
        return 1;
        } else
        {
            return 0;
        }
       
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
    public function edit_productunit(Request $request)
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
        $pro_unit = ProductUnitModel::where('id', $id)
                                ->limit(1)
                                ->first();
        $parent_units=ProductUnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->get();
    }
    else
    {
        $pro_unit = ProductUnitModel::where('id', $id)
                                ->limit(1)
                                ->first();
        $parent_units=ProductUnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->where('branch',$branch)->get();
    }
                                  
        return view('inventory.unit.edit_unit', ['datas' => $pro_unit],compact('parent_units','branch'));
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroys(Request $request)
    {
        $id=$request->id;
        ProductUnitModel::where('id',$id)->update(['del_flag'=>0]);
        return 'true';
    }
/**
 *unit details for recover datas
 */      
    public function restoreinventoryunit(Request $request)
    {
        $id=$request->id;
        ProductUnitModel::where('id',$id)->update(['del_flag'=>1]);
        return 'true';
    }
/**
 *unit details for delete for recover datas
 */  

    public function DeleteTrashProdctunits(Request $request)
    {
        // dd($request);

        $id=$request->id;

        $qinventory_products=ProductdetailslistModel::where('unit',$id)->get();
         // dd($qinventory_products);

        if($qinventory_products ==$id){

        ProductUnitModel::where('id',$id)->update(['del_flag'=>1]);

        }
        else
        {

        ProductUnitModel::where('id',$id)->delete();

        }
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}

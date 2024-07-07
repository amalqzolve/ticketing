<?php

namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\settings\ProductUnitModel;
use App\settings\ProductdetailslistModel;
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

            if ($request->ajax()) {
            $query  = ProductUnitModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    return view('settings.unit.listing');
    } 
    /**
     * Display a listing of deleted datas.
     */

    public function unittrash(Request $request)
    {
           $branch=Session::get('branch');

        if ($request->ajax()) {
            $query  = ProductUnitModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = ProductUnitModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('settings.unit.tash');
    }    
    
    

    /**
     * Add New unit Form.
     */

    public function NewUnit()
    {
           $branch=Session::get('branch');

        $parent_unit=ProductUnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->where('branch',$branch)->get();

        // dd($parent_unit);
         return view('settings.unit.add',compact('parent_unit','branch'));
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
         $branch=Session::get('branch');
         

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
        return 'true';
        } else
        {
            return 'false';
        }
       
        }
        else
        {
            return 'false';
        }

        
     
/*

 $check = $this->check_exists($request->unit_code,'unit_code','qinventory_product_unit');
        if($check<1)
        {
         $unitid = ProductUnitModel::updateOrCreate(['id' => $prounit_id], $data);
        return 'true';
        }
        else
        {
            return 'false';
        }
*/
        
       

        
      
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
        $pro_unit = ProductUnitModel::where('id', $id)
                                ->limit(1)
                                ->first();
        $parent_units=ProductUnitModel::select('unit_name','id')->where('base_unit',1)->where('del_flag',1)->where('branch',$branch)->get();                          
        return view('settings.unit.edit_unit', ['datas' => $pro_unit],compact('parent_units','branch'));
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
        $query = DB::table('qsales_deliveryorder_products')->select('unit')->where('unit',$id)->where('del_flag',1)->get();
        $no = $query->count();
        $query1 = DB::table('qsales_invoiceorder_products')->select('unit')->where('unit',$id)->where('del_flag',1)->get();
        $no1 = $query1->count();
        $query2 = DB::table('qsales_purchasereturn_products')->select('unit')->where('unit',$id)->where('del_flag',1)->get();
        $no2 = $query2->count();
        $query3 = DB::table('qsales_quotation_products')->select('unit')->where('unit',$id)->where('del_flag',1)->get();
        $no3 = $query3->count();
        $query4 = DB::table('qsales_salesorder_products')->select('unit')->where('unit',$id)->where('del_flag',1)->get();
        $no4 = $query4->count();
        if($no > 0 || $no1 > 0 || $no2 > 0 || $no3 > 0 || $no4 > 0)
        {
            return '1';
        }
        else
        {
        ProductUnitModel::where('id',$id)->update(['del_flag'=>0]);
        return 'true';
        }
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
           $branch=Session::get('branch');

        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->where('branch',$branch)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}

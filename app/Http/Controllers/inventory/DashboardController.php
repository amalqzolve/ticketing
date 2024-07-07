<?php

namespace App\Http\Controllers\inventory;
use App\inventory\ProductdetailslistModel;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
// use Session;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
// use Spatie\Activitylog\Models\Activity;

use PDF;
use View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use App\Imports\ProductmainImport;
use App\Imports\CustomermainImport;
use App\Imports\SuppliermainImport;
use Carbon\Carbon;
use App\inventory\Product_stockModel;
// use Illuminate\Support\Facades\Auth;

use App\crm\CustomerModel;
use App\crm\SupplierModel;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    
        $products = DB::table('qinventory_products')->count();
        $brands = DB::table('qinventory_brand')->count();
        $manufacturer = DB::table('qinventory_manufacture')->count(); 
        $categories = DB::table('qinvoice_category')->count(); 
        $batches = DB::table('qpurchase_batch')->count(); 
        $units = DB::table('qinventory_product_unit')->count(); 
        return view('inventory.dashboard.index',compact('products','brands','manufacturer','categories','batches','units'));

    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    // public function view()

    // { 
    //     $product = DB::table('qinventory_products')->count();
    //     $product_del = DB::table('qinventory_products')->where('qinventory_products.del_flag',1)->count();
    //     $product_tbl_del = DB::table('qinventory_products')->where('qinventory_products.del_flag',0)->count();



    //     $warehouse = DB::table('qinventory_warehouse')->count();
    //     $warehouse_del = DB::table('qinventory_warehouse')->where('qinventory_warehouse.del_flag',1)->count();
    //     $warehouse_tbl_del = DB::table('qinventory_warehouse')->where('qinventory_warehouse.del_flag',0)->count();





    //     $store = DB::table('qinventory_store_management')->count();
    //     $store_del = DB::table('qinventory_store_management')->where('qinventory_store_management.del_flag',1)->count();
    //     $store_tbl_del = DB::table('qinventory_store_management')->where('qinventory_store_management.del_flag',0)->count();



    //     $rack = DB::table('qinventory_rack_management')->count();
    //     $rack_del = DB::table('qinventory_rack_management')->where('qinventory_rack_management.del_flag',1)->count();
    //     $rack_tbl_del = DB::table('qinventory_rack_management')->where('qinventory_rack_management.del_flag',0)->count();
    //     return view('inventory.dashboard.view',['data' => $product,'product_del'=>$product_del,'product_tbl_del'=>$product_tbl_del,'warehouse'=>$warehouse,'warehouse_del'=>$warehouse_del,'warehouse_tbl_del'=>$warehouse_tbl_del,'store'=>$store,'store_del'=>$store_del,'store_tbl_del'=>$store_tbl_del,'rack'=>$rack,'rack_del'=>$rack_del,'rack_tbl_del'=>$rack_tbl_del]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($groupID,$branch) {
     //   return 'I am group id ' . $groupID;
        Auth::loginUsingId($groupID, true);
               Session::put('branch', $branch);
      //  var_dump(Auth::user()->roles()->get()); exit();
        return redirect()->intended('/home');
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
    public function destroy($id)
    {
        //
    }
     public function changepic(Request $request)
    {
        $id = $request->id;

        return view('inventory.changepic',compact('id'));
    }
    public function submit_changepic(Request $request)
    {
        $id                 = $request->id;
       
        $data               = [
                               
                               'image'       =>$request->fileData,
                               
                              ];

        $brand          = DB::table('users')->where('id',$id)->update($data);
        return 'true';
       
    }
    public function inventorydashboard(Request $request)
    {
        $branch=Session::get('branch');

                if ($request->ajax()) 
                        {
                                $query = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.available_stock','qinventory_products.warehouse','qinventory_products.store','qinventory_products.rack')->orderby('qinventory_products.product_id', 'desc');
                                $query->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                                // $query->where('qinventory_products.product_id',NULL);
                                $data = $query->get();
                                // dd($data);
                                $count_filter = $query->count();
                                $count_total = ProductdetailslistModel::count();
                                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                                        return $row->product_id; 
                                })->rawColumns(['action'])->make(true);    
                        }
        $products = DB::table('qinventory_products')->select('id','vendor_name as name')->where('del_flag',1)->count();
        $productsenabld = DB::table('qinventory_products')->select('id','vendor_name as name')->where('del_flag',1)->where('product_status',1)->count();
         return view('inventory.dashboard.inventorydashboard',compact('products','productsenabld'));

    }

      public function product_download()
    {
       $filepath = public_path('invproducts.xlsx');
            ob_end_clean(); 
            ob_start(); 
         return response()->download($filepath, 'Products.xlsx', [
        'Content-Type' => 'application/vnd.ms-excel',
        'Content-Disposition' => 'inline; filename="Asset.xlsx"'
    ]);


      


    }



      

    
    public function exportdata()
    {
         return view('inventory.product.export');
    }

 public function submit_file(Request $request)
    {
        
        // $request->validate(['file' => 'required'], [

        // 'file.required' => 'file is required']);
Excel::import(new ProductmainImport, $request->file('file')->store('temp'));
      return redirect()->route('ProductListing')->with('message', 'State saved correctly!!!');

        
      /* Excel::import(new BoqmainImport($data), $request->file('file'));
         dd(1);*/
    }


 

     
    
}

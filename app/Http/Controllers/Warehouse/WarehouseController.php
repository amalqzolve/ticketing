<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use App\purchase\ProductPurchasedetailslistModel;
use App\inventory\ProductdetailslistModel;
use DataTables;
use App\inventory\AttributeModel;
use App\inventory\BrandModel;
use App\inventory\ManufactureModel;
use App\inventory\productcategory;
use App\inventory\Attributeoptionsmodel;
use App\inventory\ProductUnitModel;
use App\inventory\BatchlistModel;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function warehouse_select()
    {
$branch=Session::get('branch');

        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

         return view('warehouse.dashboard.select', compact('warehouses','branch'));
    }
public function stockin_history()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qwarehouse_stock_in')->select('*')->orderby('qwarehouse_stock_in.id', 'desc')->where('qwarehouse_stock_in.warehouse',$warehouse);
                              
                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            
                                
  return view('warehouse.stockin_history.index', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }


    public function stockin()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qinventory_products_purchase')
                                ->leftJoin('qinvoice_category', 'qinventory_products_purchase.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products_purchase.unit', '=', 'qinventory_product_unit.id')
                                ->select('qinventory_products_purchase.product_id','qinventory_products_purchase.product_name','qinventory_products_purchase.product_code','qinventory_products_purchase.barcode','qinventory_product_unit.unit_name as unit','qinventory_products_purchase.out_of_stock_status','qinventory_products_purchase.product_status','qinventory_products_purchase.description','qinventory_products_purchase.product_id','qinventory_products_purchase.status', 'qinvoice_category.category_name','qinventory_products_purchase.selling_price','qinventory_products_purchase.product_price','qinventory_products_purchase.part_no','qinventory_products_purchase.model_no','qinventory_products_purchase.available_stock','qinventory_products_purchase.sku','qinventory_products_purchase.purchaseid')->orderby('qinventory_products_purchase.purchaseid', 'desc')->where('qinventory_products_purchase.warehouse',$warehouse)->where('qinventory_products_purchase.available_stock' ,'>',0);
                          
                              /* $query->where('qinventory_products_purchase.purchaseid',NULL);*/
                                $products = $query->get();
                            
                                
  return view('warehouse.stockin.index', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }
   
  public function warehouse_stockin(Request $request)
     {
       $branch=Session::get('branch');
$warehouse=Session::get('warehouse');
$edit_ids=$request->ids;

 $id_arr = explode (",",$edit_ids);
/*$id_arr = array_map('intval', explode(',', $edit_ids));*/

  $purchase_products = DB::table('qinventory_products_purchase')->leftJoin('qpurchase_products', 'qinventory_products_purchase.main_product_id', '=', 'qpurchase_products.productname_id')->select('qinventory_products_purchase.*','qpurchase_products.amount','qpurchase_products.vat_amount','qpurchase_products.row_total')->whereIn('qinventory_products_purchase.product_id',$id_arr)->get();

  

 
      
  $unitlist = DB::table('qinventory_product_unit')->select('id','unit_name')->where('del_flag',1)->where('branch',$branch)->get();


   $storelist = DB::table('qinventory_store_management')->select('id','store_name')->where('del_flag',1)->where('qinventory_store_management.warehouse',$warehouse)->get();
return view('warehouse.stockin.stockin_step', compact('purchase_products','edit_ids','unitlist','storelist'));

     }

     
  public function stockin_history_view(Request $request)
     {
       $branch=Session::get('branch');
$warehouse=Session::get('warehouse');


  $purchase_products = DB::table('qwarehouse_stock_in_products')->leftJoin('qinventory_products_purchase', 'qwarehouse_stock_in_products.productname', '=', 'qinventory_products_purchase.main_product_id')->select('qwarehouse_stock_in_products.*','qinventory_products_purchase.*')->where('stock_in_id',$request->id)->get();
//join  qinventory_products_purchase



  $unitlist = DB::table('qinventory_product_unit')->select('id','unit_name')->where('del_flag',1)->where('branch',$branch)->get();


   $storelist = DB::table('qinventory_store_management')->select('id','store_name')->where('del_flag',1)->where('qinventory_store_management.warehouse',$warehouse)->get();
return view('warehouse.stockin_history.stockin_history_view', compact('purchase_products','unitlist','storelist'));

     }

 public function newstockin_submit(Request $request)
     {
    $branch=Session::get('branch');
$warehouse=Session::get('warehouse');
   $purchase_warehouse= '';
    $purchase_productname= '';
    $purchase_sku= '';
    $purchase_available_stock='';

                    $ldate = date('Y-m-d');
                    $data = [      
                        'stock_in_date'     => Carbon::parse($ldate)->format('Y-m-d'),
                        'warehouse' =>$warehouse
                        ];
                      $stock_in_object =DB::table('qwarehouse_stock_in')->insert($data);

                         $stock_in_id =DB::getPdo()->lastInsertId();

     for ($i = 0; $i < count($request->pnameid); $i++)
                 {

$purchase_id=$request->purchase[$i];

$purchase_product = DB::table('qinventory_products_purchase')->select('*')->where('product_id',$request->pnameid[$i])->get();
foreach ($purchase_product as $key => $value) {
    $purchase_product_id= $value->product_id;
    $purchase_warehouse= $value->warehouse;
    $purchase_productname= $value->product_name;
    $purchase_sku= $value->sku;
    $purchase_available_stock= $value->available_stock;
        
}

$inventory_product = DB::table('qinventory_products')->select('*')->where('warehouse',$purchase_warehouse)->where('product_name',$purchase_productname)->where('sku',$purchase_sku)->where('branch',$branch)->get();

$inventory_available_stock= '';
$inventory_product_id='';
foreach ($inventory_product as $key => $value) {
    $inventory_available_stock= $value->available_stock;
    $inventory_product_id= $value->product_id;
}

$inventory_productCount = DB::table('qinventory_products')->select('*')->where('warehouse',$purchase_warehouse)->where('product_name',$purchase_productname)->where('sku',$purchase_sku)->where('branch',$branch)->count();



if($inventory_productCount>0){

DB::enableQueryLog();

//update stock
   DB::table('qinventory_products')->where('product_id', $inventory_product_id)->increment('available_stock', $request->quantity[$i]);
//dd(DB::getQueryLog());

  $main_entry_id =DB::getPdo()->lastInsertId();

  //need to update store and rack
                           $data2 = [   'store' =>$request->store[$i],
                                        'rack' =>$request->rack[$i],
                                          ];
                              
DB::table('qinventory_products')->where('product_id',$inventory_product_id)->update($data2);


 $data21 = [   'stock_in_id' =>$stock_in_id,
               'productname' =>$inventory_product_id,
   ];

DB::table('qwarehouse_stock_in_products')->insert($data21);

  DB::table('qinventory_products_purchase')->where('product_id', $request->pnameid[$i])->decrement('available_stock', $request->quantity[$i]);


//history
 $data23 = [   'mdate' =>Carbon::parse($ldate)->format('Y-m-d'),
               'productname' =>$inventory_product_id,
               'mtype'=>1,
               'quantity'=>$request->quantity[$i],
               'warehouse'=>$warehouse
   ];

DB::table('qwarehouse_stock_movement')->insert($data23);
  ///


$data33 = [
                    'productname' => $inventory_product_id,
                'purchase_order_id' => $purchase_id, 
                'transaction_date' => Carbon::parse($ldate)->format('Y-m-d'),          
                'transaction_type' => 1,      
                'totalamount'     => $request->amount[$i],             
                'vatamount'         => $request->vat_amount[$i], 
                'grandtotalamount' => $request->row_total[$i],
                'warehouse'   => $warehouse
                                 ];  
                $history = DB::table('qwarehouse_transaction_history')->insert($data33);






}else{
  
foreach ($purchase_product as $key => $value) {

    $data = [      
                        'product_type' =>1,
                        'product_name' =>$value->product_name,
                        'category' =>$value->category,         
                        'unit' =>$value->unit, 
                        'product_code' =>$value->product_code, 
                        'sku' =>$value->sku, 
                        'barcode' =>$value->barcode, 
                        'barcode_format' =>$value->barcode_format, 
                        'available_stock' =>$request->quantity[$i], 
                        'product_price' =>$value->product_price,
                        'product_status' =>1, 
                        'out_of_stock_status' =>1,  
                        'provider' =>$value->provider, 
                        'provider_id' =>$value->provider_id, 
                        'description' =>$value->description, 
                        'opening_stock' =>$value->opening_stock, 
                        'enable_minus_stock_billing' =>$value->enable_minus_stock_billing, 
                        'reorder_quantity_alert' =>$value->reorder_quantity_alert, 
                        'reorder_quantity' =>$value->reorder_quantity, 
                        'inventory_type' =>$value->inventory_type,
                        'refundable' =>$value->refundable, 
                        'manufacturer' =>$value->manufacturer, 
                        'brand' =>$value->brand, 
                        'serial_number' =>$value->serial_number,
                        'model_no' =>$value->model_no, 
                        'part_no' =>$value->part_no, 
                        'hsn_code' =>$value->hsn_code, 
                        'maintain_batches' =>$value->maintain_batches, 
                        'batch_name' =>$value->batch_name, 
                        'manufacturing_date'     => Carbon::parse($value->manufacturing_date)->format('Y-m-d'),  

                        'expiry_date'     => Carbon::parse($value->expiry_date)->format('Y-m-d'),  

                        'expiry_reminder'     => $value->expiry_reminder, 

                        'warranty_date'     => Carbon::parse($value->warranty_date)->format('Y-m-d'), 

                        'warranty_reminder' => $value->warranty_reminder,  


                        'upc' =>$value->upc, 
                        'ean' =>$value->ean, 
                        'jan' =>$value->jan,
                        'isbn' =>$value->isbn,
                        'mpn' =>$value->mpn,
                        'image' =>$value->image,
                        'branch' =>$value->branch,
                        'selling_price'=> $value->selling_price,
                        'lotno'=> $value->lotno,
                        'shelflife'=>$value->shelflife,
                        'countryoforigin'=>$value->countryoforigin,
                        'cfds'=>$value->cfds,
                        'reference'=>$value->reference,
                        'catno'=>$value->catno,
                        'warehouse'=>$warehouse,
                        'store' =>$request->store[$i],
                        'rack' =>$request->rack[$i]
                         ];
                         $product_object =DB::table('qinventory_products')->insert($data);
                              $main_entry_id =DB::getPdo()->lastInsertId();
                              
                              $data12 = ['main_product_id' =>$main_entry_id  ];

                          DB::table('qinventory_products')->where('product_id',$main_entry_id)->update($data12);
                          

                            
                  DB::table('qinventory_products_purchase')->where('product_id', $request->pnameid[$i])->decrement('available_stock', $request->quantity[$i]);

/*
 $data2 = [   'available_stock' =>2  ];
 DB::table('qinventory_products_purchase')->where('product_id',$purchase_product_id)->update($data2);*/



 $data21 = [   'stock_in_id' =>$stock_in_id,
               'productname' =>$value->product_name,
   ];

DB::table('qwarehouse_stock_in_products')->insert($data21);

//history
 $data23 = [   'mdate' =>Carbon::parse($ldate)->format('Y-m-d'),
               'productname' =>$value->product_name,
               'mtype'=>1,
               'quantity'=>$request->quantity[$i],
               'warehouse'=>$warehouse
   ];

DB::table('qwarehouse_stock_movement')->insert($data23);

$data33 = [
                    'productname' => $value->product_name,
                'purchase_order_id' => $purchase_id, 
                'transaction_date' => Carbon::parse($ldate)->format('Y-m-d'),          
                'transaction_type' => 1,      
                 'totalamount'     => $request->amount[$i],             
                'vatamount'         => $request->vat_amount[$i], 
                'grandtotalamount' => $request->row_total[$i],
                'warehouse'   => $warehouse
                                 ];  
                $history = DB::table('qwarehouse_transaction_history')->insert($data33);

  ///

                              
}





}


}
  //    stock_in_date   warehouse


return 'true';

 

                    }
    
  

/* public function warehouse_stockin(Request $request)
     {
     
    $branch=Session::get('branch');
$warehouse=Session::get('warehouse');
$edit_ids=$request->ids;

  $id_arr = explode (",",$edit_ids);

      $purchase_warehouse= '';
    $purchase_productname= '';
    $purchase_sku= '';
    $purchase_available_stock='';



                    $ldate = date('Y-m-d');
                    $data = [      
                        'stock_in_date'     => Carbon::parse($ldate)->format('Y-m-d'),
                        'warehouse' =>$warehouse
                        ];
                      $stock_in_object =DB::table('qwarehouse_stock_in')->insert($data);

                         $stock_in_id =DB::getPdo()->lastInsertId();


                              ////////

foreach ($id_arr as $id) {

$purchase_product = DB::table('qinventory_products_purchase')->select('*')->where('product_id',$id)->get();
foreach ($purchase_product as $key => $value) {
    $purchase_product_id= $value->product_id;
    $purchase_warehouse= $value->warehouse;
    $purchase_productname= $value->product_name;
    $purchase_sku= $value->sku;
    $purchase_available_stock= $value->available_stock;
        
}

$inventory_product = DB::table('qinventory_products')->select('*')->where('warehouse',$purchase_warehouse)->where('product_name',$purchase_productname)->where('sku',$purchase_sku)->where('branch',$branch)->get();

$inventory_available_stock= '';
$inventory_product_id='';
foreach ($inventory_product as $key => $value) {
    $inventory_available_stock= $value->available_stock;
    $inventory_product_id= $value->product_id;
}

$inventory_productCount = DB::table('qinventory_products')->select('*')->where('warehouse',$purchase_warehouse)->where('product_name',$purchase_productname)->where('sku',$purchase_sku)->where('branch',$branch)->count();



if($inventory_productCount>0){

//update stock
   DB::table('qinventory_products')->where('product_id', $inventory_product_id)->increment('available_stock', $purchase_available_stock);
  $main_entry_id =DB::getPdo()->lastInsertId();
                              $data2 = [   'status' =>2  ];
                              
DB::table('qinventory_products_purchase')->where('product_id',$purchase_product_id)->update($data2);


 $data21 = [   'stock_in_id' =>$stock_in_id,
               'productname' =>$inventory_product_id,
   ];

DB::table('qwarehouse_stock_in_products')->insert($data21);





}else{
  
foreach ($purchase_product as $key => $value) {

    $data = [      
                        'product_type' =>1,
                        'product_name' =>$value->product_name,
                        'category' =>$value->category,         
                        'unit' =>$value->unit, 
                        'product_code' =>$value->product_code, 
                        'sku' =>$value->sku, 
                        'barcode' =>$value->barcode, 
                        'barcode_format' =>$value->barcode_format, 
                        'available_stock' =>$value->available_stock, 
                        'product_price' =>$value->product_price,
                        'product_status' =>1, 
                        'out_of_stock_status' =>1,  
                        'provider' =>$value->provider, 
                        'provider_id' =>$value->provider_id, 
                        'description' =>$value->description, 
                        'opening_stock' =>$value->opening_stock, 
                        'enable_minus_stock_billing' =>$value->enable_minus_stock_billing, 
                        'reorder_quantity_alert' =>$value->reorder_quantity_alert, 
                        'reorder_quantity' =>$value->reorder_quantity, 
                        'inventory_type' =>$value->inventory_type,
                        'refundable' =>$value->refundable, 
                        'manufacturer' =>$value->manufacturer, 
                        'brand' =>$value->brand, 
                        'serial_number' =>$value->serial_number,
                        'model_no' =>$value->model_no, 
                        'part_no' =>$value->part_no, 
                        'hsn_code' =>$value->hsn_code, 
                        'maintain_batches' =>$value->maintain_batches, 
                        'batch_name' =>$value->batch_name, 
                        'manufacturing_date'     => Carbon::parse($value->manufacturing_date)->format('Y-m-d'),  

                        'expiry_date'     => Carbon::parse($value->expiry_date)->format('Y-m-d'),  

                        'expiry_reminder'     => $value->expiry_reminder, 

                        'warranty_date'     => Carbon::parse($value->warranty_date)->format('Y-m-d'), 

                        'warranty_reminder' => $value->warranty_reminder,  


                        'upc' =>$value->upc, 
                        'ean' =>$value->ean, 
                        'jan' =>$value->jan,
                        'isbn' =>$value->isbn,
                        'mpn' =>$value->mpn,
                        'image' =>$value->image,
                        'branch' =>$value->branch,
                        'selling_price'=> $value->selling_price,
                        'lotno'=> $value->lotno,
                        'shelflife'=>$value->shelflife,
                        'countryoforigin'=>$value->countryoforigin,
                        'cfds'=>$value->cfds,
                        'reference'=>$value->reference,
                        'catno'=>$value->catno,
                        'warehouse'=>$value->warehouse

                                 ];
                              $product_object =DB::table('qinventory_products')->insert($data);
                              $main_entry_id =DB::getPdo()->lastInsertId();
                              
                              $data12 = ['main_product_id' =>$main_entry_id  ];

                          DB::table('qinventory_products')->where('product_id',$main_entry_id)->update($data12);
                          

                              $data2 = [   'status' =>2  ];
                              

DB::table('qinventory_products_purchase')->where('product_id',$purchase_product_id)->update($data2);



 $data21 = [   'stock_in_id' =>$stock_in_id,
               'productname' =>$value->product_name,
   ];

DB::table('qwarehouse_stock_in_products')->insert($data21);


                              
}





}


}
  //    stock_in_date   warehouse


return redirect()->route('stockin');

     

  }*/
   
       public function stockout()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qwarehouse_stock_out')
                                ->leftJoin('qwarehouse_stock_out_products', 'qwarehouse_stock_out.id', '=', 'qwarehouse_stock_out_products.stock_out_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_stock_out.prepared_by', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qwarehouse_stock_out.approved_by', '=', 's2.id')
                                ->select('qwarehouse_stock_out.id as id','qwarehouse_stock_out.*','qwarehouse_stock_out_products.*','s1.name as preparedby','s2.name as approvedby',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_stock_out_products.stock_out_id')->where('qwarehouse_stock_out.warehouse',$warehouse);
                         

                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            
                                
  return view('warehouse.stockout.index', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }  


   public function newstock_adjustment()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();

     return view('warehouse.stock_adjustment.add', compact('warehouse','branch','salesmen'));

    
}else{

  return $this->warehouse_select();
}
  }


   public function newstockout()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();

     return view('warehouse.stockout.add', compact('warehouse','branch','salesmen'));

    
}else{

  return $this->warehouse_select();
}
  }


 public function stockoutsubmit(Request $request)
     {
     
$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');

  $data = [      
                        'out_date'     => Carbon::parse($request->out_date)->format('Y-m-d'),
                        'reason' =>$request->product_name,
                        'notes' =>$request->notes,         
                        'prepared_by' =>$request->prepared_by, 
                        'approved_by' =>$request->approved_by, 
                        'out_status' =>$request->reason, 
                        'warehouse' =>$warehouse,
                        'branch' =>$branch,  
                        
                                 ];
                              $product_object =DB::table('qwarehouse_stock_out')->insert($data);
                              $main_entry_id =DB::getPdo()->lastInsertId();
                              
   for ($i = 0; $i < count($request->productname); $i++)
                 {
                    
                 $data = [
                'stock_out_id' => $main_entry_id,        
                'productname' => $request->productname[$i],                     
                'existing_quantity'   => $request->existing_quantity[$i],  
                'stock_out_quantity'   => $request->stock_out_quantity[$i], 
                'material_status'   => $request->reason, 
                'warehouse'   =>$warehouse  

           
                 ];      
                DB::table('qwarehouse_stock_out_products')->insert($data);
                 DB::table('qinventory_products')->where('product_id', $request->productname[$i])->decrement('available_stock', $request->stock_out_quantity[$i]);


                 //history
 $data23 = [   'mdate' =>Carbon::parse($request->out_date)->format('Y-m-d'),
               'productname' => $request->productname[$i],
               'mtype'=>2,
               'quantity'=>$request->stock_out_quantity[$i],
               'warehouse'=>$warehouse
   ];

DB::table('qwarehouse_stock_movement')->insert($data23);
  ///



                
                 } 

     return 'true';

     
     
     }

     
public function stock_adjustsubmit(Request $request)
     {
     
$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');

  $data = [      
                        'adjustment_date'     => Carbon::parse($request->adjustment_date)->format('Y-m-d'),
                        'reason' =>$request->product_name,       
                        'adjustedby' =>$request->adjustedby,  
                        'warehouse' =>$warehouse,
                        'branch' =>$branch,  
                        
                                 ];
                              $product_object =DB::table('qwarehouse_stock_adjustment')->insert($data);
                              $main_entry_id =DB::getPdo()->lastInsertId();
                              
   for ($i = 0; $i < count($request->productname); $i++)
                 {
                    
                 $data = [
                'stock_adjustment_id' => $main_entry_id,        
                'productname' => $request->productname[$i],                     
                'existing_quantity'   => $request->existing_quantity[$i],  
                'stock_adjust_quantity'   => $request->stock_adjust_quantity[$i], 
                'atype'   =>$request->atype[$i], 
                'warehouse'   =>$warehouse  

           
                 ];      
                DB::table('qwarehouse_stock_adjustment_products')->insert($data);


if($request->atype[$i]=='1'){
DB::table('qinventory_products')->where('product_id', $request->productname[$i])->increment('available_stock', $request->stock_adjust_quantity[$i]);
}else{ 
   DB::table('qinventory_products')->where('product_id', $request->productname[$i])->decrement('available_stock', $request->stock_adjust_quantity[$i]); 
}
  



                ///
                
                 } 




     return 'true';

     
     
     }



public function stock_adjust_list()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qwarehouse_stock_adjustment')
                                ->leftJoin('qwarehouse_stock_adjustment_products', 'qwarehouse_stock_adjustment.id', '=', 'qwarehouse_stock_adjustment_products.stock_adjustment_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_stock_adjustment.adjustedby', '=', 's1.id')
                                ->select('qwarehouse_stock_adjustment.id as id','qwarehouse_stock_adjustment.*','qwarehouse_stock_adjustment_products.*','s1.name as adjustedby',DB::raw('SUM(stock_adjust_quantity) as total'),DB::raw('SUM(CASE WHEN atype = 1 THEN qwarehouse_stock_adjustment_products.stock_adjust_quantity END) plus'),DB::raw('SUM(CASE WHEN atype = 2 THEN qwarehouse_stock_adjustment_products.stock_adjust_quantity END) minus'))->groupBy('qwarehouse_stock_adjustment_products.stock_adjustment_id')->where('qwarehouse_stock_adjustment.warehouse',$warehouse);
                        

                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            
                                
  return view('warehouse.stock_adjustment.index', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }  

      public function stocktransfer()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qwarehouse_stock_transfer')
                                ->leftJoin('qwarehouse_stock_transfer_products', 'qwarehouse_stock_transfer.id', '=', 'qwarehouse_stock_transfer_products.stock_transfer_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_stock_transfer.prepared_by', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qwarehouse_stock_transfer.approved_by', '=', 's2.id')->leftJoin('qinventory_warehouse', 'qwarehouse_stock_transfer.transfer_warehouse', '=', 'qinventory_warehouse.id')
                                ->select('qwarehouse_stock_transfer.id as id','qwarehouse_stock_transfer.*','qwarehouse_stock_transfer_products.*','s1.name as preparedby','qinventory_warehouse.warehouse_name as transfer_warehouse2','s2.name as approvedby',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_stock_transfer_products.stock_transfer_id')->where('qwarehouse_stock_transfer.warehouse',$warehouse);
                         






                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            
                                
  return view('warehouse.stocktransfer.index', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }  

     
public function newstocktransfer()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){
$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();

     return view('warehouse.stocktransfer.add', compact('warehouse','branch','salesmen','warehouses'));

    
}else{

  return $this->warehouse_select();
}
  }



public function newstocktransfer_byrequest(Request $request)
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
        $id=$request->id;
//dd($warehouse);
if(session()->has('warehouse')){
$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();
  $query = DB::table('qwarehouse_stock_transfer_request')
                                ->leftJoin('qwarehouse_stock_transfer_request_products', 'qwarehouse_stock_transfer_request.id', '=', 'qwarehouse_stock_transfer_request_products.request_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_stock_transfer_request.requestedby', '=', 's1.id')->leftJoin('qinventory_warehouse', 'qwarehouse_stock_transfer_request.warehouse', '=', 'qinventory_warehouse.id')
                                ->select('qwarehouse_stock_transfer_request.id as id','qwarehouse_stock_transfer_request.*','qwarehouse_stock_transfer_request_products.*','s1.name as requestedby','qinventory_warehouse.warehouse_name as transfer_warehouse2','qwarehouse_stock_transfer_request.rwarehouse as rwarehouse',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_stock_transfer_request_products.request_id')->where('qwarehouse_stock_transfer_request.warehouse',$warehouse);
                         






                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();

 $pproducts = DB::table('qwarehouse_stock_transfer_request_products')->leftJoin('qinventory_products', 'qwarehouse_stock_transfer_request_products.productname', '=', 'qinventory_products.product_id')->select('qwarehouse_stock_transfer_request_products.*','qinventory_products.*')->where('qwarehouse_stock_transfer_request_products.request_id',$id)->get();
                       
                 
  $all_products = DB::table('qinventory_products')->select('qinventory_products.*')->get();
//dd($pproducts);


     return view('warehouse.stocktransfer.add_byrequest', compact('warehouse','branch','salesmen','warehouses','pproducts','products','all_products'));

    
}else{

  return $this->warehouse_select();
}
  }

 public function stocktransfersubmit(Request $request)
     {
     
$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');

  $data = [      
                        'transfer_date'     => Carbon::parse($request->out_date)->format('Y-m-d'),
                        'requested_by' =>$request->requested_by,
                        'notes' =>$request->notes,         
                        'prepared_by' =>$request->prepared_by, 
                        'approved_by' =>$request->approved_by, 
                        'warehouse' =>$warehouse,
                        'transfer_warehouse' =>$request->warehouse,
                        'branch' =>$branch,  
                        
                                 ];
                              $product_object =DB::table('qwarehouse_stock_transfer')->insert($data);
                              $main_entry_id =DB::getPdo()->lastInsertId();
                              
   for ($i = 0; $i < count($request->productname); $i++)
                 {
                    
                 $data = [
                'stock_transfer_id' => $main_entry_id,        
                'productname' => $request->productname[$i],                     
              //  'existing_quantity'   => $request->existing_quantity[$i],  
                'stock_out_quantity'   => $request->stock_out_quantity[$i],         
           
                 ];      
                DB::table('qwarehouse_stock_transfer_products')->insert($data);

                /////////////

                 $old_quote = DB::table('qinventory_products')->select('qinventory_products.*')->where('product_id',$request->productname[$i])->get();
                    foreach ($old_quote as $key => $value) 
                    {
                     $old_product_id=$value->product_id;
                         $data = [   
                        'purchaseid' =>'',
                        'product_type' =>1,
                        'product_name' =>$value->product_name,
                        'category' =>$value->category,         
                        'unit' =>$value->unit, 
                        'product_code' =>$value->product_code, 
                        'sku' =>$value->sku, 
                        'barcode' =>$value->barcode, 
                        'barcode_format' =>$value->barcode_format, 
                        'available_stock' =>$request->stock_out_quantity[$i], 
                        'product_price' =>$value->product_price,
                        'product_status' =>1, 
                        'out_of_stock_status' =>1,  
                        // 'provider' =>$value->sup_vendor, 
                        'provider_id' =>$value->provider_id, 
                        'description' =>$value->description, 
                        'opening_stock' =>$value->opening_stock, 
                        'enable_minus_stock_billing' =>$value->enable_minus_stock_billing, 
                        'reorder_quantity_alert' =>$value->reorder_quantity_alert, 
                        'reorder_quantity' =>$value->reorder_quantity, 
                        'inventory_type' =>$value->inventory_type,
                        'refundable' =>$value->refundable, 
                        'manufacturer' =>$value->manufacturer, 
                        'brand' =>$value->brand, 
                        'serial_number' =>$value->serial_number,
                        'model_no' =>$value->model_no, 
                        'part_no' =>$value->part_no, 
                        'hsn_code' =>$value->hsn_code, 
                        'maintain_batches' =>$value->maintain_batches, 
                        'batch_name' =>$value->batch_name, 
                        'manufacturing_date'     => Carbon::parse($value->manufacturing_date)->format('Y-m-d'),  

                        'expiry_date'     => Carbon::parse($value->expiry_date)->format('Y-m-d'),  

                        'expiry_reminder'     => $value->expiry_reminder, 

                        'warranty_date'     => Carbon::parse($value->warranty_date)->format('Y-m-d'), 

                        'warranty_reminder' => $value->warranty_reminder,  


                        'upc' =>$value->upc, 
                        'ean' =>$value->ean, 
                        'jan' =>$value->jan,
                        'isbn' =>$value->isbn,
                        'mpn' =>$value->mpn,
                        'image' =>$value->image,
                        'branch' =>$branch,
                        'selling_price'=> $value->selling_price,
                        'lotno'=> $value->lotno,
                        'shelflife'=>$value->shelflife,
                        'countryoforigin'=>$value->countryoforigin,
                        'cfds'=>$value->cfds,
                        'reference'=>$value->reference,
                        'catno'=>$value->catno,
                        'warehouse'=>$request->warehouse,
                        /*'costpercentage' => $request->percentage[$i],
                        'profit'=>$request->profit[$i],*/
                        'status'=>1

                                 ];


//Log::info(json_encode($data));


$product_ids = DB::table('qinventory_products_purchase')->insert($data);
$newproduct_id =DB::getPdo()->lastInsertId();
//$newproduct_id = $product_ids->product_id;
ProductPurchasedetailslistModel::where('product_id', $newproduct_id)->update(['main_product_id' => $old_product_id]);
}
////////////////////////
                
                 } 

     return 'true';

     
     
     }



public function stockMaster1()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

            $query = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')->leftJoin('qinventory_rack_management', 'qinventory_products.rack', '=', 'qinventory_rack_management.id')
                                // ->leftJoin('qinventory_products_purchase', 'qinventory_products.product_id', '=', 'qinventory_products_purchase.main_product_id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku','qinventory_store_management.store_name','qinventory_rack_management.rack_name',DB::raw("(SELECT SUM(qsales_salesorder_products.iremaining_quantity) FROM qsales_salesorder_products

                                WHERE qinventory_products.product_id = qsales_salesorder_products.itemname

                                GROUP BY qsales_salesorder_products.itemname) as so"),DB::raw("(SELECT (qinventory_products_purchase.product_price ) FROM qinventory_products_purchase

                                WHERE qinventory_products.product_id = qinventory_products_purchase.main_product_id ORDER BY qinventory_products_purchase.main_product_id DESC
       LIMIT 1 ) as sproduct_price"),DB::raw("(SELECT (qinventory_products_purchase.landing  ) FROM qinventory_products_purchase

                                WHERE qinventory_products.product_id = qinventory_products_purchase.main_product_id ORDER BY qinventory_products_purchase.main_product_id DESC
       LIMIT 1 ) as landing "),DB::raw("(SELECT (qinventory_products_purchase.selling_price  ) FROM qinventory_products_purchase

                                WHERE qinventory_products.product_id = qinventory_products_purchase.main_product_id ORDER BY qinventory_products_purchase.main_product_id DESC
       LIMIT 1 ) as selling_price ")
                               )->orderby('qinventory_products.product_id', 'desc');

                                ///

                                ///orderBy('updated_at', 'desc')
                                $query->where('qinventory_products.del_flag',1);
                                // ->where('qinventory_products.branch',$branch);
                                // $query->where('qinventory_products.product_id',NULL);
                                 $query->where('qinventory_products.warehouse',$warehouse);

                                /* ->where('qinventory_products_purchase.main_product_id',);*/

                               /*  $query->orderBy('qinventory_products_purchase.main_product_id', 'desc')->limit(1);*/

                                $products = $query->get();

// dd($products);

$group = DB::table('qinventory_products')->leftjoin('qinventory_brand','qinventory_products.brand','=','qinventory_brand.id')->select('qinventory_products.*','qinventory_brand.brand_name as groupname',DB::raw('count(*) as total'),'qinventory_brand.id as bid')->groupBy('qinventory_products.brand')->get();

        $category = DB::table('qinventory_products')->leftjoin('qinvoice_category','qinventory_products.category','=','qinvoice_category.id')->select('qinventory_products.*','qinvoice_category.category_name as categoryname',DB::raw('count(*) as total'),'qinvoice_category.id as cid')->groupBy('qinventory_products.category')->get();
    



        $unit = DB::table('qinventory_products')->leftjoin('qinventory_product_unit','qinventory_products.unit','=','qinventory_product_unit.id')->select('qinventory_products.*','qinventory_product_unit.unit_name as unitname',DB::raw('count(*) as total'),'qinventory_product_unit.id as uid')->groupBy('qinventory_products.unit')->get();


  
       


            $query1 = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku')->orderby('qinventory_products.product_id', 'desc');
                                $query1->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                                $query1->where('qinventory_products.available_stock','=',0);
                                 $query1->where('qinventory_products.warehouse',$warehouse);
     $warehouses = $query1->get();




       $query2 = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku')->orderby('qinventory_products.product_id', 'desc');
                                $query2->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                               $query2->where('qinventory_products.available_stock','<',0);
                                 $query2->where('qinventory_products.warehouse',$warehouse);

  $minus =$query2->get();



       $query3 = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku')->orderby('qinventory_products.product_id', 'desc');
                                $query3->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                               $query3->where('qinventory_products.available_stock','>',0);
                                 $query3->where('qinventory_products.warehouse',$warehouse);

  $available =$query3->get();


   /*   $locations = DB::table('assets_allocation')->leftjoin('assets_geolocation','assets_allocation.geo_location','=','assets_geolocation.id')->select('*',DB::raw('count(*) as total'),'assets_geolocation.location')->groupBy('assets_allocation.geo_location')->whereNotNull('assets_allocation.geo_location')->get();
   $project = DB::table('assets_allocation')->leftjoin('assets_projects','assets_allocation.project','=','assets_projects.id')->select('*',DB::raw('count(*) as total'),'assets_projects.project_name')->groupBy('assets_allocation.project')->whereNotNull('assets_allocation.project')->get();*/
                   
                                
  return view('warehouse.product.master', compact('products','branch','category','warehouses','unit','available','minus','group'));

    
}else{

  return $this->warehouse_select();
}
        
    }



public function warehouse_brand_view(Request $request)
    {

$id=$request->id;

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

            $query = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')->leftJoin('qinventory_rack_management', 'qinventory_products.rack', '=', 'qinventory_rack_management.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku','qinventory_store_management.store_name','qinventory_rack_management.rack_name')->orderby('qinventory_products.product_id', 'desc');
                                $query->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                              $query->where('qinventory_products.brand',$id);
                                 $query->where('qinventory_products.warehouse',$warehouse);
                                $products = $query->get();


                   
                                
  return view('warehouse.product.brand_view', compact('products'));

    
}else{

  return $this->warehouse_select();
}
        
    }

    
public function warehouse_category_view(Request $request)
    {

$id=$request->id;

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

            $query = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')->leftJoin('qinventory_rack_management', 'qinventory_products.rack', '=', 'qinventory_rack_management.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku','qinventory_store_management.store_name','qinventory_rack_management.rack_name')->orderby('qinventory_products.product_id', 'desc');
                                $query->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                              $query->where('qinventory_products.category',$id);
                                 $query->where('qinventory_products.warehouse',$warehouse);
                                $products = $query->get();


                   
                                
  return view('warehouse.product.category_view', compact('products'));

    
}else{

  return $this->warehouse_select();
}
        
    }


public function warehouse_unit_view(Request $request)
    {

$id=$request->id;

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

            $query = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')->leftJoin('qinventory_rack_management', 'qinventory_products.rack', '=', 'qinventory_rack_management.id')
                                ->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unit','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku','qinventory_store_management.store_name','qinventory_rack_management.rack_name')->orderby('qinventory_products.product_id', 'desc');
                                $query->where('qinventory_products.del_flag',1)->where('qinventory_products.branch',$branch);
                              $query->where('qinventory_products.unit',$id);
                                 $query->where('qinventory_products.warehouse',$warehouse);
                                $products = $query->get();


                   
                                
  return view('warehouse.product.unit_view', compact('products'));

    
}else{

  return $this->warehouse_select();
}
        
    }
public function stock_transfer_request()
{
 $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();

     return view('warehouse.stocktransfer.request', compact('warehouse','branch','salesmen','warehouses'));
                            
                                

    
}else{

  return $this->warehouse_select();
}
       

}




 public function stock_transfer_request_list()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                        /*        $query = DB::table('qwarehouse_stock_transfer_request')
                                ->leftJoin('qwarehouse_stock_transfer_request_products', 'qwarehouse_stock_transfer_request.id', '=', 'qwarehouse_stock_transfer_request_products.request_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_stock_transfer_request.requestedby', '=', 's1.id')->leftJoin('qinventory_warehouse', 'qwarehouse_stock_transfer_request.warehouse', '=', 'qinventory_warehouse.id')
                                ->select('qwarehouse_stock_transfer_request.id as id','qwarehouse_stock_transfer_request.*','qwarehouse_stock_transfer_request_products.*','s1.name as requestedby','qinventory_warehouse.warehouse_name as transfer_warehouse2',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_stock_transfer_request_products.request_id')->where('qwarehouse_stock_transfer_request.rwarehouse',$warehouse);
                         
*/

        $query = DB::table('qwarehouse_stock_transfer')
                                ->leftJoin('qwarehouse_stock_transfer_products', 'qwarehouse_stock_transfer.id', '=', 'qwarehouse_stock_transfer_products.stock_transfer_id')->leftJoin('qinventory_warehouse', 'qwarehouse_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                                ->select('qwarehouse_stock_transfer.id as id','qwarehouse_stock_transfer.transfer_date as request_date','qwarehouse_stock_transfer.requested_by as requestedby','qwarehouse_stock_transfer.*','qwarehouse_stock_transfer_products.*','qinventory_warehouse.warehouse_name as transfer_warehouse2',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_stock_transfer_products.stock_transfer_id')->where('qwarehouse_stock_transfer.transfer_warehouse',$warehouse);
                         




                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            
                                
  return view('warehouse.stocktransfer.request_list', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    } 





 public function stockin_request_view(Request $request)
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
        $id=$request->id;

if(session()->has('warehouse')){
DB::enableQueryLog();

                                $query = DB::table('qwarehouse_stock_transfer_products')->leftJoin('qinventory_products', 'qwarehouse_stock_transfer_products.productname', '=', 'qinventory_products.product_id')->select('qwarehouse_stock_transfer_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku')->where('qwarehouse_stock_transfer_products.stock_transfer_id',$id);
                         
                            
  

                                $products1 = $query->get();
                   /*             dd(DB::getQueryLog());
          dd($products);   */               
                                
  return view('warehouse.stocktransfer.request_list_view_products', compact('products1','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    } 


 public function transaction_history(Request $request)
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');

if(session()->has('warehouse')){
DB::enableQueryLog();

                                $query = DB::table('qwarehouse_transaction_history')->leftJoin('qinventory_products', 'qwarehouse_transaction_history.productname', '=', 'qinventory_products.product_id')->select('qwarehouse_transaction_history.*','qinventory_products.product_name')->where('qwarehouse_transaction_history.warehouse',$warehouse);
                         

  

                                $products1 = $query->get();
                   /*             dd(DB::getQueryLog());
          dd($products);   */               
                                
  return view('warehouse.stocktransfer.transaction_history', compact('products1','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    } 


public function movement_history()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qwarehouse_stock_movement')->leftJoin('qinventory_products', 'qwarehouse_stock_movement.productname', '=', 'qinventory_products.product_id')->select('qwarehouse_stock_movement.*','qinventory_products.product_name')->orderby('qwarehouse_stock_movement.id', 'desc')->where('qwarehouse_stock_movement.warehouse',$warehouse);
                              

                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            ////?
                                
  return view('warehouse.movement_history.index', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }



public function stock_status()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                              $query = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Maitenance');
                         
                            

                                $Maitenance = $query->get();
                            
                                $query1 = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Service');
                         
                            

                                $Service = $query1->get();

                                $query2 = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Service');
                         
                            

                                $Warranty = $query2->get();

                                  $query3 = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Outof Warranty');
                         
                            

                                $Outof_Warranty = $query3->get();

                                     $query4 = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Damaged');
                         
                            

                                $Damaged = $query4->get();

                                    $query5 = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Stolen');
                         
                            

                                $Stolen = $query5->get();
                                $query6 = DB::table('qwarehouse_stock_out_products')->leftJoin('qinventory_products', 'qwarehouse_stock_out_products.productname', '=', 'qinventory_products.product_id')->leftJoin('qwarehouse_stock_out', 'qwarehouse_stock_out_products.stock_out_id', '=', 'qwarehouse_stock_out.id')->select('qwarehouse_stock_out_products.*','qinventory_products.product_name' ,'qinventory_products.product_code','qinventory_products.sku','qwarehouse_stock_out.out_date')->where('qwarehouse_stock_out_products.warehouse',$warehouse)->where('qwarehouse_stock_out_products.material_status','Scrap');
                         
                            

                                $Scrap = $query6->get();







  return view('warehouse.stock_status.listing', compact('Maitenance','branch','Service','Warranty','Outof_Warranty','Damaged','Stolen','Scrap'));

    
}else{

  return $this->warehouse_select();
}
        
    }




public function expired_items()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                              $query = DB::table('qinventory_products')->select('qinventory_products.*',DB::raw("DATE_FORMAT(qinventory_products.expiry_date, '%d-%m-%Y') as expiry_date"),DB::raw("DATE_FORMAT(qinventory_products.expiry_reminder, '%d-%m-%Y') as expiry_reminder"))->where('qinventory_products.warehouse',$warehouse)->whereDate('qinventory_products.expiry_reminder', '<', Carbon::now());
                         
                            
  

                                $products1 = $query->get();
                            
                                
  return view('warehouse.stock_status.expired_items', compact('products1','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }


     public function stock_transfer_request_processed()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
//dd($warehouse);
if(session()->has('warehouse')){

                                $query = DB::table('qwarehouse_stock_transfer_request')
                                ->leftJoin('qwarehouse_stock_transfer_request_products', 'qwarehouse_stock_transfer_request.id', '=', 'qwarehouse_stock_transfer_request_products.request_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_stock_transfer_request.requestedby', '=', 's1.id')->leftJoin('qinventory_warehouse', 'qwarehouse_stock_transfer_request.warehouse', '=', 'qinventory_warehouse.id')
                                ->select('qwarehouse_stock_transfer_request.id as id','qwarehouse_stock_transfer_request.*','qwarehouse_stock_transfer_request_products.*','s1.name as requestedby','qinventory_warehouse.warehouse_name as transfer_warehouse2',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_stock_transfer_request_products.request_id')->where('qwarehouse_stock_transfer_request.warehouse',$warehouse);
                         






                                // $query->where('qinventory_products.product_id',NULL);
                                $products = $query->get();
                            
                                
  return view('warehouse.stocktransfer.request_list_processed', compact('products','branch'));

    
}else{

  return $this->warehouse_select();
}
        
    }  



 public function stocktransferrequestsubmit(Request $request)
     {
     
$branch=Session::get('branch');
 $rwarehouse=Session::get('warehouse');
        $warehouse=$request->warehouse;

  $data = [      
                        'request_date'     => Carbon::parse($request->request_date)->format('Y-m-d'),
                        'requestedby' =>$request->requestedby,
                        'warehouse' =>$request->warehouse,
                        'rwarehouse' =>$rwarehouse,
                        'notes' =>$request->notes, 
                        'branch' =>$branch,  
                        
                                 ];
                              $product_object =DB::table('qwarehouse_stock_transfer_request')->insert($data);
                              $main_entry_id =DB::getPdo()->lastInsertId();
                              
   for ($i = 0; $i < count($request->productname); $i++)
                 {
                    
                 $data = [
                'request_id' => $main_entry_id,        
                'productname' => $request->productname[$i],                     
                'existing_quantity'   => $request->existing_quantity[$i],  
                'stock_out_quantity'   => $request->stock_out_quantity[$i],         
           
                 ];      
                DB::table('qwarehouse_stock_transfer_request_products')->insert($data);

               
                
                 } 

     return 'true';

     
     
     }
     public function salesmaster(Request $request)
     {
      if ($request->ajax()) 
     {
                           
       $query = DB::table('qinventory_products')->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_products_purchase', 'qinventory_products.product_id', '=', 'qinventory_products_purchase.main_product_id')->select('qinventory_products.product_id','qinventory_products.product_name','qinventory_products.description','qinventory_products.sku','qinventory_products.product_code','qinventory_products.available_stock','qinventory_product_unit.unit_name as unit', 'qinvoice_category.category_name','qinventory_products_purchase.costpercentage','qinventory_products_purchase.profit','qinventory_products_purchase.landing','qinventory_products_purchase.margin','qinventory_products_purchase.selling_price','qinventory_products_purchase.product_price','qinventory_products_purchase.product_id as id')->orderby('qinventory_products.product_id', 'desc')->groupBy('qinventory_products_purchase.main_product_id');
        $query->where('qinventory_products.del_flag',1);
                                
        $data = $query->get();
                               
        $count_filter = $query->count();
        $count_total = ProductdetailslistModel::count();
        return Datatables::of($data)->addIndexColumn()->addColumn('action',function($row){
        return $row->product_id; 
                         })->rawColumns(['action'])->make(true);
     }
     return view('warehouse.salesmaster.list');
 }
 
 public function salesmaster_edit(Request $request)
    {
$id = $request->id;

        $salesmaster = DB::table('qinventory_products')->leftjoin('qinventory_products_purchase.main_product_id','=','qinventory_products.product_id')->select('qinventory_products.product_price as purchase_price','qinventory_products_purchase.*')->where('qinventory_products.product_id',$id)->get();

         return view('warehouse.salesmaster.edit',compact('salesmaster'));
    }
     public function warehouseProductListView(Request $request)
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
        $attributeList    = AttributeModel::select('id', 'attribute_name','options')->where('del_flag',1)->get();
                $brandlist        = BrandModel::select('id','brand_name')->where('del_flag',1)->get();
                $manufacturerlist = ManufactureModel::select('id','manufacture_name')->where('del_flag',1)->get();
                $categorylist     = productcategory::select('id','category_name')->where('del_flag',1)->get();
                $products = ProductdetailslistModel::where('product_id', $id)->limit(1)
                        ->first();
                $options =array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
                $unit     = ProductUnitModel::select('id','unit_name')->where('del_flag',1)->get();
                $batches          =BatchlistModel::select('id','batchname')->where('del_flag',1)->get();
                $vendors = DB::table('qcrm_vendors')->select('id','vendor_name as name')->where('del_flag',1)->get();
                $suppliers = DB::table('qcrm_supplier')->select('id','sup_name as name')->where('del_flag',1)->get();
    }
    else
    {
        $attributeList    = AttributeModel::select('id', 'attribute_name','options')->where('del_flag',1)->where('branch',$branch)->get();
                $brandlist        = BrandModel::select('id','brand_name')->where('del_flag',1)->where('branch',$branch)->get();
                $manufacturerlist = ManufactureModel::select('id','manufacture_name')->where('del_flag',1)->where('branch',$branch)->get();
                $categorylist     = productcategory::select('id','category_name')->where('del_flag',1)->get();
                $products = ProductdetailslistModel::where('product_id', $id)->limit(1)
                        ->first();
                $options =array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
                $unit     = ProductUnitModel::select('id','unit_name')->where('del_flag',1)->where('branch',$branch)->get();
                $batches          =BatchlistModel::select('id','batchname')->where('del_flag',1)->where('branch',$branch)->get();
                $vendors = DB::table('qcrm_vendors')->select('id','vendor_name as name')->where('del_flag',1)->get();
                $suppliers = DB::table('qcrm_supplier')->select('id','sup_name as name')->where('del_flag',1)->get();
    }
                
    return view('warehouse.product.productview', ['data' => $products],compact('attributeList','brandlist','manufacturerlist','products','categorylist','options','unit','batches','branch','vendors','suppliers'));
        }
     


}

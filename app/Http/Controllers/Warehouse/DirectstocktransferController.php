<?php
namespace App\Http\Controllers\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use DataTables;
use App\purchase\ProductPurchasedetailslistModel;
use App\inventory\ProductdetailslistModel;
class DirectstocktransferController extends Controller
{
	 public function index()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
		if(session()->has('warehouse')){

           $query = DB::table('qwarehouse_direct_stock_transfer')->leftJoin('qwarehouse_direct_stock_transfer_products', 'qwarehouse_direct_stock_transfer.id', '=', 'qwarehouse_direct_stock_transfer_products.stock_transfer_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_direct_stock_transfer.prepared_by', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qwarehouse_direct_stock_transfer.approved_by', '=', 's2.id')->leftJoin('qinventory_warehouse', 'qwarehouse_direct_stock_transfer.transfer_warehouse', '=', 'qinventory_warehouse.id')->select('qwarehouse_direct_stock_transfer.id as tid','qwarehouse_direct_stock_transfer.*','qwarehouse_direct_stock_transfer_products.*','s1.name as preparedby','qinventory_warehouse.warehouse_name as transfer_warehouse2','s2.name as approvedby',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_direct_stock_transfer_products.stock_transfer_id')->where('qwarehouse_direct_stock_transfer.warehouse',$warehouse);
               $products = $query->get();  
               //dd($products);                    
 return view('warehouse.directtransfer.index',compact('products','branch'));    
}
else{

  return $this->warehouse_select();
}
        
    }
	public function add()
	{
		$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
		if(session()->has('warehouse')){
		$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();
		$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();
		return view('warehouse.directtransfer.add',compact('branch','warehouse','warehouses','salesmen'));
	}
	}
	public function submit(Request $request)
     {
     
$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
$rwarehouse = $request->warehouse;
  $data = [      
                        'transfer_date'     => Carbon::parse($request->out_date)->format('Y-m-d'),
                        'requested_by' =>$request->requested_by,
                        'notes' =>$request->notes,         
                        'prepared_by' =>$request->prepared_by, 
                        'approved_by' =>$request->approved_by, 
                        'warehouse' =>$warehouse,
                        'transfer_warehouse' =>$request->warehouse,
                        'branch' =>$branch,
                        'type'=>'Direct',
                        'status'=>'Draft'   
                        
                                 ];
            $product_object =DB::table('qwarehouse_direct_stock_transfer')->insert($data);
            $main_entry_id =DB::getPdo()->lastInsertId();
                              
   			for ($i = 0; $i < count($request->productname); $i++)
                 {   
                 $data = [
                'stock_transfer_id' => $main_entry_id,        
                'productname' => $request->productname[$i],                      
                'stock_out_quantity'   => $request->stock_out_quantity[$i],     
                'existing_quantity'=>$request->available_stock[$i],    
                 ];      
                DB::table('qwarehouse_direct_stock_transfer_products')->insert($data);
                $data23 =
                ['mdate' =>Carbon::parse($request->out_date)->format('Y-m-d'),
               'productname' =>$request->productname[$i],
               'mtype'=>1,
               'quantity'=>$request->stock_out_quantity[$i],
               'warehouse'=>$warehouse
                ];
                DB::table('qwarehouse_stock_movement')->insert($data23);
                
                $product = DB::table('qinventory_products')->select('product_name')->where('warehouse',$rwarehouse)->where('main_product_id',$request->productname[$i])->where('branch',$branch)->get();
                $productCount = $product->count();

                if($productCount > 0)
                {
                    DB::table('qinventory_products')->where('main_product_id', $request->productname[$i])->where('warehouse',$rwarehouse)->increment('available_stock',$request->stock_out_quantity[$i]);
                    DB::table('qinventory_products')->where('product_id', $request->productname[$i])->where('warehouse',$warehouse)->decrement('available_stock',$request->stock_out_quantity[$i]);
                }
                else
                {
                    $old_quote = DB::table('qinventory_products')->select('qinventory_products.*')->where('product_id',$request->productname[$i])->get();
                    foreach ($old_quote as $key => $value) 
                    {
                     $old_product_id=$value->product_id;
                         $data = [
                         'main_product_id'=>$old_product_id,   
                        'product_type' =>1,
                        'product_name' =>$value->product_name,
                        'category' =>$value->category,         
                        'unit' =>$value->unit, 
                        'product_code' =>$value->product_code, 
                        'sku' =>$value->sku, 
                        'barcode' =>$value->barcode, 
                        'barcode_format' =>$value->barcode_format, 
                        'available_stock'=>$request->stock_out_quantity[$i], 
                        'product_price' =>$value->product_price,
                        'product_status' =>1, 
                        'out_of_stock_status' =>1,  
                        'provider' =>$value->provider, 
                        'provider_id' =>$value->provider_id, 
                        'description' =>$value->description, 
                        'opening_stock' =>$request->stock_out_quantity[$i], 
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
                        'expiry_reminder'=> $value->expiry_reminder, 
                        'warranty_date'     => Carbon::parse($value->warranty_date)->format('Y-m-d'), 
                        'warranty_reminder'=>$value->warranty_reminder,  
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
                        'warehouse'=>$rwarehouse,
                         ];
$product_ids = DB::table('qinventory_products')->insert($data);
DB::table('qinventory_products')->where('product_id', $request->productname[$i])->where('warehouse',$warehouse)->decrement('available_stock',$request->stock_out_quantity[$i]);
                 } 
                }
             }

     return $productCount;

     }
     public function edit(Request $request)
	{
		$id = $request->id;
		$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
		if(session()->has('warehouse')){
		$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();
		$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();
		$direct = DB::table('qwarehouse_direct_stock_transfer')->select('*',DB::raw("DATE_FORMAT(qwarehouse_direct_stock_transfer.transfer_date, '%d-%m-%Y') as transfer_date"))->where('id',$id)->get();
		
		$directproducts = DB::table('qwarehouse_direct_stock_transfer_products')->leftjoin('qinventory_products','qwarehouse_direct_stock_transfer_products.productname','=','qinventory_products.product_id')->select('qwarehouse_direct_stock_transfer_products.*','qinventory_products.product_name')->where('qwarehouse_direct_stock_transfer_products.stock_transfer_id',$id)->get();
		return view('warehouse.directtransfer.edit',compact('branch','warehouse','warehouses','salesmen','direct','directproducts'));
	}
	}
	
	public function update(Request $request)
     {
     
$branch=Session::get('branch');
      $warehouse=Session::get('warehouse');
$id = $request->id;
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
            $product_object =DB::table('qwarehouse_direct_stock_transfer')->where('id',$id)->update($data);
           
            DB::table('qwarehouse_direct_stock_transfer_products')->where('stock_transfer_id',$id)->delete();                
   			for ($i = 0; $i < count($request->productname); $i++)
                 {   
                 $data = [
                'stock_transfer_id' => $id,        
                'productname'=>$request->productname[$i],                      
                'stock_out_quantity'=> $request->stock_out_quantity[$i],   
                'existing_quantity'=>$request->available_stock[$i],     
                 ];      
                DB::table('qwarehouse_direct_stock_transfer_products')->insert($data);
                 } 

     return 'true';

     }

public function delete(Request $request)
    {
        $id = $request->id;
        DB::table('qwarehouse_direct_stock_transfer')->where('id', $id)->delete();
        DB::table('qwarehouse_direct_stock_transfer_products')->where('stock_transfer_id', $id)->delete();
        return redirect()->route('directstocktransfer')->with('message', 'State saved correctly!!!');
     }


}
?>
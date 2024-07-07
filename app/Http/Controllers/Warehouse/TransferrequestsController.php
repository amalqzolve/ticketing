<?php
namespace App\Http\Controllers\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use DataTables;
use App\purchase\ProductPurchasedetailslistModel;
class TransferrequestsController extends Controller
{
	public function index()
    {

        $branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
		if(session()->has('warehouse')){

           $query = DB::table('qwarehouse_transfer_request')->leftJoin('qwarehouse_transfer_request_products', 'qwarehouse_transfer_request.id', '=', 'qwarehouse_transfer_request_products.stock_transfer_id')->leftJoin('qcrm_salesman_details as s1', 'qwarehouse_transfer_request.prepared_by', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qwarehouse_transfer_request.approved_by', '=', 's2.id')->leftJoin('qinventory_warehouse', 'qwarehouse_transfer_request.transfer_warehouse', '=', 'qinventory_warehouse.id')->select('qwarehouse_transfer_request.id as tid','qwarehouse_transfer_request.*','qwarehouse_transfer_request_products.*','s1.name as preparedby','qinventory_warehouse.warehouse_name as transfer_warehouse2','s2.name as approvedby',DB::raw('SUM(stock_out_quantity) as total'))->groupBy('qwarehouse_transfer_request_products.stock_transfer_id')->where('qwarehouse_transfer_request.warehouse',$warehouse);
               $products = $query->get();  
               //dd($products);                    
 return view('warehouse.transferrequest.index',compact('products','branch'));    
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
		return view('warehouse.transferrequest.add',compact('branch','warehouse','warehouses','salesmen'));
	}
	}
	public function submit(Request $request)
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
            $product_object =DB::table('qwarehouse_transfer_request')->insert($data);
            $main_entry_id =DB::getPdo()->lastInsertId();
                              
   			for ($i = 0; $i < count($request->productname); $i++)
                 {   
                 $data = [
                'stock_transfer_id' => $main_entry_id,        
                'productname' => $request->productname[$i],                      
                'stock_out_quantity'   => $request->stock_out_quantity[$i], 
                'existing_quantity'=>$request->available_stock[$i],        
                 ];      
                DB::table('qwarehouse_transfer_request_products')->insert($data);
                 } 

     return 'true';

     }
     public function edit(Request $request)
	{
		$id = $request->id;
		$branch=Session::get('branch');
        $warehouse=Session::get('warehouse');
		if(session()->has('warehouse')){
		$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();
		$salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();
		$direct = DB::table('qwarehouse_transfer_request')->select('*',DB::raw("DATE_FORMAT(qwarehouse_transfer_request.transfer_date, '%d-%m-%Y') as transfer_date"))->where('id',$id)->get();
		
		$directproducts = DB::table('qwarehouse_transfer_request_products')->leftjoin('qinventory_products','qwarehouse_transfer_request_products.productname','=','qinventory_products.product_id')->select('qwarehouse_transfer_request_products.*','qinventory_products.product_name','qinventory_products.available_stock')->where('qwarehouse_transfer_request_products.stock_transfer_id',$id)->get();
		return view('warehouse.transferrequest.edit',compact('branch','warehouse','warehouses','salesmen','direct','directproducts'));
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
            $product_object =DB::table('qwarehouse_transfer_request')->where('id',$id)->update($data);
           
            DB::table('qwarehouse_transfer_request_products')->where('stock_transfer_id',$id)->delete();                
   			for ($i = 0; $i < count($request->productname); $i++)
                 {   
                 $data = [
                'stock_transfer_id' => $id,        
                'productname'=>$request->productname[$i],                      
                'stock_out_quantity'=> $request->stock_out_quantity[$i],   
                'existing_quantity'=>$request->available_stock[$i],     
                 ];      
                DB::table('qwarehouse_transfer_request_products')->insert($data);
                 } 

     return 'true';

     }
     public function delete(Request $request)
    {
    	$id = $request->id;
		DB::table('qwarehouse_transfer_request')->where('id', $id)->delete();
		DB::table('qwarehouse_transfer_request_products')->where('stock_transfer_id', $id)->delete();
    	return redirect()->route('transferrequests')->with('message', 'State saved correctly!!!');
     }
     
}
?>
<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function warehouse()
    {

  $branch=Session::get('branch');

if(session()->has('warehouse')){


 return view('warehouse.dashboard.index');


}else{
	$this->warehouse_select();
}
        
    }
   
   public function warehouse_select()
    {
 $branch=Session::get('branch');
        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

         return view('warehouse.dashboard.select', compact('warehouses','branch'));
    }


//////////
    	public function ProductListing(Request $request)
		{
		   $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
			
				 return view('inventory.product.listing');
		}







		////////////////////////
   
     

  
}

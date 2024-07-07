<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use Session;
use DB;
use Carbon\Carbon;
use App\inventory\Product_stockModel;
use App\inventory\StockadjustmentModel;
class StockadjustmentController extends Controller
{
	public function stockadjustment_inventory(Request $request)
		{
		   $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
				if ($request->ajax()) 
						{
							if($common_customer_database == 1)
							{
								$query = DB::table('qinventory_stock_adjustment')
								->leftJoin('qinventory_products', 'qinventory_stock_adjustment.product_id', '=', 'qinventory_products.product_id')->select('qinventory_products.*')->orderby('qinventory_stock_adjustment.st_ad_id', 'desc');
								$query->where('qinventory_stock_adjustment.del_flag',1);
								$data = $query->get();
								// dd($data);
								$count_filter = $query->count();
								$count_total = StockadjustmentModel::count();
								return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
										return $row->product_id; 
								})->rawColumns(['action'])->make(true);
							}
							else
							{
								$query = DB::table('qinventory_stock_adjustment')
								->leftJoin('qinventory_products', 'qinventory_stock_adjustment.product_id', '=', 'qinventory_products.product_id')->select('qinventory_products.*')->orderby('qinventory_stock_adjustment.st_ad_id', 'desc');
								$query->where('qinventory_stock_adjustment.del_flag',1)->where('qinventory_stock_adjustment.branch',$branch);
								$data = $query->get();
								// dd($data);
								$count_filter = $query->count();
								$count_total = StockadjustmentModel::count();
								return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
										return $row->product_id; 
								})->rawColumns(['action'])->make(true);
							}
								    
						}
				 return view('inventory.stockadjustment.listing');
		}
}
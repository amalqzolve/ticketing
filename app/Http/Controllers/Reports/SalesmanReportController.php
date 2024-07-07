<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use View;
use DB;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class SalesmanReportController extends Controller
{
	public function salesmanreports()
	{
		$salesman = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->get();
		return view('Reports.salesman.index',compact('salesman'));
	}
	public function salesmanreportsubmit(Request $request)
	{
		$sid = $request->salesman;
		$fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
		$data = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details','qsell_saleinvoice.customer','=','qcrm_customer_details.id')->leftjoin('qsell_saleinvoice_products','qsell_saleinvoice_products.invoice_id','=','qsell_saleinvoice.id')->leftjoin('qinventory_products_purchase','qsell_saleinvoice_products.item_id','=','qinventory_products_purchase.main_product_id')->select('qinventory_products_purchase.profit','qinventory_products_purchase.product_id','qcrm_customer_details.cust_name','qsell_saleinvoice_products.item_id','qsell_saleinvoice.*')->where('qsell_saleinvoice.salesman',$sid)->whereBetween('qsell_saleinvoice.quotedate',[$fromdate,$todate])->groupBy('qsell_saleinvoice.id')->get();
		
		return view('Reports.salesman.report',compact('data'));
	}
}
?>
<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;

class StockController extends Controller
{
	public function purchasestock_reports()
	{
		return view('Reports.stock.purchase');
	}
	public function salesstock_reports()
	{
		return view('Reports.stock.sales');
	}
	public function salesstockreport(Request $request)
    {
           $branch=Session::get('branch');
           $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
           $todate = Carbon::parse($request->todate)->format('Y-m-d');
           $query  = DB::table('qsell_saleinvoice_products')->leftjoin('qsell_saleinvoice','qsell_saleinvoice_products.invoice_id','=','qsell_saleinvoice.id')->leftJoin('qinventory_products','qsell_saleinvoice_products.item_id','=','qinventory_products.product_id')->select('qinventory_products.product_name','qsell_saleinvoice_products.item_id',DB::raw('SUM(qsell_saleinvoice_products.quantity) as quantity'));
           $query->groupBy('qsell_saleinvoice_products.item_id');
            $query->where('qsell_saleinvoice_products.del_flag', 1)->where('qsell_saleinvoice_products.branch',$branch)->whereBetween('qsell_saleinvoice.invoice_date',[$fromdate,$todate]);
            $data = $query->get(); 

         return view('Reports.stock.salesreport',compact('data','fromdate','todate'));
       
    }
    public function purchasestockreport(Request $request)
    {
           $branch=Session::get('branch');
           $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
           $todate = Carbon::parse($request->todate)->format('Y-m-d');
           $query  = DB::table('qbuy_pi_products')->leftjoin('qbuy_purchase_pi','qbuy_pi_products.pi_id','=','qbuy_purchase_pi.id')->leftJoin('qinventory_products','qbuy_pi_products.itemname','=','qinventory_products.product_id')->select('qbuy_pi_products.itemname','qinventory_products.product_name','qbuy_pi_products.itemname',DB::raw('SUM(qbuy_pi_products.quantity) as quantity'));
           $query->groupBy('qbuy_pi_products.itemname');
            $query->where('qbuy_pi_products.del_flag', 1)->where('qbuy_pi_products.branch',$branch)->whereBetween('qbuy_purchase_pi.bill_entry_date',[$fromdate,$todate]);
            $data = $query->get(); 

         return view('Reports.stock.purchasereport',compact('data','fromdate','todate'));
       
    }
    public function viewpurchasereport(Request $request)
    {
    	$item = $request->id;
           $branch=Session::get('branch');
    	$query  = DB::table('qbuy_pi_products')->leftjoin('qbuy_purchase_pi','qbuy_pi_products.pi_id','=','qbuy_purchase_pi.id')->leftJoin('qinventory_products','qbuy_pi_products.itemname','=','qinventory_products.product_id')->select('qbuy_purchase_pi.bill_entry_date','qinventory_products.product_name','qbuy_pi_products.*')->orderby('qbuy_pi_products.id', 'desc');
        $query->where('qbuy_pi_products.itemname',$item)->where('qbuy_pi_products.branch',$branch);
         $data = $query->get();
         return view('Reports.stock.viewpurchasereports',compact('data','item'));
    }
    public function viewsalesreport(Request $request)
    {
    	$item = $request->id;
           $branch=Session::get('branch');
    	$query  = DB::table('qsell_saleinvoice_products')->leftjoin('qsell_saleinvoice','qsell_saleinvoice_products.invoice_id','=','qsell_saleinvoice.id')->leftJoin('qinventory_products','qsell_saleinvoice_products.item_id','=','qinventory_products.product_id')->select('qsell_saleinvoice.invoice_date','qinventory_products.product_name','qsell_saleinvoice_products.*')->orderby('qsell_saleinvoice_products.id', 'desc');
        $query->where('qsell_saleinvoice_products.item_id',$item)->where('qsell_saleinvoice_products.branch',$branch);
         $data = $query->get();
         return view('Reports.stock.viewsalesreports',compact('data','item'));
    }
    public function purchasereportpdf(Request $request)
    {
    	ini_set("pcre.backtrack_limit", "100000000000");
    	$branch=Session::get('branch');
    	$branchsettings = BranchSettingsModel::select('id','pdfheader','pdffooter')->where('del_flag',1)->where('branch',$branch)->get();
           
           $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
           $todate = Carbon::parse($request->todate)->format('Y-m-d');
           $query  = DB::table('qbuy_pi_products')->leftjoin('qbuy_purchase_pi','qbuy_pi_products.pi_id','=','qbuy_purchase_pi.id')->leftJoin('qinventory_products','qbuy_pi_products.itemname','=','qinventory_products.product_id')->select('qbuy_pi_products.itemname','qinventory_products.product_name','qbuy_pi_products.itemname',DB::raw('SUM(qbuy_pi_products.quantity) as quantity'));
           $query->groupBy('qbuy_pi_products.itemname');
            $query->where('qbuy_pi_products.del_flag', 1)->where('qbuy_pi_products.branch',$branch)->whereBetween('qbuy_purchase_pi.bill_entry_date',[$fromdate,$todate]);
            $data = $query->get(); 

        $pdf = PDF::loadview('Reports.stock.purchasereportpdf',compact('data','branchsettings'));
        return $pdf->stream('purchasestock.pdf');
         
       
    }
    
    public function purchasestockreportpdf(Request $request)
    {
    	ini_set("pcre.backtrack_limit", "100000000000");
    	$branch=Session::get('branch');
    	$branchsettings = BranchSettingsModel::select('id','pdfheader','pdffooter')->where('del_flag',1)->where('branch',$branch)->get(); 
           $item = $request->item;
    	$query  = DB::table('qbuy_pi_products')->leftjoin('qbuy_purchase_pi','qbuy_pi_products.pi_id','=','qbuy_purchase_pi.id')->leftJoin('qinventory_products','qbuy_pi_products.itemname','=','qinventory_products.product_id')->select('qbuy_purchase_pi.bill_entry_date','qinventory_products.product_name','qbuy_pi_products.*')->orderby('qbuy_pi_products.id', 'desc');
        $query->where('qbuy_pi_products.itemname',$item)->where('qbuy_pi_products.branch',$branch);
         $data = $query->get();

        $pdf = PDF::loadview('Reports.stock.purchasestockreportpdf',compact('data','branchsettings'));
        return $pdf->stream('purchasestock.pdf');
         
       
    }
    
    public function salesreportpdf(Request $request)
    {
    	ini_set("pcre.backtrack_limit", "100000000000");
    	$branch=Session::get('branch');
    	$branchsettings = BranchSettingsModel::select('id','pdfheader','pdffooter')->where('del_flag',1)->where('branch',$branch)->get();
           
           $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
           $todate = Carbon::parse($request->todate)->format('Y-m-d');
           $query  = DB::table('qsell_saleinvoice_products')->leftjoin('qsell_saleinvoice','qsell_saleinvoice_products.invoice_id','=','qsell_saleinvoice.id')->leftJoin('qinventory_products','qsell_saleinvoice_products.item_id','=','qinventory_products.product_id')->select('qinventory_products.product_name','qsell_saleinvoice_products.item_id',DB::raw('SUM(qsell_saleinvoice_products.quantity) as quantity'));
           $query->groupBy('qsell_saleinvoice_products.item_id');
            $query->where('qsell_saleinvoice_products.del_flag', 1)->where('qsell_saleinvoice_products.branch',$branch)->whereBetween('qsell_saleinvoice.invoice_date',[$fromdate,$todate]);
            $data = $query->get();

        $pdf = PDF::loadview('Reports.stock.salesreportpdf',compact('data','branchsettings'));
        return $pdf->stream('salesstock.pdf');
         
       
    }
    
    public function salesstockreportpdf(Request $request)
    {
    	ini_set("pcre.backtrack_limit", "100000000000");
    	$branch=Session::get('branch');
    	$branchsettings = BranchSettingsModel::select('id','pdfheader','pdffooter')->where('del_flag',1)->where('branch',$branch)->get(); 
           $item = $request->item;
    	$query  = DB::table('qsell_saleinvoice_products')->leftjoin('qsell_saleinvoice','qsell_saleinvoice_products.invoice_id','=','qsell_saleinvoice.id')->leftJoin('qinventory_products','qsell_saleinvoice_products.item_id','=','qinventory_products.product_id')->select('qsell_saleinvoice.invoice_date','qinventory_products.product_name','qsell_saleinvoice_products.*')->orderby('qsell_saleinvoice_products.id', 'desc');
        $query->where('qsell_saleinvoice_products.item_id',$item)->where('qsell_saleinvoice_products.branch',$branch);
         $data = $query->get();

        $pdf = PDF::loadview('Reports.stock.salesstockreportpdf',compact('data','branchsettings'));
        return $pdf->stream('purchasestock.pdf');
         
       
    }
}
?>
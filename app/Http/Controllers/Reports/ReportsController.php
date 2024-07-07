<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\purchase\PurchaseProductModel;
use App\purchase\PurchasedetailslistModel;
use App\purchase\ProductcostheadModel;
use DB;
use DataTables;
use Session;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;

class ReportsController extends Controller
{
    public function purchasereports(Request $request)
    {
        $branch = Session::get('branch');

        $details = "";
        // dd($details);
        return view('Reports.preports.purchaselisting', compact('details'));
    }

    public function purchasereports1(Request $request)
    {
        $branch = Session::get('branch');

        $details = "";
        // dd($details);
        return view('Reports.preports.purchaselisting1', compact('details'));
    }


    public function purchaselistreports(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');

        DB::enableQueryLog();

        // and then you can get query log



        /*$details = DB::table('buy_voucher')->leftjoin('qsettings_voucher','buy_voucher.voucher_type','=','qsettings_voucher.id')->leftjoin('qcrm_supplier','buy_voucher.cust_id','=','qcrm_supplier.id')->leftjoin('qcrm_salesman_details','buy_voucher.salesman','=','qcrm_salesman_details.id')->select('*','qsettings_voucher.voucher_name','qcrm_supplier.sup_name','qcrm_supplier.vatno','qcrm_supplier.buyerid_crno','qcrm_salesman_details.name as purchaser','buy_voucher.id as vid')->Where('buy_voucher.del_flag', 1)->whereBetween('quotedate',[$fromdate,$todate])->get();
*/


        $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.name', '=', 'qcrm_supplier.id')->select('*', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno')->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->whereBetween('bill_entry_date', [$fromdate, $todate])->get();
        //dd(DB::getQueryLog());
        return view('Reports.preports.purchaselists', compact('details', 'fromdate', 'todate'));
    }

    public function purchaselistreports1(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');

        DB::enableQueryLog();

        // and then you can get query log



        $details = DB::table('buy_voucher')->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')->select('*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')->Where('buy_voucher.del_flag', 1)->whereBetween('quotedate', [$fromdate, $todate])->get();



        /*    $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier','qbuy_purchase_pi.name','=','qcrm_supplier.id')->select('*','qcrm_supplier.sup_name','qcrm_supplier.vatno','qcrm_supplier.buyerid_crno')->where('qbuy_purchase_pi.del_flag',1)->where('qbuy_purchase_pi.branch',$branch)->whereBetween('bill_entry_date',[$fromdate,$todate])->get();*/
        //dd(DB::getQueryLog());
        return view('Reports.preports.purchaselists1', compact('details', 'fromdate', 'todate'));
    }

    public function purchase_reportpdf_print(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        /* $details = DB::table('qpurchase_purchase')->select('*')->where('del_flag',1)->where('branch',$branch)->whereBetween('purchase_date',[$fromdate,$todate])->get();
*/

        /*    $details = DB::table('buy_voucher')->leftjoin('qsettings_voucher','buy_voucher.voucher_type','=','qsettings_voucher.id')->leftjoin('qcrm_supplier','buy_voucher.cust_id','=','qcrm_supplier.id')->leftjoin('qcrm_salesman_details','buy_voucher.salesman','=','qcrm_salesman_details.id')->select('*','qsettings_voucher.voucher_name','qcrm_supplier.sup_name','qcrm_supplier.vatno','qcrm_supplier.buyerid_crno','qcrm_salesman_details.name as purchaser','buy_voucher.id as vid')->Where('buy_voucher.del_flag', 1)->whereBetween('quotedate',[$fromdate,$todate])->get();
*/
        $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.name', '=', 'qcrm_supplier.id')->select('*', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno')->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->whereBetween('bill_entry_date', [$fromdate, $todate])->get();

        $pdf = PDF::loadview('Reports.preports.pdf', compact('details', 'branchsettings'));
        return $pdf->stream('Purchase.pdf');
    }

    public function purchase_reportpdf_print1(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        /* $details = DB::table('qpurchase_purchase')->select('*')->where('del_flag',1)->where('branch',$branch)->whereBetween('purchase_date',[$fromdate,$todate])->get();
*/

        $details = DB::table('buy_voucher')->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')->select('*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')->Where('buy_voucher.del_flag', 1)->whereBetween('quotedate', [$fromdate, $todate])->get();

        /*  $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier','qbuy_purchase_pi.name','=','qcrm_supplier.id')->select('*','qcrm_supplier.sup_name','qcrm_supplier.vatno','qcrm_supplier.buyerid_crno')->where('qbuy_purchase_pi.del_flag',1)->where('qbuy_purchase_pi.branch',$branch)->whereBetween('bill_entry_date',[$fromdate,$todate])->get();*/

        $pdf = PDF::loadview('Reports.preports.pdf1', compact('details', 'branchsettings'));
        return $pdf->stream('Purchase.pdf');
    }


    public function vatfiling(Request $request)
    {
        $branch = Session::get('branch');

        $details = "";
        // dd($details);
        return view('purchase.vatfiling.vatsearch', compact('details'));
    }




    public function vatlistreports(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');

        DB::enableQueryLog();

        // and then you can get query log





        $details = DB::table('qpurchase_vatfiling')->select('*', DB::raw('SUM(purchase_vatamount) AS tpurchase_vatamount'), DB::raw('SUM(pgrandtotalamount) AS ptgrandtotalamount'), DB::raw('SUM(sgrandtotalamount) AS stgrandtotalamount'), DB::raw('SUM(sales_vatamount) AS tsales_vatamount'), DB::raw('SUM(purchase_vatamount) AS tpurchase_vatamount'))->groupBy('date')->where('branch', $branch)->whereBetween('date', [$fromdate, $todate])->get();
        //dd(DB::getQueryLog());
        return view('purchase.vatfiling.vatlists', compact('details', 'fromdate', 'todate'));
    }



    public function vatfiling_print(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');

        DB::enableQueryLog();

        // and then you can get query log



        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $details = DB::table('qpurchase_vatfiling')->select('*', DB::raw('SUM(purchase_vatamount) AS tpurchase_vatamount'), DB::raw('SUM(pgrandtotalamount) AS ptgrandtotalamount'), DB::raw('SUM(sgrandtotalamount) AS stgrandtotalamount'), DB::raw('SUM(sales_vatamount) AS tsales_vatamount'), DB::raw('SUM(purchase_vatamount) AS tpurchase_vatamount'))->groupBy('date')->where('branch', $branch)->whereBetween('date', [$fromdate, $todate])->get();
        //dd(DB::getQueryLog());

        $pdf = PDF::loadview('purchase.vatfiling.pdf', compact('details', 'fromdate', 'todate', 'branchsettings'));
        return $pdf->stream('Purchase.pdf');
    }
}
//purchase_vatamount
//sales_vatamount
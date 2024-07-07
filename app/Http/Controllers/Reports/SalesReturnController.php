<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use View;
use DB;
use Auth;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;

class SalesReturnController extends Controller
{
    public function sellreturnreport(Request $request)
    {
        $branch = Session::get('branch');
        $details = "";
        return view('Reports.sales.return.listing', compact('details'));
    }
    public function salesreturnsubmit(Request $request)
    {
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');

        DB::enableQueryLog();

        $details = DB::table('qsell_sales_return')->leftjoin('qcrm_customer_details', 'qsell_sales_return.customer', '=', 'qcrm_customer_details.id')->select('*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.buyerid_crno', 'qsell_sales_return.id as sid', DB::raw("DATE_FORMAT(qsell_sales_return.returndate, '%d-%m-%Y') as returndate"))->where('qsell_sales_return.del_flag', 1)->where('qsell_sales_return.branch', $branch)->whereBetween('returndate', [$fromdate, $todate])->orderby('qsell_sales_return.returndate', 'ASC')->groupBy('qsell_sales_return.id')->get();

        return view('Reports.sales.return.salesreturnreport', compact('details', 'fromdate', 'todate'));
    }
    public function salesreturn_reportpdf(Request $request)
    {
        ini_set("pcre.backtrack_limit", "100000000000");
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $details = DB::table('qsell_sales_return')->leftjoin('qcrm_customer_details', 'qsell_sales_return.customer', '=', 'qcrm_customer_details.id')->select('*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.buyerid_crno', 'qsell_sales_return.id as sid', DB::raw("DATE_FORMAT(qsell_sales_return.returndate, '%d-%m-%Y') as returndate"))->where('qsell_sales_return.del_flag', 1)->where('qsell_sales_return.branch', $branch)->whereBetween('returndate', [$fromdate, $todate])->orderby('qsell_sales_return.returndate', 'ASC')->groupBy('qsell_sales_return.id')->get();

        $pdf = PDF::loadview('Reports.sales.return.salesreturnpdf', compact('details', 'branchsettings'));
        return $pdf->stream('salesreturn.pdf');
    }
    public function sellreturnsoareport(Request $request)
    {
        $branch = Session::get('branch');
        $details = "";
        if (Session::get('common_customer_database') == 1) {
            $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->get();
        } else {
            $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();
        }
        return view('Reports.sales.return.listingsoa', compact('details', 'customers'));
    }
    public function salesreturnsoasubmit(Request $request)
    {
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $customer = $request->customer;
        $details = DB::table('qsell_sales_return')->leftjoin('qcrm_customer_details', 'qsell_sales_return.customer', '=', 'qcrm_customer_details.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('*', DB::raw("DATE_FORMAT(qsell_sales_return.returndate, '%d-%m-%Y') as returndate"), 'qcrm_customer_details.*', 'countries.*')->whereBetween('returndate', [$fromdate, $todate])->where('qsell_sales_return.del_flag', 1)->where('qsell_sales_return.branch', $branch)->where('qsell_sales_return.customer', $customer)->get();
        //dd($details);
        return view('Reports.sales.return.salesreturnsoa', compact('details', 'fromdate', 'todate', 'customer'));
    }
    public function soasalesreturnpdf(Request $request)
    {
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $customer = $request->customer;
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $details = DB::table('qsell_sales_return')->leftjoin('qcrm_customer_details', 'qsell_sales_return.customer', '=', 'qcrm_customer_details.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('*', DB::raw("DATE_FORMAT(qsell_sales_return.returndate, '%d-%m-%Y') as returndate"), 'qcrm_customer_details.*', 'countries.*')->whereBetween('returndate', [$fromdate, $todate])->where('qsell_sales_return.del_flag', 1)->where('qsell_sales_return.branch', $branch)->where('qsell_sales_return.customer', $customer)->get();
        $pdf = PDF::loadview('Reports.sales.return.pdf', compact('details', 'fromdate', 'branchsettings', 'todate'));
        return $pdf->stream('salesreturnsoa.pdf');
    }
}

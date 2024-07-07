<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\inventory\ProductdetailslistModel;
use App\sales\CustomInvoiceModel;
use App\sales\CustomInvoiceproductModel;
use PDF;
use View;
use DB;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\sales\SalesModel;
use App\settings\BranchSettingsModel;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\InvoicesExport;


class SalesReportController extends Controller
{
  public function sellreports(Request $request)
  {
    $branch = Session::get('branch');
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch);
    $data = $query->get();

    return view('Reports.sales.salesreport', compact('data'));
  }
  public function viewsellreport(Request $request)
  {
    $date = Carbon::parse($request->id)->format('Y-m-d');
    $branch = Session::get('branch');
    $query  = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->select('qcrm_customer_details.cust_name as customer', 'qsell_saleinvoice.id', 'totalamount', 'vatamount', 'grandtotalamount', 'quotedate')->orderby('qsell_saleinvoice.id', 'desc');
    $query->where('qsell_saleinvoice.quotedate', $date)->where('qsell_saleinvoice.branch', $branch);
    $data = $query->get();

    return view('Reports.sales.viewsalesreport', compact('data'));
  }
  public function cashsell_report(Request $request)
  {
    $branch = Session::get('branch');

    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->where('sale_method', 1);
    $data = $query->get();

    return view('Reports.sales.cashsales', compact('data'));
  }
  public function viewcashsellreport(Request $request)
  {
    $date = Carbon::parse($request->id)->format('Y-m-d');
    $branch = Session::get('branch');
    $query  = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->select('qcrm_customer_details.cust_name as customer', 'qsell_saleinvoice.id', 'totalamount', 'vatamount', 'grandtotalamount', 'quotedate')->orderby('qsell_saleinvoice.id', 'desc');
    $query->where('qsell_saleinvoice.quotedate', $date)->where('qsell_saleinvoice.sale_method', 1)->where('qsell_saleinvoice.branch', $branch);
    $data = $query->get();

    return view('Reports.sales.cashsales_report_view', compact('data'));
  }
  public function creditsell_report(Request $request)
  {
    $branch = Session::get('branch');

    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->where('sale_method', 2);
    $data = $query->get();

    return view('Reports.sales.creditsell_report', compact('data'));
  }

  public function viewcreditsellreport(Request $request)
  {

    $date = Carbon::parse($request->id)->format('Y-m-d');
    $branch = Session::get('branch');
    $query  = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->select('qcrm_customer_details.cust_name as customer', 'qsell_saleinvoice.id', 'totalamount', 'vatamount', 'grandtotalamount', 'quotedate')->orderby('qsell_saleinvoice.id', 'desc');
    $query->where('quotedate', $date)->where('qsell_saleinvoice.sale_method', 2)->where('qsell_saleinvoice.branch', $branch);
    $data = $query->get();

    return view('Reports.sales.viewcreditsellreport', compact('data'));
  }
  public function sellvatlistreports(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";
    // dd($details);
    return view('Reports.sales.sellvatreports', compact('details'));
  }
  public function sellvatlist(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');

    DB::enableQueryLog();

    // and then you can get query log


    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('qcrm_customer_documents', 'qcrm_customer_details.id', '=', 'qcrm_customer_documents.customer_id')->select('*', 'qcrm_customer_details.cust_name', 'qcrm_customer_documents.vat_no', 'qcrm_customer_details.buyerid_crno', 'qsell_saleinvoice.id as sid', DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('quotedate', [$fromdate, $todate])->orderby('qsell_saleinvoice.quotedate', 'ASC')->groupBy('qsell_saleinvoice.id')->get();
    //dd(DB::getQueryLog());
    return view('Reports.sales.sellvatlists', compact('details', 'fromdate', 'todate'));
  }
  public function sell_reportpdf_print(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('qcrm_customer_documents', 'qcrm_customer_details.id', '=', 'qcrm_customer_documents.customer_id')->select('*', 'qcrm_customer_details.cust_name', 'qcrm_customer_documents.vat_no', 'qcrm_customer_details.buyerid_crno', 'qsell_saleinvoice.id as sid', DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('quotedate', [$fromdate, $todate])->orderby('qsell_saleinvoice.quotedate', 'ASC')->groupBy('qsell_saleinvoice.id')->get();





    $pdf = PDF::loadview('Reports.sales.sellvatpdf', compact('details', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }

  public function sell_reportexcel_print(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    return Excel::download(new InvoicesExport, 'invoices.xlsx');
  }


  public function sellreports1(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";
    // dd($details);
    return view('Reports.sales.sellreports1', compact('details'));
  }

  public function sellreportsubmit(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');

    DB::enableQueryLog();

    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.customer', '=', 'qcrm_salesman_details.id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('qsell_saleinvoice.quotedate', [$fromdate, $todate])->get();
    return view('Reports.sales.sellreportsall', compact('details', 'fromdate', 'todate'));
  }

  public function sell_report1pdf_print(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    DB::enableQueryLog();

    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.customer', '=', 'qcrm_salesman_details.id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('qsell_saleinvoice.quotedate', [$fromdate, $todate])->get();

    $pdf = PDF::loadview('Reports.sales.sellreportsallpdf', compact('details', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
  public function sellreceivable(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";
    // dd($details);
    return view('Reports.sales.sellreceivable', compact('details'));
  }

  public function sellreceivablereportsubmit(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');

    DB::enableQueryLog();

    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.customer', '=', 'qcrm_salesman_details.id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('qsell_saleinvoice.quotedate', [$fromdate, $todate])->get();
    return view('Reports.sales.sellreceivablereportall', compact('details', 'fromdate', 'todate'));
  }

  public function sell_receivable_reportpdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    DB::enableQueryLog();

    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.customer', '=', 'qcrm_salesman_details.id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('qsell_saleinvoice.quotedate', [$fromdate, $todate])->get();

    $pdf = PDF::loadview('Reports.sales.sellreceivablereportsallpdf', compact('details', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }

  public function sellpayablereport(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";
    // dd($details);
    return view('Reports.sales.sellpayablereport', compact('details'));
  }

  public function sellpayablereportsubmit(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');

    DB::enableQueryLog();

    $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.name', '=', 'qcrm_supplier.id')->leftjoin('qcrm_salesman_details', 'qbuy_purchase_pi.purchaser', '=', 'qcrm_salesman_details.id')->select('qbuy_purchase_pi.*', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name')->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->whereBetween('qbuy_purchase_pi.bill_entry_date', [$fromdate, $todate])->get();
    return view('Reports.sales.sellpayablereportall', compact('details', 'fromdate', 'todate'));
  }
  public function sell_payable_reportpdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    DB::enableQueryLog();

    $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.name', '=', 'qcrm_supplier.id')->leftjoin('qcrm_salesman_details', 'qbuy_purchase_pi.purchaser', '=', 'qcrm_salesman_details.id')->select('qbuy_purchase_pi.*', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name')->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->whereBetween('qbuy_purchase_pi.bill_entry_date', [$fromdate, $todate])->get();

    $pdf = PDF::loadview('Reports.sales.sellpayablereportsallpdf', compact('details', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
  public function sellincome(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";

    $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
    $subledgertable = $subtable . 'ledgers';

    $subledgertables = DB::table($subtable . 'ledgers')->select('*')->get();


    // dd($details);
    return view('Reports.sales.sellincome', compact('details', 'subledgertables'));
  }

  public function sellincomereportsubmit(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $pmethods = $request->mode;

    DB::enableQueryLog();
    // $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details','qsell_saleinvoice.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsell_saleinvoice.customer','=','qcrm_salesman_details.id')->select('qsell_saleinvoice.*','qcrm_customer_details.cust_name','qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag',1)->where('qsell_saleinvoice.branch',$branch)->whereBetween('qsell_saleinvoice.quotedate',[$fromdate,$todate])->get();

    $advancepayment = DB::table('qsell_advancepayment_payment_method')->leftjoin('qsell_advancepayment', 'qsell_advancepayment_payment_method.payid', '=', 'qsell_advancepayment.id')->leftjoin('qcrm_customer_details', 'qsell_advancepayment.customer', '=', 'qcrm_customer_details.id')->select('qsell_advancepayment.*', 'qsell_advancepayment_payment_method.*', 'qcrm_customer_details.cust_name')->whereBetween('qsell_advancepayment.date', [$fromdate, $todate])->where('qsell_advancepayment_payment_method.del_flag', 1)->where('qsell_advancepayment_payment_method.branch', $branch)->get();

    $billsettlement = DB::table('qsell_billsettlement_payment_method')->leftjoin('qsell_billsettlement', 'qsell_billsettlement_payment_method.bill_id', '=', 'qsell_billsettlement.id',)->leftjoin('qcrm_customer_details', 'qsell_billsettlement.customer', '=', 'qcrm_customer_details.id')->select('qsell_billsettlement.*', 'qsell_billsettlement_payment_method.*', 'qcrm_customer_details.cust_name')->whereIn('qsell_billsettlement_payment_method.modeofpayment', $pmethods)->whereBetween('qsell_billsettlement.transactiondate', [$fromdate, $todate])->where('qsell_billsettlement.del_flag', 1)->where('qsell_billsettlement.branch', $branch)->get();
    //dd( $billsettlement);
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    // return view('Reports.sales.sellincomereportall',compact('fromdate','todate','advancepayment','billsettlement','pmethods'));
    $pdf = PDF::loadview('Reports.sales.sellincomereportsallpdf', compact('branchsettings', 'advancepayment', 'billsettlement'));
    return $pdf->stream('Income.pdf');
  }

  public function sell_income_reportpdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $pmethods = $request->mode;
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    DB::enableQueryLog();

    $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.customer', '=', 'qcrm_salesman_details.id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('qsell_saleinvoice.quotedate', [$fromdate, $todate])->get();

    $advancepayment = DB::table('qsell_advancepayment_payment_method')->leftjoin('qsell_advancepayment', 'qsell_advancepayment_payment_method.payid', '=', 'qsell_advancepayment.id')->leftjoin('qcrm_customer_details', 'qsell_advancepayment.customer', '=', 'qcrm_customer_details.id')->select('qsell_advancepayment.*', 'qsell_advancepayment_payment_method.*', 'qcrm_customer_details.cust_name')->whereBetween('qsell_advancepayment.date', [$fromdate, $todate])->where('qsell_advancepayment_payment_method.del_flag', 1)->where('qsell_advancepayment_payment_method.branch', $branch)->get();

    $billsettlement = DB::table('qsell_billsettlement_payment_method')->leftjoin('qsell_billsettlement', 'qsell_billsettlement_payment_method.bill_id', '=', 'qsell_billsettlement.id',)->leftjoin('qcrm_customer_details', 'qsell_billsettlement.customer', '=', 'qcrm_customer_details.id')->select('qsell_billsettlement.*', 'qsell_billsettlement_payment_method.*', 'qcrm_customer_details.cust_name')->whereIn('qsell_billsettlement_payment_method.modeofpayment', $pmethods)->whereBetween('qsell_billsettlement.transactiondate', [$fromdate, $todate])->where('qsell_billsettlement.del_flag', 1)->where('qsell_billsettlement.branch', $branch)->get();


    $pdf = PDF::loadview('Reports.sales.sellincomereportsallpdf', compact('details', 'branchsettings', 'advancepayment', 'billsettlement'));
    return $pdf->stream('sales.pdf');
  }

  public function sellexpense(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";
    // dd($details);
    return view('Reports.sales.sellexpense', compact('details'));
  }

  public function sellexpensereportsubmit(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    /*   $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch=Session::get('branch');
       
DB::enableQueryLog();

      /*  $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details','qsell_saleinvoice.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsell_saleinvoice.customer','=','qcrm_salesman_details.id')->select('qsell_saleinvoice.*','qcrm_customer_details.cust_name','qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag',1)->where('qsell_saleinvoice.branch',$branch)->whereBetween('qsell_saleinvoice.quotedate',[$fromdate,$todate])->get();


 $branch=Session::get('branch');
$subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
            $subledgertable= $subtable.'ledgers';
        $details = DB::table('buy_voucher_products')->select('buy_account_head.head_name as head_names','buy_voucher_products.*',$subtable.'ledgers.*','buy_voucher.*')->leftjoin($subtable.'ledgers','buy_voucher_products.ledger','=',$subtable.'ledgers.id')->leftjoin('buy_account_head','buy_voucher_products.head_name','=','buy_account_head.id')->leftjoin('buy_voucher','buy_voucher_products.main_voucher_id','=','buy_voucher.id')->where('buy_voucher_products.branch',$branch)->where('buy_voucher_products.del_flag',1)->whereBetween('buy_voucher.entrydate',[$fromdate,$todate])->get();




         return view('Reports.sales.sellexpensereportall',compact('details','fromdate','todate'));*/



    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $pmethods = $request->mode;

    DB::enableQueryLog();
    // $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details','qsell_saleinvoice.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsell_saleinvoice.customer','=','qcrm_salesman_details.id')->select('qsell_saleinvoice.*','qcrm_customer_details.cust_name','qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag',1)->where('qsell_saleinvoice.branch',$branch)->whereBetween('qsell_saleinvoice.quotedate',[$fromdate,$todate])->get();

    $advancepayment = DB::table('qbuy_advancepayment_payment_method')->leftjoin('qbuy_advancepayment', 'qbuy_advancepayment_payment_method.payid', '=', 'qbuy_advancepayment.id')->leftjoin('qcrm_supplier', 'qbuy_advancepayment.name', '=', 'qcrm_supplier.id')->select('qbuy_advancepayment.*', 'qbuy_advancepayment_payment_method.*', 'qcrm_supplier.sup_name')->whereBetween('qbuy_advancepayment.date', [$fromdate, $todate])->where('qbuy_advancepayment_payment_method.del_flag', 1)->where('qbuy_advancepayment_payment_method.branch', $branch)->get();

    $billsettlement = DB::table('buy_billsettlement_payment_method')->leftjoin('buy_billsettlement', 'buy_billsettlement_payment_method.bill_id', '=', 'buy_billsettlement.id',)->leftjoin('qcrm_supplier', 'buy_billsettlement.supplier', '=', 'qcrm_supplier.id')->select('buy_billsettlement.*', 'buy_billsettlement_payment_method.*', 'qcrm_supplier.sup_name')->whereIn('buy_billsettlement_payment_method.modeofpayment', $pmethods)->whereBetween('buy_billsettlement.transactiondate', [$fromdate, $todate])->where('buy_billsettlement.del_flag', 1)->where('buy_billsettlement.branch', $branch)->get();

    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    // return view('Reports.sales.sellincomereportall',compact('fromdate','todate','advancepayment','billsettlement','pmethods'));
    $pdf = PDF::loadview('Reports.sales.sellexpensereportsallpdf', compact('branchsettings', 'advancepayment', 'billsettlement'));
    return $pdf->stream('Income.pdf');
  }

  public function sell_expense_reportpdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    DB::enableQueryLog();

    /*        $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details','qsell_saleinvoice.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsell_saleinvoice.customer','=','qcrm_salesman_details.id')->select('qsell_saleinvoice.*','qcrm_customer_details.cust_name','qcrm_salesman_details.name')->where('qsell_saleinvoice.del_flag',1)->where('qsell_saleinvoice.branch',$branch)->whereBetween('qsell_saleinvoice.quotedate',[$fromdate,$todate])->get();*/


    $branch = Session::get('branch');
    $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
    $subledgertable = $subtable . 'ledgers';
    $details = DB::table('buy_voucher_products')->select('buy_account_head.head_name as head_names', 'buy_voucher_products.*', $subtable . 'ledgers.*', 'buy_voucher.*')->leftjoin($subtable . 'ledgers', 'buy_voucher_products.ledger', '=', $subtable . 'ledgers.id')->leftjoin('buy_account_head', 'buy_voucher_products.head_name', '=', 'buy_account_head.id')->leftjoin('buy_voucher', 'buy_voucher_products.main_voucher_id', '=', 'buy_voucher.id')->where('buy_voucher_products.branch', $branch)->where('buy_voucher_products.del_flag', 1)->whereBetween('buy_voucher.entrydate', [$fromdate, $todate])->get();



    $pdf = PDF::loadview('Reports.sales.sellexpensereportsallpdf', compact('details', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
  public function sell_report_pdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch);
    $data = $query->get();

    $pdf = PDF::loadview('Reports.sales.salesreportsallpdf', compact('data', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }

  public function dailysalesreport(Request $request)
  {
    $branch = Session::get('branch');
    return view('Reports.sales.dailysales');
  }
  public function dailysalessubmit(Request $request)
  {
    $branch = Session::get('branch');
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->whereBetween('quotedate', [$fromdate, $todate]);
    $data = $query->get();
    return view('Reports.sales.dailysalesreport', compact('data', 'fromdate', 'todate'));
  }
  public function sell_report_pdf_bydate(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $branch = Session::get('branch');
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->whereBetween('quotedate', [$fromdate, $todate]);
    $data = $query->get();

    $pdf = PDF::loadview('Reports.sales.salesreportsallpdf_bydate', compact('data', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
  public function cashsell_report_bydate(Request $request)
  {
    $branch = Session::get('branch');
    return view('Reports.sales.dailycashsales');
  }
  public function dailycashsalessubmit(Request $request)
  {
    $branch = Session::get('branch');
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->where('sale_method', 1)->whereBetween('quotedate', [$fromdate, $todate]);
    $data = $query->get();

    return view('Reports.sales.cashsalesreport', compact('data', 'fromdate', 'todate'));
  }
  public function cashsell_report_pdf_bydate(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $branch = Session::get('branch');
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->whereBetween('quotedate', [$fromdate, $todate])->where('sale_method', 1);
    $data = $query->get();

    $pdf = PDF::loadview('Reports.sales.cashsalesreportsallpdf_bydate', compact('data', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
  public function creditsell_report_bydate(Request $request)
  {
    $branch = Session::get('branch');
    return view('Reports.sales.dailycreditsales');
  }

  public function dailycreditsalessubmit(Request $request)
  {
    $branch = Session::get('branch');
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->where('sale_method', 2)->whereBetween('quotedate', [$fromdate, $todate]);
    $data = $query->get();

    return view('Reports.sales.creditsalesreport', compact('data', 'fromdate', 'todate'));
  }

  public function creditsell_report_pdf_bydate(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $branch = Session::get('branch');
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    $query  = DB::table('qsell_saleinvoice')->select('quotedate', 'id', DB::raw('SUM(totalamount) as totalamounts'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(quotedate, '%d-%m-%Y') as quotedate"))->groupBy('quotedate');
    $query->where('del_flag', 1)->where('branch', $branch)->whereBetween('quotedate', [$fromdate, $todate])->where('sale_method', 2);
    $data = $query->get();

    $pdf = PDF::loadview('Reports.sales.creditsalesreportsallpdf_bydate', compact('data', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
  public function sell_report_date_pdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    $date = Carbon::parse($request->ddate)->format('Y-m-d');
    $date1 = Carbon::parse($date)->format('d-m-Y');
    $branch = Session::get('branch');
    $query  = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->select('qcrm_customer_details.cust_name as customer', 'qsell_saleinvoice.id', 'totalamount', 'vatamount', 'grandtotalamount', 'quotedate')->orderby('qsell_saleinvoice.id', 'desc');
    $query->where('qsell_saleinvoice.quotedate', $date)->where('qsell_saleinvoice.branch', $branch);
    $data = $query->get();

    $pdf = PDF::loadview('Reports.sales.sell_report_date_pdf', compact('data', 'branchsettings', 'date1'));
    return $pdf->stream('sales.pdf');
  }
}

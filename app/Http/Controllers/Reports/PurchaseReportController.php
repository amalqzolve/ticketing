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
use Zend\Validator\InArray;

class PurchaseReportController extends Controller
{


  public function All(Request $request)
  {
    if (($request->fromdate != '') && ($request->todate != '')) {
      $branch = Session::get('branch');
      $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
      $todate = Carbon::parse($request->todate)->format('Y-m-d');
      $query  = DB::table('qbuy_purchase_pi')
        ->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')
        ->select('qbuy_purchase_pi.quotedate', 'qbuy_purchase_pi.id', 'qbuy_purchase_pi.amountafterdiscount', 'qbuy_purchase_pi.vatamount as vatamounts', 'qbuy_purchase_pi.grandtotalamount as grandtotalamounts', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qcrm_supplier.sup_name')
        ->whereBetween('qbuy_purchase_pi.bill_entry_date', [$fromdate, $todate])
        ->orderBy('qbuy_purchase_pi.bill_entry_date');
      $query->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch);
      $data = $query->get();
    } else {
      $data = array();
      $fromdate = date('Y-m-d');
      $todate = date('Y-m-d');
    }
    return view('Reports.purchase.all.Index', compact('data', 'fromdate', 'todate'));
  }


  public function AllPdf(Request $request)
  {
    if (($request->fromdate != '') && ($request->todate != '')) {
      ini_set("pcre.backtrack_limit", "100000000000");
      $branch = Session::get('branch');
      $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
      $todate = Carbon::parse($request->todate)->format('Y-m-d');
      $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
      $query  = DB::table('qbuy_purchase_pi')
        ->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')
        ->select('qbuy_purchase_pi.quotedate', 'qbuy_purchase_pi.id', 'qbuy_purchase_pi.amountafterdiscount', 'qbuy_purchase_pi.vatamount as vatamounts', 'qbuy_purchase_pi.grandtotalamount as grandtotalamounts', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qcrm_supplier.sup_name')
        ->whereBetween('qbuy_purchase_pi.bill_entry_date', [$fromdate, $todate])
        ->orderBy('qbuy_purchase_pi.bill_entry_date');
      $query->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch);
      $data = $query->get();

      $pdf = PDF::loadview('Reports.purchase.all.pdf', compact('data', 'branchsettings'));
      return $pdf->stream('sales.pdf');
    } else
      echo "select Date First";
  }

  public function byDate(Request $request)
  {
    if (($request->fromdate != '') && ($request->todate != '')) {
      $branch = Session::get('branch');
      $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
      $todate = Carbon::parse($request->todate)->format('Y-m-d');
      $query  = DB::table('qbuy_purchase_pi')->select('bill_entry_date', 'id', DB::raw('SUM(amountafterdiscount) as amountafterdiscount'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(bill_entry_date, '%d-%m-%Y') as bill_entry_date"))
        ->whereBetween('bill_entry_date', [$fromdate, $todate])
        ->groupBy('bill_entry_date');
      $query->where('del_flag', 1)->where('branch', $branch);
      $data = $query->get();
    } else {
      $data = array();
      $fromdate = date('Y-m-d');
      $todate = date('Y-m-d');
    }
    return view('Reports.purchase.bydate.Index', compact('data', 'fromdate', 'todate'));
  }


  public function byDatePdf(Request $request)
  {
    if (($request->fromdate != '') && ($request->todate != '')) {
      ini_set("pcre.backtrack_limit", "100000000000");
      $branch = Session::get('branch');
      $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
      $todate = Carbon::parse($request->todate)->format('Y-m-d');
      $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
      $query  = DB::table('qbuy_purchase_pi')->select('bill_entry_date', 'id', DB::raw('SUM(amountafterdiscount) as amountafterdiscount'), DB::raw('SUM(vatamount) as vatamounts'), DB::raw('SUM(grandtotalamount) as grandtotalamounts'), DB::raw("DATE_FORMAT(bill_entry_date, '%d-%m-%Y') as bill_entry_date"))
        ->whereBetween('bill_entry_date', [$fromdate, $todate])
        ->groupBy('bill_entry_date');
      $query->where('del_flag', 1)->where('branch', $branch);
      $data = $query->get();

      $pdf = PDF::loadview('Reports.purchase.bydate.pdf', compact('data', 'branchsettings'));
      return $pdf->stream('sales.pdf');
    } else
      echo "select Date First";
  }


  public function vatIndex(Request $request)
  {
    $branch = Session::get('branch');
    $details = "";
    return view('Reports.purchase.vat.index', compact('details'));
  }

  public function vatList(Request $request)
  {
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')->leftJoin('qcrm_customer_documents', 'qcrm_supplier.id', '=', 'qcrm_customer_documents.customer_id')->select('*', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno', 'qbuy_purchase_pi.id as sid', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qbuy_purchase_pi.id')->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->whereBetween('bill_entry_date', [$fromdate, $todate])->orderby('qbuy_purchase_pi.bill_entry_date', 'ASC')->groupBy('qbuy_purchase_pi.id')->get();
    return view('Reports.purchase.vat.list', compact('details', 'fromdate', 'todate'));
  }

  public function vatListPdf(Request $request)
  {
    ini_set("pcre.backtrack_limit", "100000000000");
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
    $details = DB::table('qbuy_purchase_pi')->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')->leftJoin('qcrm_customer_documents', 'qcrm_supplier.id', '=', 'qcrm_customer_documents.customer_id')->select('*', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno', 'qbuy_purchase_pi.id as sid', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qbuy_purchase_pi.id')->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->whereBetween('bill_entry_date', [$fromdate, $todate])->orderby('qbuy_purchase_pi.bill_entry_date', 'ASC')->groupBy('qbuy_purchase_pi.id')->get();
    $pdf = PDF::loadview('Reports.purchase.vat.pdf', compact('details', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
}

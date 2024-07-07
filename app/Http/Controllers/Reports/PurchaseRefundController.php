<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;
use Session;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;

class PurchaseRefundController extends Controller
{

  public function index(Request $request)
  {
    $branch = Session::get('branch');
    $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
    if (($request->fromdate != '') && ($request->todate != '')) {
      $selectedSalesMan = $request->selectedSalesMan;
      $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
      $todate = Carbon::parse($request->todate)->format('Y-m-d');

      $data =  DB::table('qbuy_refund')
        ->leftjoin('qcrm_supplier', 'qbuy_refund.supplier_id', '=', 'qcrm_supplier.id')
        ->leftjoin('qbuy_purchase_return', 'qbuy_refund.qbuy_purchase_return_id', '=', 'qbuy_purchase_return.id')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_refund.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->select('qbuy_refund.*', DB::raw("DATE_FORMAT(qbuy_refund.date, '%d-%m-%Y') as date"), 'qcrm_supplier.sup_name', 'qbuy_purchase_pi.id as invoice_id', 'qbuy_purchase_return.id as return_id', DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
        ->whereBetween('qbuy_refund.date', [$fromdate, $todate])
        ->where('qbuy_refund.branch', $branch)
        ->orderBy('qbuy_refund.date', 'asc')
        ->get();
    } else {
      $data = array();
      $fromdate = date('Y-m-d');
      $todate = date('Y-m-d');
      $selectedSalesMan = array();
    }
    return view('Reports.purchase.refund.index', compact('data', 'fromdate', 'todate', 'salesmen', 'selectedSalesMan'));
  }


  public function pdf(Request $request)
  {
    if (($request->fromdate != '') && ($request->todate != '')) {
      $branch = Session::get('branch');
      $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
      $todate = Carbon::parse($request->todate)->format('Y-m-d');
      $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
      $data =  DB::table('qbuy_refund')
        ->leftjoin('qcrm_supplier', 'qbuy_refund.supplier_id', '=', 'qcrm_supplier.id')
        ->leftjoin('qbuy_purchase_return', 'qbuy_refund.qbuy_purchase_return_id', '=', 'qbuy_purchase_return.id')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_refund.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->select('qbuy_refund.*', DB::raw("DATE_FORMAT(qbuy_refund.date, '%d-%m-%Y') as date"), 'qcrm_supplier.sup_name', 'qbuy_purchase_pi.id as invoice_id', 'qbuy_purchase_return.id as return_id', DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
        ->whereBetween('qbuy_refund.date', [$fromdate, $todate])
        ->where('qbuy_refund.branch', $branch)
        ->orderBy('qbuy_refund.date', 'asc')
        ->get();

      $pdf = PDF::loadview('Reports.purchase.refund.pdf', compact('data', 'branchsettings'));
      return $pdf->stream('purchase.pdf');
    } else
      echo "select Date First";
  }
}

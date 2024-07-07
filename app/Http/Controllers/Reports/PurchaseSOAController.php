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

class PurchaseSOAController extends Controller
{

  public function purchaseSoa(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $ccid = (isset($request->supplier)) ? $request->supplier : '';
    $suppliers   = DB::table('qcrm_supplier')
      ->select('id', 'sup_name', 'sup_code')
      ->where('del_flag', 1)
      ->where('branch', $branch)
      ->get();
    if ($ccid != '') {
      // $opening_balanceRes = DB::table('qbuy_purchaseorder_soa')
      //   ->select(DB::raw('SUM(qbuy_purchaseorder_soa.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_purchaseorder_soa.cr_amount) as cr_amount'))
      //   ->where('qbuy_purchaseorder_soa.supplier_id', $ccid)
      //   ->where('qbuy_purchaseorder_soa.branch', $branch)
      //   ->whereDate('doc_transaction', '<', $fromdate)
      //   ->first();
      // $opening_balance = $opening_balanceRes->dr_amount - $opening_balanceRes->cr_amount;

      $opening_balance = DB::table('qbuy_purchaseorder_soa')
        ->select(DB::raw('SUM(qbuy_purchaseorder_soa.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_purchaseorder_soa.cr_amount) as cr_amount'))
        ->where('qbuy_purchaseorder_soa.supplier_id', $ccid)
        ->where('qbuy_purchaseorder_soa.branch', $branch)
        ->whereDate('doc_transaction', '<', $fromdate)
        ->first();

      // $transaction = DB::table('qbuy_purchaseorder_soa')
      //   ->select(DB::raw('SUM(qbuy_purchaseorder_soa.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_purchaseorder_soa.cr_amount) as cr_amount'))
      //   ->where('qbuy_purchaseorder_soa.supplier_id', $ccid)
      //   ->where('qbuy_purchaseorder_soa.branch', $branch)
      //   ->whereBetween('doc_transaction', [$fromdate, $todate])
      //   ->first();

      $transaction = DB::table('qbuy_purchaseorder_soa')
        ->select('qbuy_purchaseorder_soa.*', DB::raw("DATE_FORMAT(qbuy_purchaseorder_soa.doc_transaction, '%d-%m-%Y') as doc_transaction"))
        ->where('qbuy_purchaseorder_soa.supplier_id', $ccid)
        ->where('qbuy_purchaseorder_soa.branch', $branch)
        ->whereBetween('doc_transaction', [$fromdate, $todate])
        ->orderBy('qbuy_purchaseorder_soa.doc_transaction', 'asc')
        ->get();

      return view('Reports.purchase.soa.listing', compact('suppliers', 'ccid', 'opening_balance', 'transaction', 'fromdate', 'todate'));
    }
    return view('Reports.purchase.soa.listing', compact('suppliers', 'ccid', 'fromdate', 'todate'));
  }

  public function pdf(Request $request)
  {
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $cid = $request->cid;
    $branch = Session::get('branch');

    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();

    $supplier   = DB::table('qcrm_supplier')
      ->leftJoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')
      ->select('qcrm_supplier.id', 'qcrm_supplier.sup_name', 'qcrm_supplier.sup_add1', 'qcrm_supplier.sup_add2', 'qcrm_supplier.sup_region', 'qcrm_supplier.sup_city', 'qcrm_supplier.mobile1', 'countries.cntry_name')
      ->where('qcrm_supplier.del_flag', 1)
      ->where('qcrm_supplier.id', $cid)
      ->first();
    $opening_balance = DB::table('qbuy_purchaseorder_soa')
      ->select(DB::raw('SUM(qbuy_purchaseorder_soa.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_purchaseorder_soa.cr_amount) as cr_amount'))
      ->where('qbuy_purchaseorder_soa.supplier_id', $cid)
      ->where('qbuy_purchaseorder_soa.branch', $branch)
      ->whereDate('doc_transaction', '<', $fromdate)
      ->first();
    // $opening_balance = $opening_balance->dr_amount - $opening_balance->cr_amount;

    $transaction = DB::table('qbuy_purchaseorder_soa')
      ->select('qbuy_purchaseorder_soa.*', DB::raw("DATE_FORMAT(qbuy_purchaseorder_soa.doc_transaction, '%d-%m-%Y') as doc_transaction"))
      ->where('qbuy_purchaseorder_soa.supplier_id', $cid)
      ->where('qbuy_purchaseorder_soa.branch', $branch)
      ->whereBetween('doc_transaction', [$fromdate, $todate])
      ->orderBy('qbuy_purchaseorder_soa.doc_transaction', 'asc')
      ->get();


    $fromdate = Carbon::parse($request->fromdate)->format('d-m-Y');
    $todate = Carbon::parse($request->todate)->format('d-m-Y');

    $pdf = PDF::loadview('Reports.purchase.soa.pdf', compact('transaction', 'opening_balance', 'fromdate', 'todate', 'branchsettings', 'supplier',));
    return $pdf->stream('sales.pdf');
  }
}

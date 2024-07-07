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

class PurchasePayableController extends Controller
{
  public function payable(Request $request)
  {
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $type = (isset($request->type)) ? $request->type : '';
    $tableOn = $request->fromdate;
    if ($request->fromdate != '') {
      $transaction = DB::table('qbuy_purchase_pi')
        ->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')
        ->select('qbuy_purchase_pi.id', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qbuy_purchase_pi.amountafterdiscount', 'vatamount', 'grandtotalamount', 'paid_amount', 'advance_amt', 'balance_amount', 'qcrm_supplier.sup_name')
        ->where('qbuy_purchase_pi.branch', $branch)
        ->whereBetween('qbuy_purchase_pi.bill_entry_date', [$fromdate, $todate])
        ->orderBy('qbuy_purchase_pi.bill_entry_date', 'asc')
        ->get();



      // dd($transaction);
      return view('Reports.purchase.payable.listing', compact('transaction', 'type', 'fromdate', 'todate', 'tableOn'));
    }
    return view('Reports.purchase.payable.listing', compact('type', 'fromdate', 'todate', 'tableOn'));
  }

  public function payablepdf(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $cid = $request->cid;
    $branch = Session::get('branch');

    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();


    $transaction = DB::table('qbuy_purchase_pi')
      ->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')
      ->select('qbuy_purchase_pi.id',  DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qbuy_purchase_pi.amountafterdiscount', 'vatamount', 'grandtotalamount', 'paid_amount', 'advance_amt', 'balance_amount', 'qcrm_supplier.sup_name')
      ->where('qbuy_purchase_pi.branch', $branch)
      ->whereBetween('qbuy_purchase_pi.bill_entry_date', [$fromdate, $todate])
      ->orderBy('qbuy_purchase_pi.bill_entry_date', 'asc')
      ->get();


    $fromdate = Carbon::parse($request->fromdate)->format('d-m-Y');
    $todate = Carbon::parse($request->todate)->format('d-m-Y');
    $pdf = PDF::loadview('Reports.purchase.payable.pdf', compact('transaction', 'fromdate', 'todate', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
}

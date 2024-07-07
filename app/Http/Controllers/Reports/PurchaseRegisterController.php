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

class PurchaseRegisterController extends Controller
{
  public function purchase_register(Request $request)
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

      $updatedTransaction = $transaction->map(function ($inv) {
        $by_billsettilement = 0;

        $paid_by_cash = 0;
        $paid_by_bank = 0;
        $paid_by_card = 0;
        $payAtInvoice = 0;
        if ($inv->paid_amount > 0) {
          $payments = DB::table('qbuy_purchase_pi_payments')
            ->select(DB::raw('SUM(pay_amount) as pay_amount'), 'type')
            ->where('qbuy_purchase_pi_id', $inv->id)
            ->groupBy('type')
            ->get();
          foreach ($payments as $key => $value) {
            if ($value->type == 'By Cash')
              $paid_by_cash += $value->pay_amount;
            if ($value->type == 'By Card')
              $paid_by_card += $value->pay_amount;
            if ($value->type == 'By Bank')
              $paid_by_bank += $value->pay_amount;
          }

          $payAtInvoice = $paid_by_cash + $paid_by_bank + $paid_by_card + $inv->advance_amt;
        }

        $paid_amount =    $inv->grandtotalamount - $inv->balance_amount;
        $by_billsettilement = $paid_amount - $payAtInvoice;

        $outArray = array(
          'id' => $inv->id,
          'bill_entry_date' => $inv->bill_entry_date,
          'sup_name' => $inv->sup_name,
          'amountafterdiscount' => $inv->amountafterdiscount,
          'vatamount' => $inv->vatamount,
          'grandtotalamount' => $inv->grandtotalamount,
          'paid_amount' => $paid_amount,
          'advance_amt' => $inv->advance_amt,
          'paid_by_cash' => $paid_by_cash,
          'paid_by_bank' => $paid_by_bank,
          'paid_by_card' => $paid_by_card,
          'by_billsettilement' => $by_billsettilement,
          'balance_amount' => $inv->balance_amount,
        );
        return $outArray;
      });

      // dd($transaction);
      return view('Reports.purchase.purchase_register.listing', compact('updatedTransaction', 'type', 'fromdate', 'todate', 'tableOn'));
    }
    return view('Reports.purchase.purchase_register.listing', compact('type', 'fromdate', 'todate', 'tableOn'));
  }

  public function purchase_registerpdf(Request $request)
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

    $updatedTransaction = $transaction->map(function ($inv) {
      $by_billsettilement = 0;

      $paid_by_cash = 0;
      $paid_by_bank = 0;
      $paid_by_card = 0;
      $payAtInvoice = 0;
      if ($inv->paid_amount > 0) {
        $payments = DB::table('qbuy_purchase_pi_payments')
          ->select(DB::raw('SUM(pay_amount) as pay_amount'), 'type')
          ->where('qbuy_purchase_pi_id', $inv->id)
          ->groupBy('type')
          ->get();
        foreach ($payments as $key => $value) {
          if ($value->type == 'By Cash')
            $paid_by_cash += $value->pay_amount;
          if ($value->type == 'By Card')
            $paid_by_card += $value->pay_amount;
          if ($value->type == 'By Bank')
            $paid_by_bank += $value->pay_amount;
        }

        $payAtInvoice = $paid_by_cash + $paid_by_bank + $paid_by_card + $inv->advance_amt;
      }

      $paid_amount =    $inv->grandtotalamount - $inv->balance_amount;
      $by_billsettilement = $paid_amount - $payAtInvoice;

      $outArray = array(
        'id' => $inv->id,
        'bill_entry_date' => $inv->bill_entry_date,
        'sup_name' => $inv->sup_name,
        'amountafterdiscount' => $inv->amountafterdiscount,
        'vatamount' => $inv->vatamount,
        'grandtotalamount' => $inv->grandtotalamount,
        'paid_amount' => $paid_amount,
        'advance_amt' => $inv->advance_amt,
        'paid_by_cash' => $paid_by_cash,
        'paid_by_bank' => $paid_by_bank,
        'paid_by_card' => $paid_by_card,
        'by_billsettilement' => $by_billsettilement,
        'balance_amount' => $inv->balance_amount,
      );
      return $outArray;
    });


    $fromdate = Carbon::parse($request->fromdate)->format('d-m-Y');
    $todate = Carbon::parse($request->todate)->format('d-m-Y');
    $pdf = PDF::loadview('Reports.purchase.purchase_register.pdf', compact('updatedTransaction', 'fromdate', 'todate', 'branchsettings'));
    return $pdf->stream('sales.pdf');
  }
}

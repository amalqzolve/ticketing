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

class SalesSOAController extends Controller
{

  public function salessao(Request $request)
  {
    $branch = Session::get('branch');

    $details = "";
    // dd($details);
    if (Session::get('common_customer_database') == 1) {
      $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->get();
    } else {
      $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();
    }
    return view('Reports.sales.soa.listing', compact('customers', 'details'));
  }

  public function salessoasubmit(Request $request)
  {

    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $branch = Session::get('branch');
    $cid = $request->customer;
    /*     if(Session::get('common_customer_database')==1)
        {
        $customers   = DB::table('qcrm_customer_details')->select('id','cust_name')->where('del_flag',1)->get();
    }
    else
    {
        $customers   = DB::table('qcrm_customer_details')->select('id','cust_name')->where('del_flag',1)->where('branch',$branch)->get();
    }*/
    if (Session::get('common_customer_database') == 1) {
      $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('id', $cid)->get();
    } else {
      $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->where('id', $cid)->get();
    }


    $opening_balance = DB::table('qsell_salesorder_soa')->select('*')->where('qsell_salesorder_soa.del_flag', 1)->where('qsell_salesorder_soa.branch', $branch)->where('qsell_salesorder_soa.customer_id', $cid)->whereDate('doc_transaction', '<', $fromdate)->orderBy('qsell_salesorder_soa.doc_id', 'asc')->get();



    //
    // $details = DB::table('qsell_salesorder_soa')->select('*')->where('qsell_salesorder_soa.del_flag',1)->where('qsell_salesorder_soa.branch',$branch)->where('qsell_salesorder_soa.customer_id',$request->customer)->whereDate('doc_transaction','>=',$fromdate)->whereDate('doc_transaction','<=',$todate)->get();


    $details = DB::table('qsell_salesorder_soa')->leftjoin('qcrm_customer_details', 'qsell_salesorder_soa.customer_id', '=', 'qcrm_customer_details.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('*', DB::raw("DATE_FORMAT(qsell_salesorder_soa.doc_transaction, '%d-%m-%Y') as doc_transaction"), 'qcrm_customer_details.*', 'countries.*')->whereBetween('doc_transaction', [$fromdate, $todate])->where('qsell_salesorder_soa.del_flag', 1)->where('qsell_salesorder_soa.branch', $branch)->where('qsell_salesorder_soa.customer_id', $cid)->get();
    return view('Reports.sales.soa.listing', compact('customers', 'details', 'opening_balance', 'fromdate', 'todate'));
  }

  public function soasalespdf(Request $request)
  {
    $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
    $todate = Carbon::parse($request->todate)->format('Y-m-d');
    $cid = $request->cid;
    $branch = Session::get('branch');
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
    if (Session::get('common_customer_database') == 1) {
      $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('id', $cid)->get();
    } else {
      $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->where('id', $cid)->get();
    }
    $opening_balance = DB::table('qsell_salesorder_soa')->select('*')
      ->where('qsell_salesorder_soa.del_flag', 1)->where('qsell_salesorder_soa.branch', $branch)
      ->where('qsell_salesorder_soa.customer_id', $cid)->whereDate('doc_transaction', '<', $fromdate)
      ->orderBy('qsell_salesorder_soa.doc_id', 'asc')
      ->get();
    $details = DB::table('qsell_salesorder_soa')
      ->select('*', DB::raw("DATE_FORMAT(qsell_salesorder_soa.doc_transaction, '%d-%m-%Y') as doc_transaction"), 'qcrm_customer_details.*', 'countries.*')
      ->leftjoin('qcrm_customer_details', 'qsell_salesorder_soa.customer_id', '=', 'qcrm_customer_details.id')
      ->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')
      ->whereBetween('doc_transaction', [$fromdate, $todate])
      ->where('qsell_salesorder_soa.del_flag', 1)->where('qsell_salesorder_soa.branch', $branch)
      ->where('qsell_salesorder_soa.customer_id', $cid)
      ->orderBy('qsell_salesorder_soa.doc_transaction', 'ASC')
      ->get();
    $fromdate = Carbon::parse($request->fromdate)->format('d-m-Y');
    $todate = Carbon::parse($request->todate)->format('d-m-Y');

    $pdf = PDF::loadview('Reports.sales.soa.pdf', compact('details', 'opening_balance', 'fromdate', 'branchsettings', 'customers', 'todate'));
    return $pdf->stream('sales.pdf');
  }


  ////

  public function soacorrect()
  {


    DB::table('qsell_salesorder_soa')->delete();


    $met = 0;
    $transaction_type = "";
    $method = DB::table('qsell_saleinvoice')->select('*')->get();

    foreach ($method as $key => $value) {
      # code...

      $a = $value->sale_method;
      //dd( $value->id );
      if ($a == 1) {
        $transaction_type = 'cash';
        $met = $value->grandtotalamount;
        $cr_amount = $value->grandtotalamount;
        $dr_amount = $value->grandtotalamount;
      } else {
        $transaction_type = 'credit';
        $met = 0;
        $cr_amount = $value->grandtotalamount;
        $dr_amount = $value->paid_amount;
      }


      $cid = $value->customer;
      $branch = Session::get('branch');

      $soa = [
        'doc_type'        => 'Invoice',
        'doc_id'          => $value->id,
        'doc_transaction' => Carbon::parse($value->quotedate)->format('Y-m-d'),
        'transaction_type' => $transaction_type,
        'totalamount'     => $value->grandtotalamount,
        'customer_id'     => $cid,
        'paid_amount'     => $met,
        'branch'          => $branch,
        'cr_amount'          => $cr_amount,
        'dr_amount'          => $dr_amount,
      ];
      DB::table('qsell_salesorder_soa')->insert($soa);
    }


    $bills = DB::table('qsell_billsettlement')->select('*')->get();




    foreach ($bills as $key => $value) {
      # code...


      $transaction_type = 'Debit';
      $met = 0;
      $cr_amount = 0;
      $dr_amount = $value->paidamount;



      $cid = $value->customer;
      $branch = Session::get('branch');

      $soa = [
        'doc_type'        => 'Bill Settlement',
        'doc_id'          => $value->id,
        'doc_transaction' => Carbon::parse($value->transactiondate)->format('Y-m-d'),
        'transaction_type' => $transaction_type,
        'totalamount'     => $value->dueamount,
        'customer_id'     => $cid,
        'paid_amount'     => $met,
        'branch'          => $branch,
        'cr_amount'          => $cr_amount,
        'dr_amount'          => $dr_amount,
      ];
      DB::table('qsell_salesorder_soa')->insert($soa);
    }

    //////////////////////////////
  }
  ////



}

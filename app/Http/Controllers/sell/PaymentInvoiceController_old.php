<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use DataTables;
use App\Traits\AccountingActionsTrait;


class PaymentInvoiceController_old extends Controller
{
  use AccountingActionsTrait;

  public function sales_bill_settlement(Request $request)
  {
    $branch = Session::get('branch');
    if ($request->ajax()) {
      $user = Auth::user();
      $bills = DB::table('qsell_billsettlement')->leftjoin('qcrm_customer_details', 'qsell_billsettlement.customer', '=', 'qcrm_customer_details.id')->select('qsell_billsettlement.*',  DB::raw("DATE_FORMAT(qsell_billsettlement.transactiondate, '%d-%m-%Y') as transactiondate"), 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1')->get();

      return Datatables::of($bills)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
        $j = '';
        $hasPermission = $user->can('Bill Settlement PDF');
        if ($hasPermission) {
          $j .= '<a href="{{url("bill_pdf")}}?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                          <span class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon-background"></i>
                              <span class="kt-nav__link-text" data-id="">PDF</span>
                          </span>
                        </li>
                    </a>';

          return '<span style="overflow: visible; position: relative; width: 80px;">
                    <div class="dropdown">
                         <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                         <i class="fa fa-cog"></i>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right">
                         <ul class="kt-nav">' . $j . '</ul>
                         </div>
                   </div>
                </span>';
        } else
          return '';
      })->rawColumns(['action'])->make(true);
    } else
      return view('sell.bill.list');
  }
  public function sales_bill_settlement_add_sell()
  {
    $branch = Session::get('branch');
    $customers   = DB::table('qcrm_customer_details')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
    return view('sell.bill.add', compact('branch', 'customers'));
  }
  public function customer_submit_sell(Request $request)
  {
    $branch = Session::get('branch');
    $customer_select = $request->customer_select;
    $vouchers = DB::table('qsell_saleinvoice')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.salesman', '=', 'qcrm_salesman_details.id')->where('qsell_saleinvoice.customer', $customer_select)->where('qsell_saleinvoice.balance_amount', '>', 0)->select('qsell_saleinvoice.*', 'qcrm_salesman_details.name as purchaser', 'qsell_saleinvoice.id as vid')->get();


    $this->connectToAccounting();

    $groups = DB::connection('mysql_accounting')->table('groups')->get();
    $ledgers = DB::connection('mysql_accounting')->table('ledgers')->get();
    $finalLedger = array();
    foreach ($groups as $key => $value) {

      $string = $value->code;
      $characterToCount = '-';
      $count = substr_count($string, $characterToCount);
      $elemnt = array(
        'id' => $value->id,
        'parent_id' => $value->parent_id,
        'name' => $value->name,
        'code' => $value->code,
        'count' => $count,
      );
      array_push($finalLedger, $elemnt);
    }

    $fullGroups = collect($finalLedger)->sortBy('code')->toArray();

    foreach ($ledgers as $key => $value) {
      $string = $value->code;
      $characterToCount = '-';
      $count = substr_count($string, $characterToCount);
      $elemnt = array(
        'id' => $value->id,
        'parent_id' => '~', //$value->parent_id,
        'name' => $value->name,
        'code' => $value->code,
        'count' => $count,
      );
      array_push($finalLedger, $elemnt);
    }
    $fullLedger = collect($finalLedger)->sortBy('code')->toArray();

    return view('sell.bill.details', compact('vouchers', 'branch', 'customer_select', 'fullLedger'));
  }

  public function sale_bill_settle_submit(Request $request)
  {

    DB::transaction(function () use ($request) {
      $branch = Session::get('branch');
      $data = [
        'customer' => $request->customer_select,
        'dueamount' => $request->dueamount,
        'paidamount' => $request->paidamount,
        'depositaccount' => $request->depositaccount,
        'notes' => $request->notes,
        'reference' => $request->reference,
        'addtotal' => $request->addtotal,
        'bills' => implode(', ', $request->vouchers),
        'branch' => $branch,
        'transactiondate' => Carbon::parse($request->transactiondate)->format('Y-m-d'),
      ];
      $main_bill = DB::table('qsell_billsettlement')->insert($data);
      $main_bill_id = DB::getPdo()->lastInsertId();
      $sum = 0;
      for ($i = 0; $i < count($request->modeofpayment); $i++) {
        $sum += $request->amount[$i];

        $data = [
          'bill_id' => $main_bill_id,
          'modeofpayment'     => $request->modeofpayment[$i],
          'preference' => $request->preference[$i],
          'amount'   => $request->amount[$i],
          'branch' => $branch
        ];
        $voucher_modes = DB::table('qsell_billsettlement_payment_method')->insert($data);
      }

      $datapay = [
        'customer_id' => $request->customer_select,
        'payment_date' => Carbon::parse($request->transactiondate)->format('Y-m-d'),
        'payment_type' => 'Bill Settle',
        'doc_id' => $main_bill_id,
        'dr_amount' => 0,
        'cr_amount' => $sum

      ];
      $payid = DB::table('qsell_customer_payments')->insertGetId($datapay);


      // statement of account entry


      $met = 0;
      $soa = [
        'doc_type'        => 'Bill Settlement',
        'doc_id'          => $main_bill_id,
        'doc_transaction' => Carbon::parse($request->transactiondate)->format('Y-m-d'),
        'transaction_type' => 'Debit',
        'totalamount'     => $request->dueamount,
        'customer_id'     => $request->customer_select,
        'paid_amount'     => $met,
        'branch'          => $branch,
        'cr_amount'          => 0,
        'dr_amount'          => $request->paidamount,
      ];
      DB::table('qsell_salesorder_soa')->insert($soa);

      // ./statement of account entry 


      //reduce due amounts from vouchers
      $x = 0;
      $y = 0;
      $z = 0;

      $x = $request->paidamount;
      for ($i = 0; $i < count($request->vouchers); $i++) {

        $y = DB::table('qsell_saleinvoice')->select('balance_amount')->where('id', '=', $request->vouchers[$i])->value('balance_amount');
        $z = $x - $y;
        if ($z > 0) {

          $data = ['balance_amount' => 0];
          DB::table('qsell_saleinvoice')->where('id', $request->vouchers[$i])->update($data);
          $x = $x - $y;
        } elseif ($z < 0) {

          $data = ['balance_amount' => abs($y - $x)];
          DB::table('qsell_saleinvoice')->where('id', $request->vouchers[$i])->update($data);
          $x = 0;
        } elseif ($z == 0) {
          $data = ['balance_amount' => 0];
          DB::table('qsell_saleinvoice')->where('id', $request->vouchers[$i])->update($data);
          $x = $x - $y;
        } else {
        }
      }

      //reduce due amounts from vouchers
      ///////////////////////////////
      $this->salesInvoiceBillSettlementAccountingEnrty($main_bill_id); //Accounting Entry
    });
    return 'true';
  }

  public function pdf(Request $request)
  {
    $brandlist = array();
    $manufacturerlist = array();
    $brname = array();
    $mrname = array();
    ini_set("pcre.backtrack_limit", "100000000000");
    $id = $request->id;
    $branch = Session::get('branch');
    $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();

    $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
    $common_customer_database = DB::table('qsettings_company')->select('common_customer_database')->value('common_customer_database');
    $productlistquery = DB::table('qinventory_products')->select('*');
    if ($common_customer_database != 1) {
      $productlistquery->where('branch', $branch);
    }
    $productlist = $productlistquery->where('del_flag', 1)->get();
    $currencylistquery = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value');
    if ($common_customer_database != 1) {
      $currencylistquery->where('branch', $branch);
    }
    $currencylist = $currencylistquery->where('del_flag', 1)->get();
    $unitlistquery = DB::table('qinventory_product_unit')->select('id', 'unit_name');
    if ($common_customer_database != 1) {
      $unitlistquery->where('branch', $branch);
    }
    $unitlist = $unitlistquery->where('del_flag', 1)->get();
    $termslistquery = DB::table('qcrm_termsandconditions')->select('id', 'term');
    if ($common_customer_database != 1) {
      $termslistquery->where('branch', $branch);
    }
    $termslist = $termslistquery->where('del_flag', 1)->get();
    $salesmenquery = DB::table('qcrm_salesman_details')->select('id', 'name');
    if ($common_customer_database != 1) {
      $salesmenquery->where('branch', $branch);
    }
    $salesmen = $salesmenquery->where('del_flag', 1)->get();
    $vatlistquery = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax');
    if ($common_customer_database != 1) {
      $vatlistquery->where('branch', $branch);
    }
    $vatlist = $vatlistquery->where('del_flag', 1)->get();
    $stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();
    $billsettlement = DB::table('qsell_billsettlement')->select('qsell_billsettlement.*', DB::raw("DATE_FORMAT(qsell_billsettlement.transactiondate, '%d-%m-%Y') as tdate"))->where('qsell_billsettlement.branch', $branch)->where('qsell_billsettlement.del_flag', 1)->where('qsell_billsettlement.id', $id)->get();
    $billsettlement_metod = DB::table('qsell_billsettlement_payment_method')->select('qsell_billsettlement_payment_method.*')->where('qsell_billsettlement_payment_method.branch', $branch)->where('qsell_billsettlement_payment_method.del_flag', 1)->where('qsell_billsettlement_payment_method.bill_id', $id)->get();
    $customers = DB::table('qsell_billsettlement')->leftjoin('qcrm_customer_details', 'qsell_billsettlement.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_billsettlement.id', $id)->get();
    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
    $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
    $companysettings = BranchSettingsModel::where('branch', $branch)->get();

    $customfields = DB::table('qsettings_custom_fields')->select('*')->get();
    $plabels = $customfields->pluck('labels')->toArray();
    $gm_amount = 0;


    if (Session::get('preview') == 'preview1') {
      $pdf = PDF::loadView('sell.bill.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
    } elseif (Session::get('preview') == 'preview2') {
      $pdf = PDF::loadView('sell.bill.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
    } elseif (Session::get('preview') == 'preview3') {
      $pdf = PDF::loadView('sell.bill.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
    } elseif (Session::get('preview') == 'preview4') {
      $pdf = PDF::loadView('sell.bill.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
    } else {
      $pdf = PDF::loadView('sell.bill.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
    }
    return $pdf->stream('Bill Settle-#' . $id . '.pdf');
  }
}

<?php

namespace App\Http\Controllers\qpurchase;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use DataTables;
use App\Traits\PurchaseTraits;
use App\Traits\AccountingActionsTrait;
use Hashids\Hashids;

class BillSettlementController extends Controller
{
  use PurchaseTraits, AccountingActionsTrait;

  public function list(Request $request)
  {
    $branch = Session::get('branch');
    if ($request->ajax()) {
      $user = Auth::user();

      $bills = DB::table('qbuy_billsettlement')
        ->leftjoin('qcrm_supplier', 'qbuy_billsettlement.supplier', '=', 'qcrm_supplier.id')
        ->select('qbuy_billsettlement.*', DB::raw("DATE_FORMAT(qbuy_billsettlement.transactiondate, '%d-%m-%Y') as transactiondate"), 'qcrm_supplier.sup_name')
        ->where('qbuy_billsettlement.branch', $branch)
        ->get();

      return Datatables::of($bills)->addIndexColumn()
        ->addColumn('status', function ($row) use ($user) {
          if ($row->status == 'Draft')
            return '<span style="color:gray;">Draft</span>';
          if ($row->status == 'Approved')
            return '<span style="color:green;">Approved</span>';
        })->addColumn('action', function ($row) use ($user) {
          $j = '';

          $hashids = new Hashids();
          $j .= '<a href="qpurchase-bill-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
          <li class="kt-nav__item">
              <span class="kt-nav__link">
                  <i class="kt-nav__link-icon flaticon-eye"></i>
                  <span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
              </span>
          </li>
      </a>';

          $hasPermission = $user->can('Bill Settlement PDF');
          if ($hasPermission) {
            $j .= '<a href="qpurchase-bill-pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                          <span class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon-doc"></i>
                              <span class="kt-nav__link-text" data-id="">PDF</span>
                          </span>
                        </li>
                    </a>';
          }

          if ($row->status == 'Draft') {
            $j .= '<a href="qpurchase-bill-settlement-edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                    <li class="kt-nav__item">
                      <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                        <span class="kt-nav__link-text" data-id="">Edit</span>
                      </span>
                    </li>
                  </a>';

            $j .= '<a data-type="send" data-target="#kt_form">
						<li class="kt-nav__item bill_settlement_approve" id="' . $row->id . '">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-accept"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
							</span>
						</li>
					</a>';
            $j .= '<a data-type="send" data-target="#kt_form">
						<li class="kt-nav__item bill_settlement_delete" id="' . $row->id . '">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon-delete"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Delete</span>
							</span>
						</li>
					</a>';
          }

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
        })->rawColumns(['action', 'status'])->make(true);
    } else
      return view('qpurchase.billsettlement.list');
  }
  public function add()
  {
    $branch = Session::get('branch');
    $suppliers   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
    return view('qpurchase.billsettlement.add', compact('branch', 'suppliers'));
  }

  public function supplier_submit(Request $request)
  {
    // qsell_saleinvoice
    $branch = Session::get('branch');
    $supplierSelect = $request->supplier;
    $supplier   = DB::table('qcrm_supplier')->select('sup_name')->where('id', $supplierSelect)->first();
    $vouchers = DB::table('qbuy_purchase_pi')
      ->leftjoin('qcrm_salesman_details', 'qbuy_purchase_pi.salesman', '=', 'qcrm_salesman_details.id')
      ->where('qbuy_purchase_pi.supplier_id', $supplierSelect)
      ->where('qbuy_purchase_pi.balance_amount', '>', 0)
      ->where('qbuy_purchase_pi.status', 'Approved')
      ->select('qbuy_purchase_pi.*', 'qcrm_salesman_details.name as purchaser', 'qbuy_purchase_pi.id as vid')
      ->get();
    $this->connectToAccounting();
    $fullLedger = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more

    $entryTypes = DB::connection('mysql_accounting')->table('entrytypes')->get();
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
    $allLedger = collect($finalLedger)->sortBy('code')->toArray();

    $debitBalanceObj = DB::table('qbuy_supplier_payments')
      ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
      ->where('qbuy_supplier_payments.supplier_id', $supplierSelect)
      ->groupBy('qbuy_supplier_payments.supplier_id')
      ->first();
    $debitBalance = (isset($debitBalanceObj->dr_amount) ? $debitBalanceObj->dr_amount : 0) - (isset($debitBalanceObj->cr_amount) ? $debitBalanceObj->cr_amount : 0);
    return view('qpurchase.billsettlement.details', compact('vouchers', 'fullLedger', 'allLedger', 'branch', 'debitBalance', 'supplierSelect', 'supplier'));
  }

  public function billSettleSave(Request $request)
  {
    DB::transaction(function () use ($request) {
      $branch = Session::get('branch');
      $branch_settings = Session::get('branch_settings');
      $data = [
       // 'code' => $branch_settings->purchasebillsettlement_sufix . '' . sprintf("%03d", $branch),
        'supplier' => $request->supplier_select,
        'dueamount' => $request->dueamount,
        'paidamount' => $request->paidamount,
        // 'depositaccount' => $request->depositaccount,
        'credit_from_another' => $request->credit_from_another,
        'credit_from_ledjer' => $request->credit_from_ledjer,
        'use_advance' => $request->use_advance,
        'advance_amt' => $request->advance_amt,
        'notes' => $request->notes,
        'reference' => $request->reference,
        'addtotal' => $request->addtotal,
        'branch' => $branch,
        'transactiondate' => Carbon::parse($request->transactiondate)->format('Y-m-d'),
        'status' => $request->status, //'Draft' //
      ];
      $main_bill = DB::table('qbuy_billsettlement')->insert($data);
      $main_bill_id = DB::getPdo()->lastInsertId();
      for ($i = 0; $i < count($request->debitaccount); $i++) {
        $data = [
          'bill_id' => $main_bill_id,
          'debitaccount'     => $request->debitaccount[$i],
          'preference' => $request->preference[$i],
          'amount'   => $request->amount[$i],
          'branch' => $branch
        ];
        $voucher_modes = DB::table('qbuy_billsettlement_payment_method')->insert($data);
      }
      $this->purchaseInvoiceBillSettlementAccountingEnrty($main_bill_id); //Accounting Entry
      $this->purchaseBillSettilementSOAInsertion($main_bill_id, $branch); //SOA Entry

      //reduce due amounts from vouchers
      $dueInInvoice = 0;
      $payBalance = 0;
      $paidamount = $request->paidamount;
      for ($i = 0; $i < count($request->vouchers); $i++) {
        $dueInInvoice = DB::table('qbuy_purchase_pi')->select('balance_amount')->where('id', '=', $request->vouchers[$i])->value('balance_amount');
        $payBalance = $paidamount - $dueInInvoice;
        if ($payBalance >= 0) {
          $data = ['balance_amount' => 0];
          DB::table('qbuy_purchase_pi')->where('id', $request->vouchers[$i])->update($data);
          $invRedusedAmount = $dueInInvoice;
          $paidamount = $paidamount - $dueInInvoice;
        } elseif ($payBalance < 0) {
          $data = ['balance_amount' => abs($dueInInvoice - $paidamount)];
          DB::table('qbuy_purchase_pi')->where('id', $request->vouchers[$i])->update($data);
          $invRedusedAmount = $paidamount;
          $paidamount = 0;
        }
        if ($invRedusedAmount != 0) {
          $data = [
            'qbuy_billsettlement_id' => $main_bill_id,
            'qbuy_purchase_pi_id'    => $request->vouchers[$i],
            'paidamount' => $invRedusedAmount,
          ];
          $voucher_modes = DB::table('qbuy_billsettlement_inv_payments')->insert($data);
        }
      }
      //reduce due amounts from vouchers
    });
    return 'true';
  }



  public function edit(Request $request)
  {
    $branch = Session::get('branch');
    $id = $request->id;
    $billSettlement =   DB::table('qbuy_billsettlement')
      ->leftjoin('qcrm_supplier', 'qbuy_billsettlement.supplier', '=', 'qcrm_supplier.id')
      ->select('qbuy_billsettlement.*', 'qcrm_supplier.sup_name')
      ->where('qbuy_billsettlement.id', $id)
      ->where('qbuy_billsettlement.branch', $branch)
      ->first();

    if (isset($billSettlement->id)) {
      $billSettlementProducts = DB::table('qbuy_billsettlement_payment_method')->select('qbuy_billsettlement_payment_method.*')->where('bill_id', $id)->get();
      $vouchers = DB::table('qbuy_billsettlement_inv_payments')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_billsettlement_inv_payments.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->leftjoin('qcrm_salesman_details', 'qbuy_purchase_pi.salesman', '=', 'qcrm_salesman_details.id')
        ->select('qbuy_billsettlement_inv_payments.paidamount as curPay', 'qbuy_purchase_pi.*', 'qcrm_salesman_details.name as purchaser', 'qbuy_purchase_pi.id as vid')
        ->where('qbuy_billsettlement_inv_payments.qbuy_billsettlement_id', $id)
        ->get();

      $this->connectToAccounting();
      $fullLedger = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get();

      $entryTypes = DB::connection('mysql_accounting')->table('entrytypes')->get();
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
      $allLedger = collect($finalLedger)->sortBy('code')->toArray();

      $debitBalanceObj = DB::table('qbuy_supplier_payments')
        ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
        ->where('qbuy_supplier_payments.supplier_id', $billSettlement->supplier)
        ->groupBy('qbuy_supplier_payments.supplier_id')
        ->first();

      $debitBalance = (isset($debitBalanceObj->dr_amount) ? $debitBalanceObj->dr_amount : 0) - (isset($debitBalanceObj->cr_amount) ? $debitBalanceObj->cr_amount : 0) + $billSettlement->advance_amt;

      return view('qpurchase.billsettlement.detailsEdit', compact('billSettlement', 'billSettlementProducts', 'vouchers', 'debitBalance', 'fullLedger', 'allLedger', 'branch'));
    } else
      echo "Data Not Found";
  }

  public function update(Request $request)
  {
    DB::transaction(function () use ($request) {
      $branch = Session::get('branch');
      $data = [
        'supplier' => $request->supplier_select,
        'dueamount' => $request->dueamount,
        'paidamount' => $request->paidamount,
        // 'depositaccount' => $request->depositaccount,
        'credit_from_another' => $request->credit_from_another,
        'credit_from_ledjer' => $request->credit_from_ledjer,
        'use_advance' => $request->use_advance,
        'advance_amt' => $request->advance_amt,
        'notes' => $request->notes,
        'reference' => $request->reference,
        'addtotal' => $request->addtotal,
        'branch' => $branch,
        'transactiondate' => Carbon::parse($request->transactiondate)->format('Y-m-d'),
        'status' => $request->status, //'Draft' //
      ];
      $main_bill = DB::table('qbuy_billsettlement')->where('id', $request->id)->update($data);
      $main_bill_id = $request->id;
      DB::table('qbuy_billsettlement_payment_method')->where('bill_id', $main_bill_id)->delete();
      if ($request->paidamount > $request->advance_amt) {
        for ($i = 0; $i < count($request->debitaccount); $i++) {
          $data = [
            'bill_id' => $main_bill_id,
            'debitaccount'     => $request->debitaccount[$i],
            'preference' => $request->preference[$i],
            'amount'   => $request->amount[$i],
            'branch' => $branch
          ];
          $voucher_modes = DB::table('qbuy_billsettlement_payment_method')->insert($data);
        }
      }
      $this->purchaseInvoiceBillSettlementAccountingEnrty($main_bill_id); //Accounting Entry
      $this->purchaseBillSettilementSOAInsertion($main_bill_id, $branch); //SOA Entry

      // remove old voucher details from invoice
      $oldpay =  DB::table('qbuy_billsettlement_inv_payments')->select('qbuy_purchase_pi_id', 'paidamount')->where('qbuy_billsettlement_id', $main_bill_id)->get();

      foreach ($oldpay as $key => $value) {
        DB::table('qbuy_purchase_pi')->where('id', $value->qbuy_purchase_pi_id)->increment('balance_amount', $value->paidamount);
      }
      DB::table('qbuy_billsettlement_inv_payments')->where('qbuy_billsettlement_id', $main_bill_id)->delete();
      // remove old voucher details from invoice

      //reduce due amounts from vouchers
      $dueInInvoice = 0;
      $payBalance = 0;
      $paidamount = $request->paidamount;
      for ($i = 0; $i < count($request->vouchers); $i++) {
        $dueInInvoice = DB::table('qbuy_purchase_pi')->select('balance_amount')->where('id', '=', $request->vouchers[$i])->value('balance_amount');
        $payBalance = $paidamount - $dueInInvoice;
        if ($payBalance >= 0) {
          $data = ['balance_amount' => 0];
          DB::table('qbuy_purchase_pi')->where('id', $request->vouchers[$i])->update($data);
          $invRedusedAmount = $dueInInvoice;
          $paidamount = $paidamount - $dueInInvoice;
        } elseif ($payBalance < 0) {
          $data = ['balance_amount' => abs($dueInInvoice - $paidamount)];
          DB::table('qbuy_purchase_pi')->where('id', $request->vouchers[$i])->update($data);
          $invRedusedAmount = $paidamount;
          $paidamount = 0;
        }

        if ($invRedusedAmount != 0) {
          $data = [
            'qbuy_billsettlement_id' => $main_bill_id,
            'qbuy_purchase_pi_id'     => $request->vouchers[$i],
            'paidamount' => $invRedusedAmount,
          ];
          $voucher_modes = DB::table('qbuy_billsettlement_inv_payments')->insert($data);
        }
      }
      //reduce due amounts from vouchers
    });
    return 'true';
  }
  // 

  public function view(Request $request, $id)
  {
    $branch = Session::get('branch');
    
    $hashids = new Hashids();
    $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;

    $billSettlement =   DB::table('qbuy_billsettlement')
      ->leftjoin('qcrm_supplier', 'qbuy_billsettlement.supplier', '=', 'qcrm_supplier.id')
      ->select('qbuy_billsettlement.*', 'qcrm_supplier.sup_name')
      ->where('qbuy_billsettlement.id', $id)
      ->where('qbuy_billsettlement.branch', $branch)
      ->first();

    if (isset($billSettlement->id)) {
      $billSettlementProducts = DB::table('qbuy_billsettlement_payment_method')->select('qbuy_billsettlement_payment_method.*')->where('bill_id', $id)->get();
      $vouchers = DB::table('qbuy_billsettlement_inv_payments')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_billsettlement_inv_payments.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->leftjoin('qcrm_salesman_details', 'qbuy_purchase_pi.salesman', '=', 'qcrm_salesman_details.id')
        ->select('qbuy_billsettlement_inv_payments.paidamount as curPay', 'qbuy_purchase_pi.*', 'qcrm_salesman_details.name as purchaser', 'qbuy_purchase_pi.id as vid')
        ->where('qbuy_billsettlement_inv_payments.qbuy_billsettlement_id', $id)
        ->get();

      $this->connectToAccounting();
      $fullLedger = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get();

      $entryTypes = DB::connection('mysql_accounting')->table('entrytypes')->get();
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
      $allLedger = collect($finalLedger)->sortBy('code')->toArray();

      $debitBalanceObj = DB::table('qbuy_supplier_payments')
        ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
        ->where('qbuy_supplier_payments.supplier_id', $billSettlement->supplier)
        ->groupBy('qbuy_supplier_payments.supplier_id')
        ->first();

      $debitBalance = (isset($debitBalanceObj->dr_amount) ? $debitBalanceObj->dr_amount : 0) - (isset($debitBalanceObj->cr_amount) ? $debitBalanceObj->cr_amount : 0) + $billSettlement->advance_amt;

      return view('qpurchase.billsettlement.view', compact('billSettlement', 'billSettlementProducts', 'vouchers', 'debitBalance', 'fullLedger', 'allLedger', 'branch'));
    } else
      echo "Data Not Found";
  }

  public function approve(Request $request)
  {
    DB::transaction(function () use ($request) {
      $branch = Session::get('branch');
      DB::table('qbuy_billsettlement')->where('id', '=', $request->id)->update(['status' => 'Approved']); //
    });
    $out = array(
      'status' => 1,
    );
    echo json_encode($out);
  }

  public function delete(Request $request)
  {
    DB::transaction(function () use ($request) {
      $oldData = DB::table('qbuy_billsettlement')->select('acc_entries_id', 'soa_id', 'supplier_payment_id')->where('id', $request->id)->first();
      $this->entryItemsDelete($oldData->acc_entries_id);
      $this->deletePurchaseSOA($oldData->soa_id);
      $this->deleteSupplierPayment($oldData->supplier_payment_id);
      DB::table('qbuy_billsettlement')->where('id', $request->id)->delete();
      DB::table('qbuy_billsettlement_payment_method')->where('bill_id', $request->id)->delete();
      $oldpay =  DB::table('qbuy_billsettlement_inv_payments')
        ->select('qbuy_purchase_pi_id', 'paidamount')
        ->where('qbuy_billsettlement_id', $request->id)
        ->get();
      foreach ($oldpay as $key => $value) {
        DB::table('qbuy_purchase_pi')->where('id', $value->qbuy_purchase_pi_id)
          ->increment('balance_amount', $value->paidamount);
      }
      DB::table('qbuy_billsettlement_inv_payments')->where('qbuy_billsettlement_id', $request->id)->delete();
    });
    $out = array(
      'status' => 1,
    );
    echo json_encode($out);
  }



  public function pdf(Request $request)
  {
    $brandlist = array();
    $manufacturerlist = array();
    $brname = array();
    $mrname = array();
    $id = $request->id;
    $branch = Session::get('branch');
    $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
    $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
    $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
    $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
    $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
    $vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->orderBy('total', 'asc')->where('del_flag', 1)->get();
    $stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();

    $billsettlement = DB::table('qbuy_billsettlement')->select('qbuy_billsettlement.*', DB::raw("DATE_FORMAT(qbuy_billsettlement.transactiondate, '%d-%m-%Y') as tdate"))
      ->where('qbuy_billsettlement.branch', $branch)
      ->where('qbuy_billsettlement.del_flag', 1)
      ->where('qbuy_billsettlement.id', $id)
      ->get();


    $billsettlement_metod = DB::table('qbuy_billsettlement_payment_method')->select('qbuy_billsettlement_payment_method.*')->where('qbuy_billsettlement_payment_method.branch', $branch)->where('qbuy_billsettlement_payment_method.del_flag', 1)->where('qbuy_billsettlement_payment_method.bill_id', $id)->get();

    foreach ($billsettlement as $key => $value) {
      $supplier = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->supplier)->get();
      # code...
    }


    $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
    $bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
    $companysettings = BranchSettingsModel::where('branch', $branch)->get();

    $customfields = DB::table('qsettings_custom_fields')->select('*')->get();
    $plabels = $customfields->pluck('labels')->toArray();
    $gm_amount = 0;

    $this->connectToAccounting();
    $ledgers = DB::connection('mysql_accounting')->table('ledgers')->get();

    // dd(Session::get('preview'));
    if (Session::get('preview') == 'preview1') {
      $pdf = PDF::loadView('qpurchase.billsettlement.preview1', compact('branch', 'branchsettings', 'currencylist', 'unitlist', 'termslist', 'supplier', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels', 'ledgers'));
    } elseif (Session::get('preview') == 'preview2') {
      $pdf = PDF::loadView('qpurchase.billsettlement.preview2', compact('branch', 'branchsettings', 'currencylist', 'unitlist', 'termslist', 'supplier', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels', 'ledgers'));
    } elseif (Session::get('preview') == 'preview3') {
      $pdf = PDF::loadView('qpurchase.billsettlement.preview3', compact('branch', 'branchsettings', 'currencylist', 'unitlist', 'termslist', 'supplier', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels', 'ledgers'));
    } elseif (Session::get('preview') == 'preview4') {
      $pdf = PDF::loadView('qpurchase.billsettlement.preview4', compact('branch', 'branchsettings', 'currencylist', 'unitlist', 'termslist', 'supplier', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels', 'ledgers'));
    } else {
      $pdf = PDF::loadView('qpurchase.billsettlement.preview4', compact('branch', 'branchsettings', 'currencylist', 'unitlist', 'termslist', 'supplier', 'salesmen', 'billsettlement', 'billsettlement_metod', 'vatlist', 'bname', 'companysettings', 'plabels', 'ledgers'));
    }
    return $pdf->stream('Bill Settle-#' . $id . '.pdf');
  }
}

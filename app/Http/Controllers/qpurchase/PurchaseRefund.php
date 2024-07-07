<?php

namespace App\Http\Controllers\qpurchase;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use App\Traits\AccountingActionsTrait;
use Hashids\Hashids;


class PurchaseRefund extends Controller
{
  use AccountingActionsTrait;
  public function list(Request $request)
  {


    $branch = Session::get('branch');
    if ($request->ajax()) {
      $bills = DB::table('qbuy_refund')
        ->leftjoin('qcrm_supplier', 'qbuy_refund.supplier_id', '=', 'qcrm_supplier.id')
        ->leftjoin('qbuy_purchase_return', 'qbuy_refund.qbuy_purchase_return_id', '=', 'qbuy_purchase_return.id')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_refund.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->select('qbuy_refund.*', DB::raw("DATE_FORMAT(qbuy_refund.date, '%d-%m-%Y') as date"), 'qcrm_supplier.sup_name',  'qbuy_purchase_pi.id as invoice_id', 'qbuy_purchase_return.id as return_code', DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
        ->where('qbuy_refund.branch', $branch)
        ->get();


      return Datatables::of($bills)->addIndexColumn()
        ->addColumn('status', function ($row) {
          if ($row->status == 'Draft')
            return '<span style="color:gray;">Draft</span>';
          if ($row->status == 'Approved')
            return '<span style="color:green;">Approved</span>';
        })->addColumn('inv_code', function ($row) {
          return $row->invoice_id;
        })->addColumn('rtn_code', function ($row) {
          return $row->return_code;
        })
        ->addColumn('action', function ($row) {
          $j = '';


          $hashids = new Hashids();
          $j .= '<a href="qpurchase-refund-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
                      <li class="kt-nav__item">
                          <span class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon-eye"></i>
                              <span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
                          </span>
                      </li>
                  </a>';

          if ($row->status == 'Draft') {
            $j .= '<a href="qpurchase-refund-edit/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
                    <li class="kt-nav__item">
                      <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                        <span class="kt-nav__link-text" data-id="">Edit</span>
                      </span>
                    </li>
                  </a>';

            $j .= '<a data-type="send" data-target="#kt_form">
						<li class="kt-nav__item refund_approve" id="' . $row->id . '">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-accept"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
							</span>
						</li>
					</a>';
            $j .= '<a data-type="send" data-target="#kt_form">
						<li class="kt-nav__item refund_delete" id="' . $row->id . '">
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
      return view('qpurchase.refund.list');
  }


  public function add(Request $request, $id)
  {
    $branch = Session::get('branch');

    $hashids = new Hashids();
    $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;
    $return   = DB::table('qbuy_purchase_return')
      ->leftjoin('qcrm_supplier', 'qcrm_supplier.id', '=', 'qbuy_purchase_return.supplier_id')
      ->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_return.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
      ->select('qbuy_purchase_return.*', 'qcrm_supplier.sup_name', 'qcrm_supplier.sup_code', 'qbuy_purchase_pi.id as inv_id', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
      ->where('qbuy_purchase_return.branch', $branch)
      ->where('qbuy_purchase_return.id', $id)
      ->first();
    if (isset($return->id)) {

      $returnedProduct = DB::table('qbuy_purchase_return_products')
        ->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
        ->leftjoin('qinventory_product_unit', 'qbuy_purchase_pi_products.unit', '=', 'qinventory_product_unit.id')
        ->select('qbuy_purchase_return_products.*', 'qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty', 'qbuy_purchase_pi_products.new_product_id', 'qbuy_purchase_pi_products.rdiscount as inv_discount', 'qinventory_product_unit.unit_name', 'qinventory_product_unit.unit_code') //
        ->where('qbuy_purchase_return_id', $id)
        ->get();

      $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
      $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
      $this->connectToAccounting();
      $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more
      return view('qpurchase.refund.add', compact('return', 'returnedProduct', 'salesmen', 'termslist', 'debitLedjer'));
    } else
      return abort(404);
  }

  public function edit(Request $request, $id)
  {
    $branch = Session::get('branch');

    $hashids = new Hashids();
    $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;
    $refund = DB::table('qbuy_refund')->select('*')->where('qbuy_refund.id', $id)->where('qbuy_refund.branch', $branch)->first();
    if (isset($refund->id)) {

      $refundProducts = DB::table('qbuy_refund_items')->select('*')->where('qbuy_refund_id', $id)->get();
      $return   = DB::table('qbuy_purchase_return')
        ->leftjoin('qcrm_supplier', 'qcrm_supplier.id', '=', 'qbuy_purchase_return.supplier_id')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_return.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->select('qbuy_purchase_return.*', 'qcrm_supplier.sup_name', 'qcrm_supplier.sup_code', 'qbuy_purchase_pi.id as inv_id', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
        ->where('qbuy_purchase_return.branch', $branch)
        ->where('qbuy_purchase_return.id', $refund->qbuy_purchase_return_id)
        ->first();

      $returnedProduct = DB::table('qbuy_purchase_return_products')
        ->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
        ->leftjoin('qinventory_product_unit', 'qbuy_purchase_pi_products.unit', '=', 'qinventory_product_unit.id')
        ->select('qbuy_purchase_return_products.*', 'qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty', 'qbuy_purchase_pi_products.new_product_id', 'qbuy_purchase_pi_products.rdiscount as inv_discount', 'qinventory_product_unit.unit_name', 'qinventory_product_unit.unit_code') //
        ->where('qbuy_purchase_return_id', $refund->qbuy_purchase_return_id)
        ->get();

      $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
      $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
      $this->connectToAccounting();
      $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more
      return view('qpurchase.refund.edit', compact('refund', 'refundProducts', 'return', 'returnedProduct', 'salesmen', 'termslist', 'debitLedjer'));
    } else
      return abort(404);
  }

  public function save(Request $request)
  {
    DB::transaction(function () use ($request) {
      $branch = Session::get('branch');
      $data = [
        'qbuy_purchase_return_id' => $request->qbuy_purchase_return_id,
        'qbuy_purchase_pi_id' => $request->qbuy_purchase_pi_id,
        'date' => Carbon::parse($request->date)->format('Y-m-d'),
        'rec_by' => $request->rec_by,
        'notes' => $request->notes,
        'addtotal' => $request->addtotal,
        'supplier_id' => $request->supplier_id,
        'terms_conditions' => $request->terms_conditions,
        'tpreview' => $request->tpreview,
        //  'created_by' => $request->created_by,
        'branch' => $branch,
        'status' => 'Draft' //$request->status,
      ];
      if ($request->id != '') {
        $oldrefund = DB::table('qbuy_refund')->select('addtotal')->where('id', $request->id)->first();
        DB::table('qbuy_purchase_return')->where('id', $request->qbuy_purchase_return_id)->decrement('supplier_given_amt', $oldrefund->addtotal);
        DB::table('qbuy_purchase_return')->where('id', $request->qbuy_purchase_return_id)->increment('supplier_given_amt', $request->addtotal);
        DB::table('qbuy_refund_items')->where('qbuy_refund_id', $request->id)->delete();
        DB::table('qbuy_refund')->where('id', $request->id)->update($data);
        $refund_id = $request->id;
      } else {
        $refund_id = DB::table('qbuy_refund')->insertGetId($data);
        DB::table('qbuy_purchase_return')->where('id', $request->qbuy_purchase_return_id)->increment('supplier_given_amt', $request->addtotal);
      }
      $inProductArray = array();
      foreach ($request->debitaccount as $key => $value) {
        $data = array_push($inProductArray, array(
          'qbuy_refund_id' => $refund_id,
          'debitaccount' => $request->debitaccount[$key],
          'reference' => $request->reference[$key],
          'amount' => $request->amount[$key]
        ));
      }
      $items = DB::table('qbuy_refund_items')->insert($inProductArray);
      $this->purchaseRefundAccountingEnrty($refund_id);
    });
    return 'true';
  }


  public function view(Request $request, $id)
  {
    $branch = Session::get('branch');

    $hashids = new Hashids();
    $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;
    $refund = DB::table('qbuy_refund')->select('*')->where('qbuy_refund.id', $id)->where('qbuy_refund.branch', $branch)->first();
    if (isset($refund->id)) {

      $refundProducts = DB::table('qbuy_refund_items')->select('*')->where('qbuy_refund_id', $id)->get();
      $return   = DB::table('qbuy_purchase_return')
        ->leftjoin('qcrm_supplier', 'qcrm_supplier.id', '=', 'qbuy_purchase_return.supplier_id')
        ->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_return.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
        ->select('qbuy_purchase_return.*', 'qcrm_supplier.sup_name', 'qcrm_supplier.sup_code', 'qbuy_purchase_pi.id as inv_id', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
        ->where('qbuy_purchase_return.branch', $branch)
        ->where('qbuy_purchase_return.id', $refund->qbuy_purchase_return_id)
        ->first();

      $returnedProduct = DB::table('qbuy_purchase_return_products')
        ->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
        ->leftjoin('qinventory_product_unit', 'qbuy_purchase_pi_products.unit', '=', 'qinventory_product_unit.id')
        ->select('qbuy_purchase_return_products.*', 'qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty', 'qbuy_purchase_pi_products.new_product_id', 'qbuy_purchase_pi_products.rdiscount as inv_discount', 'qinventory_product_unit.unit_name', 'qinventory_product_unit.unit_code') //
        ->where('qbuy_purchase_return_id', $refund->qbuy_purchase_return_id)
        ->get();

      $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
      $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
      $this->connectToAccounting();
      $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more
      return view('qpurchase.refund.view', compact('refund', 'refundProducts', 'return', 'returnedProduct', 'salesmen', 'termslist', 'debitLedjer'));
    } else
      return abort(404);
  }



  public function approve(Request $request)
  {
    DB::transaction(function () use ($request) {
      $branch = Session::get('branch');
      DB::table('qbuy_refund')->where('id', $request->id)->update(['status' => 'Approved']);
    });
    $out = array(
      'status' => 1,
    );
    echo json_encode($out);
  }


  public function delete(Request $request)
  {
    DB::transaction(function () use ($request) {
      $exData = DB::table('qbuy_refund')->select('qbuy_purchase_return_id', 'addtotal', 'acc_entries_id')->where('id', $request->id)->first();
      DB::table('qbuy_purchase_return')->where('id', $exData->qbuy_purchase_return_id)->decrement('supplier_given_amt', $exData->addtotal);
      $acc_entries_id = $exData->acc_entries_id;
      $this->entryItemsDelete($acc_entries_id);
      DB::table('qbuy_refund')->where('id', $request->id)->delete();
      DB::table('qbuy_refund_items')->where('qbuy_refund_id', $request->id)->delete();
    });
    $out = array(
      'status' => 1,
    );
    echo json_encode($out);
  }
}

<?php

namespace App\Http\Controllers\qpurchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\purchase\PurchaseProductModel;
use App\purchase\PurchasedetailslistModel;
use App\purchase\ProductcostheadModel;
use App\inventory\ProductdetailslistModel;
use DB;
use DataTables;
use Session;
use PDF;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;

class PurchaseController extends Controller
{
	public function list()
	{
		$branch = Session::get('branch');
		$purchase   = DB::table('qbuy_purchase')->select('qbuy_purchase.*', DB::raw("DATE_FORMAT(qbuy_purchase.purchase_date, '%d-%m-%Y') as purchase_date"), DB::raw("DATE_FORMAT(qbuy_purchase.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('qbuy_purchase.del_flag', 1)->where('qbuy_purchase.branch', $branch)->orderby('qbuy_purchase.id', 'desc')->get();

		$purchase_cash   = DB::table('qbuy_purchase')->select('qbuy_purchase.*', DB::raw("DATE_FORMAT(qbuy_purchase.purchase_date, '%d-%m-%Y') as purchase_date"), DB::raw("DATE_FORMAT(qbuy_purchase.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('qbuy_purchase.del_flag', 1)->where('qbuy_purchase.branch', $branch)->where('qbuy_purchase.purchasemethod', 1)->get();
		$purchase_credit   = DB::table('qbuy_purchase')->select('qbuy_purchase.*', DB::raw("DATE_FORMAT(qbuy_purchase.purchase_date, '%d-%m-%Y') as purchase_date"), DB::raw("DATE_FORMAT(qbuy_purchase.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('qbuy_purchase.del_flag', 1)->where('qbuy_purchase.branch', $branch)->where('qbuy_purchase.purchasemethod', 2)->get();
		return view('qpurchase.purchase.list', compact('purchase', 'purchase_cash', 'purchase_credit'));
	}
	public function add()
	{
		$branch = Session::get('branch');

		$paymenttermslist   = DB::table('qcrm_payment_terms')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
		$productlist = DB::table('qinventory_products')->select('product_id as id', 'product_name', 'opening_stock', 'product_code')->where('del_flag', 1)->where('branch', $branch)->get();
		$accountslist   = DB::table('qinventory_accounts')->select('id', 'account_name')->where('del_flag', 1)->where('branch', $branch)->get();
		$currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
		$taxlist   = DB::table('qpurchase_tax')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
		// $costheadlist   = DB::table('buy_voucher')->leftjoin('qcrm_supplier','buy_voucher.cust_id','=','qcrm_supplier.id')->select('buy_voucher.id','buy_voucher.bill_id','qcrm_supplier.sup_name')->where('buy_voucher.del_flag',1)->where('buy_voucher.branch',$branch)->get();
		$subtable = DB::table('qsettings_branch_details')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
		$subentrytypestable = $subtable . 'entrytypes';
		$query  = DB::table('qsettings_voucher')->leftjoin($subentrytypestable, $subentrytypestable . '.id', '=', 'qsettings_voucher.entry_types')->select('qsettings_voucher.*', $subentrytypestable . '.name')->orderby('qsettings_voucher.id', 'desc');
		$query->where('qsettings_voucher.del_flag', 1)->where('qsettings_voucher.branch', $branch)->get();
		$costheadlist = $query->get();
		$batchlist = DB::table('qpurchase_batch')->select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
		$taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('base_unit', 1)->where('del_flag', 1)->where('branch', $branch)->get();
		$termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
		$vatlist   = $taxgrouplist; //DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
		$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
		$salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->get();
		$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();

		return view('qpurchase.purchase.add', compact('paymenttermslist', 'productlist', 'accountslist', 'currencylist', 'taxlist', 'costheadlist', 'batchlist', 'taxgrouplist', 'unitlist', 'branch', 'termslist', 'vatlist', 'suppliers', 'salesmen', 'warehouses'));
	}
	public function submit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->id;
		$data = [

			'vendor_supplier_name' => $request->name,
			'purchase_date' => Carbon::parse($request->purchase_date)->format('Y-m-d'),
			'purchaseno' => $request->purchaseno,
			'paymentterms' => $request->paymentterms,
			'purchasemethod' => $request->purchasemethod,
			'notes' => $request->notes,
			'terms' => $request->terms,
			'currency' => $request->currency,
			'currency_value' => $request->currencyvalue,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'totalcost_amount' => $request->totalcost_amount,
			'image' => $request->fileData,
			'branch' => $branch,
			'po_ref_number' => $request->po_ref_number,
			'purchasebillid' => $request->purchasebillid,
			'qtnref' => $request->qtnref,
			'vat_no' => $request->vat_no,
			'cr_no' => $request->cr_no,
			'status' => 0,
			'purchaser' => $request->purchaser,
			'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),

		];
		DB::table('qbuy_purchase')->insert($data);

		$purchase_id = DB::getPdo()->lastInsertId();

		for ($i = 0; $i < count($request->productname_id); $i++) {
			$data_variant = [
				'purchase_id' => $purchase_id,
				'product_name' => $request->productname[$i],
				'productname_id' => $request->productname_id[$i],
				'unit' => $request->unit[$i],
				'quantity' => $request->quantity[$i],
				'rate' => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'vat_amount' => $request->vatamount[$i],
				'discount' => $request->discountamount[$i],
				'row_total' => $request->row_total[$i],
				'quantity_value' => $request->quantity_value[$i],
				'branch' => $branch,
				'description' =>	 $request->product_description[$i]
			];
			DB::table('qbuy_products')->insert($data_variant);
		}
		if (isset($request->itemcost_details) && !empty($request->itemcost_details)) {
			for ($i = 0; $i < count($request->itemcost_details); $i++) {
				$data_variant1 = [
					'purchase_id' => $purchase_id,
					'costheadname' => $request->itemcost_details[$i],
					'rate' => $request->costrate[$i],
					'tax' => $request->costtax_group[$i],
					'amount' => $request->costtax_amount[$i],
					'branch' => $branch,
					'costtax_notes' => $request->costtax_notes[$i]
				];

				DB::table('qbuy_products_costhead')->insert($data_variant1);
			}
		}

		return 'true';
	}

	public function edit(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$paymenttermslist   = DB::table('qcrm_payment_terms')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
		$productlist = DB::table('qinventory_products')->select('product_id as id', 'product_name', 'opening_stock', 'product_code')->where('del_flag', 1)->where('branch', $branch)->get();
		$accountslist   = DB::table('qinventory_accounts')->select('id', 'account_name')->where('del_flag', 1)->where('branch', $branch)->get();
		$currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
		$taxlist   = DB::table('qpurchase_tax')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
		// $costheadlist   = DB::table('buy_voucher')->leftjoin('qcrm_supplier','buy_voucher.cust_id','=','qcrm_supplier.id')->select('buy_voucher.id','buy_voucher.bill_id','qcrm_supplier.sup_name')->where('buy_voucher.del_flag',1)->where('buy_voucher.branch',$branch)->get();
		$subtable = DB::table('qsettings_branch_details')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
		$subentrytypestable = $subtable . 'entrytypes';
		$query  = DB::table('qsettings_voucher')->leftjoin($subentrytypestable, $subentrytypestable . '.id', '=', 'qsettings_voucher.entry_types')->select('qsettings_voucher.*', $subentrytypestable . '.name')->orderby('qsettings_voucher.id', 'desc');
		$query->where('qsettings_voucher.del_flag', 1)->where('qsettings_voucher.branch', $branch)->get();
		$costheadlist = $query->get();
		$batchlist = DB::table('qpurchase_batch')->select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
		$taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('base_unit', 1)->where('del_flag', 1)->where('branch', $branch)->get();
		$termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
		$vatlist   = $taxgrouplist; // DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
		$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
		$salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->get();
		$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
		$purchase = DB::table('qbuy_purchase')->select('*')->where('branch', $branch)->where('id', $id)->get();
		$purchaseproducts = DB::table('qbuy_products')->select('*')->where('branch', $branch)->where('purchase_id', $id)->get();
		$purchasecosthead = DB::table('qbuy_products_costhead')->select('*')->where('branch', $branch)->where('purchase_id', $id)->get();
		foreach ($purchase as $value) {
			$paymentpreview = DB::table('qcrm_payment_terms')->select('description')->where('id', $value->paymentterms)->get();
			$termspreview = DB::table('qcrm_termsandconditions')->select('description')->where('id', $value->terms)->get();
		}

		return view('qpurchase.purchase.edit', compact('paymenttermslist', 'productlist', 'accountslist', 'currencylist', 'taxlist', 'costheadlist', 'batchlist', 'taxgrouplist', 'unitlist', 'termslist', 'vatlist', 'suppliers', 'salesmen', 'warehouses', 'purchase', 'purchaseproducts', 'purchasecosthead', 'paymentpreview', 'termspreview', 'branch'));
	}


	public function update(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->id;
		$data = [

			'vendor_supplier_name' => $request->name,
			'purchase_date' => Carbon::parse($request->purchase_date)->format('Y-m-d'),
			'purchaseno' => $request->purchaseno,
			'paymentterms' => $request->paymentterms,
			'purchasemethod' => $request->purchasemethod,
			'notes' => $request->notes,
			'terms' => $request->terms,
			'currency' => $request->currency,
			'currency_value' => $request->currencyvalue,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'totalcost_amount' => $request->totalcost_amount,
			'image' => $request->fileData,
			'branch' => $branch,
			'po_ref_number' => $request->po_ref_number,
			'purchasebillid' => $request->purchasebillid,
			'qtnref' => $request->qtnref,
			'vat_no' => $request->vat_no,
			'cr_no' => $request->cr_no,
			'status' => 0,
			'purchaser' => $request->purchaser,
			'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),

		];
		DB::table('qbuy_purchase')->where('id', $postID)->update($data);


		DB::table('qbuy_products')->where('purchase_id', $postID)->delete();

		for ($i = 0; $i < count($request->productname_id); $i++) {
			$data_variant = [
				'purchase_id' => $postID,
				'product_name' => $request->productname[$i],
				'productname_id' => $request->productname_id[$i],
				'unit' => $request->unit[$i],
				'quantity' => $request->quantity[$i],
				'rate' => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'vat_amount' => $request->vatamount[$i],
				'discount' => $request->discountamount[$i],
				'row_total' => $request->row_total[$i],
				'quantity_value' => $request->quantity_value[$i],
				'branch' => $branch,
				'description' =>	 $request->product_description[$i]
			];
			DB::table('qbuy_products')->insert($data_variant);
		}
		DB::table('qbuy_products_costhead')->where('purchase_id', $postID)->delete();
		if (isset($request->itemcost_details) && !empty($request->itemcost_details)) {
			for ($i = 0; $i < count($request->itemcost_details); $i++) {
				$data_variant1 = [
					'purchase_id' => $postID,
					'costheadname' => $request->itemcost_details[$i],
					'rate' => $request->costrate[$i],
					'tax' => $request->costtax_group[$i],
					'amount' => $request->costtax_amount[$i],
					'branch' => $branch,
					'costtax_notes' => $request->costtax_notes[$i],

				];

				DB::table('qbuy_products_costhead')->insert($data_variant1);
			}
		}

		return 'true';
	}


	public function pdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
		$currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
		$termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

		$salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

		$purchase   = DB::table('qbuy_purchase')->leftJoin('qcrm_salesman_details as s1', 'qbuy_purchase.preparedby', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qbuy_purchase.approvedby', '=', 's2.id')->leftJoin('qcrm_salesman_details as s3', 'qbuy_purchase.salesman', '=', 's3.id')->select('qbuy_purchase.*', 's1.name as preparedby', 's2.name as approvedby', 's3.name as salesman')->where('qbuy_purchase.id', $id)->where('qbuy_purchase.del_flag', 1)->where('qbuy_purchase.branch', $branch)->get();

		$purchase_product   = DB::table('qbuy_products')->select('*')->where('purchase_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
		$vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
		$bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
		foreach ($purchase as $key => $value) {

			$pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->vendor_supplier_name)->get();
		}

		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('qpurchase.purchase.preview1', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase', 'purchase_product', 'pname', 'branchsettings', 'bname'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('qpurchase.purchase.preview2', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase', 'purchase_product', 'pname', 'branchsettings', 'bname'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('qpurchase.purchase.preview3', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase', 'purchase_product', 'pname', 'branchsettings', 'bname'));
		} elseif (Session::get('preview') == 'preview4') {

			$pdf = PDF::loadView('qpurchase.purchase.preview4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase', 'purchase_product', 'pname', 'branchsettings', 'bname'));
		} else {
			$pdf = PDF::loadView('qpurchase.purchase.preview4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase', 'purchase_product', 'pname', 'branchsettings', 'bname'));
		}

		return $pdf->stream('purchase.pdf');
	}


	public function approve(Request $request)
	{
		$id = $request->id;
		DB::table('qbuy_purchase')->where('id', $id)->update(['status' => 1]);
		return redirect()->route('qpurchaselist')->with('message', 'State saved correctly!!!');
	}
}

<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;

class DeliveryOrderController extends Controller
{
	public function sell_delivery_list()
	{
		$branch = Session::get('branch');

		$deliveryorder = DB::table('qsell_deliveryorder')->leftjoin('qcrm_customer_details', 'qsell_deliveryorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_deliveryorder.salesman', '=', 'qcrm_salesman_details.id')->leftjoin('qsell_deliveryorder_products', 'qsell_deliveryorder.id', '=', 'qsell_deliveryorder_products.deliveryorder_id')->select('qsell_deliveryorder.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name as salesman_name', DB::raw('SUM(qsell_deliveryorder_products.delivery_quantity) as delivery_quantity'), DB::raw("DATE_FORMAT(qsell_deliveryorder.valid_till, '%d-%m-%Y') as validity"), 'qsell_deliveryorder.id as so_id', DB::raw("DATE_FORMAT(qsell_deliveryorder.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_deliveryorder.branch', $branch)->where('qsell_deliveryorder.del_flag', 1)->groupBy('qsell_deliveryorder.id')->orderby('qsell_deliveryorder.id', 'desc')->get();
		return view('sell.deliveryorder.list', compact('deliveryorder'));
	}
	public function Deliveryorderedit_sell(Request $request)
	{
		$branch = Session::get('branch');

		$deliveryorder_id = $request->id;
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
		$deliveryorder   = DB::table('qsell_deliveryorder')->select('*')->where('id', $deliveryorder_id)->get();
		$deliveryorder_products = DB::table('qsell_deliveryorder_products')->leftjoin('qinventory_products', 'qsell_deliveryorder_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_deliveryorder_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock')->where('qsell_deliveryorder_products.deliveryorder_id', $deliveryorder_id)->get();
		$customers = DB::table('qsell_deliveryorder')->leftjoin('qcrm_customer_details', 'qsell_deliveryorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_deliveryorder.id', $deliveryorder_id)->get();

		return view('sell.deliveryorder.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'deliveryorder', 'deliveryorder_products'));
	}
	public function saleorder_generate_delivery_edit(Request $request)
	{
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');

		$delivery_data = [
			'saleorder_id' => $request->soid,
			'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
			'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
			'qtn_ref' => $request->qtn_ref,
			'po_ref' => $request->po_ref,
			'delivery_period' => $request->delivery_period,
			'attention' => $request->attention,
			'salesman' => $request->salesman,
			'currency' => $request->currency,
			'currencyvalue' => $request->currencyvalue,
			'preparedby' => $request->preparedby,
			'approvedby' => $request->approvedby,
			'customer' => $request->customer,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'tpreview' => $request->tpreview,
			'branch' => $branch,
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
			'internal_reference' => $request->internal_reference,
			'delivery_date' => $request->delivery_date,
			'vehicle' => $request->vehicle,
			'driver' => $request->driver,
			'deliverynote' => $request->deliverynote,
			'status' => 'Draft'
		];


		DB::table('qsell_deliveryorder')->where('id', $request->del_id)->update($delivery_data);
		$delivery_id = DB::getPdo()->lastInsertId();
	}
	public function delivery_delete(Request $request)
	{
		$delid = $request->id;
		$soid = $request->soid;
		$deli_pdt = DB::table('qsell_deliveryorder_products')->select('item_id', 'delivery_quantity')->where('deliveryorder_id', $delid)->get();

		foreach ($deli_pdt as $deli_pdts) {
			$item = $deli_pdts->item_id;
			$dquantity = $deli_pdts->delivery_quantity;

			$a = DB::table('qsell_saleorder_products')->where('item_id', $item)->where('saleorder_id', $soid)->increment('delivery_remaining', $dquantity);
		}
		$deli_pdt = DB::table('qsell_deliveryorder')->where('id', $delid)->update(['del_flag' => 0]);

		return redirect()->route('sell_delivery_list')->with('message', 'State saved correctly!!!');
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
		$delivery = DB::table('qsell_deliveryorder')->select('*')->where('id', $id)->get();
		$deliveryorder = DB::table('qsell_deliveryorder_products')->leftjoin('qinventory_products', 'qsell_deliveryorder_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_deliveryorder_products.*', 'qinventory_products.product_name', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_deliveryorder_products.deliveryorder_id', $id)->get();

		$customers = DB::table('qsell_deliveryorder')->leftjoin('qcrm_customer_details', 'qsell_deliveryorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_deliveryorder.id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();


		foreach ($deliveryorder as $key => $value) {
			$itemname = $value->item_id;
		}
		$itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
		$customfields = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $customfields->pluck('labels')->toArray();
		$gm_amount = 0;


		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('sell.deliveryorder.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'delivery', 'deliveryorder', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('sell.deliveryorder.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'delivery', 'deliveryorder', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('sell.deliveryorder.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'delivery', 'deliveryorder', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname'));
		} elseif (Session::get('preview') == 'preview4') {
			$pdf = PDF::loadView('sell.deliveryorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'delivery', 'deliveryorder', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails'));
		} else {
			$pdf = PDF::loadView('sell.deliveryorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'delivery', 'deliveryorder', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname'));
		}
		return $pdf->stream('Delivery-#' . $id . '.pdf');
	}
	public function Deliveryorderinvoice_sell(Request $request)
	{
		$branch = Session::get('branch');

		$saleorder_id = $request->id;
		$did = $request->did;
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
		$saleorder   = DB::table('qsell_saleorder')->select('*')->where('id', $saleorder_id)->get();
		$saleorder_products = DB::table('qsell_saleorder_products')->leftjoin('qinventory_products', 'qsell_saleorder_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleorder_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleorder_products.saleorder_id', $saleorder_id)->get();

		//dd($saleorder_products);

		$customers = DB::table('qsell_saleorder')->leftjoin('qcrm_customer_details', 'qsell_saleorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleorder.id', $saleorder_id)->get();
		$quotation   = DB::table('qsell_saleorder')->select('qsell_quotation.notes', 'qsell_quotation.internal_reference', 'qsell_quotation.preparedby')->leftjoin('qsell_quotation', 'qsell_saleorder.quote_id', '=', 'qsell_quotation.id')->where('qsell_saleorder.id', $saleorder_id)->get();

		return view('sell.deliveryorder.convert_invoice', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'saleorder', 'saleorder_products', 'quotation'));
	}

	public function deliveryOrder_Performa(Request $request)
	{
		$branch = Session::get('branch');

		$saleorder_id = $request->id;
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
		$saleorder   = DB::table('qsell_saleorder')->select('*')->where('id', $saleorder_id)->get();
		$saleorder_products = DB::table('qsell_saleorder_products')->leftjoin('qinventory_products', 'qsell_saleorder_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleorder_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleorder_products.saleorder_id', $saleorder_id)->get();
		$customers = DB::table('qsell_saleorder')->leftjoin('qcrm_customer_details', 'qsell_saleorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleorder.id', $saleorder_id)->get();
		$quotation   = DB::table('qsell_saleorder')->select('qsell_quotation.notes', 'qsell_quotation.internal_reference', 'qsell_quotation.preparedby')->leftjoin('qsell_quotation', 'qsell_saleorder.quote_id', '=', 'qsell_quotation.id')->where('qsell_saleorder.id', $saleorder_id)->get();

		return view('sell.deliveryorder.convert_perfoma', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'saleorder', 'saleorder_products', 'quotation'));
	}
	public function deliveryorder_performa_sell(Request $request)
	{

		$user_id = Auth::user()->id;
		$branch = Session::get('branch');
		$cname = DB::table('qcrm_customer_details')->where('id', $request->customer)->value('cust_name');
		$sname = DB::table('qcrm_salesman_details')->where('id', $request->salesman)->value('name');
		$invoice_data = [
			'performa_type' => 'By DeliveryOrder',
			'saleorder_id' => $request->saleorder_id,
			'quotedate' =>  Carbon::parse($request->invoicedate)->format('Y-m-d'),
			'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
			'qtn_ref' => $request->qtn_ref,
			'po_ref' => $request->po_ref,
			'delivery_period' => $request->delivery_period,
			'attention' => $request->attention,
			'salesman' => $request->salesman,
			'currency' => $request->currency,
			'currencyvalue' => $request->currencyvalue,
			'preparedby' => $request->preparedby,
			//'approvedby'=>$request->approvedby,
			'customer' => $request->customer,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'tpreview' => $request->tpreview,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'discount_type' => $request->discount_type,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
			'sale_method' => $request->method,
			'paid_amount' => $request->paidamount,
			'balance_amount' => $request->balanceamount,
			'internal_reference' => $request->internal_reference,
			'status' => 1,

		];
		DB::table('qsell_performainvoice')->insert($invoice_data);
		$invoice_id = DB::getPdo()->lastInsertId();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$invoice_product_data = [
				'invoice_id' => $invoice_id,
				'item_id' => $request->item_id[$i],
				'description' => $request->description[$i],
				'unit'         => $request->unit[$i],
				'quantity'   => $request->quantity[$i],
				'rate'     => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vatamount' => $request->vatamount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'discount' => $request->rdiscount[$i],
				'totalamount' => $request->row_total[$i],
				'branch' => $branch,
			];
			DB::table('qsell_performainvoice_products')->insert($invoice_product_data);
		}
	}
}

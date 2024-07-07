<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\inventory\ProductdetailslistModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MuktarSayedSaleh\ZakatTlv\Encoder;
use DataTables;
use App\Traits\AccountingActionsTrait;
use App\Traits\SellTrails;

class InvoiceOrderController extends Controller
{
	use AccountingActionsTrait, SellTrails;
	public function sell_invoice_list(Request $request)
	{
		$branch = Session::get('branch');
		if ($request->ajax()) {
			/*
				$query = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details','qsell_saleinvoice.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsell_saleinvoice.salesman','=','qcrm_salesman_details.id')->leftjoin('qsell_saleorder_products','qsell_saleinvoice.saleorder_id','=','qsell_saleorder_products.saleorder_id')->select('qsell_saleinvoice.*','qcrm_customer_details.cust_name','qcrm_salesman_details.name as salesman_name',DB::raw('SUM(qsell_saleorder_products.quantity) as totalquantity'),DB::raw('SUM(qsell_saleorder_products.delivery_remaining) as delivery'),DB::raw("DATE_FORMAT(qsell_saleinvoice.valid_till, '%d-%m-%Y') as validity"),'qsell_saleinvoice.id as so_id',DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_saleinvoice.branch',$branch)->where('qsell_saleinvoice.del_flag',1)->groupBy('qsell_saleinvoice.id')->orderby('qsell_saleinvoice.id', 'desc')->limit(10);
			*/
			$data = DB::table('qsell_saleinvoice')
				->where('qsell_saleinvoice.branch', $branch)
				->where('qsell_saleinvoice.del_flag', 1)
				->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')
				->select('qsell_saleinvoice.*', DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"), 'qcrm_customer_details.mobile1')
				->get();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->addColumn('status11', function ($row) {
				if ($row->status == 'Approved') {
					$returned =	DB::table('qsell_saleinvoice_products')->where('invoice_id', $row->id)->select(DB::raw('SUM(qsell_saleinvoice_products.quantity) as total_quantity'), DB::raw('SUM(qsell_saleinvoice_products.credit_created_quantity) as total_returned_qty'))->first();
					if ($returned->total_quantity == $returned->total_returned_qty)
						return 'Returned';
					else if ($returned->total_returned_qty > 0)
						return 'Partially Returned';
					else
						return 'Approved';
				} else
					return $row->status;
			})
				->rawColumns(['action', 'status11'])->make(true);
		}
		return view('sell.invoiceorder.list1');
	}

	public function pending_bills(Request $request)
	{
		$branch = Session::get('branch');
		if ($request->ajax()) {

			$query = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.salesman', '=', 'qcrm_salesman_details.id')->leftjoin('qsell_saleorder_products', 'qsell_saleinvoice.saleorder_id', '=', 'qsell_saleorder_products.saleorder_id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', 'qcrm_salesman_details.name as salesman_name', DB::raw('SUM(qsell_saleorder_products.quantity) as totalquantity'), DB::raw('SUM(qsell_saleorder_products.delivery_remaining) as delivery'), DB::raw("DATE_FORMAT(qsell_saleinvoice.valid_till, '%d-%m-%Y') as validity"), 'qsell_saleinvoice.id as so_id', DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_saleinvoice.invoice_date, '%d-%m-%Y') as invoice_date"))
				->where('qsell_saleinvoice.branch', $branch)
				->where('qsell_saleinvoice.del_flag', 1)
				->where('qsell_saleinvoice.balance_amount', '>', 0)
				->groupBy('qsell_saleinvoice.id')
				->orderby('qsell_saleinvoice.id', 'desc');

			if (!empty($request->search['value'])) {
				$query->where('qsell_saleinvoice.id', 'like', '%' . $request->search['value'] . '%');
				$query->orWhere('qsell_saleinvoice.cust_name', 'like', '%' . $request->search['value'] . '%');
				$query->orWhere('qsell_saleinvoice.grandtotalamount', 'like', '%' . $request->search['value'] . '%');
			}


			$data = $query->get();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('sell.invoiceorder.list2');
	}

	public function sell_invoice_list1()
	{
		$branch = Session::get('branch');

		$invoiceorder = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_salesman_details', 'qsell_saleinvoice.salesman', '=', 'qcrm_salesman_details.id')->leftjoin('qsell_saleorder_products', 'qsell_saleinvoice.saleorder_id', '=', 'qsell_saleorder_products.saleorder_id')->select('qsell_saleinvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_salesman_details.name as salesman_name', DB::raw('SUM(qsell_saleorder_products.quantity) as totalquantity'), DB::raw('SUM(qsell_saleorder_products.delivery_remaining) as delivery'), DB::raw("DATE_FORMAT(qsell_saleinvoice.valid_till, '%d-%m-%Y') as validity"), 'qsell_saleinvoice.id as so_id', DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_saleinvoice.invoice_date, '%d-%m-%Y') as invoice_date"))->where('qsell_saleinvoice.branch', $branch)->where('qsell_saleinvoice.del_flag', 1)->groupBy('qsell_saleinvoice.id')->orderby('qsell_saleinvoice.id', 'desc')->get();
		return view('sell.invoiceorder.list', compact('invoiceorder'));
	}

	/* public function Add_Invoice_Sell()
    {
        $branch=Session::get('branch');
 	$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();

   $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch',$branch)->get();

   $common_customer_database = DB::table('qsettings_company')->select('common_customer_database')->value('common_customer_database');
    $productlistquery = DB::table('qinventory_products')->select('qinventory_products.product_id','qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode as bar_code','qinventory_products.product_id as pid','qinventory_products.product_price as product_price','qinventory_products.selling_price as selling_price','qinventory_products.product_status','qinventory_products.description as description','qinventory_products.product_id as id','qinventory_products.product_type','qinventory_products.available_stock','qinventory_products.part_no','qinventory_products.warehouse_name','qinventory_products.store_name','qinventory_products.unit_name','qinventory_products.category_name','qinventory_products.available_stock as so',DB::raw("(SELECT SUM(qsales_salesorder_products.iremaining_quantity) FROM qsales_salesorder_products

      WHERE qinventory_products.product_id = qsales_salesorder_products.itemname

      GROUP BY qsales_salesorder_products.itemname) as so"))->orderby('qinventory_products.product_id', 'desc');
						
	if ($common_customer_database != 1)
	{
		$productlistquery->where('branch',$branch);
	}
	$productlist = $productlistquery->where('del_flag',1)->get();
	$currencylistquery = DB::table('qpurchase_currency')->select('id','currency_name','currency_default','value');
	if ($common_customer_database != 1)
	{
		$currencylistquery->where('branch',$branch);
	}
	$currencylist = $currencylistquery->where('del_flag',1)->get();
	$unitlistquery = DB::table('qinventory_product_unit')->select('id','unit_name');
	if ($common_customer_database != 1)
	{
		$unitlistquery->where('branch',$branch);
	}

	$unitlist = $unitlistquery->where('del_flag',1)->get();

		$termslistquery = DB::table('qcrm_termsandconditions')->select('id','term');

			if ($common_customer_database != 1){
			    $termslistquery->where('branch',$branch);
			}

		$termslist = $termslistquery->where('del_flag',1)->get();

		 $customersquery = DB::table('qcrm_customer_details')->select('id','cust_name');

			if ($common_customer_database != 1){
			    $customersquery->where('branch',$branch);
			}

		$customers = $customersquery->where('del_flag',1)->get();

		 $salesmenquery = DB::table('qcrm_salesman_details')->select('id','name');

			if ($common_customer_database != 1){
			    $salesmenquery->where('branch',$branch);
			}

		$salesmen = $salesmenquery->where('del_flag',1)->get();

		 $vatlistquery = DB::table('qpurchase_taxgroup')->select('id','total','default_tax');

			if ($common_customer_database != 1){
			    $vatlistquery->where('branch',$branch);
			}

		$vatlist = $vatlistquery->where('del_flag',1)->get();

		 $areaListquery = DB::table('qcrm_customer_categorydetails')->select('*');

			if ($common_customer_database != 1){
			    $areaListquery->where('branch',$branch);
			}

		$areaList = $areaListquery->where('del_flag',1)->get();

		 $areaListsquery = DB::table('qcrm_customer_typedetails')->select('*');

			if ($common_customer_database != 1){
			    $areaListsquery->where('branch',$branch);
			}

		$areaLists = $areaListsquery->where('del_flag',1)->get();


		 $groupquery = DB::table('qcrm_customer_groupdetails')->select('*');

			if ($common_customer_database != 1){
			    $groupquery->where('branch',$branch);
			}

		$group = $groupquery->where('del_flag',1)->get();

		$countryquery = DB::table('countries')->select('id', 'cntry_name');
		$country = $countryquery->get();

		 $stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag',1)->get();
		 $storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch',$branch)->get();
		 $default_grp   = DB::table('qcrm_customer_groupdetails')->select('id')->where('default_grp',1)->get();
$typedefault   = DB::table('qcrm_customer_typedetails')->select('id')->where('typedefault',1)->get();
$catdefault   = DB::table('qcrm_customer_categorydetails')->select('id')->where('catdefault',1)->get();
    return view('sell.invoiceorder.add',compact('branch','currencylist','vatlist','productlist','unitlist','termslist','customers','salesmen','areaList','areaLists','group','country','storeavailabe','stores','warehouses','default_grp','typedefault','catdefault'));
    } */

	public function Add_Invoice_Sell()
	{
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

		$customersquery = DB::table('qcrm_customer_details')->select('id', 'cust_name');

		if ($common_customer_database != 1) {
			$customersquery->where('branch', $branch);
		}

		$customers = $customersquery->where('del_flag', 1)->get();

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

		$areaListquery = DB::table('qcrm_customer_categorydetails')->select('*');

		if ($common_customer_database != 1) {
			$areaListquery->where('branch', $branch);
		}

		$areaList = $areaListquery->where('del_flag', 1)->get();

		$areaListsquery = DB::table('qcrm_customer_typedetails')->select('*');

		if ($common_customer_database != 1) {
			$areaListsquery->where('branch', $branch);
		}

		$areaLists = $areaListsquery->where('del_flag', 1)->get();


		$groupquery = DB::table('qcrm_customer_groupdetails')->select('*');

		if ($common_customer_database != 1) {
			$groupquery->where('branch', $branch);
		}

		$group = $groupquery->where('del_flag', 1)->get();

		$countryquery = DB::table('countries')->select('id', 'cntry_name');
		$country = $countryquery->get();

		$stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();
		$storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
		$default_grp   = DB::table('qcrm_customer_groupdetails')->select('id')->where('default_grp', 1)->get();
		$typedefault   = DB::table('qcrm_customer_typedetails')->select('id')->where('typedefault', 1)->get();
		$catdefault   = DB::table('qcrm_customer_categorydetails')->select('id')->where('catdefault', 1)->get();
		return view('sell.invoiceorder.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'default_grp', 'typedefault', 'catdefault'));
	}

	public function invoicesubmit_sell(Request $request)
	{


		$user_id = Auth::user()->id;
		$branch = Session::get('branch');

		/*Insert to SaleOrder Table*/

		// /Check IF new customer/
		if ($request->customer_type == 1) {
			$customer_default = 0;
			$customer_default = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('customer_default');


			$customer_data = [
				'cust_code' => $request->cust_code, 'cust_type' => $request->cust_type, 'cust_category' => $request->cust_category, 'cust_group' => $request->cust_group, 'cust_name' => $request->cust_name, 'cust_add1' => $request->building_no, 'cust_add2' => $request->cust_region, 'cust_country' => $request->cust_country, 'cust_region' => $request->cust_district, 'cust_city' => $request->cust_city, 'cust_zip' => $request->cust_zip, 'mobile1' => $request->mobile, 'branch' => $branch, 'cust_district' => $request->cust_district, 'building_no' => $request->building_no, 'email1' => $request->email, 'vatno' => $request->vatno, 'buyerid_crno' => $request->buyerid_crno, 'account_ledger' => $customer_default
			];

			DB::table('qcrm_customer_details')->insert($customer_data);
			$customer_id = DB::getPdo()->lastInsertId();
		} else {
			$customer_id = $request->customer;
		}


		$sale_order_data = [
			'sale_type' => 'Direct',
			'quote_id' => '',
			'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
			'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
			'qtn_ref' => $request->qtn_ref,
			'po_ref' => $request->po_ref,
			'delivery_period' => '',
			'attention' => $request->attention,
			'salesman' => $request->salesman,
			'currency' => $request->currency,
			'currencyvalue' => $request->currencyvalue,
			'preparedby' => $request->preparedby,
			'approvedby' => $request->approvedby,
			'discount_type' => $request->discount_type,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'internal_reference' => $request->internal_reference,
			'tpreview' => $request->tpreview,
			'documents' => '',
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
			'podate' => Carbon::parse($request->quotedate)->format('Y-m-d'),
			'status' => 'Draft',
		];

		DB::table('qsell_saleorder')->insert($sale_order_data);
		$saleorder_id = DB::getPdo()->lastInsertId();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$sale_order_product_data = [
				'saleorder_id' => $saleorder_id,
				'item_id' => $request->item_id[$i],
				'description' => $request->description[$i],
				'unit'         => $request->unit[$i],
				'quantity'   => $request->quantity[$i],
				'delivery_remaining'   => $request->quantity[$i],
				'invoice_remaining'   => 0,
				'rate'     => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vatamount' => $request->vatamount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'discount' => $request->rdiscount[$i],
				'totalamount' => $request->row_total[$i],
				'branch' => $branch
			];
			DB::table('qsell_saleorder_products')->insert($sale_order_product_data);
		}



		/*Insert to SaleOrder Table*/
		/*Insert to Invoice Table*/
		$cname = DB::table('qcrm_customer_details')->where('id', $customer_id)->value('cust_name');
		$sname = DB::table('qcrm_salesman_details')->where('id', $request->salesman)->value('name');
		$invoice_data = [
			'invoice_number' => $request->invoicenumber,
			'sale_type' => 'Direct',
			'saleorder_id' => $saleorder_id,
			'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
			'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
			'qtn_ref' => $request->qtn_ref,
			'po_ref' => $request->po_ref,
			'delivery_period' => '',
			'attention' => $request->attention,
			'salesman' => $request->salesman,
			'currency' => $request->currency,
			'currencyvalue' => $request->currencyvalue,
			'preparedby' => $request->preparedby,
			'approvedby' => $request->approvedby,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'internal_reference' => $request->internal_reference,
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
			'useadvance' => $request->useadvance,
			'status' => 'Draft',
			'cust_name' => $cname,
			'salesman_name' => $sname,
		];


		DB::table('qsell_saleinvoice')->insert($invoice_data);
		$invoice_id = DB::getPdo()->lastInsertId();


		///
		if (empty($request->invoicenumber)) {
			DB::table('qsell_saleinvoice')->where('id', $invoice_id)->update(['invoice_number' => $invoice_id]);
		}


		////
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
				'branch' => $branch
			];
			DB::table('qsell_saleinvoice_products')->insert($invoice_product_data);

			/*Minus Stock*/


			$check_stock = ProductdetailslistModel::where('product_id', $request->item_id[$i])->first()->available_stock;

			if ($check_stock > 0 && $check_stock >=  $request->quantity[$i]) {
				$stock = ProductdetailslistModel::where('product_id',  $request->item_id[$i])->decrement('available_stock', $request->quantity[$i]);
			} else {
				/* watchOut('warning', 'Opps', 'Stock shortage');
			        return back();*/
			}

			/*Minus Stock*/
		}

		/*Generate Zakat QR code*/
		$company_name = '';
		$company_vat = '';
		$company_details = DB::table('qsettings_company')->select('*')->first();
		$company_name = $company_details->company_name;
		$company_vat = $company_details->company_vat;
		$quotedate = Carbon::parse($request->quotedate)->format('Y-m-d  h:i');
		$grandtotalamount = $request->grandtotalamount;
		$totalvatamount = $request->totalvatamount;


		$qrtextof = 'Seller Name :-> ' . $company_name . ', Vat Number :-> ' . $company_vat . ', Datetime :-> ' . $quotedate . ', Vat Total :-> ' . $totalvatamount . ', Total  :->' . $grandtotalamount;


		$encoder = new Encoder();
		$qr_signature = $encoder->encode(
			$company_name,
			$company_vat,
			null,
			$grandtotalamount,
			$totalvatamount
		);

		$qrcode = QrCode::size(200)->format('svg')->generate($qr_signature, storage_path('app/public/QRinvoice/' . str_slug($invoice_id) . '.svg'));

		/*Generate Zakat QR code*/




		/*Customer Balance*/
		if ($request->useadvance == 1) {
			$paydata = [
				'customer_id' => $customer_id,
				'payment_date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
				'payment_type' => 'Invoice',
				'doc_id' => $invoice_id,
				'dr_amount' => $request->paidamount,
				'cr_amount' => 0
			];
			$payid = DB::table('qsell_customer_payments')->insertGetId($paydata);
		}

		/////////////////////////////////////////////
		//get customer ledger

		$customer_ledger = DB::table('qcrm_customer_details')->where('id', $customer_id)->select('account_ledger')->value('account_ledger');


		//get sales ledger
		$sales_evenue_account = 0;
		$sales_evenue_account = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('sales_evenue_account');

		//get vat ledger
		$output_vat_ledger = 0;
		$output_vat_ledger = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('output_vat_ledger');

		//get entry type

		$sales_inv_entry_type = 0;
		$sales_inv_entry_type = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('sales_inv_entry_type');

		//get number
		$number = $this->nextNumber($sales_inv_entry_type);

		//pass entry to accounting

		$data_accounts = [
			'entrytype_id'   => $sales_inv_entry_type,
			'number'         => $number,
			'date'           => date("Y-m-d"),
			'dr_total'       => abs($request->grandtotalamount),
			'cr_total'       => abs($request->grandtotalamount),


		];



		$main_entry = DB::table('a_branch1_entries')->insert($data_accounts);
		$main_entry_id = DB::getPdo()->lastInsertId();



		$data_accounts_items = [
			'entry_id'   => $main_entry_id,
			'ledger_id'  => $customer_ledger,
			'amount'     => abs($request->grandtotalamount),
			'dc'         => 'D',
			'narration'         => '-',
		];
		DB::table('a_branch1_entryitems')->insert($data_accounts_items);
		$data_accounts_items = [
			'entry_id'   => $main_entry_id,
			'ledger_id'  => $sales_evenue_account,
			'amount'     => abs($request->totalamount),
			'dc'         => 'C',
			'narration'         => '-',
		];




		DB::table('a_branch1_entryitems')->insert($data_accounts_items);


		$data_accounts_items = [
			'entry_id'   => $main_entry_id,
			'ledger_id'  => $output_vat_ledger,
			'amount'     => abs($request->totalvatamount),
			'dc'         => 'C',
			'narration'         => '-',
		];




		DB::table('a_branch1_entryitems')->insert($data_accounts_items);


		//save entry id in sales table
		DB::table('qsell_saleinvoice')->where('id', $invoice_id)->update(['entry_id' => $main_entry_id]);


		/////////////////////////////////////////////////////////////////////////////////////////////
		return 'Success';
	}



	public function nextNumber($id)
	{

		$max = DB::table('a_branch1_entries')->where('entrytype_id', $id)->max('number');

		/*   foreach ($max as $key => $value) {
    if (empty($value->max)) {
        $maxNumber = 0;
      } else {
        $maxNumber = $value->max;
      }
   }*/
		if (empty($max)) {
			$maxNumber = 0;
		} else {
			$maxNumber = $max;
		}

		return $maxNumber + 1;
	}


	public function Invoice_edit_sell(Request $request)
	{
		$saletype = $request->type;
		$soid = $request->soid;
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

		$areaListquery = DB::table('qcrm_customer_categorydetails')->select('id', 'customer_category');

		if ($common_customer_database != 1) {
			$areaListquery->where('branch', $branch);
		}

		$areaList = $areaListquery->where('del_flag', 1)->get();

		$areaListsquery = DB::table('qcrm_customer_typedetails')->select('id', 'title');

		if ($common_customer_database != 1) {
			$areaListsquery->where('branch', $branch);
		}

		$areaLists = $areaListsquery->where('del_flag', 1)->get();


		$groupquery = DB::table('qcrm_customer_groupdetails')->select('id', 'title');

		if ($common_customer_database != 1) {
			$groupquery->where('branch', $branch);
		}

		$group = $groupquery->where('del_flag', 1)->get();

		$countryquery = DB::table('countries')->select('id', 'cntry_name');
		$country = $countryquery->get();

		$stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();

		$storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
		$invoice   = DB::table('qsell_saleinvoice')->select('qsell_saleinvoice.*', DB::raw("DATE_FORMAT(qsell_saleinvoice.invoice_date, '%d-%m-%Y') as invoice_date"))->where('del_flag', 1)->where('id', $id)->get();

		$invoice_product = DB::table('qsell_saleinvoice_products')
			->select('qsell_saleinvoice_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', 'qsell_saleinvoice.saleorder_id', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products
            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id
            GROUP BY qsell_saleorder_products.item_id) as so"), 'qsell_saleorder_products.invoice_remaining')
			->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')
			->leftjoin('qsell_saleinvoice', 'qsell_saleinvoice_products.invoice_id', '=', 'qsell_saleinvoice.id')
			->leftjoin('qsell_saleorder_products', 'qsell_saleinvoice_products.so_item_id', '=', 'qsell_saleorder_products.id')

			->where('qsell_saleinvoice_products.invoice_id', $id)
			->get();

		// 	foreach ($invoice_product as $invoice_products) {
		// 	$soid = $invoice_products->saleorder_id;
		// 	$invoice_products->invoice_rem = DB::table('qsell_saleorder_products')->where('del_flag', 1)->where('saleorder_id', $soid)->value('invoice_remaining');
		// }

		$customers = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleinvoice.id', $id)->get();
		$squantity   = DB::table('qsell_saleorder_products')->select('quantity')->where('del_flag', 1)->where('saleorder_id', $soid)->get();
		$quotation   = DB::table('qsell_saleorder')->select('qsell_quotation.notes', 'qsell_quotation.internal_reference', 'qsell_quotation.preparedby', 'qsell_saleorder.notes as sonotes', 'qsell_saleorder.internal_reference as sointernal_reference', 'qsell_saleorder.preparedby as sopreparedby', 'qsell_saleorder.quote_id', 'qsell_saleorder.id', 'qsell_saleorder.quotedate as qdate', 'qsell_quotation.quotedate as sodate')->leftjoin('qsell_quotation', 'qsell_saleorder.quote_id', '=', 'qsell_quotation.id')->where('qsell_saleorder.id', $soid)->get();
		if ($saletype == 'By Quote') {
			return view('sell.invoiceorder.edit_by_quote', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'invoice', 'invoice_product', 'saletype', 'quotation'));
		}
		return view('sell.invoiceorder.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'invoice', 'invoice_product', 'saletype'));
	}

	public function Pdf(Request $request)
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
		$salesinvoice   = DB::table('qsell_saleinvoice')->select('*')->where('id', $id)->get();
		$salesinvoice_products = DB::table('qsell_saleinvoice_products')->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_saleinvoice_products.*', 'qinventory_products.product_name', 'qinventory_products.product_name as product_name1', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', 'qsell_saleinvoice_products.description as description', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleinvoice_products.invoice_id', $id)->get();







		$customers = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleinvoice.id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();

		//dd($salesinvoice_products);
		foreach ($salesinvoice_products as $key => $value) {
			$itemname = $value->item_id;
		}
		$itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
		$customfields = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $customfields->pluck('labels')->toArray();
		$gm_amount = 0;
		foreach ($salesinvoice as $key => $value) {
			$gm_amount = $value->grandtotalamount;
			$balance_amount = $value->balance_amount;
		}

		$words = $this->numberToWord($gm_amount);
		$quote_status = DB::table('qsell_saleinvoice')->select('status')->where('id', $id)->value('status');

		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('sell.invoiceorder.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'salesinvoice_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('sell.invoiceorder.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'salesinvoice_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('sell.invoiceorder.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'salesinvoice_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview4') {
			if ($quote_status == "Approved") {
				$pdf = PDF::loadView('sell.invoiceorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'salesinvoice_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'words'));
			} else {
				$pdf = PDF::loadView('sell.invoiceorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'salesinvoice_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'words'), [], [
					'default_font'               => 'sans-serif',
					'watermark'                  => $quote_status,
					'show_watermark'             => true,
					'pdfa'                       => false,
					'pdfaauto'                   => false,
				]);
			}
		} else {
			$pdf = PDF::loadView('sell.invoiceorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'salesinvoice_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		}
		return $pdf->stream('invoiceorder-#' . $id . '.pdf');
	}

	public function Invoice_approve_sell(Request $request)
	{
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

		$areaListquery = DB::table('qcrm_customer_categorydetails')->select('id', 'customer_category');

		if ($common_customer_database != 1) {
			$areaListquery->where('branch', $branch);
		}

		$areaList = $areaListquery->where('del_flag', 1)->get();

		$areaListsquery = DB::table('qcrm_customer_typedetails')->select('id', 'title');

		if ($common_customer_database != 1) {
			$areaListsquery->where('branch', $branch);
		}

		$areaLists = $areaListsquery->where('del_flag', 1)->get();


		$groupquery = DB::table('qcrm_customer_groupdetails')->select('id', 'title');

		if ($common_customer_database != 1) {
			$groupquery->where('branch', $branch);
		}

		$group = $groupquery->where('del_flag', 1)->get();

		$countryquery = DB::table('countries')->select('id', 'cntry_name');
		$country = $countryquery->get();

		$stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();

		$storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
		$invoice   = DB::table('qsell_saleinvoice')->select('*')->where('del_flag', 1)->where('id', $id)->get();
		$invoice_product = DB::table('qsell_saleinvoice_products')->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleinvoice_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleinvoice_products.invoice_id', $id)->get();
		$customers = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleinvoice.id', $id)->get();

		return view('sell.invoiceorder.approve', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'invoice', 'invoice_product'));
	}
	public function Invoice_Approve(Request $request)
	{
		DB::transaction(function () use ($request) {
			$id = $request->id;
			DB::table('qsell_saleinvoice')->where('id', $id)->update(['status' => 'Approved', 'balance_amount' => DB::raw('grandtotalamount')]);
			$this->insertInvoiceSOA($id); // Statement of account entry
			$this->salesInvoiceAccountingEnrty($id); // Accounting Entry
		});
		return redirect()->route('sell_invoice_list')->with('message', 'State saved correctly!!!');
	}
	public function numberToWord($num = '')
	{
		$num    = (string) ((int) $num);
		if ((int) ($num) && ctype_digit($num)) {
			$words  = array();
			$num    = str_replace(array(',', ' '), '', trim($num));
			$list1  = array(
				'', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
				'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
				'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
			);
			$list2  = array(
				'', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
				'seventy', 'eighty', 'ninety', 'hundred'
			);



			$list3  = array(
				'', 'thousand', 'million', 'billion', 'trillion',
				'quadrillion', 'quintillion', 'sextillion', 'septillion',
				'octillion', 'nonillion', 'decillion', 'undecillion',
				'duodecillion', 'tredecillion', 'quattuordecillion',
				'quindecillion', 'sexdecillion', 'septendecillion',
				'octodecillion', 'novemdecillion', 'vigintillion'
			);
			$num_length = strlen($num);
			$levels = (int) (($num_length + 2) / 3);
			$max_length = $levels * 3;
			$num    = substr('00' . $num, -$max_length);
			$num_levels = str_split($num, 3);
			foreach ($num_levels as $num_part) {
				$levels--;
				$hundreds   = (int) ($num_part / 100);
				$hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
				$tens       = (int) ($num_part % 100);
				$singles    = '';
				if ($tens < 20) {
					$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
				} else {
					$tens = (int) ($tens / 10);
					$tens = ' ' . $list2[$tens] . ' ';
					$singles = (int) ($num_part % 10);
					$singles = ' ' . $list1[$singles] . ' ';
				}
				$words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
			}
			$commas = count($words);
			if ($commas > 1) {
				$commas = $commas - 1;
			}
			$words  = implode(', ', $words);
			$words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');
			if ($commas) {
				$words  = str_replace(',', ' ', $words);
			}
			return $words;
		} else if (!((int) $num)) {
			return 'Zero';
		}
		return '';
	}



	public function sales_soacorrect()
	{
		/////////////////
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
				'doc_transaction' => Carbon::parse($value->invoice_date)->format('Y-m-d'),
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


	public function purchase_soacorrect()
	{

		/////////////////
		DB::table('qsell_purchase_soa')->delete();


		$met = 0;
		$transaction_type = "";
		$method = DB::table('buy_voucher')->select('*')->get();

		foreach ($method as $key => $value) {
			# code...

			$a = $value->purchase_type;
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
				$dr_amount = $value->paidamount;
			}


			$cid = $value->cust_id;
			$branch = Session::get('branch');

			$soa = [
				'doc_type'        => 'Purchase',
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
			DB::table('qsell_purchase_soa')->insert($soa);
		}
	}
	////



	public function invoice_correct(Request $request)
	{


		/*DB::table('qsell_saleorder')->truncate();
DB::table('qsell_saleorder_products')->truncate();
DB::table('qsell_saleinvoice')->truncate();
DB::table('qsell_saleinvoice_products')->truncate();*/

		/*qsales_salesorder
qsales_salesorder_products
qsell_saleinvoice
qsell_saleinvoice_products*/
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');


		$saleorders = DB::table('qsales_salesorder')->select('*')->get();

		foreach ($saleorders as $key => $value) {

			$did = $value->id;
			$sale_order_data = [

				'id' => $value->id,
				'sale_type' => 'Direct',
				'quote_id' => '',
				'quotedate' =>  Carbon::parse($value->quotedate1)->format('Y-m-d'),
				'valid_till' =>  Carbon::parse($value->validity)->format('Y-m-d'),
				'qtn_ref' => $value->qtnref,
				'po_ref' => $value->po_wo_ref,
				'delivery_period' => '',
				'attention' => $value->attention,
				'salesman' => $value->salesman,
				'currency' => $value->currency,
				'currencyvalue' => $value->currencyvalue,
				'preparedby' => $value->preparedby,
				'approvedby' => $value->approvedby,
				'discount_type' => 1,
				'customer' => $value->customer,
				'terms_conditions' => $value->terms,
				'notes' => $value->notes,
				'internal_reference' => $value->terms,
				'tpreview' => $value->tpreview,
				'documents' => '',
				'totalamount' => $value->totalamount,
				'discount' => $value->discount,
				'amountafterdiscount' => $value->amountafterdiscount,
				'vatamount' => $value->vatamount,
				'grandtotalamount' => $value->grandtotalamount,
				'branch' => $value->branch,
				'user_id' => $user_id,
				'payment_terms' => $value->terms,
				'podate' => Carbon::parse($value->quotedate1)->format('Y-m-d'),
				'status' => 'Approved',
			];

			DB::table('qsell_saleorder')->insert($sale_order_data);
			$saleorder_id = DB::getPdo()->lastInsertId();
			$salesorder_products = DB::table('qsales_salesorder_products')->select('*')->where('quotationid', $value->id)->get();

			foreach ($salesorder_products as $key => $value1) {
				$sale_order_product_data = [
					'saleorder_id' => $saleorder_id,
					'item_id' => $value1->itemname,
					'description' => $value1->description,
					'unit'         => $value1->unit,
					'quantity'   => $value1->quantity,
					'delivery_remaining'   => $value1->quantity,
					'invoice_remaining'   => 0,
					'rate'     => $value1->rate,
					'amount' => $value1->amount,
					'vatamount' => $value1->vatamount,
					'vat_percentage' => $value1->vat_percentage,
					'discount' => $value1->rdiscount,
					'totalamount' => $value1->totalamount,
					'branch' => $branch
				];
				DB::table('qsell_saleorder_products')->insert($sale_order_product_data);
			}



			$invoice_data = [
				'id' => $value->id,
				// 'invoice_number' => $request->invoicenumber,
				'sale_type' => 'Direct',
				'saleorder_id' => $saleorder_id,

				'quotedate' =>  Carbon::parse($value->quotedate1)->format('Y-m-d'),
				'valid_till' =>  Carbon::parse($value->validity)->format('Y-m-d'),
				'qtn_ref' => $value->qtnref,
				'po_ref' => $value->po_wo_ref,
				'delivery_period' => '',
				'attention' => $value->attention,
				'salesman' => $value->salesman,
				'currency' => $value->currency,
				'currencyvalue' => $value->currencyvalue,
				'preparedby' => $value->preparedby,
				'approvedby' => $value->approvedby,
				'discount_type' => 1,
				'customer' => $value->customer,
				'terms_conditions' => $value->terms,
				'notes' => $value->notes,
				'internal_reference' => $value->terms,
				'tpreview' => $value->tpreview,
				'documents' => '',
				'totalamount' => $value->totalamount,
				'discount' => $value->discount,
				'amountafterdiscount' => $value->amountafterdiscount,
				'vatamount' => $value->vatamount,
				'grandtotalamount' => $value->grandtotalamount,
				'branch' => $value->branch,
				'user_id' => $user_id,
				'payment_terms' => $value->terms,
				//	'podate'=>Carbon::parse($value->quotedate1)->format('Y-m-d'),
				'status' => 'Approved',

				'sale_method' => 1,
				'paid_amount' => 0,
				'balance_amount' => $request->grandtotalamount,
				//	'useadvance' => $request->useadvance,
				//	'status'=>'Draft',

			];


			DB::table('qsell_saleinvoice')->insert($invoice_data);
			$invoice_id = DB::getPdo()->lastInsertId();





			DB::table('qsell_saleinvoice')->where('id', $invoice_id)->update(['invoice_number' => $invoice_id]);












			foreach ($salesorder_products as $key => $value1) {
				$invoice_product_data = [
					'invoice_id' => $invoice_id,
					'item_id' => $value1->itemname,
					'description' => $value1->description,
					'unit'         => $value1->unit,
					'quantity'   => $value1->quantity,
					/*	'delivery_remaining'   => $value1->quantity,
				'invoice_remaining'   => 0, 	 */
					'rate'     => $value1->rate,
					'amount' => $value1->amount,
					'vatamount' => $value1->vatamount,
					'vat_percentage' => $value1->vat_percentage,
					'discount' => $value1->rdiscount,
					'totalamount' => $value1->totalamount,
					'branch' => $branch
				];
				DB::table('qsell_saleinvoice_products')->insert($invoice_product_data);
			}




			$company_name = '';
			$company_vat = '';
			$company_details = DB::table('qsettings_company')->select('*')->first();
			$company_name = $company_details->company_name;
			$company_vat = $company_details->company_vat;
			$quotedate = Carbon::parse($value->quotedate)->format('Y-m-d  h:i');
			$grandtotalamount = $value->grandtotalamount;
			$totalvatamount = $value->vatamount;


			$qrtextof = 'Seller Name :-> ' . $company_name . ', Vat Number :-> ' . $company_vat . ', Datetime :-> ' . $quotedate . ', Vat Total :-> ' . $totalvatamount . ', Total  :->' . $grandtotalamount;


			$encoder = new Encoder();
			$qr_signature = $encoder->encode(
				$company_name,
				$company_vat,
				null,
				$grandtotalamount,
				$totalvatamount
			);

			$qrcode = QrCode::size(200)->format('svg')->generate($qr_signature, storage_path('app/public/QRinvoice/' . str_slug($invoice_id) . '.svg'));











			DB::table('qsales_salesorder')->where('id', $did)->delete();
		}


		/*Insert to SaleOrder Table*/

		// /Check IF new customer/







		/*Insert to SaleOrder Table*/
		/*Insert to Invoice Table*/



		///



		////








		/*Customer Balance*/

		return 'Success';
	}




	public function delete(Request $request)
	{
		DB::transaction(function () use ($request) {
			$id = $request->id;
			//	DB::table('qsell_saleinvoice')->where('id', $id)->update(['del_flag' =>0]);
			DB::table('qsell_saleinvoice')->where('id', $id)->delete();
			$maxValue = DB::table('qsell_saleinvoice')->orderBy('id', 'desc')->value('id');
			$autono = $maxValue + 1;
			DB::statement("ALTER TABLE qsell_saleinvoice AUTO_INCREMENT = $autono;");

			$invoiceData = DB::table('qsell_saleinvoice_products')->where('invoice_id', $id)->get();
			foreach ($invoiceData as $key => $value) {
				DB::table('qsell_saleorder_products')->where('id', $value->so_item_id)->increment('invoice_remaining', $value->quantity);
			}
			DB::table('qsell_saleinvoice_products')->where('invoice_id', $id)->delete();
		});
		return redirect()->route('sell_invoice_list')->with('message', 'State saved correctly!!!');
	}

	public function customer_correct(Request $request)
	{

		$saleoinvs = DB::table('qsell_saleinvoice')->select('id', 'salesman', 'customer')->get();

		foreach ($saleoinvs as $key => $value) {

			$id = $value->id;
			$cname = DB::table('qcrm_customer_details')->where('id', $value->customer)->value('cust_name');
			$sname = DB::table('qcrm_salesman_details')->where('id', $value->salesman)->value('name');
			DB::table('qsell_saleinvoice')->where('id', $id)->update(['cust_name' => $cname, 'salesman_name' => $sname]);
		}
		return 1;
	}

	public function invoiceupdate_sell_byquote(Request $request)
	{
		try {
			DB::transaction(function () use ($request) {
				$soid = $request->soid;
				$invid = $request->id;
				$user_id = Auth::user()->id;
				$branch = Session::get('branch');
				/*Insert to Invoice Table*/
				$invoice_data = [
					'invoice_number' => $request->invoicenumber,
					// 'sale_type' => 'By Quote',
					// 'saleorder_id' => $request->soid,
					'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
					'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
					'qtn_ref' => $request->qtn_ref,
					'po_ref' => $request->po_ref,
					'delivery_period' => '',
					'attention' => $request->attention,
					'salesman' => $request->salesman,
					'currency' => $request->currency,
					'currencyvalue' => $request->currencyvalue,
					'preparedby' => $request->preparedby,
					'approvedby' => $request->approvedby,
					'customer' => $request->customer,
					'terms_conditions' => $request->terms_conditions,
					'notes' => $request->notes,
					'internal_reference' => $request->internal_reference,
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
					'useadvance' => $request->useadvance,
					'status' => $request->status,
				];

				DB::table('qsell_saleinvoice')->where('id', $invid)->update($invoice_data);

				$oldProducts = DB::table('qsell_saleinvoice_products')->select('*')->where('invoice_id', $invid)->get();

				foreach ($oldProducts as $key => $value) {
					DB::table('qsell_saleorder_products')->where('id', $value->so_item_id)->increment('invoice_remaining', $value->quantity);
				}

				DB::table('qsell_saleinvoice_products')->where('invoice_id', $invid)->delete();

				for ($i = 0; $i < count($request->item_id); $i++) {
					$invoice_product_data = [
						'invoice_id' => $invid,
						'item_id' => $request->item_id[$i],
						'so_item_id' => $request->so_item_id[$i],
						'description' => $request->description[$i],
						'unit'         => $request->unit[$i],
						'quantity'   => $request->quantity[$i],
						'purchaserate' => $request->purchaserate[$i],
						'purchaseamount' => $request->purchaserate[$i] * $request->quantity[$i],
						'rate'     => $request->rate[$i],
						'amount' => $request->amount[$i],
						'vatamount' => $request->vatamount[$i],
						'vat_percentage' => $request->vat_percentage[$i],
						'discount' => $request->rdiscount[$i],
						'totalamount' => $request->row_total[$i],
						'branch' => $branch
					];
					DB::table('qsell_saleinvoice_products')->insert($invoice_product_data);

					/*Decrement from saleorder products*/
					DB::table('qsell_saleorder_products')->where('id', $request->so_item_id[$i])->decrement('invoice_remaining', $request->quantity[$i]);
					/*Decrement from saleorder products*/
				}


				/*Generate Zakat QR code*/
				if (file_exists(storage_path('app/public/QRinvoice/' . str_slug($invid) . '.svg'))) {
					unlink(storage_path('app/public/QRinvoice/' . str_slug($invid) . '.svg'));
				} else {
				}
				$company_name = '';
				$company_vat = '';
				$company_details = DB::table('qsettings_company')->select('*')->first();
				$company_name = $company_details->company_name;
				$company_vat = $company_details->company_vat;
				$quotedate = Carbon::parse($request->quotedate)->format('Y-m-d  h:i');
				$grandtotalamount = $request->grandtotalamount;
				$totalvatamount = $request->totalvatamount;

				$qrtextof = 'Seller Name :-> ' . $company_name . ', Vat Number :-> ' . $company_vat . ', Datetime :-> ' . $quotedate . ', Vat Total :-> ' . $totalvatamount . ', Total  :->' . $grandtotalamount;
				$encoder = new Encoder();
				$qr_signature = $encoder->encode(
					$company_name,
					$company_vat,
					null,
					$grandtotalamount,
					$totalvatamount
				);
				$qrcode = QrCode::size(200)->format('svg')->generate($qr_signature, storage_path('app/public/QRinvoice/' . str_slug($invid) . '.svg'));
				/*Generate Zakat QR code*/

				/*Customer balance code*/
				DB::table('qsell_customer_payments')->where('doc_id', $invid)->where('payment_type', 'Invoice')->delete();
				if ($request->useadvance == 1) {
					$datapay = [
						'customer_id' => $request->customer,
						'payment_date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
						'payment_type' => 'Invoice',
						'doc_id' => $invid,
						'dr_amount' => $request->paidamount,
						'cr_amount' => 0

					];
					$payid = DB::table('qsell_customer_payments')->insertGetId($datapay);
				}
				/*Customer balance  code*/
				if ($request->status == 'Approved') {
					$this->insertInvoiceSOA($invid); //statement of account entry
					$this->salesInvoiceAccountingEnrty($invid); // Accounting Entry
				}
			});
			$out = array(
				'status' => 1,
				'msg' => 'Saved Success'
			);
			echo json_encode($out);
		} catch (\Throwable $e) {
			$out = array(
				'error' => $e,
				'status' => 0,
				'msg' => ' Error While Save'
			);
			echo json_encode($out);
		}
	}


	public function invoiceupdate_sell(Request $request)
	{
		try {
			DB::transaction(function () use ($request) {
				$soid = $request->soid;
				$invid = $request->id;
				$user_id = Auth::user()->id;
				$branch = Session::get('branch');
				/*Insert to Invoice Table*/
				$invoice_data = [
					'invoice_number' => $request->invoicenumber,
					// 'sale_type' => 'By Quote',
					// 'saleorder_id' => $request->soid,
					'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
					'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
					'qtn_ref' => $request->qtn_ref,
					'po_ref' => $request->po_ref,
					'delivery_period' => '',
					'attention' => $request->attention,
					'salesman' => $request->salesman,
					'currency' => $request->currency,
					'currencyvalue' => $request->currencyvalue,
					'preparedby' => $request->preparedby,
					'approvedby' => $request->approvedby,
					'customer' => $request->customer,
					'terms_conditions' => $request->terms_conditions,
					'notes' => $request->notes,
					'internal_reference' => $request->internal_reference,
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
					'useadvance' => $request->useadvance,
					'status' => $request->status,
				];

				DB::table('qsell_saleinvoice')->where('id', $invid)->update($invoice_data);

				$oldProducts = DB::table('qsell_saleinvoice_products')->select('*')->where('invoice_id', $invid)->get();

				foreach ($oldProducts as $key => $value) {
					DB::table('qsell_saleorder_products')->where('id', $value->so_item_id)->increment('invoice_remaining', $value->quantity);
				}

				DB::table('qsell_saleinvoice_products')->where('invoice_id', $invid)->delete();

				for ($i = 0; $i < count($request->item_id); $i++) {
					$invoice_product_data = [
						'invoice_id' => $invid,
						'item_id' => $request->item_id[$i],
						'so_item_id' => $request->so_item_id[$i],
						'description' => $request->description[$i],
						'unit'         => $request->unit[$i],
						'quantity'   => $request->quantity[$i],
						'purchaserate' => $request->purchaserate[$i],
						'purchaseamount' => $request->purchaserate[$i] * $request->quantity[$i],
						'rate'     => $request->rate[$i],
						'amount' => $request->amount[$i],
						'vatamount' => $request->vatamount[$i],
						'vat_percentage' => $request->vat_percentage[$i],
						'discount' => $request->rdiscount[$i],
						'totalamount' => $request->row_total[$i],
						'branch' => $branch
					];
					DB::table('qsell_saleinvoice_products')->insert($invoice_product_data);

					/*Decrement from saleorder products*/
					DB::table('qsell_saleorder_products')->where('id', $request->so_item_id[$i])->decrement('invoice_remaining', $request->quantity[$i]);
					/*Decrement from saleorder products*/
				}


				/*Generate Zakat QR code*/
				if (file_exists(storage_path('app/public/QRinvoice/' . str_slug($invid) . '.svg'))) {
					unlink(storage_path('app/public/QRinvoice/' . str_slug($invid) . '.svg'));
				} else {
				}
				$company_name = '';
				$company_vat = '';
				$company_details = DB::table('qsettings_company')->select('*')->first();
				$company_name = $company_details->company_name;
				$company_vat = $company_details->company_vat;
				$quotedate = Carbon::parse($request->quotedate)->format('Y-m-d  h:i');
				$grandtotalamount = $request->grandtotalamount;
				$totalvatamount = $request->totalvatamount;

				$qrtextof = 'Seller Name :-> ' . $company_name . ', Vat Number :-> ' . $company_vat . ', Datetime :-> ' . $quotedate . ', Vat Total :-> ' . $totalvatamount . ', Total  :->' . $grandtotalamount;
				$encoder = new Encoder();
				$qr_signature = $encoder->encode(
					$company_name,
					$company_vat,
					null,
					$grandtotalamount,
					$totalvatamount
				);
				$qrcode = QrCode::size(200)->format('svg')->generate($qr_signature, storage_path('app/public/QRinvoice/' . str_slug($invid) . '.svg'));
				/*Generate Zakat QR code*/

				/*Customer balance code*/
				DB::table('qsell_customer_payments')->where('doc_id', $invid)->where('payment_type', 'Invoice')->delete();
				if ($request->useadvance == 1) {
					$datapay = [
						'customer_id' => $request->customer,
						'payment_date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
						'payment_type' => 'Invoice',
						'doc_id' => $invid,
						'dr_amount' => $request->paidamount,
						'cr_amount' => 0

					];
					$payid = DB::table('qsell_customer_payments')->insertGetId($datapay);
				}
				/*Customer balance  code*/
				if ($request->status == 'Approved') {
					$this->insertInvoiceSOA($invid); //statement of account entry
					$this->salesInvoiceAccountingEnrty($invid); // Accounting Entry
				}
			});
			$out = array(
				'status' => 1,
				'msg' => 'Saved Success'
			);
			echo json_encode($out);
		} catch (\Throwable $e) {
			$out = array(
				'error' => $e,
				'status' => 0,
				'msg' => ' Error While Save'
			);
			echo json_encode($out);
		}
	}



	public function invoiceOrder_Delivery(Request $request)
	{
		$branch = Session::get('branch');

		$saleorder_id = $request->sid;
		$iid = $request->id;
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
		$saleorder   = DB::table('qsell_saleorder')->select('qsell_saleorder.*', DB::raw("DATE_FORMAT(qsell_saleorder.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_saleorder.id', $saleorder_id)->get();
		$saleorder_products = DB::table('qsell_saleorder_products')->leftjoin('qinventory_products', 'qsell_saleorder_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleorder_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleorder_products.saleorder_id', $saleorder_id)->get();
		$customers = DB::table('qsell_saleorder')->leftjoin('qcrm_customer_details', 'qsell_saleorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleorder.id', $saleorder_id)->get();
		return view('sell.salesorder.convert_delivery', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'saleorder', 'saleorder_products'));
	}


	public function invoice_accounting()
	{


		$saleorders = DB::table('qsell_saleinvoice')->select('*')->get();

		foreach ($saleorders as $key => $value) {
			$customer_id = $value->customer;
			$invoice_id = $value->id;
			$grandtotalamount = $value->grandtotalamount;
			$vatamount = $value->vatamount;
			$totalamount = $value->totalamount;

			$branch = $value->branch;

			/////////////////////////////////////////////
			//get customer ledger

			$customer_ledger = DB::table('qcrm_customer_details')->where('id', $customer_id)->select('account_ledger')->value('account_ledger');


			//get sales ledger
			$sales_evenue_account = 0;
			$sales_evenue_account = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('sales_evenue_account');

			//get vat ledger
			$output_vat_ledger = 0;
			$output_vat_ledger = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('output_vat_ledger');

			//get entry type

			$sales_inv_entry_type = 0;
			$sales_inv_entry_type = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('sales_inv_entry_type');

			//get number
			$number = $this->nextNumber($sales_inv_entry_type);

			//pass entry to accounting

			$data_accounts = [
				'entrytype_id'   => $sales_inv_entry_type,
				'number'         => $number,
				'date'           => date("Y-m-d"),
				'dr_total'       => abs($grandtotalamount),
				'cr_total'       => abs($grandtotalamount),


			];



			$main_entry = DB::table('a_branch1_entries')->insert($data_accounts);
			$main_entry_id = DB::getPdo()->lastInsertId();



			$data_accounts_items = [
				'entry_id'   => $main_entry_id,
				'ledger_id'  => $customer_ledger,
				'amount'     => abs($grandtotalamount),
				'dc'         => 'D',
				'narration'         => '-',
			];
			DB::table('a_branch1_entryitems')->insert($data_accounts_items);
			$data_accounts_items = [
				'entry_id'   => $main_entry_id,
				'ledger_id'  => $sales_evenue_account,
				'amount'     => abs($totalamount),
				'dc'         => 'C',
				'narration'         => '-',
			];




			DB::table('a_branch1_entryitems')->insert($data_accounts_items);


			$data_accounts_items = [
				'entry_id'   => $main_entry_id,
				'ledger_id'  => $output_vat_ledger,
				'amount'     => abs($vatamount),
				'dc'         => 'C',
				'narration'         => '-',
			];




			DB::table('a_branch1_entryitems')->insert($data_accounts_items);


			//save entry id in sales table
			DB::table('qsell_saleinvoice')->where('id', $invoice_id)->update(['entry_id' => $main_entry_id]);
		}
	}


	public function voucher_accounting()
	{


		$saleorders = DB::table('buy_voucher')->select('*')->get();

		foreach ($saleorders as $key => $value) {
			$supplier_id = $value->cust_id;
			$id = $value->id;
			$grandtotalamount = $value->grandtotalamount;
			$totalvatamount = $value->totalvatamount;
			$totalamount = $value->totalamount;

			$branch = $value->branch;


			/////////////////////////////////////////////

			$oentry_id = DB::table('buy_voucher')->where('id', $id)->value('entry_id');

			//get supplier ledger

			$supplier_ledger = DB::table('qcrm_supplier')->where('id', $supplier_id)->select('main_ledger')->value('main_ledger');


			//get sales ledger
			$purchase_account = 0;
			$purchase_account = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('purchase_account');

			//get vat ledger
			$input_vat_ledger = 0;
			$input_vat_ledger = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('input_vat_ledger');

			//get entry type

			$purchase_invoice_entry_type = 0;
			$purchase_invoice_entry_type = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('purchase_invoice_entry_type');

			//get number
			$number = $this->nextNumber($purchase_invoice_entry_type);

			//pass entry to accounting
			if ($supplier_ledger > 0) {
				$data_accounts = [
					'entrytype_id'   => $purchase_invoice_entry_type,
					'number'         => $number,
					'date'           => date("Y-m-d"),
					'dr_total'       => abs($value->grandtotalamount),
					'cr_total'       => abs($value->grandtotalamount),


				];



				/* $main_entry = DB::table('a_branch1_entries')->insert($data_accounts);
$main_entry_id =DB::getPdo()->lastInsertId();*/
				//  DB::table('a_branch1_entries')->where('id', $oentry_id)->update($data_accounts);

				$main_entry = DB::table('a_branch1_entries')->insert($data_accounts);
				//DB::table('a_branch1_entryitems')->where('entry_id', $main_entry)->delete();



				//$main_entry_id =$oentry_id;
				$main_entry_id = DB::getPdo()->lastInsertId();

				$data_accounts_items = [
					'entry_id'   => $main_entry_id,
					'ledger_id'  => $supplier_ledger,
					'amount'     => abs($grandtotalamount),
					'dc'         => 'D',
					'narration'         => '-',
				];
				DB::table('a_branch1_entryitems')->insert($data_accounts_items);
				$data_accounts_items = [
					'entry_id'   => $main_entry_id,
					'ledger_id'  => $purchase_account,
					'amount'     => abs($totalamount),
					'dc'         => 'C',
					'narration'         => '-',
				];




				DB::table('a_branch1_entryitems')->insert($data_accounts_items);


				$data_accounts_items = [
					'entry_id'   => $main_entry_id,
					'ledger_id'  => $input_vat_ledger,
					'amount'     => abs($totalvatamount),
					'dc'         => 'C',
					'narration'         => '-',
				];




				DB::table('a_branch1_entryitems')->insert($data_accounts_items);


				//save entry id in sales table
				DB::table('buy_voucher')->where('id', $id)->update(['entry_id' => $main_entry_id]);
			}

			/////////////////////////////////////////////////////////////////////////////////////////////
		}
	}
}

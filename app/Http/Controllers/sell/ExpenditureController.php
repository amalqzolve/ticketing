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
use App\Expenditure;

class ExpenditureController extends Controller
{
	public function sell_invoice_list(Request $request, $id)
	{
		$branch = Session::get('branch');
		if ($request->ajax()) {

			$data = Expenditure::select('expenditures.id', 'expenditures.sales_order_id', 'expenditures.quotedate', 'qcrm_supplier.sup_name', 'qcrm_supplier.mobile1',  'expenditures.totalamount', 'expenditures.discount', 'expenditures.vatamount', 'expenditures.grandtotalamount')
				->leftjoin('qcrm_supplier', 'expenditures.sup_id', '=', 'qcrm_supplier.id')
				->where('expenditures.sales_order_id', '=', $id)
				->get();

			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action']);
			return  $dtTble->make(true);
		}
		$sales_invoice_id = $id;
		return view('sell.expenditure.list', compact('sales_invoice_id'));
	}

	public function allList(Request $request)
	{
		$branch = Session::get('branch');
		if ($request->ajax()) {

			$data = Expenditure::select('expenditures.id', 'expenditures.sales_order_id', 'expenditures.quotedate', 'qcrm_supplier.sup_name', 'qcrm_supplier.mobile1',  'expenditures.totalamount', 'expenditures.discount', 'expenditures.vatamount', 'expenditures.grandtotalamount')
				->leftjoin('qcrm_supplier', 'expenditures.sup_id', '=', 'qcrm_supplier.id')
				->where('expenditures.branch', '=', $branch)
				->get();

			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action']);
			return  $dtTble->make(true);
		} else
			return view('sell.expenditure.list_all');
	}


	public function Add_Invoice_Sell(Request $request, $id)
	{
		$branch = Session::get('branch');
		$productlist = DB::table('qinventory_products')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();
		$catogry =  DB::table('qcrm_suppliercatogry')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
		$type = DB::table('qcrm_supplier_type')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
		$group = DB::table('qcrm_suppliergroup')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();

		$countryquery = DB::table('countries')->select('id', 'cntry_name');
		$country = $countryquery->get();


		$default_grp   = DB::table('qcrm_customer_groupdetails')->select('id')->where('default_grp', 1)->get();
		$typedefault   = DB::table('qcrm_customer_typedetails')->select('id')->where('typedefault', 1)->get();
		$catdefault   = DB::table('qcrm_customer_categorydetails')->select('id')->where('catdefault', 1)->get();
		$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name')->where('branch', $branch)->get();
		$sales_order_id = $id;
		return view('sell.expenditure.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist',  'salesmen', 'catogry', 'type', 'group', 'country',   'default_grp', 'typedefault', 'catdefault', 'sales_order_id', 'suppliers'));
	}

	public function editInvoice(Request $request, $id)
	{
		$expenditure = Expenditure::select('*')->where('id', $id)->first();
		if (isset($expenditure->id)) {
			$expenditureProduct = DB::table('expenditure_products')->select('expenditure_products.*', 'qinventory_products.product_name')->where('expenditure_id', $id)->leftjoin('qinventory_products', 'expenditure_products.item_id', '=', 'qinventory_products.product_id')->get();
			$branch = Session::get('branch');
			$productlist = DB::table('qinventory_products')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
			$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
			$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
			$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
			$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
			$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();
			$catogry =  DB::table('qcrm_suppliercatogry')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
			$type = DB::table('qcrm_supplier_type')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
			$group = DB::table('qcrm_suppliergroup')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();

			$countryquery = DB::table('countries')->select('id', 'cntry_name');
			$country = $countryquery->get();


			$default_grp   = DB::table('qcrm_customer_groupdetails')->select('id')->where('default_grp', 1)->get();
			$typedefault   = DB::table('qcrm_customer_typedetails')->select('id')->where('typedefault', 1)->get();
			$catdefault   = DB::table('qcrm_customer_categorydetails')->select('id')->where('catdefault', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name')->where('branch', $branch)->get();
			$sales_order_id = $expenditure->sales_order_id;

			return view('sell.expenditure.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist',  'salesmen', 'catogry', 'type', 'group', 'country',   'default_grp', 'typedefault', 'catdefault', 'sales_order_id', 'suppliers', 'expenditure', 'expenditureProduct'));
		} else
			return "not fount Expenditure";
	}

	public function invoicesubmit_sell(Request $request)
	{

		DB::transaction(function () use ($request) {
			$user_id = Auth::user()->id;
			$branch = Session::get('branch');

			// /Check IF new customer/
			if ($request->customer_type == 1) {
				$supplier_data = [
					'sup_code' => $request->cust_code,
					'sup_type' => $request->cust_type,
					'sup_category' => $request->cust_category,
					'sup_name' => $request->cust_name,
					'sup_add1' => $request->cust_add1,
					'sup_add2' => $request->cust_region,
					'sup_region' => $request->cust_district,
					'sup_city' => $request->cust_city,
					'sup_zip' => $request->cust_zip,
					'mobile1' => $request->mobile,
					'vatno' => $request->vatno,
					'buyerid_crno' => $request->buyerid_crno,
					'branch' => $branch
				];
				DB::table('qcrm_supplier')->insert($supplier_data);
				$sup_id = DB::getPdo()->lastInsertId();
			} else
				$sup_id = $request->customer;


			/*Insert to Invoice Table*/
			$cname = DB::table('qcrm_supplier')->where('id', $sup_id)->value('sup_name');
			$sname = DB::table('qcrm_salesman_details')->where('id', $request->salesman)->value('name');
			$invoice_data = [
				'sales_order_id' => $request->sales_order_id,
				'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
				'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
				'qtn_ref' => $request->qtn_ref,
				'po_ref' => $request->po_ref,
				'attention' => $request->attention,
				'salesman' => $request->salesman,
				'currency' => $request->currency,
				'currencyvalue' => $request->currencyvalue,
				'preparedby' => $request->preparedby,
				'approvedby' => $request->approvedby,
				'sup_id' => $sup_id,
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
				// 'paid_amount' => $request->paidamount,
				// 'balance_amount' => $request->balanceamount,
				// 'useadvance' => $request->useadvance,
				'status' => 'Draft',
				'sup_name' => $cname,
				'salesman_name' => $sname,
			];


			// DB::table('qsell_saleinvoice')->insert($invoice_data);
			// $invoice_id = DB::getPdo()->lastInsertId();


			///
			// if (empty($request->invoicenumber)) {
			// 	DB::table('qsell_saleinvoice')->where('id', $invoice_id)->update(['invoice_number' => $invoice_id]);
			// }



			$expenditure = Expenditure::updateOrCreate(['id' => $request->id], $invoice_data);

			$expenditureId = $expenditure->id;

			DB::table('expenditure_products')->where('expenditure_id', $expenditureId)->delete();
			////
			for ($i = 0; $i < count($request->item_id); $i++) {
				$expenditure_product_data = [
					'expenditure_id' => $expenditureId,
					'sales_order_id' => $request->sales_order_id,
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
				DB::table('expenditure_products')->insert($expenditure_product_data);

				/*Minus Stock*/
				// $check_stock = ProductdetailslistModel::where('product_id', $request->item_id[$i])->first()->available_stock;

				// if ($check_stock > 0 && $check_stock >=  $request->quantity[$i]) {
				// 	$stock = ProductdetailslistModel::where('product_id',  $request->item_id[$i])->decrement('available_stock', $request->quantity[$i]);
				// } else {
				// 	/* watchOut('warning', 'Opps', 'Stock shortage');
				//         return back();*/
				// }
				/*Minus Stock*/
			}
		});
	}





	public function Pdf(Request $request, $id)
	{
		$expenditure   = Expenditure::select('expenditures.*', 'qcrm_supplier.sup_name', 'qcrm_supplier.sup_add1', 'qcrm_supplier.sup_add2', 'qcrm_supplier.sup_region', 'qcrm_supplier.sup_region_ar', 'qcrm_supplier.sup_zip', 'qcrm_supplier.sup_zip_ar', 'qcrm_supplier.vatno_ar', 'qcrm_supplier.buyerid_crno_ar', 'qcrm_supplier.vatno', 'qcrm_supplier.buyerid_crno', 'qcrm_supplier.sup_name_ar', 'qcrm_supplier.sup_add1_ar', 'qcrm_supplier.sup_add2_ar')
			->leftjoin('qcrm_supplier', 'expenditures.sup_id', '=', 'qcrm_supplier.id')
			->where('expenditures.id', $id)->first();

		$expenditureProduct = DB::table('expenditure_products')
			->select('expenditure_products.*', 'qinventory_products.product_name', 'qinventory_product_unit.unit_name')
			->leftjoin('qinventory_products', 'expenditure_products.item_id', '=', 'qinventory_products.product_id')
			->leftjoin('qinventory_product_unit', 'expenditure_products.unit', '=', 'qinventory_product_unit.id')
			->where('expenditure_products.expenditure_id', $id)
			->get();

		$gm_amount = ($expenditure->grandtotalamount != '') ? $expenditure->grandtotalamount : 0;
		$words = $this->numberToWord($gm_amount);
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->first();

		$configuration = [];
		$exp_id = 'Expenditure-#' . $id;
		$pdf = PDF::loadView('sell.expenditure.preview1', compact('branchsettings',   'expenditure', 'expenditureProduct', 'words'), $configuration,  [
			'title'      => $exp_id,
			'margin_top' => 0
		]);

		return $pdf->stream($exp_id . '.pdf');
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
		$id = $request->id;

		//	DB::table('qsell_saleinvoice')->where('id', $id)->update(['del_flag' =>0]);

		DB::table('qsell_saleinvoice')->where('id', $id)->delete();


		$maxValue = DB::table('qsell_saleinvoice')->orderBy('id', 'desc')->value('id');
		$autono = $maxValue + 1;

		DB::statement("ALTER TABLE qsell_saleinvoice AUTO_INCREMENT = $autono;");





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

		$soid = $request->soid;
		$invid = $request->id;
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');


		/*Insert to SaleOrder Table*/
		$sale_order_data = [
			'sale_type' => 'By Quote',
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
			'customer' => $request->customer,
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

		];
		DB::table('qsell_saleorder')->where('id', $soid)->update($sale_order_data);

		for ($i = 0; $i < count($request->item_id); $i++) {
			$iq = 0;
			$ir = 0;
			$iq = $request->originalquantity[$i] + $request->invoiced[$i];
			$ir = $iq - $request->quantity[$i];

			$sale_order_product_data = [
				'saleorder_id' => $soid,
				'item_id' => $request->item_id[$i],
				'description' => $request->description[$i],
				'unit'         => $request->unit[$i],
				// 'quantity'   => $request->quantity[$i],
				// 'delivery_remaining'   => $request->quantity[$i],
				'invoice_remaining'   => $ir,
				'rate'     => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vatamount' => $request->vatamount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'discount' => $request->rdiscount[$i],
				'totalamount' => $request->row_total[$i],
				'branch' => $branch
			];
			DB::table('qsell_saleorder_products')->where('saleorder_id', $soid)->where('item_id', $request->item_id[$i])->update($sale_order_product_data);
		}
		/*Insert to Saleorder Table*/
		/*Insert to Invoice Table*/
		$invoice_data = [
			'invoice_number' => $request->invoicenumber,
			'sale_type' => 'By Quote',
			'saleorder_id' => $soid,
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
		];

		DB::table('qsell_saleinvoice')->where('id', $invid)->update($invoice_data);


		/* Increment old stock-Start*/
		$old_stock = DB::table('qsell_saleinvoice_products')->select('qsell_saleinvoice_products.*')->where('invoice_id', $invid)->get();
		foreach ($old_stock as $key => $value) {
			$stock = ProductdetailslistModel::where('product_id',  $value->item_id)->increment('available_stock', $value->quantity);
		}
		/* Increment old stock-End*/


		DB::table('qsell_saleinvoice_products')->where('invoice_id', $invid)->delete();


		for ($i = 0; $i < count($request->item_id); $i++) {
			$invoice_product_data = [
				'invoice_id' => $invid,
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

			/*Decrement from saleorder products*/

			DB::table('qsell_saleorder_products')->where('id', $request->product_row_id[$i])->decrement('invoice_remaining', $request->quantity[$i]);

			/*Decrement from saleorder products*/



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

		return 'Success';
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
}

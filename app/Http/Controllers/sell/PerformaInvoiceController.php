<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
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


class PerformaInvoiceController extends Controller
{
	use AccountingActionsTrait, SellTrails;
	public function list(Request $request)
	{
		$branch = Session::get('branch');
		$user = Auth::user();
		if (!$request->ajax()) {
			$performainvoice = array();
			return view('sell.performainvoice.list', compact('performainvoice'));
		} else {
			$performainvoice = DB::table('qsell_performainvoice')
				->select('qsell_performainvoice.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', 'qcrm_salesman_details.name as salesman_name', DB::raw("DATE_FORMAT(qsell_performainvoice.valid_till, '%d-%m-%Y') as validity"), 'qsell_performainvoice.id as so_id', DB::raw("DATE_FORMAT(qsell_performainvoice.quotedate, '%d-%m-%Y') as quotedate"))
				->leftjoin('qcrm_customer_details', 'qsell_performainvoice.customer', '=', 'qcrm_customer_details.id')
				->leftjoin('qcrm_salesman_details', 'qsell_performainvoice.salesman', '=', 'qcrm_salesman_details.id')
				->where('qsell_performainvoice.branch', $branch)
				->where('qsell_performainvoice.del_flag', 1)
				->groupBy('qsell_performainvoice.id')
				->get();
			$dtTble = Datatables::of($performainvoice)->addIndexColumn()
				->addColumn('action', function ($row) use ($user) {
					$j = '';
					$hasPermission = $user->can('Performa Invoice PDF');
					if ($hasPermission) {
						$j .= '<a href="performainvoicepdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                                                    </span>
                                                </li>
                                            </a>';
					}


					if ($row->status == 1) {
						$hasPermission = $user->can('Performa Invoice Edit');
						if ($hasPermission) {
							$j .= '<a href="performainvoice_edit?id=' . $row->id . '&&soid=' . $row->saleorder_id . '&&type=' . $row->performa_type . '" data-type="edit" data-target="#kt_form">
							<li class="kt-nav__item">
								<span class="kt-nav__link">
									<i class="kt-nav__link-icon flaticon2-reload-1"></i>
									<span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
								</span>
							</li>
						</a>';
						}

						$hasPermission = $user->can('Performa Invoice Convert to Invoice');
						if ($hasPermission) {
							$j .= ' <a href="performaconvertinvoice_edit?id=' . $row->id . '&&soid=' . $row->saleorder_id . '&&type=' . $row->performa_type . '" data-type="edit" data-target="#kt_form">
					<li class="kt-nav__item">
						<span class="kt-nav__link">
							<i class="kt-nav__link-icon flaticon2-reload-1"></i>
							<span class="kt-nav__link-text" data-id="' . $row->id . '">Convert to Invoice</span>
						</span>
					</li>
				</a>';
						}
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
				})->addColumn('status', function ($row) use ($user) {
					if ($row->status == 2)
						return '<span style="color:green;">Invoiced</span>';
					if ($row->status == 1)
						return '<span style="color:gray;">Not Invoiced</span>';
				})
				->rawColumns(['action', 'status']);
			return  $dtTble->make(true);
		}
	}
	public function add()
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

		return view('sell.performainvoice.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'default_grp', 'typedefault', 'catdefault'));
	}
	public function performainvoicesubmit_sell(Request $request)
	{


		$user_id = Auth::user()->id;
		$branch = Session::get('branch');

		/*Insert to SaleOrder Table*/

		// /Check IF new customer/
		if ($request->customer_type == 1) {
			$accounting_settings = Session::get('branch_settings');
			$customer_data = [
				'cust_code' => $request->cust_code,
				'cust_type' => $request->cust_type,
				'cust_category' => $request->cust_category,
				'cust_group' => $request->cust_group,
				'cust_name' => $request->cust_name,
				'cust_add1' => $request->building_no,
				'cust_add2' => $request->cust_region,
				'cust_country' => $request->cust_country,
				'cust_region' => $request->cust_district,
				'cust_city' => $request->cust_city,
				'cust_zip' => $request->cust_zip,
				'mobile1' => $request->mobile,
				'branch' => $branch,
				'cust_district' => $request->cust_district,
				'building_no' => $request->building_no,
				'email1' => $request->email,
				'vatno' => $request->vatno,
				'buyerid_crno' => $request->buyerid_crno,
				'account_ledger' => $accounting_settings->default_customer_ledger
			];

			DB::table('qcrm_customer_details')->insert($customer_data);
			$customer_id = DB::getPdo()->lastInsertId();
		} else {
			$customer_id = $request->customer;
		}


		/*Insert to SaleOrder Table*/
		$quote_data = [
			'sale_type' => 'By Direct',
			// 'quote_id' => $request->quote_id,
			'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
			'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
			'qtn_ref' => $request->qtn_ref,
			'po_ref' => $request->po_ref,
			'delivery_period' => '', //$request->delivery_period,
			'attention' => $request->attention,
			'salesman' => $request->salesman,
			'currency' => $request->currency,
			'currencyvalue' => $request->currencyvalue,
			'preparedby' => $request->preparedby,
			'approvedby' => $user_id,
			'discount_type' => $request->discount_type,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'internal_reference' => $request->internal_reference,
			'tpreview' => $request->tpreview,
			'documents' => '', //$request->document,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
			'podate' => Carbon::parse($request->podate)->format('Y-m-d'),
			'status' => 'Confirm',
		];

		$saleorder_id = DB::table('qsell_saleorder')->insertGetId($quote_data);
		/*Insert to SaleOrder Table*/

		/*Insert to performa Invoice Table*/
		$invoice_data = [
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
			'internal_reference' => $request->internalreference,
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
			'status' => 1,
			'performa_type' => 'Direct'
		];
		$performaInvoice_id = DB::table('qsell_performainvoice')->insertGetId($invoice_data);
		for ($i = 0; $i < count($request->item_id); $i++) {
			$so_item_id =	DB::table('qsell_saleorder_products')->insertGetId(array(
				'saleorder_id' => $saleorder_id,
				'item_id' => $request->item_id[$i],
				'description' => $request->description[$i],
				'unit'         => $request->unit[$i],
				'quantity'   => $request->quantity[$i],
				'invoice_remaining'   => $request->quantity[$i],
				'rate'     => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vatamount' => $request->vatamount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'discount' => $request->rdiscount[$i],
				'totalamount' => $request->row_total[$i],
			));
			$invoice_product_data = [
				'invoice_id' => $performaInvoice_id,
				'item_id' => $request->item_id[$i],
				'so_item_id' => $so_item_id,
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
			DB::table('qsell_performainvoice_products')->insert($invoice_product_data);
		}
		return 'Success';
	}
	public function edit(Request $request)
	{
		$id = $request->id;
		$soid = $request->soid;
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
		$performainvoice   = DB::table('qsell_performainvoice')->select('qsell_performainvoice.*', DB::raw("DATE_FORMAT(qsell_performainvoice.quotedate, '%d-%m-%Y') as quotedate"))->where('del_flag', 1)->where('id', $id)->get();
		$performainvoiceproducts = DB::table('qsell_performainvoice_products')->leftjoin('qinventory_products', 'qsell_performainvoice_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qsell_performainvoice', 'qsell_performainvoice_products.invoice_id', '=', 'qsell_performainvoice.id')->select('qsell_performainvoice_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', 'qsell_performainvoice.saleorder_id', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_performainvoice_products.invoice_id', $id)->get();
		$customers = DB::table('qsell_performainvoice')->leftjoin('qcrm_customer_details', 'qsell_performainvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_performainvoice.id', $id)->get();
		foreach ($performainvoiceproducts as $performainvoiceproductss) {
			$soid = $performainvoiceproductss->saleorder_id;
			$performainvoiceproductss->invoice_rem = DB::table('qsell_saleorder_products')->where('del_flag', 1)->where('saleorder_id', $soid)->value('invoice_remaining');
		}
		$quotation   = DB::table('qsell_saleorder')->select('qsell_quotation.notes', 'qsell_quotation.internal_reference', 'qsell_quotation.preparedby', 'qsell_saleorder.notes as sonotes', 'qsell_saleorder.internal_reference as sointernal_reference', 'qsell_saleorder.preparedby as sopreparedby', 'qsell_saleorder.quote_id', 'qsell_saleorder.id', 'qsell_saleorder.quotedate as qdate', 'qsell_quotation.quotedate as sodate')->leftjoin('qsell_quotation', 'qsell_saleorder.quote_id', '=', 'qsell_quotation.id')->where('qsell_saleorder.id', $soid)->get();
		if ($request->type == 'By SalesOrder') {
			return view('sell.performainvoice.edit_by_so', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'performainvoice', 'performainvoiceproducts', 'quotation'));
		} else {
			return view('sell.performainvoice.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'performainvoice', 'performainvoiceproducts'));
		}
	}

	public function update(Request $request)
	{
		DB::transaction(function () use ($request) {
			$user_id = Auth::user()->id;
			$branch = Session::get('branch');
			$id = $request->id;
			$invoice_data = [
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
				'internal_reference' => $request->internalreference,
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
			];


			DB::table('qsell_performainvoice')->where('id', $id)->update($invoice_data);
			DB::table('qsell_performainvoice_products')->where('invoice_id', $id)->delete();
			// $invoice_id = DB::getPdo()->lastInsertId();

			for ($i = 0; $i < count($request->item_id); $i++) {
				if ($request->so_item_id[$i] != '')
					$so_item_id = $request->so_item_id[$i];
				else {
					$soProduct = [
						'saleorder_id' => $request->saleorder_id,
						'item_id' => $request->item_id[$i],
						'description' => $request->description[$i],
						'unit'         => $request->unit[$i],
						'quantity'   => $request->quantity[$i],
						'invoice_remaining'   => $request->quantity[$i],
						'rate'     => $request->rate[$i],
						'amount' => $request->amount[$i],
						'vatamount' => $request->vatamount[$i],
						'vat_percentage' => $request->vat_percentage[$i],
						'discount' => $request->rdiscount[$i],
						'totalamount' => $request->row_total[$i],
						'branch' => $branch
					];
					$so_item_id = DB::table('qsell_saleorder_products')->insertGetId($soProduct);
				}
				$invoice_product_data = [
					'invoice_id' => $id,
					'item_id' => $request->item_id[$i],
					'so_item_id' => $so_item_id,
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
				DB::table('qsell_performainvoice_products')->insert($invoice_product_data);
			}
		});

		return 'Success';
	}

	public function convertinvoice(Request $request)
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
		$performainvoice   = DB::table('qsell_performainvoice')->select('*', DB::raw("DATE_FORMAT(qsell_performainvoice.quotedate, '%d-%m-%Y') as quotedate"))->where('del_flag', 1)->where('id', $id)->get();
		$performainvoiceproducts = DB::table('qsell_performainvoice_products')->leftjoin('qinventory_products', 'qsell_performainvoice_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qsell_performainvoice', 'qsell_performainvoice_products.invoice_id', '=', 'qsell_performainvoice.id')->select('qsell_performainvoice_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', 'qsell_performainvoice.saleorder_id', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_performainvoice_products.invoice_id', $id)->get();
		$customers = DB::table('qsell_performainvoice')->leftjoin('qcrm_customer_details', 'qsell_performainvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_performainvoice.id', $id)->get();
		foreach ($performainvoiceproducts as $performainvoiceproductss) {
			$soid = $performainvoiceproductss->saleorder_id;
			$performainvoiceproductss->invoice_rem = DB::table('qsell_saleorder_products')->where('del_flag', 1)->where('saleorder_id', $soid)->value('invoice_remaining');
		}
		$cusId = $customers[0]->id;

		$adwance = DB::table('qsell_customer_payments')
			->select(DB::raw('SUM(qsell_customer_payments.dr_amount) as dr_amount'), DB::raw('SUM(qsell_customer_payments.cr_amount) as cr_amount'))
			->where('qsell_customer_payments.customer_id', $cusId)
			->groupBy('qsell_customer_payments.customer_id')
			->first();
		$adwanceAmount = (isset($adwance->cr_amount) ? $adwance->cr_amount : 0) - (isset($adwance->dr_amount) ? $adwance->dr_amount : 0);

		$this->connectToAccounting();
		$depositLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more


		if ($request->type == 'By SalesOrder') {
			return view('sell.performainvoice.convertinvoice_by_so', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'performainvoice', 'performainvoiceproducts', 'adwanceAmount', 'depositLedjer'));
		}


		return view('sell.performainvoice.convertinvoice', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'performainvoice', 'performainvoiceproducts', 'adwanceAmount', 'depositLedjer'));
	}

	public function convertinvoice_submit(Request $request)
	{
		DB::transaction(function () use ($request) {
			$user_id = Auth::user()->id;
			$branch = Session::get('branch');
			$id = $request->id;
			$cname = DB::table('qcrm_customer_details')->where('id', $request->customer)->value('cust_name');
			$sname = DB::table('qcrm_salesman_details')->where('id', $request->salesman)->value('name');
			$invoice_data = [
				'sale_type' => 'Performa',
				'saleorder_id' => $request->saleorder_id,
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

				'mark_payments' => $request->mark_payments,
				'use_advance' => $request->use_advance,
				'advance_amt' => $request->advance_amt,
				'paid_amount' => $request->paidamount,
				'balance_amount' => $request->balanceamount,

				'status' => 'Draft',

				// 'useadvance' => $request->useadvance,
				// 'cust_name' => $cname,
				// 'salesman_name' => $sname,
			];
			DB::table('qsell_saleinvoice')->insert($invoice_data);
			$invoice_id = DB::getPdo()->lastInsertId();
			if (empty($request->invoicenumber)) {
				DB::table('qsell_saleinvoice')->where('id', $invoice_id)->update(['invoice_number' => $invoice_id]);
			}
			for ($i = 0; $i < count($request->item_id); $i++) {
				$invoice_product_data = [
					'invoice_id' => $invoice_id,
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
				DB::table('qsell_performainvoice')->where('id', $id)->update(['status' => 2]);
				//
				DB::table('qsell_saleorder_products')->where('id', $request->so_item_id[$i])->decrement('invoice_remaining', $request->quantity[$i]);
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
					'customer_id' => $request->customer,
					'payment_date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
					'payment_type' => 'Invoice',
					'doc_id' => $invoice_id,
					'dr_amount' => $request->paidamount,
					'cr_amount' => 0
				];
				$payid = DB::table('qsell_customer_payments')->insertGetId($paydata);
			}
			/*Customer Balance*/

			/* Mark Payment at the time of invoice*/
			if ($request->mark_payments == 1) {
				$paymentsArray = array();
				$allPaymentsArray = array();
				$totalPayid = 0;
				if ($request->paidamount != $request->advance_amt) {
					foreach ($request->type as $key => $value) {
						if ($request->pay_amount[$key] != 0) {
							$totalPayid += $request->pay_amount[$key];
							array_push($paymentsArray, array(
								'qsell_saleinvoice_id' => $invoice_id,
								'type' => $request->type[$key],
								'depositaccount' => $request->depositaccount[$key],
								'reference' => $request->reference[$key],
								'pay_amount' => $request->pay_amount[$key],
							)); //for payments
							array_push($allPaymentsArray, array(
								'qsell_saleinvoice_id' => $invoice_id,
								'qsell_billsettlement_id' => null,
								'source' => 'invoice',
								'date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
								'type' => $request->type[$key],
								'depositaccount' => $request->depositaccount[$key],
								'pay_amount' => $request->pay_amount[$key],
								'balance_amount' => $request->grandtotalamount - $totalPayid,
							)); //for all payments
						}
					}
					DB::table('qsell_saleinvoice_payments')->insert($paymentsArray);
				}
				if (($request->advance_amt != 0) && ($request->advance_amt != '')) {
					$totalPayid += $request->advance_amt;
					array_push($allPaymentsArray, array(
						'qsell_saleinvoice_id' => $invoice_id,
						'qsell_billsettlement_id' => null,
						'source' => 'invoice',
						'date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
						'type' => 'advance',
						'depositaccount' => null,
						'pay_amount' => $request->advance_amt,
						'balance_amount' => $request->grandtotalamount - $totalPayid,
					)); //for all payments
				}
				DB::table('qsell_saleinvoice_all_payments')->insert($allPaymentsArray);
			}
			/* ./ Mark Payment at the time of invoice*/


			if ($request->status == 'Approved') {
				$this->insertInvoiceSOA($invoice_id); //statement of account entry
				$this->salesInvoiceAccountingEnrty($invoice_id); // Accounting Entry
			}
		});

		return 'Success';
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
		$performainvoice   = DB::table('qsell_performainvoice')->select('*')->where('del_flag', 1)->where('id', $id)->get();
		$performainvoiceproducts = DB::table('qsell_performainvoice_products')->leftjoin('qinventory_products', 'qsell_performainvoice_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_performainvoice_products.description as description1', 'qsell_performainvoice_products.*', 'qinventory_products.product_name', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_performainvoice_products.invoice_id', $id)->get();
		// dd($performainvoiceproducts);
		$customers = DB::table('qsell_performainvoice')->leftjoin('qcrm_customer_details', 'qsell_performainvoice.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_performainvoice.id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();
		foreach ($performainvoiceproducts as $key => $value) {
			$itemname = $value->item_id;
		}
		$itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
		$customfields = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $customfields->pluck('labels')->toArray();
		$gm_amount = 0;
		foreach ($performainvoice as $key => $value) {
			$gm_amount = $value->grandtotalamount;
		}

		$words = $this->numberToWord($gm_amount);
		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('sell.performainvoice.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'performainvoice', 'performainvoiceproducts', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('sell.performainvoice.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'performainvoice', 'performainvoiceproducts', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('sell.performainvoice.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'performainvoice', 'performainvoiceproducts', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview4') {
			$pdf = PDF::loadView('sell.performainvoice.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'performainvoice', 'performainvoiceproducts', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} else {
			$pdf = PDF::loadView('sell.performainvoice.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'performainvoice', 'performainvoiceproducts', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		}
		return $pdf->stream('Performa Invoice-#' . $id . '.pdf');
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
}

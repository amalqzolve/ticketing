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
use DataTables;
use App\Traits\AccountingActionsTrait;


class QuotationController extends Controller
{
	use AccountingActionsTrait;
	public function list(Request $request)
	{
		$branch = Session::get('branch');
		$user = Auth::user();
		if (!$request->ajax()) {
			$all_quotations = array();
			return view('sell.quotation.list', compact('all_quotations'));
		} else {
			$all_quotations = DB::table('qsell_quotation')
				->select('qsell_quotation.*', 'qcrm_salesman_details.name as salesman_name', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', DB::raw("DATE_FORMAT(qsell_quotation.valid_till, '%d-%m-%Y') as validity"), 'qsell_quotation.grandtotalamount', 'qsell_saleorder.id as so_id', DB::raw("DATE_FORMAT(qsell_quotation.quotedate, '%d-%m-%Y') as quotedate"))
				->leftjoin('qcrm_salesman_details', 'qsell_quotation.salesman', '=', 'qcrm_salesman_details.id')
				->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')
				->leftjoin('qsell_saleorder', 'qsell_quotation.id', '=', 'qsell_saleorder.quote_id')
				->where('qsell_quotation.branch', $branch)->where('qsell_quotation.del_flag', 1)
				->orderby('qsell_quotation.id', 'desc')->get();
			$dtTble = Datatables::of($all_quotations)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
				$j = '';


				$hasPermission = $user->can('Sales Quotation PDF');
				if ($hasPermission) {
					$j .= ' <a href="Quotation-Pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
					<li class="kt-nav__item">
						<span class="kt-nav__link">
							<i class="kt-nav__link-icon flaticon2-printer"></i>
							<span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
						</span>
					</li>
				</a>';
				}


				if ($row->status === 'Draft') {
					$hasPermission = $user->can('Sales Quotation Edit');
					if ($hasPermission) {
						$j .= '<a href="Quotation-Edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
												<li class="kt-nav__item">
													<span class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-reload-1"></i>
														<span class="kt-nav__link-text" data-id="">Edit</span>
													</span>
												</li>
											</a>';
					}
					$hasPermission = $user->can('Enquiry Approve');
					if ($hasPermission) {
						$j .= '<a data-type="approved" data-target="#kt_form">
						<li class="kt-nav__item quotation_approve" id="' . $row->id . '">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-check-mark"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id="' . $row->id . '">Convert to Sale Order</span>
							</span>
						</li>
					</a>';
					}

					$hasPermission = $user->can('Sales Quotation Delete');
					if ($hasPermission) {
						$j .= '<a data-type="delete" data-target="#kt_form">
						<li class="kt-nav__item quotation_delete" id="' . $row->id . '">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-trash"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id="' . $row->id . '">Delete</span>
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
				if ($row->status == 'Approved')
					return '<span style="color:green;">Converted</span>';
				if ($row->status == 'Draft')
					return '<span style="color:gray;">Convertion Pending</span>';
			})->rawColumns(['action', 'status']);
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
		$default_grp   = DB::table('qcrm_customer_groupdetails')->select('id')->where('default_grp', 1)->get();
		$typedefault   = DB::table('qcrm_customer_typedetails')->select('id')->where('typedefault', 1)->get();
		$catdefault   = DB::table('qcrm_customer_categorydetails')->select('id')->where('catdefault', 1)->get();

		return view('sell.quotation.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses', 'stores', 'default_grp', 'typedefault', 'catdefault'));
	}
	public function submit(Request $request)
	{
		DB::transaction(function () use ($request) {
			$user_id = Auth::user()->id;
			$branch = Session::get('branch');
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

			$quote_data = [
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
				'discount_type' => $request->discount_type,
				'customer_type' => $request->customer_type,
				'customer' => $customer_id,
				'terms_conditions' => $request->terms_conditions,
				'notes' => $request->notes,
				'internal_reference' => $request->internal_reference,
				'tpreview' => $request->tpreview,
				// 'documents'=>$request->documents,
				'totalamount' => $request->totalamount,
				'discount' => $request->discount,
				'amountafterdiscount' => $request->amountafterdiscount,
				'vatamount' => $request->totalvatamount,
				'grandtotalamount' => $request->grandtotalamount,
				'branch' => $branch,
				'status' => 'Draft',
				'user_id' => $user_id,
				'payment_terms' => $request->payment_terms,
			];


			DB::table('qsell_quotation')->insert($quote_data);
			$quote_id = DB::getPdo()->lastInsertId();

			for ($i = 0; $i < count($request->item_id); $i++) {
				$quote_product_data = [
					'quote_id' => $quote_id,
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
				DB::table('qsell_quotation_products')->insert($quote_product_data);
			}
		});

		return 'Success';
	}

	public function send(Request $request)
	{
		$id = $request->id;
		DB::table('qsell_quotation')->where('id', $id)->update(['status' => 'Send']);
		return redirect()->route('quotation_list')->with('message', 'State saved correctly!!!');
	}

	public function negotiation(Request $request)
	{
		$id = $request->id;
		DB::table('qsell_quotation')->where('id', $id)->update(['status' => 'Negotiated']);
		return redirect()->route('quotation_list')->with('message', 'State saved correctly!!!');
	}


	public function approve(Request $request)
	{
		$branch = Session::get('branch');
		$id = $request->id;
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
		$quotation   = DB::table('qsell_quotation')->select('*', DB::raw("DATE_FORMAT(qsell_quotation.valid_till, '%d-%m-%Y') as validity"), DB::raw("DATE_FORMAT(qsell_quotation.quotedate, '%d-%m-%Y') as quotedate"))->where('id', $id)->get();
		$quotation_products = DB::table('qsell_quotation_products')->leftjoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_quotation_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_products.quote_id', $id)->get();
		$customers = DB::table('qsell_quotation')->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation.id', $id)->get();

		return view('sell.quotation.approve', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'quotation', 'quotation_products'));
	}

	public function reject(Request $request)
	{
		$id = $request->id;
		DB::table('qsell_quotation')->where('id', $id)->update(['status' => 'Rejected']);
		return redirect()->route('quotation_list')->with('message', 'State saved correctly!!!');
	}

	public function revise(Request $request)
	{
		$branch = Session::get('branch');
		$id = $request->id;
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
		$quotation   = DB::table('qsell_quotation')->select('qsell_quotation.*', DB::raw("DATE_FORMAT(qsell_quotation.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_quotation.valid_till, '%d-%m-%Y') as valid_till"))->where('id', $id)->get();
		$quotation_products = DB::table('qsell_quotation_products')->leftjoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_quotation_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_products.quote_id', $id)->get();
		$customers = DB::table('qsell_quotation')->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation.id', $id)->get();

		return view('sell.quotation.revise', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'quotation', 'quotation_products'));
	}

	public function delete(Request $request)
	{
		$id = $request->id;
		DB::table('qsell_quotation')->where('id', $id)->update(['del_flag' => 0]);
		return redirect()->route('quotation_list')->with('message', 'State saved correctly!!!');
	}




	public function edit(Request $request)
	{
		$branch = Session::get('branch');
		$id = $request->id;
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
		$quotation   = DB::table('qsell_quotation')->select('qsell_quotation.*', DB::raw("DATE_FORMAT(qsell_quotation.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_quotation.valid_till, '%d-%m-%Y') as valid_till"))->where('id', $id)->get();
		$quotation_products = DB::table('qsell_quotation_products')->leftjoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_quotation_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_products.quote_id', $id)->get();
		$customers = DB::table('qsell_quotation')->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation.id', $id)->get();

		return view('sell.quotation.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'quotation', 'quotation_products'));
	}

	public function update(Request $request)
	{
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');
		$customer_id = $request->customer;
		$id = $request->id;

		$quote_data = [
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
			'discount_type' => $request->discount_type,
			'customer_type' => $request->customer_type,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'internal_reference' => $request->internal_reference,
			'tpreview' => $request->tpreview,
			// 'documents'=>$request->documents,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'status' => 'Draft',
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
		];
		DB::table('qsell_quotation')->where('id', $id)->update($quote_data);
		DB::table('qsell_quotation_products')->where('quote_id', $id)->delete();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$quote_product_data = [
				'quote_id' => $id,
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
			DB::table('qsell_quotation_products')->insert($quote_product_data);
		}

		return 'Success';
	}
	public function Quotation_Pdf(Request $request)
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
		$quotation   = DB::table('qsell_quotation')->select('*')->where('id', $id)->get();
		$quotation_products = DB::table('qsell_quotation_products')->leftjoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_quotation_products.*', 'qinventory_products.product_name', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_products.quote_id', $id)->get();
		$customers = DB::table('qsell_quotation')->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation.id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();


		foreach ($quotation_products as $key => $value) {
			$itemname = $value->item_id;
		}
		$itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
		$customfields = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $customfields->pluck('labels')->toArray();
		$gm_amount = 0;
		foreach ($quotation as $key => $value) {
			$gm_amount = $value->grandtotalamount;
		}

		$words = $this->numberToWord($gm_amount);


		$quote_status = DB::table('qsell_quotation')->select('status')->where('id', $id)->value('status');



		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('sell.quotation.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('sell.quotation.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('sell.quotation.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview4') {

			if ($quote_status == "Approved") {
				$pdf = PDF::loadView('sell.quotation.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
			} else if ($quote_status == "Verified") {
				$pdf = PDF::loadView('sell.quotation.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
			} else {
				$pdf = PDF::loadView('sell.quotation.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'words'), [], [
					'default_font'               => 'sans-serif',
					'watermark'                  => $quote_status,
					'show_watermark'             => true,
					'pdfa'                       => false,
					'pdfaauto'                   => false,
				]);
			}
		} else {
			$pdf = PDF::loadView('sell.quotation.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		}




		return $pdf->stream('Quotation-#' . $id . '.pdf');
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
	public function sellquotationrevise(Request $request)
	{
		$user_id = Auth::user()->id;
		$quote_id = $request->quote_id;
		$branch = Session::get('branch');
		/* Take backup -Start*/
		$old_quote = DB::table('qsell_quotation')->select('qsell_quotation.*')->where('id', $quote_id)->get();

		foreach ($old_quote as $key => $value) {

			$count = DB::table('qsell_quotation_revised')->where('quote_id', $quote_id)->count();
			$version = $quote_id . '-' . ($count + 1);
			$quote_data = [
				'version' => $version,
				'quote_id' => $quote_id,
				'quotedate' => $value->quotedate,
				'valid_till' => $value->valid_till,
				'qtn_ref' => $value->qtn_ref,
				'po_ref' => $value->po_ref,
				'delivery_period' => $value->delivery_period,
				'attention' => $value->attention,
				'salesman' => $value->salesman,
				'currency' => $value->currency,
				'currencyvalue' => $value->currencyvalue,
				'preparedby' => $value->preparedby,
				'approvedby' => $value->approvedby,
				'discount_type' => $value->discount_type,
				'customer_type' => $value->customer_type,
				'customer' => $value->customer,
				'terms_conditions' => $value->terms_conditions,
				'notes' => $value->notes,
				'tpreview' => $value->tpreview,
				'totalamount' => $value->totalamount,
				'discount' => $value->discount,
				'amountafterdiscount' => $value->amountafterdiscount,
				'vatamount' => $value->vatamount,
				'grandtotalamount' => $value->grandtotalamount,
				'branch' => $value->branch,
				'user_id' => $user_id,
				'payment_terms' => $value->payment_terms,
			];
		}
		DB::table('qsell_quotation_revised')->insert($quote_data);
		$revise_id = DB::getPdo()->lastInsertId();
		$old_quote_product = DB::table('qsell_quotation_products')->select('qsell_quotation_products.*')->where('quote_id', $quote_id)->get();


		foreach ($old_quote_product as $key => $value) {
			$old_data_product = [
				'revise_id' => $revise_id,
				'item_id' => $value->item_id,
				'description' => $value->description,
				'unit'         => $value->unit,
				'quantity'   => $value->quantity,
				'rate'     => $value->rate,
				'amount' => $value->amount,
				'vatamount' => $value->vatamount,
				'vat_percentage' => $value->vat_percentage,
				'discount' => $value->discount,
				'totalamount' => $value->totalamount,
				'branch' => $value->branch,



			];
			DB::table('qsell_quotation_revised_products')->insert($old_data_product);
		}


		/* Take backup -End*/


		$customer_id = $request->customer;
		$quote_id = $request->quote_id;

		$quote_data = [
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
			'discount_type' => $request->discount_type,
			'customer_type' => $request->customer_type,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'tpreview' => $request->tpreview,
			// 'documents'=>$request->documents,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'status' => 'Revised',
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
		];
		DB::table('qsell_quotation')->where('id', $quote_id)->update($quote_data);
		DB::table('qsell_quotation_products')->where('quote_id', $quote_id)->delete();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$quote_product_data = [
				'quote_id' => $quote_id,
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
			DB::table('qsell_quotation_products')->insert($quote_product_data);
		}

		return 'Success';
	}
	public function Quotation_Revised_Pdf(Request $request)
	{
		$brandlist = array();
		$manufacturerlist = array();
		$brname = array();
		$mrname = array();
		ini_set("pcre.backtrack_limit", "100000000000");
		$version = $request->version;
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
		$quotation   = DB::table('qsell_quotation_revised')->select('*')->where('version', $version)->get();
		foreach ($quotation as $quotations) {
			$revise_id = $quotations->id;
		}
		$quotation_products = DB::table('qsell_quotation_revised_products')->leftjoin('qinventory_products', 'qsell_quotation_revised_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_quotation_revised_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_revised_products.revise_id', $revise_id)->get();
		$customers = DB::table('qsell_quotation_revised')->leftjoin('qcrm_customer_details', 'qsell_quotation_revised.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation_revised.version', $version)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();


		foreach ($quotation_products as $key => $value) {
			$itemname = $value->item_id;
		}
		$itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
		$customfields = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $customfields->pluck('labels')->toArray();
		$gm_amount = 0;
		foreach ($quotation as $key => $value) {
			$gm_amount = $value->grandtotalamount;
		}

		$words = $this->numberToWord($gm_amount);


		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('sell.quotation.revisepreview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('sell.quotation.revisepreview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('sell.quotation.revisepreview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview4') {
			$pdf = PDF::loadView('sell.quotation.revisepreview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'words'));
		} else {
			$pdf = PDF::loadView('sell.quotation.revisepreview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'quotation', 'quotation_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		}
		return $pdf->stream('Quotation-#' . $version . '.pdf');
	}


	public function sellquotationapprove(Request $request)
	{
		$user_id = Auth::user()->id;
		$quote_id = $request->quote_id;
		$branch = Session::get('branch');
		$customer_id = $request->customer;
		$quote_id = $request->quote_id;
		DB::table('qsell_quotation')->where('id', $quote_id)->update(['status' => 'Approved']);
		$sale_order_data = [
			'sale_type' => 'By Quote',
			'quote_id' => $request->quote_id,
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
			'approvedby' => $user_id,
			'discount_type' => $request->discount_type,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'internal_reference' => $request->internal_reference,
			'tpreview' => $request->tpreview,
			'documents' => $request->document,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
			'podate' => Carbon::parse($request->podate)->format('Y-m-d'),
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
				'invoice_remaining'   => $request->quantity[$i],
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

		return 'Success';
	}

	public function verify(Request $request)
	{
		$branch = Session::get('branch');
		$id = $request->id;
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
		$quotation   = DB::table('qsell_quotation')->select('qsell_quotation.*', DB::raw("DATE_FORMAT(qsell_quotation.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_quotation.valid_till, '%d-%m-%Y') as valid_till"))->where('id', $id)->get();
		$quotation_products = DB::table('qsell_quotation_products')->leftjoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_quotation_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_products.quote_id', $id)->get();
		$customers = DB::table('qsell_quotation')->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation.id', $id)->get();

		return view('sell.quotation.verify', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'quotation', 'quotation_products'));
	}

	public function sellquotationverify(Request $request)
	{
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');
		$customer_id = $request->customer;
		$id = $request->id;

		$quote_data = [
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
			'discount_type' => $request->discount_type,
			'customer_type' => $request->customer_type,
			'customer' => $customer_id,
			'terms_conditions' => $request->terms_conditions,
			'notes' => $request->notes,
			'internal_reference' => $request->internal_reference,
			'tpreview' => $request->tpreview,
			// 'documents'=>$request->documents,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'status' => 'Verified',
			'user_id' => $user_id,
			'payment_terms' => $request->payment_terms,
		];
		DB::table('qsell_quotation')->where('id', $id)->update($quote_data);
		DB::table('qsell_quotation_products')->where('quote_id', $id)->delete();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$quote_product_data = [
				'quote_id' => $id,
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
			DB::table('qsell_quotation_products')->insert($quote_product_data);
		}

		return 'Success';
	}
}

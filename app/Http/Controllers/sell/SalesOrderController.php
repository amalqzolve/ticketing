<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use App\inventory\ProductdetailslistModel;
use Illuminate\Http\Request;
use App\Expenditure;
use App\Ticket;
use PDF;
use App\settings\BranchSettingsModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MuktarSayedSaleh\ZakatTlv\Encoder;
use Carbon\Carbon;
use DataTables;
use App\Traits\AccountingActionsTrait;
use App\Traits\SellTrails;


class SalesOrderController extends Controller
{
	use AccountingActionsTrait, SellTrails;
	public function sell_saleorder_list(Request $request)
	{
		$branch = Session::get('branch');
		$user = Auth::user();
		if (!$request->ajax()) {
			$salesorder = array();
			return view('sell.salesorder.list', compact('salesorder'));
		} else {
			$salesorder = DB::table('qsell_saleorder')
				->select('qsell_saleorder.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', DB::raw("DATE_FORMAT(qsell_saleorder.valid_till, '%d-%m-%Y') as validity"), 'qsell_saleorder.grandtotalamount', 'qsell_saleorder.id as so_id', DB::raw("DATE_FORMAT(qsell_saleorder.quotedate, '%d-%m-%Y') as quotedate"), DB::raw('SUM(qsell_saleorder_products.quantity) as totalquantity'), DB::raw('SUM(qsell_saleorder_products.delivery_remaining) as delivery'), DB::raw('SUM(qsell_saleorder_products.invoice_remaining) as invoice'), DB::raw("DATE_FORMAT(qsell_saleorder.podate, '%d-%m-%Y') as podate"))
				->leftjoin('qcrm_customer_details', 'qsell_saleorder.customer', '=', 'qcrm_customer_details.id')
				->leftjoin('qsell_saleorder_products', 'qsell_saleorder.id', '=', 'qsell_saleorder_products.saleorder_id')
				->where('qsell_saleorder.branch', $branch)
				->where('qsell_saleorder.del_flag', 1)
				->groupBy('qsell_saleorder.id')
				->orderby('qsell_saleorder.id', 'desc')
				->get();

			$dtTble = Datatables::of($salesorder)->addIndexColumn()->addColumn('status', function ($row) use ($user) {
				if ($row->status == 'Confirm')
					return '<span style="color:green;">Approved</span>';
				if ($row->status == 'Draft')
					return '<span style="color:gray;">Draft</span>';
			})->addColumn('inv_status', function ($row) use ($user) {
				if ($row->totalquantity == $row->invoice)
					return 'Not Invoiced';
				if ($row->invoice == 0)
					return 'Fully Invoiced';
				if ($row->invoice > 0 && $row->totalquantity > $row->invoice)
					return 'Partially Invoiced';
			})->addColumn('action', function ($row) use ($user) {
				$j = '';

				// $hasPermission = $user->can('Sales Order Attachments');
				// if ($hasPermission) {
				// 	$j .= '<a href="quotation_documents?id=' . $row->quote_id . '" data-type="edit" data-target="#kt_form">
				// 		<li class="kt-nav__item">
				// 			<span class="kt-nav__link">
				// 				<i class="kt-nav__link-icon flaticon2-printer"></i>
				// 				<span class="kt-nav__link-text" data-id="' . $row->quote_id . '">Attachments</span>
				// 			</span>
				// 		</li>
				// 	</a>';
				// }

				$hasPermission = $user->can('Sales Order PDF');
				if ($hasPermission) {
					$j .= '<a href="SaleOrder-Pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
						<li class="kt-nav__item">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-printer"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
							</span>
						</li>
					</a>';
				}


				if ($row->status === 'Draft') {
					$hasPermission = $user->can('Sales Order Approve');
					if ($hasPermission) {
						$j .= '<a data-type="send" data-target="#kt_form">
							<li class="kt-nav__item salesorder_confirm" id="' . $row->id . '">
								<span class="kt-nav__link">
									<i class="kt-nav__link-icon flaticon-multimedia"></i>
									<span class="kt-nav__link-text" data-id="' . $row->id . '" id="' . $row->id . '">Approve</span>
								</span>
							</li>
						</a>';
					}


					$hasPermission = $user->can('Sales Order Edit');
					if ($hasPermission) {
						$j .= '<a href="saleorder-edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
							<li class="kt-nav__item">
								<span class="kt-nav__link">
									<i class="kt-nav__link-icon flaticon2-reload-1"></i>
									<span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
								</span>
							</li>
						</a>';
					}
				}



				if ($row->status == 'Confirm') {
					$j .= '<a href="sell-cost-sheet/' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Cost Sheet</span>
                                                    </span>
                                                </li>
                                            </a>';

					$j .= '<a href="ticket_list/' . $row->id . '" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon  flaticon2-send-1"></i>
                                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Ticket
                                                            List</span>
                                                    </span>
                                                </li>
                                            </a>';

					$j .= '<a href="expenditure_list/' . $row->id . '" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Expenditure</span>
                                                    </span>
                                                </li>
                                            </a>';

					if ($row->totalquantity == $row->invoice || ($row->invoice > 0 && $row->totalquantity > $row->invoice)) {
						$hasPermission = $user->can('Sales Order Generate Invoice');
						if ($hasPermission) {
							$j .= ' <a href="SaleOrder-Invoice?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-crisp-icons"></i>
                                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Generate
                                                            Invoice</span>
                                                    </span>
                                                </li>
                                            </a>';
						}

						$hasPermission = $user->can('Sales Order Generate Performa Invoice');
						if ($hasPermission) {
							$j .= '<a href="SaleOrder-Performa?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
						<li class="kt-nav__item">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon-cart"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '">Generate
									Performa Invoice</span>
							</span>
						</li>
					</a>';
						}
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
			})->rawColumns(['action', 'status', 'inv_status']);
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


		return view('sell.salesorder.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses', 'stores', 'default_grp', 'typedefault', 'catdefault'));
	}

	// public function edit(Request $request)
	// {
	// 	$branch = Session::get('branch');
	// 	$id = $request->id;
	// 	$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();

	// 	$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
	// 	$common_customer_database = DB::table('qsettings_company')->select('common_customer_database')->value('common_customer_database');
	// 	$productlistquery = DB::table('qinventory_products')->select('*');
	// 	if ($common_customer_database != 1) {
	// 		$productlistquery->where('branch', $branch);
	// 	}
	// 	$productlist = $productlistquery->where('del_flag', 1)->get();
	// 	$currencylistquery = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value');
	// 	if ($common_customer_database != 1) {
	// 		$currencylistquery->where('branch', $branch);
	// 	}
	// 	$currencylist = $currencylistquery->where('del_flag', 1)->get();
	// 	$unitlistquery = DB::table('qinventory_product_unit')->select('id', 'unit_name');
	// 	if ($common_customer_database != 1) {
	// 		$unitlistquery->where('branch', $branch);
	// 	}
	// 	$unitlist = $unitlistquery->where('del_flag', 1)->get();
	// 	$termslistquery = DB::table('qcrm_termsandconditions')->select('id', 'term');
	// 	if ($common_customer_database != 1) {
	// 		$termslistquery->where('branch', $branch);
	// 	}
	// 	$termslist = $termslistquery->where('del_flag', 1)->get();
	// 	$salesmenquery = DB::table('qcrm_salesman_details')->select('id', 'name');
	// 	if ($common_customer_database != 1) {
	// 		$salesmenquery->where('branch', $branch);
	// 	}
	// 	$salesmen = $salesmenquery->where('del_flag', 1)->get();
	// 	$vatlistquery = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax');
	// 	if ($common_customer_database != 1) {
	// 		$vatlistquery->where('branch', $branch);
	// 	}
	// 	$vatlist = $vatlistquery->where('del_flag', 1)->get();
	// 	$stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();
	// 	$quotation   = DB::table('qsell_quotation')->select('qsell_quotation.*', DB::raw("DATE_FORMAT(qsell_quotation.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_quotation.valid_till, '%d-%m-%Y') as valid_till"))->where('id', $id)->get();
	// 	$quotation_products = DB::table('qsell_quotation_products')->leftjoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_quotation_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

	//         WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

	//         GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_quotation_products.quote_id', $id)->get();
	// 	$customers = DB::table('qsell_quotation')->leftjoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_quotation.id', $id)->get();

	// 	return view('sell.salesorder.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'quotation', 'quotation_products'));
	// }

	public function submit(Request $request)
	{

		try {
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
					'sale_type' => 'By Direct',
					// 'quote_id' => $request->quote_id,
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
					'status' => $request->status, //'Draft',
				];
				if ($request->id == '') {
					DB::table('qsell_saleorder')->insert($quote_data);
					$saleorder_id = DB::getPdo()->lastInsertId();
				} else {
					$saleorder_id = $request->id;
					DB::table('qsell_saleorder')->where('id', $saleorder_id)->update($quote_data);
					DB::table('qsell_saleorder_products')->where('saleorder_id', $saleorder_id)->delete();
				}
				for ($i = 0; $i < count($request->item_id); $i++) {
					$quote_product_data = [
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
						'branch' => $branch
					];
					DB::table('qsell_saleorder_products')->insert($quote_product_data);
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


	public function sell_saleorder_convert_delivery(Request $request)
	{
		$branch = Session::get('branch');

		$saleorder_id = $request->id;
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


	public function sell_saleorder_convert_invoice(Request $request)
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

		$cusId = $customers[0]->id;

		$adwanceAmount = 0;
		// if ($invoice[0]->useadvance == 1) {
		$adwance = DB::table('qsell_customer_payments')
			->select(DB::raw('SUM(qsell_customer_payments.dr_amount) as dr_amount'), DB::raw('SUM(qsell_customer_payments.cr_amount) as cr_amount'))
			->where('qsell_customer_payments.customer_id', $cusId)
			->groupBy('qsell_customer_payments.customer_id')
			->first();
		$adwanceAmount = (isset($adwance->cr_amount) ? $adwance->cr_amount : 0) - (isset($adwance->dr_amount) ? $adwance->dr_amount : 0);

		$this->connectToAccounting();
		$depositLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more

		return view('sell.salesorder.convert_invoice', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'saleorder', 'saleorder_products', 'quotation', 'adwanceAmount', 'depositLedjer'));
	}


	public function saleorder_generate_delivery(Request $request)
	{
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');

		$delivery_data = [
			'saleorder_id' => $request->saleorder_id,
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
			'status' => 'Draft',
			'sodate' => $request->sodate,
			'quoteid' => $request->quoteid
		];


		DB::table('qsell_deliveryorder')->insert($delivery_data);
		$delivery_id = DB::getPdo()->lastInsertId();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$delivery_product_data = [
				'deliveryorder_id' => $delivery_id,
				'item_id' => $request->item_id[$i],
				'description' => $request->description[$i],
				'quantity'   => $request->quantity[$i],
				'delivery_quantity' => $request->delivery_quantity[$i],
				'delivered_quantity' => $request->delivered_quantity[$i],
				'remaining_quantity' => $request->remaining_quantity[$i],
				'branch' => $branch
			];
			DB::table('qsell_deliveryorder_products')->insert($delivery_product_data);

			/*Decrement from saleorder products*/

			DB::table('qsell_saleorder_products')->where('id', $request->product_row_id[$i])->decrement('delivery_remaining', $request->delivery_quantity[$i]);

			/*Decrement from saleorder products*/
		}


		return 'Success';
	}
	public function saleorder_invoice_sell(Request $request)
	{

		DB::transaction(function () use ($request) {
			$user_id = Auth::user()->id;
			$branch = Session::get('branch');
			$cname = DB::table('qcrm_customer_details')->where('id', $request->customer)->value('cust_name');
			$sname = DB::table('qcrm_salesman_details')->where('id', $request->salesman)->value('name');
			$invoice_data = [
				'invoice_number' => $request->invoicenumber,
				'sale_type' => 'By SO',
				'saleorder_id' => $request->saleorder_id,
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

				// 'paid_amount' => $request->paidamount,
				// 'balance_amount' => $request->balanceamount,
				// 'internal_reference' => $request->internal_reference,
				// 'useadvance' => $request->useadvance,

				'mark_payments' => $request->mark_payments,
				'use_advance' => $request->use_advance,
				'advance_amt' => $request->advance_amt,
				'paid_amount' => $request->paidamount,
				'balance_amount' => $request->balanceamount,

				'status' => $request->status,
				'cust_name' => $cname,
				'salesman_name' => $sname,
				'invoice_date' => Carbon::parse($request->invoicedate)->format('Y-m-d')
			];


			DB::table('qsell_saleinvoice')->insert($invoice_data);
			$invoice_id = DB::getPdo()->lastInsertId();


			/* Mark Payment at the time of invoice*/
			if ($request->mark_payments == 1) {
				$paymentsArray = array();
				$allPaymentsArray = array();
				$totalPayid = 0;
				if ($request->paidamount != $request->advance_amt) {
					foreach ($request->type as $key => $value) {
						$totalPayid += $request->pay_amount[$key];
						if ($request->pay_amount[$key] != 0) {
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


			for ($i = 0; $i < count($request->item_id); $i++) {
				$invoice_product_data = [
					'invoice_id' => $invoice_id,
					'item_id' => $request->item_id[$i],
					'so_item_id' => $request->product_row_id[$i],
					'item_id' => $request->item_id[$i],
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
					'branch' => $branch,
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
			/*Customer balance code*/
			if ($request->useadvance == 1) {
				$datapay = [
					'customer_id' => $request->customer,
					'payment_date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
					'payment_type' => 'Invoice',
					'doc_id' => $invoice_id,
					'dr_amount' => $request->paidamount,
					'cr_amount' => 0
				];
				$payid = DB::table('qsell_customer_payments')->insertGetId($datapay);
			}
			/*Customer balance  code*/

			if ($request->status == 'Approved') {
				$this->insertInvoiceSOA($invoice_id); //statement of account entry
				$this->salesInvoiceAccountingEnrty($invoice_id); // Accounting Entry
			}
		});
		return 'Success';
	}

	public function confirm(Request $request)
	{
		$id = $request->id;
		DB::table('qsell_saleorder')->where('id', $id)->update(['status' => 'Confirm']);
		return redirect()->route('sell_saleorder_list')->with('message', 'State saved correctly!!!');
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
		$salesorder   = DB::table('qsell_saleorder')->select('qsell_saleorder.*',)->where('id', $id)->get();
		$salesoreder_products = DB::table('qsell_saleorder_products')->leftjoin('qinventory_products', 'qsell_saleorder_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleorder_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleorder_products.saleorder_id', $id)->get();
		$customers = DB::table('qsell_saleorder')->leftjoin('qcrm_customer_details', 'qsell_saleorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleorder.id', $id)->get();


		return view('sell.salesorder.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'salesorder', 'salesoreder_products'));
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
		DB::table('qsell_saleorder')->where('id', $id)->update($quote_data);
		DB::table('qsell_saleorder_products')->where('saleorder_id', $id)->delete();

		for ($i = 0; $i < count($request->item_id); $i++) {
			$quote_product_data = [
				'saleorder_id' => $id,
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
			DB::table('qsell_saleorder_products')->insert($quote_product_data);
		}

		return 'Success';
	}

	public function sell_saleorder_convert_po(Request $request)
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
		$customersquery = DB::table('qcrm_supplier')->select('id', 'sup_name');

		if ($common_customer_database != 1) {
			$customersquery->where('branch', $branch);
		}

		$customers = $customersquery->where('del_flag', 1)->get();
		$areaListquery = DB::table('qcrm_suppliercatogry')->select('id', 'title');

		if ($common_customer_database != 1) {
			$areaListquery->where('branch', $branch);
		}

		$areaList = $areaListquery->where('del_flag', 1)->get();

		$areaListsquery = DB::table('qcrm_supplier_type')->select('id', 'title');

		if ($common_customer_database != 1) {
			$areaListsquery->where('branch', $branch);
		}

		$areaLists = $areaListsquery->where('del_flag', 1)->get();


		$groupquery = DB::table('qcrm_suppliergroup')->select('id', 'title');

		if ($common_customer_database != 1) {
			$groupquery->where('branch', $branch);
		}

		$group = $groupquery->where('del_flag', 1)->get();

		$countryquery = DB::table('countries')->select('id', 'cntry_name');
		$country = $countryquery->get();
		$stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();
		$saleorder   = DB::table('qsell_saleorder')->select('*')->where('id', $saleorder_id)->get();
		$saleorder_products = DB::table('qsell_saleorder_products')->leftjoin('qinventory_products', 'qsell_saleorder_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleorder_products.*', 'qinventory_products.product_name', 'qinventory_products.available_stock', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleorder_products.saleorder_id', $saleorder_id)->get();


		return view('sell.salesorder.convert_po', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'saleorder', 'saleorder_products', 'areaList', 'areaLists', 'group', 'country'));
	}
	public function so_convert_po(Request $request)
	{
		$user_id = Auth::user()->id;
		$branch = Session::get('branch');
		$postID = $request->id;

		$data = [
			'name' => $request->supplier,
			'so_id' => $request->soid,
			'quotedate'   => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
			'valid_till'     => Carbon::parse($request->valid_till)->format('Y-m-d  h:i'),
			'qtnref' => $request->qtnref,
			'po_wo_ref' => $request->po_wo_ref,
			'attention'     => $request->attention,
			'salesman'         => $request->salesman,
			'currency' => $request->currency,
			'currencyvalue' => $request->currencyvalue,
			'preparedby' => $request->preparedby,
			'approvedby' => $request->approvedby,
			'internal_reference' => $request->internalreference,
			'notes' => $request->notes,
			'terms' => $request->terms,
			'tpreview' => $request->tpreview,
			'totalamount' => $request->totalamount,
			'discount' => $request->discount,
			'amountafterdiscount' => $request->amountafterdiscount,
			'vatamount' => $request->totalvatamount,
			'grandtotalamount' => $request->grandtotalamount,
			'branch' => $branch,
			'status' => 'Draft',
			'user_id' => $user_id,
			'ctype' => 2,
		];
		DB::table('qbuy_purchase_orders')->insert($data);

		$purchaseorderid = DB::getPdo()->lastInsertId();
		for ($i = 0; $i < count($request->productname); $i++) {
			$data = [
				'po_id' => $purchaseorderid,
				'so_id' => $request->soid,
				'itemname' => $request->productname[$i],
				'description' => $request->product_description[$i],
				'unit'         => $request->unit[$i],
				'quantity'   => $request->quantity[$i],
				'rate'     => $request->rate[$i],
				'amount' => $request->amount[$i],
				'vatamount' => $request->vatamount[$i],
				'vat_percentage' => $request->vat_percentage[$i],
				'rdiscount' => $request->rdiscount[$i],
				'totalamount' => $request->row_total[$i],
				'branch' => $branch,
				'original_quantity' => $request->quantity[$i],
				'grn_remaining_quantity' => $request->quantity[$i],
				'pi_remaining_quantity' => $request->quantity[$i],
				'grn_quantity' => 0, //'invoiced_quantity' =>0,
				'pi_quantity' => 0 //  'delivered_quantity' =>0

			];
			$vat = DB::table('qbuy_purchase_order_products')->insert($data);
		}


		//update sale order
		DB::table('qsell_saleorder')->where('id', $request->soid)->update(array('po_status' => 1));
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
		$salesorder   = DB::table('qsell_saleorder')->select('*')->where('id', $id)->get();
		$salesorder_products = DB::table('qsell_saleorder_products')->leftjoin('qinventory_products', 'qsell_saleorder_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_saleorder_products.*', 'qinventory_products.product_name', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_saleorder_products.saleorder_id', $id)->get();
		$customers = DB::table('qsell_saleorder')->leftjoin('qcrm_customer_details', 'qsell_saleorder.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_saleorder.id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();


		foreach ($salesorder_products as $key => $value) {
			$itemname = $value->item_id;
		}
		$itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
		$customfields = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $customfields->pluck('labels')->toArray();
		$gm_amount = 0;
		foreach ($salesorder as $key => $value) {
			$gm_amount = $value->grandtotalamount;
		}

		$words = $this->numberToWord($gm_amount);
		$quote_status = DB::table('qsell_saleorder')->select('status')->where('id', $id)->value('status');

		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('sell.salesorder.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesorder', 'salesorder_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview2') {
			$pdf = PDF::loadView('sell.salesorder.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesorder', 'salesorder_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('sell.salesorder.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesorder', 'salesorder_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		} elseif (Session::get('preview') == 'preview4') {
			if ($quote_status == "Confirm") {
				$pdf = PDF::loadView('sell.salesorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesorder', 'salesorder_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'words'));
			} else {
				$pdf = PDF::loadView('sell.salesorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesorder', 'salesorder_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'words'), [], [
					'default_font'               => 'sans-serif',
					'watermark'                  => $quote_status,
					'show_watermark'             => true,
					'pdfa'                       => false,
					'pdfaauto'                   => false,
				]);
			}
		} else {
			$pdf = PDF::loadView('sell.salesorder.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'salesorder', 'salesorder_products', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		}
		return $pdf->stream('Salesorder-#' . $id . '.pdf');
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

	public function delivery_Approve(Request $request)
	{
		$id = $request->id;
		DB::table('qsell_deliveryorder')->where('id', $id)->update(['status' => 'Delivered']);
		return redirect()->route('sell_delivery_list')->with('message', 'State saved correctly!!!');
	}
	public function quotation_documents(Request $request)
	{
		$id = $request->id;
		$documents = DB::table('qsales_quotation_documents_files')->select('*')->where('qtn_id', $id)->get();
		return view('sell.salesorder.documents', compact('documents', 'id'));
	}
	public function quotationdownload(Request $request)
	{
		ob_end_clean();
		$qtnid = $request->qtnid;
		$file = $request->file;
		$file_path = public_path('Quotationfiles/' . $qtnid . '/' . $file);
		//dd($file_path);
		return response()->download($file_path);
		redirect()->back();
	}

	public function SaleOrder_Performa(Request $request)
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

		return view('sell.salesorder.convert_perfoma', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'warehouses', 'stores', 'saleorder', 'saleorder_products', 'quotation'));
	}

	public function saleorder_performa_sell(Request $request)
	{

		$user_id = Auth::user()->id;
		$branch = Session::get('branch');
		$cname = DB::table('qcrm_customer_details')->where('id', $request->customer)->value('cust_name');
		$sname = DB::table('qcrm_salesman_details')->where('id', $request->salesman)->value('name');
		$invoice_data = [
			'performa_type' => 'By SalesOrder',
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
				'so_item_id' => $request->product_row_id[$i],
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


	public function CostSheet($id)
	{

		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->first();

		$saleorder =	DB::table('qsell_saleorder')->select('*')->where('id', $id)->first();
		$tickets = Ticket::select('tickets.id', 'tickets.sales_order_id', 'tickets.name', 'tickets.total_amount', 'tickets.passport_no', 'countries.cntry_name as cntry_name')
			->leftjoin('countries', 'tickets.country', '=', 'countries.id')
			->where('tickets.sales_order_id', '=', $id)
			->get();
		$so_id = $id;
		$expenditures =  Expenditure::select('expenditures.id', 'expenditures.sales_order_id', 'expenditures.quotedate', 'qcrm_supplier.sup_name',  'expenditures.totalamount', 'expenditures.discount', 'expenditures.vatamount', 'expenditures.grandtotalamount')
			->leftjoin('qcrm_supplier', 'expenditures.sup_id', '=', 'qcrm_supplier.id')
			->where('expenditures.sales_order_id', '=', $id)
			->get();
		$invoices =  DB::table('qsell_saleinvoice')->select('qsell_saleinvoice.id', 'qsell_saleinvoice.saleorder_id', 'qsell_saleinvoice.quotedate', 'qcrm_customer_details.cust_name',  'qsell_saleinvoice.totalamount', 'qsell_saleinvoice.discount', 'qsell_saleinvoice.vatamount', 'qsell_saleinvoice.grandtotalamount')
			->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')
			->where('qsell_saleinvoice.saleorder_id', '=', $id)
			->get();

		$invoiceProducts =  DB::table('qsell_saleinvoice')->select('qsell_saleinvoice.id', 'qsell_saleinvoice_products.purchaseamount', 'qsell_saleinvoice_products.amount')
			->leftjoin('qsell_saleinvoice_products', 'qsell_saleinvoice.id', '=', 'qsell_saleinvoice_products.invoice_id')
			->where('qsell_saleinvoice.saleorder_id', '=', $id)
			->orderBy('qsell_saleinvoice.id', 'asc')
			->get();



		$soId = 'Cost Sheet #SO- ' . $id . '_' . date('d-m-Y');
		$configuration = [];
		$pdf = PDF::loadView('sell.salesorder.costSheet1', compact('branchsettings', 'tickets', 'expenditures', 'invoices', 'saleorder', 'invoiceProducts'), $configuration,  [
			'title'      => $soId,
			'margin_top' => 0
		]);
		return $pdf->stream($soId . '.pdf');
	}

	public function CostCenter(Request $request)
	{
		if (!$request->ajax()) {
			return view('sell.salesorder.listCostCenter');
		} else {
			$data = DB::table('qsell_saleorder')
				->select('qsell_saleorder.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', DB::raw("DATE_FORMAT(qsell_saleorder.valid_till, '%d-%m-%Y') as validity"), 'qsell_saleorder.grandtotalamount', 'qsell_saleorder.id as so_id', DB::raw("DATE_FORMAT(qsell_saleorder.quotedate, '%d-%m-%Y') as quotedate"))
				->leftjoin('qcrm_customer_details',   'qcrm_customer_details.id', 'qsell_saleorder.customer')->get();


			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->addColumn('calculations', function ($row) {
				$expenditures =  Expenditure::select(DB::raw('SUM(totalamount) AS exp_totalamount'), DB::raw('SUM(vatamount) AS exp_vatamount'), DB::raw('SUM(grandtotalamount) AS exp_grandtotalamount'))
					->where('sales_order_id', '=', $row->id)
					->get();
				$invoices =  DB::table('qsell_saleinvoice')->select(DB::raw('SUM(totalamount) AS inv_totalamount'), DB::raw('SUM(vatamount) AS inv_vatamount'), DB::raw('SUM(grandtotalamount) AS inv_grandtotalamount'))
					->where('saleorder_id', '=', $row->id)
					->get();
				$out = array(
					'exp_totalamount' => ($expenditures[0]->exp_totalamount == '') ? 0 : $expenditures[0]->exp_totalamount,
					'exp_vatamount' => ($expenditures[0]->exp_vatamount == '') ? 0 : $expenditures[0]->exp_vatamount,
					'exp_grandtotalamount' => ($expenditures[0]->exp_grandtotalamount == '') ? 0 : $expenditures[0]->exp_grandtotalamount,
					'inv_totalamount' => ($invoices[0]->inv_totalamount == '') ? 0 : $invoices[0]->inv_totalamount,
					'inv_vatamount' => ($invoices[0]->inv_vatamount == '') ? 0 : $invoices[0]->inv_vatamount,
					'inv_grandtotalamount' => ($invoices[0]->inv_grandtotalamount == '') ? 0 : $invoices[0]->inv_grandtotalamount,
					'profit' => $invoices[0]->inv_totalamount - $expenditures[0]->exp_totalamount
				);
				return $out;
			})
				->rawColumns(['action', 'calculations']);
			return  $dtTble->make(true);
		}
	}
}

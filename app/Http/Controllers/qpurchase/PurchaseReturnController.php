<?php

namespace App\Http\Controllers\qpurchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use View;
use DB;
use Auth;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\Traits\PurchaseTraits;
use App\Traits\AccountingActionsTrait;
use App\Traits\ProductCountOperationTrait;
use App\settings\BranchSettingsModel;
use Hashids\Hashids;


class PurchaseReturnController extends Controller
{
	use PurchaseTraits, AccountingActionsTrait, ProductCountOperationTrait;
	public function index(Request $request)
	{
		$branch = Session::get('branch');
		$user = Auth::user();
		if (!$request->ajax()) {
			return view('qpurchase.return.list');
		} else {
			$debitnote = DB::table('qbuy_purchase_return')
				->leftjoin('qcrm_supplier', 'qbuy_purchase_return.supplier_id', '=', 'qcrm_supplier.id')
				->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_return.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
				->select('qbuy_purchase_return.*',  'qbuy_purchase_pi.id as pur_inv_br_id', 'qcrm_supplier.sup_name', DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"), DB::raw("DATE_FORMAT(qbuy_purchase_pi.quotedate, '%d-%m-%Y') as quotedate"))
				// ->where('qbuy_purchase_return.del_flag', 1)
				->where('qbuy_purchase_return.branch', $branch)
				->get();

			$dtTble = Datatables::of($debitnote)->addIndexColumn()->addColumn('status', function ($row) use ($user) {
				if ($row->status == 'Draft')
					return '<span style="color:gray;">Draft</span>';
				if ($row->status == 'Approved') {
					if ($row->supplier_given_amt == 0)
						return '<span style="color:green;">Approved</span>';
					else if ($row->supplier_given_amt >= $row->grandtotalamount) {
						return '<span style="color:green;">Refunded</span>';
					} else
						return '<span style="color:orange;">Partially Refunded</span>';
				}
			})->addColumn('action', function ($row) use ($user) {
				$j = '';

				$hashids = new Hashids();
				$j .= '<a href="qpurchase-return-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
				<li class="kt-nav__item">
					<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon-eye"></i>
						<span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
					</span>
				</li>
			</a>';

				if ($row->status == "Draft") {
					$j .= '<a href="qpurchase-return-pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
								<li class="kt-nav__item">
									<span class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-printer"></i>
										<span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
									</span>
								</li>
							</a>';

					$j .= '<a href="qpurchase-invoice-load-for-return-edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
									<li class="kt-nav__item">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon flaticon2-reload-1"></i>
											<span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
										</span>
									</li>
								</a>';

					$j .= '<a data-type="send" data-target="#kt_form">
								<li class="kt-nav__item purchase_return_approve" id="' . $row->id . '">
									<span class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-check-mark"></i>
										<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
									</span>
								</li>
							</a>';
					$j .= '<a data-type="send" data-target="#kt_form">
							<li class="kt-nav__item purchase_return_delete" id="' . $row->id . '">
								<span class="kt-nav__link">
									<i class="kt-nav__link-icon flaticon-delete"></i>
									<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Delete</span>
								</span>
							</li>
						</a>';
				} else {
					$j .= '<a href="qpurchase-debit-note-pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
						<li class="kt-nav__item">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-printer"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '">Debit Note</span>
							</span>
						</li>
					</a>';

					if ($row->supplier_given_amt < $row->grandtotalamount) {
						$j .= '<a href="qpurchase-refund/' . $hashids->encode($row->id)  . '" data-type="edit" data-target="#kt_form">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon-refresh"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">Refund</span>
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
			})
				->addColumn('pur_inv_code', function ($row) {
					return $row->id;
				})


				->rawColumns(['action', 'status']);
			return  $dtTble->make(true);
		}
	}
	public function add()
	{
		$branch = Session::get('branch');
		$suppliers   = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('del_flag', 1)->where('branch', $branch)->get();
		return view('qpurchase.return.add', compact('suppliers', 'branch'));
	}
	public function loadPurchaseInvoice(Request $request)
	{
		$id = $request->purchasenumber;
		$branch = Session::get('branch');
		$pi   = DB::table('qbuy_purchase_pi')->select('qbuy_purchase_pi.*', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();
		if (isset($pi->id)) {
			$pi_product   = DB::table('qbuy_purchase_pi_products')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();


			$pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $pi->supplier_id)->get();

			$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
			$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
			$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
			$customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
			$areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$country = DB::table('countries')->select('id', 'cntry_name')->get();;
			$taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();

			return view('qpurchase.return.returndetails', compact('branch', 'currencylist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses',  'taxgrouplist', 'pi', 'pi_product',  'pname'));
		} else
			return abort(404);
	}

	public function loadPurchaseInvoiceEdit(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');
		$purchase_return =	DB::table('qbuy_purchase_return')->select('*')->where('id', $id)->where('branch', $branch)->first();
		if ($purchase_return->id != '') {

			//products Select
			// qbuy_purchase_pi_products
			$return_product = DB::table('qbuy_purchase_return_products')
				->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
				->select('qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty', 'qbuy_purchase_pi_products.new_product_id', 'qbuy_purchase_pi_products.rdiscount as inv_discount') //
				->where('qbuy_purchase_return_id', $id)
				->get();
			// ./products Select
			$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
			$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();

			$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
			$customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
			$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->orderBy('total', 'asc')->where('branch', $branch)->where('del_flag', 1)->get();
			$areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$country = DB::table('countries')->select('id', 'cntry_name')->get();

			$pi   = DB::table('qbuy_purchase_pi')->select('qbuy_purchase_pi.*', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('id', $purchase_return->qbuy_purchase_pi_id)->where('del_flag', 1)->where('branch', $branch)->get();

			// $pi_product   = DB::table('qbuy_purchase_pi_products')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
			foreach ($pi as $key => $value) {
				$pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->supplier_id)->get();
			}
			return view('qpurchase.return.returndetailsEdit', compact('branch', 'currencylist', 'vatlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses',  'pi',  'pname', 'purchase_return', 'return_product'));
		} else
			return abort(404);
	}

	public function view(Request $request, $id)
	{
		$hashids = new Hashids();
		$id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;
		$branch = Session::get('branch');
		$purchase_return =	DB::table('qbuy_purchase_return')->select('*')->where('id', $id)->where('branch', $branch)->first();
		if ($purchase_return->id != '') {

			//products Select
			// qbuy_purchase_pi_products
			$return_product = DB::table('qbuy_purchase_return_products')
				->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
				->select('qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty', 'qbuy_purchase_pi_products.new_product_id') //
				->where('qbuy_purchase_return_id', $id)
				->get();
			// ./products Select
			$warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
			$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();

			$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
			$customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
			$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->orderBy('total', 'asc')->where('branch', $branch)->where('del_flag', 1)->get();
			$areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
			$country = DB::table('countries')->select('id', 'cntry_name')->get();

			$pi   = DB::table('qbuy_purchase_pi')->select('qbuy_purchase_pi.*', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('id', $purchase_return->qbuy_purchase_pi_id)->where('del_flag', 1)->where('branch', $branch)->get();

			// $pi_product   = DB::table('qbuy_purchase_pi_products')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
			foreach ($pi as $key => $value) {
				$pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->supplier_id)->get();
			}
			return view('qpurchase.return.view', compact('branch', 'currencylist', 'vatlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses',  'pi',  'pname', 'purchase_return', 'return_product'));
		} else
			return abort(404);
	}

	public function save(Request $request)
	{
		DB::transaction(function () use ($request) {
			$branch = Session::get('branch');
			$postID = $request->id;
			$branch_settings = Session::get('branch_settings');
			$data = [
				//'code' => $branch_settings->purchasereturn_sufix . '' . sprintf("%03d", $branch),
				'qbuy_purchase_pi_id' => $request->qbuy_purchase_pi_id,
				'supplier_id' => $request->supplier_id,
				'returndate' => Carbon::parse($request->returndate)->format('Y-m-d'),
				'reason' => $request->reason,
				'internalreference' => $request->internalreference,
				'notes' => $request->notes,
				'terms' => $request->terms,
				'tpreview' => $request->tpreview,
				'totalamount' => $request->totalamount,
				'discount' => $request->discount,
				'amountafterdiscount' => $request->amountafterdiscount,
				'totalvatamount' => $request->totalvatamount,
				'grandtotalamount' => $request->grandtotalamount,
				'branch' => $branch,
				'status' => $request->status,
			];
			if ($postID == '') {
				DB::table('qbuy_purchase_return')->insert($data);
				$returnId = DB::getPdo()->lastInsertId();
			} else {
				$oldRtn =  DB::table('qbuy_purchase_return')->select('id', 'grandtotalamount')->where('id', $request->id)->first();
				$oldAmt = $oldRtn->grandtotalamount;
				DB::table('qbuy_purchase_pi')->where('id', $request->qbuy_purchase_pi_id)->increment('balance_amount', $oldAmt); //incr old returnd amount

				DB::table('qbuy_purchase_return')->where('id', $postID)->update($data);

				$products = DB::table('qbuy_purchase_return_products')->where('qbuy_purchase_return_id', $postID)->select('quantity', 'qbuy_purchase_pi_products_id', 'product_transaction_id')->get();
				foreach ($products as $key => $value) {
					DB::table('qbuy_purchase_pi_products')->where('id', $value->qbuy_purchase_pi_products_id)->decrement('returned_qty', $value->quantity);
					if ($branch_settings->inventory_stock_affect_at == 'at-invoice') {
						$this->deleteProductTransaction($value->product_transaction_id);
					}
				}
				DB::table('qbuy_purchase_return_products')->where('qbuy_purchase_return_id', $postID)->delete();
				$returnId = $postID;
			}
			DB::table('qbuy_purchase_pi')->where('id', $request->qbuy_purchase_pi_id)->decrement('balance_amount', $request->grandtotalamount); //decr returnd amount
			for ($i = 0; $i < count($request->item_details_id); $i++) {
				$product_transaction_id = null;
				if ($branch_settings->inventory_stock_affect_at == 'at-invoice') {
					$product_transaction_id = $this->updateOrinsertProductTransaction('', array(
						'product_id' => $request->new_product_id[$i],
						'date' => Carbon::parse($request->returndate)->format('Y-m-d'),
						'desc' => 'Purchase Return',
						'qty' => $request->quantity[$i],
						'stock_affection' => '-',
						// 'price',
						'branch' => $branch,
					));
					$this->decrementStock($request->new_product_id[$i], $request->quantity[$i]);
				}
				DB::table('qbuy_purchase_pi_products')->where('id', $request->qbuy_purchase_pi_products_id[$i])->increment('returned_qty', $request->quantity[$i]);
				$data_variant = [
					'qbuy_purchase_return_id' => $returnId,
					'item_details_id' => $request->item_details_id[$i],
					'qbuy_purchase_pi_products_id' => $request->qbuy_purchase_pi_products_id[$i],
					'quantity' => $request->quantity[$i],
					'rate' => $request->rate[$i],
					'amount' => $request->amount[$i],
					'vatamount' => $request->vatamount[$i],
					'vat_percentage' => $request->vat_percentage[$i],
					'discountamount' => $request->discountamount[$i],
					'row_total' => $request->row_total[$i],
					'product_transaction_id' => $product_transaction_id,
				];
				DB::table('qbuy_purchase_return_products')->insert($data_variant);
			}
			$this->purchaseReturnAccountingEnrty($returnId); //Accounting Entry
			$this->purchaseReturnSOAInsertion($returnId, $branch); //SOA Entry
		});
		return 'true';
	}

	public function  approve(Request $request)
	{
		DB::transaction(function () use ($request) {
			$branch = Session::get('branch');
			$postID = $request->id;
			DB::table('qbuy_purchase_return')->where('id', $postID)->update(array('status' => 'Approved'));
			// $this->reduceFromStock($postID);
		});
		$out = array(
			'status' => 1,
		);
		echo json_encode($out);
	}
	public function  delete(Request $request)
	{
		DB::transaction(function () use ($request) {
			$postID = $request->id;
			$branch_settings = Session::get('branch_settings');
			$oldData = DB::table('qbuy_purchase_return')->select('acc_entries_id', 'soa_id', 'grandtotalamount')->where('id', $postID)->first();
			$this->entryItemsDelete($oldData->acc_entries_id);
			$this->deletePurchaseSOA($oldData->soa_id);
			$oldAmt = $oldData->grandtotalamount;
			DB::table('qbuy_purchase_pi')->where('id', $request->qbuy_purchase_pi_id)->increment('balance_amount', $oldAmt); //incr old returnd amount
			DB::table('qbuy_purchase_return')->where('id', $postID)->delete();
			$products = DB::table('qbuy_purchase_return_products')
				->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
				->where('qbuy_purchase_return_products.qbuy_purchase_return_id', $postID)
				->select('qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.product_transaction_id', 'qbuy_purchase_pi_products.new_product_id')
				->get();
			foreach ($products as $key => $value) {
				DB::table('qbuy_purchase_pi_products')->where('id', $value->qbuy_purchase_pi_products_id)->decrement('returned_qty', $value->quantity);
				if ($branch_settings->inventory_stock_affect_at == 'at-invoice') {
					$this->deleteProductTransaction($value->product_transaction_id);
					$this->decrementStock($value->new_product_id, $value->quantity);
				}
			}
			DB::table('qbuy_purchase_return_products')->where('qbuy_purchase_return_id', $postID)->delete();
		});
		$out = array(
			'status' => 1,
		);
		echo json_encode($out);
	}


	public function pdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$purchase_return =	DB::table('qbuy_purchase_return')->select('*')->where('id', $id)->where('branch', $branch)->first();
		if ($purchase_return->id != '') {
			$return_product = DB::table('qbuy_purchase_return_products')
				->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
				->select('qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty') //
				->where('qbuy_purchase_return_id', $id)
				->get();
			$currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
			$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

			$salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
			$vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();

			$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
			$bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();

			$pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $purchase_return->supplier_id)->get();

			$pdf = PDF::loadView('qpurchase.return.preview', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase_return', 'return_product', 'pname', 'branchsettings', 'bname'));

			return $pdf->stream('return.pdf');
		} else
			echo "Purchase Return Not Fount";
	}

	public function debitNotePdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$purchase_return =	DB::table('qbuy_purchase_return')->select('*')->where('id', $id)->where('branch', $branch)->first();
		if ($purchase_return->id != '') {
			$return_product = DB::table('qbuy_purchase_return_products')
				->leftJoin('qbuy_purchase_pi_products', 'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', '=', 'qbuy_purchase_pi_products.id')
				->select('qbuy_purchase_return_products.item_details_id',  'qbuy_purchase_return_products.qbuy_purchase_pi_products_id', 'qbuy_purchase_return_products.quantity', 'qbuy_purchase_return_products.rate', 'qbuy_purchase_return_products.amount', 'qbuy_purchase_return_products.vat_percentage', 'qbuy_purchase_return_products.vatamount', 'qbuy_purchase_return_products.discountamount', 'qbuy_purchase_return_products.row_total', 'qbuy_purchase_pi_products.itemname', 'qbuy_purchase_pi_products.description', 'qbuy_purchase_pi_products.unit', 'qbuy_purchase_pi_products.quantity as pquantity', 'qbuy_purchase_pi_products.returned_qty') //
				->where('qbuy_purchase_return_id', $id)
				->get();
			$currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
			$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
			$termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

			$salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
			$vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();

			$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
			$bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();

			$pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $purchase_return->supplier_id)->get();

			$pdf = PDF::loadView('qpurchase.return.preview_debit_note', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchase_return', 'return_product', 'pname', 'branchsettings', 'bname'));

			return $pdf->stream('debitnote.pdf');
		} else
			echo "Purchase Return Not Fount";
	}
}

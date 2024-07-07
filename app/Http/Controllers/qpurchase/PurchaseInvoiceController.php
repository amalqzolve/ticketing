<?php

namespace App\Http\Controllers\qpurchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use View;
use DB;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use Auth;
use App\settings\BranchSettingsModel;
use App\Traits\PurchaseTraits;
use App\Traits\AccountingActionsTrait;
use App\Traits\ProductCountOperationTrait;
use Hashids\Hashids;

class PurchaseInvoiceController extends Controller
{
    use AccountingActionsTrait, PurchaseTraits, ProductCountOperationTrait;
    public function list(Request $request)
    {
        $branch = Session::get('branch');
        $user = Auth::user();
        if (!$request->ajax()) {
            return view('qpurchase.purchaseinvoice.list');
        } else {
            $purchaseinvoice = DB::table('qbuy_purchase_pi')
                ->leftjoin('qbuy_purchase_orders', 'qbuy_purchase_pi.po_id', '=', 'qbuy_purchase_orders.id')
                ->leftjoin('qbuy_purchase_pi_products', 'qbuy_purchase_pi.id', '=', 'qbuy_purchase_pi_products.pi_id')
                ->leftjoin('qcrm_supplier', 'qbuy_purchase_pi.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'qbuy_purchase_pi.salesman', '=', 'qcrm_salesman_details.id')
                ->select('qbuy_purchase_pi.*',  DB::raw("DATE_FORMAT(qbuy_purchase_pi.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"), 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as salesman', DB::raw('SUM(qbuy_purchase_pi_products.quantity) as quantity'), DB::raw('SUM(qbuy_purchase_pi_products.grn_remaining_quantity) as grn_remaining_quantity'), DB::raw('SUM(qbuy_purchase_pi_products.returned_qty) as total_returned_qty'))
                ->where('qbuy_purchase_pi.del_flag', 1)
                ->where('qbuy_purchase_pi.branch', $branch)
                ->groupBy('qbuy_purchase_pi.id')
                ->get();
            $dtTble = Datatables::of($purchaseinvoice)->addIndexColumn()
                ->addColumn('status', function ($row) use ($user) {
                    if ($row->status == 'Approved')
                        return '<span style="color:green;">Approved</span>';
                    if ($row->status == 'Draft')
                        return '<span style="color:gray;">Draft</span>';
                })->addColumn('grn_status', function ($row) use ($user) {
                    if (($row->invoice_type == 'Direct') && ($row->status == 'Approved')) {
                        if ($row->quantity <= $row->grn_remaining_quantity)
                            return 'Not Generated';
                        else if ($row->grn_remaining_quantity == 0)
                            return 'Fully Generated';
                        else
                            return 'Partially Generated';
                    } else
                        return '-';
                })->addColumn('return_status', function ($row) use ($user) {
                    if ($row->status == 'Approved') {
                        if ($row->quantity == $row->total_returned_qty)
                            return 'Fully Returned';
                        else if ($row->total_returned_qty > 0)
                            return 'Partially Returned';
                        else
                            return 'Not Returned';
                    } else
                        return '-';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $j = '';

                    $hashids = new Hashids();
                    $j .= '<a href="qpurchase-invoice-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
                    <li class="kt-nav__item">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-eye"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
                        </span>
                    </li>
                </a>';

                    $j .= '<a href="qpurchase_invoice_pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-printer"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                            </span>
                        </li>
                    </a>';

                    if ($row->status == "Draft") {
                        $j .= '<a href="qpurchase_invoice_edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
                                    </span>
                                </li>
                            </a>';

                        $j .= '<a data-type="send" data-target="#kt_form">
						<li class="kt-nav__item invoice_approve" id="' . $row->id . '">
							<span class="kt-nav__link">
								<i class="kt-nav__link-icon flaticon2-check-mark"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
							</span>
						</li>
					</a>';

                        $j .= '<a data-type="send" data-target="#kt_form">
                    <li class="kt-nav__item invoice_delete" id="' . $row->id . '">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-delete"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Delete</span>
                        </span>
                    </li>
                </a>';
                    }

                    if (($row->status == "Approved") && ($row->grn_remaining_quantity != 0)) {
                        $j .= '<a href="convert-grn-from-invoice?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">Generate GRN</span>
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
                })
                ->addColumn('po_code', function ($row) {
                    if ($row->po_id != null)
                        return $row->po_id;
                    else
                        return '-';
                })->rawColumns(['action', 'status']);
            return  $dtTble->make(true);
        }
    }
    public function add(Request $request)
    {
        $branch = Session::get('branch');
        $branch_settings = Session::get('branch_settings');
        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
        $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
        $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
        $suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $suppliercatogry = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $supplierType = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $supplierGroup = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = DB::table('countries')->select('id', 'cntry_name')->get();
        $taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();

        $this->connectToAccounting();
        $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more

        return view('qpurchase.purchaseinvoice.add', compact('branch', 'branch_settings', 'currencylist',  'unitlist', 'termslist',  'salesmen', 'suppliers', 'suppliercatogry', 'supplierType', 'supplierGroup', 'country', 'warehouses',  'taxgrouplist',  'debitLedjer'));
    }

    public function submit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');


            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $branch_settings = Session::get('branch_settings');
            if ($request->supplier_source == 1) { //New Supplier     
                $supData =  array(
                    'sup_code' => $branch_settings->supplier_sufix . '' . sprintf("%03d", $branch),
                    'sup_category' => $request->sup_category,
                    'sup_group' => $request->sup_group,
                    'sup_type' => $request->sup_type,
                    'sup_name' => $request->sup_name,
                    'sup_add1' => $request->building_no,
                    'sup_region' => $request->sup_region,
                    'sup_add2' => $request->sup_district,
                    'sup_city' => $request->sup_city,
                    'sup_country' => $request->sup_country,
                    'sup_zip' => $request->sup_zip,
                    'mobile1' => $request->mobile,
                    'vatno' => $request->vatno,
                    'buyerid_crno' => $request->buyerid_crno,
                    'account_ledger' => $branch_settings->default_supplier_ledger,
                    'branch' => $branch,
                );
                $supplier = DB::table('qcrm_supplier')->insertGetId($supData);
            } else if ($request->supplier_source == 2) //supplier from DB
                $supplier = $request->supplier;
            $data = [
               // 'code' => $branch_settings->purchaseinvoice_sufix . '' . sprintf("%03d", $branch),
                'supplier_id' => $supplier,
                'attention'     => $request->attention,
                'salesman'         => $request->salesman,
                'currency' => $request->currency,
                'currencyvalue' => $request->currencyvalue,
                'totalamount' => $request->totalamount,
                'discount' => $request->discount,
                'amountafterdiscount' => $request->amountafterdiscount,
                'vatamount' => $request->totalvatamount,
                'grandtotalamount' => $request->grandtotalamount,
                // 'paid_amount' => 0,
                // 'balance_amount' => $request->grandtotalamount,
                'terms' => $request->terms,
                'notes' => $request->notes,
                'preparedby' => $request->preparedby,
                'approvedby' => $request->approvedby,
                'branch' => $branch,
                'tpreview' => $request->tpreview,
                'user_id' => $user_id,
                'qtnref' => $request->qtnref,
                'po_wo_ref' => $request->po_wo_ref,
                'branch' => $branch,
                'internal_reference' => $request->internalreference,
                'purchasemethod' => $request->purchasemethod,
                'purchasebillid' => $request->purchasebillid,
                'purchaser' => $request->purchaser,
                'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),
                'invoice_type' => 'Direct',

                // 'paid_by_bank' => $request->paid_by_bank,
                // 'paid_by_card' => $request->paid_by_card,
                // 'paid_by_cash' => $request->paid_by_cash,
                // 'useadvance' => $request->useadvance,
                // 'paid_from_adwance' => $request->paid_from_adwance,
                // 'paid_amount' => $request->paid_amount,
                // 'balance_amount' => $request->balance_amount,

                'mark_payments' => $request->mark_payments,
                'use_advance' => $request->use_advance,
                'advance_amt' => $request->advance_amt,
                'paid_amount' => $request->paid_amount,
                'balance_amount' => $request->balance_amount,

                // 'job_id' => $request->job_id,
                'discount_type' => $request->discount_type,
                'status' => $request->status,
            ];
            DB::table('qbuy_purchase_pi')->insert($data);
            $piid = DB::getPdo()->lastInsertId();
            for ($i = 0; $i < count($request->productname); $i++) {
                $data = [
                    'pi_id' => $piid,
                    'itemname' => $request->productname[$i],
                    'save_as' => isset($request->save_as[$i]) ? $request->save_as[$i] : null,
                    'item_details_id' => $request->item_details_id[$i],
                    'description' => $request->product_description[$i],
                    'unit'         => $request->unit[$i],
                    'quantity'   => $request->quantity[$i],
                    'original_quantity'   => $request->quantity[$i],
                    'pi_remaining_quantity'   => $request->quantity[$i],
                    'grn_remaining_quantity' => $request->quantity[$i],
                    'rate'     => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'vatamount' => $request->vatamount[$i],
                    'vat_percentage' => $request->vat_percentage[$i],
                    'rdiscount' => $request->rdiscount[$i],
                    'totalamount' => $request->row_total[$i],
                    'branch' => $branch
                ];
                if ($branch_settings->inventory_stock_affect_at == 'at-invoice') {
                    $stockUpdationStatus = $this->purchaseUpdation('PI', 'insert', $request->bill_entry_date, array(
                        'item_details_id' => $request->item_details_id[$i],
                        'product_name' => $request->productname[$i],
                        'unit' => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'description' => $request->product_description[$i],
                        'save_as' => $request->save_as[$i],
                        'totalamount' => $request->row_total[$i],
                        'branch' => $branch,
                    ));
                    $data['new_product_id'] = $stockUpdationStatus['new_product_id'];
                    $data['product_transaction_id'] = $stockUpdationStatus['transaction_id'];
                }
                $enquiry_product =  DB::table('qbuy_purchase_pi_products')->insert($data);
            }
            if (is_array($request->itemcost_details))
                foreach ($request->itemcost_details as $i => $value) {
                    $data_variant1 = [
                        'costheadname' => $request->itemcost_details[$i],
                        'rate' => $request->costrate[$i],
                        'tax' => $request->costtax_group[$i],
                        'amount' => $request->costtax_amount[$i],
                        'branch' => $branch,
                        'costtax_notes' => $request->costtax_notes[$i],
                        'costsupplier' => $request->costsupplier[$i],
                        'pi_id' => $piid,
                    ];
                    DB::table('qbuy_products_costhead')->insert($data_variant1);
                }


            /* Mark Payment at the time of invoice*/
            if ($request->mark_payments == 1) {
                if ($request->paidamount != $request->advance_amt) {
                    $paymentsArray = array();
                    foreach ($request->type as $key => $value) {
                        if ($request->pay_amount[$key] != 0)
                            array_push($paymentsArray, array(
                                'qbuy_purchase_pi_id' => $piid,
                                'type' => $request->type[$key],
                                'debitaccount' => $request->debitaccount[$key],
                                'reference' => $request->reference[$key],
                                'pay_amount' => $request->pay_amount[$key],
                            ));
                    }
                    DB::table('qbuy_purchase_pi_payments')->insert($paymentsArray);
                }
            }
            /* ./ Mark Payment at the time of invoice*/


            /*supplier balance code*/
            // DB::table('qbuy_supplier_payments')->where('doc_id', $piid)->where('payment_type', 'Invoice')->delete();
            if ($request->use_advance == 1) {
                $datapay = [
                    'supplier_id' => $request->name,
                    'payment_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),
                    'payment_type' => 'Invoice',
                    'doc_id' => $piid,
                    'dr_amount' => 0,
                    'cr_amount' => $request->advance_amt

                ];
                $payid = DB::table('qbuy_supplier_payments')->insertGetId($datapay);
            }
            /*supplier balance  code*/
            $this->purchaseInvoiceAccountingEnrty($piid); //Accounting Entry
            $this->insertPurchaseInvoiceToSOA($piid, $branch); //SOA Entry
        });
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $branch_settings = Session::get('branch_settings');
        $pi = DB::table('qbuy_purchase_pi')->select('qbuy_purchase_pi.*', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();
        if (isset($pi->id)) {
            if ($pi->invoice_type == 'By Po') {
                $pi_product   = DB::table('qbuy_purchase_pi_products')
                    ->leftjoin('qbuy_purchase_order_products', 'qbuy_purchase_pi_products.qbuy_purchase_order_product_id', '=', 'qbuy_purchase_order_products.id')
                    ->select('qbuy_purchase_pi_products.*', 'qbuy_purchase_order_products.quantity as poquantity', 'qbuy_purchase_order_products.pi_remaining_quantity')->where('qbuy_purchase_pi_products.pi_id', $id)
                    ->where('qbuy_purchase_pi_products.del_flag', 1)
                    ->where('qbuy_purchase_pi_products.branch', $branch)
                    ->get();
            } else
                $pi_product   = DB::table('qbuy_purchase_pi_products')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

            $pi_payments =   DB::table('qbuy_purchase_pi_payments')->select('*')->where('qbuy_purchase_pi_id', $id)->get();
            $pi_costhead   = DB::table('qbuy_products_costhead')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $pi->supplier_id)->get();


            $adwance = DB::table('qbuy_supplier_payments')
                ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
                ->where('qbuy_supplier_payments.supplier_id', $pi->supplier_id)
                ->groupBy('qbuy_supplier_payments.supplier_id')
                ->first();

            $adwanceAmount =   (isset($adwance->dr_amount) ? $adwance->dr_amount : 0) - (isset($adwance->cr_amount) ? $adwance->cr_amount : 0) + (isset($pi->advance_amt) ? $pi->advance_amt : 0);

            $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
            $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
            $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country = DB::table('countries')->select('id', 'cntry_name')->get();
            $taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();

            $this->connectToAccounting();
            $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more


            if ($pi->invoice_type != 'By Po')
                return view('qpurchase.purchaseinvoice.edit', compact('branch', 'currencylist',  'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses',  'taxgrouplist', 'pi', 'pi_product', 'pi_payments', 'pi_costhead', 'pname', 'adwanceAmount', 'branch_settings', 'debitLedjer'));
            else
                return view('qpurchase.purchaseinvoice.editByPO', compact('branch', 'currencylist',  'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses',  'taxgrouplist', 'pi', 'pi_product', 'pi_payments', 'pi_costhead', 'pname', 'adwanceAmount', 'branch_settings', 'debitLedjer'));
        } else
            return abort(404);
    }

    public function view(Request $request, $id)
    {
        $hashids = new Hashids();
        $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;

        $branch = Session::get('branch');
        $branch_settings = Session::get('branch_settings');
        $pi = DB::table('qbuy_purchase_pi')->select('qbuy_purchase_pi.*', DB::raw("DATE_FORMAT(qbuy_purchase_pi.bill_entry_date, '%d-%m-%Y') as bill_entry_date"))->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();
        if (isset($pi->id)) {
            if ($pi->invoice_type == 'By Po') {
                $pi_product   = DB::table('qbuy_purchase_pi_products')
                    ->leftjoin('qbuy_purchase_order_products', 'qbuy_purchase_pi_products.qbuy_purchase_order_product_id', '=', 'qbuy_purchase_order_products.id')
                    ->select('qbuy_purchase_pi_products.*', 'qbuy_purchase_order_products.quantity as poquantity', 'qbuy_purchase_order_products.pi_remaining_quantity')->where('qbuy_purchase_pi_products.pi_id', $id)
                    ->where('qbuy_purchase_pi_products.del_flag', 1)
                    ->where('qbuy_purchase_pi_products.branch', $branch)
                    ->get();
            } else
                $pi_product   = DB::table('qbuy_purchase_pi_products')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

            $pi_payments =   DB::table('qbuy_purchase_pi_payments')->select('*')->where('qbuy_purchase_pi_id', $id)->get();
            $pi_costhead   = DB::table('qbuy_products_costhead')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $pi->supplier_id)->get();


            $adwance = DB::table('qbuy_supplier_payments')
                ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
                ->where('qbuy_supplier_payments.supplier_id', $pi->supplier_id)
                ->groupBy('qbuy_supplier_payments.supplier_id')
                ->first();

            $adwanceAmount =   (isset($adwance->dr_amount) ? $adwance->dr_amount : 0) - (isset($adwance->cr_amount) ? $adwance->cr_amount : 0) + (isset($pi->advance_amt) ? $pi->advance_amt : 0);

            $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
            $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
            $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country = DB::table('countries')->select('id', 'cntry_name')->get();
            $taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();

            $this->connectToAccounting();
            $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more
            return view('qpurchase.purchaseinvoice.view', compact('branch', 'currencylist',  'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses',  'taxgrouplist', 'pi', 'pi_product', 'pi_payments', 'pi_costhead', 'pname', 'adwanceAmount',  'branch_settings', 'debitLedjer'));
        } else
            return abort(404);
    }

    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $branch_settings = Session::get('branch_settings');
            $postID = $request->piid;
            $data = [
                'supplier_id' => $request->name,
                'attention'     => $request->attention,
                'salesman'         => $request->salesman,
                'currency' => $request->currency,
                'currencyvalue' => $request->currencyvalue,
                'totalamount' => $request->totalamount,
                'discount' => $request->discount,
                'amountafterdiscount' => $request->amountafterdiscount,
                'vatamount' => $request->totalvatamount,
                'grandtotalamount' => $request->grandtotalamount,
                // 'paid_amount' => 0,
                // 'balance_amount' => $request->grandtotalamount,
                'terms' => $request->terms,
                'notes' => $request->notes,
                'preparedby' => $request->preparedby,
                'approvedby' => $request->approvedby,
                'branch' => $branch,
                'status' => $request->status,
                'tpreview' => $request->tpreview,
                'user_id' => $user_id,
                'qtnref' => $request->qtnref,
                'po_wo_ref' => $request->po_wo_ref,
                'branch' => $branch,
                'internal_reference' => $request->internalreference,
                'purchasemethod' => $request->purchasemethod,
                'purchasebillid' => $request->purchasebillid,
                'purchaser' => $request->purchaser,
                'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),

                // 'paid_by_bank' => $request->paid_by_bank,
                // 'paid_by_card' => $request->paid_by_card,
                // 'paid_by_cash' => $request->paid_by_cash,
                // 'useadvance' => $request->useadvance,
                // 'paid_from_adwance' => $request->paid_from_adwance,
                // 'paid_amount' => $request->paid_amount,
                // 'balance_amount' => $request->balance_amount,

                'mark_payments' => $request->mark_payments,
                'use_advance' => $request->use_advance,
                'advance_amt' => $request->advance_amt,
                'paid_amount' => $request->paid_amount,
                'balance_amount' => $request->balance_amount,

                // 'job_id' => $request->job_id,
                'discount_type' => $request->discount_type,
            ];
            DB::table('qbuy_purchase_pi')->where('id', $postID)->update($data);

            if ($request->invoice_type == 'By Po') {
                $products =   DB::table('qbuy_purchase_pi_products')->select('id', 'quantity', 'qbuy_purchase_order_product_id')->where('pi_id', $postID)->get();
                foreach ($products as $key => $value) {
                    DB::table('qbuy_purchase_order_products')
                        ->where('id', $value->qbuy_purchase_order_product_id)
                        ->increment('pi_remaining_quantity', $value->quantity);
                }
            }

            DB::table('qbuy_purchase_pi_products')->where('pi_id', $postID)->delete();
            for ($i = 0; $i < count($request->productname); $i++) {
                $data = [
                    'pi_id' => $postID,
                    'qbuy_purchase_order_product_id' => isset($request->qbuy_purchase_order_product_id[$i]) ? $request->qbuy_purchase_order_product_id[$i] : NULL,
                    'item_details_id' => $request->item_details_id[$i],
                    'itemname' => $request->productname[$i],
                    'save_as' => isset($request->save_as[$i]) ? $request->save_as[$i] : null,
                    'description' => $request->product_description[$i],
                    'unit'         => $request->unit[$i],
                    'quantity'   => $request->quantity[$i],
                    'original_quantity'   => $request->quantity[$i],
                    'pi_remaining_quantity'   => $request->quantity[$i],
                    'grn_remaining_quantity' => $request->quantity[$i],
                    'rate'     => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'vatamount' => $request->vatamount[$i],
                    'vat_percentage' => $request->vat_percentage[$i],
                    'rdiscount' => $request->rdiscount[$i],
                    'totalamount' => $request->row_total[$i],
                    'branch' => $branch
                ];

                if ($branch_settings->inventory_stock_affect_at == 'at-invoice') {
                    $stockUpdationStatus = $this->purchaseUpdation('PI', 'update', $request->bill_entry_date, array(
                        'item_details_id' => $request->item_details_id[$i],
                        'product_name' => $request->productname[$i],
                        'unit' => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'quantity_old'   => $request->quantity_old[$i],
                        'description' => $request->product_description[$i],
                        'save_as' => $request->save_as[$i],
                        'save_as_old' => $request->save_as_old[$i],
                        'totalamount' => $request->row_total[$i],
                        'product_transaction_id' => $request->product_transaction_id[$i],
                        'new_product_id' => $request->new_product_id[$i],
                        'branch' => $branch,
                    ));
                    $data['new_product_id'] = $stockUpdationStatus['new_product_id'];
                    $data['product_transaction_id'] = $stockUpdationStatus['transaction_id'];
                }

                $enquiry_product =  DB::table('qbuy_purchase_pi_products')->insert($data);

                if ($request->invoice_type == 'By Po')
                    DB::table('qbuy_purchase_order_products')->where('id', $request->qbuy_purchase_order_product_id[$i])->decrement('pi_remaining_quantity', $request->quantity[$i]);
            }
            DB::table('qbuy_products_costhead')->where('pi_id', $postID)->delete();
            if (is_array($request->itemcost_details))
                foreach ($request->itemcost_details as $i => $value) {
                    $data_variant1 = [
                        'costheadname' => $request->itemcost_details[$i],
                        'rate' => $request->costrate[$i],
                        'tax' => $request->costtax_group[$i],
                        'amount' => $request->costtax_amount[$i],
                        'branch' => $branch,
                        'costtax_notes' => $request->costtax_notes[$i],
                        'costsupplier' => $request->costsupplier[$i],
                        'pi_id' => $postID,
                    ];
                    DB::table('qbuy_products_costhead')->insert($data_variant1);
                }


            /* Mark Payment at the time of invoice*/
            DB::table('qbuy_purchase_pi_payments')->where('qbuy_purchase_pi_id', $postID)->delete();
            if ($request->mark_payments == 1) {
                if ($request->paidamount != $request->advance_amt) {
                    $paymentsArray = array();
                    foreach ($request->type as $key => $value) {
                        if ($request->pay_amount[$key] != 0)
                            array_push($paymentsArray, array(
                                'qbuy_purchase_pi_id' => $postID,
                                'type' => $request->type[$key],
                                'debitaccount' => $request->debitaccount[$key],
                                'reference' => $request->reference[$key],
                                'pay_amount' => $request->pay_amount[$key],
                            ));
                    }
                    DB::table('qbuy_purchase_pi_payments')->insert($paymentsArray);
                }
            }
            /* ./ Mark Payment at the time of invoice*/

            /*supplier balance code*/
            DB::table('qbuy_supplier_payments')->where('doc_id', $postID)->where('payment_type', 'Invoice')->delete();
            if ($request->use_advance == 1) {
                $datapay = [
                    'supplier_id' => $request->name,
                    'payment_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),
                    'payment_type' => 'Invoice',
                    'doc_id' => $postID,
                    'dr_amount' => 0,
                    'cr_amount' => $request->advance_amt

                ];
                $payid = DB::table('qbuy_supplier_payments')->insertGetId($datapay);
            }
            /*supplier balance  code*/
            $this->purchaseInvoiceAccountingEnrty($postID); //Accounting Entry
            $this->insertPurchaseInvoiceToSOA($postID, $branch); //SOA Entry
        });
    }

    public function approve(Request $request)
    {
        DB::transaction(function () use ($request) {
            $branch = Session::get('branch');
            $postID = $request->id;
            DB::table('qbuy_purchase_pi')->where('id', $postID)->update(array('status' => 'Approved'));
        });
        $out = array(
            'status' => 1,
        );
        echo json_encode($out);
    }

    public function qpurchase_invoice_delete(Request $request)
    {
        DB::transaction(function () use ($request) {
            $postID = $request->id;
            $invoice =   DB::table('qbuy_purchase_pi')->select('id', 'invoice_type', 'acc_entries_id', 'soa_id')->where('id', $postID)->first();
            if (isset($invoice->id)) {
                $this->entryItemsDelete($invoice->acc_entries_id);
                $this->deletePurchaseSOA($invoice->soa_id);
                $products =   DB::table('qbuy_purchase_pi_products')->select('id', 'quantity', 'qbuy_purchase_order_product_id', 'new_product_id', 'product_transaction_id')->where('pi_id', $postID)->get();
                foreach ($products as $key => $value) {
                    if ($invoice->invoice_type == 'By Po') {
                        DB::table('qbuy_purchase_order_products')
                            ->where('id', $value->qbuy_purchase_order_product_id)
                            ->increment('pi_remaining_quantity', $value->quantity);
                    }
                    if ($value->new_product_id != '')
                        $this->decrementStock($value->new_product_id, $value->quantity);
                    if ($value->product_transaction_id != '')
                        $this->deleteProductTransaction($value->product_transaction_id);
                }
                DB::table('qbuy_purchase_pi')->where('id', $postID)->delete();
                DB::table('qbuy_purchase_pi_products')->where('pi_id', $postID)->delete();
                DB::table('qbuy_products_costhead')->where('pi_id', $postID)->delete();
            }
        });
        $out = array(
            'status' => 1,
        );
        echo json_encode($out);
    }

    public function convertgrn(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $purchaseInvoice   = DB::table('qbuy_purchase_pi')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();

        if (isset($purchaseInvoice->id)) {
            $branch_settings = Session::get('branch_settings');
            $purchaseInvoiceProduct   = DB::table('qbuy_purchase_pi_products')
                ->leftjoin('qinventory_products', 'qbuy_purchase_pi_products.item_details_id', '=', 'qinventory_products.product_id')
                ->select('qbuy_purchase_pi_products.*', 'qbuy_purchase_pi_products.id as purchase_invoice_products_id', 'qinventory_products.product_id', 'qinventory_products.product_name')
                ->where('qbuy_purchase_pi_products.pi_id', $id)
                ->get();

            $supplierDetails = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $purchaseInvoice->supplier_id)->get();

            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
            $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
            return view('qpurchase.purchaseinvoice.convertgrn', compact('branch_settings', 'unitlist', 'termslist',  'salesmen', 'purchaseInvoice', 'purchaseInvoiceProduct', 'supplierDetails'));
        } else
            return abort(404);
    }

    public function grnSaveFromInvoice(Request $request)
    {
        DB::transaction(function () use ($request) {
            $branch = Session::get('branch');
            $postID = $request->id;
            $branch_settings = Session::get('branch_settings');
            $data = [
              //  'code' => $branch_settings->grn_sufix . '' . sprintf("%03d", $branch),
                'po_id' => $request->po_id,
                'inv_id' => $request->inv_id,
                'supplier_id' => $request->supplier_id,
                'source' => $request->source,
                'grn_date'   => Carbon::parse($request->grn_date)->format('Y-m-d'),
                'attention'     => $request->attention,
                'vehicle'     => $request->vehicle,
                'driver'     => $request->driver,
                'preparedby' => $request->preparedby,
                'deliverynote' => $request->deliverynote,
                'terms' => $request->terms,
                'tpreview' => $request->tpreview,
                'branch' => $branch,
                'status' => $request->status,
            ];
            DB::table('qbuy_purchase_grn')->insert($data);
            $grnid = DB::getPdo()->lastInsertId();
            $oldProducts =  DB::table('qbuy_purchase_grn_products')->select('purchase_order_products_id', 'purchase_invoice_products_id', 'quantity')->where('grn_id', $postID)->get();
            foreach ($oldProducts as $key => $value) {
                if ($request->source == 'By PO')
                    DB::table('qbuy_purchase_order_products')->where('id', $value->purchase_order_products_id)->increment('grn_remaining_quantity', $value->quantity);
                if ($request->source == 'By PO')
                    DB::table('qbuy_purchase_pi_products')->where('id', $value->purchase_invoice_products_id)->increment('grn_remaining_quantity', $value->quantity);
            }
            DB::table('qbuy_purchase_grn_products')->where('grn_id', $grnid)->delete();
            for ($i = 0; $i < count($request->productname); $i++) {
                if ($request->source == 'By PO')
                    DB::table('qbuy_purchase_order_products')->where('id', $request->purchase_order_products_id[$i])->decrement('grn_remaining_quantity', $request->quantity[$i]);
                if ($request->source == 'By Invoice')
                    DB::table('qbuy_purchase_pi_products')->where('id', $request->purchase_invoice_products_id[$i])->decrement('grn_remaining_quantity', $request->quantity[$i]);
                $data = [
                    'grn_id' => $grnid,
                    'purchase_order_products_id' => isset($request->purchase_order_products_id[$i]) ? $request->purchase_order_products_id[$i] : '',
                    'purchase_invoice_products_id' => isset($request->purchase_invoice_products_id[$i]) ? $request->purchase_invoice_products_id[$i] : '',
                    'item_details_id' => $request->item_details_id[$i],
                    'productname' => $request->productname[$i],
                    'product_description' => $request->product_description[$i],
                    'unit' => $request->unit[$i],
                    'quantity' => $request->quantity[$i],
                ];

                if ($branch_settings->inventory_stock_affect_at == 'at-delivey-or-grn') {
                    $stockUpdationStatus = $this->purchaseUpdation('GRN', 'insert', $request->grn_date, array(
                        'item_details_id' => $request->item_details_id[$i],
                        'product_name' => $request->productname[$i],
                        'unit' => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'description' => $request->product_description[$i],
                        'save_as' => $request->save_as[$i],
                        'totalamount' => $request->product_price[$i] * $request->quantity[$i],
                        'branch' => $branch,
                    ));
                    $data['save_as'] = $request->save_as[$i];
                    $data['new_product_id'] = $stockUpdationStatus['new_product_id'];
                    $data['product_transaction_id'] = $stockUpdationStatus['transaction_id'];
                }

                $enquiry_product =  DB::table('qbuy_purchase_grn_products')->insert($data);
            }
            if ($request->status == 'Approved')
                app('App\Http\Controllers\qpurchase\GRNController')->addToStock($postID);
        });
        $out = array(
            'status' => 1,
            'msg' => 'Saved Success'
        );
        echo json_encode($out);
    }



    public function pdf(Request $request)
    {

        $id = $request->id;
        $branch = Session::get('branch');
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

        $pi   = DB::table('qbuy_purchase_pi')->leftJoin('qcrm_salesman_details as s1', 'qbuy_purchase_pi.preparedby', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qbuy_purchase_pi.approvedby', '=', 's2.id')->leftJoin('qcrm_salesman_details as s3', 'qbuy_purchase_pi.salesman', '=', 's3.id')->select('qbuy_purchase_pi.*', 's1.name as preparedby', 's2.name as approvedby', 's3.name as salesman')->where('qbuy_purchase_pi.id', $id)->where('qbuy_purchase_pi.del_flag', 1)->where('qbuy_purchase_pi.branch', $branch)->get();

        $pi_product   = DB::table('qbuy_purchase_pi_products')->select('*')->where('pi_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
        $bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
        foreach ($pi as $key => $value) {
            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->supplier_id)->get();
        }
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();
        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('qpurchase.purchaseinvoice.preview1', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'pi', 'pi_product', 'pname', 'branchsettings', 'bname', 'companysettings'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('qpurchase.purchaseinvoice.preview2', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'pi', 'pi_product', 'pname', 'branchsettings', 'bname', 'companysettings'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('qpurchase.purchaseinvoice.preview3', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'pi', 'pi_product', 'pname', 'branchsettings', 'bname', 'companysettings'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('qpurchase.purchaseinvoice.preview4', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'pi', 'pi_product', 'pname', 'branchsettings', 'bname', 'companysettings'));
        } else {
            $pdf = PDF::loadView('qpurchase.purchaseinvoice.preview4', compact('branch', 'currencylist',  'unitlist', 'termslist', 'vatlist', 'salesmen', 'pi', 'pi_product', 'pname', 'branchsettings', 'bname', 'companysettings'));
        }

        return $pdf->stream('Purchase Invoice.pdf');
    }
}

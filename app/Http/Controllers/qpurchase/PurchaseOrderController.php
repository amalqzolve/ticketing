<?php

namespace App\Http\Controllers\qpurchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use Auth;
use App\Traits\PurchaseTraits;
use App\Traits\AccountingActionsTrait;
use App\settings\BranchSettingsModel;
use App\Traits\ProductCountOperationTrait;
use Hashids\Hashids;


class PurchaseOrderController extends Controller
{
    use AccountingActionsTrait, PurchaseTraits, ProductCountOperationTrait;
    public function qpurchase_order(Request $request)
    {
        $branch = Session::get('branch');
        $user = Auth::user();
        if (!$request->ajax()) {
            $purchaseorder = array();
            return view('qpurchase.purchaseorder.list', compact('purchaseorder'));
        } else {
            $purchaseorder = DB::table('qbuy_purchase_orders')
                ->leftjoin('qcrm_supplier', 'qbuy_purchase_orders.name', '=', 'qcrm_supplier.id')
                ->leftjoin('qbuy_purchase_order_products', 'qbuy_purchase_orders.id', '=', 'qbuy_purchase_order_products.po_id')
                ->select('qbuy_purchase_orders.*', 'qcrm_supplier.sup_name', DB::raw("DATE_FORMAT(qbuy_purchase_orders.quotedate, '%d-%m-%Y') as quotedate"), DB::raw('SUM(qbuy_purchase_order_products.quantity) as totalquantity'), DB::raw('SUM(qbuy_purchase_order_products.grn_remaining_quantity) as grn_remaining'), DB::raw('SUM(qbuy_purchase_order_products.pi_remaining_quantity) as invoice_remaining')) //'qbuy_po_vo.po_id'
                ->where('qbuy_purchase_orders.del_flag', 1)
                ->where('qbuy_purchase_orders.branch', $branch)
                ->groupBy('qbuy_purchase_orders.id')
                ->get();
            $dtTble = Datatables::of($purchaseorder)->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $j = '';
                    $hashids = new Hashids();
                    $j .= '<a href="qpurchase-order-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
                    <li class="kt-nav__item">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-eye"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
                        </span>
                    </li>
                </a>';

                    $j .= '<a href="qpurchaseorder_pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-printer"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                            </span>
                        </li>
                    </a>';

                    if ($row->status == "Draft") {
                        $j .= '<a href="qpurchase_order_edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
                                    </span>
                                </li>
                            </a>';
                        $j .= '<a data-type="send" data-target="#kt_form">
                                    <li class="kt-nav__item purchaseorder_approve" id="' . $row->id . '">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-multimedia"></i>
                                            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
                                        </span>
                                    </li>
					          </a>';
                    } else if ($row->status == "Approved") {
                        if ($row->grn_remaining > 0)
                            $j .=  '<a href="convertgrn?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                        <span class="kt-nav__link-text" data-id=' . $row->id . '>Generate GRN</span>
                                                    </span>
                                                </li>
                                            </a>';
                        if ($row->invoice_remaining > 0)
                            $j .= '<a href="convertpi?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Generate Purchase Invoice</span>
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
                ->addColumn('grnStatus', function ($row) use ($user) {
                    if ($row->totalquantity <= $row->grn_remaining)
                        return 'Not Genrated';
                    else if ($row->grn_remaining == 0)
                        return 'Fully Genrated';
                    else
                        return 'Partially Genrated';
                })
                ->addColumn('invoiceStatus', function ($row) use ($user) {
                    if ($row->totalquantity <= $row->invoice_remaining)
                        return 'Not Genrated';
                    else if ($row->invoice_remaining == 0)
                        return 'Fully Genrated';
                    else
                        return 'Partially Genrated';
                })
                ->addColumn('poStatus', function ($row) use ($user) {
                    if ($row->status == 'Draft')
                        return '<span style="color:gray;">Draft</span>';
                    if ($row->status == 'Approved')
                        return '<span style="color:green;">Approved</span>';
                })->rawColumns(['action', 'grnStatus', 'invoiceStatus', 'poStatus']);
            return  $dtTble->make(true);
        }
    }
    public function approve(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->id;
            DB::table('qbuy_purchase_orders')->where('id', $id)->update(['status' => 'Approved']);
        });
        $out = array(
            'status' => 1,
            'msg' => "Approved Successfully",
        );
        echo json_encode($out);
    }
    public function qdirect_po()
    {
        $branch = Session::get('branch');
        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();

        $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
        $suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
        $vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->orderBy('total', 'asc')->get();
        $suppliercatogry = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $supplierType = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $supplierGroup = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = DB::table('countries')->select('id', 'cntry_name')->get();

        return view('qpurchase.purchaseorder.directpo', compact('branch', 'currencylist', 'vatlist', 'unitlist', 'termslist',  'suppliers', 'salesmen', 'suppliercatogry', 'supplierType', 'supplierGroup', 'country', 'warehouses'));
    }
    public function newposubmit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $branch_settings = Session::get('branch_settings');
            if ($request->supplier_source == 1) { //New Supplier    
                $supData =  array(
                    // 'sup_code' => $branch_settings->supplier_sufix . '' . sprintf("%03d", $branch),
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
            } elseif ($request->supplier_source == 2) //supplier from DB
                $supplier = $request->supplier;
            $data = [
                // 'code' => $branch_settings->purchaseorder_sufix . '' . sprintf("%03d", $branch),
                'name' => $supplier, //supplier
                'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                'valid_till' => Carbon::parse($request->valid_till)->format('Y-m-d  h:i'),
                'qtnref' => $request->qtnref,
                'po_wo_ref' => $request->po_wo_ref,
                'attention' => $request->attention,
                'salesman' => $request->salesman,
                'currency' => $request->currency,
                'currencyvalue' => $request->currencyvalue,
                'preparedby' => $request->preparedby,
                'approvedby' => $request->approvedby,
                'discount_type' => $request->discount_type,
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
                'status' => $request->status, //'Draft',
                'user_id' => $user_id,
                'ctype' => 2,
            ];
            DB::table('qbuy_purchase_orders')->insert($data);

            $purchaseorderid = DB::getPdo()->lastInsertId();
            for ($i = 0; $i < count($request->productname); $i++) {
                $data = [
                    'po_id' => $purchaseorderid,

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
        });
    }

    public function view(Request $request, $id)
    {
        $hashids = new Hashids();
        $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;
        $branch = Session::get('branch');

        $purchaseorder   = DB::table('qbuy_purchase_orders')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();
        if (isset($purchaseorder->id)) {
            $purchaseorder_product   = DB::table('qbuy_purchase_order_products')
                ->leftjoin('qinventory_products', 'qbuy_purchase_order_products.itemname', '=', 'qinventory_products.product_id')
                ->select('qbuy_purchase_order_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name')
                ->where('qbuy_purchase_order_products.po_id', $id)
                ->where('qbuy_purchase_order_products.del_flag', 1)
                ->where('qbuy_purchase_order_products.branch', $branch)
                ->get();

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $purchaseorder->name)->get();

            $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
            $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
            $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
            $vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->orderBy('total', 'asc')->get();
            $areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country = DB::table('countries')->select('id', 'cntry_name')->get();

            return view('qpurchase.purchaseorder.view', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses', 'purchaseorder', 'purchaseorder_product', 'pname'));
        }
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
        $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
        $vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->orderBy('total', 'asc')->get();
        $areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = DB::table('countries')->select('id', 'cntry_name')->get();
        $purchaseorder   = DB::table('qbuy_purchase_orders')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $purchaseorder_product   = DB::table('qbuy_purchase_order_products')
            ->leftjoin('qinventory_products', 'qbuy_purchase_order_products.itemname', '=', 'qinventory_products.product_id')
            ->select('qbuy_purchase_order_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name')
            ->where('qbuy_purchase_order_products.po_id', $id)
            ->where('qbuy_purchase_order_products.del_flag', 1)
            ->where('qbuy_purchase_order_products.branch', $branch)
            ->get();
        foreach ($purchaseorder as $key => $value) {
            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->name)->get();
        }
        return view('qpurchase.purchaseorder.edit', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses', 'purchaseorder', 'purchaseorder_product', 'pname'));
    }
    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $postID = $request->id;
            $data = [
                'name' => $request->supplier,
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
                'status' => $request->status, // 'Draft',
                'user_id' => $user_id,
                'ctype' => 2,
            ];
            DB::table('qbuy_purchase_orders')->where('id', $postID)->update($data);
            DB::table('qbuy_purchase_order_products')->where('po_id', $postID)->delete();
            for ($i = 0; $i < count($request->productname); $i++) {
                $data = [
                    'po_id' => $postID,
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
        });
    }



    public function convertgrn(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $purchaseorder   = DB::table('qbuy_purchase_orders')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();
        if (isset($purchaseorder->id)) {
            $branch_settings = Session::get('branch_settings');
            $purchaseorder_product   = DB::table('qbuy_purchase_order_products')
                ->leftjoin('qinventory_products', 'qbuy_purchase_order_products.itemname', '=', 'qinventory_products.product_id')
                ->select('qbuy_purchase_order_products.*', 'qbuy_purchase_order_products.id as purchase_order_products_id', 'qinventory_products.product_id', 'qinventory_products.product_name')
                ->where('qbuy_purchase_order_products.po_id', $id)
                ->where('qbuy_purchase_order_products.del_flag', 1)
                ->where('qbuy_purchase_order_products.branch', $branch)
                ->get();
            $supplierDetails = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $purchaseorder->name)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
            $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();

            return view('qpurchase.purchaseorder.convertgrn', compact('branch_settings', 'unitlist', 'termslist', 'customers', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'supplierDetails'));
        } else
            return abort(404);
    }


    public function grnSaveFromPO(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $postID = $request->po_id;
            $branch_settings = Session::get('branch_settings');
            $data = [
               // 'code' => $branch_settings->grn_sufix . '' . sprintf("%03d", $branch),
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
            for ($i = 0; $i < count($request->productname); $i++) {
                DB::table('qbuy_purchase_order_products')->where('id', $request->purchase_order_products_id[$i])->decrement('grn_remaining_quantity', $request->quantity[$i]);
                $data = [
                    'grn_id' => $grnid,
                    'purchase_order_products_id' => $request->purchase_order_products_id[$i],
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
        });
        $out = array(
            'status' => 1,
            'msg' => 'Saved Success'
        );
        echo json_encode($out);
    }


    public function convertpi(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $branch_settings = Session::get('branch_settings');

        $purchaseorder   = DB::table('qbuy_purchase_orders')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->first();
        if (isset($purchaseorder->id)) {
            $purchaseorder_product   = DB::table('qbuy_purchase_order_products')
                ->leftjoin('qinventory_products', 'qbuy_purchase_order_products.itemname', '=', 'qinventory_products.product_id')
                ->select('qbuy_purchase_order_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name')
                ->where('qbuy_purchase_order_products.po_id', $id)
                ->where('qbuy_purchase_order_products.del_flag', 1)
                ->where('qbuy_purchase_order_products.branch', $branch)
                ->get();

            $adwance = DB::table('qbuy_supplier_payments')
                ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
                ->where('qbuy_supplier_payments.supplier_id', $purchaseorder->name)
                ->groupBy('qbuy_supplier_payments.supplier_id')
                ->first();

            $adwanceAmount =   (isset($adwance->dr_amount) ? $adwance->dr_amount : 0) - (isset($adwance->cr_amount) ? $adwance->cr_amount : 0);

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $purchaseorder->name)->get();

            $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();
            $currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
            $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
            $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
            $taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->orderBy('total', 'asc')->where('branch', $branch)->get();
            $areaList = DB::table('qcrm_suppliercatogry')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = DB::table('qcrm_supplier_type')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = DB::table('qcrm_suppliergroup')->select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country = DB::table('countries')->select('id', 'cntry_name')->get();
          

            $this->connectToAccounting();
            $debitLedjer = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get(); //for add more


            return view('qpurchase.purchaseorder.convertpi', compact('branch', 'branch_settings', 'currencylist',  'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'warehouses', 'purchaseorder', 'purchaseorder_product', 'pname',  'taxgrouplist',  'adwanceAmount', 'debitLedjer'));
        } else
            return abort(404);
    }
    public function pisubmit_qpurchase(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $postID = $request->po_id;
            $branch_settings = Session::get('branch_settings');
            $data = [
               // 'code' => $branch_settings->purchaseinvoice_sufix . '' . sprintf("%03d", $branch),
                'po_id' => $request->po_id,
                'supplier_id' => $request->name,
                'attention'     => $request->attention,
                'salesman'         => $request->salesman,
                'quotedate'   => Carbon::parse($request->quotedate)->format('Y-m-d'),
                'validity'     => Carbon::parse($request->validity)->format('Y-m-d  h:i'),
                'currency' => $request->currency,
                'currencyvalue' => $request->currencyvalue,
                'totalamount' => $request->totalamount,
                'discount' => $request->discount,
                'amountafterdiscount' => $request->amountafterdiscount,
                'vatamount' => $request->totalvatamount,
                'grandtotalamount' => $request->grandtotalamount,
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
                'invoice_type' => 'By Po',

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
                'discount_type' => $request->discount_type,
                'status' => $request->status,
            ];
            DB::table('qbuy_purchase_pi')->insert($data);
            $piid = DB::getPdo()->lastInsertId();

            DB::table('qbuy_purchase_pi_products')->where('pi_id', $piid)->delete();
            for ($i = 0; $i < count($request->productname); $i++) {
                $data = [
                    'pi_id' => $piid,
                    'porder_id' => $request->po_id,
                    'qbuy_purchase_order_product_id' => $request->rid[$i],
                    'item_details_id' => $request->item_details_id[$i],
                    'itemname' => $request->productname[$i],
                    'save_as' => isset($request->save_as[$i]) ? $request->save_as[$i] : null,
                    'description' => $request->product_description[$i],
                    'unit'         => $request->unit[$i],
                    'quantity'   => $request->quantity[$i],
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
                DB::table('qbuy_purchase_order_products')->where('id', $request->rid[$i])->decrement('pi_remaining_quantity', $request->quantity[$i]);
            }


            /*supplier balance code*/
            // DB::table('qbuy_supplier_payments')->where('doc_id', $piid)->where('payment_type', 'Invoice')->delete();
            if ($request->useadvance == 1) {
                $datapay = [
                    'supplier_id' => $request->name,
                    'payment_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),
                    'payment_type' => 'Invoice',
                    'doc_id' => $piid,
                    'dr_amount' => 0,
                    'cr_amount' => $request->paid_from_adwance

                ];
                $payid = DB::table('qbuy_supplier_payments')->insertGetId($datapay);
            }
            /*supplier balance  code*/
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

            $this->purchaseInvoiceAccountingEnrty($piid); //Accounting Entry
            $this->insertPurchaseInvoiceToSOA($piid, $branch); //SOA Entry
        });
    }


    public function rfq_view(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

        $enquiryrfq   = DB::table('qsales_enquiry_rfq')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

        $enquiryrfq_product   = DB::table('qsales_enquiry_rfq_products')->select('*')->where('enquiryrfqid', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
        foreach ($enquiryrfq as $key => $value) {

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->leftjoin('qcrm_supplier_documents', 'qcrm_supplier.id', '=', 'qcrm_supplier_documents.supplier_id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name', 'qcrm_supplier_documents.vat_no', 'qcrm_supplier_documents.cr_no')->where('qcrm_supplier.id', $value->name)->get();
        }

        return view('sales.enquiry.rfqview', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'enquiryrfq', 'enquiryrfq_product', 'pname'));
    }
    public function popdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

        $purchaseorder   = DB::table('qbuy_purchase_orders')->leftJoin('qcrm_salesman_details as s1', 'qbuy_purchase_orders.preparedby', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qbuy_purchase_orders.approvedby', '=', 's2.id')->leftJoin('qcrm_salesman_details as s3', 'qbuy_purchase_orders.salesman', '=', 's3.id')->select('qbuy_purchase_orders.*', 's1.name as preparedby', 's2.name as approvedby', 's3.name as salesman')->where('qbuy_purchase_orders.id', $id)->where('qbuy_purchase_orders.del_flag', 1)->where('qbuy_purchase_orders.branch', $branch)->get();

        $purchaseorder_product   = DB::table('qbuy_purchase_order_products')->select('*')->where('po_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
        $bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
        foreach ($purchaseorder as $key => $value) {

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->name)->get();
        }
        $po_status = DB::table('qbuy_purchase_orders')->select('status')->where('id', $id)->value('status');
        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('qpurchase.purchaseorder.po1', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('qpurchase.purchaseorder.po2', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('qpurchase.purchaseorder.po3', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview4') {
            if ($po_status == "Po Issued") {

                $pdf = PDF::loadView('qpurchase.purchaseorder.po4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'pname', 'branchsettings', 'bname'));
            } else {
                $pdf = PDF::loadView('qpurchase.purchaseorder.po4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'pname', 'branchsettings', 'bname'), [], [
                    'default_font'               => 'sans-serif',
                    'watermark'                  => $po_status,
                    'show_watermark'             => true,
                    'pdfa'                       => false,
                    'pdfaauto'                   => false,
                ]);
            }
        } else {
            $pdf = PDF::loadView('qpurchase.purchaseorder.po4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'purchaseorder', 'purchaseorder_product', 'pname', 'branchsettings', 'bname'));
        }

        return $pdf->stream('Purchase Order.pdf');
    }

    public function povopdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

        $povo   = DB::table('qbuy_po_vo')->leftJoin('qcrm_salesman_details as s1', 'qbuy_po_vo.preparedby', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qbuy_po_vo.approvedby', '=', 's2.id')->leftJoin('qcrm_salesman_details as s3', 'qbuy_po_vo.salesman', '=', 's3.id')->select('qbuy_po_vo.*', 's1.name as preparedby', 's2.name as approvedby', 's3.name as salesman')->where('qbuy_po_vo.id', $id)->where('qbuy_po_vo.del_flag', 1)->where('qbuy_po_vo.branch', $branch)->get();

        $povo_product   = DB::table('qbuy_po_vo_products')->select('*')->where('po_vo_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
        $bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
        foreach ($povo as $key => $value) {

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->name)->get();
        }

        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('qpurchase.purchaseorder.povo1', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'povo', 'povo_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('qpurchase.purchaseorder.povo2', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'povo', 'povo_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('qpurchase.purchaseorder.povo3', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'povo', 'povo_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview4') {

            $pdf = PDF::loadView('qpurchase.purchaseorder.povo4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'povo', 'povo_product', 'pname', 'branchsettings', 'bname'));
        } else {
            $pdf = PDF::loadView('qpurchase.purchaseorder.povo4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'povo', 'povo_product', 'pname', 'branchsettings', 'bname'));
        }

        return $pdf->stream('PoVo.pdf');
    }
}

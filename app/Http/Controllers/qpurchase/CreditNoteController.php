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
use App\crm\CustomerTypeModel;
use App\settings\CustomerCategoryModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\settings\BranchSettingsModel;

class CreditNoteController extends Controller
{
    public function creditnote()
    {
        $branch = Session::get('branch');
        $creditnote = DB::table('qbuy_debitnote')->leftjoin('qcrm_supplier', 'qbuy_debitnote.supplier_name', '=', 'qcrm_supplier.id')->select('qbuy_debitnote.*', 'qcrm_supplier.sup_name')->where('qbuy_debitnote.del_flag', 1)->where('qbuy_debitnote.branch', $branch)->get();
        return view('qpurchase.creditnote.list', compact('creditnote'));
    }
    public function add()
    {
        $branch = Session::get('branch');
        $suppliers   = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('qpurchase.creditnote.add', compact('branch', 'suppliers'));
    }
    public function purchasenumber_submit_purchase_credit(Request $request)
    {
        $id = $request->purchasenumber;

        $branch = Session::get('branch');

        $paymenttermslist   = DB::table('qcrm_payment_terms')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
        $productlist = DB::table('qinventory_products')->select('product_id as id', 'product_name', 'opening_stock', 'product_code')->where('del_flag', 1)->where('branch', $branch)->get();
        $accountslist   = DB::table('qinventory_accounts')->select('id', 'account_name')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $taxlist   = DB::table('qpurchase_tax')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $costheadlist   = DB::table('buy_voucher')->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')->select('buy_voucher.id', 'buy_voucher.bill_id', 'qcrm_supplier.sup_name')->where('buy_voucher.del_flag', 1)->where('buy_voucher.branch', $branch)->get();
        $batchlist = DB::table('qpurchase_batch')->select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
        $taxgrouplist = DB::table('qpurchase_taxgroup')->select('*')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('base_unit', 1)->where('del_flag', 1)->where('branch', $branch)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = $taxgrouplist; //DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
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
        return view('qpurchase.creditnote.creditdetails', compact('paymenttermslist', 'productlist', 'accountslist', 'currencylist', 'taxlist', 'costheadlist', 'batchlist', 'taxgrouplist', 'unitlist', 'termslist', 'vatlist', 'suppliers', 'salesmen', 'warehouses', 'purchase', 'purchaseproducts', 'purchasecosthead', 'paymentpreview', 'termspreview', 'branch'));
    }
    public function qpurchase_creditnote_submit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->id;
        $data = [

            'supplier_name' => $request->name,
            'purchase_date' => Carbon::parse($request->purchase_date)->format('Y-m-d'),

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
            'purchaser' => $request->purchaser,
            'bill_entry_date' => Carbon::parse($request->bill_entry_date)->format('Y-m-d'),

        ];
        DB::table('qbuy_creditnote')->insert($data);

        $credit_id = DB::getPdo()->lastInsertId();

        for ($i = 0; $i < count($request->productname_id); $i++) {
            $data_variant = [
                'credit_id' => $credit_id,
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
                'description' =>  $request->product_description[$i]
            ];
            DB::table('qbuy_creditnote_products')->insert($data_variant);
        }
        if (isset($request->itemcost_details) && !empty($request->itemcost_details)) {
            for ($i = 0; $i < count($request->itemcost_details); $i++) {
                $data_variant1 = [
                    'credit_id' => $credit_id,
                    'purchase_id' => $postID,
                    'costheadname' => $request->itemcost_details[$i],
                    'rate' => $request->costrate[$i],
                    'tax' => $request->costtax_group[$i],
                    'amount' => $request->costtax_amount[$i],
                    'branch' => $branch,
                    'costtax_notes' => $request->costtax_notes[$i],
                    'costsupplier' => $request->costsupplier[$i]
                ];

                DB::table('qbuy_creditnote_costhead')->insert($data_variant1);
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

        $creditnote   = DB::table('qbuy_creditnote')->leftJoin('qcrm_salesman_details as s1', 'qbuy_creditnote.preparedby', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qbuy_creditnote.approvedby', '=', 's2.id')->leftJoin('qcrm_salesman_details as s3', 'qbuy_creditnote.salesman', '=', 's3.id')->select('qbuy_creditnote.*', 's1.name as preparedby', 's2.name as approvedby', 's3.name as salesman')->where('qbuy_creditnote.id', $id)->where('qbuy_creditnote.del_flag', 1)->where('qbuy_creditnote.branch', $branch)->get();

        $creditnote_product   = DB::table('qbuy_creditnote_products')->select('*')->where('credit_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->orderBy('total', 'asc')->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
        foreach ($creditnote as $key => $value) {

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->supplier_name)->get();
        }

        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('qpurchase.creditnote.preview1', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'creditnote', 'creditnote_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('qpurchase.creditnote.preview2', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'creditnote', 'creditnote_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('qpurchase.creditnote.preview3', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'creditnote', 'creditnote_product', 'pname', 'branchsettings', 'bname'));
        } elseif (Session::get('preview') == 'preview4') {

            $pdf = PDF::loadView('qpurchase.creditnote.preview4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'creditnote', 'creditnote_product', 'pname', 'branchsettings', 'bname'));
        } else {
            $pdf = PDF::loadView('qpurchase.creditnote.preview4', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'salesmen', 'creditnote', 'creditnote_product', 'pname', 'branchsettings', 'bname'));
        }

        return $pdf->stream('creditnote.pdf');
    }
}

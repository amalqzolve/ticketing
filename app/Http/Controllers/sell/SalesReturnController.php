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
use App\inventory\ProductdetailslistModel;

class SalesReturnController extends Controller
{
    public function sales_return_list_sell()
    {
        $branch = Session::get('branch');
        $salesreturn   = DB::table('qsell_sales_return')->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qsell_sales_return.customer')->select('qsell_sales_return.*', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qsell_sales_return.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(qsell_sales_return.returndate, '%d-%m-%Y') as returndate"))->where('qsell_sales_return.del_flag', 1)->where('qsell_sales_return.branch', $branch)->get();
        return view('sell.salesreturn.list', compact('salesreturn'));
    }
    public function add()
    {
        $branch = Session::get('branch');
        $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();
        $invoicenumber = DB::table('qsales_salesorder')->select('id')->where('del_flag', 1)->get();
        return view('sell.salesreturn.add', compact('customers'));
    }
    public function getinvoicenumber_sell(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qsell_saleinvoice')->select('qsell_saleinvoice.*')->where('qsell_saleinvoice.customer', $id)->get();

        return response()->json($data);
    }
    public function invoicenumber_submit_sell(Request $request)
    {
        $id = $request->invoicenumber;

        $branch = Session::get('branch');

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

        $customersinv   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

        $cinvoice   = DB::table('qsell_saleinvoice')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

        $cinvoice_product   = DB::table('qsell_saleinvoice_products')->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleinvoice_products.*', 'qinventory_products.product_id')->where('qsell_saleinvoice_products.invoice_id', $id)->where('qsell_saleinvoice_products.del_flag', 1)->where('qsell_saleinvoice_products.branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
        $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $country1 = countryModel::select('id', 'cntry_name')->get();

        $customers   = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*')->where('qsell_saleinvoice.id', $id)->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->get();
        // dd($cinvoice_product);
        return view('sell.salesreturn.returndetails', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'areaList', 'areaLists', 'group', 'country1', 'customersinv'));
    }
    public function salesreturnsubmit_sell(Request $request)
    {
        $user_id = Auth::user()->id;
        $branch = Session::get('branch');
        $quote_data = [
            'invoiceid' => $request->invoiceid,
            'returndate' => Carbon::parse($request->returndate)->format('Y-m-d'),
            'reason' => $request->reason,
            'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
            'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
            'qtn_ref' => $request->qtn_ref,
            'po_ref' => $request->po_ref,
            'attention' => $request->attention,
            'salesman' => $request->salesman,
            'currency' => $request->currency,
            'currencyvalue' => $request->currencyvalue,
            'discount_type' => $request->discount_type,
            'customer' => $request->customer,
            'terms_conditions' => $request->terms,
            'notes' => $request->notes,
            'internal_reference' => $request->internal_reference,
            'tpreview' => $request->tpreview,
            'totalamount' => $request->totalamount,
            'discount' => $request->discount,
            'amountafterdiscount' => $request->amountafterdiscount,
            'vatamount' => $request->totalvatamount,
            'grandtotalamount' => $request->grandtotalamount,
            'branch' => $branch,
            'user_id' => $user_id,
            'payment_terms' => $request->payment_terms,
            'status' => 0,
        ];


        DB::table('qsell_sales_return')->insert($quote_data);
        $return_id = DB::getPdo()->lastInsertId();

        for ($i = 0; $i < count($request->item_id); $i++) {
            $return_product_data = [
                'return_id' => $return_id,
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
            DB::table('qsell_sales_return_products')->insert($return_product_data);



            /*Plus Stock*/



            $stock = ProductdetailslistModel::where('product_id',  $request->item_id[$i])->increment('available_stock', $request->quantity[$i]);


            /*Plus Stock*/

            DB::table('qsell_saleinvoice')->where('id', $request->invoiceid)->update(['status' => 'Returned']);
        }

        $transaction_type = 'Debit';
        $met = 0;
        $cr_amount = 0;
        $dr_amount = $request->grandtotalamount;


        $soa = [
            'doc_type'        => 'Sales Return',
            'doc_id'          =>  $request->invoiceid,
            'doc_transaction' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
            'transaction_type' => $transaction_type,
            'totalamount'     => $request->grandtotalamount,
            'customer_id'     => $request->customer,
            'paid_amount'     => $request->grandtotalamount,
            'branch'          => $branch,
            'cr_amount'          => $cr_amount,
            'dr_amount'          => $dr_amount,
        ];
        DB::table('qsell_salesorder_soa')->insert($soa);




        return 'true';
    }

    public function salesreturns_Pdf(Request $request)
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
        $salesreturn   = DB::table('qsell_sales_return')->select('*')->where('id', $id)->get();
        $salesreturnproducts = DB::table('qsell_sales_return_products')->leftjoin('qinventory_products', 'qsell_sales_return_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_sales_return_products.*', 'qinventory_products.product_name', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_sales_return_products.return_id', $id)->get();
        $customers = DB::table('qsell_sales_return')->leftjoin('qcrm_customer_details', 'qsell_sales_return.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_sales_return.id', $id)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();

        foreach ($salesreturnproducts as $key => $value) {
            $itemname = $value->item_id;
        }
        $itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
        $customfields = DB::table('qsettings_custom_fields')->select('*')->get();
        $plabels = $customfields->pluck('labels')->toArray();
        $gm_amount = 0;
        foreach ($salesreturn as $key => $value) {
            $gm_amount = $value->grandtotalamount;
        }

        $words = $this->numberToWord($gm_amount);

        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('sell.salesreturn.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'salesreturn', 'salesreturnproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('sell.salesreturn.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'salesreturn', 'salesreturnproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('sell.salesreturn.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'salesreturn', 'salesreturnproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } elseif (Session::get('preview') == 'preview4') {

            $pdf = PDF::loadView('sell.salesreturn.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'salesreturn', 'salesreturnproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } else {
            $pdf = PDF::loadView('sell.salesreturn.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'salesreturn', 'salesreturnproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        }


        return $pdf->stream('Sales Return-#' . $id . '.pdf');
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

<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;

class CommonController extends Controller
{

    public function calculator()
    {
        $branch = Session::get('branch');
        $vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->get();
        return view('sell.commonfns.calculator', compact('vatlist'));
    }

    public function getproduct(Request $request)
    {
        //

        $id = $request->id;
        $data = DB::table('qinventory_products')->select('*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

                                WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

                                GROUP BY qsell_saleorder_products.item_id) as so"))->where('product_id', $id)->get();
        return response()->json($data);
    }
    public function gettermsquote(Request $request)
    {
        $id = $request->id;

        $data = DB::table('qcrm_termsandconditions')->select('qcrm_termsandconditions.*')->where('qcrm_termsandconditions.id', $id)->get();


        return response()->json($data);
    }
    public function getcustomeraddressquote(Request $request)
    {
        $id = $request->id;

        $data = DB::table('qcrm_customer_details')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'countries.cntry_name as invoice_country')->where('qcrm_customer_details.id', $id)->get();


        return response()->json($data);
    }
    public function getcurrency_sell(Request $request)
    {
        $id = $request->id;

        $data = DB::table('qpurchase_currency')->select('qpurchase_currency.*')->where('qpurchase_currency.id', $id)->get();


        return response()->json($data);
    }
    public function producthistorylist_sell(Request $request)
    {
        $query1 = array();
        $branch = Session::get('branch');
        if ($request->customer != "") {
            $query = DB::table('qsell_saleinvoice')->select('id')->where('qsell_saleinvoice.customer', $request->customer)->get();
            $query99 = DB::table('qsell_saleinvoice')->select('id')->where('qsell_saleinvoice.customer', $request->customer)->get()->toArray();


            $output_array = array();

            foreach ($query99 as $a) {
                array_push($output_array, $a->id);
            }




            //   dd($output_array);
            foreach ($query as $query6) {
                //dd($query6->id);
                $query1 = DB::table('qsell_saleinvoice_products')->leftJoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->select('qinventory_products.product_name', 'qsell_saleinvoice_products.item_id', 'qsell_saleinvoice_products.quantity', 'qsell_saleinvoice_products.rate', 'qsell_saleinvoice_products.amount', 'qsell_saleinvoice_products.invoice_id', 'qsell_saleinvoice_products.vat_percentage', 'qsell_saleinvoice_products.vatamount', 'qsell_saleinvoice_products.discount', 'qsell_saleinvoice_products.totalamount')->whereIn('qsell_saleinvoice_products.invoice_id', $output_array)->where('qsell_saleinvoice_products.item_id', $request->pid)->get();
            }
            return response()->json($query1);
            //dd($query1 );



        } else {
            $query = DB::table('qsell_saleinvoice_products')->leftJoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->select('qinventory_products.product_name', 'qsell_saleinvoice_products.item_id', 'qsell_saleinvoice_products.quantity', 'qsell_saleinvoice_products.rate', 'qsell_saleinvoice_products.amount', 'qsell_saleinvoice_products.invoice_id', 'qsell_saleinvoice_products.vat_percentage', 'qsell_saleinvoice_products.vatamount', 'qsell_saleinvoice_products.discount', 'qsell_saleinvoice_products.totalamount')->orderby('qsell_saleinvoice_products.id', 'desc')->where('qsell_saleinvoice_products.item_id', $request->pid)->get();
            return response()->json($query);
        }
    }
    public function productquotationhistorylist_sell(Request $request)
    {
        $branch = Session::get('branch');
        $query1 = array();
        if ($request->customer != "") {
            $query = DB::table('qsell_quotation')->select('id')->where('qsell_quotation.customer', $request->customer)->get();
            foreach ($query as $query) {
                $query1 = DB::table('qsell_quotation_products')->leftJoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qinventory_products.product_name', 'qsell_quotation_products.item_id', 'qsell_quotation_products.quantity', 'qsell_quotation_products.rate', 'qsell_quotation_products.amount', 'qsell_quotation_products.quote_id', 'qsell_quotation_products.vat_percentage', 'qsell_quotation_products.vatamount', 'qsell_quotation_products.discount', 'qsell_quotation_products.totalamount')->where('qsell_quotation_products.quote_id', $query->id)->where('qsell_quotation_products.item_id', $request->pid)->get();
            }

            return response()->json($query1);
        } else {
            $query = DB::table('qsell_quotation_products')->leftJoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->select('qinventory_products.product_name', 'qsell_quotation_products.item_id', 'qsell_quotation_products.quantity', 'qsell_quotation_products.rate', 'qsell_quotation_products.amount', 'qsell_quotation_products.quote_id', 'qsell_quotation_products.vat_percentage', 'qsell_quotation_products.vatamount', 'qsell_quotation_products.discount', 'qsell_quotation_products.totalamount')->orderby('qsell_quotation_products.id', 'desc')->where('qsell_quotation_products.item_id', $request->pid)->get();
            return response()->json($query);
        }
    }
    public function getcustomerinvoices_advance_sell(Request $request)
    {
        $id = $request->id;
        $customer = $request->customer;

        $data = DB::table('qsell_saleorder')->select('qsell_saleorder.*')->where('qsell_saleorder.customer', $customer)->whereNotNull('quote_id')->get();

        return response()->json($data);
    }

    public function getcreditbalance(Request $request)
    {
        $customer = $request->customer;

        $data = DB::table('qsell_customer_payments')->select(DB::raw('SUM(qsell_customer_payments.dr_amount) as dr_amount'), DB::raw('SUM(qsell_customer_payments.cr_amount) as cr_amount'))->where('qsell_customer_payments.customer_id', $customer)->groupBy('qsell_customer_payments.customer_id')->get();

        return response()->json($data);
    }
    public function getproduct_product_code(Request $request)
    {
        //
        $id = $request->id;
        $warehouse = $request->warehouse;
        $data = DB::table('qinventory_products')->select('*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products
                                WHERE qinventory_products.product_id = qsell_saleorder_products.item_id
                                GROUP BY qsell_saleorder_products.item_id) as so"))->where('product_code', $id)->get();
        return response()->json($data);
    }


    public function ProductSalesHistory(Request $request)
    {


        $branch = Session::get('branch');

        $invoices = DB::table('qsell_saleinvoice_products')->leftJoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->leftJoin('qsell_saleinvoice', 'qsell_saleinvoice_products.invoice_id', '=', 'qsell_saleinvoice.id')->select('qinventory_products.product_name', 'qsell_saleinvoice_products.item_id', 'qsell_saleinvoice_products.quantity', 'qsell_saleinvoice_products.rate', 'qsell_saleinvoice_products.amount', 'qsell_saleinvoice_products.invoice_id', 'qsell_saleinvoice_products.vat_percentage', 'qsell_saleinvoice_products.vatamount', 'qsell_saleinvoice_products.discount', 'qsell_saleinvoice_products.totalamount', 'qsell_saleinvoice.cust_name', 'qsell_saleinvoice.id as inv_id', 'qsell_saleinvoice.quotedate')->orderby('qsell_saleinvoice.quotedate', 'desc')->where('qsell_saleinvoice_products.item_id', $request->id)->get();
        return view('inventory.inv_history', compact('invoices'));
    }



    public function ProductQuoteHistory(Request $request)
    {


        $branch = Session::get('branch');






        $invoices = DB::table('qsell_quotation_products')->leftJoin('qinventory_products', 'qsell_quotation_products.item_id', '=', 'qinventory_products.product_id')->leftJoin('qsell_quotation', 'qsell_quotation_products.quote_id', '=', 'qsell_quotation.id')->leftJoin('qcrm_customer_details', 'qsell_quotation.customer', '=', 'qcrm_customer_details.id')->select('qinventory_products.product_name', 'qsell_quotation_products.item_id', 'qsell_quotation_products.quantity', 'qsell_quotation_products.rate', 'qsell_quotation_products.amount', 'qsell_quotation_products.quote_id', 'qsell_quotation_products.vat_percentage', 'qsell_quotation_products.vatamount', 'qsell_quotation_products.discount', 'qsell_quotation_products.totalamount', 'qcrm_customer_details.cust_name', 'qsell_quotation.id as inv_id', 'qsell_quotation.quotedate')->orderby('qsell_quotation.quotedate', 'desc')->where('qsell_quotation_products.item_id', $request->id)->get();


        return view('inventory.quote_history', compact('invoices'));
    }
}

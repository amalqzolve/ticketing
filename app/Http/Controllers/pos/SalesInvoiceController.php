<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
// use App\Boq;
use App\crm\CustomerTypeModel;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\pos\StockTransferModel;
use DataTables;
use Auth;
use Carbon\Carbon;
use App\pos\InvoiceModel;
use App\pos\VanStockModel;
use App\crm\Customer_documents_Model;
use App\settings\BranchSettingsModel;
use PDF;


class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
        $branch = Session::get('branch');
        $user_id = Auth::user()->name;
        $user_id = Auth::user()->name;
        if ($user_id == 'Qzolve') {
            if ($request->ajax()) {
                $query  = DB::table('qpos_invoice')->leftjoin('qpos_van', 'qpos_invoice.vanid', '=', 'qpos_van.id')->leftjoin('qcrm_customer_details', 'qpos_invoice.customer', '=', 'qcrm_customer_details.id')
                    ->select('qpos_invoice.*', 'qpos_van.vanname', DB::raw("DATE_FORMAT(qpos_invoice.quotedate1, '%d-%m-%Y %h:%i') as quotedate1"), 'qcrm_customer_details.cust_name')
                    ->orderby('id', 'desc');
                $query->where('qpos_invoice.del_flag', 1)->where('qpos_invoice.branch', $branch);

                $data = $query->get();
                $count_filter = $query->count();
                $count_total = InvoiceModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            }
        } else {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->where('username', $user_id)->get();
            foreach ($van as $van) {
                $vanid = $van->id;
            }
            if ($request->ajax()) {
                $query  = DB::table('qpos_invoice')->leftjoin('qpos_van', 'qpos_invoice.vanid', '=', 'qpos_van.id')->leftjoin('qcrm_customer_details', 'qpos_invoice.customer', '=', 'qcrm_customer_details.id')
                    ->select('qpos_invoice.*', 'qpos_van.vanname', DB::raw("DATE_FORMAT(qpos_invoice.quotedate1, '%d-%m-%Y %h:%i') as quotedate1"), 'qcrm_customer_details.cust_name')
                    ->orderby('id', 'desc');
                $query->where('qpos_invoice.del_flag', 1)->where('qpos_invoice.branch', $branch)->where('qpos_invoice.vanid', $vanid);

                $data = $query->get();
                $count_filter = $query->count();
                $count_total = InvoiceModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            }
        }

        return view('pos.salesinvoice.listing');
    }
    public function possalesinvoice()
    {
        $branch = Session::get('branch');
        $user_id = Auth::user()->name;
        if ($user_id == 'Qzolve') {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->get();
            $customers   = DB::table('qpos_van_customers')->leftjoin('qcrm_customer_details', 'qpos_van_customers.customers', '=', 'qcrm_customer_details.id')->select('qcrm_customer_details.id', 'qcrm_customer_details.cust_name')->where('qpos_van_customers.del_flag', 1)->where('qpos_van_customers.branch', $branch)->get();
            $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

            $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
            $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
            // dd($vatlist);
            $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country = countryModel::select('id', 'cntry_name')->get();
            $storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
            $stores   = DB::table('qinventory_store_management')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
            return view('pos.salesinvoice.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'van', 'user_id'));
        } else {
            $vanid = DB::table('qpos_van')->select('*')->where('del_flag', 1)->where('username', $user_id)->get();

            foreach ($vanid as $vanids) {
                $van_id = $vanids->id;
            }
            $customers   = DB::table('qpos_van_customers')->leftjoin('qcrm_customer_details', 'qpos_van_customers.customers', '=', 'qcrm_customer_details.id')->select('qcrm_customer_details.id', 'qcrm_customer_details.cust_name')->where('qpos_van_customers.del_flag', 1)->where('qpos_van_customers.branch', $branch)->where('qpos_van_customers.vanid', $van_id)->get();
            $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

            $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
            $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
            // dd($vatlist);
            $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country = countryModel::select('id', 'cntry_name')->get();
            $storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
            $stores   = DB::table('qinventory_store_management')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
            return view('pos.salesinvoice.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'van_id', 'user_id'));
        }
    }
    public function posProductpurchaseListing(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = DB::table('qpos_van_stock')
                ->leftJoin('qinventory_products', 'qpos_van_stock.productid', '=', 'qinventory_products.product_id',)->select('qinventory_products.product_name', 'qinventory_products.product_id', 'qpos_van_stock.*')->orderby('qpos_van_stock.id', 'desc');
            $query->where('qpos_van_stock.del_flag', 1)->where('qpos_van_stock.branch', $branch)->where('qpos_van_stock.vanid', $request->vanid);
            // $query->where('qinventory_products.product_id',NULL);
            $data = $query->get();
            // dd($data);
            $count_filter = $query->count();
            $count_total = VanStockModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    }

    public function getproduct_name_details_pos(Request $request)
    {

        $id = $request->id;
        $data = DB::table('qpos_van_stock')->leftJoin('qinventory_products', 'qpos_van_stock.productid', '=', 'qinventory_products.product_id')->select('qpos_van_stock.*', 'qinventory_products.product_name')->where('qpos_van_stock.productid', $id)->where('qpos_van_stock.vanid', $request->van)->get();
        return response()->json($data);
    }
    public function posinvoicesubmit(Request $request)
    {
        $user_id = Auth::user()->id;
        $branch = Session::get('branch');
        $postID = $request->id;

        $data = [
            'customer' => $request->customer,
            'reference' => $request->reference,
            'attention'     => $request->attention,
            'salesman'         => $request->salesman,
            'quotedate'   => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
            'quotedate1'   => Carbon::parse($request->quotedate)->format('Y-m-d'),
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
            'status' => 'Paid',
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address,
            'contact_phone' => $request->contact_phone,
            'tpreview' => $request->tpreview,
            'invoice_type' => 1,
            'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
            'method' => $request->method,
            'user_id' => $user_id,
            'qtnref' => $request->qtnref,
            'po_wo_ref' => $request->po_wo_ref,
            'vanid' => $request->vanid,
        ];

        // $quotation = CustomInvoiceModel::updateOrCreate(['id' => $postID], $data);
        $quotation = InvoiceModel::updateOrCreate(['id' => $postID], $data);
        $quotationid = $quotation->id;

        for ($i = 0; $i < count($request->productname); $i++) {
            $data = [
                'quotationid' => $quotationid,
                'vanid' => $request->vanid,
                'itemname' => $request->productname[$i],

                'quantity'   => $request->quantity[$i],
                'invoiced_quantity'   => $request->quantity[$i],
                'rate'     => $request->rate[$i],
                'amount' => $request->amount[$i],
                'vatamount' => $request->vatamount[$i],
                'vat_percentage' => $request->vat_percentage[$i],
                'rdiscount' => $request->rdiscount[$i],
                'totalamount' => $request->row_total[$i],
                'branch' => $branch
            ];

            $quotation_product = DB::table('qpos_invoice_products')->insert($data);

            $ostock = DB::table('qpos_stocktransfer_products')->select('quantity', 'invoiced_quantity')->where('van', $request->vanid)->where('product', $request->productname[$i])->get();
            foreach ($ostock as $ostock) {
                $orstock = $ostock->quantity;
                $invoiced_quantity = $ostock->invoiced_quantity;
            }

            $restock = intval($orstock) - intval($request->quantity[$i]);

            $data1 = [
                'invoiced_quantity' => $invoiced_quantity + $request->quantity[$i],
                'quantity' =>  $restock
            ];
            DB::table('qpos_stocktransfer_products')->where('van', $request->vanid)->where('product', $request->productname[$i])->update($data1);

            $avstock = DB::table('qpos_van_stock')->select('*')->where('productid', $request->productname[$i])->where('vanid', $request->vanid)->get();

            foreach ($avstock as $avstock) {

                $avquantity = $avstock->available_quantity;
                $r = $avstock->return_quantity;
                $in = $avstock->invoiced_quantity;
            }


            $data2 = [
                'available_quantity' => $avquantity - $request->quantity[$i],
                'invoiced_quantity' =>  $in + $request->quantity[$i]
            ];
            DB::table('qpos_van_stock')->where('productid', $request->productname[$i])->where('vanid', $request->vanid)->update($data2);
        }
    }

    public function getcustomer_van(Request $request)
    {

        $id = $request->id;
        $data = DB::table('qpos_van_customers')->leftJoin('qcrm_customer_details', 'qpos_van_customers.customers', '=', 'qcrm_customer_details.id')->select('qpos_van_customers.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.id as cid')->where('qpos_van_customers.vanid', $id)->get();
        return response()->json($data);
    }

    public function posinvoice_pdf(Request $request)
    {
        ini_set("pcre.backtrack_limit", "100000000000");
        $id = $request->id;
        $branch = Session::get('branch');


        $companysettings = BranchSettingsModel::where('branch', $branch)->get();


        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

        // $customers   = DB::table('qcrm_customer_details')->select('id','cust_name')->where('del_flag',1)->where('branch',$branch)->get();






        //qcrm_customer_documents - customer_id
        //

        $customers   = DB::table('qpos_invoice')->leftjoin('qcrm_customer_details', 'qpos_invoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('qcrm_customer_documents', 'qcrm_customer_details.id', '=', 'qcrm_customer_documents.customer_id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qpos_invoice.*', 'qcrm_customer_details.*', 'qcrm_customer_documents.*', 'countries.*')->where('qpos_invoice.id', $id)->where('qpos_invoice.del_flag', 1)->where('qpos_invoice.branch', $branch)->get();


        //

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

        $cinvoice   = DB::table('qpos_invoice')->leftJoin('qpos_van', 'qpos_invoice.vanid', '=', 'qpos_van.id')->leftJoin('qcrm_salesman_details as s1', 'qpos_invoice.preparedby', '=', 's1.id')->leftJoin('qcrm_salesman_details as s2', 'qpos_invoice.approvedby', '=', 's2.id')->leftJoin('qcrm_salesman_details as s3', 'qpos_invoice.salesman', '=', 's3.id')->select('qpos_invoice.*', 's1.name as preparedby', 's2.name as approvedby', 's3.name as salesman', 'qpos_van.vanname')->where('qpos_invoice.id', $id)->where('qpos_invoice.del_flag', 1)->where('qpos_invoice.branch', $branch)->get();

        $cinvoice_product   = DB::table('qpos_invoice_products')->select('*')->where('quotationid', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
        $stores   = DB::table('qinventory_store_management')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();

        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();

        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('pos.salesinvoice.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'vatlist', 'bname', 'storeavailabe', 'stores', 'companysettings'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('pos.salesinvoice.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'vatlist', 'bname', 'storeavailabe', 'stores', 'companysettings'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('pos.salesinvoice.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'vatlist', 'bname', 'storeavailabe', 'stores', 'companysettings'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('pos.salesinvoice.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'vatlist', 'bname', 'storeavailabe', 'stores', 'companysettings'));
        } else {
            $pdf = PDF::loadView('pos.salesinvoice.cinvoice_pdf', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'vatlist', 'bname', 'storeavailabe', 'stores', 'companysettings'));
        }


        return $pdf->stream('Invoice-#' . $id . '.pdf');
    }
}

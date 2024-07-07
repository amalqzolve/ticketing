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

class CreditNoteController extends Controller
{
    use AccountingActionsTrait;
    public function list(Request $request)
    {
        $branch = Session::get('branch');
        $user = Auth::user();
        if (!$request->ajax()) {
            $creditnote   = array();
            return view('sell.creditnote.list', compact('creditnote'));
        } else {
            $creditnote = DB::table('qsell_creditnote')
                ->select('qsell_creditnote.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', DB::raw("DATE_FORMAT(qsell_creditnote.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_creditnote.del_flag', 1)
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', '=', 'qsell_creditnote.customer')
                ->where('qsell_creditnote.branch', $branch)->get();
            $dtTble = Datatables::of($creditnote)->addIndexColumn()
                ->addColumn('status', function ($row) use ($user) {
                    if ($row->status == 'Draft')
                        return '<span style="color:gray;">Draft</span>';
                    if ($row->status == 'Approved')
                        return '<span style="color:green;">Approved</span>';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $j = '';
                    $hasPermission = $user->can('Credit Note PDF');
                    if ($hasPermission) {
                        $j .= '<a href="Credit-Pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-printer"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                            </span>
                        </li>
                    </a>';
                    }

                    if ($row->status == "Draft") {
                        $j .= '<a href="creditnote-edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                    <li class="kt-nav__item">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                            <span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
                                        </span>
                                    </li>
                                </a>';
                        $j .= '<a data-type="send" data-target="#kt_form">
                                    <li class="kt-nav__item creditnoteApprove" id="' . $row->id . '">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-accept"></i>
                                            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
                                        </span>
                                    </li>
                                </a>';
                        $j .= '<a data-type="send" data-target="#kt_form">
                                    <li class="kt-nav__item creditnoteDelete" id="' . $row->id . '">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-delete"></i>
                                            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Delete</span>
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
                ->rawColumns(['action', 'status']);
            return  $dtTble->make(true);
        }
    }

    public function add()
    {
        $branch = Session::get('branch');
        $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();
        $invoicenumber = DB::table('qsales_salesorder')->select('id')->where('del_flag', 1)->get();
        return view('sell.creditnote.add', compact('customers'));
    }

    public function creditnote(Request $request)
    {
        $id = $request->invoicenumber;
        $branch = Session::get('branch');
        $cinvoice   = DB::table('qsell_saleinvoice')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        if (isset($cinvoice[0]->id)) {
            $cinvoice_product   = DB::table('qsell_saleinvoice_products')
                ->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')
                ->select('qsell_saleinvoice_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name')
                ->where('qsell_saleinvoice_products.invoice_id', $id)
                ->get();

            $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
            $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
            $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
            $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country1 = countryModel::select('id', 'cntry_name')->get();

            $customers   = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*')->where('qsell_saleinvoice.id', $id)->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->get();
            return view('sell.creditnote.creditnote', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'areaList', 'areaLists', 'group', 'country1'));
        } else
            echo "invoice Not Found";
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $creditnote   = DB::table('qsell_creditnote')
            ->leftjoin('qsell_saleinvoice', 'qsell_creditnote.invoiceid', '=', 'qsell_saleinvoice.id')->select('qsell_creditnote.*', 'qsell_saleinvoice.sale_method')->where('qsell_creditnote.id', $id)->where('qsell_creditnote.del_flag', 1)->where('qsell_creditnote.branch', $branch)->first();
        if (isset($creditnote->id)) {
            $creditnoteProduct   = DB::table('qsell_creditnote_products')
                ->leftjoin('qinventory_products', 'qsell_creditnote_products.item_id', '=', 'qinventory_products.product_id')
                ->leftjoin('qsell_saleinvoice_products', 'qsell_creditnote_products.qsell_saleinvoice_product_id', '=', 'qsell_saleinvoice_products.id')
                ->select('qsell_creditnote_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name', 'qsell_saleinvoice_products.quantity as total_invoice', 'qsell_saleinvoice_products.credit_created_quantity')
                ->where('qsell_creditnote_products.creditnoteid', $id)
                ->get();

            $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
            $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
            $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
            $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
            $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
            $country1 = countryModel::select('id', 'cntry_name')->get();

            $customers   = DB::table('qsell_creditnote')
                ->leftjoin('qcrm_customer_details', 'qsell_creditnote.customer', '=', 'qcrm_customer_details.id')
                ->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')
                ->select('qcrm_customer_details.*')
                ->where('qsell_creditnote.id', $id)
                ->get();

            return view('sell.creditnote.creditnote_edit', compact('branch', 'currencylist', 'unitlist', 'termslist', 'vatlist', 'customers', 'salesmen', 'creditnote', 'creditnoteProduct', 'areaList', 'areaLists', 'group', 'country1'));
        } else
            echo "Credit Note Not Found";
    }

    public function creditnotesubmit_sell(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::user()->id;
            $branch = Session::get('branch');
            $crData = [
                'invoiceid' => $request->invoiceid,
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
                'status' => $request->status,
            ];
            if ($request->id == '') {
                DB::table('qsell_creditnote')->insert($crData);
                $creditnoteid = DB::getPdo()->lastInsertId();
            } else {
                DB::table('qsell_creditnote')->where('id', $request->id)->update($crData);
                $creditnoteid = $request->id;
                $creditnoteProducts = DB::table('qsell_creditnote_products')->where('creditnoteid', $creditnoteid)->select('qsell_saleinvoice_product_id', 'quantity')->get();
                foreach ($creditnoteProducts as $key => $value)
                    DB::table('qsell_saleinvoice_products')->where('id', $value->qsell_saleinvoice_product_id)->decrement('credit_created_quantity', $value->quantity);
                DB::table('qsell_creditnote_products')->where('creditnoteid', $creditnoteid)->delete();
            }
            for ($i = 0; $i < count($request->item_id); $i++) {
                $creditnote_product_data = [
                    'creditnoteid' => $creditnoteid,
                    'item_id' => $request->item_id[$i],
                    'qsell_saleinvoice_product_id' => $request->qsell_saleinvoice_product_id[$i],
                    'description' => $request->description[$i],
                    'unit'      => $request->unit[$i],
                    'quantity'   => $request->quantity[$i],
                    'rate'     => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'vatamount' => $request->vatamount[$i],
                    'vat_percentage' => $request->vat_percentage[$i],
                    'discount' => $request->rdiscount[$i],
                    'totalamount' => $request->row_total[$i],
                    'branch' => $branch
                ];
                DB::table('qsell_saleinvoice_products')->where('id', $request->qsell_saleinvoice_product_id[$i])->increment('credit_created_quantity', $request->quantity[$i]);
                DB::table('qsell_creditnote_products')->insert($creditnote_product_data);
            }
            if ($request->status == "Approved") {
                $this->creditNoteAccountingEnrty($creditnoteid);
            }
        });
        return 'true';
    }


    public function approve(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->id;
            $branch = Session::get('branch');
            $credtNote = DB::table('qsell_creditnote')->where('id', $id)->update(['status' => 'Approved']);
            $this->creditNoteAccountingEnrty($id); //Accounting Entry
        });
        $out = array(
            'status' => 1,
            'msg' => "Approved Successfully",
        );
        echo json_encode($out);
    }

    public function delete(Request $request)
    {
        DB::transaction(function () use ($request) {
            $creditnoteid = $request->id;
            DB::table('qsell_creditnote')->where('id', $request->id)->delete();
            $creditnoteProducts = DB::table('qsell_creditnote_products')->where('creditnoteid', $creditnoteid)->select('qsell_saleinvoice_product_id', 'quantity')->get();
            foreach ($creditnoteProducts as $key => $value)
                DB::table('qsell_saleinvoice_products')->where('id', $value->qsell_saleinvoice_product_id)->decrement('credit_created_quantity', $value->quantity);
            DB::table('qsell_creditnote_products')->where('creditnoteid', $creditnoteid)->delete();
        });
        $out = array(
            'status' => 1,
            'msg' => "Deleted Successfully",
        );
        echo json_encode($out);
    }


    public function Credit_Pdf(Request $request)
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
        $creditnote   = DB::table('qsell_creditnote')->select('*')->where('id', $id)->get();
        $creditnoteproducts = DB::table('qsell_creditnote_products')->leftjoin('qinventory_products', 'qsell_creditnote_products.item_id', '=', 'qinventory_products.product_id')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qsell_creditnote_products.*', 'qinventory_products.product_name', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name', 'qinventory_products.*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products

            WHERE qinventory_products.product_id = qsell_saleorder_products.item_id

            GROUP BY qsell_saleorder_products.item_id) as so"))->where('qsell_creditnote_products.creditnoteid', $id)->get();
        $customers = DB::table('qsell_creditnote')->leftjoin('qcrm_customer_details', 'qsell_creditnote.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_creditnote.id', $id)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();

        foreach ($creditnoteproducts as $key => $value) {
            $itemname = $value->item_id;
        }
        $itemdetails = DB::table('qinventory_products')->leftjoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftjoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->select('qinventory_products.*', 'qinventory_brand.brand_name', 'qinventory_manufacture.manufacture_name')->where('qinventory_products.del_flag', 1)->where('qinventory_products.product_id', $itemname)->get();
        $customfields = DB::table('qsettings_custom_fields')->select('*')->get();
        $plabels = $customfields->pluck('labels')->toArray();
        $gm_amount = 0;
        foreach ($creditnote as $key => $value) {
            $gm_amount = $value->grandtotalamount;
        }

        $words = $this->numberToWord($gm_amount);

        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('sell.creditnote.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'creditnote', 'creditnoteproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('sell.creditnote.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'creditnote', 'creditnoteproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('sell.creditnote.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'creditnote', 'creditnoteproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } elseif (Session::get('preview') == 'preview4') {

            $pdf = PDF::loadView('sell.creditnote.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'creditnote', 'creditnoteproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        } else {
            $pdf = PDF::loadView('sell.creditnote.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'salesmen', 'creditnote', 'creditnoteproducts', 'vatlist', 'bname', 'companysettings', 'customers', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
        }


        return $pdf->stream('CreditNote-#' . $id . '.pdf');
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



    // public function convert(Request $request)
    // {
    //     $id = $request->id;
    //     $rid = $request->rid;
    //     $branch = Session::get('branch');

    //     $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
    //     $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
    //     $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
    //     $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();

    //     $customersinv   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();

    //     $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();

    //     $cinvoice   = DB::table('qsell_saleinvoice')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->get();

    //     $cinvoice_product   = DB::table('qsell_saleinvoice_products')->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleinvoice_products.*', 'qinventory_products.product_id')->where('qsell_saleinvoice_products.invoice_id', $id)->where('qsell_saleinvoice_products.del_flag', 1)->where('qsell_saleinvoice_products.branch', $branch)->get();
    //     $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
    //     $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
    //     $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
    //     $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
    //     $country1 = countryModel::select('id', 'cntry_name')->get();

    //     $customers   = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*')->where('qsell_saleinvoice.id', $id)->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->get();
    //     // dd($cinvoice_product);
    //     return view('sell.creditnote.convertcreditnote', compact('branch', 'currencylist', 'productlist', 'unitlist', 'termslist', 'vatlist', 'customers', 'salesmen', 'cinvoice', 'cinvoice_product', 'areaList', 'areaLists', 'group', 'country1', 'customersinv', 'rid'));
    // }
    // public function creditnotesubmit_sell1(Request $request)
    // {

    //     $user_id = Auth::user()->id;
    //     $branch = Session::get('branch');
    //     DB::table('qsell_sales_return')->where('id', $request->rid)->update(['status' => 1]);
    //     $quote_data = [
    //         'invoiceid' => $request->invoiceid,
    //         'quotedate' =>  Carbon::parse($request->quotedate)->format('Y-m-d'),
    //         'valid_till' =>  Carbon::parse($request->valid_till)->format('Y-m-d'),
    //         'qtn_ref' => $request->qtn_ref,
    //         'po_ref' => $request->po_ref,
    //         'attention' => $request->attention,
    //         'salesman' => $request->salesman,
    //         'currency' => $request->currency,
    //         'currencyvalue' => $request->currencyvalue,
    //         'discount_type' => $request->discount_type,
    //         'customer' => $request->customer,
    //         'terms_conditions' => $request->terms,
    //         'notes' => $request->notes,
    //         'internal_reference' => $request->internal_reference,
    //         'tpreview' => $request->tpreview,
    //         'totalamount' => $request->totalamount,
    //         'discount' => $request->discount,
    //         'amountafterdiscount' => $request->amountafterdiscount,
    //         'vatamount' => $request->totalvatamount,
    //         'grandtotalamount' => $request->grandtotalamount,
    //         'branch' => $branch,
    //         'user_id' => $user_id,
    //         'payment_terms' => $request->payment_terms,
    //     ];


    //     DB::table('qsell_creditnote')->insert($quote_data);
    //     $creditnoteid = DB::getPdo()->lastInsertId();

    //     for ($i = 0; $i < count($request->item_id); $i++) {
    //         $creditnote_product_data = [
    //             'creditnoteid' => $creditnoteid,
    //             'item_id' => $request->item_id[$i],
    //             'description' => $request->description[$i],
    //             'unit'         => $request->unit[$i],
    //             'quantity'   => $request->quantity[$i],
    //             'rate'     => $request->rate[$i],
    //             'amount' => $request->amount[$i],
    //             'vatamount' => $request->vatamount[$i],
    //             'vat_percentage' => $request->vat_percentage[$i],
    //             'discount' => $request->rdiscount[$i],
    //             'totalamount' => $request->row_total[$i],
    //             'branch' => $branch
    //         ];
    //         DB::table('qsell_creditnote_products')->insert($creditnote_product_data);
    //     }



    //     return 'true';
    // }


}

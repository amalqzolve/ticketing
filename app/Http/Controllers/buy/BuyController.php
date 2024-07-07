<?php

namespace App\Http\Controllers\buy;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\buy\BuyAccountModel;
use PDF;
use App\inventory\Product_stockModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\crm\CustomerModel;
use App\crm\Customer_documents_Model;
use App\crm\SupplierCategory;
use App\crm\SuppliergroupModel;
use App\crm\suppliertype;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;
//
class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buy_account_head()
    {

        $branch = Session::get('branch');
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers';
        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();


        return view('buy.account.list', compact('account_heads', 'branch'));
    }

    public function buy_head_add()
    {
        $branch = Session::get('branch');
        /*  $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
            $subledgertable= $subtable.'ledgers';
            $accounts = DB::table($subledgertable)->select('id','name')->get();
*/
        $branch = Session::get('branch');
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subgrouptable = $subtable . 'a_groups';
        $groups = DB::table($subgrouptable)->get()
            ->toArray();

        $branch = Session::get('branch');
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers'; //Take id,name for ledger dropdown
        $accounts = DB::table($subledgertable)->select('id', 'name')->get();


        return view('buy.account.add', compact('groups', 'branch', 'accounts'));
    }


    public function submit_account_head(Request $request)
    {
        // $user_id = Auth::user()->id;
        $branch = Session::get('branch');
        $postID = $request->id;
        $check = $this->check_exists($request->head_name, 'head_name', 'buy_account_head');
        $sub_ledger_id = 0;
        if ($check < 1) {
            if ($request->newledger == 1) {



                $maintable = DB::table('qlogistic_accounts_accounts')->where('is_default', '=', 1)->orderBy('id', 'asc')->value('db_prefix');
                $mainledgertable = $maintable . 'ledgers';


                $request->accounts_code++;
                $data = array(
                    'code' => $request->accounts_code,
                    'op_balance' => 0,
                    'name' => $request->accounts_ledger,
                    'group_id' => $request->accounts_group,
                    'op_balance_dc' => 0,
                    'notes' => $request->accounts_ledger . '-' . $request->accounts_code,
                    'reconciliation' => 0,
                    'type' => 0,
                );
                $main_ledger =  DB::table($mainledgertable)->insert($data);
                //main accounts
                $main_ledger_id = DB::getPdo()->lastInsertId();

                //sub accounts
                $data = array(

                    'main_ledger_id' => $main_ledger_id,
                    'code' => $request->accounts_code,
                    'op_balance' => 0,
                    'name' => $request->accounts_ledger,
                    'group_id' => $request->accounts_group,
                    'op_balance_dc' => 0,
                    'notes' => $request->accounts_ledger . '-' . $request->accounts_code,
                    'reconciliation' => 0,
                    'type' => 0,
                );
                $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
                $subledgertable = $subtable . 'ledgers';


                $sub_ledger =  DB::table($subledgertable)->insert($data);
                $sub_ledger_id = DB::getPdo()->lastInsertId();
            } else {
                $sub_ledger_id = $request->account_head_ledger;
            }
            $data = [
                'head_name' => $request->head_name,
                'head_description' => $request->head_description,
                'account_head_ledger' => $sub_ledger_id,
                'branch' => $branch
            ];


            $area = BuyAccountModel::updateOrCreate(['id' => $postID], $data);
            $areaid = $area->id;
            return 'true';
        } else {
            return 'false';
        }
    }
    public function check_exists($value, $field, $table)
    {
        $branch = Session::get('branch');

        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();

        return $query->count();
    }


    public function buy_direct_purchase()
    {
        $branch = Session::get('branch');

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
        if (Session::get('common_customer_database') == 1) {
            $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->get();
        } else {
            $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();
        }
        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        $areaList = SupplierCategory::select('*')->where('branch', $branch)->where('del_flag', 1)->get();
        $areaLists = suppliertype::select('*')->where('branch', $branch)->where('del_flag', 1)->get();
        $group = SuppliergroupModel::select('*')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = countryModel::select('id', 'cntry_name')->get();




        $vouchers   = DB::table('qsettings_voucher')->select('id', 'voucher_name')->where('del_flag', 1)->where('branch', $branch)->get();


        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');

        $subledgertable = $subtable . 'ledgers';

        $subledgertables = DB::table($subtable . 'ledgers')->select('*')->get();



        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name as lname', $subledgertable . '.id as lid')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();
        $suppliers   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        // dd($vatlist);
        return view('buy.voucher.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'vouchers', 'account_heads', 'suppliers', 'subledgertables'));
    }
    /* public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = BuyAccountModel::where('head_name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } */

    public function searcheads(Request $request)
    {
        return BuyAccountModel::where('head_name', 'LIKE', '%' . $request->q . '%')->get();
    }
    public function buy_voucher_submit(Request $request)
    {

        $branch = Session::get('branch');
        $data = [

            'voucher_type' => $request->voucher_type,
            'purchase_type' => $request->purchase_type,
            'bill_id' => $request->bill_id,
            'quotedate'   => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'entrydate'   => Carbon::parse($request->entrydate)->format('Y-m-d'),
            'dateofsupply'   => Carbon::parse($request->dateofsupply)->format('Y-m-d'),
            'po_wo_ref' => $request->po_wo_ref,
            'salesman'         => $request->salesman,
            'currency' => $request->currency,
            'currencyvalue' => $request->currencyvalue,
            'terms'     => $request->terms,
            'notes' => $request->notes,
            'internalreference' => $request->internalreference,
            'tpreview' => $request->tpreview,

            'cust_id' => $request->cust_id,

            'totalamount' => $request->totalamount,
            'discount' => $request->discount,
            'amountafterdiscount' => $request->amountafterdiscount,
            'totalvatamount' => $request->totalvatamount,
            'grandtotalamount' => $request->grandtotalamount,
            'paidamount' => $request->paidamount,
            'balanceamount' => $request->balanceamount,
            'branch' => $branch,
        ];
        $main_voucher = DB::table('buy_voucher')->insert($data);
        $main_voucher_id = DB::getPdo()->lastInsertId();
        //vat

        $datavat = [
            'sale_order_id' => '',
            'purchaseorder_id' => $main_voucher_id,
            'type' => 1,
            'date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'totalamount'   => $request->totalamount,
            'branch' => $branch,
        ];
        $vat = DB::table('qpurchase_vatfiling')->insert($datavat);


        //vat
        //soa
        $met = 0;
        $transaction_type = "";
        $method = DB::table('buy_voucher')->select('*')->where('id', $main_voucher_id)->get();
        foreach ($method as $methods) {
            $a = $methods->purchase_type;
            $met = "";
            $cr_amount = "";
            $dr_amount = "";
            if ($a == 1) {
                $transaction_type = 'cash';
                $met = $methods->grandtotalamount;
                $cr_amount = $request->grandtotalamount;
                $dr_amount = $request->grandtotalamount;
            } else {
                $transaction_type = 'credit';
                $met = 0;
                $cr_amount = $request->grandtotalamount;
                $dr_amount = $request->paidamount;
            }
        }






        $soa = [
            'doc_type'        => 'Purchase',
            'doc_id'          => $main_voucher_id,
            'doc_transaction' => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'transaction_type' => $transaction_type,
            'totalamount'     => $request->totalamount,
            'customer_id'     => $request->cust_id,
            'paid_amount'     => $met,
            'branch'          => $branch,
            'cr_amount'          => $cr_amount,
            'dr_amount'          => $dr_amount,
        ];
        DB::table('qpurchase_purchase_soa')->insert($soa);

        //soa
        for ($i = 0; $i < count($request->head_name); $i++) {
            //


            $query = DB::table('buy_account_head')->select('head_name', 'id')->where('head_name', $request->head_name[$i])->where('del_flag', 1)->where('branch', $branch)->get();

            if ($query->count() > 0) {
                foreach ($query as $key => $value) {
                    $head_id = $value->id;
                }
            } else {
                $data = [
                    'head_name' => $request->head_name[$i],
                    'head_description' => $request->product_description[$i],
                    'account_head_ledger' => $request->ledger[$i],
                    'branch' => $branch
                ];
                $head_product = DB::table('buy_account_head')->insert($data);
                $head_id = DB::getPdo()->lastInsertId();
            }
            //

            $data = [
                'main_voucher_id' => $main_voucher_id,
                'head_name' => $head_id,
                'ledger'     => $request->ledger[$i],
                'product_description'         => $request->product_description[$i],
                'amount' => $request->amount[$i],
                'unit' => $request->unit[$i],
                'quantity' => $request->quantity[$i],
                'rate' => $request->rate[$i],
                'vat_percentage' => $request->vat_percentage[$i],
                'vatamount' => $request->vatamount[$i],
                'rdiscount' => $request->rdiscount[$i],
                'row_total'  => $request->row_total[$i],
                'branch' => $branch
            ];
            $voucher_product = DB::table('buy_voucher_products')->insert($data);
        }







        /////////////////////////////////////////////
        //get supplier ledger
        $supplier_id = $request->cust_id;
        $supplier_ledger = DB::table('qcrm_supplier')->where('id', $supplier_id)->select('main_ledger')->value('main_ledger');


        //get sales ledger
        $purchase_account = 0;
        $purchase_account = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('purchase_account');

        //get vat ledger
        $input_vat_ledger = 0;
        $input_vat_ledger = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('input_vat_ledger');

        //get entry type

        $purchase_invoice_entry_type = 0;
        $purchase_invoice_entry_type = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('purchase_invoice_entry_type');

        //get number
        $number = $this->nextNumber($purchase_invoice_entry_type);

        //pass entry to accounting

        $data_accounts = [
            'entrytype_id'   => $purchase_invoice_entry_type,
            'number'         => $number,
            'date'           => date("Y-m-d"),
            'dr_total'       => abs($request->grandtotalamount),
            'cr_total'       => abs($request->grandtotalamount),


        ];


        $main_entry = DB::table('a_branch1_entries')->insert($data_accounts);
        $main_entry_id = DB::getPdo()->lastInsertId();



        $data_accounts_items = [
            'entry_id'   => $main_entry_id,
            'ledger_id'  => $supplier_ledger,
            'amount'     => abs($request->grandtotalamount),
            'dc'         => 'D',
            'narration'         => '-',
        ];
        DB::table('a_branch1_entryitems')->insert($data_accounts_items);
        $data_accounts_items = [
            'entry_id'   => $main_entry_id,
            'ledger_id'  => $purchase_account,
            'amount'     => abs($request->totalamount),
            'dc'         => 'C',
            'narration'         => '-',
        ];




        DB::table('a_branch1_entryitems')->insert($data_accounts_items);


        $data_accounts_items = [
            'entry_id'   => $main_entry_id,
            'ledger_id'  => $input_vat_ledger,
            'amount'     => abs($request->totalvatamount),
            'dc'         => 'C',
            'narration'         => '-',
        ];




        DB::table('a_branch1_entryitems')->insert($data_accounts_items);


        //save entry id in sales table
        DB::table('buy_voucher')->where('id', $main_voucher_id)->update(['entry_id' => $main_entry_id]);


        /////////////////////////////////////////////////////////////////////////////////////////////







        return 'true';
    }



    public function buy_vouchers()
    {

        $branch = Session::get('branch');
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers';
        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();


        $vouchers = DB::table('buy_voucher')->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')->select('*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_supplier.vatno', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')->Where('buy_voucher.del_flag', 1)->orderBy('buy_voucher.id', 'desc')->get();

        return view('buy.voucher.list', compact('account_heads', 'branch', 'vouchers'));
    }

    public function buy_bill_settlement()
    {

        $branch = Session::get('branch');
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers';
        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();


        $vouchers = DB::table('buy_voucher')->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')->select('*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser')->get();

        $bills = DB::table('buy_billsettlement')->leftjoin($subledgertable, 'buy_billsettlement.depositaccount', '=', $subledgertable . '.id')->leftjoin('qcrm_supplier', 'buy_billsettlement.supplier', '=', 'qcrm_supplier.id')->select('buy_billsettlement.*', 'qcrm_supplier.sup_name', $subledgertable . '.name as lname')->get();



        return view('buy.bill.list', compact('account_heads', 'branch', 'bills'));
    }


    public function buy_bill_settlement_add()
    {
        $branch = Session::get('branch');

        $suppliers   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();

        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers'; //Take id,name for ledger dropdown
        $accounts = DB::table($subledgertable)->select('id', 'name')->get();

        return view('buy.bill.add', compact('branch', 'suppliers', 'accounts'));
    }




    public function submit_buy_supplier(Request $request)
    {

        $Supplier_select = $request->Supplier_select;


        $vouchers = DB::table('buy_voucher')->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')->where('cust_id', $Supplier_select)/*->where('balanceamount','>',0)*/->select('*', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')->get();

        return response()->json($vouchers);
    }

    public function buy_bill_settle_submit(Request $request)
    {
        $branch = Session::get('branch');
        $data = [

            'supplier' => $request->Supplier_select,
            'dueamount' => $request->dueamount,
            'paidamount' => $request->paidamount,
            'depositaccount' => $request->depositaccount,
            'notes' => $request->notes,
            'reference' => $request->reference,
            'addtotal' => $request->addtotal,
            'bills' => implode(', ', $request->vouchers),
            'branch' => $branch,
            'transactiondate' => Carbon::parse($request->transactiondate)->format('Y-m-d'),

        ];
        $main_bill = DB::table('buy_billsettlement')->insert($data);
        $main_bill_id = DB::getPdo()->lastInsertId();

        for ($i = 0; $i < count($request->modeofpayment); $i++) {

            $data = [
                'bill_id' => $main_bill_id,
                'modeofpayment'     => $request->modeofpayment[$i],
                'preference' => $request->preference[$i],
                'amount'   => $request->amount[$i],
                'branch' => $branch
            ];
            $voucher_modes = DB::table('buy_billsettlement_payment_method')->insert($data);
        }

        //reduce due amunts from vouchers
        $paidamount = 0;
        $paidamount = $request->paidamount;
        for ($i = 0; $i < count($request->vouchers); $i++) {

            if ($paidamount > 0) {
                $balanceamount = 0;
                $balanceamount = DB::table('buy_voucher')->select('balanceamount')->where('id', '=', $request->vouchers[$i])->value('balanceamount');
                // $ba = ($balanceamount-$paidamount>=0);
                //    if($paidamount>=$balanceamount){
                if ($paidamount >= $balanceamount) {
                    //  dd("yes");   dd($balanceamount); 
                    // $lastbalance=$paidamount-$balanceamount;
                    $paidamount = $paidamount - $balanceamount;

                    $data = [
                        'balanceamount' => 0,
                    ];
                    //dd($data);

                    DB::table('buy_voucher')->where('id', $request->vouchers[$i])->update($data);
                } else {
                    $lastbalance = 0;
                    //$paidamount=$paidamount-$balanceamount;
                    $lastbalance = $paidamount - $balanceamount;
                    $paidamount = $lastbalance;
                    $data = [
                        'balanceamount' => abs($lastbalance),
                    ];
                    //dd($data);

                    DB::table('buy_voucher')->where('id', $request->vouchers[$i])->update($data);
                }
            }
        }
        //

        return 'true';
    }

    public function buy_voucher_delete(Request $request)
    {
        $postID = $request->id;

        $data = [
            'del_flag' => 0,
        ];
        //  dd($data);
        $vdel_flag = DB::table('buy_voucher')->where('id', $postID)->update($data);
        /*$vdel_flag_product =DB::table('buy_voucher_products')->where('main_voucher_id', $postID)->update($data);*/

        DB::table('qpurchase_vatfiling')->where('purchaseorder_id', $postID)->delete();


        DB::table('qsales_salesorder_soa')->where('doc_id', $postID)->delete();




        return redirect()->route('Buy Vouchers')->with('message', 'State saved correctly!!!');
    }
    /*     
     */


    public function getvoucherdetails(Request $request)
    {
        $id = $request->id;
        $data = DB::table('buy_voucher')->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')->select('buy_voucher.id', 'buy_voucher.totalamount', 'qcrm_supplier.sup_name')->where('buy_voucher.id', $id)->get();
        return response()->json($data);
    }


    public function pdf(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $vouchers   = DB::table('qsettings_voucher')->select('id', 'voucher_name')->where('del_flag', 1)->where('branch', $branch)->get();
        $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*')->where('qcrm_customer_details.branch', $branch)->where('qcrm_customer_details.del_flag', 1)->get();
        $voucher = DB::table('buy_voucher')->select('buy_voucher.*', DB::raw("DATE_FORMAT(buy_voucher.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(buy_voucher.entrydate, '%d-%m-%Y') as entrydate"), DB::raw("DATE_FORMAT(buy_voucher.dateofsupply, '%d-%m-%Y') as dateofsupply"))->where('buy_voucher.branch', $branch)->where('buy_voucher.del_flag', 1)->where('buy_voucher.id', $id)->get();

        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers';
        $voucher_metod = DB::table('buy_voucher_products')->select('buy_account_head.head_name as head_names', 'buy_voucher_products.*', $subtable . 'ledgers.*')->leftjoin($subtable . 'ledgers', 'buy_voucher_products.ledger', '=', $subtable . 'ledgers.id')->leftjoin('buy_account_head', 'buy_voucher_products.head_name', '=', 'buy_account_head.id')->where('buy_voucher_products.branch', $branch)->where('buy_voucher_products.del_flag', 1)->where('buy_voucher_products.main_voucher_id', $id)->get();
        //dd($voucher_metod);
        //

        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();


        ////////

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        foreach ($voucher as $key => $value) {

            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->cust_id)->get();
        }
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();

        $customfields = DB::table('qsettings_custom_fields')->select('*')->get();
        $plabels = $customfields->pluck('labels')->toArray();
        $gm_amount = 0;
        foreach ($voucher as $key => $value) {
            $gm_amount = $value->grandtotalamount;
            //$balance_amount=$value->balance_amount;
        }

        $words = $this->numberToWord($gm_amount);
        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('buy.voucher.preview1', compact('branch', 'branchsettings', 'voucher', 'voucher_metod', 'bname', 'companysettings', 'customers', 'pname', 'vouchers', 'unitlist', 'companysettings', 'plabels', 'words'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('buy.voucher.preview2', compact('branch', 'branchsettings', 'voucher', 'voucher_metod', 'bname', 'companysettings', 'customers', 'pname', 'vouchers', 'unitlist', 'companysettings', 'plabels', 'words'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('buy.voucher.preview3', compact('branch', 'branchsettings', 'voucher', 'voucher_metod', 'bname', 'companysettings', 'customers', 'pname', 'vouchers', 'unitlist', 'companysettings', 'plabels', 'words'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('buy.voucher.preview4', compact('branch', 'branchsettings', 'voucher', 'voucher_metod', 'bname', 'companysettings', 'customers', 'pname', 'vouchers', 'unitlist', 'companysettings', 'plabels', 'words'));
        } else {
            $pdf = PDF::loadView('buy.voucher.preview4', compact('branch', 'branchsettings', 'voucher', 'voucher_metod', 'bname', 'companysettings', 'customers', 'pname', 'vouchers', 'unitlist', 'companysettings', 'plabels', 'words'));
        }
        return $pdf->stream('voucher-#' . $id . '.pdf');
    }

    public function numberToWord($num = '')
    {
        $num    = (string) ((int) $num);
        if ((int) ($num) && ctype_digit($num)) {
            $words  = array();
            $num   = str_replace(array(',', ' '), '', trim($num));
            $list1  = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');
            $list2  = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
            $list3  = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion', 'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion');
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

    public function edit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('del_flag', 1)->where('branch', $branch)->get();
        if (Session::get('common_customer_database') == 1) {
            $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->get();
        } else {
            $customers   = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('del_flag', 1)->where('branch', $branch)->get();
        }
        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        $areaList = SupplierCategory::select('*')->where('branch', $branch)->where('del_flag', 1)->get();
        $areaLists = suppliertype::select('*')->where('branch', $branch)->where('del_flag', 1)->get();
        $group = SuppliergroupModel::select('*')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = countryModel::select('id', 'cntry_name')->get();




        $vouchers   = DB::table('qsettings_voucher')->select('id', 'voucher_name')->where('del_flag', 1)->where('branch', $branch)->get();


        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');

        $subledgertable = $subtable . 'ledgers';

        $subledgertables = DB::table($subtable . 'ledgers')->select('*')->get();



        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name as lname', $subledgertable . '.id as lid')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();
        $suppliers   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        // dd($vatlist);
        $buyvoucher =  DB::table('buy_voucher')->select('*')->where('id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        $buyvoucherproducts =  DB::table('buy_voucher_products')->select('*')->where('main_voucher_id', $id)->where('del_flag', 1)->where('branch', $branch)->get();
        foreach ($buyvoucher as $key => $value) {
            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->cust_id)->get();
        }
        $accounthead =  DB::table('buy_account_head')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();

        return view('buy.voucher.edit', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'vouchers', 'account_heads', 'suppliers', 'subledgertables', 'buyvoucher', 'buyvoucherproducts', 'pname', 'accounthead'));
    }


    public function buy_voucher_update(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $data = [
            'voucher_type' => $request->voucher_type,
            'purchase_type' => $request->purchase_type,
            'bill_id' => $request->bill_id,
            'quotedate'   => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'entrydate'   => Carbon::parse($request->entrydate)->format('Y-m-d'),
            'dateofsupply'   => Carbon::parse($request->dateofsupply)->format('Y-m-d'),
            'po_wo_ref' => $request->po_wo_ref,
            'salesman'         => $request->salesman,
            'currency' => $request->currency,
            'currencyvalue' => $request->currencyvalue,
            'terms'     => $request->terms,
            'notes' => $request->notes,
            'internalreference' => $request->internalreference,
            'tpreview' => $request->tpreview,
            'cust_id' => $request->cust_id,
            'totalamount' => $request->totalamount,
            'discount' => $request->discount,
            'amountafterdiscount' => $request->amountafterdiscount,
            'totalvatamount' => $request->totalvatamount,
            'grandtotalamount' => $request->grandtotalamount,
            'paidamount' => $request->paidamount,
            'balanceamount' => $request->balanceamount,
            'branch' => $branch,
        ];
        DB::table('buy_voucher')->where('id', $id)->update($data);
        DB::table('buy_voucher_products')->where('main_voucher_id', $id)->delete();
        for ($i = 0; $i < count($request->head_name); $i++) {
            //


            $query = DB::table('buy_account_head')->select('head_name', 'id')->where('head_name', $request->head_name[$i])->where('del_flag', 1)->where('branch', $branch)->get();

            if ($query->count() > 0) {
                foreach ($query as $key => $value) {
                    $head_id = $value->id;
                }
            } else {
                $data = [
                    'head_name' => $request->head_name[$i],
                    'head_description' => $request->product_description[$i],
                    'account_head_ledger' => $request->ledger[$i],
                    'branch' => $branch
                ];
                $head_product = DB::table('buy_account_head')->insert($data);
                $head_id = DB::getPdo()->lastInsertId();
            }
            //

            $data = [
                'main_voucher_id' => $id,
                'head_name' => $head_id,
                'ledger'     => $request->ledger[$i],
                'product_description'         => $request->product_description[$i],
                'amount' => $request->amount[$i],
                'unit' => $request->unit[$i],
                'quantity' => $request->quantity[$i],
                'rate' => $request->rate[$i],
                'vat_percentage' => $request->vat_percentage[$i],
                'vatamount' => $request->vatamount[$i],
                'rdiscount' => $request->rdiscount[$i],
                'row_total'  => $request->row_total[$i],
                'branch' => $branch
            ];
            $voucher_product = DB::table('buy_voucher_products')->insert($data);
        }



        /////////////////////////////////////////////

        $oentry_id = DB::table('buy_voucher')->where('id', $id)->value('entry_id');

        //get supplier ledger
        $supplier_id = $request->cust_id;
        $supplier_ledger = DB::table('qcrm_supplier')->where('id', $supplier_id)->select('main_ledger')->value('main_ledger');


        //get sales ledger
        $purchase_account = 0;
        $purchase_account = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('purchase_account');

        //get vat ledger
        $input_vat_ledger = 0;
        $input_vat_ledger = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('input_vat_ledger');

        //get entry type

        $purchase_invoice_entry_type = 0;
        $purchase_invoice_entry_type = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('purchase_invoice_entry_type');

        //get number
        $number = $this->nextNumber($purchase_invoice_entry_type);

        //pass entry to accounting

        $data_accounts = [
            'entrytype_id'   => $purchase_invoice_entry_type,
            'number'         => $number,
            'date'           => date("Y-m-d"),
            'dr_total'       => abs($request->grandtotalamount),
            'cr_total'       => abs($request->grandtotalamount),


        ];



        /* $main_entry = DB::table('a_branch1_entries')->insert($data_accounts);
$main_entry_id =DB::getPdo()->lastInsertId();*/
        DB::table('a_branch1_entries')->where('id', $oentry_id)->update($data_accounts);


        DB::table('a_branch1_entryitems')->where('entry_id', $oentry_id)->delete();



        $main_entry_id = $oentry_id;


        $data_accounts_items = [
            'entry_id'   => $main_entry_id,
            'ledger_id'  => $supplier_ledger,
            'amount'     => abs($request->grandtotalamount),
            'dc'         => 'D',
            'narration'         => '-',
        ];
        DB::table('a_branch1_entryitems')->insert($data_accounts_items);
        $data_accounts_items = [
            'entry_id'   => $main_entry_id,
            'ledger_id'  => $purchase_account,
            'amount'     => abs($request->totalamount),
            'dc'         => 'C',
            'narration'         => '-',
        ];




        DB::table('a_branch1_entryitems')->insert($data_accounts_items);


        $data_accounts_items = [
            'entry_id'   => $main_entry_id,
            'ledger_id'  => $input_vat_ledger,
            'amount'     => abs($request->totalvatamount),
            'dc'         => 'C',
            'narration'         => '-',
        ];




        DB::table('a_branch1_entryitems')->insert($data_accounts_items);


        //save entry id in sales table
        DB::table('buy_voucher')->where('id', $id)->update(['entry_id' => $main_entry_id]);


        /////////////////////////////////////////////////////////////////////////////////////////////

    }
}

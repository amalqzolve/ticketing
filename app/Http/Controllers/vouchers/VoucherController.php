<?php

namespace App\Http\Controllers\vouchers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Session;

use App\crm\CustomerCategoryModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\buy\BuyAccountModel;
use App\User;

use App\vouchers\VoucherModel;
use App\vouchers\VoucherSynthesisModel;
use App\vouchers\VoucherApprovalTransactionModel;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequiredVoucher;
use App\settings\BranchSettingsModel;


class VoucherController extends Controller
{

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = VoucherModel::select('buy_voucher.*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->Where('buy_voucher.del_flag', 1)
                ->Where('buy_voucher.status', 1)
                ->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dataTble->make(true);
        } else
            return view('vouchers.voucher.list');
    }

    public function listSend(Request $request)
    {
        if ($request->ajax()) {
            $data = VoucherModel::select('buy_voucher.*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->Where('buy_voucher.del_flag', 1)
                ->Where('buy_voucher.status', 2)
                ->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dataTble->make(true);
        } else
            return null;
    }

    public function listApproved(Request $request)
    {
        if ($request->ajax()) {
            $data = VoucherModel::select('buy_voucher.*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->Where('buy_voucher.del_flag', 1)
                ->Where('buy_voucher.status', 6)
                ->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dataTble->make(true);
        } else
            return null;
    }

    public function listRejected(Request $request)
    {
        if ($request->ajax()) {
            $data = VoucherModel::select('buy_voucher.*', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser', 'buy_voucher.id as vid')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->Where('buy_voucher.del_flag', 1)
                ->Where('buy_voucher.status', 4)
                ->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dataTble->make(true);
        } else
            return null;
    }


    public function add(Request $request)
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
        $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
        $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = countryModel::select('id', 'cntry_name')->get();


        $vouchers   = DB::table('qsettings_voucher')->select('id', 'voucher_name')->where('del_flag', 1)->where('branch', $branch)->get();


        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers';
        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name as lname', $subledgertable . '.id as lid')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();
        $suppliers   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        // dd($vatlist);
        return view('vouchers.voucher.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'vouchers', 'account_heads', 'suppliers'));
    }


    public function save(Request $request)
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
            'cust_category' => $request->cust_category,
            'cust_code' => $request->cust_code,
            'cust_type' => $request->cust_type,
            'cust_name' => $request->cust_name,
            'cust_id' => $request->cust_id,
            'cust_country' => $request->cust_country,
            'building_no' => $request->building_no,
            'cust_region' => $request->cust_region,
            'cust_district' => $request->cust_district,
            'cust_city' => $request->cust_city,
            'cust_zip' => $request->cust_zip,
            'mobile' => $request->mobile,
            'vatno' => $request->vatno,
            'buyerid_crno' => $request->buyerid_crno,
            'totalamount' => $request->totalamount,
            'discount' => $request->discount,
            'amountafterdiscount' => $request->amountafterdiscount,
            'totalvatamount' => $request->totalvatamount,
            'grandtotalamount' => $request->grandtotalamount,
            'paidamount' => $request->paidamount,
            'balanceamount' => $request->balanceamount,
            'branch' => $branch,
        ];
        $postID = null; //$request->id;
        $main_voucher = VoucherModel::updateOrCreate(['id' => $postID], $data);
        $postID = $main_voucher->id;
        //vat
        $datavat = [
            'sale_order_id' => '',
            'purchaseorder_id' => $postID,
            'type' => 1,
            'date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'totalamount'   => $request->totalamount,
            'sales_vatamount'     => $request->totalvatamount,
            'sgrandtotalamount' => $request->grandtotalamount,
            'branch' => $branch,
        ];
        $vat = DB::table('qpurchase_vatfiling')->insert($datavat);
        //vat

        //soa
        $met = 0;
        $transaction_type = "";
        $method = DB::table('buy_voucher')->select('*')->where('id', $postID)->get();
        foreach ($method as $methods) {
            $a = $methods->purchase_type;
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
            'doc_id'          => $postID,
            'doc_transaction' => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'transaction_type' => $transaction_type,
            'totalamount'     => $request->grandtotalamount,
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
                'main_voucher_id' => $postID,
                'head_name' => $head_id,
                'ledger'     => $request->ledger[$i],
                'product_description'         => $request->product_description[$i],
                'unit' => $request->unit[$i],
                'quantity'   => $request->quantity[$i],
                'rate'     => $request->rate[$i],
                'amount' => $request->amount[$i],
                'vatamount' => $request->vatamount[$i],
                'vat_percentage' => $request->vat_percentage[$i],
                'rdiscount' => $request->rdiscount[$i],
                'row_total' => $request->row_total[$i],
                'branch' => $branch
            ];
            $voucher_product = DB::table('buy_voucher_products')->insert($data);
        }
        return 'true';
    }



    public function update(Request $request)
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
            'cust_category' => $request->cust_category,
            'cust_code' => $request->cust_code,
            'cust_type' => $request->cust_type,
            'cust_name' => $request->cust_name,
            'cust_id' => $request->cust_id,
            'cust_country' => $request->cust_country,
            'building_no' => $request->building_no,
            'cust_region' => $request->cust_region,
            'cust_district' => $request->cust_district,
            'cust_city' => $request->cust_city,
            'cust_zip' => $request->cust_zip,
            'mobile' => $request->mobile,
            'vatno' => $request->vatno,
            'buyerid_crno' => $request->buyerid_crno,
            'totalamount' => $request->totalamount,
            'discount' => $request->discount,
            'amountafterdiscount' => $request->amountafterdiscount,
            'totalvatamount' => $request->totalvatamount,
            'grandtotalamount' => $request->grandtotalamount,
            'paidamount' => $request->paidamount,
            'balanceamount' => $request->balanceamount,
            'branch' => $branch,
        ];
        $postID = $request->id;
        $main_voucher = VoucherModel::updateOrCreate(['id' => $postID], $data);
        $postID = $main_voucher->id;
        //vat
        DB::table('qpurchase_vatfiling')->where('purchaseorder_id', $postID)->delete();
        $datavat = [
            'sale_order_id' => '',
            'purchaseorder_id' => $postID,
            'type' => 1,
            'date' => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'totalamount'   => $request->totalamount,
            'sales_vatamount'     => $request->totalvatamount,
            'sgrandtotalamount' => $request->grandtotalamount,
            'branch' => $branch,
        ];
        $vat = DB::table('qpurchase_vatfiling')->insert($datavat);
        //vat

        //soa
        $met = 0;
        $transaction_type = "";
        $method = DB::table('buy_voucher')->select('*')->where('id', $postID)->get();
        foreach ($method as $methods) {
            $a = $methods->purchase_type;
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
        DB::table('qpurchase_purchase_soa')->where('doc_id', $postID)->delete();
        $soa = [
            'doc_type'        => 'Purchase',
            'doc_id'          => $postID,
            'doc_transaction' => Carbon::parse($request->quotedate)->format('Y-m-d'),
            'transaction_type' => $transaction_type,
            'totalamount'     => $request->grandtotalamount,
            'customer_id'     => $request->cust_id,
            'paid_amount'     => $met,
            'branch'          => $branch,
            'cr_amount'          => $cr_amount,
            'dr_amount'          => $dr_amount,
        ];
        DB::table('qpurchase_purchase_soa')->insert($soa);

        //soa
        DB::table('buy_voucher_products')->where('main_voucher_id', $postID)->delete();
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
                'main_voucher_id' => $postID,
                'head_name' => $head_id,
                'ledger'     => $request->ledger[$i],
                'product_description'         => $request->product_description[$i],
                'unit' => $request->unit[$i],
                'quantity'   => $request->quantity[$i],
                'rate'     => $request->rate[$i],
                'amount' => $request->amount[$i],
                'vatamount' => $request->vatamount[$i],
                'vat_percentage' => $request->vat_percentage[$i],
                'rdiscount' => $request->rdiscount[$i],
                'row_total' => $request->row_total[$i],
                'branch' => $branch
            ];
            $voucher_product = DB::table('buy_voucher_products')->insert($data);
        }
        return 'true';
    }

    public function editView(Request $request)
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
        $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
        $areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
        $country = countryModel::select('id', 'cntry_name')->get();


        $vouchers   = DB::table('qsettings_voucher')->select('id', 'voucher_name')->where('del_flag', 1)->where('branch', $branch)->get();


        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers';
        $account_heads = BuyAccountModel::select('buy_account_head.id', 'head_name', 'head_description', $subledgertable . '.name as lname', $subledgertable . '.id as lid')->leftjoin($subledgertable, 'buy_account_head.account_head_ledger', '=', $subledgertable . '.id')->Where('del_flag', 1)->where('branch', $branch)->get();
        $suppliers   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();

        $id =  $request->id;
        $voucher =  VoucherModel::select('buy_voucher.*', 'qcrm_termsandconditions.description')
            ->leftjoin('qcrm_termsandconditions', 'buy_voucher.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);

        $products = DB::table('buy_voucher_products')->select('buy_voucher_products.*', 'buy_account_head.head_name as hed')
            ->leftjoin('buy_account_head', 'buy_voucher_products.head_name', '=', 'buy_account_head.id')
            ->where('main_voucher_id', $id)->get();


        return view('vouchers.voucher.edit', compact('voucher', 'products', 'branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'vouchers', 'account_heads', 'suppliers'));
    }

    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = VoucherModel::select(
            'buy_voucher.id',
            'qsettings_voucher.voucher_name as voucher_type',
            'buy_voucher.purchase_type',
            'buy_voucher.bill_id',
            'buy_voucher.quotedate',
            'buy_voucher.entrydate',
            'buy_voucher.dateofsupply',
            'buy_voucher.po_wo_ref',
            'qcrm_salesman_details.name as salesman',
            'qpurchase_currency.currency_name as currency',
            'buy_voucher.currencyvalue',
            'buy_voucher.cust_name',
            'buy_voucher.totalamount',
            'buy_voucher.discount',
            'buy_voucher.amountafterdiscount',
            'buy_voucher.totalvatamount',
            'buy_voucher.grandtotalamount',
            'buy_voucher.paidamount',
            'buy_voucher.balanceamount',
            'buy_voucher.notes',
            'qcrm_termsandconditions.description',
            'buy_voucher.status'
        )
            ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
            ->leftjoin('qpurchase_currency', 'buy_voucher.currency', '=', 'qpurchase_currency.id')
            ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
            ->leftjoin('qcrm_termsandconditions', 'buy_voucher.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);


        $products = DB::table('buy_voucher_products')->select('qinventory_product_unit.unit_name', 'buy_account_head.head_name', 'buy_voucher_products.ledger', 'buy_voucher_products.product_description', 'buy_voucher_products.quantity', 'buy_voucher_products.rate', 'buy_voucher_products.amount', 'buy_voucher_products.vatamount', 'buy_voucher_products.vat_percentage', 'buy_voucher_products.rdiscount', 'buy_voucher_products.row_total')
            ->leftJoin('qinventory_product_unit', 'buy_voucher_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('buy_account_head', 'buy_voucher_products.head_name', 'buy_account_head.id')
            ->where('buy_voucher_products.main_voucher_id', '=', $id)
            ->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = VoucherApprovalTransactionModel::select('voucher_approval_transaction.status', 'voucher_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'voucher_approval_transaction.updated_at')
                ->leftjoin('voucher_synthesis', 'voucher_approval_transaction.voucher_synthesis_id', '=', 'voucher_synthesis.id')
                ->leftjoin('users', 'voucher_synthesis.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('voucher_approval_transaction.voucher_id', '=', $id)
                ->orderBy('voucher_approval_transaction.id', 'asc')
                ->get();


            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                if ($value->status_changed_by != null) {
                    $user = $this->getDescUser($value->status_changed_by);
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $user->name,
                        'sign' => $user->sign,
                        'designation' => $user->designation,
                        'department' => $user->department,
                        'status' => $value->status,
                    );
                } else {
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $value->name,
                        'sign' => $value->sign,
                        'designation' => $value->designation,
                        'department' => $value->department,
                        'status' => $value->status,
                    );
                }
                return $outArray;
            });
        } else
            $approvalLevel = array();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'VC ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->quotedate));
        $pdf = PDF::loadView('vouchers.voucher.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }

    public function send(Request $request)
    {
        $createdBy = Auth::user()->id;
        $id = $request->id;

        $voucher = VoucherModel::select('buy_voucher.voucher_type')->find($id);
        // ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
        if ($voucher) {
            $workflow =  VoucherSynthesisModel::select('voucher_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'voucher_synthesis.user_id', '=', 'users.id')
                ->where('voucher_synthesis.qsettings_voucher_id', '=', $voucher->voucher_type)->orderBy('priority', 'asc')->get();
            $i = 0;
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'voucher_synthesis_id' => $value->id,
                    'voucher_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = VoucherApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('Voucher', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
                $i++;
            }
            if ($i != 0) {
                $data = array('status' => 2);
                VoucherModel::find($id)->update($data);
                $out = array(
                    'status' => 1,
                    'msg' => 'success',
                );
            } else {
                $out = array(
                    'status' => 0,
                    'msg' => 'Voucher Approval Sysnthesis Not Found Contact Admin !!',
                );
            }
            echo json_encode($out);
        } else {
            $out = array(
                'status' => 0,
                'msg' => 'error Please Try After Some time',
            );
            echo json_encode($out);
        }
    }

    public function sendMail($docType = 'Voucher', $docId, $toMailId, $transactionId, $userName, $date)
    {

        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now()
        ];
        DB::table('email_verify_keys_voucher')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'Voucher';
        $data['document'] = 'VC';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequiredVoucher($data));
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }
}

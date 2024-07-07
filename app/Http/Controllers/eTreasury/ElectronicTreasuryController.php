<?php

namespace App\Http\Controllers\eTreasury;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\EprSupplierPaymentModel;
use App\procurement\EprSupplierPaymentProductsModel;

use App\procurement\EprPaymentVoucherModel;
use App\procurement\EprIssuedPaymentVoucherModel;
use App\vouchers\VoucherModel;

use App\procurement\EprPoProductsModel;
use App\procurement\EprPoModel;

use App\crm\SupplierBank;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;

class ElectronicTreasuryController extends Controller
{

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = EprSupplierPaymentModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), 'epr_po.id as po_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status', 'epr_supplier_payment.payment_voucher_status', 'epr_supplier_payment.payment_voucher_status')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->where('epr_supplier_payment.status', 6)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else {
            return view('eTreasury.electronicTreasury.list');
        }
    }


    public function listVouchers(Request $request)
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
            return Null;
    }

    public function voucherPdf(Request $request)
    {
        return redirect()->route('voucher-pdf', 'id=' . $request->id);
    }

    public function generatedVoucherList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPaymentVoucherModel::select('epr_payment_voucher.id', DB::raw("DATE_FORMAT(epr_payment_voucher.voucher_date, '%d-%m-%Y') as voucher_date"), 'epr_payment_voucher.payment_method', 'epr_payment_voucher.voucher_reference', 'qcrm_supplier.sup_name', 'epr_payment_voucher.invoice_id', 'epr_payment_voucher.supplier_payement_id', 'epr_payment_voucher.amount', 'epr_payment_voucher.status')
                ->leftjoin('qcrm_supplier', 'epr_payment_voucher.supplier_id', '=', 'qcrm_supplier.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else
            return null;
    }
    public function  issuePaymentVoucherList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprIssuedPaymentVoucherModel::select('epr_issued_payment_voucher.id', 'epr_issued_payment_voucher.voucher_id', DB::raw("DATE_FORMAT(epr_payment_voucher.voucher_date, '%d-%m-%Y') as voucher_date"), 'epr_payment_voucher.id as payment_voucher_id', 'epr_payment_voucher.payment_method', 'epr_payment_voucher.amount', 'epr_issued_payment_voucher.receiver_name', 'epr_issued_payment_voucher.relation_with_supplier', 'epr_issued_payment_voucher.designation', 'epr_issued_payment_voucher.department', 'epr_issued_payment_voucher.national_id', 'epr_issued_payment_voucher.phone_number', DB::raw("DATE_FORMAT(epr_issued_payment_voucher.issued_date, '%d-%m-%Y') as issued_date"), 'users.name')
                ->leftjoin('epr_payment_voucher', 'epr_issued_payment_voucher.voucher_id', '=', 'epr_payment_voucher.id')
                ->leftjoin('users', 'epr_issued_payment_voucher.created_by', '=', 'users.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('req_amount', function ($row) {
                $created = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $row->id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else
            return null;
    }


    public function generatePaymentVoucheVc(Request $request)
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
            'buy_voucher.cust_id', //supplier_id
            'buy_voucher.cust_name',
            'qcrm_customer_categorydetails.customer_category as cust_category',
            'buy_voucher.cust_code',
            'qcrm_customer_typedetails.title as cust_type',
            'countries.cntry_name as cust_country',
            'buy_voucher.building_no',
            'buy_voucher.cust_region',
            'buy_voucher.cust_district',
            'buy_voucher.cust_city',
            'buy_voucher.cust_zip',
            'buy_voucher.mobile',
            'buy_voucher.vatno',
            'buy_voucher.buyerid_crno',
            'buy_voucher.totalamount',
            'buy_voucher.discount',
            'buy_voucher.amountafterdiscount',
            'buy_voucher.totalvatamount',
            'buy_voucher.grandtotalamount',
            'buy_voucher.paidamount',
            'buy_voucher.balanceamount',
        )
            ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
            ->leftjoin('qpurchase_currency', 'buy_voucher.currency', '=', 'qpurchase_currency.id')
            ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
            ->leftjoin('qcrm_customer_categorydetails', 'buy_voucher.cust_category', '=', 'qcrm_customer_categorydetails.id')
            ->leftjoin('qcrm_customer_typedetails', 'buy_voucher.cust_type', '=', 'qcrm_customer_typedetails.id')
            ->leftjoin('countries', 'buy_voucher.cust_country', '=', 'countries.id')
            ->find($id);
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers'; //Take id,name for ledger dropdown
        $accounts = DB::table($subledgertable)->select('id', 'name')->get();
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->get();
        $bank = SupplierBank::select('id', 'bank_name', 'iban_swift_code')->get();
        return view('eTreasury.electronicTreasury.generatePaymentVoucherVc', compact('mainData', 'accounts', 'termslist', 'bank'));
    }


    public function generatePaymentVoucherVcAdd(Request $request)
    {
        $inArray = array(
            // 'epr_id' => $request->epr_id,
            // 'po_id' => $request->po_id,
            // 'invoice_id' => $request->invoice_id,
            'buy_voucher_id' => $request->buy_voucher_id,
            'supplier_id' => $request->supplier_id,
            'payment_cr_account' => $request->payment_cr_account,
            'voucher_date' => Carbon::parse($request->voucher_date)->format('Y-m-d  h:i'),
            'voucher_notes' => $request->voucher_notes,
            'voucher_reference' => $request->voucher_reference,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'cash_transaction_id' => $request->cash_transaction_id,
            'cash_transaction_referance' => $request->cash_transaction_referance,
            'bank_account' => $request->bank_account,
            'bank_transaction_id' => $request->bank_transaction_id,
            'bank_transaction_referance' => $request->bank_transaction_referance,
            'cheque_number' => $request->cheque_number,
            'cheque_date' => Carbon::parse($request->cheque_date)->format('Y-m-d  h:i'),
            'cheque_transaction_id' => $request->cheque_transaction_id,
            'cheque_transaction_referance' => $request->cheque_transaction_referance,
            'card_transaction_id' => $request->card_transaction_id,
            'card_transaction_reference' => $request->card_transaction_reference,
            'internalreference' => $request->internalreference,
            'notes' => $request->notes,
            'terms' => $request->terms,
            'created_by' => Auth::user()->id
        );
        $postID = null;
        $mr = EprPaymentVoucherModel::updateOrCreate(['id' => $postID], $inArray);

        VoucherModel::find($request->buy_voucher_id)->update(['payment_voucher_status' => 2]);

        $out = array(
            'status' => 1,
            'msg' => 'success'
        );
        echo json_encode($out);
    }

    public function generatePaymentVoucher(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprSupplierPaymentModel::select('epr_supplier_payment.epr_id', 'epr_supplier_payment.po_id', 'epr_supplier_payment.invoice_id', 'epr_supplier_payment.id as supplier_payement_id', 'epr_po.supplier_id', 'qcrm_supplier.sup_name', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'ma_category.name as ma_categoryname', 'material_request.request_priority', 'material_request.request_against', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as project', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_po.id as po_id', 'epr_po.po_date', 'epr_po_invoice.id as invoice_id', 'epr_po_invoice.supplier_invoice_over_due_date as payement_book_date', 'epr_po_invoice.supplier_invoice_number', 'epr_po_invoice.supplier_invoice_date')
            ->leftjoin('material_request', 'epr_supplier_payment.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
            ->find($id);
        $amount = EprSupplierPaymentProductsModel::where('epr_supplier_payment_id', '=', $id)->sum('amount');

        $branch = Session::get('branch');
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers'; //Take id,name for ledger dropdown
        $accounts = DB::table($subledgertable)->select('id', 'name')->get();
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->get();
        $bank = SupplierBank::select('id', 'bank_name', 'iban_swift_code')->get();
        // ->where('suppler_id', $MaterialRequest->supplier_id)
        return view('eTreasury.electronicTreasury.generatePaymentVoucher', compact('MaterialRequest', 'amount', 'accounts', 'termslist', 'bank'));
    }


    public function generatePaymentVoucherAdd(Request $request)
    {
        $inArray = array(
            'epr_id' => $request->epr_id,
            'po_id' => $request->po_id,
            'invoice_id' => $request->invoice_id,
            'supplier_payement_id' => $request->supplier_payement_id,
            'supplier_id' => $request->supplier_id,
            'payment_cr_account' => $request->payment_cr_account,
            'voucher_date' => Carbon::parse($request->voucher_date)->format('Y-m-d  h:i'),
            'voucher_notes' => $request->voucher_notes,
            'voucher_reference' => $request->voucher_reference,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'cash_transaction_id' => $request->cash_transaction_id,
            'cash_transaction_referance' => $request->cash_transaction_referance,
            'bank_account' => $request->bank_account,
            'bank_transaction_id' => $request->bank_transaction_id,
            'bank_transaction_referance' => $request->bank_transaction_referance,
            'cheque_number' => $request->cheque_number,
            'cheque_date' => Carbon::parse($request->cheque_date)->format('Y-m-d  h:i'),
            'cheque_transaction_id' => $request->cheque_transaction_id,
            'cheque_transaction_referance' => $request->cheque_transaction_referance,
            'card_transaction_id' => $request->card_transaction_id,
            'card_transaction_reference' => $request->card_transaction_reference,
            'internalreference' => $request->internalreference,
            'notes' => $request->notes,
            'terms' => $request->terms,
            'created_by' => Auth::user()->id
        );
        $postID = null;
        $mr = EprPaymentVoucherModel::updateOrCreate(['id' => $postID], $inArray);

        EprSupplierPaymentModel::find($request->supplier_payement_id)->update(['payment_voucher_status' => 2]);

        $out = array(
            'status' => 1,
            'msg' => 'success'
        );
        echo json_encode($out);
    }

    public function generatePaymentVoucherPdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPaymentVoucherModel::select(
            'epr_payment_voucher.id',
            'epr_payment_voucher.payment_cr_account',
            'epr_payment_voucher.voucher_date',
            'epr_payment_voucher.voucher_notes',
            'epr_payment_voucher.voucher_reference',
            'epr_payment_voucher.amount',
            'epr_payment_voucher.payment_method',
            'epr_payment_voucher.cash_transaction_id',
            'epr_payment_voucher.cash_transaction_referance',
            'epr_payment_voucher.bank_account',
            'qcrm_supplier_bank_details.bank_name',
            'qcrm_supplier_bank_details.iban_swift_code',
            'epr_payment_voucher.bank_transaction_id',
            'epr_payment_voucher.bank_transaction_referance',
            'epr_payment_voucher.cheque_number',
            'epr_payment_voucher.cheque_date',
            'epr_payment_voucher.cheque_transaction_id',
            'epr_payment_voucher.cheque_transaction_referance',
            'epr_payment_voucher.card_transaction_id',
            'epr_payment_voucher.card_transaction_reference',
            'epr_payment_voucher.internalreference',
            'epr_payment_voucher.notes',
            'epr_payment_voucher.status',
            'qcrm_termsandconditions.description',
            'qcrm_supplier.sup_name',
            'users.name as created_name',
        )
            ->leftjoin('users', 'epr_payment_voucher.created_by', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_payment_voucher.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_supplier_bank_details', 'epr_payment_voucher.bank_account', '=', 'qcrm_supplier_bank_details.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_payment_voucher.terms', '=', 'qcrm_termsandconditions.id')
            ->where('epr_payment_voucher.id', $id)->first();
        $subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
        $subledgertable = $subtable . 'ledgers'; //Take id,name for ledger dropdown
        // die();
        if (isset($mainData->payment_cr_account))
            $accounts = DB::table($subledgertable)->select('id', 'name')->where('id', $mainData->payment_cr_account)->first();
        else
            $accounts = array();
        if (isset($accounts->name))
            $payment_cr_account = $accounts->name;
        else
            $payment_cr_account = '';
        $products = array();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'G-PV ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->voucher_date));
        $pdf = PDF::loadView('eTreasury.electronicTreasury.previewPaymentVoucher', compact('mainData', 'branchsettings', 'products', 'payment_cr_account'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }


    public function issuePayment(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPaymentVoucherModel::select('epr_payment_voucher.epr_id', 'epr_payment_voucher.po_id', 'epr_payment_voucher.invoice_id', 'epr_payment_voucher.supplier_payement_id', 'epr_payment_voucher.supplier_id', 'epr_payment_voucher.id', 'epr_payment_voucher.supplier_id', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'ma_category.name as ma_categoryname', 'material_request.request_priority', 'material_request.request_against', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as project', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_po.id as po_id', 'epr_po.po_date', 'epr_po_invoice.id as invoice_id', 'epr_po_invoice.supplier_invoice_over_due_date as payement_book_date', 'epr_po_invoice.supplier_invoice_number', 'epr_po_invoice.supplier_invoice_date', 'epr_payment_voucher.amount')
            ->leftjoin('material_request', 'epr_payment_voucher.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftjoin('epr_po', 'epr_payment_voucher.po_id', '=', 'epr_po.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('epr_po_invoice', 'epr_payment_voucher.invoice_id', '=', 'epr_po_invoice.id')
            ->find($id);

        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->get();

        if ($MaterialRequest->epr_id)
            return view('eTreasury.electronicTreasury.issuePayment', compact('MaterialRequest', 'termslist'));
        else {
            $mainData = EprPaymentVoucherModel::select(
                'epr_payment_voucher.id',
                'epr_payment_voucher.supplier_id',
                'epr_payment_voucher.buy_voucher_id',
                'epr_payment_voucher.amount',
                // 'buy_voucher.id',
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
                'buy_voucher.cust_id', //supplier_id
                'buy_voucher.cust_name',
                'qcrm_customer_categorydetails.customer_category as cust_category',
                'buy_voucher.cust_code',
                'qcrm_customer_typedetails.title as cust_type',
                'countries.cntry_name as cust_country',
                'buy_voucher.building_no',
                'buy_voucher.cust_region',
                'buy_voucher.cust_district',
                'buy_voucher.cust_city',
                'buy_voucher.cust_zip',
                'buy_voucher.mobile',
                'buy_voucher.vatno',
                'buy_voucher.buyerid_crno',
                'buy_voucher.totalamount',
                'buy_voucher.discount',
                'buy_voucher.amountafterdiscount',
                'buy_voucher.totalvatamount',
                'buy_voucher.grandtotalamount',
                'buy_voucher.paidamount',
                'buy_voucher.balanceamount',
            )
                ->leftjoin('buy_voucher', 'epr_payment_voucher.buy_voucher_id', '=', 'buy_voucher.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->leftjoin('qpurchase_currency', 'buy_voucher.currency', '=', 'qpurchase_currency.id')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_customer_categorydetails', 'buy_voucher.cust_category', '=', 'qcrm_customer_categorydetails.id')
                ->leftjoin('qcrm_customer_typedetails', 'buy_voucher.cust_type', '=', 'qcrm_customer_typedetails.id')
                ->leftjoin('countries', 'buy_voucher.cust_country', '=', 'countries.id')
                ->find($id);
            return view('eTreasury.electronicTreasury.issuePaymentVc', compact('mainData', 'termslist'));
        }
    }

    public function issuePaymentVoucherAdd(Request $request)
    {
        $inArray = array(
            'epr_id' => $request->epr_id,
            'po_id' => $request->po_id,
            'invoice_id' => $request->invoice_id,
            'supplier_payement_id' => $request->supplier_payement_id,
            'buy_voucher_id' => $request->buy_voucher_id,
            'supplier_id' => $request->supplier_id,
            'voucher_id' => $request->voucher_id,
            'receiver_name' => $request->receiver_name,
            'relation_with_supplier' => $request->relation_with_supplier,
            'designation' => $request->designation,
            'department' => $request->department,
            'national_id' => $request->national_id,
            'phone_number' => $request->phone_number,
            'issued_date' => Carbon::parse($request->issued_date)->format('Y-m-d  h:i'),
            'comments' => $request->comments,
            'internalreference' => $request->internalreference,
            'notes' => $request->notes,
            'terms' => $request->terms,
            'internalreference' => $request->internalreference,
            'notes' => $request->notes,
            'terms' => $request->terms,
            'created_by' => Auth::user()->id
        );
        $postID = null;
        $mr = EprIssuedPaymentVoucherModel::updateOrCreate(['id' => $postID], $inArray);
        EprPaymentVoucherModel::find($request->voucher_id)->update(['status' => 2]);

        $ifPoFind =  EprPoModel::find($request->po_id);
        if ($ifPoFind) {
            $ifPoFind->increment('issued_payemnts_amount', $request->amount);
            $this->updatePOstatus($request->po_id);
        }

        $out = array(
            'status' => 1,
            'msg' => 'success'
        );
        echo json_encode($out);
    }


    public function updatePOstatus($id)
    {
        $products = EprPoProductsModel::select('quantity', 'amount')->where('epr_po_id', $id)->get();
        $qtyTotal = 0;
        $amountTotal = 0;
        foreach ($products as $key => $value) {
            $qtyTotal += $value->quantity;
            $amountTotal += $value->amount;
        }
        $po = EprPoModel::find($id);
        if ($po) {
            if (($po->warehouse_received_qty == $qtyTotal) && ($po->issued_payemnts_amount == $amountTotal)) {
                $po->update(['po_closed' => 1]);
            }
        }
    }

    public function issuePaymentVoucherPdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprIssuedPaymentVoucherModel::select(
            'epr_issued_payment_voucher.id',
            'epr_issued_payment_voucher.receiver_name',
            'epr_issued_payment_voucher.relation_with_supplier',
            'epr_issued_payment_voucher.designation',
            'epr_issued_payment_voucher.department',
            'epr_issued_payment_voucher.national_id',
            'epr_issued_payment_voucher.phone_number',
            'epr_issued_payment_voucher.issued_date',
            'epr_issued_payment_voucher.comments',
            'epr_issued_payment_voucher.internalreference',
            'epr_issued_payment_voucher.notes',
            'epr_issued_payment_voucher.status',
            'qcrm_termsandconditions.description',
            'qcrm_supplier.sup_name',
            'users.name as created_name',
        )
            ->leftjoin('users', 'epr_issued_payment_voucher.created_by', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_issued_payment_voucher.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_issued_payment_voucher.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'ISS-P ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->issued_date));
        $pdf = PDF::loadView('eTreasury.electronicTreasury.previewIssuePayment', compact('mainData', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }
}

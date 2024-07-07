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
use App\Traits\PurchaseTraits;
use App\Traits\AccountingActionsTrait;
use App\settings\BranchSettingsModel;
use Hashids\Hashids;

class AdvancePaymentController extends Controller
{
    use PurchaseTraits, AccountingActionsTrait;
    public function list(Request $request)
    {
        $branch = Session::get('branch');
        $user = Auth::user();
        if (!$request->ajax()) {
            return view('qpurchase.advancepayment.list');
        } else {
            $payments   = DB::table('qbuy_advancepayment')
                ->leftjoin('qcrm_supplier', 'qbuy_advancepayment.supplier_id', '=', 'qcrm_supplier.id')
                ->select('qbuy_advancepayment.*', 'qcrm_supplier.sup_name', DB::raw("DATE_FORMAT(qbuy_advancepayment.date, '%d-%m-%Y') as date"))
                ->where('qbuy_advancepayment.del_flag', 1)
                ->where('qbuy_advancepayment.branch', $branch)
                ->get();
            $dtTble = Datatables::of($payments)->addIndexColumn()
                ->addColumn('status', function ($row) use ($user) {
                    if ($row->status == 'Approved')
                        return '<span style="color:green;">Approved</span>';
                    if ($row->status == 'Draft')
                        return '<span style="color:gray;">Draft</span>';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $j = '';
                    $hashids = new Hashids();

                    $j .= '<a href="qpurchase-advancepayment-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
                    <li class="kt-nav__item">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-eye"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
                        </span>
                    </li>
                </a>';

                    $j .= '<a href="Adpayment-Pdf_purchase?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-printer"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                            </span>
                        </li>
                    </a>';

                    if ($row->status == "Draft") {
                        $j .= '<a href="qpurchaseadvancepayment_edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                        <span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
                                    </span>
                                </li>
                            </a>';

                        $j .= '<a data-type="send" data-target="#kt_form">
                                <li class="kt-nav__item adwance_confirm" id="' . $row->id . '">
                                    <span class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
                                    </span>
                                </li>
                            </a>';

                        $j .= '<a data-type="send" data-target="#kt_form">
                                    <li class="kt-nav__item adwance_delete" id="' . $row->id . '">
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
                })->rawColumns(['action', 'status']);
            return  $dtTble->make(true);
        }
    }
    public function add(Request $request)
    {
        $branch = Session::get('branch');
        $suppliers   = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('del_flag', 1)->where('branch', $branch)->get();

        $this->connectToAccounting();
        $fullLedger = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get();
        return view('qpurchase.advancepayment.add', compact('suppliers', 'fullLedger'));
    }

    public function edit(Request $request)
    {
        $branch = Session::get('branch');
        $adwancePaymnt = DB::table('qbuy_advancepayment')->select('*')->where('id', $request->id)->where('branch', $branch)->first();
        if (isset($adwancePaymnt->id)) {
            $adwancePaymntMethods = DB::table('qbuy_advancepayment_payment_method')->select('*')->where('payid', $request->id)->get();
            $suppliers   = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('del_flag', 1)->where('branch', $branch)->get();
            // $bankDetails = DB::table('chart_of_account_details')->select('id', 'bank_name', 'branch_name')->where('branch', $branch)->get();

            $this->connectToAccounting();
            $fullLedger = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get();
            return view('qpurchase.advancepayment.edit', compact('suppliers', 'fullLedger', 'adwancePaymnt', 'adwancePaymntMethods'));
        } else
            return null;
    }

    public function view(Request $request, $id)
    {
        $hashids = new Hashids();
        $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;

        $branch = Session::get('branch');
        $adwancePaymnt = DB::table('qbuy_advancepayment')->select('*')->where('id', $id)->where('branch', $branch)->first();
        if (isset($adwancePaymnt->id)) {
            $adwancePaymntMethods = DB::table('qbuy_advancepayment_payment_method')->select('*')->where('payid', $id)->get();
            $suppliers   = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('del_flag', 1)->where('branch', $branch)->get();
            // $bankDetails = DB::table('chart_of_account_details')->select('id', 'bank_name', 'branch_name')->where('branch', $branch)->get();

            $this->connectToAccounting();
            $fullLedger = DB::connection('mysql_accounting')->table('ledgers')->where('type', 1)->get();
            return view('qpurchase.advancepayment.view', compact('suppliers', 'fullLedger', 'adwancePaymnt', 'adwancePaymntMethods'));
        } else
            return null;
    }

    public function submit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $branch = Session::get('branch');
            $data = [
                'purchaseno' => $request->purchaseno,
                'date' => Carbon::parse($request->date)->format('Y-m-d  h:i'),
                'notes' => $request->notes,
                'supplier_id' => $request->supplier,
                'branch' => $branch,
                'transactiontype' => $request->transactiontype,
                // 'accountledger_depositaccount' => $request->accountledger_depositaccount,
                'total_amount' => $request->total_amount,
                'status' => $request->status,
            ];
            if ($request->id == '') {
                $branch_settings = Session::get('branch_settings');
              //  $data['code'] = $branch_settings->purchasadvance_sufix . '' . sprintf("%03d", $branch);
                $payid = DB::table('qbuy_advancepayment')->insertGetId($data);
            } else {
                DB::table('qbuy_advancepayment')->where('id', $request->id)->update($data);
                $payid = $request->id;
                DB::table('qbuy_advancepayment_payment_method')->where('payid', $request->id)->delete();
            }
            $sum = 0;
            for ($i = 0; $i < count($request->accountledger_debitaccount); $i++) {
                $data = [
                    'payid' => $payid,
                    'accountledger_debitaccount' => $request->accountledger_debitaccount[$i],
                    'amounts'     => $request->amount[$i],
                    'branch' => $branch,
                    'preference' => $request->preference[$i],
                ];
                $methodes = DB::table('qbuy_advancepayment_payment_method')->insert($data);
                $sum += $request->amount[$i];
            }
            $this->purchaseAdwancePaymentAccountingEnrty($payid); //Accounting Entry
            $this->purchaseAdvanceSOAInsertion($payid, $branch); //SOA Entry
        });
    }

    public function approve(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->id;
            $branch = Session::get('branch');
            $adwance = DB::table('qbuy_advancepayment')->where('id', $id)->update(['status' => 'Approved']);
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
            $id = $request->id;
            $oldData = DB::table('qbuy_advancepayment')->select('id', 'supplier_payment_id', 'soa_id', 'acc_entries_id')->where('id', $id)->first();
            $this->deletePurchaseSOA($oldData->soa_id); //SOA deletion
            $this->deleteSupplierPayment($oldData->supplier_payment_id); //Supplier Payment deletion
            $this->entryItemsDelete($oldData->acc_entries_id); //Accounting Entry Delete
            DB::table('qbuy_advancepayment')->where('id', $id)->delete();
        });
        $out = array(
            'status' => 1,
            'msg' => "Deleted Successfully",
        );
        echo json_encode($out);
    }


    public function pdf(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        // $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*')->where('qcrm_customer_details.branch', $branch)->where('qcrm_customer_details.del_flag', 1)->get();
        $advancepayment = DB::table('qbuy_advancepayment')->select('qbuy_advancepayment.*', DB::raw("DATE_FORMAT(qbuy_advancepayment.date, '%d-%m-%Y') as tdate"))->where('qbuy_advancepayment.branch', $branch)->where('qbuy_advancepayment.del_flag', 1)->where('qbuy_advancepayment.id', $id)->get();
        $advancepayment_metod = DB::table('qbuy_advancepayment_payment_method')->select('qbuy_advancepayment_payment_method.*')->where('qbuy_advancepayment_payment_method.branch', $branch)->where('qbuy_advancepayment_payment_method.del_flag', 1)->where('qbuy_advancepayment_payment_method.payid', $id)->get();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
        foreach ($advancepayment as $key => $value) {
            $pname = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $value->supplier_id)->get();
        }
        $bname   = DB::table('qsettings_branch_details')->select('id', 'label')->where('id', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();

        $this->connectToAccounting();
        $ledgers = DB::connection('mysql_accounting')->table('ledgers')->get();
        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('qpurchase.advancepayment.preview1', compact('branch', 'branchsettings', 'advancepayment', 'advancepayment_metod', 'bname', 'companysettings', 'pname', 'ledgers'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('qpurchase.advancepayment.preview2', compact('branch', 'branchsettings', 'advancepayment', 'advancepayment_metod', 'bname', 'companysettings', 'pname', 'ledgers'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('qpurchase.advancepayment.preview3', compact('branch', 'branchsettings', 'advancepayment', 'advancepayment_metod', 'bname', 'companysettings', 'pname', 'ledgers'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('qpurchase.advancepayment.preview4', compact('branch', 'branchsettings', 'advancepayment', 'advancepayment_metod', 'bname', 'companysettings', 'pname', 'ledgers'));
        } else {
            $pdf = PDF::loadView('qpurchase.advancepayment.preview4', compact('branch', 'branchsettings', 'advancepayment', 'advancepayment_metod', 'bname', 'companysettings', 'pname', 'ledgers'));
        }
        return $pdf->stream('Advance Payment-#' . $id . '.pdf');
    }
}

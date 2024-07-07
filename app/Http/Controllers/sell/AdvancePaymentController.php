<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use DataTables;
use App\Traits\AccountingActionsTrait;
use App\Traits\SellTrails;


class AdvancePaymentController extends Controller
{
    use AccountingActionsTrait, SellTrails;
    public function advancepayment(Request $request)
    {
        $branch = Session::get('branch');
        $user = Auth::user();
        if (!$request->ajax()) {
            return view('sell.advancepayment.listing');
        } else {
            $advancepayments = DB::table('qsell_advancepayment')
                ->leftjoin('qcrm_customer_details', 'qsell_advancepayment.customer', '=', 'qcrm_customer_details.id')
                ->select('qsell_advancepayment.*', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.mobile1', DB::raw("DATE_FORMAT(qsell_advancepayment.date, '%d-%m-%Y') as date"))->where('qsell_advancepayment.branch', $branch)
                ->where('qsell_advancepayment.del_flag', 1)->get();
            $dtTble = Datatables::of($advancepayments)->addIndexColumn()
                ->addColumn('status', function ($row) use ($user) {
                    if ($row->status == 'Draft')
                        return '<span style="color:gray;">Draft</span>';
                    if ($row->status == 'Approved')
                        return '<span style="color:green;">Approved</span>';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $j = '';
                    $hasPermission = $user->can('Advance Receipts PDF');
                    if ($hasPermission) {
                        $j .= '<a href="Adpayment-Pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                        <li class="kt-nav__item">
                            <span class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-printer"></i>
                                <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                            </span>
                        </li>
                    </a>';
                    }
                    if ($row->status == "Draft") {
                        $j .= '<a href="advancepayment-edit?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
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
								<i class="kt-nav__link-icon flaticon-multimedia"></i>
								<span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
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
        // 


    }
    public function add(Request $request)
    {
        $branch = Session::get('branch');
        $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*')->where('qcrm_customer_details.branch', $branch)->where('qcrm_customer_details.del_flag', 1)->get();

        $this->connectToAccounting();

        $groups = DB::connection('mysql_accounting')->table('groups')->get();
        $ledgers = DB::connection('mysql_accounting')->table('ledgers')->get();
        $finalLedger = array();
        foreach ($groups as $key => $value) {

            $string = $value->code;
            $characterToCount = '-';
            $count = substr_count($string, $characterToCount);
            $elemnt = array(
                'id' => $value->id,
                'parent_id' => $value->parent_id,
                'name' => $value->name,
                'code' => $value->code,
                'count' => $count,
            );
            array_push($finalLedger, $elemnt);
        }

        $fullGroups = collect($finalLedger)->sortBy('code')->toArray();

        foreach ($ledgers as $key => $value) {
            $string = $value->code;
            $characterToCount = '-';
            $count = substr_count($string, $characterToCount);
            $elemnt = array(
                'id' => $value->id,
                'parent_id' => '~', //$value->parent_id,
                'name' => $value->name,
                'code' => $value->code,
                'count' => $count,
            );
            array_push($finalLedger, $elemnt);
        }
        $fullLedger = collect($finalLedger)->sortBy('code')->toArray();


        return view('sell.advancepayment.add', compact('customers', 'fullLedger'));
    }

    public function edit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $advancepayment = DB::table('qsell_advancepayment')->select('*')->where('id', $id)->where('branch', $branch)->first();
        if (isset($advancepayment->id)) {

            $advancepaymentMethode = DB::table('qsell_advancepayment_payment_method')->select('*')->where('payid', $id)->get();
            $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*')->where('qcrm_customer_details.branch', $branch)->where('qcrm_customer_details.del_flag', 1)->get();


            $this->connectToAccounting();

            $groups = DB::connection('mysql_accounting')->table('groups')->get();
            $ledgers = DB::connection('mysql_accounting')->table('ledgers')->get();
            $finalLedger = array();
            foreach ($groups as $key => $value) {

                $string = $value->code;
                $characterToCount = '-';
                $count = substr_count($string, $characterToCount);
                $elemnt = array(
                    'id' => $value->id,
                    'parent_id' => $value->parent_id,
                    'name' => $value->name,
                    'code' => $value->code,
                    'count' => $count,
                );
                array_push($finalLedger, $elemnt);
            }

            $fullGroups = collect($finalLedger)->sortBy('code')->toArray();

            foreach ($ledgers as $key => $value) {
                $string = $value->code;
                $characterToCount = '-';
                $count = substr_count($string, $characterToCount);
                $elemnt = array(
                    'id' => $value->id,
                    'parent_id' => '~', //$value->parent_id,
                    'name' => $value->name,
                    'code' => $value->code,
                    'count' => $count,
                );
                array_push($finalLedger, $elemnt);
            }
            $fullLedger = collect($finalLedger)->sortBy('code')->toArray();
            return view('sell.advancepayment.edit', compact('customers', 'fullLedger', 'advancepayment', 'advancepaymentMethode'));
        } else
            echo "error Advance Payment Not Found";
    }

    public function submit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $branch = Session::get('branch');
            $data = [
                'invoice_no' => $request->invoice_no,
                'date' => Carbon::parse($request->date)->format('Y-m-d  h:i'),
                'notes' => $request->notes,
                'customer' => $request->customer,
                'branch' => $branch,
                'transactiontype' => $request->transactiontype,
                'accountledger_depositaccount' => $request->accountledger_depositaccount,
                'total_amount' => $request->total_amount,
                'status' => $request->status
            ];

            if ($request->id == '') {
                $payid = DB::table('qsell_advancepayment')->insertGetId($data);
            } else {
                DB::table('qsell_advancepayment')->where('id', $request->id)->update($data);
                $payid = $request->id;
                DB::table('qsell_advancepayment_payment_method')->where('payid', $request->id)->delete();
            }
            $sum = 0;
            for ($i = 0; $i < count($request->modeofpayment); $i++) {
                $data = [
                    'payid' => $payid,
                    'modeofpayment' => $request->modeofpayment[$i],
                    'amounts'     => $request->amount[$i],
                    'branch' => $branch,
                    'preference' => $request->preference[$i],
                ];
                $payments = DB::table('qsell_advancepayment_payment_method')->insert($data);
                $sum += $request->amount[$i];
            }
            if ($request->status == "Approved") {
                $this->salesAdvanceSoaInsertion($payid, $branch);
                $this->salesAdwancePaymentAccountingEnrty($payid);
            }
        });
    }

    public function approve(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->id;
            $branch = Session::get('branch');
            $adwance = DB::table('qsell_advancepayment')->where('id', $id)->update(['status' => 'Approved']);
            $this->salesAdvanceSoaInsertion($id, $branch); //SOA Insertion
            $this->salesAdwancePaymentAccountingEnrty($id); //Accounting Entry
        });
        $out = array(
            'status' => 1,
            'msg' => "Approved Successfully",
        );
        echo json_encode($out);
    }


    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*')->where('qcrm_customer_details.branch', $branch)->where('qcrm_customer_details.del_flag', 1)->get();
        $advancepayment = DB::table('qsell_advancepayment')->select('qsell_advancepayment.*', DB::raw("DATE_FORMAT(qsell_advancepayment.date, '%d-%m-%Y') as tdate"))->where('qsell_advancepayment.branch', $branch)->where('qsell_advancepayment.del_flag', 1)->where('qsell_advancepayment.id', $id)->get();
        $advancepayment_metod = DB::table('qsell_advancepayment_payment_method')->select('qsell_advancepayment_payment_method.*')->where('qsell_advancepayment_payment_method.branch', $branch)->where('qsell_advancepayment_payment_method.del_flag', 1)->where('qsell_advancepayment_payment_method.payid', $id)->get();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();


        $pdf = PDF::loadView('sell.advancepayment.pdf', compact('customers', 'advancepayment', 'advancepayment_metod', 'branchsettings'));
        return $pdf->stream('advancePayment.pdf');
    }

    public function Pdf1(Request $request)
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
        $advancepayment = DB::table('qsell_advancepayment')->select('qsell_advancepayment.*', DB::raw("DATE_FORMAT(qsell_advancepayment.date, '%d-%m-%Y') as tdate"))->where('qsell_advancepayment.branch', $branch)->where('qsell_advancepayment.del_flag', 1)->where('qsell_advancepayment.id', $id)->get();
        $advancepayment_metod = DB::table('qsell_advancepayment_payment_method')->select('qsell_advancepayment_payment_method.*')->where('qsell_advancepayment_payment_method.branch', $branch)->where('qsell_advancepayment_payment_method.del_flag', 1)->where('qsell_advancepayment_payment_method.payid', $id)->get();
        $customers = DB::table('qsell_advancepayment')->leftjoin('qcrm_customer_details', 'qsell_advancepayment.customer', '=', 'qcrm_customer_details.id')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')->where('qsell_advancepayment.id', $id)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();

        $customfields = DB::table('qsettings_custom_fields')->select('*')->get();
        $plabels = $customfields->pluck('labels')->toArray();
        $gm_amount = 0;


        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('sell.advancepayment.preview1', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'advancepayment', 'advancepayment_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('sell.advancepayment.preview2', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'advancepayment', 'advancepayment_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('sell.advancepayment.preview3', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'advancepayment', 'advancepayment_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('sell.advancepayment.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'advancepayment', 'advancepayment_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
        } else {
            $pdf = PDF::loadView('sell.advancepayment.preview4', compact('branch', 'branchsettings', 'currencylist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'advancepayment', 'advancepayment_metod', 'vatlist', 'bname', 'companysettings', 'plabels'));
        }
        return $pdf->stream('Advance Payment-#' . $id . '.pdf');
    }
}

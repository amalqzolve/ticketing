<?php

namespace App\Http\Controllers\qpurchase;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use PDF;
use App\settings\BranchSettingsModel;
use Session;
use DataTables;
use Carbon\Carbon;

class PurchaseOpeningBalanceController extends Controller
{
    public function index(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $data = DB::table('qbuy_opening_balance')
                ->leftjoin('qcrm_supplier', 'qcrm_supplier.id', '=', 'qbuy_opening_balance.supplier')
                ->select('qbuy_opening_balance.*', DB::raw("DATE_FORMAT(qbuy_opening_balance.date, '%d-%m-%Y') as date"), 'qcrm_supplier.sup_name')
                ->where('qbuy_opening_balance.branch', $branch)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('status', function ($row) {
                if ($row->status == 'Approved')
                    return '<span style="color:green;">Approved</span>';
                if ($row->status == 'Draft')
                    return '<span style="color:gray;">Draft</span>';
            })->addColumn('action', function ($row) {
                $j = '';
                $j .= '<a href="qpurchase-opening-balance-pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
                <li class="kt-nav__item">
                    <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
                    </span>
                </li>
            </a>';

                if ($row->status == 'Draft') {
                    $j .= '<a href="#?id=' . $row->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5">
                        <li class="kt-nav__item">
					    		<span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                    <span class="kt-nav__link-text customergroupupdate" data-id="' . $row->id . '" >Edit</span>
					    		</span>
                        </li>
                       </a>';
                    $j .= '<a data-type="send" data-target="#kt_form">
                       <li class="kt-nav__item openingBalanceApprove" id="' . $row->id . '">
                           <span class="kt-nav__link">
                               <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                               <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
                           </span>
                       </li>
                   </a>';


                    $j .= '<li class="kt-nav__item openingBalancedelete" id="' . $row->id . '">
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-trash"></i>
                            <span class="kt-nav__link-text" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span>
                        </li>';
                }
                return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                    <i class="fa fa-cog"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '</ul>
                    </div>
                </div>
            </span>';
            })->rawColumns(['action', 'status', 'action'])
                ->make(true);
        } else {
            $suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
            return view('qpurchase.opening_balance.index', compact('suppliers'));
        }
    }

    public function submit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $postID = $request->info_id;
            $branch = Session::get('branch');
            $branch_settings = Session::get('branch_settings');
            $data = [
                'code' => $branch_settings->purchaseopeningbalance_sufix . '' . sprintf("%03d", $branch),
                'supplier' => $request->supplier,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'method' => $request->method,
                'amount' => $request->amount,
                'note' => $request->note,
                'reference' => $request->reference,
                'branch' => $branch,
                'status' => $request->status,
            ];
            if ($postID != '') {
                $id = $postID;
                DB::table('qbuy_opening_balance')->where('id', $postID)->update($data);
            } else {
                $id =  DB::table('qbuy_opening_balance')->insertGetId($data);
            }
            if ($request->status == 'Approved')
                $this->openingBalanceSOAInsertion($id);
        });
        $out = array(
            'status' => 1,
            'msg' => 'Details Saved Success'
        );
        echo json_encode($out);
    }

    public function approve(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->id;
            $dat = DB::table('qbuy_opening_balance')->where('id', $id)->update(['status' => 'Approved']);
            $this->openingBalanceSOAInsertion($id);
        });
        $out = array(
            'status' => 1,
        );
        echo json_encode($out);
    }

    public function openingBalanceSOAInsertion($id)
    {
        $openBlns = DB::table('qbuy_opening_balance')->where('id', $id)->select('id', 'amount', 'date', 'supplier', 'method', 'branch')->first();
        $soa = [
            'doc_type'        => 'Opening Balance',
            'doc_id'          => $openBlns->id,
            'doc_transaction' => Carbon::parse($openBlns->date)->format('Y-m-d'),
            'transaction_type' => 'Opening Balance', //Credit or Debit
            'totalamount'     => $openBlns->amount,
            'supplier_id'     => $openBlns->supplier,
            'branch'          => $openBlns->branch,
            'dr_amount'          => ($openBlns->method == 'Debit') ? $openBlns->amount : 0,
            'cr_amount'          => ($openBlns->method == 'Credit') ? $openBlns->amount : 0,
        ];
        DB::table('qbuy_purchaseorder_soa')->insert($soa);
        return true;
    }

    public function getData(Request $request)
    {
        $data = DB::table('qbuy_opening_balance')->select('qbuy_opening_balance.*', DB::raw("DATE_FORMAT(qbuy_opening_balance.date, '%d-%m-%Y') as date"))->where('id', $request->info_id)->first();
        $out = array(
            'status' => 1,
            'data' => $data
        );
        return response()->json($out);
    }
    public function delete(Request $request)
    {
        $delete = $request->id;
        DB::table('qbuy_opening_balance')->where('id', $delete)->delete();
        $out = array(
            'status' => 1,
        );
        echo json_encode($out);
    }
    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();

        $opening_balance = DB::table('qbuy_opening_balance')
            ->select('qbuy_opening_balance.*', DB::raw("DATE_FORMAT(qbuy_opening_balance.date, '%d-%m-%Y') as date"))
            ->where('qbuy_opening_balance.id', $id)->first();

        $supplier = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $opening_balance->supplier)->first();

        $pdf = PDF::loadView('qpurchase.opening_balance.preview1', compact('companysettings', 'branchsettings', 'supplier', 'opening_balance'));
        return $pdf->stream('Bill Settle-#' . $id . '.pdf');
    }
}

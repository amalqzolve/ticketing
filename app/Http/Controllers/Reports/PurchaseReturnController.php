<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use View;
use DB;
use Auth;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;

class PurchaseReturnController extends Controller
{
    public function index(Request $request)
    {
        $branch = Session::get('branch');
        $details = "";
        return view('Reports.purchase.return.index', compact('details'));
    }
    public function list(Request $request)
    {
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $details = DB::table('qbuy_purchase_return')
            ->leftjoin('qcrm_supplier', 'qbuy_purchase_return.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_return.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
            ->select('qbuy_purchase_return.*', 'qbuy_purchase_pi.id', 'qcrm_supplier.sup_name', 'qcrm_supplier.buyerid_crno', 'qbuy_purchase_return.id as sid', DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
            ->where('qbuy_purchase_return.branch', $branch)
            ->whereBetween('returndate', [$fromdate, $todate])
            ->orderby('qbuy_purchase_return.returndate', 'ASC')
            ->groupBy('qbuy_purchase_return.id')
            ->get();

        return view('Reports.purchase.return.list', compact('details', 'fromdate', 'todate'));
    }
    public function pdf(Request $request)
    {
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
        $details = DB::table('qbuy_purchase_return')
            ->leftjoin('qcrm_supplier', 'qbuy_purchase_return.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_return.qbuy_purchase_pi_id', '=', 'qbuy_purchase_pi.id')
            ->select('qbuy_purchase_return.*', 'qbuy_purchase_pi.id', 'qcrm_supplier.sup_name', 'qcrm_supplier.buyerid_crno', 'qbuy_purchase_return.id as sid', DB::raw("DATE_FORMAT(qbuy_purchase_return.returndate, '%d-%m-%Y') as returndate"))
            ->where('qbuy_purchase_return.branch', $branch)
            ->whereBetween('returndate', [$fromdate, $todate])
            ->orderby('qbuy_purchase_return.returndate', 'ASC')
            ->groupBy('qbuy_purchase_return.id')
            ->get();

        $pdf = PDF::loadview('Reports.purchase.return.returnpdf', compact('details', 'branchsettings'));
        return $pdf->stream('salesreturn.pdf');
    }
}

<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use View;
use DB;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\Soapurchaseexcel;
use App\settings\BranchSettingsModel;

class PurchaseSOAController_old extends Controller
{
    public function soapurchase(Request $request)
    {
        $branch = Session::get('branch');

        $details = "";
        // dd($details);
        $suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();

        return view('Reports.purchase.soa.listing', compact('details', 'suppliers'));
       
    }
    public function getsupplier_vendor(Request $request)
    {
        $id = $request->id;

        // if ($id == 2) {
        $data = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
        return response()->json($data);
        // }
        // if ($id == 1) {
        //     $data = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
        //     return response()->json($data);
        // }
        if ($id == "") {
            $data = "";
            return response()->json($data);
        }
    }
    public function purchasesoasubmit(Request $request)
    {
        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $branch = Session::get('branch');
        $name = "";
        $providername = "";
        $details = "";
        // if ($request->vendor_supplier == 1) {
        // $name = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('id', $request->supplier_vendor_names)->get();
        // $providername = "Vendor";
        // }
        // if ($request->vendor_supplier == 2) {
        $name = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('id', $request->supplier_vendor_names)->get();
        $providername = "Supplier";
        // }
        $opening_balance = DB::table('qbuy_purchase_soa')->select('*')->where('qbuy_purchase_soa.del_flag', 1)->where('qbuy_purchase_soa.branch', $branch)->where('qbuy_purchase_soa.customer_id', $request->supplier_vendor_names)->whereDate('doc_transaction', '<', $fromdate)->get();
        $details = DB::table('qbuy_purchase_soa')->select('*')->where('qbuy_purchase_soa.del_flag', 1)->where('qbuy_purchase_soa.branch', $branch)->where('qbuy_purchase_soa.customer_id', $request->supplier_vendor_names)->get();

        return view('Reports.purchase.soa.soa', compact('details', 'opening_balance', 'fromdate', 'name', 'providername', 'todate'));
    }
    public function soapurchasepdf(Request $request)
    {

        $fromdate = Carbon::parse($request->fromdate)->format('Y-m-d');
        $todate = Carbon::parse($request->todate)->format('Y-m-d');
        $cid = $request->cid;
        $provider = $request->provider;
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

        $name = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('id', $cid)->get();
        $providername = "Supplier";



        $opening_balance = DB::table('qbuy_purchase_soa')->select('*')->where('qbuy_purchase_soa.del_flag', 1)->where('qbuy_purchase_soa.branch', $branch)->where('qbuy_purchase_soa.customer_id', $cid)->whereDate('doc_transaction', '<', $fromdate)->get();

        $details = DB::table('qbuy_purchase_soa')->select('*')->where('qbuy_purchase_soa.del_flag', 1)->where('qbuy_purchase_soa.branch', $branch)->where('qbuy_purchase_soa.customer_id', $cid)->get();

        $pdf = PDF::loadview('Reports.purchase.soa.pdf', compact('details', 'opening_balance', 'fromdate', 'branchsettings', 'name', 'providername', 'todate'));
        return $pdf->stream('sales.pdf');
    }
    public function soapurchaseexcel(Request $request)
    {
        ini_set("pcre.backtrack_limit", "100000000000");
        return Excel::download(new Soapurchaseexcel, 'soa.xlsx');
    }
}

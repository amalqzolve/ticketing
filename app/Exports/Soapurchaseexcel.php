<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Input;

class Soapurchaseexcel implements FromView
{
    /*     public $view;
 */

    /* public function __construct(Request $request)
{
    $this->request = $request;
} */


    public function view(): \Illuminate\Contracts\View\View
    {

        ini_set("pcre.backtrack_limit", "100000000000");
        $fromdate = Carbon::parse(Input::get('fromdate'))->format('Y-m-d');
        $todate = Carbon::parse(Input::get('todate'))->format('Y-m-d');
        $cid = Input::get('cid');
        $provider = Input::get('provider');
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

        $name = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('id', $cid)->get();
        $providername = "Supplier";
        $opening_balance = DB::table('qbuy_purchase_soa')->select('*')->where('qbuy_purchase_soa.del_flag', 1)->where('qbuy_purchase_soa.branch', $branch)->where('qbuy_purchase_soa.customer_id', $cid)->whereDate('doc_transaction', '<', $fromdate)->get();

        $details = DB::table('qbuy_purchase_soa')->select('*')->where('qbuy_purchase_soa.del_flag', 1)->where('qbuy_purchase_soa.branch', $branch)->where('qbuy_purchase_soa.customer_id', $cid)->get();

        return view('Reports.purchase.soa.excel', compact('details', 'opening_balance', 'fromdate', 'branchsettings', 'name', 'providername', 'todate'));
    }
}

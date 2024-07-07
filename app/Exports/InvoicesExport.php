<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\inventory\ProductdetailslistModel;
use App\sales\CustomInvoiceModel;
use App\sales\CustomInvoiceproductModel;

use DB;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\sales\SalesModel;
use App\settings\BranchSettingsModel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Input;

class InvoicesExport implements FromView
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
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $details = DB::table('qsell_saleinvoice')->leftjoin('qcrm_customer_details', 'qsell_saleinvoice.customer', '=', 'qcrm_customer_details.id')->leftJoin('qcrm_customer_documents', 'qcrm_customer_details.id', '=', 'qcrm_customer_documents.customer_id')->select('*', 'qcrm_customer_details.cust_name', 'qcrm_customer_documents.vat_no', 'qcrm_customer_details.buyerid_crno', 'qsell_saleinvoice.id as sid', DB::raw("DATE_FORMAT(qsell_saleinvoice.quotedate, '%d-%m-%Y') as quotedate"))->where('qsell_saleinvoice.del_flag', 1)->where('qsell_saleinvoice.branch', $branch)->whereBetween('quotedate', [$fromdate, $todate])->orderby('qsell_saleinvoice.quotedate', 'ASC')->groupBy('qsell_saleinvoice.id')->get();


        return view('Reports.sales.sellvatexcel', compact('details', 'branchsettings'));
    }
}

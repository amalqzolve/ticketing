<?php

namespace App\Http\Controllers\crm;

use Illuminate\Http\Request;
use App\crm\CustomerModel;
use DB;
use PDF;
use DataTables;
use Session;
use App\Traits\AccountingActionsTrait;

class customeraccountsController extends Controller
{
    use AccountingActionsTrait;
    public function accountsList(Request $request)
    {
        $branch = Session::get('branch');

        $this->connectToAccounting();
        if ($request->ajax()) {
            $data  = DB::table('qcrm_customer_details')->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')->select('qcrm_customer_details.id', 'qcrm_customer_details.cust_code', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.account_ledger')
                ->where('qcrm_customer_details.del_flag', 1)
                ->where('qcrm_customer_details.branch', $branch)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('ledger', function ($row) {
                if (($row->account_ledger != null) || ($row->account_ledger != '')) {
                    $ledgers =  DB::connection('mysql_accounting')->table('ledgers')->where('id', $row->account_ledger)->first();
                    return '[' . $ledgers->code . '] ' . $ledgers->name;
                } else
                    return '--';
            })->addColumn('action', function ($row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">
			<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
						<i class="fa fa-cog"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
						<ul class="kt-nav">
						 <li id=' . $row->id . '" data-type="edit">
						 <li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-edit"></i>
						<span class="kt-nav__link-text kt_edit_accounts" id=' . $row->id . ' data-id=' . $row->id . '>Update</span></span></li></a>
					   </ul></div></div></span>';
            })->rawColumns(['action', 'ledger'])->make(true);
        }

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
        $array = collect($finalLedger)->sortBy('code')->toArray();
        return view('crm.customeraccounts.customer_accounts', compact('groups', 'ledgers', 'array'));
    }

    public function accountsubmit(Request $request)
    {
        $custID = $request->cust_id;
        $data = [
            'account_ledger' => $request->customer_ledger,
        ];
        DB::table('qcrm_customer_details')->where('id', $custID)->update($data);
        return 'true';
    }

    public function getaccountdata(Request $request)
    {
        $data['accounts'] = CustomerModel::select('id', 'account_ledger')->where('id', $request->info_id)->first();
        echo json_encode($data);
    }
}

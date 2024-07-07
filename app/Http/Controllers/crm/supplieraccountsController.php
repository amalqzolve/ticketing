<?php

namespace App\Http\Controllers\crm;

use Illuminate\Http\Request;
use App\crm\SupplierModel;
use DB;
use DataTables;
use Session;
use App\Traits\AccountingActionsTrait;

class supplieraccountsController extends Controller
{
    use AccountingActionsTrait;
    public function accountsList(Request $request)
    {
        $branch = Session::get('branch');

        $this->connectToAccounting();
        if ($request->ajax()) {
            $data = DB::table('qcrm_supplier')
                ->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', "=", "qcrm_suppliercatogry.id")
                ->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', "=", "qcrm_supplier_type.id")
                ->leftjoin('qcrm_salesman_details', 'qcrm_supplier.salesman', "=", "qcrm_salesman_details.id")
                ->select('qcrm_supplier.sup_code', 'qcrm_supplier.id', 'qcrm_supplier.sup_name', 'qcrm_suppliercatogry.title as category', 'qcrm_supplier_type.title as type', 'qcrm_salesman_details.name', 'qcrm_supplier.account_group', 'qcrm_supplier.account_ledger', 'qcrm_supplier.*')
                ->where('qcrm_supplier.branch', $branch)
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
						 <li id="' . $row->id . '" data-target="#kt_modal_4_5">
						 <li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-edit"></i>
						<span class="kt-nav__link-text kt_edit_accounts" id=' . $row->id . ' data-id=' . $row->id . '>Update</span></span></li></li>
					   </ul></div></div></span>';
            })->rawColumns(['action', 'ledger'])->make(true);
        } else {

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
            $allLedger = collect($finalLedger)->sortBy('code')->toArray();
            return view('crm.supplieraccounts.supplier_accounts', compact('allLedger'));
        }
    }
    public function accountsubmit(Request $request)
    {
        $custID = $request->cust_id;
        $data = [
            'account_ledger' => $request->accounts_ledger
        ];
        DB::table('qcrm_supplier')->where('id', $custID)->update($data);
        return 'true';
    }
    public function getaccountdata(Request $request)
    {
        $data['accounts'] = SupplierModel::select('account_ledger')->where('id', $request->info_id)->first();
        echo json_encode($data);
    }
}

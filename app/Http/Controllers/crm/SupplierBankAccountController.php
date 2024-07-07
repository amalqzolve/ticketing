<?php

namespace App\Http\Controllers\crm;


use App\crm\SupplierModel;

use DB;
use Illuminate\Http\Request;

use App\crm\SupplierBank;
use PDF;
use DataTables;
use Session;
use Carbon\Carbon;
use Auth;
use App\settings\BranchSettingsModel;

class SupplierBankAccountController extends Controller
{
	public function list(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$data  = DB::table('qcrm_supplier')
				->select('qcrm_supplier.id', 'qcrm_supplier.sup_code', 'qcrm_supplier.sup_name',  'qcrm_suppliercatogry.title as supplier_category', 'qcrm_suppliergroup.title')
				->leftJoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')
				->leftJoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')
				->leftJoin('qcrm_salesman_details', 'qcrm_supplier.salesman', '=', 'qcrm_salesman_details.id')
				->leftJoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')
				->where('qcrm_supplier.del_flag', 1)->where('qcrm_supplier.branch', $branch)->get();

			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->addColumn('bank_account', function ($row) {
				$totalBankAccounts = SupplierBank::where('suppler_id', '=', $row->id)->count();
				return $totalBankAccounts;
			})->rawColumns(['action', 'bank_account']);
			return  $dtTble->make(true);
		}
		$supplier = SupplierModel::select('id', 'sup_name')->where('qcrm_supplier.branch', $branch)->get();
		return view('crm.bankAccount.list', compact('supplier'));
	}

	public function specificSupplier(Request $request)
	{
		$branch = Session::get('branch');
		$id = $request->id;
		if ($request->ajax()) {
			$data  = SupplierBank::select('qcrm_supplier.sup_code', 'qcrm_supplier.sup_name', 'qcrm_supplier_bank_details.*')
				->leftJoin('qcrm_supplier', 'qcrm_supplier_bank_details.suppler_id', '=', 'qcrm_supplier.id')
				->where('qcrm_supplier_bank_details.suppler_id', $id)
				->get();
			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action']);
			return  $dtTble->make(true);
		}
		$supplier = SupplierModel::select('id', 'sup_name')->find($id);
		return view('crm.bankAccount.listSpecific', compact('supplier'));
	}

	public function add(Request $request)
	{
		$id = $request->id;
		$supplier = SupplierModel::select('id', 'sup_name')->find($id);
		return view('crm.bankAccount.add', compact('supplier'));
	}

	public function save(Request $request)
	{
		$useasr_id = Auth::user()->id;
		$inData = array(
			'suppler_id' => $request->suppler_id,
			'beneficiary_name' => $request->beneficiary_name,
			'bank_name' => $request->bank_name,
			'branch_name' => $request->branch_name,
			'branch_code' => $request->branch_code,
			'bank_address' => $request->bank_address,
			'account_number' => $request->account_number,
			'iban_swift_code' => $request->iban_swift_code,
			'notes' => $request->notes,
			'created_by' => $useasr_id
		);
		$ifSaved = SupplierBank::updateOrCreate(['id' => null], $inData);
		if ($ifSaved)
			$out = array(
				'status' => 1,
				'message' => "success",
			);
		else
			$out = array(
				'status' => 1,
				'message' => "Error",
			);
		echo json_encode($out);
	}

	public function editView(Request $request)
	{
		$id = $request->id;
		$data = SupplierBank::select('qcrm_supplier_bank_details.*', 'qcrm_supplier.sup_name')
			->leftJoin('qcrm_supplier', 'qcrm_supplier_bank_details.suppler_id', 'qcrm_supplier.id')
			->find($id);
		return view('crm.bankAccount.edit', compact('data'));
	}

	public function update(Request $request)
	{
		$useasr_id = Auth::user()->id;
		$inData = array(
			'beneficiary_name' => $request->beneficiary_name,
			'bank_name' => $request->bank_name,
			'branch_name' => $request->branch_name,
			'branch_code' => $request->branch_code,
			'bank_address' => $request->bank_address,
			'account_number' => $request->account_number,
			'iban_swift_code' => $request->iban_swift_code,
			'notes' => $request->notes
		);
		$ifSaved = SupplierBank::updateOrCreate(['id' => $request->id], $inData);
		if ($ifSaved)
			$out = array(
				'status' => 1,
				'message' => "success",
			);
		else
			$out = array(
				'status' => 1,
				'message' => "Error",
			);

		echo json_encode($out);
	}
	public function pdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');
		$mainData = SupplierBank::select('qcrm_supplier_bank_details.*', 'qcrm_supplier.sup_name', 'users.name as created_name')
			->leftJoin('qcrm_supplier', 'qcrm_supplier_bank_details.suppler_id', 'qcrm_supplier.id')
			->leftJoin('users', 'qcrm_supplier_bank_details.created_by', 'users.id')
			->find($id);

		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
		$pdfId = 'BNK ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->created_at));
		$pdf = PDF::loadView('crm.bankAccount.preview', compact('mainData', 'branchsettings'), array(),  [
			'title'      => $pdfId,
			'margin_top' => 0
		]);
		return $pdf->stream($pdfId . '.pdf');
	}
}

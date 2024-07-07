<?php

namespace App\Http\Controllers\crm;

use App\crm\CustomerModel;
use App\crm\customer;
use App\crm\SupplierModel;
use App\crm\Supplier;
use App\crm\Category;
use App\crm\suppliertype;
use App\crm\SupplierCategory;
use App\crm\CustomerTypeModel;
use App\crm\CustomerCategoryModel;
use App\crm\Supplier_documents_Model;
use App\crm\SalesmanDetailModel;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use App\crm\PaymentModel;
use App\crm\countryModel;
use App\crm\SuppliergroupModel;
use PDF;
use DataTables;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Traits\AccountingActionsTrait;
use App\settings\BranchSettingsModel;

class SupplierController extends Controller
{
	use AccountingActionsTrait;
	public function supplierdetailss(Request $request)
	{
		$branch = Session::get('branch');
		if ($request->ajax()) {
			$query  = DB::table('qcrm_supplier')
				->leftJoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')
				->leftJoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')
				->leftJoin('qcrm_salesman_details', 'qcrm_supplier.salesman', '=', 'qcrm_salesman_details.id')
				->leftJoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')
				->select('qcrm_supplier.sup_code', 'qcrm_supplier.sup_name', 'qcrm_supplier.id', 'qcrm_suppliercatogry.title as supplier_category', 'qcrm_supplier_type.title as supplier_type', 'qcrm_salesman_details.name as salesman', 'qcrm_supplier.sup_name_alias', 'qcrm_supplier.mobile1', 'qcrm_suppliergroup.title', 'qcrm_supplier.sup_name_ar', 'qcrm_supplier.email1', 'qcrm_supplier.vatno')
				->orderby('qcrm_supplier.id', 'desc');

			$query->where('qcrm_supplier.del_flag', 1)->where('qcrm_supplier.branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = SupplierModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		$data = SupplierModel::all();
		return view('crm.suppliers.suppliers', ['data' => $data], compact('branch'));
	}
	public function supplierdetailstrash(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query  = DB::table('qcrm_supplier')
				->leftJoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')
				->leftJoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')
				->leftJoin('qcrm_salesman_details', 'qcrm_supplier.salesman', '=', 'qcrm_salesman_details.id')
				->select('qcrm_supplier.sup_code', 'qcrm_supplier.sup_name', 'qcrm_supplier.id', 'qcrm_suppliercatogry.title as supplier_category', 'qcrm_supplier_type.title as supplier_type', 'qcrm_salesman_details.name as salesman')
				->orderby('qcrm_supplier.id', 'desc');
			$query->where('qcrm_supplier.del_flag', 0)->where('qcrm_supplier.branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = SupplierModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		$data = SupplierModel::all();
		return view('crm.suppliers.trash', ['data' => $data]);
	}
	public function supplierdocuments(Request $request)
	{
		$branch = Session::get('branch');
		$ta = 1;
		$te = 1;
		if ($request->ajax()) {
			$query  = DB::table('qcrm_supplier')->leftJoin('qcrm_supplier_documents', 'qcrm_supplier.id', '=', 'qcrm_supplier_documents.supplier_id')->leftJoin('qcrm_supplier_docs', 'qcrm_supplier.id', '=', 'qcrm_supplier_docs.supplier_id')

				->select('qcrm_supplier.sup_name', 'qcrm_supplier.id', 'qcrm_supplier_documents.documents', 'qcrm_supplier_documents.supplier_id', DB::raw("DATE_FORMAT(qcrm_supplier_docs.expdate, '%d-%m-%Y') as expdate"))
				->groupBy('qcrm_supplier.id')
				->orderby('qcrm_supplier.id', 'desc');
			$query->where('qcrm_supplier.del_flag', 1);
			$data = $query->get();
			foreach ($data as $key => $value) {

				$value->exp = "";
				$value->ac = "";
				$value->total = "";
				$value->total = DB::table('qcrm_supplier_docs')->select('docname')->where('supplier_id', $value->id)->where('del_flag', 1)->count();
				$cdate = date('Y-m-d');
				$value->exp = DB::table('qcrm_supplier_docs')->select('expdate')->where('supplier_id', $value->id)->where('del_flag', 1)->where('expdate', '<', $cdate)->count();

				$value->ac = DB::table('qcrm_supplier_docs')->select('expdate')->where('supplier_id', $value->id)->where('del_flag', 1)->where('expdate', '>=', $cdate)->count();
			}
			$count_filter = $query->count();
			$count_total = Supplier_documents_Model::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		return view('crm.suppliers.supplierdocuments');
	}


	public function sup_doc_view(Request $request)
	{
		$branch = Session::get('branch');
		$supplier_id = $request->id;
		if ($request->ajax()) {
			$query  = DB::table('qcrm_supplier_documents_files')->select('qcrm_supplier_documents_files.*')
				->orderby('qcrm_supplier_documents_files.id', 'desc');
			$query->where('qcrm_supplier_documents_files.supplier_id', $request->supplier_id);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = $query->count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		return view('crm.suppliers.sup_doc_view', compact('supplier_id'));
	}
	public function edit_supplier_docs(Request $request)
	{
		$branch = Session::get('branch');

		$id = $request->id;
		$docs = DB::table('qcrm_supplier_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_supplier_docs.expdate, '%d-%m-%Y') as expdate1"))->where('supplier_id', $id)->get();

		return view('crm.suppliers.supplier_docs', compact('docs'));
	}


	/**
	 *Supplier Category datas listing
	 **/
	public function category_list(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = SupplierCategory::orderby('id', 'desc');
			$query->where('del_flag', 1)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = SupplierCategory::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.supplier_category.suppliercategory', compact('branch'));
	}
	//supplier pdf


	public function supplier_pdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

		$users = DB::table('qcrm_supplier')->leftJoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftJoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftJoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftJoin('qcrm_salesman_details', 'qcrm_supplier.salesman', '=', 'qcrm_salesman_details.id')->leftJoin('a_branch1_a_groups', 'qcrm_supplier.key_account', '=', 'a_branch1_a_groups.id')->leftJoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliercatogry.title as supplier_category', 'qcrm_supplier_type.title as suppliertype', 'qcrm_salesman_details.name as salesmanname', 'a_branch1_a_groups.name as account_ledger', 'countries.cntry_name as country', 'qcrm_suppliergroup.title as group')->where('qcrm_supplier.id', $id)->get();
		$suppliercontact = Supplier::where('info_id', $id)->get();
		$docs = DB::table('qcrm_supplier_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_supplier_docs.expdate, '%d-%m-%Y') as expdate1"))->where('supplier_id', $id)->get();
		$total = DB::table('qcrm_supplier_docs')->select('docname')->where('supplier_id', $id)->where('del_flag', 1)->count();
		$cdate = date('Y-m-d');
		$exp = DB::table('qcrm_supplier_docs')->select('expdate')->where('supplier_id', $id)->where('del_flag', 1)->where('expdate', '<', $cdate)->count();
		$ac = DB::table('qcrm_supplier_docs')->select('expdate')->where('supplier_id', $id)->where('del_flag', 1)->where('expdate', '>=', $cdate)->count();
		$pdf = PDF::loadView('crm.suppliers.preview2', compact('suppliercontact', 'users', 'branchsettings', 'docs', 'branch', 'total', 'exp', 'ac'));

		return $pdf->stream('document.pdf');
	}
	public function findsupplierstartfrom(Request $request)
	{
		$id   = $request->id;
		$data = SupplierCategory::select('cust_start')->where('id', $id)->get();
		foreach ($data as $value) {
			$cust_start = $value->cust_start;
		}
		return response()
			->json($cust_start);
	}
	/**
	 *Supplier Category Submission
	 */
	public function Submit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->info_id;
		$check = $this->check_exists($request->title, 'title', 'qcrm_suppliercatogry');
		if ($check < 1) {
			$data   = ['cust_start' => $request->customcode . '/' . number_format($request->startfrom + 1), 'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color, 'customcode' => $request->customcode, 'startfrom' => $request->startfrom, 'increment' => $request->startfrom, 'branch' => $branch];
			$userInfo = SupplierCategory::updateOrCreate(['id' => $postID], $data);
			return 'true';
		} else {
			return 'false';
		}
	}
	/**
	 *Supplier Category datas to be shows in edit 
	 */
	public function getsuppliercatgry(Request $request)
	{

		$data['users'] = SupplierCategory::where('id', $request->cust_id)
			->limit(1)
			->first();
		echo json_encode($data);
	}
	/**
	 *Supplier category trash 
	 */
	public function suplircatgry_trash(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = SupplierCategory::orderby('id', 'desc');
			$query->where('del_flag', 0)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = SupplierCategory::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.supplier_category.suppliercatgrytrash');
	}
	/**
	 *Supplier Category restore 
	 */
	public function sup_cat_TrashRestore(Request $request)
	{
		$postID = $request->id;
		SupplierCategory::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	/**
	 * Supplier Category Delete
	 */
	public function deletesuppliercatgryInfo(Request $request)
	{
		$postID = $request->id;
		$query = DB::table('qcrm_supplier')->select('sup_category')->where('sup_category', $postID)->where('del_flag', 1)->get();
		$no = $query->count();
		if ($no > 0) {
			return '1';
		} else {
			SupplierCategory::where('id', $postID)->update(['del_flag' => 0]);
			return 'true';
		}
	}
	/**
	 * Supplier Type listing
	 */
	public function suplir_type(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = suppliertype::orderby('id', 'desc');
			$query->where('del_flag', 1)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = suppliertype::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		return view('crm.supplier_type.suppliertype', compact('branch'));
	}

	/**
	 * Supplier Type trash listing
	 */
	public function suplir_trash(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = suppliertype::orderby('id', 'desc');
			$query->where('del_flag', 0)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = suppliertype::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.supplier_type.suppliertypetrash');
	}

	/**
	 *Supplier Type Restore entry
	 */
	public function typetrashrestores(Request $request)
	{
		$postID = $request->id;
		suppliertype::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	/**
	 *Supplier Type delete 
	 */
	public function deletesupplierInfo(Request $request)
	{
		$postID = $request->id;
		suppliertype::where('id', $postID)->update(['del_flag' => 0]);
		return 'true';
	}
	/**
	 *Supplier Type Update
	 */

	public function getsuppliertype(Request $request)
	{

		$data['users']   = suppliertype::where('id', $request->cust_id)
			->limit(1)
			->first();

		echo json_encode($data);
	}

	public function view_supplier(Request $request)
	{
		$id = $_REQUEST['id'];
		// $users = SupplierModel::where('id', $id)->limit(1)
		// 			  ->first();     
		// dd($users);
		$users = DB::table('qcrm_supplier')->leftJoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftJoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftJoin('qcrm_salesman_details', 'qcrm_supplier.salesman', '=', 'qcrm_salesman_details.id')->leftJoin('a_branch1_a_groups', 'qcrm_supplier.key_account', '=', 'a_branch1_a_groups.id')->leftJoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->leftJoin('countries as invoicecountry', 'qcrm_supplier.invoice_country', '=', 'invoicecountry.id')->leftJoin('countries as shippingcountry', 'qcrm_supplier.shipping_country', '=', 'shippingcountry.id')->select('qcrm_supplier.*', 'qcrm_suppliercatogry.title as supplier_category', 'qcrm_supplier_type.title as suppliertype', 'qcrm_salesman_details.name as salesmanname', 'a_branch1_a_groups.name as account_ledger', 'countries.cntry_name as country', 'invoicecountry.cntry_name as invoice_country', 'shippingcountry.cntry_name as shipping_country')->where('qcrm_supplier.id', $id)->get();
		$suppliercontact = Supplier::where('info_id', $id)->get();

		return view('crm.suppliers.supplier_view', compact('suppliercontact', 'users'));
	}

	public function add()
	{
		$branch = Session::get('branch');
		$areaList  = SupplierCategory::select('id', 'title')->Where('del_flag', 1)->where('branch', $branch)->get();
		$areaLists = suppliertype::select('id', 'title')->Where('del_flag', 1)->where('branch', $branch)->get();
		$country   = countryModel::select('id', 'cntry_name')->get();
		$salesman  = SalesmanDetailModel::select('id', 'name', 'account_ledger')->where('branch', $branch)->get();
		// $groups = DB::table('a_branch1_a_groups')->get()->toArray();
		$group = SuppliergroupModel::select('id', 'title')->Where('del_flag', 1)->where('branch', $branch)->get();
		$keyaccountants = SalesmanDetailModel::select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->where('keysalesman', 1)->get();

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
		return view('crm.suppliers.supplier_add', compact('areaLists', 'areaList', 'salesman', 'country', 'branch', 'group', 'keyaccountants', 'fullGroups', 'fullLedger'));
	}


	public function edits(Request $request) //supplier Edit
	{
		$branch = Session::get('branch');

		$skill = [];
		$id = $request->id;
		$supplieradd = Supplier::where('info_id', $id)->get();
		$userInfo    = SupplierModel::findOrFail($id);
		$areaLists   = suppliertype::select('id', 'title')->get();
		$areaList    = SupplierCategory::select('id', 'title')->get();
		$country     = countryModel::select('id', 'cntry_name')->get();
		$group = SuppliergroupModel::select('id', 'title')->Where('del_flag', 1)->where('branch', $branch)->get();
		$salesman    = SalesmanDetailModel::select('id', 'name', 'account_ledger')
			->Where('del_flag', 1)
			->get();
		$keyaccountants = SalesmanDetailModel::select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->where('keysalesman', 1)->get();

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

		return view('crm.suppliers.supplier_edit', ['datas' => $supplieradd], compact('areaList', 'areaLists', 'salesman', 'country', 'branch', 'group', 'keyaccountants', 'fullGroups', 'fullLedger'))->with('userInfo', $userInfo);
	}


	public function edit_supplier(Request $request)
	{

		die();
		$skill     = [];
		$id        = $_REQUEST['id'];
		$users     = SupplierModel::where('id', $id)->limit(1)
			->first();
		$areaLists = suppliertype::select('id', 'title')->Where('del_flag', 1)
			->get();
		$areaList  = SupplierCategory::select('id', 'title')->Where('del_flag', 1)
			->get();
		$skill     = Supplier::where('info_id', $id)->limit(1)
			->first();
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

		return view('crm.suppliers.supplier_edit', ['data' => $users, 'datas' => $skill], compact('areaLists', 'areaList', 'fullGroups', 'fullLedger'));
	}

	public function supplieraccountsshow(Request $request)
	{
		$totalData = SupplierModel::count();
		$totalFiltered = 0;
		$query = DB::table('qcrm_supplier')
			->leftjoin(
				'qcrm_suppliercatogry',
				'qcrm_supplier.sup_category',
				"=",
				"qcrm_suppliercatogry.id"
			)
			->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', "=", "qcrm_supplier_type.id")
			->leftjoin('qcrm_salesman_details', 'qcrm_supplier.salesman', "=", "qcrm_salesman_details.id")
			->select('qcrm_supplier.*', 'qcrm_suppliercatogry.title as category', 'qcrm_supplier_type.title as type', 'qcrm_salesman_details.name')
			->orderby('id', 'desc');
		$query->where('qcrm_supplier.del_flag', 1);
		if (!empty($request->input('search.value'))) {
			$search = $request->input('search.value');
			$query->Where('id', 'LIKE', "%{$search}%");
			$query->orWhere('sup_code', 'LIKE', "%{$search}%");
			$query->orWhere('sup_type', 'LIKE', "%{$search}%");
			$query->orWhere('sup_category', 'LIKE', "%{$search}%");
			$query->orWhere('salesman', 'LIKE', "%{$search}%");
			$query->orWhere('key_account', 'LIKE', "%{$search}%");
			$query->orWhere('sup_name', 'LIKE', "%{$search}%");
			$query->orWhere('sup_add1', 'LIKE', "%{$search}%");
			$query->orWhere('sup_add2', 'LIKE', "%{$search}%");
			$query->orWhere('sup_country', 'LIKE', "%{$search}%");
			$query->orWhere('sup_city', 'LIKE', "%{$search}%");
			$query->orWhere('sup_region', 'LIKE', "%{$search}%");
			$query->orWhere('sup_zip', 'LIKE', "%{$search}%");
			$query->orWhere('email1', 'LIKE', "%{$search}%");
			$query->orWhere('email2', 'LIKE', "%{$search}%");
			$query->orWhere('office_phone1', 'LIKE', "%{$search}%");
			$query->orWhere('office_phone2', 'LIKE', "%{$search}%");
			$query->orWhere('mobile1', 'LIKE', "%{$search}%");
			$query->orWhere('mobile2', 'LIKE', "%{$search}%");
			$query->orWhere('fax', 'LIKE', "%{$search}%");
			$query->orWhere('website', 'LIKE', "%{$search}%");
			$query->orWhere('contact_person', 'LIKE', "%{$search}%");
			$query->orWhere('contact_person_incharge', 'LIKE', "%{$search}%");
			$query->orWhere('mobile', 'LIKE', "%{$search}%");
			$query->orWhere('office', 'LIKE', "%{$search}%");
			$query->orWhere('contact_department', 'LIKE', "%{$search}%");
			$query->orWhere('email', 'LIKE', "%{$search}%");
			$query->orWhere('location', 'LIKE', "%{$search}%");
			$query->orWhere('portal', 'LIKE', "%{$search}%");
			$query->orWhere('username', 'LIKE', "%{$search}%");
			$query->orWhere('registerd_email', 'LIKE', "%{$search}%");
			$query->orWhere('password', 'LIKE', "%{$search}%");
		}
		if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '') {
			$search_3 = $_POST['columns'][3]['search']['value'];
			$query->Where('password', 'LIKE', "%{$search_3}%");
			$query->Where('registerd_email', 'LIKE', "%{$search_3}%");
			$query->Where('username', 'LIKE', "%{$search_3}%");
			$query->Where('portal', 'LIKE', "%{$search_3}%");
			$query->Where('location', 'LIKE', "%{$search_3}%");
			$query->Where('email', 'LIKE', "%{$search_3}%");
			$query->Where('contact_department', 'LIKE', "%{$search_3}%");
			$query->Where('office', 'LIKE', "%{$search_3}%");
			$query->Where('mobile', 'LIKE', "%{$search_3}%");
			$query->Where('contact_person_incharge', 'LIKE', "%{$search_3}%");
			$query->Where('contact_person', 'LIKE', "%{$search_3}%");
			$query->Where('website', 'LIKE', "%{$search_3}%");
			$query->Where('fax', 'LIKE', "%{$search_3}%");
			$query->Where('mobile2', 'LIKE', "%{$search_3}%");
			$query->Where('mobile1', 'LIKE', "%{$search_3}%");
			$query->Where('office_phone2', 'LIKE', "%{$search_3}%");
			$query->Where('office_phone1', 'LIKE', "%{$search_3}%");
			$query->Where('email2', 'LIKE', "%{$search_3}%");
			$query->Where('email1', 'LIKE', "%{$search_3}%");
			$query->Where('sup_zip', 'LIKE', "%{$search_3}%");
			$query->Where('sup_city', 'LIKE', "%{$search_3}%");
			$query->Where('sup_region', 'LIKE', "%{$search_3}%");
			$query->Where('sup_country', 'LIKE', "%{$search_3}%");
			$query->Where('sup_add2', 'LIKE', "%{$search_3}%");
			$query->Where('sup_add1', 'LIKE', "%{$search_3}%");
			$query->Where('sup_name', 'LIKE', "%{$search_3}%");
			$query->Where('key_account', 'LIKE', "%{$search_3}%");
			$query->Where('salesman', 'LIKE', "%{$search_3}%");
			$query->Where('sup_category', 'LIKE', "%{$search_3}%");
			$query->Where('sup_type', 'LIKE', "%{$search_3}%");
			$query->Where('sup_code', 'LIKE', "%{$search_3}%");
			echo "test";
		}
		$query->skip($_POST['start'])->take($_POST['length']);
		$supplier = $query->get();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		$row = array();
		foreach ($supplier as $supplier_detail) {
			if (isset($supplier_detail->account_group)) {
				$status = '<span class="label label-lg font-weight-bold label-light-primary label-inline">Updated</span';
			} else {
				$status = '<span class="label label-lg label-light-danger label-inline">Not Updated</span>';
			}
			$no++;
			$row[0] = '<tr role="row">
						<th class="dt-left sorting_disabled" >
						   <label class="checkbox checkbox-single">
						   <input type="checkbox" value="" class="group-checkable">
						   <span></span>
						   </label>
						</th></tr>';
			$row[1] = $no;
			$row[2] = $supplier_detail->sup_code;
			$row[3] = $supplier_detail->type;
			$row[4] = $supplier_detail->category;
			$row[5] = $supplier_detail->name;
			$row[6] = $supplier_detail->sup_name;
			$row[7] = $status;
			$row[8] = '<span style="overflow: visible; position: relative; width: 80px;">
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
						<i class="fa fa-cog"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
						<ul class="kt-nav">
					   </a>
						<a href="#?id=' . $supplier_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5">
						 <li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-contract"></i>
						<span class="kt-nav__link-text kt_edit_accounts" id=' . $supplier_detail->id . ' data-id=' . $supplier_detail->id . '>Update</span></span></li></a>
					   </ul></div></div></span>';
			$data[$i] = $row;
			$i++;
		}
		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $totalData,
			"recordsFiltered" => $totalFiltered,
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function deletefiles(Request $request)
	{
		$postID = $request->id;
		SupplierModel::where('id', $postID)->update(['del_flag' => 0]);
		return 'true';
	}
	public function suppliersubmit(Request $request)
	{

		$branch = $request->branch;
		$postID = $request->info_id;
		if (isset($postID) && !empty($postID)) {
			$check = $this->check_exists_edit($postID, $request->email1);
		} else {
			$check = $this->check_exists1($request->email1);
		}
		if ($check < 1) {

			// sssss
			$account_ledger = $request->account_ledger;
			$accountType = $request->accountType;
			if ($accountType == 'new account') {
				$data = array(
					'group_id' => $request->l_group_id,
					'name' => $request->l_name,
					'code' => $request->l_code,
					'op_balance' => $request->l_op_balance,
					'op_balance_dc' => $request->l_op_balance_dc,
					'type' => $request->l_type,
					'reconciliation' => $request->l_reconciliation,
					'notes' => $request->l_notes
				);
				$this->connectToAccounting();
				$account_ledger = DB::connection('mysql_accounting')->table('ledgers')->insertGetId($data);
			}

			$data = [
				'sup_code' => $request->sup_code,
				'sup_type' => $request->sup_type,
				'sup_category' => $request->sup_category,
				'salesman' => $request->salesman,
				'key_account' => $request->key_account,
				'sup_note' => $request->sup_note,
				'sup_name_alias' => $request->sup_name_alias,
				'sup_name' => $request->sup_name,
				'sup_add1' => $request->sup_add1,
				'sup_add2' => $request->sup_add2,
				'sup_country' => $request->sup_country,
				'sup_region' => $request->sup_region,
				'sup_city' => $request->sup_city,
				'sup_zip' => $request->sup_zip,
				'email1' => $request->email1,
				'email2' => $request->email2,
				'office_phone1' => $request->office_phone1,
				'office_phone2' => $request->office_phone2,
				'mobile1' => $request->mobile1,
				'mobile2' => $request->mobile2,
				'fax' => $request->fax,
				'website' => $request->website,
				'contact_person' => $request->contact_person,
				'contact_person_incharge' => $request->contact_person_incharge,
				'mobile' => $request->mobile,
				'office' => $request->office,
				'contact_department' => $request->contact_department,
				'email' => $request->email,
				'location' => $request->location,
				'username' => $request->username,
				'password' => Hash::make($request->password),
				'branch' => $branch,
				'additionalno' => $request->additionalno,
				'vatno' => $request->vatno,
				'buyerid_crno' => $request->buyerid_crno,
				'sup_name_alias_ar' => $request->sup_name_alias_ar,
				'sup_name_ar' => $request->sup_name_ar,
				'sup_add1_ar' => $request->sup_add1_ar,
				'sup_add2_ar' => $request->sup_add2_ar,
				'sup_country_ar' => $request->sup_country_ar,
				'sup_region_ar' => $request->sup_region_ar,
				'sup_city_ar' => $request->sup_city_ar,
				'sup_zip_ar' => $request->sup_zip_ar,
				'vatno_ar' => $request->vatno_ar,
				'buyerid_crno_ar' => $request->buyerid_crno_ar,
				'sup_state_ar' => $request->sup_state_ar,
				'additionalno_ar' => $request->additionalno_ar,
				'sup_state' => $request->sup_state,

				'account_ledger' => $account_ledger,
			];
			$userInfo = SupplierModel::updateOrCreate(['id' => $postID], $data);
			Supplier::where('info_id', $userInfo->id)
				->delete();

			if (isset($postID) && !empty($postID)) {
				$sid = $postID;
			} else {
				$sid = $userInfo->id;
			}


			if (!empty($request->mobiles)) {
				foreach ($request->mobiles as $key => $value) {
					Supplier::create([
						'info_id' => $userInfo->id, 'contact_personvalue' => $request->contact_personvalue[$key], 'contact_person_incharges' => $request->contact_person_incharges[$key], 'mobiles' => $request->mobiles[$key], 'offices' => $request->offices[$key], 'emails' => $request->emails[$key], 'departments' => $request->departments[$key], 'locations' => $request->locations[$key], 'branch' => $branch
					]);
				}
			}
			if (isset($postID)) {
			} else {
				$data = DB::table('qcrm_suppliercatogry')->select('id', 'increment')->where('id', $request->sup_category)->get();
				foreach ($data as $key => $value) {
					$increment = $value->increment + 1;
				}
				SupplierCategory::where('id', $request->sup_category)->update(['increment' => $increment]);
			}
			$message = '';
			//$this->sendSupplierMail($request->email, $message, $request->sup_name);
			return 'true';
		} else {
			return 'false';
		}
	}


	public function sendSupplierMail($email, $message, $name)
	{
		try {
			$data = array('name' => "Virat Gandhi");
			$mailView = 'mail';
			Mail::send(['text' => $mailView], $data, function ($message) use ($email, $name) {
				$message->to('amalqzolve@gmail.com', 'Welcome ' . $name)
					->subject('Supplier Welcome Mail');
			});
			// return redirect()->back()->with('success', 'Test email sent successfully');
		} catch (\Exception $e) {
			print_r($e->getMessage());
		}
	}


	/**
	 *Supplier Type delete 
	 */
	public function deletesuppliertypeInfo(Request $request)
	{
		$postID = $request->id;
		$query = DB::table('qcrm_supplier')->select('sup_type')->where('sup_type', $postID)->where('del_flag', 1)->get();
		$no = $query->count();
		if ($no > 0) {
			return '1';
		} else {
			suppliertype::where('id', $postID)->update(['del_flag' => 0]);
			return 'true';
		}
	}
	/**
	 *Supplier Type Submit 
	 */

	public function typeSubmit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->info_id;
		$check = $this->check_exists($request->title, 'title', 'qcrm_supplier_type');
		if ($check < 1) {
			$data   = [
				'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color, 'branch' => $branch
			];
			$userInfo = suppliertype::updateOrCreate(['id' => $postID], $data);
			return 'true';
		} else {
			return 'false';
		}
	}
	public function supplierTrashRestore(Request $request)
	{
		$postID = $request->id;
		SupplierModel::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}


	public function edit_supplier_document(Request $request)
	{
		$branch = Session::get('branch');

		$id = $_REQUEST['id'];
		$payment_terms = PaymentModel::where('branch', $branch)->get();
		$supplierdocuments = Supplier_documents_Model::where('supplier_id', $id)->get();
		$unq_id = uniqid();
		$docs = DB::table('qcrm_supplier_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_supplier_docs.expdate, '%d-%m-%Y') as expdate1"))->where('supplier_id', $id)->get();

		return view('crm.suppliers.supplier_document_edit', compact('id', 'payment_terms', 'unq_id', 'branch', 'supplierdocuments', 'docs'));
	}
	//supplier document pdf


	public function sup_docpdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

		$payment_termss = PaymentModel::where('branch', $branch)->get();

		$supplier = SupplierModel::where('id', $id)->get();
		$supplierdocuments = Supplier_documents_Model::where('supplier_id', $id)->get();
		$unq_id = uniqid();


		$pdf = PDF::loadView('crm.suppliers.supdocpdf', compact('id', 'payment_termss', 'unq_id', 'branch', 'supplier', 'supplierdocuments', 'branchsettings'));

		return $pdf->stream('document.pdf');
	}
	//supplier account pdf


	public function suplier_accountpdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

		$account = SupplierModel::where('id', $id)->limit(1)->first();
		$category = DB::table('qcrm_customer_categorydetails')->select('id', 'customer_category')->where('del_flag', 1)->get();
		$pdf = PDF::loadView('crm.supplieraccounts.pdf', compact('category', 'branchsettings'), ['data' => $account]);

		return $pdf->stream('document.pdf');
	}
	public function supplierdocumentSubmit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->supplier_id;
		$data = ['supplier_id' => $postID, 'no_of_invoices' => $request->no_of_invoices, 'credit_period_of_each_invoices' => $request->credit_period_each_invoice, 'total_amount' => $request->total_amount, 'credit_period_of_total_invoices' => $request->credit_period_total_invoice, 'payment_terms' => $request->payment_terms, 'description' => $request->description, 'branch' => $branch];
		$userInfo = Supplier_documents_Model::updateOrCreate(['supplier_id' => $postID], $data);
		DB::table('qcrm_supplier_docs')->where('supplier_id', $postID)->delete();
		if (isset($request->documentname) && !empty($request->documentname)) {
			for ($i = 0; $i < count($request->documentname); $i++) {
				$data1 = ['supplier_id' => $postID, 'docname' => $request->documentname[$i], 'expdate' => Carbon::parse($request->expirydate[$i])->format('Y-m-d'), 'days' => $request->days[$i]];

				DB::table('qcrm_supplier_docs')->insert($data1);
			}
		}

		return 'true';
	}
	public function getpayterms(Request $request)
	{
		$data['payterm'] = PaymentModel::where('id', $request->grp_id)
			->limit(1)
			->first();
		echo json_encode($data);
	}
	public function download($path, $file)
	{
		$file_name = $path . '/' . $file;
		$file_path = public_path($file_name);
		return response()->download($file_path);
	}
	public function supplier_download(Request $request)
	{
		$id = $request->id;
		$customerdocuments = Supplier_documents_Model::where('supplier_id', $id)->get();
		return view('crm.Supdownload.sup_download', ['data' => $customerdocuments], compact('id'));
	}
	public function getcategorycode(Request $request)
	{
		$id = $request->id;

		$data = DB::table('qcrm_suppliercatogry')->select('id', 'title', 'increment', 'customcode')->where('id', $id)->get();



		return response()->json($data);
	}
	public function check_exists($value, $field, $table)
	{
		$branch = Session::get('branch');

		$query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
		// $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		return $query->count();
	}
	public function check_exists1($value1)
	{
		$branch = Session::get('branch');

		$query = DB::table('qcrm_supplier')->select('*')->where('email1', $value1)->where('del_flag', 1)->where('branch', $branch)->get();
		// $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		//	return $query->count();
		return 0;
	}

	public function getcustomerusername(Request $request)
	{
		$branch = Session::get('branch');
		$username = $request->id;
		$query = DB::table('qcrm_supplier')->select('*')->where('username', $username)->where('del_flag', 1)->where('branch', $branch)->get();
		$check = $query->count();
		return $check;
	}
	public function check_exists_edit($id, $value1)
	{
		$query = DB::table('qcrm_supplier')->select('*')->where('email1', $value1)->where('del_flag', 1)->whereNotIn('id', [$id])->get();
		// $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		return $query->count();
	}
	public function exportproductdatasupplier()
	{
		return view('crm.datamigration.exportsupplier');
	}
}

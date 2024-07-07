<?php

namespace App\Http\Controllers\crm;

use App\crm\CustomerModel;
use App\crm\customer;
use APP\crm\Category;
use App\crm\CustomerTypeModel;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerGroup;
use App\crm\customerCreditlimitModel;
use DB;
use PDF;
use App\crm\SalesmanDetailModel;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use App\crm\Customer_documents_Model;
use App\crm\PaymentModel;
use App\crm\countryModel;
use Session;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Traits\AccountingActionsTrait;
use App\settings\BranchSettingsModel;


class CustomerController extends Controller
{

	use AccountingActionsTrait;
	/**
	 *Customer Listing Function
	 */
	public function index(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query  = DB::table('qcrm_customer_details')->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
				->leftJoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
				->select('qcrm_customer_details.id as id', 'qcrm_customer_details.cust_code as cust_code', 'qcrm_customer_details.cust_name as cust_name', 'qcrm_customer_details.cust_name_alias as cust_name_alias', 'qcrm_customer_details.mobile1 as mobile1', 'qcrm_customer_categorydetails.customer_category as custcategory', 'qcrm_customer_groupdetails.title as grouptitle', 'qcrm_customer_details.ar_cust_name', 'qcrm_customer_details.email1', 'qcrm_customer_details.vatno')
				->orderby('id', 'desc');
			/*$query->where('qcrm_customer_details.del_flag', 1)->where('qcrm_customer_details.branch',$branch);*/

			if (Session::get('common_customer_database') == 1) {
				$query->where('qcrm_customer_details.del_flag', 1);
			} else {
				$query->where('qcrm_customer_details.del_flag', 1)->where('qcrm_customer_details.branch', $branch);
			}
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		$data = CustomerModel::all();
		return view('crm.customer.customer_details', ['data' => $data], compact('branch'));
	}

	/**
	 *Customer details Add Function
	 */
	public function add_custmer()
	{
		$branch = Session::get('branch');

		$areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();

		$category = CustomerCategoryModel::select('id', 'customer_category', 'cust_code', 'start_from')->where('branch', $branch)->where('del_flag', 1)->get();
		$areaLists = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
		$group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
		$country = countryModel::select('id', 'cntry_name')->get();
		$salesman = SalesmanDetailModel::select('id', 'name', 'account_ledger')->where('branch', $branch)->where('del_flag', 1)->get();


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

		return view('crm.customer.customer_details_add', compact('areaList', 'areaLists', 'group', 'groups', 'salesman', 'country', 'branch', 'keyaccountants', 'fullGroups', 'fullLedger'));
	}

	/**
	 *Customer edits Function
	 */
	public function edits(Request $request)
	{
		$branch = Session::get('branch');

		$skill = [];
		$id = $request->id;
		$customeradd = customer::where('info_id', $id)->get();
		$type = CustomerTypeModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
		$category = CustomerCategoryModel::select('id', 'customer_category')->where('branch', $branch)->where('del_flag', 1)->get();
		$customer = CustomerModel::where('id', $id)->limit(1)
			->first();
		$documents = Customer_documents_Model::where('customer_id', $id)->get();

		$group = CustomerGroup::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();

		$salesman = SalesmanDetailModel::select('id', 'name', 'account_ledger')->where('branch', $branch)->where('del_flag', 1)->get();
		$country = countryModel::select('id', 'cntry_name')->get();
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
		return view('crm.customer.customer_edit', ['data' => $customer, 'datas' => $customeradd], compact('category', 'type', 'salesman', 'groups', 'group', 'country', 'branch', 'documents', 'keyaccountants', 'fullLedger', 'fullGroups'));
	}


	/**
	 *Customer Documents & Contracts Listing
	 */
	public function crmcustomerdocuments(Request $request)
	{
		$branch = Session::get('branch');
		$ta = 1;
		$te = 1;
		if ($request->ajax()) {
			DB::enableQueryLog();

			// and then you can get query log


			$query  = DB::table('qcrm_customer_details')->leftJoin('qcrm_customer_documents', 'qcrm_customer_details.id', '=', 'qcrm_customer_documents.customer_id')->leftJoin('qcrm_customer_docs', 'qcrm_customer_details.id', '=', 'qcrm_customer_docs.customerid')

				->select('qcrm_customer_details.cust_name', 'qcrm_customer_details.id', 'qcrm_customer_documents.documents', 'qcrm_customer_documents.customer_id', DB::raw("DATE_FORMAT(qcrm_customer_docs.expdate, '%d-%m-%Y') as expdate"))
				->groupBy('qcrm_customer_details.id')
				->orderby('qcrm_customer_details.id', 'desc');
			$query->where('qcrm_customer_details.del_flag', 1);
			$data = $query->get();

			foreach ($data as $key => $value) {

				$value->exp = "";
				$value->ac = "";
				$value->total = "";
				$value->total = DB::table('qcrm_customer_docs')->select('docname')->where('customerid', $value->id)->where('del_flag', 1)->count();
				$cdate = date('Y-m-d');
				$value->exp = DB::table('qcrm_customer_docs')->select('expdate')->where('customerid', $value->id)->where('del_flag', 1)->where('expdate', '<', $cdate)->count();

				$value->ac = DB::table('qcrm_customer_docs')->select('expdate')->where('customerid', $value->id)->where('del_flag', 1)->where('expdate', '>=', $cdate)->count();
			}

			$count_filter = $query->count();
			$count_total = CustomerModel::count();

			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		return view('crm.document.cust_document', compact('branch'));
	}

	/**
	 *Customer category Function for find starting from and  customer code
	 */
	public function findstartform(Request $request)
	{
		$id = $request->id;
		$data = CustomerCategoryModel::select('cust_start')->where('id', $id)->get();
		foreach ($data as $value) {
			$cust_start = $value->cust_start;
		}
		return response()
			->json($cust_start);
	}
	/**
	 *Customer Group Trash Restore
	 */
	public function grouptrashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerGroup::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	/**
	 *Customer Group delete function
	 */
	public function groupdelete(Request $request)
	{
		$delete = $request->id;
		$del = DB::table('qcrm_customer_details')->select('cust_group')->where('cust_group', $delete)->where('del_flag', 1)->get();
		$group = $del->count();
		if ($group > 0) {
			return '1';
		} else {
			CustomerGroup::where('id', $delete)->update(['del_flag' => 0]);
			return 'true';
		}
	}
	/**
	 *Customer Group update  function for datas show from database
	 */
	public function groupupdate(Request $request)
	{
		$data['users'] = CustomerGroup::where('id', $request->info_id)
			->limit(1)
			->first();
		echo json_encode($data);
	}
	/**
	 *Customer Category Listing page Function
	 */
	public function groupindex(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = CustomerGroup::orderby('id', 'desc');
			$query->where('del_flag', 1)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerGroup::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		return view('crm.customer_grop.groupindex', compact('branch'));
	}
	/**
	 *Customer Group data submission for datatables Function
	 */
	public function groupsubmit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->info_id;
		$check = $this->check_exists($request->title, 'title', 'qcrm_customer_groupdetails');
		if ($check < 1) {
			$data = [
				'title' => $request->title, 'description' => $request->description,
				'color' => $request->color, 'branch' => $branch
			];
			$userInfo = CustomerGroup::updateOrCreate(['id' => $postID], $data);

			// if ($request->info_id) {
			//     $msg = 'updated';
			// } else {
			//     $msg = 'created';
			// }
			// Session::flash('success', 'Customer group ' . $msg . ' successfully.');

			return 'true';
		} else {
			return 'false';
		}
	}
	/**
	 *Customer group trash forms listing Function
	 */

	public function grouptrash(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = CustomerGroup::orderby('id', 'desc');
			$query->where('del_flag', 0)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerGroup::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.customer_grop.group_trash');
	}
	/**
	 *Customer group view page lists Function
	 */
	public function view_group_lists(Request $request)
	{
		$id = $_REQUEST['id'];
		$users = CustomerGroup::where('id', $id)->limit(1)
			->first();
		return view('crm.customer_grop.group_view_list', ['data' => $users]);
	}
	/**
	 *Customer Category Form page listing Function
	 */
	public function custcategoryindex(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = CustomerCategoryModel::orderby('id', 'desc');
			$query->where('del_flag', 1)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerCategoryModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.category.customer_category_details', compact('branch'));
	}
	/**
	 *Customer Type Form Listing Function
	 */
	public function custtypeindex(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = CustomerTypeModel::orderby('id', 'desc');
			$query->where('del_flag', 1)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerTypeModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.type.customer_type_details', compact('branch'));
	}
	/**
	 *Customer Category Trash  page listing  Function
	 */
	public function trashcategory(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = CustomerCategoryModel::orderby('id', 'desc');
			$query->where('del_flag', 0)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerCategoryModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.category.trashcategory');
	}
	/**
	 *Customer type trash page listing Function
	 */
	public function typetrashs(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = CustomerTypeModel::orderby('id', 'desc');
			$query->where('del_flag', 0)->where('branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerTypeModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.type.typetrash');
	}
	/**
	 *Customer trash restore from datatable condition Function
	 */
	public function customertrashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerModel::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	/**
	 *Customer trash restore Function
	 */

	public function trashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerCategoryModel::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	/**
	 *Customer  Trash Listing Function
	 */
	public function customertrashshow(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query  = DB::table('qcrm_customer_details')->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
				->leftJoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
				->select('qcrm_customer_details.id as id', 'qcrm_customer_details.cust_code as cust_code', 'qcrm_customer_details.cust_name as cust_name', 'qcrm_customer_details.cust_name_alias as cust_name_alias', 'qcrm_customer_details.mobile1 as mobile1', 'qcrm_customer_categorydetails.customer_category as custcategory', 'qcrm_customer_groupdetails.title as grouptitle')
				->orderby('id', 'desc');
			$query->where('qcrm_customer_details.del_flag', 0)->where('qcrm_customer_details.branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = CustomerModel::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}

		return view('crm.customer.trash_details');
	}
	/**
	 *Customer Category add Function
	 */
	public function add_category()
	{
		return view('crm.customer.customer_category_add');
	}
	/**
	 *Customer type edit datas shows from datatables Function
	 */
	public function type_updatess(Request $request)
	{
		$data['users'] = CustomerTypeModel::where('id', $request->info_id)
			->limit(1)
			->first();
		echo json_encode($data);
	}
	/**
	 *Customer type trash restore Function
	 */
	public function typetrashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerTypeModel::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	/**
	 *Customer Category Edit Function
	 */
	public function categoryedit(Request $request)
	{
		$data['users'] = CustomerCategoryModel::where('id', $request->info_id)
			->limit(1)
			->first();
		echo json_encode($data);
	}


	//cutomer details pdf

	public function customer_pdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$users = DB::table('qcrm_customer_details')->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
			->leftJoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftJoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftJoin('qcrm_salesman_details', 'qcrm_customer_details.salesman', '=', 'qcrm_salesman_details.id')->leftJoin('a_branch1_a_groups', 'qcrm_customer_details.key_account', '=', 'a_branch1_a_groups.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->leftJoin('countries as invoicecountry', 'qcrm_customer_details.invoice_country', '=', 'invoicecountry.id')->leftJoin('countries as shippingcountry', 'qcrm_customer_details.invoice_country', '=', 'shippingcountry.id')
			->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category as custcategory', 'qcrm_customer_groupdetails.title as grouptitle', 'qcrm_customer_typedetails.title as customertype', 'qcrm_salesman_details.name as salesmanname', 'a_branch1_a_groups.name as account_ledger', 'countries.cntry_name as country', 'invoicecountry.cntry_name as invoice_country', 'shippingcountry.cntry_name as shipping_country')->where('qcrm_customer_details.id', $id)->get();

		$customercontact = customer::where('info_id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
		$docs = DB::table('qcrm_customer_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_customer_docs.expdate, '%d-%m-%Y') as expdate1"))->where('customerid', $id)->get();

		$total = DB::table('qcrm_customer_docs')->select('docname')->where('customerid', $id)->where('del_flag', 1)->count();
		$cdate = date('Y-m-d');
		$exp = DB::table('qcrm_customer_docs')->select('expdate')->where('customerid', $id)->where('del_flag', 1)->where('expdate', '<', $cdate)->count();

		$ac = DB::table('qcrm_customer_docs')->select('expdate')->where('customerid', $id)->where('del_flag', 1)->where('expdate', '>=', $cdate)->count();

		$pdf = PDF::loadView('crm.customer.preview2', compact('users', 'customercontact', 'branchsettings', 'branch', 'docs', 'total', 'exp', 'ac'));

		//return $pdf->stream('document.pdf');

		return $pdf->stream('Customer-Information-#' . $id . '.pdf');
	}
	/**
	 *Customer view the entire details from table Function
	 */
	public function view_customer(Request $request)
	{
		$id = $_REQUEST['id'];
		$users = DB::table('qcrm_customer_details')->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
			->leftJoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')->leftJoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')->leftJoin('qcrm_salesman_details', 'qcrm_customer_details.salesman', '=', 'qcrm_salesman_details.id')->leftJoin('a_branch1_a_groups', 'qcrm_customer_details.key_account', '=', 'a_branch1_a_groups.id')->leftJoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')->leftJoin('countries as invoicecountry', 'qcrm_customer_details.invoice_country', '=', 'invoicecountry.id')->leftJoin('countries as shippingcountry', 'qcrm_customer_details.invoice_country', '=', 'shippingcountry.id')
			->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category as custcategory', 'qcrm_customer_groupdetails.title as grouptitle', 'qcrm_customer_typedetails.title as customertype', 'qcrm_salesman_details.name as salesmanname', 'a_branch1_a_groups.name as account_ledger', 'countries.cntry_name as country', 'invoicecountry.cntry_name as invoice_country', 'shippingcountry.cntry_name as shipping_country')->where('qcrm_customer_details.id', $id)->get();

		$customercontact = customer::where('info_id', $id)->get();

		return view('crm.customer.customer_view', compact('users', 'customercontact'));
	}
	/**
	 *Customer Category entire details view for Function
	 */
	public function view_category_list(Request $request)
	{
		$id = $_REQUEST['id'];
		$users = CustomerCategoryModel::where('id', $id)->limit(1)
			->first();
		return view('crm.category.category_view', ['datas' => $users]);
	}
	/**
	 *Customer Type View page entire data Function
	 */
	public function view_type_list(Request $request)
	{
		$id = $_REQUEST['id'];
		$users = CustomerTypeModel::where('id', $id)->limit(1)
			->first();
		return view('crm.type.typeview', ['datas' => $users]);
	}
	/**
	 *Customer Submission Function
	 */
	public function submit_customer(Request $request)
	{
		$checkc = "";
		$postID = $request->info_id;
		$branch = $request->branch;
		if (isset($postID) && !empty($postID)) {
			$checkc = $this->check_exists_edit($postID, $request->email1);
		} else {
			$checkc = $this->check_exists1($request->email1);
		}

		if ($checkc < 1) {

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
				'cust_code' => $request->cust_code,
				'cust_type' => $request->cust_type,
				'cust_category' => $request->cust_category,
				'salesman' => $request->salesman,
				'key_account' => $request->key_account,
				'cust_note' => $request->cust_note,
				'cust_name_alias' => $request->cust_name_alias,
				'cust_group' => $request->cust_group,
				'cust_name' => $request->cust_name,
				'cust_add1' => $request->cust_add1,
				'cust_add2' => $request->cust_add2,
				'cust_country' => $request->cust_country,
				'cust_region' => $request->cust_region,
				'cust_city' => $request->cust_city,
				'cust_zip' => $request->cust_zip,
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
				'password' => encrypt($request->password),
				'ar_cust_name' => $request->arcust_name,
				'ar_cust_add1' => $request->arcust_add1,
				'ar_cust_add2' => $request->arcust_add2,
				'ar_cust_country' => $request->arcust_country,
				'ar_cust_region' => $request->arcust_region,
				'ar_cust_city' => $request->arcust_city,
				'ar_cust_zip' => $request->ar_cust_zip,
				'additionalno' => $request->additionalno,
				'ar_additionalno' => $request->ar_additionalno,
				'province_state' => $request->province_state,
				'ar_province_state' => $request->ar_province_state,
				'vatno' => $request->vatno,
				'buyerid_crno' => $request->crno,
				'ar_vatno' => $request->ar_vatno,
				'ar_buyerid_crno' => $request->ar_buyerid_crno,
				'account_ledger' => $account_ledger,
				'branch' => $branch,
			];

			$userInfo = CustomerModel::updateOrCreate(['id' => $postID], $data);
			customer::where('info_id', $userInfo->id)->delete();
			if (!empty($request->input('contact_personvalue'))) {
				for ($i = 0; $i < count($request->contact_personvalue); $i++) {
					$data =	array(
						'info_id' => $userInfo->id,
						'contact_personvalue' => $request->contact_personvalue[$i],
						'mobiles' => $request->mobiles[$i],
						'offices' => $request->offices[$i],
						'emails' => $request->emails[$i],
						'departments' => $request->departments[$i],
						'locations' => $request->locations[$i],
						'branch' => $branch
					);
					customer::Create($data);
				}
			}





			$custid = $userInfo->id;
			$creditlimit = ['cust_id' => $custid, 'cust_name' => $request->cust_name, 'branch' => $branch];
			$creditlimitInfo = customerCreditlimitModel::Create($creditlimit);
			if (isset($postID)) {
			} else {
				$data = DB::table('qcrm_customer_categorydetails')->select('id', 'increment')->where('id', $request->cust_category)->get();

				foreach ($data as $key => $value) {
					$increment = $value->increment + 1;
				}

				CustomerCategoryModel::where('id', $request->cust_category)->update(['increment' => $increment]);
			}
			return 'true';
		} else {
			return 'false';
		}

		///////////////////////////////

		// if (isset($postID) && !empty($postID)) {
		// } else {

		// 	$ledgercode = $this->getcustomerledgercode();

		// 	$company_accounts = DB::table('qsettings_company_accounts')->select('*')->get();

		// 	$customer_group = 0;

		// 	foreach ($company_accounts as $key => $value) {
		// 		$customer_group = $value->customer_group;
		// 	}
		// 	$subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
		// 	$subgrouptable = $subtable . 'a_groups';

		// 	$subledgertable = $subtable . 'ledgers';

		// 	$data = array(
		// 		'code' => $ledgercode,
		// 		'op_balance' => 0,
		// 		'name' =>  $request->cust_name . '-' . $request->cust_code,
		// 		'group_id' => $customer_group,
		// 		'op_balance_dc' => 0,
		// 		'notes' => $request->cust_name . '-' . $request->cust_code,
		// 		'reconciliation' => 0,
		// 		'type' => 0,
		// 	);
		// 	$main_ledger =  DB::table($subledgertable)->insert($data);
		// 	//main accounts
		// 	$main_ledger_id = DB::getPdo()->lastInsertId();


		// 	$data = ['account_ledger' => $main_ledger_id];


		// 	DB::table('qcrm_customer_details')->where('id', $cid)->update($data);



		// 	return 'true';
		// }

		////////////////////////////';'

	}


	public function getcustomerledgercode()
	{



		$branch = Session::get('branch');

		/* $company_accounts = DB::table('qsettings_company_accounts')->select('*')->where('branch', '=', $branch)->get();
*/

		$company_accounts = DB::table('qsettings_company_accounts')->select('*')->get();



		$customer_group = 0;

		foreach ($company_accounts as $key => $value) {
			$customer_group = $value->customer_group;
		}




		$subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
		$subgrouptable = $subtable . 'a_groups';

		$subledgertable = $subtable . 'ledgers';



		$p_group_code = DB::table($subgrouptable)->select('code')->where('id', '=', $customer_group)->value('code');
		//dd($customer_group);
		$q = DB::table($subledgertable)->select('code')->where('group_id', '=', $customer_group)->orderBy('id', 'desc')->first();


		if ($q) {

			$last = $q->code;

			$l_array = explode('-', $last);

			$new_index = end($l_array);

			$new_index += 1;
			$new_index = sprintf("%04d", $new_index);


			return $p_group_code . "-" . $new_index;
		} else {
			return $p_group_code . "-0001";
		}
	}
	/**
	 *Customer Category submission Function
	 */
	public function Categorys_submit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->info_id;
		$check = $this->check_exists($request->customer_category, 'customer_category', 'qcrm_customer_categorydetails');
		if ($check < 1) {
			$data = ['cust_start' => $request->cust_code . '/' . number_format($request->start_from + 1), 'customer_category' => $request->customer_category, 'description' => $request->description, 'color' => $request->color, 'cust_code' => $request->cust_code, 'start_from' => $request->start_from, 'increment' => $request->start_from, 'branch' => $branch];
			$userInfo = CustomerCategoryModel::updateOrCreate(['id' => $postID], $data);

			return 'true';
		} else {
			return 'false';
		}
	}
	/**
	 *Customer Category delete Function
	 */
	public function deletecategory(Request $request)
	{

		$id = $request->id;
		$query = DB::table('qcrm_customer_details')->select('cust_category')->where('cust_category', $id)->where('del_flag', 1)->get();
		$no = $query->count();
		if ($no > 0) {
			return '1';
		} else {
			CustomerCategoryModel::where('id', $id)->update(['del_flag' => 0]);
			return 'true';
		}
	}
	/**
	 *Customer type delete Function
	 */
	public function deletetypeds(Request $request)
	{
		$postID = $request->id;
		$del = DB::table('qcrm_customer_details')->select('cust_type')->where('cust_type', $postID)->where('del_flag', 1)->get();
		$type = $del->count();
		if ($type > 0) {
			return '1';
		} else {
			CustomerTypeModel::where('id', $postID)->update(['del_flag' => 0]);
			return 'true';
		}
	}
	/**
	 *Customer delete Function
	 */

	public function delete_customer(Request $request)
	{
		$postID = $request->id;
		CustomerModel::where('id', $postID)->update(['del_flag' => 0]);
		return 'true';
	}
	/**
	 *Customer trash shows Function
	 */
	public function customersstrashshow(Request $request)
	{
		$totalFiltered = 0;
		$totalData = CustomerModel::count();
		$query = CustomerModel::orderby('id', 'desc');
		if (!empty($request->input('search.value'))) {
			$search = $request->input('search.value');
			$query->where('id', 'LIKE', "%{$search}%");
			$query->orWhere('cust_category', 'LIKE', "%{$search}%");
		}
		$query->where('del_flag', 0);
		$totalFiltered = $query->count();
		$query->skip($_POST['start'])->take($_POST['length']);
		$users = $query->get();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		$row = array();
		foreach ($users as $customer_detail) {
			$no++;
			$row[0] = '<tr role="row">
						<th class="dt-left sorting_disabled" >
						   <label class="checkbox checkbox-single">
						   <input type="checkbox" value="" class="group-checkable">
						   <span></span>
						   </label>
						</th></tr>';
			$row[1] = $customer_detail->cust_code;
			$row[2] = $customer_detail->cust_name;
			$row[3] = $customer_detail->custcontact_person;
			$row[4] = $customer_detail->mobile1;
			$row[5] = $customer_detail->custcategory;
			$row[6] = $customer_detail->grouptitle;
			$row[7] = '<span style="overflow: visible; position: relative; width: 80px;">
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
						<i class="fa fa-cog"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
						<ul class="kt-nav">
					   </ul></div></div></span>';
			$row[7] = '<div class="dropdown dropdown-inline">
				<a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">   <i class="fa fa-cog"></i>   </a>    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
						<ul class="navi flex-column navi-hover py-2">   
						<li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-trash"></i>
						<span class="kt-nav__link-text kt_restore_customerinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Restore</span></span></li>
						</ul></div></div>';
			$data[$i] = $row;
			$i++;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $totalData,
			"recordsFiltered" => $totalFiltered,
			"data" => $data,
		);
		echo json_encode($output);
	}
	/**
	 *Customer Account details show Function
	 */
	public function customeraccountshow(Request $request)
	{
		$totalFiltered = 0;
		$totalData     = CustomerModel::count();
		$query         = DB::table('qcrm_customer_details')
			->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
			->leftJoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
			->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category as custcategory', 'qcrm_customer_groupdetails.title as grouptitle')
			->orderby('id', 'desc');
		$query->where('qcrm_customer_details.del_flag', 1);
		if (!empty($request->input('search.value'))) {
			$search = $request->input('search.value');
			$query->Where('id', 'LIKE', "%{$search}%");
			$query->orWhere('cust_code', 'LIKE', "%{$search}%");
			$query->orWhere('cust_type', 'LIKE', "%{$search}%");
			$query->orWhere('cust_category', 'LIKE', "%{$search}%");
			$query->orWhere('salesman', 'LIKE', "%{$search}%");
			$query->orWhere('key_account', 'LIKE', "%{$search}%");
			$query->orWhere('cust_name', 'LIKE', "%{$search}%");
			$query->orWhere('cust_add1', 'LIKE', "%{$search}%");
			$query->orWhere('cust_add2', 'LIKE', "%{$search}%");
			$query->orWhere('cust_country', 'LIKE', "%{$search}%");
			$query->orWhere('cust_city', 'LIKE', "%{$search}%");
			$query->orWhere('cust_region', 'LIKE', "%{$search}%");
			$query->orWhere('cust_zip', 'LIKE', "%{$search}%");
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
			$query->Where('cust_zip', 'LIKE', "%{$search_3}%");
			$query->Where('cust_city', 'LIKE', "%{$search_3}%");
			$query->Where('cust_region', 'LIKE', "%{$search_3}%");
			$query->Where('cust_country', 'LIKE', "%{$search_3}%");
			$query->Where('cust_add2', 'LIKE', "%{$search_3}%");
			$query->Where('cust_add1', 'LIKE', "%{$search_3}%");
			$query->Where('cust_name', 'LIKE', "%{$search_3}%");
			$query->Where('key_account', 'LIKE', "%{$search_3}%");
			$query->Where('salesman', 'LIKE', "%{$search_3}%");
			$query->Where('cust_category', 'LIKE', "%{$search_3}%");
			$query->Where('cust_type', 'LIKE', "%{$search_3}%");
			$query->Where('cust_code', 'LIKE', "%{$search_3}%");
			echo "test";
		}
		$totalFiltered = $query->count();
		$query->skip($_POST['start'])->take($_POST['length']);
		$customer = $query->get();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		$row = array();
		foreach ($customer as $customer_detail) {
			if (isset($customer_detail->account_group)) {
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
			$row[1] = $customer_detail->cust_code;
			$row[2] = $customer_detail->cust_name;
			$row[3] = $customer_detail->custcontact_person;
			$row[4] = $customer_detail->mobile1;
			$row[5] = $customer_detail->custcategory;
			$row[6] = $status;
			$row[7] = '<span style="overflow: visible; position: relative; width: 80px;">
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
						<i class="fa fa-cog"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
						<ul class="kt-nav">
					   </a>
						  <a href="#?id=' . $customer_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5">
						 <li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-contract"></i>
						<span class="kt-nav__link-text kt_edit_accounts" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Update</span></span></li></a>
					   </ul></div></div></span>';
			$data[$i] = $row;
			$i++;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $totalData,
			"recordsFiltered" => $totalFiltered,
			"data" => $data,
		);
		echo json_encode($output);
	}
	/**
	 *Customer type submission Function
	 */
	public function typeSubmit(Request $request)
	{
		$branch = $request->branch;
		$check = $this->check_exists($request->title, 'title', 'qcrm_customer_typedetails');
		if ($check < 1) {
			$postID = $request->info_id;
			$data = [
				'title' => $request->title, 'discription' => $request->description, 'color' => $request->color, 'branch' => $branch
			];

			$userInfo = CustomerTypeModel::updateOrCreate(['id' => $postID], $data);
			return 'true';
		} else {
			return 'false';
		}
	}
	/**
	 *Customer document datas show  Function
	 */
	public function customer_document_show(Request $request)
	{
		$totalFiltered = 0;
		$totalData     = CustomerModel::count();
		$query         = DB::table('qcrm_customer_details')
			->leftJoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
			->leftJoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
			->leftJoin(
				'qcrm_customer_documents',
				'qcrm_customer_details.id',
				'=',
				'qcrm_customer_documents.customer_id'
			)
			->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category as custcategory', 'qcrm_customer_groupdetails.title as grouptitle', 'qcrm_customer_documents.customer_id')
			->orderby('id', 'desc');
		$query->where('qcrm_customer_details.del_flag', 1);
		if (!empty($request->input('search.value'))) {
			$search = $request->input('search.value');
			$query->Where('id', 'LIKE', "%{$search}%");
			$query->orWhere('cust_code', 'LIKE', "%{$search}%");
			$query->orWhere('cust_type', 'LIKE', "%{$search}%");
			$query->orWhere('cust_category', 'LIKE', "%{$search}%");
			$query->orWhere('salesman', 'LIKE', "%{$search}%");
			$query->orWhere('key_account', 'LIKE', "%{$search}%");
			$query->orWhere('cust_name', 'LIKE', "%{$search}%");
			$query->orWhere('cust_add1', 'LIKE', "%{$search}%");
			$query->orWhere('cust_add2', 'LIKE', "%{$search}%");
			$query->orWhere('cust_country', 'LIKE', "%{$search}%");
			$query->orWhere('cust_city', 'LIKE', "%{$search}%");
			$query->orWhere('cust_region', 'LIKE', "%{$search}%");
			$query->orWhere('cust_zip', 'LIKE', "%{$search}%");
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
			$query->Where('cust_zip', 'LIKE', "%{$search_3}%");
			$query->Where('cust_city', 'LIKE', "%{$search_3}%");
			$query->Where('cust_region', 'LIKE', "%{$search_3}%");
			$query->Where('cust_country', 'LIKE', "%{$search_3}%");
			$query->Where('cust_add2', 'LIKE', "%{$search_3}%");
			$query->Where('cust_add1', 'LIKE', "%{$search_3}%");
			$query->Where('cust_name', 'LIKE', "%{$search_3}%");
			$query->Where('key_account', 'LIKE', "%{$search_3}%");
			$query->Where('salesman', 'LIKE', "%{$search_3}%");
			$query->Where('cust_category', 'LIKE', "%{$search_3}%");
			$query->Where('cust_type', 'LIKE', "%{$search_3}%");
			$query->Where('cust_code', 'LIKE', "%{$search_3}%");
			echo "test";
		}
		$totalFiltered = $query->count();
		$query->skip($_POST['start'])->take($_POST['length']);
		$customer = $query->get();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		$row = array();
		foreach ($customer as $customer_detail) {
			if (isset($customer_detail->customer_id)) {
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
			$row[1] = $customer_detail->cust_code;
			$row[2] = $customer_detail->cust_name;
			$row[3] = $customer_detail->custcontact_person;
			$row[4] = $customer_detail->mobile1;
			$row[5] = $customer_detail->custcategory;
			$row[6] = $status;
			$row[7] = '<a href="customer_download?id=' . $customer_detail->id . '"><button class="btn btn-success btn-elevate btn-icon-sm">
											Download &nbsp; <i class="fa fa-download" aria-hidden="true"></i>
										</button></a>';
			$row[8] = '<div class="dropdown dropdown-inline">
					  <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
					  <i class="fa fa-cog"></i>
					  </a>
						<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
							<ul class="navi flex-column navi-hover py-2">
								<li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">Choose an action:</li>
								<li class="navi-item">
								<a href="edit_customer_document?id=' . $customer_detail->id . '" class="navi-link editdocument"> <span class="navi-icon"><i class="la la-pencil"></i></span>   <span class="navi-text " data-id="' .
				$customer_detail->id . '">Update</span>    
								</a>
							  </li>
							</ul>
						</div>
					</div>';
			$data[$i] = $row;
			$i++;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $totalData,
			"recordsFiltered" => $totalFiltered,
			"data" => $data,
		);
		echo json_encode($output);
	}
	/**
	 *Customer document edit datas Function
	 */
	public function edit_customer_document()
	{
		$branch = Session::get('branch');

		$id = $_REQUEST['id'];
		$payment_terms = PaymentModel::where('branch', $branch)->get();
		// dd($payment_terms);
		$customerdocuments = Customer_documents_Model::where('customer_id', $id)->get();
		// dd($customerdocuments);
		$docs = DB::table('qcrm_customer_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_customer_docs.expdate, '%d-%m-%Y') as expdate1"))->where('customerid', $id)->get();
		$unq_id = uniqid();

		$files = DB::table('qcrm_customer_documents_files')->select('*')->where('customer_id', $id);
		// dd($docs);

		return view('crm.document.customer_document_edit', ['data' => $customerdocuments], compact('id', 'payment_terms', 'unq_id', 'branch', 'files', 'docs'));
	}
	//customer document pdf
	public function cust_docpdf()
	{
		$branch = Session::get('branch');

		$id = $_REQUEST['id'];
		$payment_termss = PaymentModel::where('branch', $branch)->get();
		$customerdocuments = Customer_documents_Model::where('customer_id', $id)->get();
		$customer = CustomerModel::where('id', $id)->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
		$unq_id = uniqid();
		$pdf = PDF::loadView('crm.document.pdf', compact('id', 'payment_termss', 'unq_id', 'branch', 'customer', 'customerdocuments', 'branchsettings'));

		return $pdf->stream('document.pdf');
	}
	/**
	 *Customer document submission Function
	 */
	public function customerdocumentSubmit(Request $request)
	{
		$branch = $request->branch;

		$postID = $request->customer_id;
		$data = [
			'customer_id' => $postID, 'no_of_invoices' => $request->no_of_invoices, 'credit_period_of_each_invoices' => $request->credit_period_each_invoice, 'total_amount' => $request->total_amount, 'credit_period_of_total_invoices' => $request->credit_period_total_invoice, 'payment_terms' => $request->payment_terms, 'description' => $request->description, 'branch' => $branch,
		];
		$userInfo = Customer_documents_Model::updateOrCreate(['customer_id' => $postID], $data);
		DB::table('qcrm_customer_docs')->where('customerid', $postID)->delete();
		if (isset($request->documentname) && !empty($request->documentname)) {
			for ($i = 0; $i < count($request->documentname); $i++) {
				$data1 = ['customerid' => $postID, 'docname' => $request->documentname[$i], 'expdate' => Carbon::parse($request->expirydate[$i])->format('Y-m-d'), 'days' => $request->days[$i]];

				DB::table('qcrm_customer_docs')->insert($data1);
			}
		}


		return 'true';
	}
	/**
	 *Customer download Function
	 */
	public function customer_download(Request $request)
	{
		$id = $request->id;
		$customerdocuments = Customer_documents_Model::where('customer_id', $id)->get();
		return view('crm.Download.common_download', ['data' => $customerdocuments], compact('id'));
	}

	public function deleteCustomerdocumentfile(Request $request)
	{
		$branch = Session::get('branch');
		$customer_id = $request->customer_id;
		$id = $request->id;
		$ofile = $request->file;


		$docs = '';


		$path = public_path('custdocumentInfoData/' . $customer_id);
		$oofile = 'custdocumentInfoData/' . $customer_id . '/' . $ofile;
		File::delete($path . '/' . $ofile);

		DB::table('qcrm_customer_documents_files')->where('id', $id)->delete();


		$oldfiles = DB::table('qcrm_customer_documents')->select('documents', 'customer_id')->where('del_flag', 1)->where('customer_id', $customer_id)->limit(1)->get();
		foreach ($oldfiles as $key => $value) {
			$docs = $value->documents;
		}


		if (!empty($docs)) {
			$docss = $this->removeFromString($docs, $oofile);

			DB::table('qcrm_customer_documents')
				->where('customer_id', $customer_id)
				->update(['documents' => $docss]);
		}
		return response()->json('success');
	}

	public function deleteSupplierdocumentfile(Request $request)
	{
		$branch = Session::get('branch');
		$supplier_id = $request->supplier_id;
		$id = $request->id;
		$ofile = $request->file;


		$docs = '';


		$path = public_path('supdocumentInfoData/' . $supplier_id);
		$oofile = 'supdocumentInfoData/' . $supplier_id . '/' . $ofile;
		File::delete($path . '/' . $ofile);

		DB::table('qcrm_supplier_documents_files')->where('id', $id)->delete();


		$oldfiles = DB::table('qcrm_supplier_documents')->select('documents', 'supplier_id')->where('del_flag', 1)->where('supplier_id', $supplier_id)->limit(1)->get();
		foreach ($oldfiles as $key => $value) {
			$docs = $value->documents;
		}

		if (!empty($docs)) {
			$docss = $this->removeFromString($docs, $oofile);

			DB::table('qcrm_supplier_documents')
				->where('supplier_id', $supplier_id)
				->update(['documents' => $docss]);
		}
		return response()->json('success');
	}



	public function deleteVendordocumentfile(Request $request)
	{
		$branch = Session::get('branch');
		$vendor_id = $request->vendor_id;
		$id = $request->id;
		$ofile = $request->file;


		$docs = '';


		$path = public_path('vendordocumentInfoData/' . $vendor_id);
		$oofile = 'vendordocumentInfoData/' . $vendor_id . '/' . $ofile;
		File::delete($path . '/' . $ofile);

		DB::table('qcrm_vendors_documents_files')->where('id', $id)->delete();


		$oldfiles = DB::table('qcrm_vendors_documents')->select('documents', 'vendor_id')->where('del_flag', 1)->where('vendor_id', $vendor_id)->limit(1)->get();
		foreach ($oldfiles as $key => $value) {
			$docs = $value->documents;
		}

		if (!empty($docs)) {
			$docss = $this->removeFromString($docs, $oofile);

			DB::table('qcrm_vendors_documents')
				->where('vendor_id', $vendor_id)
				->update(['documents' => $docss]);
		}
		return response()->json('success');
	}


	public function removeFromString($str, $item)
	{
		$parts = explode(',', $str);

		while (($i = array_search($item, $parts)) !== false) {
			unset($parts[$i]);
		}

		return implode(',', $parts);
	}

	public function getcategorycode(Request $request)
	{
		$id = $request->id;

		$data = DB::table('qcrm_customer_categorydetails')->select('id', 'customer_category', 'increment', 'cust_code')->where('id', $id)->get();



		return response()->json($data);
	}
	public function check_exists($value, $field, $table)
	{
		$branch = Session::get('branch');

		$query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
		// $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		return $query->count();
	}

	public function deleted(Request $request)
	{
		$id = $request['id'];
		CustomerModel::where('id', $id)->delete();
		return 'true';
	}

	public function cust_doc_view(Request $request)
	{
		$branch = Session::get('branch');
		$customer_id = $request->id;
		if ($request->ajax()) {
			$query  = DB::table('qcrm_customer_documents_files')->select('qcrm_customer_documents_files.*')
				->orderby('qcrm_customer_documents_files.id', 'desc');
			$query->where('qcrm_customer_documents_files.customer_id', $request->customer_id);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = $query->count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		$customername  = DB::table('qcrm_customer_details')->select('cust_name')->where('qcrm_customer_details.id', $customer_id)->get();


		return view('crm.document.cust_doc_view', compact('customer_id', 'customername'));
	}
	public function edit_customer_docs(Request $request)
	{
		$branch = Session::get('branch');

		$id = $request->id;
		$docs = DB::table('qcrm_customer_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_customer_docs.expdate, '%d-%m-%Y') as expdate1"))->where('customerid', $id)->get();

		return view('crm.document.customer_docs', compact('docs'));
	}
	public function check_exists1($value1)
	{
		$branch = Session::get('branch');

		$query = DB::table('qcrm_customer_details')->select('*')->where('email1', $value1)->where('del_flag', 1)->where('branch', $branch)->get();

		return $query->count();
	}
	public function check_exists_edit($id, $value1)
	{
		$query = DB::table('qcrm_customer_details')->select('*')->where('email1', $value1)->where('del_flag', 1)->whereNotIn('id', [$id])->get();
		// $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		return $query->count();
	}

	public function getcustomerusername(Request $request)
	{
		$branch = Session::get('branch');
		$username = $request->id;
		$query = DB::table('qcrm_customer_details')->select('*')->where('username', $username)->where('del_flag', 1)->where('branch', $branch)->get();
		$check = $query->count();
		return $check;
	}
	public function exportproductdatacustomer()
	{
		return view('crm.datamigration.exportcustomer');
	}
}

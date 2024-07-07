<?php

namespace App\Http\Controllers\crm;

use App\crm\vendor;
use App\crm\VendorCategoryModel;
use App\crm\VendorTypeModel;
use App\crm\VendorSkill;
use App\crm\TaxInformation;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;
use App\crm\SalesmanDetailModel;
use App\crm\VendorGroupModel;
use App\crm\countryModel;
use Session;
use DataTables;
use App\settings\BranchSettingsModel;

class vendorsController extends Controller
{
	public function index(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = DB::table('qcrm_vendors')
				->leftJoin('qcrm_vendor_category_details', 'qcrm_vendors.vendor_category', '=', 'qcrm_vendor_category_details.id')
				->leftJoin('qcrm_vendor_type_details', 'qcrm_vendors.vendor_type', '=', 'qcrm_vendor_type_details.id')
				->leftJoin('qcrm_salesman_details', 'qcrm_vendors.salesman', '=', 'qcrm_salesman_details.id')
				->leftJoin('qcrm_salesman_details as as', 'qcrm_vendors.key_account', '=', 'as.id')
				->leftJoin('qcrm_vendor_groups', 'qcrm_vendors.vendor_group', '=', 'qcrm_vendor_groups.id')

				->select('qcrm_vendors.vendor_code', 'qcrm_vendor_category_details.vendor_category', 'qcrm_vendor_type_details.vendor_type', 'qcrm_salesman_details.name', 'qcrm_vendors.vendor_name', 'qcrm_vendors.id', 'as.account_ledger', 'qcrm_vendor_groups.title', 'qcrm_vendors.vendor_name_alias', 'qcrm_vendors.mobile1')
				->orderby('qcrm_vendors.id', 'desc');
			$query->where('qcrm_vendors.del_flag', 1)->where('qcrm_vendors.branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = vendor::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		$data = vendor::all();
		return view('crm.vendors.index', ['data' => $data]);
	}
	//vendors pdf


	public function vendor_pdf(Request $request)
	{
		$id = $request->id;
		$branch = Session::get('branch');

		$users = DB::table('qcrm_vendors')->leftJoin('qcrm_vendor_category_details', 'qcrm_vendors.vendor_category', '=', 'qcrm_vendor_category_details.id')
			->leftJoin('qcrm_vendor_groups', 'qcrm_vendors.vendor_group', '=', 'qcrm_vendor_groups.id')->leftJoin('qcrm_vendor_type_details', 'qcrm_vendors.vendor_type', '=', 'qcrm_vendor_type_details.id')->leftJoin('qcrm_salesman_details', 'qcrm_vendors.salesman', '=', 'qcrm_salesman_details.id')->leftJoin('a_branch1_a_groups', 'qcrm_vendors.key_account', '=', 'a_branch1_a_groups.id')->leftJoin('countries', 'qcrm_vendors.vendor_country', '=', 'countries.id')->leftJoin('countries as invoicecountry', 'qcrm_vendors.invoice_country', '=', 'invoicecountry.id')->leftJoin('countries as shippingcountry', 'qcrm_vendors.shipping_country', '=', 'shippingcountry.id')
			->select('qcrm_vendors.*', 'qcrm_vendor_category_details.vendor_category as vendorcategory', 'qcrm_vendor_groups.title as grouptitle', 'qcrm_vendor_type_details.vendor_type as vendortype', 'qcrm_salesman_details.name as salesmanname', 'a_branch1_a_groups.name as account_ledger', 'countries.cntry_name as country', 'invoicecountry.cntry_name as invoice_country', 'shippingcountry.cntry_name as shipping_country')->where('qcrm_vendors.id', $id)->get();

		$vendorcontact = VendorSkill::where('info_id', $id)->get();

		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();


		$pdf = PDF::loadView('crm.vendors.pdf', compact('branchsettings', 'vendorcontact', 'users'));

		return $pdf->stream('document.pdf');
	}
	public function vencategoryfindstartform(Request $request)
	{
		$id = $request->id;
		$data = VendorCategoryModel::select('vendor_start')->where('id', $id)->get();
		foreach ($data as $value) {
			$cust_start = $value->vendor_start;
		}
		return response()
			->json($cust_start);
	}
	public function addvendordetails()
	{
		$branch = Session::get('branch');

		$categry = VendorCategoryModel::select('id', 'vendor_category')->where('branch', $branch)->where('del_flag', 1)->get();
		$type = VendorTypeModel::select('id', 'vendor_type')->where('branch', $branch)->where('del_flag', 1)->get();
		$category = VendorCategoryModel::select('id', 'vendor_category', 'customcode', 'startfrom')->where('branch', $branch)->where('del_flag', 1)->get();
		$salesman = SalesmanDetailModel::select('id', 'name', 'account_ledger')->where('branch', $branch)->get();
		$vendor_group = VendorGroupModel::select('id', 'title')->where('branch', $branch)->where('del_flag', 1)->get();
		$country = countryModel::select('id', 'cntry_name')->get();
		$groups = DB::table('a_branch1_a_groups')->get()
			->toArray();
		return view('crm.vendors.addvendordetails', compact('categry', 'type', 'salesman', 'groups', 'vendor_group', 'country', 'branch'));
	}
	public function vendorInfoTrash(Request $request)
	{
		$branch = Session::get('branch');

		if ($request->ajax()) {
			$query = DB::table('qcrm_vendors')
				->leftJoin('qcrm_vendor_category_details', 'qcrm_vendors.vendor_category', '=', 'qcrm_vendor_category_details.id')
				->leftJoin('qcrm_vendor_type_details', 'qcrm_vendors.vendor_type', '=', 'qcrm_vendor_type_details.id')
				->leftJoin('qcrm_salesman_details', 'qcrm_vendors.salesman', '=', 'qcrm_salesman_details.id')
				->select('qcrm_vendors.vendor_code', 'qcrm_vendor_category_details.vendor_category', 'qcrm_vendor_type_details.vendor_type', 'qcrm_salesman_details.name', 'qcrm_vendors.vendor_name', 'qcrm_vendors.id', 'qcrm_salesman_details.account_ledger')
				->orderby('qcrm_vendors.id', 'desc');
			$query->where('qcrm_vendors.del_flag', 0)->where('qcrm_vendors.branch', $branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = vendor::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
		}
		return view('crm.vendors.trash');
	}
	public function vendoraccountshow(Request $request)
	{
		$totalFiltered = 0;
		$totalData = vendor::count();
		$vendor_group = VendorGroupModel::select('id', 'title')->get();
		$query = DB::table('qcrm_vendors')->leftJoin('qcrm_vendor_category_details', 'qcrm_vendors.vendor_category', '=', 'qcrm_vendor_category_details.id')
			->leftJoin('qcrm_vendor_type_details', 'qcrm_vendors.vendor_type', '=', 'qcrm_vendor_type_details.id')
			->leftJoin('qcrm_salesman_details', 'qcrm_vendors.salesman', '=', 'qcrm_salesman_details.id')
			->leftJoin('qcrm_vendor_groups', 'qcrm_vendors.vendor_group', '=', 'qcrm_vendor_groups.id')
			->select('qcrm_vendors.*', 'qcrm_vendor_category_details.vendor_category as vvendor_category', 'qcrm_vendor_type_details.vendor_type as vvendor_type,qcrm_salesman_details.name as vsaleman,qcrm_vendor_groups.title as grouptitle')
			->orderby('id', 'desc');
		$query->where('qcrm_vendors.del_flag', 1);
		if (!empty($request->input('search.value'))) {
			$search = $request->input('search.value');
			$query->Where('id', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_code', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_type', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_category', 'LIKE', "%{$search}%");
			$query->orWhere('salesman', 'LIKE', "%{$search}%");
			$query->orWhere('key_account', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_name', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_add1', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_add2', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_country', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_city', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_region', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_zip', 'LIKE', "%{$search}%");
			$query->orWhere('email1', 'LIKE', "%{$search}%");
			$query->orWhere('email2', 'LIKE', "%{$search}%");
			$query->orWhere('office_phone1', 'LIKE', "%{$search}%");
			$query->orWhere('office_phone2', 'LIKE', "%{$search}%");
			$query->orWhere('mobile1', 'LIKE', "%{$search}%");
			$query->orWhere('mobile2', 'LIKE', "%{$search}%");
			$query->orWhere('fax', 'LIKE', "%{$search}%");
			$query->orWhere('website', 'LIKE', "%{$search}%");
			$query->orWhere('contact_person', 'LIKE', "%{$search}%");
			$query->orWhere('mobile', 'LIKE', "%{$search}%");
			$query->orWhere('office', 'LIKE', "%{$search}%");
			$query->orWhere('contact_department', 'LIKE', "%{$search}%");
			$query->orWhere('email', 'LIKE', "%{$search}%");
			$query->orWhere('location', 'LIKE', "%{$search}%");
			$query->orWhere('invoice_add1', 'LIKE', "%{$search}%");
			$query->orWhere('invoice_add2', 'LIKE', "%{$search}%");
			$query->orWhere('shipping1', 'LIKE', "%{$search}%");
			$query->orWhere('shipping2', 'LIKE', "%{$search}%");
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
			$query->Where('shipping2', 'LIKE', "%{$search_3}%");
			$query->Where('shipping1', 'LIKE', "%{$search_3}%");
			$query->Where('invoice_add2', 'LIKE', "%{$search_3}%");
			$query->Where('invoice_add1', 'LIKE', "%{$search_3}%");
			$query->Where('location', 'LIKE', "%{$search_3}%");
			$query->Where('email', 'LIKE', "%{$search_3}%");
			$query->Where('contact_department', 'LIKE', "%{$search_3}%");
			$query->Where('office', 'LIKE', "%{$search_3}%");
			$query->Where('mobile', 'LIKE', "%{$search_3}%");
			$query->Where('contact_person', 'LIKE', "%{$search_3}%");
			$query->Where('website', 'LIKE', "%{$search_3}%");
			$query->Where('fax', 'LIKE', "%{$search_3}%");
			$query->Where('mobile2', 'LIKE', "%{$search_3}%");
			$query->Where('mobile1', 'LIKE', "%{$search_3}%");
			$query->Where('office_phone2', 'LIKE', "%{$search_3}%");
			$query->Where('office_phone1', 'LIKE', "%{$search_3}%");
			$query->Where('email2', 'LIKE', "%{$search_3}%");
			$query->Where('email1', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_zip', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_city', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_region', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_country', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_add2', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_add1', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_name', 'LIKE', "%{$search_3}%");
			$query->Where('key_account', 'LIKE', "%{$search_3}%");
			$query->Where('salesman', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_category', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_type', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_code', 'LIKE', "%{$search_3}%");
		}
		$totalFiltered = $query->count();
		$query->skip($_POST['start'])->take($_POST['length']);
		$vendor = $query->get();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		$row = array();
		foreach ($vendor as $vendor_detail) {
			if (isset($vendor_detail->account_group)) {
				$status = '<span class="label label-lg font-weight-bold label-light-primary label-inline">Updated</span';
			} else {
				$status = '<span class="label label-lg label-light-danger label-inline">Not Updated</span>';
			}
			$no++;
			$row[0] = '<label class="checkbox checkbox-single">
										<input type="checkbox" value="" class="group-checkable">
										<span></span>
								</label>';
			$row[1] = $no;
			$row[2] = $vendor_detail->vendor_name;
			$row[3] = $vendor_detail->vendor_code;
			$row[4] = $vendor_detail->vendor_type;
			$row[5] = $vendor_detail->vendor_category;
			$row[6] = $vendor_detail->salesman;
			$row[7] = $vendor_detail->key_account;
			$row[8] = $status;
			$row[9] = '<span style="overflow: visible; position: relative; width: 80px;">
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
						<i class="fa fa-cog"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
						<ul class="kt-nav">
					   </a>
						  <a href="#?id=' . $vendor_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5">
						 <li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-contract"></i>
						<span class="kt-nav__link-text kt_edit_accounts" id=' . $vendor_detail->id . ' data-id=' . $vendor_detail->id . '>Update</span></span></li> </a>
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
	// public function vendorshow(Request $request)
	// {
	//     $totalFiltered = 0;
	//     $totalData = vendor::count();
	//     $vendor_group = VendorGroupModel::select('id', 'title')->get();
	//     $query = DB::table('qcrm_vendors')->leftJoin('qcrm_vendor_category_details', 'qcrm_vendors.vendor_category', '=', 'qcrm_vendor_category_details.id')
	//         ->leftJoin('qcrm_vendor_type_details', 'qcrm_vendors.vendor_type', '=', 'qcrm_vendor_type_details.id')
	//         ->leftJoin('qcrm_salesman_details', 'qcrm_vendors.salesman', '=', 'qcrm_salesman_details.id')
	//         ->leftJoin('qcrm_vendor_groups', 'qcrm_vendors.vendor_group', '=', 'qcrm_vendor_groups.id')
	//         ->select('qcrm_vendors.*', 'qcrm_vendor_category_details.vendor_category as vvendor_category', 'qcrm_vendor_type_details.vendor_type as vvendor_type,qcrm_salesman_details.name as salesman,qcrm_vendor_groups.title as grouptitle')
	//         ->orderby('id', 'desc');
	//     $query->where('qcrm_vendors.del_flag', 1);
	//     if (!empty($request->input('search.value')))
	//     {
	//         $search = $request->input('search.value');
	//         $query->Where('id', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_code', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_type', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_category', 'LIKE', "%{$search}%");
	//         $query->orWhere('salesman', 'LIKE', "%{$search}%");
	//         $query->orWhere('key_account', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_name', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_add1', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_add2', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_country', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_city', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_region', 'LIKE', "%{$search}%");
	//         $query->orWhere('vendor_zip', 'LIKE', "%{$search}%");
	//         $query->orWhere('email1', 'LIKE', "%{$search}%");
	//         $query->orWhere('email2', 'LIKE', "%{$search}%");
	//         $query->orWhere('office_phone1', 'LIKE', "%{$search}%");
	//         $query->orWhere('office_phone2', 'LIKE', "%{$search}%");
	//         $query->orWhere('mobile1', 'LIKE', "%{$search}%");
	//         $query->orWhere('mobile2', 'LIKE', "%{$search}%");
	//         $query->orWhere('fax', 'LIKE', "%{$search}%");
	//         $query->orWhere('website', 'LIKE', "%{$search}%");
	//         $query->orWhere('contact_person', 'LIKE', "%{$search}%");
	//         $query->orWhere('mobile', 'LIKE', "%{$search}%");
	//         $query->orWhere('office', 'LIKE', "%{$search}%");
	//         $query->orWhere('contact_department', 'LIKE', "%{$search}%");
	//         $query->orWhere('email', 'LIKE', "%{$search}%");
	//         $query->orWhere('location', 'LIKE', "%{$search}%");
	//         $query->orWhere('invoice_add1', 'LIKE', "%{$search}%");
	//         $query->orWhere('invoice_add2', 'LIKE', "%{$search}%");
	//         $query->orWhere('shipping1', 'LIKE', "%{$search}%");
	//         $query->orWhere('shipping2', 'LIKE', "%{$search}%");
	//         $query->orWhere('portal', 'LIKE', "%{$search}%");
	//         $query->orWhere('username', 'LIKE', "%{$search}%");
	//         $query->orWhere('registerd_email', 'LIKE', "%{$search}%");
	//         $query->orWhere('password', 'LIKE', "%{$search}%");
	//     }
	//     if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
	//     {
	//         $search_3 = $_POST['columns'][3]['search']['value'];
	//         $query->Where('password', 'LIKE', "%{$search_3}%");
	//         $query->Where('registerd_email', 'LIKE', "%{$search_3}%");
	//         $query->Where('username', 'LIKE', "%{$search_3}%");
	//         $query->Where('portal', 'LIKE', "%{$search_3}%");
	//         $query->Where('shipping2', 'LIKE', "%{$search_3}%");
	//         $query->Where('shipping1', 'LIKE', "%{$search_3}%");
	//         $query->Where('invoice_add2', 'LIKE', "%{$search_3}%");
	//         $query->Where('invoice_add1', 'LIKE', "%{$search_3}%");
	//         $query->Where('location', 'LIKE', "%{$search_3}%");
	//         $query->Where('email', 'LIKE', "%{$search_3}%");
	//         $query->Where('contact_department', 'LIKE', "%{$search_3}%");
	//         $query->Where('office', 'LIKE', "%{$search_3}%");
	//         $query->Where('mobile', 'LIKE', "%{$search_3}%");
	//         $query->Where('contact_person', 'LIKE', "%{$search_3}%");
	//         $query->Where('website', 'LIKE', "%{$search_3}%");
	//         $query->Where('fax', 'LIKE', "%{$search_3}%");
	//         $query->Where('mobile2', 'LIKE', "%{$search_3}%");
	//         $query->Where('mobile1', 'LIKE', "%{$search_3}%");
	//         $query->Where('office_phone2', 'LIKE', "%{$search_3}%");
	//         $query->Where('office_phone1', 'LIKE', "%{$search_3}%");
	//         $query->Where('email2', 'LIKE', "%{$search_3}%");
	//         $query->Where('email1', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_zip', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_city', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_region', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_country', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_add2', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_add1', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_name', 'LIKE', "%{$search_3}%");
	//         $query->Where('key_account', 'LIKE', "%{$search_3}%");
	//         $query->Where('salesman', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_category', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_type', 'LIKE', "%{$search_3}%");
	//         $query->Where('vendor_code', 'LIKE', "%{$search_3}%");
	//     }
	//     $totalFiltered = $query->count();
	//     $query->skip($_POST['start'])->take($_POST['length']);
	//     $vendor = $query->get();
	//     $data = array();
	//     $no = $_POST['start'];
	//     $i = 0;
	//     $row = array();
	//     foreach ($vendor as $vendor_detail)
	//     {
	//         $no++;
	//         $row[0] = '<label class="checkbox checkbox-single">
	//                                     <input type="checkbox" value="" class="group-checkable">
	//                                     <span></span>
	//                             </label>';
	//         $row[1] = $no;
	//         $row[2] = $vendor_detail->vendor_name;
	//         $row[3] = $vendor_detail->vendor_code;
	//         $row[4] = $vendor_detail->vendor_type;
	//         $row[5] = $vendor_detail->vendor_category;
	//         $row[6] = $vendor_detail->salesman;
	//         $row[7] = $vendor_detail->key_account;
	//         $row[8] = '<div class="dropdown dropdown-inline">
	//             <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">   <i class="fa fa-cog"></i>   </a>    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
	//                     <ul class="navi flex-column navi-hover py-2">   
	//                     <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">Choose an action:</li> 
	//                              <li class="navi-item"><a href="edit_vendor?id=' . $vendor_detail->id . '" class="navi-link"> <span class="navi-icon"><i class="la la-pencil"></i></span>    <span class="navi-text">Edit</span>                    </a></li>            
	//                              <li class="navi-item"> <a class="navi-link"> <span class="navi-icon"><i class="la la-trash"></i></span>
	//                              <span class="navi-text kt_del_vendorinformation" id=' . $vendor_detail->id . ' data-id=' . $vendor_detail->id . '>Delete</span></a></li></ul>
	//                              </div></div>';
	//         $data[$i] = $row;
	//         $i++;
	//     }
	//     $output = array(
	//         "draw" => $_POST['draw'],
	//         "recordsTotal" => $totalData,
	//         "recordsFiltered" => $totalFiltered,
	//         "data" => $data,
	//     );
	//     echo json_encode($output);
	// }
	public function vendortrashshow(Request $request)
	{
		$totalFiltered = 0;
		$totalData = vendor::count();
		$query = vendor::orderby('id', 'desc');
		$query->where('del_flag', 0);
		if (!empty($request->input('search.value'))) {
			$search = $request->input('search.value');
			$query->Where('id', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_code', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_type', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_category', 'LIKE', "%{$search}%");
			$query->orWhere('salesman', 'LIKE', "%{$search}%");
			$query->orWhere('key_account', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_name', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_add1', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_add2', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_country', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_city', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_region', 'LIKE', "%{$search}%");
			$query->orWhere('vendor_zip', 'LIKE', "%{$search}%");
			$query->orWhere('email1', 'LIKE', "%{$search}%");
			$query->orWhere('email2', 'LIKE', "%{$search}%");
			$query->orWhere('office_phone1', 'LIKE', "%{$search}%");
			$query->orWhere('office_phone2', 'LIKE', "%{$search}%");
			$query->orWhere('mobile1', 'LIKE', "%{$search}%");
			$query->orWhere('mobile2', 'LIKE', "%{$search}%");
			$query->orWhere('fax', 'LIKE', "%{$search}%");
			$query->orWhere('website', 'LIKE', "%{$search}%");
			$query->orWhere('contact_person', 'LIKE', "%{$search}%");
			$query->orWhere('mobile', 'LIKE', "%{$search}%");
			$query->orWhere('office', 'LIKE', "%{$search}%");
			$query->orWhere('contact_department', 'LIKE', "%{$search}%");
			$query->orWhere('email', 'LIKE', "%{$search}%");
			$query->orWhere('location', 'LIKE', "%{$search}%");
			$query->orWhere('invoice_add1', 'LIKE', "%{$search}%");
			$query->orWhere('invoice_add2', 'LIKE', "%{$search}%");
			$query->orWhere('shipping1', 'LIKE', "%{$search}%");
			$query->orWhere('shipping2', 'LIKE', "%{$search}%");
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
			$query->Where('shipping2', 'LIKE', "%{$search_3}%");
			$query->Where('shipping1', 'LIKE', "%{$search_3}%");
			$query->Where('invoice_add2', 'LIKE', "%{$search_3}%");
			$query->Where('invoice_add1', 'LIKE', "%{$search_3}%");
			$query->Where('location', 'LIKE', "%{$search_3}%");
			$query->Where('email', 'LIKE', "%{$search_3}%");
			$query->Where('contact_department', 'LIKE', "%{$search_3}%");
			$query->Where('office', 'LIKE', "%{$search_3}%");
			$query->Where('mobile', 'LIKE', "%{$search_3}%");
			$query->Where('contact_person', 'LIKE', "%{$search_3}%");
			$query->Where('website', 'LIKE', "%{$search_3}%");
			$query->Where('fax', 'LIKE', "%{$search_3}%");
			$query->Where('mobile2', 'LIKE', "%{$search_3}%");
			$query->Where('mobile1', 'LIKE', "%{$search_3}%");
			$query->Where('office_phone2', 'LIKE', "%{$search_3}%");
			$query->Where('office_phone1', 'LIKE', "%{$search_3}%");
			$query->Where('email2', 'LIKE', "%{$search_3}%");
			$query->Where('email1', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_zip', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_city', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_region', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_country', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_add2', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_add1', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_name', 'LIKE', "%{$search_3}%");
			$query->Where('key_account', 'LIKE', "%{$search_3}%");
			$query->Where('salesman', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_category', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_type', 'LIKE', "%{$search_3}%");
			$query->Where('vendor_code', 'LIKE', "%{$search_3}%");
			echo "test";
		}
		$totalFiltered = $query->count();
		$query->skip($_POST['start'])->take($_POST['length']);
		$vendor = $query->get();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		$row = array();
		foreach ($vendor as $vendor_detail) {
			$no++;
			$row[0] = '<label class="checkbox checkbox-single">
										<input type="checkbox" value="" class="group-checkable">
										<span></span>
								</label>';
			$row[1] = $no;
			$row[2] = $vendor_detail->vendor_name;
			$row[3] = $vendor_detail->vendor_code;
			$row[4] = $vendor_detail->vendor_type;
			$row[5] = $vendor_detail->vendor_category;
			$row[6] = $vendor_detail->salesman;
			$row[7] = $vendor_detail->key_account;
			$row[8] = '<div class="dropdown dropdown-inline">
				<a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">   <i class="fa fa-cog"></i>   </a>    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
						<ul class="navi flex-column navi-hover py-2">   
						<li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">Choose an action:</li> 
								 <li class="kt-nav__item">
						<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-trash"></i>
						<span class="kt-nav__link-text Vendrdetail_restore" id=' . $vendor_detail->id . ' data-id=' . $vendor_detail->id . '>Restore</span></span></li>     </ul>   </div></div>';
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
	public function submit_vendor(Request $request)
	{

		$branch = $request->branch;
		$request->validate(['vendor_code' => 'required'], ['vendor_code.required' => 'Code is required']);
		$user = auth()->user();
		$postID = $request->vendor_id;
		$check = $this->check_exists1($request->mobile1, $request->email1);
		if ($check < 1) {
			$data = ['vendor_code' => $request->vendor_code, 'vendor_type' => $request->vendor_type, 'vendor_category' => $request->vendor_category, 'salesman' => $request->salesman, 'vendor_group' => $request->vendor_group, 'key_account' => $request->key_account, 'vendor_note' => $request->vendor_note, 'vendor_name' => $request->vendor_name, 'contact_person' => $request->contact_person, 'vendor_add1' => $request->vendor_add1, 'vendor_add2' => $request->vendor_add2, 'vendor_country' => $request->vendor_country, 'vendor_region' => $request->vendor_region, 'vendor_city' => $request->vendor_city, 'vendor_zip' => $request->vendor_zip, 'email1' => $request->email1, 'vendor_name_alias' => $request->vendor_name_alias, 'email2' => $request->email2, 'office_phone1' => $request->office_phone1, 'office_phone2' => $request->office_phone2, 'mobile1' => $request->mobile1, 'mobile2' => $request->mobile2, 'fax' => $request->fax, 'website' => $request->website, 'contact_persons' => $request->contact_persons, 'mobile' => $request->mobile, 'office' => $request->office, 'contact_department' => $request->contact_department, 'email' => $request->email, 'location' => $request->location, 'username' => $request->username, 'password' => encrypt($request->password), 'branch' => $branch, 'vendor_name_alias_ar' => $request->vendor_name_alias_ar, 'vendor_name_ar' => $request->vendor_name_ar, 'vendor_add1_ar' => $request->vendor_add1_ar, 'vendor_add2_ar' => $request->vendor_add2_ar, 'vendor_country_ar' => $request->vendor_country_ar, 'vendor_region_ar' => $request->vendor_region_ar, 'vendor_city_ar' => $request->vendor_city_ar, 'vendor_zip_ar' => $request->vendor_zip_ar, 'province_state' => $request->province_state, 'province_state_ar' => $request->province_state_ar, 'additionalno' => $request->additionalno, 'ar_additionalno' => $request->ar_additionalno, 'vatno' => $request->vatno, 'ar_vatno' => $request->ar_vatno, 'buyerid_crno' => $request->buyerid_crno, 'ar_buyerid_crno' => $request->ar_buyerid_crno];
			$vendors = vendor::updateOrCreate(['id' => $postID], $data);
			if ($request->vendor_id) {
				$msg = 'updated';
			} else {
				$msg = 'created';
			}
			Session::flash('success', 'Vendor Details ' . $msg . ' successfully.');

			VendorSkill::where('info_id', $vendors->id)
				->delete();
			if (!empty($request->contact_person_incharges)) {
				foreach ($request->contact_person_incharges as $key => $value) {
					VendorSkill::create(['info_id' => $vendors->id, 'contact_person_incharges' => $request->contact_person_incharges[$key], 'mobiles' => $request->mobiles[$key], 'offices' => $request->offices[$key], 'emails' => $request->emails[$key], 'departments' => $request->departments[$key], 'locations' => $request->locations[$key],]);
				}
			}
			if (isset($postID)) {
			} else {
				$data = DB::table('qcrm_vendor_category_details')->select('id', 'increment')->where('id', $request->vendor_category)->get();

				foreach ($data as $key => $value) {
					$increment = $value->increment + 1;
				}

				VendorCategoryModel::where('id', $request->vendor_category)->update(['increment' => $increment]);
			}
			return 'true';
		} else {
			return 'false';
		}
	}
	public function edit_vendor(Request $request)
	{
		$branch = Session::get('branch');

		$skill = [];
		$id = $request->id;
		$categry = VendorCategoryModel::select('id', 'vendor_category')->where('branch', $branch)->get();
		$type = VendorTypeModel::select('id', 'vendor_type')->where('branch', $branch)->get();
		$category = VendorCategoryModel::select('id', 'vendor_category', 'customcode', 'startfrom')->where('branch', $branch)->get();
		$salesman = SalesmanDetailModel::select('id', 'name', 'account_ledger')->where('branch', $branch)->get();
		$vendor_group = VendorGroupModel::select('id', 'title')->where('branch', $branch)->get();
		$vendor = vendor::where('id', $id)->limit(1)
			->first();
		// dd($vendor);
		$skill = VendorSkill::where('info_id', $id)->get();
		// dd($skill);
		$country = countryModel::select('id', 'cntry_name')->get();
		$groups = DB::table('a_branch1_a_groups')->get()
			->toArray();

		return view('crm.vendors.vendor_edit', ['data' => $vendor, 'datas' => $skill], compact('categry', 'type', 'salesman', 'vendor_group', 'country', 'branch', 'groups'));
	}
	public function delete_vendor(Request $request)
	{
		$postID = $request->id;
		vendor::where('id', $postID)->update(['del_flag' => 0]);
		return 'true';
	}
	public function vendorTrashRestore(Request $request)
	{
		$postID = $request->id;
		vendor::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}
	public function getcategorycode(Request $request)
	{
		$id = $request->id;

		$data = DB::table('qcrm_vendor_category_details')->select('id', 'vendor_category', 'increment')->where('id', $id)->get();



		return response()->json($data);
	}

	public function view_vendor(Request $request)
	{
		$id = $_REQUEST['id'];
		$users = DB::table('qcrm_vendors')->leftJoin('qcrm_vendor_category_details', 'qcrm_vendors.vendor_category', '=', 'qcrm_vendor_category_details.id')
			->leftJoin('qcrm_vendor_groups', 'qcrm_vendors.vendor_group', '=', 'qcrm_vendor_groups.id')->leftJoin('qcrm_vendor_type_details', 'qcrm_vendors.vendor_type', '=', 'qcrm_vendor_type_details.id')->leftJoin('qcrm_salesman_details', 'qcrm_vendors.salesman', '=', 'qcrm_salesman_details.id')->leftJoin('a_branch1_a_groups', 'qcrm_vendors.key_account', '=', 'a_branch1_a_groups.id')->leftJoin('countries', 'qcrm_vendors.vendor_country', '=', 'countries.id')->leftJoin('countries as invoicecountry', 'qcrm_vendors.invoice_country', '=', 'invoicecountry.id')->leftJoin('countries as shippingcountry', 'qcrm_vendors.shipping_country', '=', 'shippingcountry.id')
			->select('qcrm_vendors.*', 'qcrm_vendor_category_details.vendor_category as vendorcategory', 'qcrm_vendor_groups.title as grouptitle', 'qcrm_vendor_type_details.vendor_type as vendortype', 'qcrm_salesman_details.name as salesmanname', 'a_branch1_a_groups.name as account_ledger', 'countries.cntry_name as country', 'invoicecountry.cntry_name as invoice_country', 'shippingcountry.cntry_name as shipping_country')->where('qcrm_vendors.id', $id)->get();

		$vendorcontact = VendorSkill::where('info_id', $id)->get();

		return view('crm.vendors.vendor_view', compact('users', 'vendorcontact'));
	}
	public function check_exists1($value1, $value2)
	{
		$branch = Session::get('branch');

		$query = DB::table('qcrm_vendors')->select('*')->where('email1', $value1)->where('mobile1', $value2)->where('del_flag', 1)->where('branch', $branch)->get();
		// $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		return $query->count();
	}

	public function getcustomerusername(Request $request)
	{
		$branch = Session::get('branch');
		$username = $request->id;
		$query = DB::table('qcrm_vendors')->select('*')->where('username', $username)->where('del_flag', 1)->where('branch', $branch)->get();
		$check = $query->count();
		return $check;
	}
}

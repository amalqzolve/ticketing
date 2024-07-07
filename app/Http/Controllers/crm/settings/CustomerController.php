<?php

namespace App\Http\Controllers\crm\settings;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\settings\CustomerGroup;
use App\settings\CustomerCategoryModel;
use App\settings\CustomerTypeModel;
use Session;
use DataTables;

class CustomerController extends Controller
{
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

		return view('crm.settings.customer_grop.groupindex', compact('branch'));
	}
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
		return view('crm.settings.customer_grop.group_trash');
	}
	public function groupsubmit(Request $request)
	{
		$check = "";
		$branch = $request->branch;
		$postID = $request->info_id;

		if (isset($postID) && !empty($postID)) {
			$check = $this->check_exists_edit($postID, $request->title, 'title', 'qcrm_customer_groupdetails');
		} else {
			$check = $this->check_exists($request->title, 'title', 'qcrm_customer_groupdetails');
		}


		if ($check < 1) {
			if ($request->default_grp == 1) {
				$value = 1;
				DB::table('qcrm_customer_groupdetails')->where('branch', $branch)->update(array('default_grp' => 0));
			} else {
				$value = 0;
			}

			$data = [
				'title' => $request->title,
				'description' => $request->description,
				'color' => $request->color,
				'branch' => $branch,
				'default_grp' => $value
			];
			$userInfo = CustomerGroup::updateOrCreate(['id' => $postID], $data);

			return 'true';
		} else {
			return 'false';
		}
	}
	// public function gettermsquote(Request $request)
	//    {
	//        $id = $request->id;

	//         $data = DB::table('qcrm_termsandconditions')->select('qcrm_termsandconditions.*')->where('qcrm_termsandconditions.id',$id)->get();


	//        return response()->json($data);
	//    }
	public function groupupdate(Request $request)
	{
		$data = CustomerGroup::where('id', $request->info_id)->get();
		return response()->json($data);
		// echo json_encode($data);
	}
	public function groupdelete(Request $request)
	{
		$delete = $request->id;
		$del = DB::table('qcrm_customer_details')->select('cust_group')->where('cust_group', $delete)->where('del_flag', 1)->get();
		$group = $del->count();
		if ($group > 0) {
			return '1';
		} else {
			CustomerGroup::where('id', $delete)->update(['del_flag' => 0]);
			return '2';
		}
	}
	public function grouptrashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerGroup::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}

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
		return view('crm.settings.category.customer_category_details', compact('branch'));
	}

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
		return view('crm.settings.category.trashcategory');
	}

	public function Categorys_submit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->info_id;
		// $check = $this->check_exists($request->customer_category,'customer_category','qcrm_customer_categorydetails');
		if (isset($postID) && !empty($postID)) {
			$check = $this->check_exists_edit($postID, $request->customer_category, 'customer_category', 'qcrm_customer_categorydetails');
		} else {
			$check = $this->check_exists($request->customer_category, 'customer_category', 'qcrm_customer_categorydetails');
		}

		if ($check < 1) {
			if ($request->catdefault == 1) {
				$value = 1;
				DB::table('qcrm_customer_categorydetails')->where('branch', $branch)->update(array('catdefault' => 0));
			} else {
				$value = 0;
			}
			$data = ['cust_start' => $request->cust_code . '/' . number_format($request->start_from + 1), 'customer_category' => $request->customer_category, 'description' => $request->description, 'color' => $request->color, 'cust_code' => $request->cust_code, 'start_from' => $request->start_from, 'increment' => $request->start_from, 'branch' => $branch, 'catdefault' => $value];
			$userInfo = CustomerCategoryModel::updateOrCreate(['id' => $postID], $data);

			return 'true';
		} else {
			return 'false';
		}
	}

	public function categoryedit(Request $request)
	{
		$data = CustomerCategoryModel::where('id', $request->info_id)->get();
		return response()->json($data);
	}

	public function deletecategory(Request $request)
	{

		$id = $request->id;
		$query = DB::table('qcrm_customer_details')->select('cust_category')->where('cust_category', $id)->where('del_flag', 1)->get();
		$no = $query->count();
		if ($no > 0) {
			return '1';
		} else {
			CustomerCategoryModel::where('id', $id)->update(['del_flag' => 0]);
			return '2';
		}
	}

	public function trashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerCategoryModel::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}


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
		return view('crm.settings.type.customer_type_details', compact('branch'));
	}

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
		return view('crm.settings.type.typetrash');
	}

	public function typeSubmit(Request $request)
	{
		$branch = $request->branch;
		$postID = $request->info_id;
		// $check = $this->check_exists($request->title,'title','qcrm_customer_typedetails');
		if (isset($postID) && !empty($postID)) {
			$check = $this->check_exists_edit($postID, $request->title, 'title', 'qcrm_customer_typedetails');
		} else {
			$check = $this->check_exists($request->title, 'title', 'qcrm_customer_typedetails');
		}
		if ($check < 1) {
			if ($request->typedefault == 1) {
				$value = 1;
				DB::table('qcrm_customer_typedetails')->where('branch', $branch)->update(array('typedefault' => 0));
			} else {
				$value = 0;
			}

			$data = [
				'title' => $request->title, 'discription' => $request->description, 'color' => $request->color, 'branch' => $branch, 'typedefault' => $value
			];

			$userInfo = CustomerTypeModel::updateOrCreate(['id' => $postID], $data);
			return 'true';
		} else {
			return 'false';
		}
	}

	public function type_updatess(Request $request)
	{
		$data = CustomerTypeModel::where('id', $request->info_id)->get();
		return response()->json($data);
	}

	public function deletetypeds(Request $request)
	{
		$postID = $request->id;
		$del = DB::table('qcrm_customer_details')->select('cust_type')->where('cust_type', $postID)->where('del_flag', 1)->get();
		$type = $del->count();
		if ($type > 0) {
			return '1';
		} else {
			CustomerTypeModel::where('id', $postID)->update(['del_flag' => 0]);
			return '0';
		}
	}

	public function typetrashrestore(Request $request)
	{
		$postID = $request->id;
		CustomerTypeModel::where('id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}


	public function check_exists($value, $field, $table)
	{
		$branch = Session::get('branch');

		$query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();

		return $query->count();
	}
	public function check_exists_edit($id, $value, $field, $table)
	{
		$query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->whereNotIn('id', [$id])->get();

		return $query->count();
	}
}

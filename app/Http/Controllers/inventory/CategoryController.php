<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use DB;
use App\inventory\productcategory;
use Session;
use DataTables;
use Spatie\Activitylog\Models\Activity;
class CategoryController extends Controller
{
   /**
	 * Display a listing of Various Accounts.
	 */

	public function categorytListing(Request $request)
	{   
		   $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
		if ($request->ajax()) {
			if($common_customer_database == 1)
			{
				$query = productcategory::orderby('id', 'desc');
			$query->where('del_flag', 1);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = productcategory::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
			}
			else
			{
				$query = productcategory::orderby('id', 'desc');
			$query->where('del_flag', 1)->where('branch',$branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = productcategory::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
			}
			
		}
		 return view('inventory.category.listing');
	}

	/**
	 * Add New product category managements Form.
	 */
	public function addcategory()
	{
		   $branch=Session::get('branch');

		 return view('inventory.category.addcategory',compact('branch'));
	}
	/**
	 * product category trash function.
	 */
	public function trashform(Request $request)
	{
		   $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
		if ($request->ajax()) {
			if($common_customer_database == 1)
			{
				$query = productcategory::orderby('id', 'desc');
			$query->where('del_flag', 0);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = productcategory::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
			}
			else
			{
				$query = productcategory::orderby('id', 'desc');
			$query->where('del_flag', 0)->where('branch',$branch);
			$data = $query->get();
			$count_filter = $query->count();
			$count_total = productcategory::count();
			return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action'])->make(true);
			}
			
		}
		 return view('inventory.category.trash');
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function submitcategory(Request $request)
	{
		$branch = $request->branch;
		$id         = $request->id;

		  if(isset($id)&&!empty($id)){
                 $check = $this->check_exists_edit($id,$request->categoryname,'category_name','qinvoice_category');
            }else{
                $check = $this->check_exists($request->categoryname,'category_name','qinvoice_category'); 
            }

            
		if($check<1)
		{
		$data       = ['category_name'    => $request->categoryname, 
					   'category_code'    => $request->categorycode, 
					   'starting_number'  => $request->startingnumber,
					   'increment'        => $request->startingnumber,
					   'description'      => $request->description,
					   'branch'           => $branch
					  ];

		$unitid = productcategory::updateOrCreate(['id' => $id], $data);
	   return 1;
	}
	else
	{
	return 0;
	}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function editcategory(Request $request)
	{
		   $branch=Session::get('branch');

		$id = $request->id;
		$pro_unit = productcategory::where('id', $id)
								->limit(1)
								->first();
		return view('inventory.category.edit', ['datas' => $pro_unit],compact('branch'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deletecategory(Request $request)
	{
		$id=$request->id;
		productcategory::where('id',$id)->update(['del_flag'=>0]);
		return 'true';
	}
/**
  *category restore function
  */    
	public function ProductCategoryRestoreTrash(Request $request)
	{
		$id=$request->id;
		productcategory::where('id',$id)->update(['del_flag'=>1]);
		return 'true';
	}
/**
  *category delete trash function
  */    
	public function trashdeletecategory(Request $request)
	{
		$id=$request->id;
		productcategory::where('id',$id)->delete();
		return 'true';
	}  
	public function check_exists($value,$field,$table)
	 {
		$query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
		 // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
		 return $query->count();
	 } 

 public function check_exists_edit($id,$value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->whereNotIn('id',[$id])->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}

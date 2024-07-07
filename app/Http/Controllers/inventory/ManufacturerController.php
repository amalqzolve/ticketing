<?php
namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use DB;
use App\inventory\ManufactureModel;
use App\inventory\vendor;
use Session;
use DataTables;
use Spatie\Activitylog\Models\Activity;

class ManufacturerController extends Controller
{
					/**
					* Display a listing of Various Manufacturers.
					*/
				public function ManufacturerListing(Request $request)
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
										$query  = DB::table('qinventory_manufacture')->leftJoin('qcrm_vendors', 'qinventory_manufacture.vendor', '=', 'qcrm_vendors.id')
																->select('qinventory_manufacture.id as id','qinventory_manufacture.manufacture_name as manufact_name','qinventory_manufacture.manufacture_code as manufacture_code','qinventory_manufacture.logo as logo','qcrm_vendors.vendor_name as vendor')
																->orderby('qinventory_manufacture.id', 'desc');
																$query->where('qinventory_manufacture.del_flag', 1);
												$data = $query->get();
												$count_filter = $query->count();
												$count_total = ManufactureModel::count();
												return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
																return $row->id;
												})->rawColumns(['action'])->make(true);
									}
									else
									{
										$query  = DB::table('qinventory_manufacture')->leftJoin('qcrm_vendors', 'qinventory_manufacture.vendor', '=', 'qcrm_vendors.id')
																->select('qinventory_manufacture.id as id','qinventory_manufacture.manufacture_name as manufact_name','qinventory_manufacture.manufacture_code as manufacture_code','qinventory_manufacture.logo as logo','qcrm_vendors.vendor_name as vendor')
																->orderby('qinventory_manufacture.id', 'desc');
																$query->where('qinventory_manufacture.del_flag', 1)->where('qinventory_manufacture.branch',$branch);
												$data = $query->get();
												$count_filter = $query->count();
												$count_total = ManufactureModel::count();
												return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
																return $row->id;
												})->rawColumns(['action'])->make(true);
									}
												
								}
									return view('inventory.manufacturer.listing');
				}
				/**
					* Add New Manufacturer Form.
					*/

				public function NewManufacturer()
				{
											$branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
    if($common_customer_database == 1)
    {
    	$vendor=vendor::select('id','vendor_name')->get();
    }
    else
    {
    	$vendor=vendor::select('id','vendor_name')->where('branch',$branch)->get();
    }
									
									return view('inventory.manufacturer.add',compact('vendor','branch'));
				}
					/**
					* trash Manufacturer Form.
					*/

				public function manufacturetrash(Request $request)
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
										$query  = ManufactureModel::orderby('id', 'desc');
												$query->where('del_flag', 0);
												$data = $query->get();
												$count_filter = $query->count();
												$count_total = ManufactureModel::count();
												return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
																return $row->id;
												})->rawColumns(['action'])->make(true);
									}
									else
									{
										$query  = ManufactureModel::orderby('id', 'desc');
												$query->where('del_flag', 0)->where('branch',$branch);
												$data = $query->get();
												$count_filter = $query->count();
												$count_total = ManufactureModel::count();
												return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
																return $row->id;
												})->rawColumns(['action'])->make(true);
									}
												
								}
									return view('inventory.manufacturer.trash');
				}

				
/**
					* Show the form for creating a new resource.
					*
					* @return \Illuminate\Http\Response
					*/
				public function editmanufacturer(Request $request)
				{
								$id=$request->id;
								$vendors=vendor::select('id','vendor_name')
												->get();
								$data = ManufactureModel::where('id',$id)->limit(1)->first();
								// print_r($data);
								return view('inventory.manufacturer.edit',['data'=>$data],compact('vendors'));

				}

				/**
					* Store a newly created resource in storage.
					*
					* @param  \Illuminate\Http\Request  $request
					* @return \Illuminate\Http\Response
					*/
				public function stores(Request $request)
				{
								// dd($request);
									$branch = $request->branch;
									
									$id                 = $request->id;
						
									    if(isset($id)&&!empty($id)){
                 $check = $this->check_exists_edit($id,$request->manufacture_name,'manufacture_name','qinventory_manufacture');
            }else{
               			$check = $this->check_exists($request->manufacture_name,'manufacture_name','qinventory_manufacture'); 
            }
        
        
        
								if($check<1)
								{
								$data               = [
																															'manufacture_name' =>$request->manufacture_name,
																															'manufacture_code' =>$request->manufacture_code,
																															'logo'             =>$request->fileData,
																															'vendor'           =>$request->vendor,
																															'description'      =>$request->description,
																															'branch'           =>$branch
																														];
								$brand          = ManufactureModel::updateOrCreate(['id'=>$id],$data);                      
								return 1;
								}
								else
								{
												return 0;
								}
				}

				
				/**
					* Remove the specified resource from storage.
					*
					* @param  int  $id
					* @return \Illuminate\Http\Response
					*/
				
				public function destroy(Request $request)
				{
								$id = $request->id;
								ManufactureModel::where('id',$id)->update(['del_flag' =>0]);
								return 'true';
				}
	/**
	*manufacture details for  restore
	*/   
				public function restoremanufacture(Request $request)
				{
								$id = $request->id;
								ManufactureModel::where('id',$id)->update(['del_flag' =>1]);
								return 'true';
				}
/**
	*manufacture details for delete recover restore
	*/     
				public function DeleteTrashProdctmanufacture(Request $request)
				{
								$postID = $request->id;
								ManufactureModel::where('id', $postID)->delete();
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


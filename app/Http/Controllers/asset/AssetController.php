<?php

namespace App\Http\Controllers\asset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use PDF;

use File;
use Response;
use App\settings\BranchSettingsModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AssetmainImport;
use App\asset\PartsModel;
use App\asset\ComponentModel;


class AssetController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function asset_list()
	{


		$assets = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->select('assets.*', 'assets_groups.name as asset_gname', 'assets_category.name as asset_cname', 'assets_type.name as asset_tname')->get();
		return view('asset.asset.list', compact('assets'));
	}


	public function asset_add()
	{

		$warehouse = DB::table('assets_warehouse')->select('id', 'warehouse_name')->where('del_flag', 1)->get();
		$store = DB::table('assets_store_management')->select('id', 'store_name')->where('del_flag', 1)->get();
		$rack = DB::table('assets_rack_management')->select('id', 'rack_name')->where('del_flag', 1)->get();
		$group = DB::table('assets_groups')->select('id', 'name')->where('del_flag', 1)->get();
		$category = DB::table('assets_category')->select('id', 'name')->where('del_flag', 1)->get();
		$type = DB::table('assets_type')->select('id', 'name')->where('del_flag', 1)->get();
		$brand = DB::table('qinventory_brand')->select('id', 'brand_name')->where('del_flag', 1)->get();
		$manufacturer = DB::table('qinventory_manufacture')->select('id', 'manufacture_name')->where('del_flag', 1)->get();
		$unit = DB::table('assets_unit')->select('id', 'unit_name')->where('del_flag', 1)->get();
		$supplier = DB::table('qcrm_supplier')->select('id', 'sup_name')->where('del_flag', 1)->get();

		$parts = DB::table('assets_parts')->select('id', 'part_name')->where('asset_id', NULL)->get();

		$components          = DB::table('assets_components')->select('id', 'component_name')->where('asset_id', NULL)->get();
		$services          = DB::table('assets_service')->select('id', 'service_name')->where('asset_id', NULL)->get();
		return view('asset.asset.add', compact('parts', 'components', 'services', 'warehouse', 'store', 'rack', 'group', 'category', 'type', 'brand', 'manufacturer', 'unit', 'supplier'));

		//

	}

	public function asset_submit(Request $request)
	{

		for ($j = 0; $j < count($request->option); $j++) {

			$data = [
				'asset_name' => $request->option[$j],
				'asset_type' => $request->asset_type,
				'consumable' => $request->consumable,
				'inv_type' => $request->inv_type,
				'asset_code' => $request->variantproductcode[$j],
				'barcode' => $request->variantbarcode[$j],
				'tag' => $request->varianttag[$j],
				'image' => $request->fileData,
				'asgroup' => $request->group,
				'category' => $request->category,
				'warehouse' => $request->warehouse,
				'type' => $request->type,
				'store' => $request->store,
				'rack' => $request->rack,
				'unit' => $request->unit,
				'manufaturer' => $request->manufaturer,
				'supplier' => $request->supplier,
				'brand' => $request->brand,
				'quantity' => $request->quantity,
				'available_quantity' => $request->quantity,
				'barcodeformat' => $request->barcodeformat,
				'slno' => $request->slno,
				'modelno' => $request->modelno,
				'partno' => $request->partno,
				'hsncode' => $request->hsncode,
				'upc' => $request->upc,
				'ean' => $request->ean,
				'jan' => $request->jan,
				'isbn' => $request->isbn,
				'mpn' => $request->mpn,
				'asset_status' => 'Active',
				'asset_cost' => $request->asset_cost,
				'purchase_date' => $request->purchase_date,
				'inbound_date' => $request->inbound_date,

			];

			$asset_object = DB::table('assets')->insert($data);
			$asset_id = DB::getPdo()->lastInsertId();

			//parts

			if (isset($request->part_name) && !empty($request->part_name)) {
				for ($i = 0; $i < count($request->part_name); $i++) {

					///
					$query = DB::table('assets_parts')->select('part_name', 'id')->where('part_name', $request->part_name[$i])->get();

					if ($query->count() > 0) {
						foreach ($query as $key => $value) {
							$part_id = $value->id;
						}
					} else {

						$partdata = [
							'part_name' => $request->part_name[$i],
						];

						$part_object = DB::table('assets_parts')->insert($partdata);
						$part_id = DB::getPdo()->lastInsertId();
					}
					////
					$partdata = [
						'asset_id' => $asset_id,
						'part_name' => $part_id,
						'part_date' => Carbon::parse($request->part_date[$i])->format('Y-m-d'),
						'reminderdays' => $request->reminderdaysparts[$i],

					];

					DB::table('assets_parts')->insert($partdata);
				}
			}


			//parts





			//components

			if (isset($request->component_name) && !empty($request->component_name)) {
				for ($i = 0; $i < count($request->component_name); $i++) {

					///
					$query = DB::table('assets_components')->select('component_name', 'id')->where('component_name', $request->component_name[$i])->get();

					if ($query->count() > 0) {
						foreach ($query as $key => $value) {
							$component_id = $value->id;
						}
					} else {

						$componentdata = [
							'component_name' => $request->component_name[$i],
						];

						$part_object = DB::table('assets_components')->insert($componentdata);
						$component_id = DB::getPdo()->lastInsertId();
					}
					////
					$componentdata = [
						'asset_id' => $asset_id,
						'component_name' => $component_id,
						'component_date' => Carbon::parse($request->component_date[$i])->format('Y-m-d'),
						'reminderdays' => $request->reminderdayscomponenet[$i],

					];

					DB::table('assets_components')->insert($componentdata);
				}
			}


			//components






			//service

			if (isset($request->service_name) && !empty($request->service_name)) {
				for ($i = 0; $i < count($request->service_name); $i++) {

					///
					$query = DB::table('assets_service')->select('service_name', 'id')->where('service_name', $request->service_name[$i])->get();

					if ($query->count() > 0) {
						foreach ($query as $key => $value) {
							$component_id = $value->id;
						}
					} else {

						$servicedata = [
							'service_name' => $request->service_name[$i],
						];

						$part_object = DB::table('assets_service')->insert($servicedata);
						$component_id = DB::getPdo()->lastInsertId();
					}
					////
					$servicedata = [
						'asset_id' => $asset_id,
						'service_name' => $component_id,
						'service_date' => Carbon::parse($request->service_date[$i])->format('Y-m-d'),
						'reminderdays' => $request->reminderdaysservice[$i],

					];

					DB::table('assets_service')->insert($servicedata);
				}
			}


			//service
		}
		return 'true';
	}


	public function asset_download()
	{
		$filepath = public_path('asset.xlsx');
		ob_end_clean();
		ob_start();
		return response()->download($filepath, 'Asset.xlsx', [
			'Content-Type' => 'application/vnd.ms-excel',
			'Content-Disposition' => 'inline; filename="Asset.xlsx"'
		]);
	}

	public function exportdata()
	{
		return view('asset.asset.export');
	}

	public function submit_file(Request $request)
	{
		Excel::import(new AssetmainImport, $request->file('file')->store('temp'));
		return redirect()->route('asset_list')->with('message', 'State saved correctly!!!');


		/* Excel::import(new BoqmainImport($data), $request->file('file'));
         dd(1);*/
	}




	public function asset_allocation_borrower(Request $request)
	{
		$id = $request->id;
		$allocations = DB::table('assets_allocation')->leftjoin('qzolvehrm_employee', 'assets_allocation.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->leftjoin('qcrm_salesman_details', 'assets_allocation.allocatedby', '=', 'qcrm_salesman_details.id')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->select('assets_allocation.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.id as aid', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname', 'qcrm_salesman_details.name as sname', 'assets_geolocation.location as location')->where('assets_allocation.borrower', $id)->get();


		$allocations_borrower = DB::table('assets_allocation')->leftjoin('qzolvehrm_employee', 'assets_allocation.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->leftjoin('qcrm_salesman_details', 'assets_allocation.allocatedby', '=', 'qcrm_salesman_details.id')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->select('assets_allocation.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.id as aid', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname', 'qcrm_salesman_details.name as sname', 'assets_geolocation.location as location', DB::raw('count(*) as total'))->groupBy('assets_allocation.borrower')->get();

		//dd($allocations);

		return view('asset.asset.allocation_list_borrower', compact('allocations', 'allocations_borrower'));
	}


	public function allocation_list()
	{
		$allocations = DB::table('assets_allocation')->leftjoin('qzolvehrm_employee', 'assets_allocation.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->leftjoin('qcrm_salesman_details', 'assets_allocation.allocatedby', '=', 'qcrm_salesman_details.id')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->select('assets_allocation.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.id as aid', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname', 'qcrm_salesman_details.name as sname', 'assets_geolocation.location as location')->get();


		$allocations_borrower = DB::table('assets_allocation')->leftjoin('qzolvehrm_employee', 'assets_allocation.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->leftjoin('qcrm_salesman_details', 'assets_allocation.allocatedby', '=', 'qcrm_salesman_details.id')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->select('assets_allocation.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.id as aid', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname', 'qcrm_salesman_details.name as sname', 'assets_geolocation.location as location', DB::raw('count(*) as total'))->groupBy('assets_allocation.borrower')->get();

		//dd($allocations);

		$allocations_materials = DB::table('assets_allocation')->leftjoin('qzolvehrm_employee', 'assets_allocation.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->leftjoin('qcrm_salesman_details', 'assets_allocation.allocatedby', '=', 'qcrm_salesman_details.id')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->select('assets_allocation.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.id as aid', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname', 'qcrm_salesman_details.name as sname', 'assets_geolocation.location as location')->groupBy('assets.id')->get();


		return view('asset.asset.allocation_list', compact('allocations', 'allocations_borrower', 'allocations_materials'));
	}

	public function asset_allocation_add()
	{

		$assets = DB::table('assets')->select('*')->where('available_quantity', '>', 0)->where('asset_status', 'Active')->get();


		$employees = DB::table('qzolvehrm_employee')->select('*')->get();
		$salesman   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->get();

		$projects          = DB::table('assets_projects')->select('id', 'project_name')->get();
		$area = DB::table('assets_area')->select('*')->get();
		$geolocation = DB::table('assets_geolocation')->select('*')->get();

		return view('asset.asset.allocation_add', compact('employees', 'projects', 'assets', 'area', 'geolocation', 'salesman'));
	}


	public function asset_allocation_submit(Request $request)
	{
		if ($request->borrowertype == 1) {
			$data = [

				'f_name' => $request->borrowername,
			];

			$borrower = DB::table('qzolvehrm_employee')->insert($data);
			$borrower_id = DB::getPdo()->lastInsertId();
		}
		// dd($borrower_id);
		if ($request->borrowertype == 2) {

			$borrower_id = $request->borrower;
		}

		$data = [

			// 'asset_id' =>$request->asset_id,
			'allocation_date' => Carbon::parse($request->allocation_date)->format('Y-m-d'),
			'return_date' => Carbon::parse($request->return_date)->format('Y-m-d'),
			'borrowertype' => $request->borrowertype,
			'borrower' => $borrower_id,
			'reason' => $request->reason,
			'project' => $request->project,
			'geo_location' => $request->geo_location,
			'available_quantity' => 1,
			'allocation_quantity' => 1,
			'area' => $request->area,
			'notes' => $request->notes,
			'allocatedby' => $request->allocatedby
		];


		$allocation_object = DB::table('assets_allocation')->insert($data);
		$allocationid = DB::getPdo()->lastInsertId();

		for ($k = 0; $k < count($request->asset_id); $k++) {
			// dd($request->asset_id[$k]);

			$data1 = [

				// 'asset_id' =>$request->asset_id,
				'allocation_id' => $allocationid,
				'assetname' => (int)$request->asset_id[$k]
			];


			$allocation_assets = DB::table('assets_allocation_assetname')->insert($data1);
			$data2 = [

				// 'asset_id' =>$request->asset_id,
				'asset_status' => "Allocated",

			];
			DB::table('assets')->where('id', $request->asset_id[$k])->update($data2);


			$data1 = [

				'available_quantity' => 0,
			];
			DB::table('assets')->where('id', $request->asset_id[$k])->update($data1);


			$data = [

				'asset_id' => $request->asset_id[$k],
				'ddate' => Carbon::parse($request->allocation_date)->format('Y-m-d'),
				'borrower' => $borrower_id,
				'type' => 'Allocation',
				'quantity' => 1
			];

			$assets_history_object = DB::table('assets_history')->insert($data);
		}



		return 'true';
	}

	public function revoke_list()
	{
		$revokes = DB::table('assets_revoke')->leftjoin('assets', 'assets_revoke.asset_id', '=', 'assets.id')->leftjoin('qzolvehrm_employee', 'assets_revoke.borrower', '=', 'qzolvehrm_employee.id')->select('assets_revoke.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'qzolvehrm_employee.f_name')->get();
		return view('asset.asset.revoke_list', compact('revokes'));
	}

	public function asset_revoke_add(Request $request)
	{

		$assets = DB::table('assets')->select('*')->get();
		$assets_allocated = DB::table('assets_allocation_assetname')->select('*')->where('assets_allocation_assetname.allocation_id', $request->id)->whereNull('assets_allocation_assetname.status')->get();
		$employees = DB::table('qzolvehrm_employee')->select('id', 'f_name')->get();
		$projects          = DB::table('assets_projects')->select('id', 'project_name')->get();
		$assets_allocation = DB::table('assets_allocation')->select('*')->where('assets_allocation.id', $request->id)->get();
		$geolocation = DB::table('assets_geolocation')->select('*')->get();
		$assets_allocation_assetname = DB::table('assets_allocation_assetname')->select('*')->where('assets_allocation_assetname.allocation_id', $request->id)->where('assets_allocation_assetname.status', '!=', 1)->get();
		$area = DB::table('assets_area')->select('*')->get();
		$allocationid = $request->id;



		return view('asset.asset.revoke_add', compact('employees', 'projects', 'assets', 'assets_allocation', 'assets_allocated', 'assets_allocation_assetname', 'geolocation', 'area', 'allocationid'));
	}


	public function asset_revoke_submit(Request $request)
	{

		for ($k = 0; $k < count($request->asset_id); $k++) {


			$data = [

				'asset_id' => (int)$request->asset_id[$k],
				'allocation_date' => Carbon::parse($request->allocation_date)->format('Y-m-d'),
				'return_date' => Carbon::parse($request->return_date)->format('Y-m-d'),
				'borrower' => $request->borrower,
				'reason' => $request->reason,
				'project' => $request->project,
				'geo_location' => $request->geo_location,
				'available_quantity' => 1,
				'revoke_quantity' => 1,
				'area' => $request->area,
				'notes' => $request->notes,
			];

			$revoke_object = DB::table('assets_revoke')->insert($data);


			$data = [

				'asset_id' => (int)$request->asset_id[$k],
				'ddate' => Carbon::parse($request->return_date)->format('Y-m-d'),
				'borrower' => $request->borrower,
				'type' => 'Revoke',
				'quantity' => 1
			];

			$assets_history_object = DB::table('assets_history')->insert($data);


			$data2 = [

				// 'asset_id' =>$request->asset_id,
				'asset_status' => "Active",
				'available_quantity' => 1,

			];
			DB::table('assets')->where('id', $request->asset_id[$k])->update($data2);


			$data2 = [

				'status' => 1,

			];
			DB::table('assets_allocation_assetname')->where('allocation_id', $request->allocationid)->where('assetname', $request->asset_id[$k])->update($data2);
		}






		return 'true';
	}




	public function asset_history_group(Request $request)
	{


		$all_assets = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name')->where('assets.asgroup', $request->id)->get();



		return view('asset.asset.history_list_group', compact('all_assets'));
	}


	public function asset_history_category(Request $request)
	{


		$all_assets = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name')->where('assets.category', $request->id)->get();



		return view('asset.asset.history_list_category', compact('all_assets'));
	}

	public function asset_history_type(Request $request)
	{


		$all_assets = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name')->where('assets.type', $request->id)->get();



		return view('asset.asset.history_list_type', compact('all_assets'));
	}



	public function asset_history_list(Request $request)
	{


		$all_assets = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name')->get();



		$all_assets_group = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name', 'assets_groups.name as asset_gname', 'assets_groups.id as asset_gid', DB::raw('count(*) as total'))->groupBy('assets.asgroup')->whereNotNull('assets.asgroup')->get();




		$all_assets_category = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name', 'assets_category.name as asset_gname', 'assets_category.id as asset_gid', DB::raw('count(*) as total'))->groupBy('assets.category')->whereNotNull('assets.category')->get();


		/*$all_assets_category = DB::table('assets_history')->leftjoin('assets','assets_history.asset_id','=','assets.id')->leftjoin('qzolvehrm_employee','assets_history.borrower','=','qzolvehrm_employee.id')->select('assets_history.*','assets.asset_name','assets.asset_code','assets.quantity','assets.available_quantity','qzolvehrm_employee.f_name')->groupBy('assets.category')->get();*/
		/*$all_assets_type = DB::table('assets_history')->leftjoin('assets','assets_history.asset_id','=','assets.id')->leftjoin('qzolvehrm_employee','assets_history.borrower','=','qzolvehrm_employee.id')->select('assets_history.*','assets.asset_name','assets.asset_code','assets.quantity','assets.available_quantity','qzolvehrm_employee.f_name')->groupBy('assets.type')->get();*/
		$all_assets_type = DB::table('assets_history')->leftjoin('assets', 'assets_history.asset_id', '=', 'assets.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qzolvehrm_employee', 'assets_history.borrower', '=', 'qzolvehrm_employee.id')->select('assets_history.*', 'assets.asset_name', 'assets.asset_code', 'assets.quantity', 'assets.available_quantity', 'qzolvehrm_employee.f_name', 'assets_type.name as asset_gname', 'assets_type.id as asset_gid', DB::raw('count(*) as total'))->groupBy('assets.type')->whereNotNull('assets.type')->get();


		return view('asset.asset.history_list', compact('all_assets', 'all_assets_group', 'all_assets_category', 'all_assets_type'));
	}

	public function asset_audit_list(Request $request)
	{


		$service_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Service')->get();
		$maitenance_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Maitenance')->get();




		$warranty_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Warranty')->get();

		$outofWarranty_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Outof Warranty')->get();

		$damaged_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Damaged')->get();

		$stolen_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Stolen')->get();

		$scrap_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Scrap')->get();

		$active_assets = DB::table('assets')->select('*')->where('assets.asset_status', 'Active')->get();


		return view('asset.asset.audit_list', compact('service_assets', 'maitenance_assets', 'warranty_assets', 'outofWarranty_assets', 'damaged_assets', 'stolen_assets', 'scrap_assets', 'active_assets'));
	}


	public function asset_master_list(Request $request)
	{

		$assets = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->get();
		$group = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->select('assets.*', 'assets_groups.name as groupname', DB::raw('count(*) as total'))->groupBy('assets.asgroup')->get();
		$category = DB::table('assets')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->select('assets.*', 'assets_category.name as categoryname', DB::raw('count(*) as total'))->groupBy('assets.category')->get();
		$warehouse = DB::table('assets')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->select('assets.*', 'assets_warehouse.warehouse_name', DB::raw('count(*) as total'))->groupBy('assets.warehouse')->get();
		$type = DB::table('assets')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->select('assets.*', 'assets_type.name as typename', DB::raw('count(*) as total'))->groupBy('assets.type')->get();
		$project = DB::table('assets_allocation')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->select('*', DB::raw('count(*) as total'), 'assets_projects.project_name')->groupBy('assets_allocation.project')->whereNotNull('assets_allocation.project')->get();
		$locations = DB::table('assets_allocation')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->select('*', DB::raw('count(*) as total'), 'assets_geolocation.location')->groupBy('assets_allocation.geo_location')->whereNotNull('assets_allocation.geo_location')->get();




		// $assets = DB::table('assets')->select('*')->groupBy('category')->get();
		return view('asset.asset.asset_master_list', compact('assets', 'category', 'warehouse', 'type', 'group', 'project', 'locations'));
	}
	public function om_list(Request $request)
	{


		$assets = DB::table('assets')->whereNotNull('assets.om_status')->select('*')->get();
		$oassets = DB::table('assets')->where('assets.asset_status', 'Active')->select('*')->get();

		$asset_components = DB::table('assets_components')->leftjoin('assets', 'assets_components.asset_id', '=', 'assets.id')->select('assets_components.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag')->get();

		$asset_parts = DB::table('assets_parts')->leftjoin('assets', 'assets_parts.asset_id', '=', 'assets.id')->select('assets_parts.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag')->get();

		$asset_services = DB::table('assets_service')->leftjoin('assets', 'assets_service.asset_id', '=', 'assets.id')->select('assets_service.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag')->get();
		return view('asset.asset.om_list', compact('assets', 'oassets', 'asset_components', 'asset_parts', 'asset_services'));
	}


	//johny
	public function getassetdetails(Request $request)
	{
		$id = $request->id;

		$data = DB::table('assets')->select('assets.*')->where('assets.id', $id)->get();


		return response()->json($data);
	}
	//johny


	public function om_add(Request $request)
	{

		$assets = DB::table('assets')->select('*')->get();
		return view('asset.asset.om_add', compact('assets'));
	}

	public function asset_status_edit(Request $request)
	{
		$id = $request->id;
		$assets = DB::table('assets')->select('*')->where('assets.id', $id)->get();

		//dd($assets);
		return view('asset.asset.om_edit', compact('assets'));
	}


	public function asset_status_submit(Request $request)
	{

		$data1 = [
			'asset_status' => $request->asset_status,
			'availability_status' => $request->availability_status,
			'om_status' => $request->asset_status,
			'notes' => $request->notes
		];
		DB::table('assets')->where('id', $request->asset_id)->update($data1);
		return 'true';
	}







	public function parts_notification(Request $request)
	{
		$parts = DB::table('assets_parts')->leftjoin('assets', 'assets_parts.asset_id', '=', 'assets.id')->select('assets.*', 'assets_parts.part_date', 'assets_parts.id as cid')->whereNotNull('assets.id')->get();

		return view('asset.asset.parts_notification_list', compact('parts'));
	}

	public function components_notification(Request $request)
	{
		$components = DB::table('assets_components')->leftjoin('assets', 'assets_components.asset_id', '=', 'assets.id')->select('assets.*', 'assets_components.component_date', 'assets_components.id as cid')->whereNotNull('assets.id')->get();


		return view('asset.asset.components_notification_list', compact('components'));
	}
	public function assetedit(Request $request)
	{
		$id = $request->id;
		$warehouse = DB::table('assets_warehouse')->select('id', 'warehouse_name')->where('del_flag', 1)->get();
		$store = DB::table('assets_store_management')->select('id', 'store_name')->where('del_flag', 1)->get();
		$rack = DB::table('assets_rack_management')->select('id', 'rack_name')->where('del_flag', 1)->get();
		$asgroup = DB::table('assets_groups')->select('id', 'name')->where('del_flag', 1)->get();
		$category = DB::table('assets_category')->select('id', 'name')->where('del_flag', 1)->get();
		$type1 = DB::table('assets_type')->select('id', 'name')->where('del_flag', 1)->get();
		$brand = DB::table('qinventory_brand')->select('id', 'brand_name')->where('del_flag', 1)->get();
		$manufacturer = DB::table('qinventory_manufacture')->select('id', 'manufacture_name')->where('del_flag', 1)->get();
		$unit = DB::table('assets_unit')->select('id', 'unit_name')->where('del_flag', 1)->get();
		$supplier = DB::table('qcrm_supplier')->select('id', 'sup_name')->where('del_flag', 1)->get();

		$parts = DB::table('assets_parts')->select('id', 'part_name')->where('asset_id', NULL)->get();

		$components          = DB::table('assets_components')->select('id', 'component_name')->where('asset_id', NULL)->get();
		$services          = DB::table('assets_service')->select('id', 'service_name')->where('asset_id', NULL)->get();
		$assets = DB::table('assets')->select('*')->where('id', $id)->get();
		$asset_components = DB::table('assets_components')->select('*')->where('asset_id', $id)->get();
		$asset_parts = DB::table('assets_parts')->select('*')->where('asset_id', $id)->get();
		$asset_services  = DB::table('assets_service')->select('*')->where('asset_id', $id)->get();
		// $partnames = array();
		// foreach($asset_parts as $asset_partss)
		// {
		// 	$partname = $asset_partss->part_name;
		// 	$a  = DB::table('assets_parts')->select('part_name')->where('id',$partname)->get();
		// 	foreach($a as $aa)
		// 	{
		// 		$b = $aa->part_name;
		// 	$c  = DB::table('assets_parts')->select('part_name')->where('id',$b)->get();
		// 	array_push($partnames,$b);
		// 	}

		// }


		// dd($partname);
		return view('asset.asset.assetedit', compact('parts', 'components', 'services', 'warehouse', 'store', 'rack', 'asgroup', 'category', 'type1', 'brand', 'manufacturer', 'unit', 'supplier', 'assets', 'asset_components', 'asset_parts', 'asset_services'));

		//

	}


	public function asset_update(Request $request)
	{
		$asset_id = $request->id;
		$data = [
			'asset_name' => $request->asset_name,
			'asset_type' => $request->asset_type,
			'consumable' => $request->consumable,
			'inv_type' => $request->inv_type,
			// 'asset_code' =>$request->variantproductcode[$j],  
			// 'barcode' =>$request->variantbarcode[$j], 
			'image' => $request->fileData,
			'asgroup' => $request->group,
			'category' => $request->category,
			'warehouse' => $request->warehouse,
			'type' => $request->type,
			'store' => $request->store,
			'rack' => $request->rack,
			'unit' => $request->unit,
			'manufaturer' => $request->manufaturer,
			'supplier' => $request->supplier,
			'brand' => $request->brand,
			'quantity' => $request->quantity,
			'available_quantity' => $request->quantity,
			'barcodeformat' => $request->barcodeformat,
			'slno' => $request->slno,
			'modelno' => $request->modelno,
			'partno' => $request->partno,
			'hsncode' => $request->hsncode,
			'upc' => $request->upc,
			'ean' => $request->ean,
			'jan' => $request->jan,
			'isbn' => $request->isbn,
			'mpn' => $request->mpn,
			'asset_status' => 'Active',

		];
		DB::table('assets')->where('id', $asset_id)->update($data);

		// $asset_object =DB::table('assets')->insert($data);
		//       $asset_id = DB::getPdo()->lastInsertId();

		//parts

		if (isset($request->part_name) && !empty($request->part_name)) {
			for ($i = 0; $i < count($request->part_name); $i++) {

				///
				// $query = DB::table('assets_parts')->select('part_name','id')->where('part_name',$request->part_name[$i])->get();

				// 				 if($query->count()>0){
				// foreach ($query as $key => $value) {
				// 	$part_id=$value->id;
				// }
				// 				 }else{

				// 				 	$partdata = [     
				// 						'part_name' =>$request->part_name[$i],
				// 								 ];

				// 				 	$part_object =DB::table('assets_parts')->insert($partdata);
				//                 $part_id = DB::getPdo()->lastInsertId();
				// 				 }
				////
				$partdata = [
					'asset_id' => $asset_id,
					'part_name' => $request->part_name[$i],
					'part_date' => Carbon::parse($request->part_date[$i])->format('Y-m-d'),
					'reminderdays' => $request->reminderdaysparts[$i],

				];




				if (!empty($request->part_id[$i])) {
					$pp = PartsModel::updateOrCreate(['id' => $request->part_id[$i]], $partdata);
				} else {
					$pp =	DB::table('assets_parts')->insert($partdata);
					// PartsModel::updateOrCreate(['id'=>$request->part_id[$i]],$partdata);
				}
			}
		}


		//parts





		//components

		if (isset($request->component_name) && !empty($request->component_name)) {
			for ($i = 0; $i < count($request->component_name); $i++) {

				///
				// $query = DB::table('assets_components')->select('component_name','id')->where('component_name',$request->component_name[$i])->get();

				// 				 if($query->count()>0){
				// foreach ($query as $key => $value) {
				// 	$component_id=$value->id;
				// }
				// 				 }else{

				// 				 	$componentdata = [     
				// 						'component_name' =>$request->component_name[$i],
				// 								 ];

				// 				 	$part_object =DB::table('assets_components')->insert($componentdata);
				//                 $component_id = DB::getPdo()->lastInsertId();
				// 				 }
				////
				$componentdata = [
					'asset_id' => $asset_id,
					'component_name' => $request->component_name[$i],
					'component_date' => Carbon::parse($request->component_date[$i])->format('Y-m-d'),
					'reminderdays' => $request->reminderdayscomponenet[$i],

				];

				// DB::table('assets_components')->insert($componentdata);

				if (!empty($request->component_id[$i])) {
					$pp = ComponentModel::updateOrCreate(['id' => $request->component_id[$i]], $componentdata);
				} else {
					$pp =	DB::table('assets_components')->insert($componentdata);
					// PartsModel::updateOrCreate(['id'=>$request->part_id[$i]],$partdata);
				}
			}
		}


		//components






		//service

		if (isset($request->service_name) && !empty($request->service_name)) {
			for ($i = 0; $i < count($request->service_name); $i++) {

				///
				// $query = DB::table('assets_service')->select('service_name','id')->where('service_name',$request->service_name[$i])->get();

				// 				 if($query->count()>0){
				// foreach ($query as $key => $value) {
				// 	$component_id=$value->id;
				// }
				// 				 }else{

				// 				 	$servicedata = [     
				// 						'service_name' =>$request->service_name[$i],
				// 								 ];

				// 				 	$part_object =DB::table('assets_service')->insert($servicedata);
				//                 $component_id = DB::getPdo()->lastInsertId();
				// 				 }
				////
				$servicedata = [
					'asset_id' => $asset_id,
					'service_name' => $request->service_name[$i],
					'service_date' => Carbon::parse($request->service_date[$i])->format('Y-m-d'),
					'reminderdays' => $request->reminderdaysservice[$i],

				];
				DB::table('assets_service')->where('id', $request->service_id[$i])->update($servicedata);


				// DB::table('')->insert($servicedata);



			}
		}


		//service

		return 'true';
	}



	//asset_revoke_pdf
	public function asset_allocation_pdf(Request $request)
	{
		ini_set("pcre.backtrack_limit", "100000000000");
		$id = $request->id;

		$branch = Session::get('branch');
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();



		$allocations = DB::table('assets_allocation')->leftjoin('qzolvehrm_employee', 'assets_allocation.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_allocation.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_allocation.geo_location', '=', 'assets_geolocation.id')->leftjoin('qcrm_salesman_details', 'assets_allocation.allocatedby', '=', 'qcrm_salesman_details.id')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->select('assets_allocation.*', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'assets.id as aid', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname', 'qcrm_salesman_details.name as sname', 'assets_geolocation.location as location')->get();
		$pdf = PDF::loadView('asset.asset.asset_allocation_pdf', compact(
			'allocations',
			'branch',
			'branchsettings',
			'bname',
			'companysettings'
		));


		return $pdf->stream('Asset-Allocation-#' . $id . '.pdf');
	}



	public function asset_revoke_pdf(Request $request)
	{
		ini_set("pcre.backtrack_limit", "100000000000");
		$id = $request->id;

		$branch = Session::get('branch');
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();



		$revokes = DB::table('assets_revoke')->leftjoin('assets', 'assets_revoke.asset_id', '=', 'assets.id')->leftjoin('qzolvehrm_employee', 'assets_revoke.borrower', '=', 'qzolvehrm_employee.id')->leftjoin('assets_projects', 'assets_revoke.project', '=', 'assets_projects.id')->leftjoin('assets_geolocation', 'assets_revoke.geo_location', '=', 'assets_geolocation.id')->select('assets_revoke.*', 'assets_revoke.id as aid', 'assets.asset_name', 'assets.asset_code', 'assets.tag', 'qzolvehrm_employee.f_name', 'assets_projects.project_name', 'assets_geolocation.name as gname')->get();


		$pdf = PDF::loadView('asset.asset.asset_revoke_pdf', compact(
			'revokes',
			'branch',
			'branchsettings',
			'bname',
			'companysettings'
		));


		return $pdf->stream('Asset-Revoke-#' . $id . '.pdf');
	}

	public function asetcategoryview(Request $request)
	{
		$id = $request->id;
		$category = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->where('assets.category', $id)->get();

		return view('asset.asset.categorylist', compact('category'));
	}

	public function asettypeview(Request $request)
	{
		$id = $request->id;
		$type = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->where('assets.type', $id)->get();

		return view('asset.asset.typelist', compact('type'));
	}

	public function asetwarehouseview(Request $request)
	{
		$id = $request->id;
		$warehouse = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->where('assets.warehouse', $id)->get();

		return view('asset.asset.warehouselist', compact('warehouse'));
	}

	public function asetgroupview(Request $request)
	{
		$id = $request->id;
		$group = DB::table('assets')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->where('assets.asgroup', $id)->get();

		return view('asset.asset.grouplist', compact('group'));
	}

	public function asetview(Request $request)
	{
		$id = $request->id;
		$warehouse = DB::table('assets_warehouse')->select('id', 'warehouse_name')->where('del_flag', 1)->get();
		$store = DB::table('assets_store_management')->select('id', 'store_name')->where('del_flag', 1)->get();
		$rack = DB::table('assets_rack_management')->select('id', 'rack_name')->where('del_flag', 1)->get();
		$asgroup = DB::table('assets_groups')->select('id', 'name')->where('del_flag', 1)->get();
		$category = DB::table('assets_category')->select('id', 'name')->where('del_flag', 1)->get();
		$type1 = DB::table('assets_type')->select('id', 'name')->where('del_flag', 1)->get();
		$brand = DB::table('qinventory_brand')->select('id', 'brand_name')->where('del_flag', 1)->get();
		$manufacturer = DB::table('qinventory_manufacture')->select('id', 'manufacture_name')->where('del_flag', 1)->get();
		$unit = DB::table('assets_unit')->select('id', 'unit_name')->where('del_flag', 1)->get();
		$supplier = DB::table('qcrm_supplier')->select('id', 'sup_name')->where('del_flag', 1)->get();

		$parts = DB::table('assets_parts')->select('id', 'part_name')->where('asset_id', NULL)->get();

		$components          = DB::table('assets_components')->select('id', 'component_name')->where('asset_id', NULL)->get();
		$services          = DB::table('assets_service')->select('id', 'service_name')->where('asset_id', NULL)->get();
		$assets = DB::table('assets')->select('*')->where('id', $id)->get();
		$asset_components = DB::table('assets_components')->select('*')->where('asset_id', $id)->get();
		$asset_parts = DB::table('assets_parts')->select('*')->where('asset_id', $id)->get();
		$asset_services  = DB::table('assets_service')->select('*')->where('asset_id', $id)->get();

		return view('asset.asset.assetview', compact('parts', 'components', 'services', 'warehouse', 'store', 'rack', 'asgroup', 'category', 'type1', 'brand', 'manufacturer', 'unit', 'supplier', 'assets', 'asset_components', 'asset_parts', 'asset_services'));

		//

	}

	public function asetdocumentview(Request $request)
	{
		$id = $request->id;

		$assets = DB::table('assets')->select('*')->where('id', $id)->get();
		foreach ($assets as $assets) {
			$img = explode(',', $assets->image);
		}

		return view('asset.asset.assetdocumentview', compact('img'));

		//

	}

	public function assetdocdownload(Request $request)
	{

		ob_end_clean();
		$file = $request->id;
		$file_path = public_path($file);
		//dd($file_path);
		return response()->download($file_path);
		redirect()->back();
	}

	public function asetlocationview(Request $request)
	{
		$geolocation = $request->id;

		$location = DB::table('assets_allocation')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->where('assets_allocation.geo_location', $geolocation)->get();
		return view('asset.asset.locationlist', compact('location'));
	}

	public function asetprojectview(Request $request)
	{
		$project = $request->id;

		$projects = DB::table('assets_allocation')->leftjoin('assets_allocation_assetname', 'assets_allocation.id', '=', 'assets_allocation_assetname.allocation_id')->leftjoin('assets', 'assets_allocation_assetname.assetname', '=', 'assets.id')->leftjoin('assets_groups', 'assets.asgroup', '=', 'assets_groups.id')->leftjoin('assets_category', 'assets.category', '=', 'assets_category.id')->leftjoin('assets_type', 'assets.type', '=', 'assets_type.id')->leftjoin('qinventory_brand', 'assets.brand', '=', 'qinventory_brand.id')->leftjoin('assets_warehouse', 'assets.warehouse', '=', 'assets_warehouse.id')->leftjoin('assets_store_management', 'assets.store', '=', 'assets_store_management.id')->leftjoin('assets_unit', 'assets.unit', '=', 'assets_unit.id')->select('assets.*', 'assets_groups.name as groupname', 'assets_category.name as categoryname', 'assets_type.name as typename', 'qinventory_brand.brand_name', 'assets_warehouse.warehouse_name', 'assets_store_management.store_name', 'assets_unit.unit_name')->where('assets_allocation.project', $project)->get();
		return view('asset.asset.projectlist', compact('projects'));
	}

	public function partsupdate(Request $request)
	{
		$id = $request->id;

		$parts = DB::table('assets_parts')->select('*')->where('id', $id)->get();
		return view('asset.asset.partupdate', compact('parts'));
	}
	public function componentupdate(Request $request)
	{
		$id = $request->id;

		$component = DB::table('assets_components')->select('*')->where('id', $id)->get();
		return view('asset.asset.componentupdate', compact('component'));
	}
}

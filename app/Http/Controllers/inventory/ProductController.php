<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\AttributeModel;
use App\inventory\BrandModel;
use App\inventory\ManufactureModel;
use App\inventory\productcategory;
use App\inventory\Attributeoptionsmodel;
use App\inventory\ProductdetailslistModel;
use App\inventory\ProductvariantModel;
use App\inventory\ProductUnitModel;
use App\inventory\BatchlistModel;
use App\inventory\WarehouselistModel;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use Session;
use DB;
use Carbon\Carbon;
use App\inventory\Product_stockModel;
use App\inventory\StoremanagementlistModel;

use App\crm\SupplierModel;

class ProductController extends Controller
{

	/**
	 * Display a listing of Various Products.
	 */


	public function pproduct(Request $request)
	{
		$branch = Session::get('branch');
		$data = DB::table('qsell_saleinvoice_products')->leftJoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->leftJoin('qsell_saleinvoice', 'qsell_saleinvoice_products.invoice_id', '=', 'qsell_saleinvoice.id')->select('qinventory_products.product_name', 'qsell_saleinvoice_products.item_id', 'qsell_saleinvoice_products.quantity', 'qsell_saleinvoice_products.rate', 'qsell_saleinvoice_products.amount', 'qsell_saleinvoice_products.invoice_id', 'qsell_saleinvoice_products.vat_percentage', 'qsell_saleinvoice_products.vatamount', 'qsell_saleinvoice_products.discount', 'qsell_saleinvoice_products.totalamount', 'qsell_saleinvoice.cust_name', 'qsell_saleinvoice.id as inv_id', 'qsell_saleinvoice.quotedate', 'qinventory_products.selling_price')->orderby('qsell_saleinvoice.quotedate', 'desc')->get();


		return view('inventory.product.plisting', compact('data'));
	}



	/////////////////
	public function ProductListing(Request $request)
	{
		$branch = Session::get('branch');
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}

		///




		//
		if ($request->ajax()) {
			if ($common_customer_database == 1) {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qcrm_supplier', 'qinventory_products.provider_id', '=', 'qcrm_supplier.id')->leftJoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->leftJoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.out_of_stock_status', 'qinventory_products.product_status', 'qinventory_products.description', 'qinventory_products.product_id', 'qinvoice_category.category_name', 'qinventory_products.selling_price', 'qinventory_products.product_price', 'qinventory_products.part_no', 'qinventory_products.model_no', 'qinventory_products.available_stock', 'qinventory_products.sku', 'qinventory_warehouse.warehouse_name', 'qinventory_brand.brand_name', 'qcrm_supplier.sup_name', 'qinventory_manufacture.manufacture_name')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 1);
				// $query->where('qinventory_products.product_id',NULL);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = ProductdetailslistModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->product_id;
				})->rawColumns(['action'])->make(true);
			} else {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qcrm_supplier', 'qinventory_products.provider_id', '=', 'qcrm_supplier.id')->leftJoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->leftJoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.out_of_stock_status', 'qinventory_products.product_status', 'qinventory_products.description', 'qinventory_products.product_id', 'qinvoice_category.category_name', 'qinventory_products.selling_price', 'qinventory_products.product_price', 'qinventory_products.part_no', 'qinventory_products.model_no', 'qinventory_products.available_stock', 'qinventory_products.sku', 'qinventory_warehouse.warehouse_name', 'qinventory_brand.brand_name', 'qcrm_supplier.sup_name', 'qinventory_manufacture.manufacture_name')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
				// $query->where('qinventory_products.product_id',NULL);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = ProductdetailslistModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->product_id;
				})->rawColumns(['action'])->make(true);
			}
		}
		return view('inventory.product.listing');
	}


	public function ProductstockoutListing(Request $request)
	{
		$branch = Session::get('branch');

		if (!empty($request->wid)) {
			$warehouse = $request->wid;
		} else {
			$warehouse = Session::get('warehouse');
		}

		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($request->ajax()) {
			if ($common_customer_database == 1) {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
					->select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.out_of_stock_status', 'qinventory_products.product_status', 'qinventory_products.description', 'qinventory_products.product_id', 'qinvoice_category.category_name', 'qinventory_products.selling_price', 'qinventory_products.product_price', 'qinventory_products.part_no', 'qinventory_products.model_no', 'qinventory_products.available_stock', 'qinventory_products.sku')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 1);
				$query->where('qinventory_products.warehouse', $warehouse);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = ProductdetailslistModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->product_id;
				})->rawColumns(['action'])->make(true);
			} else {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
					->select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.out_of_stock_status', 'qinventory_products.product_status', 'qinventory_products.description', 'qinventory_products.product_id', 'qinvoice_category.category_name', 'qinventory_products.selling_price', 'qinventory_products.product_price', 'qinventory_products.part_no', 'qinventory_products.model_no', 'qinventory_products.available_stock', 'qinventory_products.sku')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 1);
				// $query->where('qinventory_products.product_id',NULL);
				$query->where('qinventory_products.warehouse', $warehouse);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = ProductdetailslistModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->product_id;
				})->rawColumns(['action'])->make(true);
			}
		}
		return view('warehouse.product.listing');
	}




	public function Getoptions(Request $request)
	{
		$id = $request->id;
		// $data=  AttributeModel::select('options')->where('id',$id)->get();

		$data = DB::table('qinventory_attribute')->leftjoin('qinventory_attributeoptions', 'qinventory_attributeoptions.attribute_id', "=", "qinventory_attribute.id")
			->where('qinventory_attributeoptions.attribute_id', '=', $id)->get();



		return response()->json($data);
	}

	/**
	 * Add New Product Form.
	 */

	public function NewProduct()
	{
		$branch = Session::get('branch');
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($common_customer_database == 1) {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$unit          = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->get();
			$suppliers = SupplierModel::select('id', 'sup_name')->where('del_flag', 1)->get();
			$warehouse = WarehouselistModel::select('id', 'warehouse_name')->where('del_flag', 1)->get();
		} else {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->where('branch', $branch)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$unit          = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
			$suppliers = SupplierModel::select('id', 'sup_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$warehouse = WarehouselistModel::select('id', 'warehouse_name')->where('del_flag', 1)->get();
		}

		return view('inventory.product.add', compact('attributeList', 'brandlist', 'manufacturerlist', 'categorylist', 'unit', 'batches', 'branch', 'suppliers', 'warehouse'))
			->with('attributeList', $attributeList);
	}


	/**
	 *product details for submission
	 */

	public function product_submit(Request $request)
	{
		//dd($request);
		$branch = Session::get('branch');
		$postID = $request->id;
		$batch = $request->batch_lot_no;
		$ccd = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $ccd->pluck('labels')->toArray();
		$des = $request->description;
		$unit = DB::table('qinventory_product_unit')->where('id', $request->unit)->value('unit_name');
		$warehouse = DB::table('qinventory_warehouse')->where('id', $request->warehouse)->value('warehouse_name');
		$brandname = DB::table('qinventory_brand')->where('id', $request->brand)->value('brand_name');
		$manufacturername = DB::table('qinventory_manufacture')->where('id', $request->manufacturer)->value('manufacture_name');
		$categoryname = DB::table('qinvoice_category')->where('id', $request->category)->value('category_name');
		$suppliername = DB::table('qcrm_supplier')->where('id', $request->sup_vendorname)->value('sup_name');


		$brandlist        = BrandModel::select('id', 'brand_name')->where('id', $request->brand)->get();
		$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('id', $request->manufacturer)->get();
		foreach ($brandlist as $key => $value) {
			$brname = $value->brand_name;
		}

		foreach ($manufacturerlist as $key => $value) {
			$mrname = $value->manufacture_name;
		}

		$check = 0;
		if (isset($postID) && !empty($postID)) {
			$check = $this->check_exists_edit($postID, $request->product_code, 'product_code', 'qinventory_products');
		} else {
			$check = $this->check_exists($request->product_code, 'product_code', 'qinventory_products');
		}
		// $check=0;
		// dd($request->product_variant);

		// if($check<1)
		// {

		$data = [
			'product_type' => 1,
			'product_name' => $request->product_name,
			'category' => $request->category,
			'unit' => $request->unit,
			'product_code' => $request->product_code,
			'sku' => $request->sku,
			'barcode' => $request->barcode,
			'barcode_format' => $request->barcode_format,
			'available_stock' => $request->available_stock,
			'product_price' => $request->product_price,
			'product_status' => 1,
			'out_of_stock_status' => 1,
			'provider' => $request->sup_vendor,
			'provider_id' => $request->sup_vendorname,
			'description' => $des,
			'opening_stock' => $request->opening_stock,
			'enable_minus_stock_billing' => $request->enable_minus_stock_billing,
			'reorder_quantity_alert' => $request->reorder_quantity_alert,
			'reorder_quantity' => $request->alert_quantity,
			'inventory_type' => $request->item_type,
			'refundable' => $request->refundable,
			'manufacturer' => $request->manufacturer,
			'brand' => $request->brand,
			'serial_number' => $request->serial_number,
			'model_no' => $request->model_no,
			'part_no' => $request->part_no,
			'hsn_code' => $request->hsn_code,
			'maintain_batches' => $request->maintain_batches,
			'batch_name' => $request->batch_lot_no,
			'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),

			'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),

			'expiry_reminder'     => $request->expiry_reminder,

			'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'),

			'warranty_reminder' => $request->warranty_reminder,


			'upc' => $request->upc,
			'ean' => $request->ean,
			'jan' => $request->jan,
			'isbn' => $request->isbn,
			'mpn' => $request->mpn,
			'image' => $request->fileData,
			'branch' => $branch,
			'selling_price' => $request->selling_price,
			'lotno' => $request->lotno,
			'shelflife' => $request->shelflife,
			'countryoforigin' => $request->countryoforigin,
			'cfds' => $request->cfds,
			'reference' => $request->reference,
			'catno' => $request->catno,
			'warehouse' => $request->warehouse,
			'unit_name' => $unit,
			'warehouse_name' => $warehouse,
			'supplier_name' => $suppliername,
			'category_name' => $categoryname,
			'manufacturer_name' => $manufacturername,
			'brand_name' => $brandname,

		];
		/*echo "<pre>"; print_r($data); exit();*/
		$product_object = ProductdetailslistModel::updateOrCreate(['product_id' => $postID], $data);
		$product_id = $product_object->product_id;
		//
		ProductdetailslistModel::where('product_id', $product_id)->update(['main_product_id' => $product_id]);

		// 		$data1 = [  
		// 		'product_id' => $product_id, 
		// 		'main_product_id' => $product_id, 
		// 		'product_type' =>1,
		// 		'product_name' =>$request->product_name,
		// 		'category' =>$request->category,         
		// 		'unit' =>$request->unit, 
		// 		'product_code' =>$request->product_code, 
		// 		'sku' =>$request->sku, 
		// 		'barcode' =>$request->barcode, 
		// 		'barcode_format' =>$request->barcode_format, 
		// 		'available_stock' =>$request->available_stock, 
		// 		'stock' =>$request->available_stock, 
		// 		'product_price' =>$request->product_price,
		// 		'product_status' =>1, 
		// 		'out_of_stock_status' =>1,  
		// 		'provider' =>$request->sup_vendor, 
		// 		'provider_id' =>$request->sup_vendorname, 
		// 		'description' =>$des, 
		// 		'opening_stock' =>$request->opening_stock, 
		// 		'enable_minus_stock_billing' =>$request->enable_minus_stock_billing, 
		// 		'reorder_quantity_alert' =>$request->reorder_quantity_alert, 
		// 		'reorder_quantity' =>$request->alert_quantity, 
		// 		'inventory_type' =>$request->item_type,
		// 	    'refundable' =>$request->refundable, 
		// 		'manufacturer' =>$request->manufacturer, 
		// 		'brand' =>$request->brand, 
		// 		'serial_number' =>$request->serial_number,
		// 		'model_no' =>$request->model_no, 
		// 		'part_no' =>$request->part_no, 
		// 		'hsn_code' =>$request->hsn_code, 
		// 		'maintain_batches' =>$request->maintain_batches, 
		// 		'batch_name' =>$request->batch_lot_no, 
		// 		'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),  


		// 		'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),  

		// 		'expiry_reminder'     => Carbon::parse($request->expiry_reminder)->format('Y-m-d'), 

		// 		'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'), 

		// 		'warranty_reminder'     => Carbon::parse($request->warranty_reminder)->format('Y-m-d'),  


		// 		'upc' =>$request->upc, 
		// 		'ean' =>$request->ean, 
		// 		'jan' =>$request->jan,
		// 		'isbn' =>$request->isbn,
		// 		'mpn' =>$request->mpn,
		// 		'image' =>$request->fileData,
		// 		'branch' =>$branch,
		// 		'selling_price'=> $request->selling_price,
		// 		'lotno'=> $request->lotno,
		// 		'shelflife'=>$request->shelflife,
		// 		'countryoforigin'=>$request->countryoforigin,
		// 		'cfds'=>$request->cfds,
		// 		'reference'=>$request->reference,
		// 		'catno'=>$request->catno,
		// 		'warehouse'=>$request->warehouse
		// 				 ];
		// $product_stock_object = Product_stockModel::updateOrCreate(['product_id' => $product_id], $data1);

		if (isset($request->product_variant) && !empty($request->product_variant)) {
			for ($i = 0; $i < count($request->product_variant); $i++) {
				$vardata = [
					'main_product_id' => $product_id,
					'product_varient' => $product_id,
					'product_type' => 1,
					'product_name' => $request->product_variant[$i],
					'category' => $request->category,
					'unit' => $request->unit,
					'product_code' => $request->variantproductcode[$i],
					'sku' => $request->variantsku[$i],
					'barcode' => $request->variantbarcode[$i],
					'barcode_format' => $request->barcode_format,
					'available_stock' => $request->available_stock,
					'product_price' => $request->variantproductcost[$i],
					'product_status' => 1,
					'out_of_stock_status' => 1,
					'provider' => $request->sup_vendor,
					'provider_id' => $request->sup_vendorname,
					'description' => $des,
					'opening_stock' => $request->variantstock[$i],
					'enable_minus_stock_billing' => $request->enable_minus_stock_billing,
					'reorder_quantity_alert' => $request->reorder_quantity_alert,
					'reorder_quantity' => $request->alert_quantity,
					'inventory_type' => $request->item_type,
					'refundable' => $request->refundable,
					'manufacturer' => $request->manufacturer,
					'brand' => $request->brand,
					'serial_number' => $request->serial_number,
					'model_no' => $request->model_no,
					'part_no' => $request->part_no,
					'hsn_code' => $request->hsn_code,
					'maintain_batches' => $request->maintain_batches,
					'batch_name' => $request->batch_lot_no,
					'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),

					'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),

					'expiry_reminder'     => Carbon::parse($request->expiry_reminder)->format('Y-m-d'),

					'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'),

					'warranty_reminder'     => Carbon::parse($request->warranty_reminder)->format('Y-m-d'),


					'upc' => $request->upc,
					'ean' => $request->ean,
					'jan' => $request->jan,
					'isbn' => $request->isbn,
					'mpn' => $request->mpn,
					'image' => 'ProductFileUpload/' . $request->variantimage[$i],
					'branch' => $branch,
					'selling_price' => $request->selling_price,
					'lotno' => $request->lotno,
					'shelflife' => $request->shelflife,
					'countryoforigin' => $request->countryoforigin,
					'cfds' => $request->cfds,
					'reference' => $request->reference,
					'catno' => $request->catno,
					'warehouse' => $request->warehouse,
					'unit_name' => $unit,
					'warehouse_name' => $warehouse,
					'supplier_name' => $suppliername,
					'category_name' => $categoryname,
					'manufacturer_name' => $manufacturername,
					'brand_name' => $brandname,

				];

				$product_var_object = ProductdetailslistModel::Create($vardata);
				$pid = $product_var_object->product_id;
				// 						$vardata1 = [ 
				// 						'main_product_id' => $product_id, 
				// 						'product_id' => $pid,   
				// 					    'product_varient' =>$product_id, 
				// 						'product_type' =>1,
				// 						'product_name' =>$request->product_variant[$i],
				// 						'category' =>$request->category,         
				// 						'unit' =>$request->unit, 
				// 						'product_code' =>$request->variantproductcode[$i], 
				// 						'sku' =>$request->variantsku[$i],
				// 						'barcode' =>$request->variantbarcode[$i],
				// 						'barcode_format' =>$request->barcode_format, 
				// 						'available_stock' =>$request->available_stock, 
				// 						'product_price' =>$request->variantproductcost[$i], 
				// 						'product_status' =>1, 
				// 						'out_of_stock_status' =>1,  
				// 						'provider' =>$request->sup_vendor, 
				// 						'provider_id' =>$request->sup_vendorname, 
				// 						'description' =>$des,
				// 						'opening_stock' =>$request->opening_stock, 
				// 						'enable_minus_stock_billing' =>$request->enable_minus_stock_billing, 
				// 						'reorder_quantity_alert' =>$request->reorder_quantity_alert, 
				// 						'reorder_quantity' =>$request->alert_quantity, 
				// 						'inventory_type' =>$request->item_type,
				// 					    'refundable' =>$request->refundable, 
				// 						'manufacturer' =>$request->manufacturer, 
				// 						'brand' =>$request->brand, 
				// 						'serial_number' =>$request->serial_number,
				// 						'model_no' =>$request->model_no, 
				// 						'part_no' =>$request->part_no, 
				// 						'hsn_code' =>$request->hsn_code, 
				// 						'maintain_batches' =>$request->maintain_batches, 
				// 						'batch_name' =>$request->batch_lot_no, 
				// 						'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),  

				// 						'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),  

				// 						'expiry_reminder'     => Carbon::parse($request->expiry_reminder)->format('Y-m-d'), 

				// 						'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'), 

				// 						'warranty_reminder'     => Carbon::parse($request->warranty_reminder)->format('Y-m-d'),  


				// 						'upc' =>$request->upc, 
				// 						'ean' =>$request->ean, 
				// 						'jan' =>$request->jan,
				// 						'isbn' =>$request->isbn,
				// 						'mpn' =>$request->mpn,
				// 						'image' =>'ProductFileUpload/'.$request->variantimage[$i],
				// 						'branch' =>$branch,
				// 						'selling_price'=> $request->selling_price,
				// 						'lotno'=> $request->lotno,
				// 						'shelflife'=>$request->shelflife,
				// 						'countryoforigin'=>$request->countryoforigin,
				// 						'cfds'=>$request->cfds,
				// 						'reference'=>$request->reference,
				// 						'catno'=>$request->catno,
				// 						'warehouse'=>$request->warehouse

				// 								 ];
				// $product_var_stock_object = Product_stockModel::updateOrCreate(['product_varient' => $product_id], $vardata1);


			}
		}

		return 'true';
		// }
		//  else
		//       {
		//           return 'false';
		//       }
	}




	public function warproduct_submits(Request $request)
	{
		//dd($request);
		$branch = Session::get('branch');
		$warehouse = Session::get('warehouse');
		$postID = $request->id;
		$batch = $request->batch_lot_no;
		$ccd = DB::table('qsettings_custom_fields')->select('*')->get();
		$plabels = $ccd->pluck('labels')->toArray();
		$des = $request->description;


		$brandlist        = BrandModel::select('id', 'brand_name')->where('id', $request->brand)->get();
		$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('id', $request->manufacturer)->get();
		foreach ($brandlist as $key => $value) {
			$brname = $value->brand_name;
		}

		foreach ($manufacturerlist as $key => $value) {
			$mrname = $value->manufacture_name;
		}

		/*if(!empty($request->part_no)){
	$des.='Part No'.'-'.$request->part_no;
}
if(!empty($request->brand)){
	$des.=','.'Brand'.'-'.$brname;
	}
	if(!empty($request->manufacturer)){
		$des.=','.'Manufacturer'.'-'.$mrname;
	}
	if(!empty($request->countryoforigin)){
		$des.=','.'Country of Origin'.'-'.$request->countryoforigin;
	}
	if(!empty($request->lotno)){
		$des.=','.'Lot No'.'-'.$request->lotno;
	}




if(!empty($request->expiry_date)){
	$des.=','.'Expiry Date'.'-'.$request->expiry_date;
	}

if(!empty($request->cfds)){
$des.=','.$request->cfds;
}
*/



		/*if(in_array('part_no',$plabels))
	{
		
	}
	if(in_array('brand',$plabels))
	{
		
	}
		if(in_array('manufacturer',$plabels))
	{
		
	}

	if(in_array('countryoforigin',$plabels))
	{
		
	}
	if(in_array('lotno',$plabels))
	{
		
	}
	if(in_array('expiry_date',$plabels))
	{
		
	}
		if(in_array('cfds',$plabels))
	{
		
	}*/







		/*

	if(in_array('hsn_code',$plabels))
	{
		$des.=','.'HS Code'.'-'.$request->hsn_code;
	}
	if(in_array('model_no',$plabels))
	{
		$des.=','.'Model No'.'-'.$request->model_no;
	}
	if(in_array('serial_number',$plabels))
	{
		$des.=','.'Serial No'.'-'.$request->serial_number;
	}
	

	if(in_array('catno',$plabels))
	{
		$des.=','.'Catelogue No'.'-'.$request->catno;
	}
	if(in_array('manufacturing_date',$plabels))
	{
		$des.=','.'Manufacturing Date'.'-'.$request->manufacturing_date;
	}
	if(in_array('shelflife',$plabels))
	{
		$des.=','.'Days for Shelf Life'.'-'.$request->shelflife;
	}if(in_array('expiry_reminder',$plabels))
	{
		$des.=','.'Expiry Reminder'.'-'.$request->expiry_reminder;
	}if(in_array('warranty_date',$plabels))
	{
		$des.=','.'Warranty Date'.'-'.$request->warranty_date;
	}if(in_array('warranty_reminder',$plabels))
	{
		$des.=','.'Warranty Reminder'.'-'.$request->warranty_reminder;
	}if(in_array('upc',$plabels))
	{
		$des.=','.'UPC'.'-'.$request->upc;
	}if(in_array('ean',$plabels))
	{
		$des.=','.'EAN'.'-'.$request->ean;
	}if(in_array('jan',$plabels))
	{
		$des.=','.'JAN'.'-'.$request->jan;
	}if(in_array('isbn',$plabels))
	{
		$des.=','.'ISBN'.'-'.$request->isbn;
	}
	if(in_array('mpn',$plabels))
	{
		$des.=','.'MPN'.'-'.$request->mpn;
	}
	if(in_array('product_code',$plabels))
	{
		$des.=','.'Product Code'.'-'.$request->product_code;
	}if(in_array('sku',$plabels))
	{
		$des.=','.'SKU'.'-'.$request->sku;
	}if(in_array('barcode',$plabels))
	{
		$des.=','.'Barcode'.'-'.$request->barcode;
	}if(in_array('product_price',$plabels))
	{
		$des.=','.'Product Price'.'-'.$request->product_price;
	}if(in_array('selling_price',$plabels))
	{
		$des.=','.'Sales Price'.'-'.$request->selling_price;
	}if(in_array('sup_vendorname',$plabels))
	{
		$des.=','.'Supplier Name'.'-'.$request->sup_vendorname;
	}

	if(in_array('warehouse',$plabels))
	{
		$des.=','.'Warehouse'.'-'.$request->warehouse;
	}
	if(in_array('countryoforigin',$plabels))
	{
		$des.=','.'Country of Origin'.'-'.$request->countryoforigin;
	}
	
	if(in_array('cfds',$plabels))
	{
		$des.=','.'SFDS'.'-'.$request->cfds;
	}
	if(in_array('batch_lot_no',$plabels))
	{
		$des.=','.'Batch Name'.'-'.$request->batch_lot_no;
	}
	
	*/

		$product_code = $this->productnextNumber();


		if (isset($postID) && !empty($postID)) {
			$check = $this->check_exists_edit($postID, $request->sku, 'sku', 'qinventory_products');
		} else {
			$check = $this->check_exists($request->sku, 'sku', 'qinventory_products');
		}

		// dd($request->product_variant);
		$check = 0;
		if ($check < 1) {

			$data = [
				'product_type' => 1,
				'product_name' => $request->product_name,
				'category' => $request->category,
				'unit' => $request->unit,
				'product_code' => $request->product_code,
				'sku' => $request->sku,
				'barcode' => $request->barcode,
				'barcode_format' => $request->barcode_format,
				'available_stock' => $request->available_stock,
				'product_price' => $request->product_price,
				'product_status' => 1,
				'out_of_stock_status' => 1,
				'provider' => $request->sup_vendor,
				'provider_id' => $request->sup_vendorname,
				'description' => $des,
				'opening_stock' => $request->opening_stock,
				'enable_minus_stock_billing' => $request->enable_minus_stock_billing,
				'reorder_quantity_alert' => $request->reorder_quantity_alert,
				'reorder_quantity' => $request->alert_quantity,
				'inventory_type' => $request->item_type,
				'refundable' => $request->refundable,
				'manufacturer' => $request->manufacturer,
				'brand' => $request->brand,
				'serial_number' => $request->serial_number,
				'model_no' => $request->model_no,
				'part_no' => $request->part_no,
				'hsn_code' => $request->hsn_code,
				'maintain_batches' => $request->maintain_batches,
				'batch_name' => $request->batch_lot_no,
				'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),

				'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),

				'expiry_reminder'     => $request->expiry_reminder,

				'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'),

				'warranty_reminder' => $request->warranty_reminder,


				'upc' => $request->upc,
				'ean' => $request->ean,
				'jan' => $request->jan,
				'isbn' => $request->isbn,
				'mpn' => $request->mpn,
				'image' => $request->fileData,
				'branch' => $branch,
				'selling_price' => $request->selling_price,
				'lotno' => $request->lotno,
				'shelflife' => $request->shelflife,
				'countryoforigin' => $request->countryoforigin,
				'cfds' => $request->cfds,
				'reference' => $request->reference,
				'catno' => $request->catno,
				'warehouse' => $request->warehouse,
				'store' => $request->store,
				'rack' => $request->rack

			];
			/*echo "<pre>"; print_r($data); exit();*/
			$product_object = ProductdetailslistModel::updateOrCreate(['product_id' => $postID], $data);
			$product_id = $product_object->product_id;
			//
			ProductdetailslistModel::where('product_id', $product_id)->update(['main_product_id' => $product_id]);

			// 		$data1 = [  
			// 		'product_id' => $product_id, 
			// 		'main_product_id' => $product_id, 
			// 		'product_type' =>1,
			// 		'product_name' =>$request->product_name,
			// 		'category' =>$request->category,         
			// 		'unit' =>$request->unit, 
			// 		'product_code' =>$request->product_code, 
			// 		'sku' =>$request->sku, 
			// 		'barcode' =>$request->barcode, 
			// 		'barcode_format' =>$request->barcode_format, 
			// 		'available_stock' =>$request->available_stock, 
			// 		'stock' =>$request->available_stock, 
			// 		'product_price' =>$request->product_price,
			// 		'product_status' =>1, 
			// 		'out_of_stock_status' =>1,  
			// 		'provider' =>$request->sup_vendor, 
			// 		'provider_id' =>$request->sup_vendorname, 
			// 		'description' =>$des, 
			// 		'opening_stock' =>$request->opening_stock, 
			// 		'enable_minus_stock_billing' =>$request->enable_minus_stock_billing, 
			// 		'reorder_quantity_alert' =>$request->reorder_quantity_alert, 
			// 		'reorder_quantity' =>$request->alert_quantity, 
			// 		'inventory_type' =>$request->item_type,
			// 	    'refundable' =>$request->refundable, 
			// 		'manufacturer' =>$request->manufacturer, 
			// 		'brand' =>$request->brand, 
			// 		'serial_number' =>$request->serial_number,
			// 		'model_no' =>$request->model_no, 
			// 		'part_no' =>$request->part_no, 
			// 		'hsn_code' =>$request->hsn_code, 
			// 		'maintain_batches' =>$request->maintain_batches, 
			// 		'batch_name' =>$request->batch_lot_no, 
			// 		'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),  


			// 		'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),  

			// 		'expiry_reminder'     => Carbon::parse($request->expiry_reminder)->format('Y-m-d'), 

			// 		'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'), 

			// 		'warranty_reminder'     => Carbon::parse($request->warranty_reminder)->format('Y-m-d'),  


			// 		'upc' =>$request->upc, 
			// 		'ean' =>$request->ean, 
			// 		'jan' =>$request->jan,
			// 		'isbn' =>$request->isbn,
			// 		'mpn' =>$request->mpn,
			// 		'image' =>$request->fileData,
			// 		'branch' =>$branch,
			// 		'selling_price'=> $request->selling_price,
			// 		'lotno'=> $request->lotno,
			// 		'shelflife'=>$request->shelflife,
			// 		'countryoforigin'=>$request->countryoforigin,
			// 		'cfds'=>$request->cfds,
			// 		'reference'=>$request->reference,
			// 		'catno'=>$request->catno,
			// 		'warehouse'=>$request->warehouse
			// 				 ];
			// $product_stock_object = Product_stockModel::updateOrCreate(['product_id' => $product_id], $data1);

			if (isset($request->product_variant) && !empty($request->product_variant)) {
				for ($i = 0; $i < count($request->product_variant); $i++) {
					$vardata = [
						'main_product_id' => $product_id,
						'product_varient' => $product_id,
						'product_type' => 1,
						'product_name' => $request->product_variant[$i],
						'category' => $request->category,
						'unit' => $request->unit,
						'product_code' => $request->variantproductcode[$i],
						'sku' => $request->variantsku[$i],
						'barcode' => $request->variantbarcode[$i],
						'barcode_format' => $request->barcode_format,
						'available_stock' => $request->available_stock,
						'product_price' => $request->variantproductcost[$i],
						'product_status' => 1,
						'out_of_stock_status' => 1,
						'provider' => $request->sup_vendor,
						'provider_id' => $request->sup_vendorname,
						'description' => $des,
						'opening_stock' => $request->opening_stock,
						'enable_minus_stock_billing' => $request->enable_minus_stock_billing,
						'reorder_quantity_alert' => $request->reorder_quantity_alert,
						'reorder_quantity' => $request->alert_quantity,
						'inventory_type' => $request->item_type,
						'refundable' => $request->refundable,
						'manufacturer' => $request->manufacturer,
						'brand' => $request->brand,
						'serial_number' => $request->serial_number,
						'model_no' => $request->model_no,
						'part_no' => $request->part_no,
						'hsn_code' => $request->hsn_code,
						'maintain_batches' => $request->maintain_batches,
						'batch_name' => $request->batch_lot_no,
						'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),

						'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),

						'expiry_reminder'     => Carbon::parse($request->expiry_reminder)->format('Y-m-d'),

						'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'),

						'warranty_reminder'     => Carbon::parse($request->warranty_reminder)->format('Y-m-d'),


						'upc' => $request->upc,
						'ean' => $request->ean,
						'jan' => $request->jan,
						'isbn' => $request->isbn,
						'mpn' => $request->mpn,
						'image' => 'ProductFileUpload/' . $request->variantimage[$i],
						'branch' => $branch,
						'selling_price' => $request->selling_price,
						'lotno' => $request->lotno,
						'shelflife' => $request->shelflife,
						'countryoforigin' => $request->countryoforigin,
						'cfds' => $request->cfds,
						'reference' => $request->reference,
						'catno' => $request->catno,
						'warehouse' => $request->warehouse,
						'store' => $request->store,
						'rack' => $request->rack

					];

					$product_var_object = ProductdetailslistModel::Create($vardata);
					$pid = $product_var_object->product_id;
					// 						$vardata1 = [ 
					// 						'main_product_id' => $product_id, 
					// 						'product_id' => $pid,   
					// 					    'product_varient' =>$product_id, 
					// 						'product_type' =>1,
					// 						'product_name' =>$request->product_variant[$i],
					// 						'category' =>$request->category,         
					// 						'unit' =>$request->unit, 
					// 						'product_code' =>$request->variantproductcode[$i], 
					// 						'sku' =>$request->variantsku[$i],
					// 						'barcode' =>$request->variantbarcode[$i],
					// 						'barcode_format' =>$request->barcode_format, 
					// 						'available_stock' =>$request->available_stock, 
					// 						'product_price' =>$request->variantproductcost[$i], 
					// 						'product_status' =>1, 
					// 						'out_of_stock_status' =>1,  
					// 						'provider' =>$request->sup_vendor, 
					// 						'provider_id' =>$request->sup_vendorname, 
					// 						'description' =>$des,
					// 						'opening_stock' =>$request->opening_stock, 
					// 						'enable_minus_stock_billing' =>$request->enable_minus_stock_billing, 
					// 						'reorder_quantity_alert' =>$request->reorder_quantity_alert, 
					// 						'reorder_quantity' =>$request->alert_quantity, 
					// 						'inventory_type' =>$request->item_type,
					// 					    'refundable' =>$request->refundable, 
					// 						'manufacturer' =>$request->manufacturer, 
					// 						'brand' =>$request->brand, 
					// 						'serial_number' =>$request->serial_number,
					// 						'model_no' =>$request->model_no, 
					// 						'part_no' =>$request->part_no, 
					// 						'hsn_code' =>$request->hsn_code, 
					// 						'maintain_batches' =>$request->maintain_batches, 
					// 						'batch_name' =>$request->batch_lot_no, 
					// 						'manufacturing_date'     => Carbon::parse($request->manufacturing_date)->format('Y-m-d'),  

					// 						'expiry_date'     => Carbon::parse($request->expiry_date)->format('Y-m-d'),  

					// 						'expiry_reminder'     => Carbon::parse($request->expiry_reminder)->format('Y-m-d'), 

					// 						'warranty_date'     => Carbon::parse($request->warranty_date)->format('Y-m-d'), 

					// 						'warranty_reminder'     => Carbon::parse($request->warranty_reminder)->format('Y-m-d'),  


					// 						'upc' =>$request->upc, 
					// 						'ean' =>$request->ean, 
					// 						'jan' =>$request->jan,
					// 						'isbn' =>$request->isbn,
					// 						'mpn' =>$request->mpn,
					// 						'image' =>'ProductFileUpload/'.$request->variantimage[$i],
					// 						'branch' =>$branch,
					// 						'selling_price'=> $request->selling_price,
					// 						'lotno'=> $request->lotno,
					// 						'shelflife'=>$request->shelflife,
					// 						'countryoforigin'=>$request->countryoforigin,
					// 						'cfds'=>$request->cfds,
					// 						'reference'=>$request->reference,
					// 						'catno'=>$request->catno,
					// 						'warehouse'=>$request->warehouse

					// 								 ];
					// $product_var_stock_object = Product_stockModel::updateOrCreate(['product_varient' => $product_id], $vardata1);


				}
			}

			return 'true';
		} else {
			return 'false';
		}
	}
	/**
	 *product details for edit by shows the datas
	 */
	public function edit_product_details(Request $request)
	{
		$branch = Session::get('branch');
		// $id = $_REQUEST['id'];
		$id = $request->id;
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($common_customer_database == 1) {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$products = ProductdetailslistModel::where('product_id', $id)->limit(1)
				->first();
			$options = array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
			$unit     = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->get();
			$vendors = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
			$warehouse = WarehouselistModel::select('id', 'warehouse_name')->where('del_flag', 1)->get();
		} else {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->where('branch', $branch)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$products = ProductdetailslistModel::where('product_id', $id)->limit(1)
				->first();
			$options = array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
			$unit     = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
			$vendors = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
			$warehouse = WarehouselistModel::select('id', 'warehouse_name')->where('del_flag', 1)->get();
		}

		return view('inventory.product.edit', ['data' => $products], compact('attributeList', 'brandlist', 'manufacturerlist', 'products', 'categorylist', 'options', 'unit', 'batches', 'branch', 'vendors', 'suppliers', 'warehouse'));
	}

	// public function productview(Request $request)
	// {
	// $id = $_REQUEST['id'];
	// 		$attributeList    = AttributeModel::select('id', 'attribute_name','options')->where('del_flag',1)->get();
	// 		$brandlist        = BrandModel::select('id','brand_name')->where('del_flag',1)->get();
	// 		$manufacturerlist = ManufactureModel::select('id','manufacture_name')->where('del_flag',1)->get();
	// 		$categorylist     = productcategory::select('id','category_name')->where('del_flag',1)->get();
	// 		$data = ProductdetailslistModel::where('id', $id)->get();
	// 		$options =array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
	// 		$unit     = ProductUnitModel::select('id','unit_name')->where('del_flag',1)->get();
	// 		$batches          =BatchlistModel::select('id','batchname')->where('del_flag',1)->get();
	// 		return view('inventory.product.view',compact('data','attributeList','brandlist','manufacturerlist','categorylist','options','unit','batches'));

	// }

	/**
	 *product details trash 
	 */
	public function trash(Request $request)
	{
		$branch = Session::get('branch');
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($request->ajax()) {
			if ($common_customer_database == 1) {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
					->select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.out_of_stock_status', 'qinventory_products.product_status', 'qinventory_products.description', 'qinventory_products.product_id', 'qinvoice_category.category_name', 'qinventory_products.product_price', 'qinventory_products.selling_price')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 0);
				// $query->where('qinventory_products.product_id',NULL);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();

				$count_total = ProductdetailslistModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->product_id;
				})->rawColumns(['action'])->make(true);
			} else {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
					->select('qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.out_of_stock_status', 'qinventory_products.product_status', 'qinventory_products.description', 'qinventory_products.product_id', 'qinvoice_category.category_name')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 0)->where('qinventory_products.branch', $branch);
				// $query->where('qinventory_products.product_id',NULL);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();

				$count_total = ProductdetailslistModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->product_id;
				})->rawColumns(['action'])->make(true);
			}
		}
		return view('inventory.product.trash');
	}
	/**
	 *product details for delete
	 */

	public function deleteproducts(Request $request)
	{
		$postID = $request->id;
		//dd($postID);
		ProductdetailslistModel::where('product_id', $postID)->update(['del_flag' => 0]);
		return 'true';
	}
	/**
	 *product details for recover datas
	 */

	public function recover(Request $request)
	{
		$postID = $request->id;
		//dd($postID);
		ProductdetailslistModel::where('product_id', $postID)->update(['del_flag' => 1]);
		return 'true';
	}

	public function getsellingunits(Request $request)
	{
		$id = $request->id;

		$data = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('parent_unit', $id)->where('del_flag', 1)->get();
		// dd($data);


		return response()->json($data);
	}

	public function getcategorycode(Request $request)
	{
		$id = $request->id;

		$data = DB::table('qinvoice_category')->select('id', 'category_name', 'increment')->where('id', $id)->get();



		return response()->json($data);
	}
	public function check_exists($value, $field, $table)
	{
		$query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->get();

		return $query->count();
	}
	public function check_exists_edit($id, $value, $field, $table)
	{


		$query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->whereNotIn('product_id', [$id])->get();
		return $query->count();
	}

	public function DeleteTrashProduct(Request $request)
	{
		$id = $request->id;
		ProductdetailslistModel::where('id', $id)->delete();
	}
	public function getsupplier_vendor(Request $request)
	{
		$id = $request->id;

		if ($id == 1) {
			$data = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
			return response()->json($data);
		}
		if ($id == 2) {
			$data = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			return response()->json($data);
		}
		if ($id == "") {
			$data = "";
			return response()->json($data);
		}
	}
	public function productview(Request $request)
	{
		$branch = Session::get('branch');

		$id = $_REQUEST['id'];
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($common_customer_database == 1) {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$products = ProductdetailslistModel::where('product_id', $id)->limit(1)
				->first();
			$options = array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
			$unit     = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->get();
			$vendors = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
		} else {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->where('branch', $branch)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$products = ProductdetailslistModel::where('product_id', $id)->limit(1)
				->first();
			$options = array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
			$unit     = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
			$vendors = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
		}

		return view('inventory.product.productview', ['data' => $products], compact('attributeList', 'brandlist', 'manufacturerlist', 'products', 'categorylist', 'options', 'unit', 'batches', 'branch', 'vendors', 'suppliers'));
	}

	public function ProductpurchaseListing(Request $request)
	{
		$branch = Session::get('branch');
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($request->ajax()) {
			if ($common_customer_database == 1) {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
					->select('qinventory_products.*', 'qinventory_products.product_id as product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinventory_products.category', 'qinventory_products.available_stock', 'qinvoice_category.category_name')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 1);
				// $query->where('qinventory_products.product_id',NULL);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = Product_stockModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->id;
				})->rawColumns(['action'])->make(true);
			} else {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')
					->select('qinventory_products.*', 'qinventory_products.product_id as product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinvoice_category.category_name', 'qinventory_products.available_stock')->orderby('qinventory_products.product_id', 'desc');
				$query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
				// $query->where('qinventory_products.product_id',NULL);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = Product_stockModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->id;
				})->rawColumns(['action'])->make(true);
			}
		}
		return view('inventory.product.listing');
	}


	public function ProductsalesListing(Request $request)
	{

		$branch = Session::get('branch');
		$wid = Session::get('warehouse');

		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($request->ajax()) {
			if ($common_customer_database == 1) {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')->select('qinventory_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinvoice_category.category_name', 'qinventory_products.available_stock', 'qinventory_products.part_no', 'qinventory_warehouse.warehouse_name', 'qinventory_store_management.store_name', 'qinventory_products.available_stock as so'/*,DB::raw("(SELECT SUM(qsales_salesorder_products.iremaining_quantity) FROM qsales_salesorder_products

                                WHERE qinventory_products.product_id = qsales_salesorder_products.itemname

                                GROUP BY qsales_salesorder_products.itemname) as so")*/)->orderby('qinventory_products.product_id', 'desc');

				//->where('qinventory_products.warehouse',$wid)

				// $query->where('qinventory_products.del_flag',1)->limit(50);
				/*->limit(50)*/
				if ($wid) {
					//$query->where('qinventory_products.warehouse',$wid);
				}
				/*if (!empty($request->search['value'])) {
								  
								$query->where('qinventory_products.product_name', 'like', '%'.$request->search['value'].'%');

								}
								*/

				if (!empty($request->search['value'])) {

					$delimeter = ' '; //or your separator
					$keywords = explode($delimeter, $request->search['value']);



					$query->orWhere('qinventory_products.product_name', 'like', '%' . $request->search['value'] . '%');

					$query->orWhere('qinventory_products.barcode', 'like', '%' . $request->search['value'] . '%');


					foreach ($keywords as $keyword) {
						$query->orWhere('qinventory_products.product_name', 'LIKE', "%$keyword%");
					}
				}


				// $query->where('qinventory_products.warehouse',$wid);
				$query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = Product_stockModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->id;
				})->rawColumns(['action'])->make(true);
			} else {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')
					->select('qinventory_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinvoice_category.category_name', 'qinventory_products.available_stock', 'qinventory_products.part_no', 'qinventory_warehouse.warehouse_name', 'qinventory_store_management.store_name')->orderby('qinventory_products.product_id', 'desc');
				//->where('qinventory_products.warehouse',$wid)
				$query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
				/*->limit(50)*/
				if ($wid) {
					//$query->where('qinventory_products.warehouse',$wid);
				}
				// $query->where('qinventory_products.product_id',NULL);
				/*	if (!empty($request->search['value'])) {
								  
								$query->where('qinventory_products.product_name', 'like', '%'.$request->search['value'].'%');
								}*/

				if (!empty($request->search['value'])) {

					$query->where('qinventory_products.product_name', 'like', '%' . $request->search['value'] . '%');
				}




				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = Product_stockModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->id;
				})->rawColumns(['action'])->make(true);
			}
		}
		return view('inventory.product.listing');
	}
	public function edit_war_product_details(Request $request)
	{
		$branch = Session::get('branch');
		$id = $_REQUEST['id'];
		$warehouse1 = Session::get('warehouse');
		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($common_customer_database == 1) {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$products = ProductdetailslistModel::where('product_id', $id)->limit(1)
				->first();
			$options = array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
			$unit     = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->get();
			$vendors = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
			$warehouse = StoremanagementlistModel::select('id', 'store_name')->where('del_flag', 1)->get();

			$warehouse = DB::table('qinventory_store_management')->select('qinventory_store_management.*')->where('warehouse', $warehouse1)->get();

			//
		} else {
			$attributeList    = AttributeModel::select('id', 'attribute_name', 'options')->where('del_flag', 1)->where('branch', $branch)->get();
			$brandlist        = BrandModel::select('id', 'brand_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$manufacturerlist = ManufactureModel::select('id', 'manufacture_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$categorylist     = productcategory::select('id', 'category_name')->where('del_flag', 1)->get();
			$products = ProductdetailslistModel::where('product_id', $id)->limit(1)
				->first();
			$options = array(); //$options     = ProductvariantModel::where('product_id',$id)->where('del_flag',1)->get();
			$unit     = ProductUnitModel::select('id', 'unit_name')->where('del_flag', 1)->where('branch', $branch)->get();
			$batches          = BatchlistModel::select('id', 'batchname')->where('del_flag', 1)->where('branch', $branch)->get();
			$vendors = DB::table('qcrm_vendors')->select('id', 'vendor_name as name')->where('del_flag', 1)->get();
			$suppliers = DB::table('qcrm_supplier')->select('id', 'sup_name as name')->where('del_flag', 1)->get();
			$warehouse = DB::table('qinventory_store_management')->select('qinventory_store_management.*')->where('warehouse', $warehouse1)->get();
		}
		//dd($warehouse);
		return view('warehouse.product.edit', ['data' => $products], compact('attributeList', 'brandlist', 'manufacturerlist', 'products', 'categorylist', 'options', 'unit', 'batches', 'branch', 'vendors', 'suppliers', 'warehouse'));
	}



	public function productnextNumber()
	{

		$max = DB::table('qinventory_products')->max('product_code');

		if (empty($max)) {
			$maxNumber = 10000000;
		} else {
			$maxNumber = (int)$max;
		}

		return $maxNumber + 1;
	}


	public function datasearch(Request $request)
	{

		$branch = Session::get('branch');
		$wid = Session::get('warehouse');

		$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
		foreach ($ccd as $cus) {
			$common_customer_database = $cus->common_customer_database;
		}
		if ($request->ajax()) {
			if ($common_customer_database == 1) {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')->select('qinventory_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinvoice_category.category_name', 'qinventory_products.available_stock', 'qinventory_products.part_no', 'qinventory_warehouse.warehouse_name', 'qinventory_store_management.store_name', DB::raw("(SELECT SUM(qsales_salesorder_products.iremaining_quantity) FROM qsales_salesorder_products

                                WHERE qinventory_products.product_id = qsales_salesorder_products.itemname

                                GROUP BY qsales_salesorder_products.itemname) as so"))->orderby('qinventory_products.product_id', 'desc');

				//->where('qinventory_products.warehouse',$wid)

				$query->where('qinventory_products.del_flag', 1);
				/*->limit(50)*/
				if ($wid) {
					//$query->where('qinventory_products.warehouse',$wid);
				}
				/*	if (!empty($request->search['value'])) {
								  
								$query->where('qinventory_products.product_name', 'like', '%'.$request->search['value'].'%');

								}*/



				if (!empty($request->q)) {

					$query->where('qinventory_products.product_name', 'like', '%' . $request->search['value'] . '%');
				} else {
					$query->limit(0);
				}





				// $query->where('qinventory_products.warehouse',$wid);
				$query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = Product_stockModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->id;
				})->rawColumns(['action'])->make(true);
			} else {
				$query = DB::table('qinventory_products')
					->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
					->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->leftJoin('qinventory_store_management', 'qinventory_products.store', '=', 'qinventory_store_management.id')
					->select('qinventory_products.*', 'qinventory_products.product_id', 'qinventory_products.product_name', 'qinventory_products.product_code', 'qinventory_products.barcode as bar_code', 'qinventory_products.product_id as pid', 'qinventory_product_unit.unit_name as unit', 'qinventory_products.product_price as product_price', 'qinventory_products.selling_price as selling_price', 'qinventory_products.product_status', 'qinventory_products.description as description', 'qinventory_products.product_id as id', 'qinventory_products.product_type', 'qinvoice_category.category_name', 'qinventory_products.available_stock', 'qinventory_products.part_no', 'qinventory_warehouse.warehouse_name', 'qinventory_store_management.store_name')->orderby('qinventory_products.product_id', 'desc');
				//->where('qinventory_products.warehouse',$wid)
				$query->where('qinventory_products.del_flag', 1)->where('qinventory_products.branch', $branch);
				/*->limit(50)*/
				if ($wid) {
					//$query->where('qinventory_products.warehouse',$wid);
				}
				// $query->where('qinventory_products.product_id',NULL);
				/*	if (!empty($request->search['value'])) {
								  
								$query->where('qinventory_products.product_name', 'like', '%'.$request->search['value'].'%');
								}*/

				if (!empty($request->search['value'])) {

					$query->where('qinventory_products.product_name', 'like', '%' . $request->search['value'] . '%');
				}




				$data = $query->get();
				// dd($data);
				$count_filter = $query->count();
				$count_total = Product_stockModel::count();
				return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
					return $row->id;
				})->rawColumns(['action'])->make(true);
			}
		}
		return view('inventory.product.listing');
	}


	public function product_correct(Request $request)
	{

		$products = DB::table('qinventory_products')->select('qinventory_products.*')->get();


		foreach ($products as $key => $value) {



			$unit = DB::table('qinventory_product_unit')->where('id', $value->unit)->value('unit_name');
			$warehouse = DB::table('qinventory_warehouse')->where('id', $value->warehouse)->value('warehouse_name');
			$brandname = DB::table('qinventory_brand')->where('id', $value->brand)->value('brand_name');
			$manufacturername = DB::table('qinventory_manufacture')->where('id', $value->manufacturer)->value('manufacture_name');
			$categoryname = DB::table('qinvoice_category')->where('id', $value->category)->value('category_name');
			$suppliername = DB::table('qcrm_supplier')->where('id', $value->provider_id)->value('sup_name');


			DB::table('qinventory_products')->where('product_id', $value->product_id)->update([

				'unit_name' => $unit,
				'warehouse_name' => $warehouse,
				'supplier_name' => $suppliername,
				'category_name' => $categoryname,
				'manufacturer_name' => $manufacturername,
				'brand_name' => $brandname

			]);
		}
	}
}

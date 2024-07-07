@extends('inventory.common.layout') @section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">

				<h3 class="kt-portlet__head-title">Product List View</h3>
			</div>
		</div>


		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable dataTable no-footer">
				@foreach($data as $product)

				<tr>
					<td>Product Name :</td>
					<td>{{$product->product_name}}</td>
				</tr>
				<tr>
					<td>Product Code:</td>
					<td>{{$product->product_code}}</td>
				</tr>
				<tr>
					<td>Bar Code:</td>
					<td>{{$product->bar_code}}</td>
				</tr>
				<tr>
					<td>Unit:</td>
					<td>{{$product->unit}}</td>
				</tr>
				<tr>
					<td>Category:</td>
					<td>{{$product->category}}</td>
				</tr>
				<tr>
					<td>Out Of Stock Status:</td>
					<td>{{$product->out_of_stock_status}}</td>
				</tr>
				<tr>
					<td>Product Status:</td>
					<td>{{$product->product_status}}</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>{{$product->description}}</td>
				</tr>
				<tr>
					<td>Opening Stock:</td>
					<td>{{$product->opening_stock}}</td>
				</tr>
				<tr>
					<td>Enable Minus Stock Billing:</td>
					<td>{{$product->enable_minus_stock_billing}}</td>
				</tr>
				<tr>
					<td>Reorder Quantity Alert:</td>
					<td>{{$product->reorder_quantity_alert}}</td>
				</tr>

				<tr>
					<td>Taxable:</td>
					<td>{{$product->taxable}}</td>
				</tr>
				<tr>
					<td>Sales Tax:</td>
					<td>{{$product->sales_tax}}</td>
				</tr>
				<tr>
					<td>Purchase Tax:</td>
					<td>{{$product->purchase_tax}}</td>
				</tr>
				<tr>
					<td>Item Type:</td>
					<td>{{$product->item_type}}</td>
				</tr>
				<tr>
					<td>Refundable:</td>
					<td>{{$product->refundable}}</td>
				</tr>
				<tr>
					<td>Manufacturer:</td>
					<td>{{$product->manufacturer}}</td>
				</tr>
				<tr>
					<td>Brand:</td>
					<td>{{$product->brand}}</td>
				</tr>

				<tr>
					<td>Serial Number:</td>
					<td>{{$product->serial_number}}</td>
				</tr>
				<tr>
					<td>Model No:</td>
					<td>{{$product->model_no}}</td>
				</tr>
				<tr>
					<td>Part No:</td>
					<td>{{$product->part_no}}</td>
				</tr>
				<tr>
					<td>Maintain Bathes:</td>
					<td>{{$product->maintain_bathes}}</td>
				</tr>
				<tr>
					<td>Batch Lot No:</td>
					<td>{{$product->batch_lot_no}}</td>
				</tr>
				<tr>
					<td>Manufacturing Date:</td>
					<td>{{$product->manufacturing_date}}</td>
				</tr>

				<tr>
					<td>Expiry Date:</td>
					<td>{{$product->expiry_date}}</td>
				</tr>
				<tr>
					<td>Expiry Reminder:</td>
					<td>{{$product->expiry_reminder}}</td>
				</tr>

				<tr>
					<td>Warranty Date:</td>
					<td>{{$product->warranty_date}}</td>
				</tr>
				<tr>
					<td>Warranty Reminder:</td>
					<td>{{$product->warranty_reminder}}</td>
				</tr>
				<tr>
					<td>sku:</td>
					<td>{{$product->sku}}</td>
				</tr>
				<tr>
					<td>upc:</td>
					<td>{{$product->upc}}</td>
				</tr>
				<tr>
					<td>ean:</td>
					<td>{{$product->ean}}</td>
				</tr>
				<tr>
					<td>jan:</td>
					<td>{{$product->jan}}</td>
				</tr>
				<tr>
					<td>isbn:</td>
					<td>{{$product->isbn}}</td>
				</tr>
				<tr>
					<td>mbn:</td>
					<td>{{$product->mbn}}</td>
				</tr>
				<tr>
					<td>Sales Accountant:</td>
					<td>{{$product->sales_accountant}}</td>
				</tr>
				<tr>
					<td>Purchase Accountant:</td>
					<td>{{$product->purchase_accountant}}</td>
				</tr>
				<tr>
					<td>Inventory Accountant:</td>
					<td>{{$product->inventory_accountant}}</td>
				</tr>
				<tr>
					<td>Stock:</td>
					<td>{{$product->stock}}</td>
				</tr>
				<tr>
					<td>Sales Price:</td>
					<td>{{$product->sales_price}}</td>
				</tr>
				<tr>
					<td>Batch:</td>
					<td>{{$product->batch}}</td>
				</tr>
				<tr>
					<td>Warehouse:</td>
					<td>{{$product->warehouse}}</td>
				</tr>
				<tr>
					<td>Store:</td>
					<td>{{$product->store}}</td>
				</tr>
				<tr>
					<td>Rack:</td>
					<td>{{$product->rack}}</td>
				</tr>
				<tr>
					<td>Variant:</td>
					<td>{{$product->variant}}</td>
				</tr>



				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection
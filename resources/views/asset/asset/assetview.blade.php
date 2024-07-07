@extends('asset.common.layout') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	li.nav-item {
		width: 140px;
}
</style>
<?php
foreach($assets as $assetss)
{
$assetid = $assetss->id;
$assetname = $assetss->asset_name;
$slno = $assetss->slno;
$modelno = $assetss->modelno;
$partno = $assetss->partno;
$hsncode = $assetss->hsncode;
$upc = $assetss->upc;
$ean = $assetss->ean;
$jan = $assetss->jan;
$isbn = $assetss->isbn;
$mpn = $assetss->mpn;
$asset_type = $assetss->asset_type;	
$consumable = $assetss->consumable;
$inv_type = $assetss->inv_type;
$assetgroup = $assetss->asgroup;
$categ = $assetss->category;
$awarehouse = $assetss->warehouse;
$type = $assetss->type;
$astore = $assetss->store;
$arack = $assetss->rack;
$aunit = $assetss->unit;
$amanufaturer = $assetss->manufaturer;
$asupplier = $assetss->supplier;
$abrand = $assetss->brand;
$aimage = $assetss->image;
}

?>
<?php
// print_r($asset_parts);
//print_r($parts);
?>
<input type="hidden" name="asset_id" id="asset_id" value="{{$assetid}}">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
		</div>
	   
	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Asset Details
				</h3>
			</div>

		</div> 

		<div class="kt-portlet__body">

			<form class="kt-form" id="kt_form">

				<div class="row" style="padding-bottom: 6px;">

					<div class="kt-portlet">

						<div class="kt-portlet__body">
							<ul class="nav nav-tabs  nav-tabs-line" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#basic_details" role="tab">{{ __('mainproducts.Basic Details') }}</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#stock_details" role="tab">Parts</a>
								</li>

								

								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#product_variant" role="tab">
										Components</a>
								</li>

								

								

								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#batch_details" role="tab">O & M
										 </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#expiry_warranty" role="tab">Identification
										  </a>
								</li>

							
							
								<!-- <li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#accounting_configuration" role="tab">{{ __('mainproducts.Accounts Configuration') }}</a>
								</li> -->
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="basic_details" role="tabpanel">
									<div class="row">
								



								


									<div class="col-lg-6 pr-md-3">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Asset Name</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$assetname}}
											</div>
										</div>
									</div>

								


								<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Physical/Digital </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													  <?php
										if($asset_type == 1)
										{
											echo "Physical";
											
							   			}
							   if($asset_type == 2)
										{
											echo "Digital";
											
							  	}
										?>
												</div>
											</div>
										</div>
									</div>

											<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Consumable </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													  <?php
			if($consumable == 1)
			{
				echo "Yes";
				
   }
   if($consumable == 2)
			{
				echo "No";
			
  	}
			?> 
													 
													
												</div>
											</div>
										</div>
									</div>

											<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Inventory Type </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													 <?php
			if($inv_type == 1)
			{
				echo "Inventory";
				
   }
   if($inv_type == 2)
			{
				echo "Non Inventory";
				
  	}
			?> 
													  
													
												</div>
											</div>
										</div>
									</div>

							<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Group </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													 
													 
													 @foreach($asgroup as $data)
												  @if($assetgroup == $data->id)
												  	{{$data->name}}
												   @endif
												@endforeach
													
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Category </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													  @foreach($category as $data)
												  @if($categ == $data->id)
												  {{$data->name}} @endif
												@endforeach
 
												</div>
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Warehouse </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													  @foreach($warehouse as $data)
												  @if($awarehouse == $data->id) 
												  	{{$data->warehouse_name}} @endif
												@endforeach
 
												</div>
											</div>
										</div>
									</div>

										<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Asset Type </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
 @foreach($type1 as $data)
												  @if($type == $data->id) {{$data->name}}@endif
												@endforeach
													
												</div>
											</div>
										</div>
									</div>

									




									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Store </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
 @foreach($store as $data)
												  @if($astore == $data->id) {{$data->store_name}}@endif
												@endforeach
													
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Rack </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													   @foreach($rack as $data)
												 @if($aunit == $data->id)  {{$data->rack_name}}@endif
												@endforeach

												</div>
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Unit </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
 @foreach($unit as $data)
												  @if($assetgroup == $data->id)  {{$data->unit_name}}@endif
												@endforeach
													
												</div>
											</div>
										</div>
									</div>

 					<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Manufacturer </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
 @foreach($manufacturer as $data)
												  @if($amanufaturer == $data->id)  {{$data->manufacture_name}}@endif
												@endforeach
												
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Supplier </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
													  @foreach($supplier as $data)
												  @if($asupplier == $data->id)  {{$data->sup_name}}@endif
												@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Brand </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
 @foreach($brand as $data)
												  @if($abrand == $data->id) 
												  	{{$data->brand_name}}
												  @endif
												@endforeach
													
												</div>
											</div>
										</div>
									</div>

									
										<!-- <div class="col-lg-6 pr-md-3">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Quantity<span style="color: red">*</span></label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="quantity" id="quantity" placeholder="">
											</div>
										</div>
									</div> -->


									<!-- more-->

									
									
								
								<!-- more -->





								</div>

								</div>
								<div class="tab-pane" id="stock_details" role="tabpanel">
									<div class="row">




										<table class="table table-striped table-hover" id="modeofpaymenttable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Part Name</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Expiry</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Reminder Days</th>
											
												 <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
												 width: 30px;">
													<!-- <div class="kt-demo-icon__preview addmorepayments pluseb">
															<i class="fa fa-plus" style="color: white;"></i>
														</div> --></th>
											</tr>
											</thead>
											
											@foreach($asset_parts as $key=>$asset_partss)
											
											<tr>
					  <td class="row_count" id="rowcount" style="padding: 0;">{{$key+1}}
<input type="hidden" class="form-control" name="part_id[]" id="part_id{{$key+1}}"  data-id='{{$key+1}}' value="{{$asset_partss->id}}">
					  </td>

					  <td style="padding: 0;">
					  
					  	@foreach($parts as $data)
												  @if($asset_partss->part_name == $data->id)  
													{{$data->part_name}}
												@endif
												@endforeach
					   
					  
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					  {{$asset_partss->part_date}}
					  </div>
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					  {{$asset_partss->reminderdays}}
					  </div>
					  </td>
					  </tr>
					  
					  @endforeach

										</table>
					
					
									



									






									</div>
								</div>
								

								<div class="tab-pane" id="product_variant" role="tabpanel">
									





										<table class="table table-striped table-hover" id="componentstable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Component Name</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Expiry</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Reminder Days</th>
											
												 <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
												 width: 30px;"></th>
											</tr>
											</thead>
										@foreach($asset_components as $key=>$asset_componentss)
											
											<tr>
					  <td class="row_count" id="rowcount" style="padding: 0;">{{$key+1}}
<input type="hidden" class="form-control" name="components_id[]" id="components_id{{$key+1}}"  data-id='{{$key+1}}' value="{{$asset_componentss->id}}">
					  </td>
					  <td style="padding: 0;">
					  
					  	@foreach($components as $data)
												 @if($asset_componentss->component_name == $data->id) {{$data->component_name}}@endif
												@endforeach
					   
					  </select>
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					  {{$asset_componentss->component_date}}
					  </div>
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					  {{$asset_componentss->reminderdays}}
					  </div>
					  </td>
					  </tr>
					  
					  @endforeach
										</table>
					
					
									



									






									
								</div>

								

								<div class="tab-pane" id="batch_details" role="tabpanel">
									<div class="row">
										<table class="table table-striped table-hover" id="servicetable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Service Name</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Date</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Reminder Days</th>
											
												 <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
												 width: 30px;"></th>
											</tr>
											</thead>
										@foreach($asset_services as $key=>$asset_servicess)
											
											<tr>
					  <td class="row_count" id="rowcount" style="padding: 0;">{{$key+1}}
<input type="hidden" class="form-control" name="service_id[]" id="service_id{{$key+1}}"  data-id='{{$key+1}}' value="{{$asset_servicess->id}}">
					  </td>
					  <td style="padding: 0;">
					  
					  	@foreach($services as $data)
												  @if($asset_servicess->service_name == $data->id) {{$data->service_name}}@endif
												@endforeach
					   
					  </select>
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					  {{$asset_servicess->service_date}}
					  </div>
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					 {{$asset_servicess->reminderdays}}
					  </div>
					  </td>
					  </tr>
					  
					  @endforeach
										</table>
					
									</div>

								</div>

						

								<div class="tab-pane" id="expiry_warranty" role="tabpanel">
									<div class="row">



									
									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Barcode Format </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													
												</div>
											</div>
										</div>
									</div>

							<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Serial Number</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$slno}}
											</div>
										</div>
									</div>

							<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Model No</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$modelno}}
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Part No</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$partno}}
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>HSN Code</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$hsncode}}
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>UPC</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$upc}}
											</div>
										</div>
									</div>


								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>EAN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$ean}}
											</div>
										</div>
									</div>


								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>JAN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$jan}}
											</div>
										</div>
									</div>


									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>ISBN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$isbn}}
											</div>
										</div>
									</div>


								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>MPN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												{{$mpn}}
											</div>
										</div>
									</div>


								</div>
								</div>

							
							  

						   </div>
						</div>
					</div>
				</div>




				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">

							</div>
							
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}
	
	.error {
		color: red
	}
</style>
<!--end::Modal-->
@endsection @section('script')
<script type="text/javascript">
   function goPrev()
	{
  window.history.back();
  }




</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/tagify.js" type="text/javascript"></script>
<script type="text/javascript">
	var tr_count = 1;
	

	
	


</script>
<script type="text/javascript">
	$(document).ready(function() {
	$('.kt-select2').select2();
});
</script>
<script type="text/javascript">

		
	

</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/asset/asset.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>





@endsection
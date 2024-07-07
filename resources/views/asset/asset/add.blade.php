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
									<a class="nav-link" data-toggle="tab" href="#product_details" role="tab">Document Vault</a>
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
												<label>Asset Name<span style="color: red">*</span></label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="asset_name" id="asset_name" placeholder="Asset Name">
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
													<select name="asset_type" id="asset_type" class="form-control single-select asset_type kt-selectpicker">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  <option value="1">Physical</option>   
													  <option value="2">Digital</option>   

													</select>
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
													<select name="consumable" id="consumable" class="form-control single-select consumable kt-selectpicker">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  <option value="1">Yes</option>   
													  <option value="2">No</option> 
													</select>
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
													<select name="inv_type" id="inv_type" class="form-control single-select inv_type kt-selectpicker">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  <option value="1">Inventory</option>   
													  <option value="2">Non Inventory</option> 
													</select>
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
													<select name="group" id="group" class="form-control single-select  kt-selectpicker group">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  @foreach($group as $data)
              <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach

													</select>
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
													<select name="category" id="category" class="form-control single-select  kt-selectpicker category">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($category as $data)
              <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach
													</select>
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
													<select name="warehouse" id="warehouse" class="form-control single-select  kt-selectpicker warehouse">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($warehouse as $data)
              <option value="{{$data->id}}">{{$data->warehouse_name}}</option>
              @endforeach
													</select>
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
													<select name="type" id="type" class="form-control single-select  kt-selectpicker type">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($type as $data)
              <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach
													</select>
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
													<select name="store" id="store" class="form-control single-select  kt-selectpicker store">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($store as $data)
              <option value="{{$data->id}}">{{$data->store_name}}</option>
              @endforeach
													</select>
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
													<select name="rack" id="rack" class="form-control single-select  kt-selectpicker rack">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													   @foreach($rack as $data)
              <option value="{{$data->id}}">{{$data->rack_name}}</option>
              @endforeach

													</select>
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
													<select name="unit" id="unit" class="form-control single-select  kt-selectpicker unit">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($unit as $data)
              <option value="{{$data->id}}">{{$data->unit_name}}</option>
              @endforeach
													</select>
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
													<select name="manufaturer" id="manufaturer" class="form-control single-select  kt-selectpicker manufaturer">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($manufacturer as $data)
              <option value="{{$data->id}}">{{$data->manufacture_name}}</option>
              @endforeach
													</select>
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
													<select name="supplier" id="supplier" class="form-control single-select  kt-selectpicker supplier">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  @foreach($supplier as $data)
              <option value="{{$data->id}}">{{$data->sup_name}}</option>
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
													<select name="brand" id="brand" class="form-control single-select  kt-selectpicker brand">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  
 @foreach($brand as $data)
              <option value="{{$data->id}}">{{$data->brand_name}}</option>
              @endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
			<div class="col-lg-6 pr-md-3">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Asset cost</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="asset_cost" id="asset_cost" placeholder="">
											</div>
										</div>
									</div>

											<div class="col-lg-6 pr-md-3">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Purchase Date</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control kt_datetimepickerr" name="purchase_date" id="purchase_date" placeholder="">
											</div>
										</div>
									</div>

								
										<div class="col-lg-6 pr-md-3">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Inbound Date</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control kt_datetimepickerr" name="inbound_date" id="inbound_date" placeholder="">
											</div>
										</div>
									</div>
									
										<div class="col-lg-6 pr-md-3">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Quantity<span style="color: red">*</span></label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="quantity" id="quantity" placeholder="">
											</div>
										</div>
									</div>


									<!-- more-->

									
									<div class="col-lg-12">
										<div class="kt-section__content">
											<table class="table" id="variant_table">
												<thead>
													<tr>
														<th>#</th>
														<th>Asset Name</th>
														<th>Asset Code</th>
														<th>{{ __('mainproducts.Barcode') }}</th>
														<th>Tag</th>
														
														
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
								
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
												 width: 30px;">Action
													<!-- <div class="kt-demo-icon__preview addmorepayments pluseb">
															<i class="fa fa-plus" style="color: white;"></i>
														</div> --></th>
											</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
					<table style="width:100%;">
						<tr>
							<td>
								<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right" ><i class="la la-plus"></i>Add More</button>
							</td>
						</tr>
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
												 width: 30px;">Action</th>
											</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
					<table style="width:100%;">
						<tr>
							<td>
								<button type="button" class="addmorecomponents pluseb btn btn-brand btn-elevate btn-icon-sm  float-right" ><i class="la la-plus"></i>Add More</button>
							</td>
						</tr>
					</table>
					
									



									






									
								</div>

								<div class="tab-pane" id="product_details" role="tabpanel">
									   <div class="form-group row">
								   <div class="col-lg-12">
								   <input type="hidden" name="fileData" id="fileData"/>
								   <div id="choose-files">
								   <form action="/upload">
								   <input type="file" id="files" name="files[]" accept="image/*"/>
									</form>
								   </div>
								   </div>
								   </div>

								   <div class="kt-portlet__foot">
								   <div class="kt-form__actions">
								   <div class="row">
								   <div class="col-lg-4"></div>
								   <div class="col-lg-8">



								   </div>
								   </div>
								   </div>
								   </div> 
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
												 width: 30px;">Action</th>
											</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
					<table style="width:100%;">
						<tr>
							<td>
								<button type="button" class="addmoreservice pluseb btn btn-brand btn-elevate btn-icon-sm  float-right" ><i class="la la-plus"></i>Add More</button>
							</td>
						</tr>
					</table>
									</div>

								</div>

						

								<div class="tab-pane" id="expiry_warranty" role="tabpanel">
									<div class="row">



									
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Manufacturing Date </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<input type="text" class="form-control kt_datetimepickerr" name="barcodeformat" id="barcodeformat" placeholder="">
													
													<!-- <select name="barcodeformat" id="barcodeformat" class="form-control single-select  kt-selectpicker">
													  <option value="">{{ __('mainproducts.Select') }}</option> 
													  

													</select> -->
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
												<input type="text" class="form-control" name="slno" id="slno" placeholder="">
											</div>
										</div>
									</div>

							<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Model No</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="modelno" id="modelno" placeholder="">
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Part No</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="partno" id="partno" placeholder="">
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>HSN Code</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="hsncode" id="hsncode" placeholder="">
											</div>
										</div>
									</div>

								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>UPC</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="upc" id="upc" placeholder="">
											</div>
										</div>
									</div>


								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>EAN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="ean" id="ean" placeholder="">
											</div>
										</div>
									</div>


								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>JAN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="jan" id="jan" placeholder="">
											</div>
										</div>
									</div>


									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>ISBN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="isbn" id="isbn" placeholder="">
											</div>
										</div>
									</div>


								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>MPN</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="mpn" id="mpn" placeholder="">
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
							<div class="col-lg-6 kt-align-right">
								<button type="submit" name="product_submit" id="product_submit" class="btn btn-primary  float-right "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('mainproducts.Save') }}</button>
								<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  {{ __('mainproducts.Cancel') }}</button>


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
$(document.body).on("change", ".unit", function() 
	{
		var unit = $(this).val();
	
		$.ajax({
		url: "getsellingunits",
		method: "POST",
		data: {
			_token: $('#token').val(),
			id:unit
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('#selling_units').empty();
		   
			$.each(data, function(key, value) {
						$('#selling_units').append('<option value="'+ value.id +'">'+ value.unit_name +'</option>');
						});

		}
	})
	}); 



$("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
	   var siblings = row.siblings();
	   row.remove();
	   siblings.each(function(index) {
		 $(this).children().first().text(index);
	   });
  
  calculate();
});


$(document.body).on("change", "input[type=radio][name=sup_vendor]", function() 
	{

		


		var checkedValue = $('input[name="sup_vendor"]:checked').val();
			//	alert(checkedValue);
		$.ajax({
		url: "getsupplier_vendor1",
		method: "POST",
		data: {
			_token: $('#token').val(),
			id:checkedValue
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('select[name="sup_vendorname"]').empty();
			$.each(data, function(key, value) {
						$('select[name="sup_vendorname"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
						});

		}
	})
	}); 


$(document.body).on("change", "input[type=radio][name=reorder_quantity_alert]", function() 
	{

		var checkedValue = $('input[name="reorder_quantity_alert"]:checked').val();


		if(checkedValue == 1)
		{

			$('#alert_quantity').removeAttr('disabled'); //Enable
		}
		else
		{
			$('#alert_quantity').val("");
			$('#alert_quantity').attr('disabled', 'disabled'); //Disable

		}
		
	}); 


$(document.body).on("click", ".productadd", function() 
	{
		// var unit = $(this).val();
	
		$.ajax({
		url: "ProductCode",
		method: "GET",
		data: {
			_token: $('#token').val(),
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('#asset_code').val(data);
			$('#barcode').val(data);
			
		}
	})
	});

function variantproductcodeadd(cc)
{
	
		$.ajax({
		url: "ProductCode",
		method: "GET",
		data: {
			_token: $('#token').val(),
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('#variantproductcode_textbox'+cc+'').val(data);
			$('#variantsku_textbox'+cc+'').val(data);
			$('#variantbarcode_textbox'+cc+'').val(data);
			
		}
	})	
}
		
	

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

<script type="text/javascript">
	$(document).ready(function(){
	  var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
	$(".addmorepayments").click(function() 
		{
		
	  var sl = ($("#modeofpaymenttable > tbody > tr").length)+1;

		   
			var payment = '';
			payment += '<tr>\
					  <td class="row_count pt-2 pl-2" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <select class="form-control part-tags" name="part_name[]" id="part_name'+rowcount+'" data-id='+rowcount+'>\
					   @foreach($parts as $data)\
              <option value="{{$data->id}}">{{$data->part_name}}</option>\
              @endforeach\
					  </select>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control kt_datetimepickerr" name="part_date[]" id="part_date'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control" name="reminderdaysparts[]" id="reminderdaysparts'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\  <td class="pt-1 pb-1">\
                      <div class="kt-demo-icon__preview premove">\
                        <i class="fa fa-trash" id="" style="color: red;padding-left: 30%;"></i>\
                     </div>\
                      </td>\
					  </tr>';
		
					   $('#modeofpaymenttable').append(payment);

					  



					   rowcount++;
					   $(".part-tags").select2({
  tags: true
})
					   		$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
})


});

   //component

    var rowcount = ($("#componentstable > tbody > tr").length);
	$(".addmorecomponents").click(function() 
		{
		
	  var sl = ($("#componentstable > tbody > tr").length)+1;

		   
			var component = '';
			component += '<tr>\
					  <td class="row_count pt-2 pl-2" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <select class="form-control part-tags" name="component[]" id="component'+rowcount+'" data-id='+rowcount+'>\
					  @foreach($components as $data)\
              <option value="{{$data->id}}">{{$data->component_name}}</option>\
              @endforeach\
					  </select>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control kt_datetimepickerr" name="component_date[]" id="component_date'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
					   <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control" name="reminderdayscomponenet[]" id="reminderdayscomponenet'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\<td class="pt-1 pb-1">\
                      <div class="kt-demo-icon__preview cremove">\
                        <i class="fa fa-trash" id="" style="color: red;padding-left: 30%;"></i>\
                     </div>\
                      </td>\
					  </tr>';
		
					   $('#componentstable').append(component);

					  



					   rowcount++;
					   $(".part-tags").select2({
  tags: true
})
					   		$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
})


});


   //

   				  //service

    var rowcount = ($("#servicetable > tbody > tr").length);
	$(".addmoreservice").click(function() 
		{
		
	  var sl = ($("#servicetable > tbody > tr").length)+1;

		   
			var service = '';
			service += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <input class="form-control form-control-sm" name="service_name[]" id="service_name'+rowcount+'" data-id='+rowcount+'>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control  form-control-sm kt_datetimepickerr" name="service_date[]" id="service_date'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control" name="reminderdaysservice[]" id="reminderdaysservice'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td class="pb-1 pt-1">\
                      <div class="kt-demo-icon__preview sremove">\
                        <i class="fa fa-trash" id="" style="color: red;padding-left: 30%;"></i>\
                     </div>\
                      </td>\
					  </tr>';
		
					   $('#servicetable').append(service);

					  



					   rowcount++;
					 $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
})


});


   //


 });
</script>


<script type="text/javascript">
	$(document).ready(function(){
	$(".part-tags").select2({
  tags: true
})
	  });

		$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

  $('body').on('focus',".kt_datetimepickerr", function(){

  $(this).datepicker();
});




const uppy = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: true,
    // meta: {
    //         UniqueID       : $('#UniqueID').val()
    //     },
  onBeforeUpload   : (files) => {
                      fileData           = [];
                      const updatedFiles = {};

                      Object.keys(files).forEach(fileID => {
                            fileData.push('AssetFileUpload/'+files[fileID].name )
                      })
                      //return updatedFiles
                      $('#fileData').val(fileData);

                    },

})

uppy.use(Uppy.Dashboard, {
   metaFields: [
    { id: 'name', name: 'Name', placeholder: 'File name' },
    { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
  ],
  browserBackButtonClose: true,
  target: '#choose-files',
  inline: true,
  replaceTargetContent: true,
  width:'100%'
})
uppy.use(Uppy.GoogleDrive,
  { target: Uppy.Dashboard,
   companionUrl: 'https://companion.uppy.io'
  })
uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
uppy.use(Uppy.XHRUpload, {
  endpoint: 'AssetFileUpload',
  // UniqueID       : $('#UniqueID').val(),
  fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
         // UniqueID       : $('#UniqueID').val()
    }
})


    
    if ($('#fileData').val() != '') {
        var img_array = $('#fileData').val().split(",");
        console.log(img_array);
        $.each(img_array, function(i) {
            onuppyImageClicked('public/' + img_array[i]);
        });
    }

    function onuppyImageClicked(img) {

        var str = img.toString();
        var n = str.lastIndexOf('/');
        var img_name = str.substring(n + 1);
        // assuming the image lives on a server somewhere
        return fetch(img)
            .then((response) => response.blob()) // returns a Blob
            .then((blob) => {
                uppy.addFile({
                    name: img_name,
                    type: 'image/jpeg',
                    data: blob
                })
            })
    }



//

$('#quantity').change(function() {
	//$("#addoption").click(function() {
	// $('tbody', this).deleteRow();
	$("#variant_table > tbody").empty()
	tr_count = ($("#variant_table > tbody > tr").length) 
		var quantity = $('#quantity').val();
		var asset_name = $('#asset_name').val();
	
		if (quantity=="") 
       {
       $('#quantity').addClass('is-invalid');
        toastr.warning('Quantity is required.');
        
       return false;
       } 
       else
       {
          $('#quantity').removeClass('is-invalid');
       } 

       if (asset_name=="") 
       {
       $('#asset_name').addClass('is-invalid');
        toastr.warning('Asset_name name is required.');
        
       return false;
       } 
       else
       {
          $('#asset_name').removeClass('is-invalid');
       } 


	
		for (i = 0; i < quantity; i++) {


			all_options=asset_name+' '+'-'+' '+tr_count;
			//if ('Type and hit Enter' != option_value) {
			//	var all_options = productname+" - "+option_value;
				// option_array.push(option_value);
				$("#variant_table").each(function() {

			var tds = '<tr id=tr' + tr_count + '>';
			tds += '<td class="count" id=count' + tr_count + '>' + tr_count + '</td>' + '<td class="option" id=option' + tr_count + '>' + all_options + '<input type="hidden" class="form-control option_textbox" name="option[]" id="option_textbox'+tr_count+'" value="' + all_options + '">'+ '</td>' + '<td class="variantproductcode" id=variantproductcode' + tr_count + '>' + '<input type="text" class="form-control" name="variantproductcode[]" id="variantproductcode_textbox'+tr_count+'" value="" readonly>' + '</td>'+ '<td class="variantbarcode" id=variantbarcode' + tr_count + '>' + '<input type="text"  class="form-control" name="variantbarcode[]" id="variantbarcode_textbox'+tr_count+'" value="">'+ '<td class="varianttag" id=varianttag' + tr_count + '>' + '<input type="text"  class="form-control" name="varianttag[]" id="varianttag_textbox'+tr_count+'" value="">';



			tds += '</tr>';
			if ($('tbody', this).length > 0) {
				$('tbody', this).append(tds);
			} else {
				$(this).append(tds);
			}

	
variantproductcodeadd(tr_count)

		});
		tr_count++;
		duplicate=0;

			//}
			

		}
		
		// var all_options = option_array.join(" - "+productname);
		
		//  $('.option_textbox').each(function(){
		//  if (($(this).val() === all_options)) {
		//  all_options = undefined;
		//  }
		//  });
		 
		// if ((!all_options || 0 === all_options.length)) {
		// 	return false;
		// }

	   // console.log(duplicate);

		




	});



//


    $("body").on("click",".premove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
           $(this).children().first().text(index+1);
       });

           /* var vatamounts = 0;
        $('.vatamount').each(function()
        {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount'+id+'').val();
        
            vatamounts += parseFloat(vatamount);

        });
        $('#totalvatamount').val(vatamounts.toFixed(2));

        
        totalamount_calculate();
        discount_calculate();
final_calculate1();
*/
   
});

</script>

@endsection
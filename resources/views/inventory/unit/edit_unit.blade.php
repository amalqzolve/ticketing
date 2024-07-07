<span style="color: red">*</span>@extends('inventory.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	input[type=checkbox].form-control
	{
		height: calc(0.5em + 1rem + 1px) ;
	}
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ __('product.Edit Unit') }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<?php
								foreach ($datas as $key => $value) {
								 $pro_unitid = $datas->id;
								 $unit_name  =$datas->unit_name;
								 $unit_code  =$datas->unit_code;
								 $unit_value  =$datas->unit_value;
								 $base_unit  =$datas->base_unit;
								 $parent_unit=$datas->parent_unit;
								 $description=$datas->description;
								}
								?>
								<form class="kt-form" id="productunit-form">
								<input type="hidden" name="id" id="id" value="<?php echo $pro_unitid?>">
								 <div class="row" style="padding-bottom: 6px;">
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Unit Name') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="{{ __('product.Unit Name') }}" value="<?php echo $unit_name?>" autocomplete="off"> 
									</div>
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row  pl-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Unit Code') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="unit_code" id="unit_code" placeholder="{{ __('product.Unit Code') }}" value="<?php echo $unit_code?>" autocomplete="off">
									</div>
									</div>
									</div>
									<div class="col-lg-6">

									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Base Unit') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker base_unit" name="base_unit" id="base_unit">
									<?php
										if($base_unit == 1)
										{
											?>
											<option value="1" selected="">Yes</option>
											<option value="2">No</option>
											<?php
										}
										else
										{
											?>
											<option value="1">Yes</option>
											<option value="2" selected="">No</option>
											<?php
										}
									?>
									
									 
									
									</select>
								   <!--  <input type="checkbox" class="form-control" name="base_unit" id="base_unit" placeholder="{{ __('product.Base Unit') }}" value="1" > -->
									</div>
									</div>
									</div>
									<?php
									
									if(isset($parent_unit))
									{
										?>
										<div class="col-lg-6">
									<div class="form-group row  pl-md-3" id="parentunits">
									<div class="col-md-4">
									<label>{{ __('product.Parent Unit') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="parent_unit" id="parent_unit" >
									 <option value="">Select</option>
									 @foreach($parent_units as $item)
									 <option value="{{$item->id}}" 
										<?php 
										if($unit_name)
										{
										echo "selected";
										 }
										?>
										>{{$item->unit_name}}</option>
									 @endforeach
									</select>
									</div>
									</div>
									</div>
									<?php
									}
									?>

									
									
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Unit Value') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="number" class="form-control" name="unit_value" id="unit_value" placeholder="{{ __('product.Unit Value') }}" value="<?php echo $unit_value?>" autocomplete="off">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('app.Note') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<textarea class="form-control" name="description" id="description" autocomplete="off" placeholder="{{ __('app.Note') }}" value=""><?php echo $description?>
									</textarea>
									</div>
									</div>
									</div>
									</div>
								 </div>
 <input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button  id="Productunitsubmit"class="btn btn-primary">{{ __('product.Update') }}</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">{{ __('product.Cancel') }}</button>
														</div>
													</div>
												</div>
											</div>
								</form>
								</div>
							</div>
						</div>
<style type="text/css">
	.hideButton{
	   display: none
	}
	.error{
		color: red
	}
</style>
@endsection
@section('script')
<script type="text/javascript">
   function goPrev()
	{
  window.history.back();
  }
	$(document.body).on("change", ".base_unit", function() 
	{
		var type = $('#base_unit').val();
	
		if(type == 1)
		{
			
			$('#parentunits').hide();
			$('#parent_unit').val("");
		}
		if(type == 2)
		{
			$('#parentunits').show();
			
		}
	});
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/inventory/productunit.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>

@endsection

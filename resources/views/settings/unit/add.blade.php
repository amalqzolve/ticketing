@extends('inventory.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<style type="text/css">
	input[type=checkbox].form-control
	{
		height: calc(0.5em + 1rem + 1px) ;
	}
</style>
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ __('product.New Unit') }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="productunit-form">
								 <div class="row" style="padding-bottom: 6px;">
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Unit Name') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="{{ __('product.Unit Name') }}" autocomplete="off">
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
									<input type="text" class="form-control" name="unit_code" id="unit_code" placeholder="{{ __('product.Unit Code') }}" autocomplete="off" >
									</div>
									</div>
									</div>
									<div class="col-lg-6">

									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Base Unit') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
								  <select class="form-control" name="base_unit" id="base_unit">
									<option value="">{{ __('product.Select') }}</option>
									
									 <option value="1">Yes</option>
									 <option value="2">No</option>
									
									</select>
									</div>
									</div>
									</div>
									<div class="col-lg-6" id="parentunits" style="display: none;">
									<div class="form-group row  pl-md-3" >
									<div class="col-md-4">
									<label>{{ __('product.Parent Unit') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="parent_unit" id="parent_unit">
									<option value="">{{ __('product.Select') }}</option>
									 @foreach($parent_unit as $item)
									 <option value="{{$item->id}}">{{ $item->unit_name}}</option>
									 @endforeach
									</select>
									</div>
									</div>
									</div>
									<div class="col-lg-6">

									<div class="form-group row  pl-md-3">
									<div class="col-md-4">
									<label>{{ __('product.Unit Value') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="number" class="form-control" name="unit_value" id="unit_value" placeholder="{{ __('product.Unit Value') }}" autocomplete="off">
									</div>
									</div>
									</div>
									<div class="col-lg-12">
									<div class="form-group row pr-md-3">
									<div class="col-md-2">
									<label>{{ __('app.Note') }}</label>
									</div>
									<div class="col-md-10 pr-md-0">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="description" id="description" placeholder="{{ __('app.Note') }}" autocomplete="off">
									</div>
									</div>
									</div>
									</div>
								 </div>
<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
								 <div class="kt-portlet__foot pr-0 pl-0 pb-1 pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right ">
															<button  id="Productunitsubmit"class="btn btn-primary float-right "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('product.Save') }}</button>
															 <button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('product.Cancel') }}</button>
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
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/settings/productunit.js" type="text/javascript"></script>
@endsection

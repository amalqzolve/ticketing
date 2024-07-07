@extends('warehouse.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ __('storerack.New Store Keeper') }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="kt_form">
									<input type="hidden" name="id" id="id" value="<?php echo $data->id;?>">
								 <div class="row" style="padding-bottom: 6px;">
									
								   
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('storerack.Store Keeper Name') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="storekeepername" placeholder="{{ __('storerack.Store Keeper Name') }}" id="storekeepername" value="{{$data->name}}">
									</div>
									</div>
									</div>
									 <!-- <div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('storerack.Details') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<textarea class="form-control" name="details" placeholder="{{ __('storerack.Details') }}" id="details"><?php echo $data->details;?></textarea>
									</div>
									</div>
									</div> -->
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('storerack.Store Keeper Code') }} </label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="code" id="code" placeholder="{{ __('warehouse.Manager Code') }}" value="{{$data->code}}">
									</div>
									</div>
									</div>

								   

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.City') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="city" id="city" placeholder="{{ __('warehouse.City') }}" value="{{$data->city}}">
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Country / Region') }} </label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
								   
									<select class="form-control single-select kt-selectpicker" name="country_region" id="country_region">
										<option value="">{{ __('warehouse.select') }}</option>
									@foreach($countries as $item)
											<option value="{{$item->id}}"
												<?php

										 if ($data->country_region == $item->id)
										 {
											 echo "selected";
										 }

										 ?>
												>{{$item->cntry_name}}</option>
										@endforeach
									</select>
									</div>
									</div>
									</div>

								   

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Phone') }}<span style="color: red">*</span> </label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('warehouse.Phone') }}" value="{{$data->phone}}">
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Email') }} </label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="email" id="email" placeholder="{{ __('warehouse.Email') }}" value="{{$data->email}}">
									</div>
									</div>
									</div>
									
		<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">							
								 </div>
								 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="storekeeper_submit" id="storekeeper_submit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('storerack.Save') }}</button>
															<button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('storerack.Cancel') }}</button>
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
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/inventory/rack.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/inventory/storekeeper.js" type="text/javascript"></script>
 
 @endsection

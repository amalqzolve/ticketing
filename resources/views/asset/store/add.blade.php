@extends('asset.common.layout')
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
											{{ __('storerack.New Store Management') }}
										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

																<form class="kt-form" id="kt_form">
																
																 <div class="row" style="padding-bottom: 6px;">
																																

																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Select Warehouse') }}<span style="color: red">*</span></label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<select class="form-control single-select kt-selectpicker" name="warehouse" id="warehouse">
																		 <option value="">{{ __('storerack.Select') }}</option>
																		 @foreach($warehouse as $item)
																						<option value="{{$item->id}}">{{$item->warehouse_name}}</option>
																				@endforeach
																		</select>
																		</div>
																		</div>
																		</div>


																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Store Name') }}<span style="color: red">*</span></label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="storename" id="storename" placeholder="{{ __('storerack.Store Name') }}">

																		</div>
																		</div>
																		</div>
																		</div>

																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Store Manager') }}</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	 
																		 <select class="form-control single-select kt-selectpicker" name="storemanager" id="storemanager">
																		 <option value="">{{ __('storerack.Select') }}</option>
																		 @foreach($manager as $item)
																						<option value="{{$item->id}}">{{$item->name}}</option>
																				@endforeach
																		</select>
																		</div>
																		</div>
																		</div>

																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Store Location') }}</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		 <input type="text" class="form-control" name="storelocation" id="storelocation" placeholder="{{ __('storerack.Store Location') }}">
																		</div>
																		</div>
																		</div>

																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Store in Charge') }}</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		
																		 <select class="form-control single-select kt-selectpicker" name="storeincharge" id="storeincharge">
																		 <option value="">{{ __('storerack.Select') }}</option>
																		 @foreach($incharge as $item)
																						<option value="{{$item->id}}">{{$item->name}}</option>
																				@endforeach
																		</select>
																		</div>
																		</div>
																		</div>

																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Store Keeper') }}</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		 
																		 <select class="form-control single-select kt-selectpicker" name="storekeeper" id="storekeeper">
																		 <option value="">{{ __('storerack.Select') }}</option>
																		 @foreach($keeper as $item)
																						<option value="{{$item->id}}">{{$item->name}}</option>
																				@endforeach
																		</select>
																		</div>
																		</div>
																		</div>

																		<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('storerack.Total Rack Availability') }}</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		 <input type="text" class="form-control" name="rackavailability" id="rackavailability" placeholder="{{ __('storerack.Total Rack Availability') }}">
																		</div>
																		</div>
																		</div>
																		<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>@lang('app.Default')</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="checkbox" name="default" class="form-control" id="default">
									</div>
									</div>
									</div>

																	 
																 </div>

 <input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
																 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" id="storemanagement_submit" name="storemanagement_submit" class="btn btn-primary kt-spinner--sm kt-spinner--light float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('storerack.Save') }}</button>
															<button type="button" class="btn btn-secondary float-right mr-1"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('storerack.Cancel') }}</button>


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
<!--end::Modal-->
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
<script src="{{url('/')}}/resources/js/asset/store.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>

@endsection

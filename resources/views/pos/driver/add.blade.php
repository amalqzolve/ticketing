@extends('pos.common.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
																		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
																	 <div class="kt-container  kt-container--fluid ">
																	 <div class="kt-subheader__main">
																	 <div class="kt-subheader__breadcrumbs">
																	 <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
																	 <span class="kt-subheader__breadcrumbs-separator"></span>

																		<!-- {{ Breadcrumbs::render('NewBrand') }} -->

																	</div>
																	</div>
																
																</div>
																</div>

																<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
																<br/>
																<div class="kt-portlet kt-portlet--mobile">
																<div class="kt-portlet__head kt-portlet__head--lg">
																<div class="kt-portlet__head-label">
																<span class="kt-portlet__head-icon">
																<i class="kt-font-brand flaticon-home-2"></i>
																</span>
																<h3 class="kt-portlet__head-title">
												Driver
																</h3>
																</div>                  
																</div>
																<div class="kt-portlet__body">
																<form class="kt-form" id="brand_form">
															 
																 <div class="row" style="padding-bottom: 6px;">
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Driver Name</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="drivername" id="drivername" class="form-control">
																		</div>
																		</div>
																		</div>
																								<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Phone No</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="phoneno" id="phoneno" class="form-control">
																		</div>
																		</div>
																		</div>
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Nationality</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																<select class="form-control kt-selectpicker" name="country" id="country">
																	<option value="">Select</option>
																	@foreach($country as $countrys)
																	<option value="{{$countrys->id}}">{{$countrys->cntry_name}}</option>
																	@endforeach
																</select>
																		</div>
																		</div>
																		</div>		
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>National ID</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="nationalid" id="nationalid" class="form-control">
																		</div>
																		</div>
																		</div><div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Employee ID</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="employeeid" id="employeeid" class="form-control">
																		</div>
																		</div>
																		</div>						
<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Notes</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="notes" id="notes" class="form-control">
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

						
																 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button id="driversubmit" class="btn btn-primary">{{ __('app.Save') }}</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">{{ __('app.Cancel') }}</button>


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
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/pos/driver.js" type="text/javascript"></script>


@endsection
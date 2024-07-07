@extends('settings.common.layout')
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
											My Acccount
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="kt_form">
								 <div class="row" style="padding-bottom: 6px;">
									
								   
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Activation Date<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									-
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Expiry Date<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									-
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>License Key<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									-
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>License Package</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									-
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>License Amount</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									-
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Remaining Days</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									-
									</div>
									</div>
									</div>

									
									
								 </div>
								
								 <div class="kt-portlet__foot">
												
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/custom/rack.js" type="text/javascript"></script> -->
<!-- <script src="{{url('/')}}/resources/js/custom/select2.js" type="text/javascript"></script>
 -->
<script src="{{url('/')}}/resources/js/settings/currency.js" type="text/javascript"></script>
 
 @endsection

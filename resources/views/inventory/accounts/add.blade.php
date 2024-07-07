@extends('inventory.common.layout')
@section('content')
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
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
											{{ __('accounts.New Account') }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="kt_form">
								 <div class="row" style="padding-bottom: 6px;">
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('accounts.Account Name') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="account_name" id="account_name" placeholder="{{ __('accounts.Account Name') }}" autocomplete="off">
									</div>
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('accounts.Account Code') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="account_code" id="account_code" placeholder="{{ __('accounts.Account Code') }}" autocomplete="off">
									</div>
									</div>
									</div>
									 <div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('accounts.Group Name') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" id="group_name" name="group_name">
									 <option value="">{{ __('accounts.Select') }}</option>
									@foreach ($groups as $key)
											<option value="{{$key->id}}">{{$key->name}}</option>@endforeach</select>
									
									</div>
									</div>
									</div>
									<!-- <div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('app.Note') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<textarea class="form-control" name="description" id="description" autocomplete="off" placeholder="{{ __('app.Note') }}">
									</textarea>
									</div>
									</div>
									</div>
									</div> -->
								 </div>
								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button id="accounts_submit" class="btn btn-primary">{{ __('product.Save') }}</button>
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
on
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/attribute.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/tagify.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/accounts.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
@endsection

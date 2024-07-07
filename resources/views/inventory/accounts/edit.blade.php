@extends('inventory.common.layout')

@section('content')


		   
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
								  <!--  <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

										{{ Breadcrumbs::render('NewAccount') }}

									</div> -->
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
											{{ __('accounts.New Account') }}
										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">


								<form class="kt-form" id="kt_form">
								
								 <div class="row" style="padding-bottom: 6px;">
											 <input type="hidden" name="id" id="id" value="<?php echo $data->id;?>">                   

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('accounts.Account Name') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="account_name" id="account_name" placeholder="{{ __('accounts.Account Name') }}" value="<?php echo $data->account_name;?>">
									</div>
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
											<?php
											if($key->id != $data->group_name)
											{
											?>
											<option value="{{$key->id}}">{{$key->name}}</option>
											<?php
										}
										else
										{
											?>
											<option value="{{$key->id}}" selected>{{$key->name}}</option>
											<?php

										}
										?>
											@endforeach
									</select>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('accounts.Account Code') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="account_code" id="account_code" placeholder="{{ __('accounts.Account Code') }}" value="<?php echo $data->account_code;?>">
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
															<button type="submit" name="accounts_submit" id="accounts_submit" class="btn btn-primary">{{ __('accounts.Save') }}</button>
															<button type="button" class="btn btn-secondary" onclick="accountsedit();">{{ __('accounts.Cancel') }}</button>
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
<!-- 
	<script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/customer.js" type="text/javascript"></script> -->
<script type="text/javascript">
	
  function accountsedit(id) {
  window.location.href = "AccountsList";
}
</script>    
<script src="{{url('/')}}/resources/js/inventory/accounts.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>

@endsection

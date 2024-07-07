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
											{{ __('warehouse.Edit Warehouse') }}
										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

								<form class="kt-form" id="kt_form">
								
								 <div class="row" style="padding-bottom: 6px;">
																
<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data->id;?>">
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Warehouse Name') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="warehousename" id="warehousename" placeholder="{{ __('warehouse.Warehouse Name') }}" value="<?php echo $data->warehouse_name;?>">
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Warehouse Code') }}<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="warehousecode" id="warehousecode" placeholder="{{ __('warehouse.Warehouse Code') }}" value="<?php echo $data->warehouse_code;?>">
									</div>
									</div>
									</div>

										<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Select Manager') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="manager_name" id="manager_name">
									  @foreach($manager as $managers)
									  <?php
									  if($managers->id!=$data->manager)
									  {
										?>
											<option value="{{$managers->id}}">{{$managers->manager_name}}</option>
											<?php
									  }
									  else
									  {
										?>
											<option value="{{$managers->id}}" selected>{{$managers->manager_name}}</option>
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
									<label>{{ __('warehouse.Select Incharge') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="incharge_name" id="incharge_name">
									  @foreach($incharge as $incharges)
									  <?php
									  if($incharges->id!=$data->incharge)
									  {
										?>
											<option value="{{$incharges->id}}">{{$incharges->incharge_name}}</option>
											<?php
									  }
									  else
									  {
										?>
											<option value="{{$incharges->id}}" selected>{{$incharges->incharge_name}}</option>
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
									<label>Address</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="address1" id="address1" placeholder="Address" value="<?php echo $data->address_1;?>">
									</div>
									</div>
									</div>
									</div>

							

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.City') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="city" id="city" placeholder="{{ __('warehouse.City') }}" value="<?php echo $data->city;?>">
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Country') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="country" id="country">
										
										@foreach($countries as $item)

											<?php
											if($data->country!=$item->id)
											{
												?>
											<option value="{{$item->id}}">{{$item->cntry_name}}</option>
											<?php
											}
											else
											{
												?>
											<option value="{{$item->id}}" selected>{{$item->cntry_name}}</option>
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
									<label>{{ __('warehouse.Region') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="region" id="region" placeholder="{{ __('warehouse.Region') }}" value="<?php echo $data->region;?>">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.State') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="state" id="state" placeholder="{{ __('warehouse.State') }}" value="<?php echo $data->state;?>">
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Zip Code') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="{{ __('warehouse.Zip Code') }}" value="<?php echo $data->zipcode;?>">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Phone') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('warehouse.Phone') }}" value="<?php echo $data->phone;?>">
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Email') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="email" id="email" placeholder="{{ __('warehouse.Email') }}" value="<?php echo $data->email;?>">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>@lang('app.Default')</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<?php 

									if($data->warehouse_default == 1)
									{
										?>
										<input type="checkbox" name="default" class="form-control" id="default" checked="">
									<?php
									}
									else
									{
										?>
										<input type="checkbox" name="default" class="form-control" id="default">
									<?php
									}
									?>
									</div>
									</div>
									</div>

							
									 



								 </div>


								 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="warehouse_submit" id="warehouse_submit" class="btn btn-primary float-right "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('warehouse.Save') }}</button>
															<button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('warehouse.Cancel') }}</button>
														</div>
													</div>
												</div>
											</div>
								</form>
								
<!-- <input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}"> -->

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
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/inventory/warehouse.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>

<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

@endsection

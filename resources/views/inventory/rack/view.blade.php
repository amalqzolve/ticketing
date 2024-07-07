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
											{{ __('rackmanagement.Rack Management') }}
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
									<label>{{ __('rackmanagement.Select Warehouse') }}</label>
									</div> 
									<div class="col-md-4">
									:
									</div>  
									<div class="col-md-4 input-group input-group-sm">
									
									 @foreach($warehouse as $item)
									 
									 @if($item->id==$data->warehouse)
									 {{$item->warehouse_name}}
									 @endif
										@endforeach
									</select>
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('rackmanagement.Select Store') }}</label>
									</div>
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4 input-group input-group-sm">
									
									@foreach($store as $item)
									
									@if($item->id==$data->store)
									{{$item->store_name}}
									@endif
										@endforeach

									</select>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('rackmanagement.Rack Name') }}</label>
									</div>
									<div class="col-md-4">
									:
									</div>  
									<div class="col-md-4 input-group input-group-sm">
									<?php echo $data->rack_name;?>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('rackmanagement.Rack Manager') }}</label>
									</div>  
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4 input-group input-group-sm">
									
									@foreach($rackmanager as $item)
									
									@if($item->id==$data->rack_manager)
									{{$item->name}}
									@endif
										@endforeach
									</select>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('rackmanagement.Rack In Charge') }}</label>
									</div>  
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4 input-group input-group-sm">
									 
									@foreach($rackincharge as $item)
									
									@if($item->id==$data->rack_in_charge)
									{{$item->name}}
									@endif
										@endforeach
									 </select>
									</div>
									</div>
									</div>
<input type="hidden" class="form-control" name="branch" value="{{$branch}}" id="branch">
									

								   
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
	function RackManagement()
	{
		window.location.href="RackManagement";
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
<script src="{{url('/')}}/resources/js/inventory/rack.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>

@endsection

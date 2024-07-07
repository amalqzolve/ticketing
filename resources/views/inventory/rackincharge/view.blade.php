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
											{{ __('rackmanagement.Rack Incharge') }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="kt_form">
								 <div class="row" style="padding-bottom: 6px;">
									
								   <input type="hidden" name="id" id="id" value="{{$data->id}}">
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('rackmanagement.Incharge Name') }}</label>
									</div>  
									<div class="col-md-4">
									:
									</div>  
									<div class="col-md-4 input-group input-group-sm">
									{{$data->name}}
									</div>
									</div>
									</div>
									<!--  <div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('storerack.Details') }}</label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<textarea class="form-control" name="details" placeholder="{{ __('storerack.Details') }}" id="details"></textarea>
									</div>
									</div>
									</div> -->
									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Code') }}</label>
									</div>  
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4 input-group input-group-sm">
									{{$data->code}}
									</div>
									</div>
									</div>

								   

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.City') }}</label>
									</div>
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4">
									<div class="input-group input-group-sm">
									{{$data->city}}
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Country / Region') }}</label>
									</div>  
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4 input-group input-group-sm">
								   
									
										@foreach($countries as $item)
										@if ($data->country_region == $item->id)
										{{$item->cntry_name}}
										@endif
										@endforeach
									
									</select>
									</div>
									</div>
									</div>

								   

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Phone') }}</label>
									</div>
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4">
									<div class="input-group input-group-sm">
									{{$data->phone}}
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>{{ __('warehouse.Email') }}</label>
									</div>  
									<div class="col-md-4">
									:
									</div>
									<div class="col-md-4 input-group input-group-sm">
									{{$data->email}}
									</div>
									</div>
									</div>
								 </div>
								 
									 </form>
								</div>
							</div>
						</div>
						<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
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

<script src="{{url('/')}}/resources/js/inventory/rackincharge.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/select2.js" type="text/javascript"></script>

 
 @endsection

@extends('inventory.common.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
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
																						{{ __('product.Edit Brand') }}
																				</h3>
																		</div>
																</div>
																<div class="kt-portlet__body">
																 <!-- <?php
																	foreach ($data as $key => $value)
																	{
																			$id = $data->id;
																			$brand_name = $data->brand_name;
																			$brand_code = $data->brand_code;
																			$logo = $data->logo;
																			$vendor = $data->vendor;
																	}
																	?> -->
																<form class="kt-form" id="brand_form">
																<input type="hidden" name="id" id="id" value="<?php echo $data->id; ?>">
																 <div class="row" style="padding-bottom: 6px;">

																		<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label>{{ __('product.Brand Name') }}<span style="color: red">*</span></label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="{{ __('product.Brand Name') }}" autocomplete="off" value="<?php echo $data->brand_name; ?>">
																		</div>
																		</div>
																		</div>
																		</div>
																		<div class="col-lg-6">
																		<div class="form-group row  pl-md-3">
																		<div class="col-md-4">
																		<label>{{ __('product.Brand Code') }}<span style="color: red">*</span></label>
																		</div>
																		<div class="col-md-8 input-group input-group-sm">
																		<input type="text" class="form-control" name="brand_code" id="brand_code" placeholder="{{ __('product.Brand Code') }}" autocomplete="off" value="<?php echo $data->brand_code; ?>">
																		</div>
																		</div>
																		</div>

																<!-- 		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>{{ __('product.Vendor') }}</label>
																		</div>
																		<div class="col-md-8 input-group input-group-sm">
															<select class="form-control single-select kt-selectpicker " name="vendor" id="vendor">
																		 <option value="">{{ __('product.Select') }}</option>
																		 @foreach($vendors as $item)
																			<option value="{{$item->id}}"
																				<?php

																				// if ($data->vendor == $item->id)
																			/*	 {
																						 echo "selected";
																				 }*/

																				 ?>
																				>{{$item->vendor_name}}</option>

																		 @endforeach
																		</select>
																		</div>
																		</div>
																		</div> -->
																		<div class="col-lg-12">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-2">
																		<label>{{ __('app.Note') }}</label>
																		</div>
																		<div class="col-md-10 pl-md-0">
																		<div class="input-group input-group-sm">
																		<textarea class="form-control" name="description" id="description" autocomplete="off" placeholder="{{ __('app.Note') }}" rows="1"> {{$data->description}}
																		</textarea>
																		</div>
																		</div>
																		</div>
																		</div>
																		<div class="col-lg-12">
																	 <div class="form-group">

																	 <input type="hidden" name="fileData" id="fileData" value="<?php echo $data->logo;?>"/>
																	 <div id="choose-files">
																	 <form action="/upload">
																	 <input type="file" id="files" name="files[]" value="<?php echo $data->logo; ?>" />
																	 </form>
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
																 <div class="kt-portlet__foot p-0">
																								<div class="kt-form__actions">
																										<div class="row">
																												<div class="col-lg-6">

																												</div>
																												<div class="col-lg-6 kt-align-right pt-3">
																														<button id="branddetailsubmit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('product.Update') }}</button>
																														<button type="button" class="btn btn-secondary  mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  {{ __('app.Cancel') }}</button>


																												</div>
																										</div>
																								</div>
																						</div>
		<input type="hidden" name="branch" id="branch" value="{{$branch}}">
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
<script src="{{url('/')}}/resources/js/inventory/brand.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>

@endsection

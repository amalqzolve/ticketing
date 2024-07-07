@extends('asset.common.layout') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	li.nav-item {
		width: 140px;
}
</style>
<?php
$asset_ids=array();
$allocation_date='';
$borrowere='';
$allocation_quantity='';

//echo "<pre>"; print_r($assets_allocation); exit();
foreach ($assets_allocated as $key => $value) {
	$asset_ids[]=$value->assetname;
}
foreach ($assets_allocation as $key => $value) {

$allocation_date=$value->allocation_date;
$borrower=$value->borrower;
$allocation_quantity=$value->allocation_quantity;
$project=$value->project;
$geo_locations=$value->geo_location;
$areas=$value->area;

}

//dd($asset_ids);

?>

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
		</div>

	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Asset Revoke Details
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">



								 <div class="row" style="padding-bottom: 6px;">





									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Asset </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">

									<select class="form-control single-select kt-selectpicker" name="asset_id" id="asset_id" multiple="multiple">




										@foreach($assets as $data)

										 <?php if(in_array($data->id, $asset_ids)){ ?>





              <option value="{{$data->id}}" <?php if(in_array($data->id, $asset_ids)){ echo 'selected'; } ?>>{{$data->asset_name}}</option>

              	 <?php  } ?>



              @endforeach

									</select>
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Allocation Date<span style="color: red">*</span> </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control " name="allocation_date" placeholder="Allocation Date" id="allocation_date" value="{{$allocation_date}}" readonly>
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Return Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control ktdatepicker" name="return_date" id="return_date" placeholder="Return Date">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Borrower </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">

									<select class="form-control single-select kt-selectpicker" name="borrower" id="borrower">
										<option value="">{{ __('warehouse.select') }}</option>
										@foreach($employees as $data)
              <option value="{{$data->id}}" <?php if($borrower==$data->id){ echo 'selected'; } ?>>{{$data->f_name}}</option>
              @endforeach

									</select>
									</div>
									</div>
									</div>


								<!-- 	<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Reason</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="reason" id="reason" placeholder="Reason">
									</div>
									</div>
									</div>
									</div>
 -->



									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Project </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">

									<select class="form-control single-select kt-selectpicker" name="project" id="project">
										<option value="">{{ __('warehouse.select') }}</option>
										@foreach($projects as $data)
              <option value="{{$data->id}}" <?php if($data->id==$project){ echo "selected"; } ?> >{{$data->project_name}}</option>
              @endforeach


									</select>
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Geo Location</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="geo_location" id="geo_location">
										<option value="">{{ __('warehouse.select') }}</option>

										@foreach($geolocation as $data)
              <option value="{{$data->id}}" <?php if($data->id==$geo_locations){ echo "selected"; } ?> >{{$data->name}}</option>
              @endforeach
									</select>
									</div>
									</div>
									</div>
									</div>





									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Area </label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="area" id="area" placeholder="Area">
										<option value="">{{ __('warehouse.select') }}</option>

										@foreach($area as $data)
              <option value="{{$data->id}}" <?php if($data->id==$areas){ echo "selected"; } ?>>{{$data->name}}</option>
              @endforeach
									</select>
									</div>
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Notes </label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="notes" id="notes" placeholder="Notes">
									</div>
									</div>
									</div>
									</div>



<input type="hidden" name="allocationid" id="allocationid" value="{{$allocationid}}">
								 </div>
								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="revoke_submit" id="revoke_submit" class="btn btn-primary  float-right">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                                Save
                                                            </button>
															<button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                Cancel
                                                            </button>
														</div>
													</div>
												</div>

						</div>

						</div>
					</div>
				</div>





		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}
</style>
<!--end::Modal-->
@endsection @section('script')
<script type="text/javascript">
   function goPrev()
	{
  window.history.back();
  }




</script>

</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/asset/asset.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>

<script type="text/javascript">

	$("#borrower").select2({disabled:'readonly'});
	$("#project").select2({disabled:'readonly'});
	$("#geo_location").select2({disabled:'readonly'});
	$("#area").select2({disabled:'readonly'});




	$( "#allocation_quantity" ).keyup(function() {
  var allocation_quantity = $(this).val();
    var available_quantity = document.getElementById("available_quantity").value;
    if (parseInt(allocation_quantity) > parseInt(available_quantity))

    {
         toastr.error('Allocation Quantity Must less or equal to Available Quantity');
        $(this).val("");
    } else {
        // do something
    }
});

</script>
@endsection

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
					Asset O & M Details
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">

	<?php
	$date = date('d-m-Y');
	foreach ($assets as $key => $value) {
		$availability_status=$value->om_status;
		$om_status=$value->availability_status;
	}
	echo $availability_status;
	?>

								 <div class="row" style="padding-bottom: 6px;">





									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Asset </label><span style="color: red">*</span>
									</div>
									<div class="col-md-8 input-group input-group-sm">

									<select class="form-control single-select kt-selectpicker asset_id" name="asset_id" id="asset_id">

										@foreach($assets as $data)
              <option value="{{$data->id}}">{{$data->asset_name}}</option>
              @endforeach

									</select>
									</div>
									</div>
									</div>







								   <div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Status </label><span style="color: red">*</span>
									</div>
									<div class="col-md-8 input-group input-group-sm">

									<select class="form-control single-select kt-selectpicker asset_status" name="asset_status" id="asset_status">

										<option value="Maitenance" <?php if($availability_status=='Maitenance'){ echo "selected"; } ?>>Maitenance</option>
										<option value="Service"  <?php if($availability_status=='Service'){ echo "selected"; } ?>>Service</option>
										<option value="Warranty"  <?php if($availability_status=='Warranty'){ echo "selected"; } ?>>Warranty</option>
										<option value="Outof Warranty"  <?php if($availability_status=='Outof Warranty'){ echo "selected"; } ?>>Outof Warranty</option>
										<option value="Damaged"  <?php if($availability_status=='Damaged'){ echo "selected"; } ?>>Damaged</option>
										<option value="Stolen"  <?php if($availability_status=='Stolen'){ echo "selected"; } ?>>Stolen</option>
										<option value="Scrap"  <?php if($availability_status=='Scrap'){ echo "selected"; } ?>>Scrap</option>
										<option value="Active"  <?php if($availability_status=='Active'){ echo "selected"; } ?>>Active</option>



									</select>
									</div>
									</div>
									</div>


									   <div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Availability Status </label><span style="color: red">*</span>
									</div>
									<div class="col-md-8 input-group input-group-sm">

									<select class="form-control single-select kt-selectpicker availability_status" name="availability_status" id="availability_status">
										<option value="">{{ __('warehouse.select') }}</option>
										<option value="1" <?php if($om_status==1){ echo "selected"; } ?>>Yes</option>
										<option value="2" <?php if($om_status==2){ echo "selected"; } ?>>No</option>


									</select>
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
															<button type="submit" name="asset_status_submit" id="asset_status_submit" class="btn btn-primary float-right ">
																<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Update
															</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">
																<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel
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
$(document).on('change','.borrowertype',function()
		  {

				var customer = $(this).val();

				if(customer == 1)
				{
					$('#borrower').attr('disabled',true);
					$('#borrowername').attr('disabled',false);


				}
				if(customer == 2)
				{
					$('#borrower').attr('disabled',false);
					$('#borrowername').attr('disabled',true);

				}



		  });
$(document).on('change','.asset_id',function()
		  {
		  	var asid = $(this).val();

        $.ajax({
        url: "getassetdetails",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:asid
        },
        dataType: "json",
        success: function(data) {

          $.each(data, function(key, value) {

           cvalue =value.available_quantity;
                        });

          $('#available_quantity').val(cvalue);

        }
    })
		  });

$("#asset_id").select2({disabled:'readonly'});
</script>
@endsection

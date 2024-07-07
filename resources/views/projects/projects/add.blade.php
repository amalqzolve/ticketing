@extends('projects.common.layout')
@section('content')
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
					Projects
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">
			<div class="row" style="padding-bottom: 6px;">
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Client <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<select class="form-control single-select kt-selectpicker" id="client" name="client">
								<option value="">Select</option>
								@foreach($customers as $customers)
								<option value="{{$customers->id}}">{{$customers->cust_name}}</option>
								@endforeach
							</select>

						</div>
					</div>
				</div>


				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Project Name<span style="color: red">*</span> </label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<input type="text" class="form-control" name="projectname" id="projectname">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group row pr-md-3">
						<div class="col-md-2">
							<label>Project Description </label>
						</div>
						<div class="col-md-10 input-group input-group-sm">
							<textarea class="form-control" name="description" id="description"></textarea>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Start Date<span style="color: red">*</span> </label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<input type="text" class="form-control kt_datetimepickerr" name="startdate" id="startdate">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>End Date<span style="color: red">*</span> </label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<input type="text" class="form-control kt_datetimepickerr" name="enddate" id="enddate">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Project Category <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<select class="form-control single-select kt-selectpicker" id="poject_category_id" name="poject_category_id">
								<option value="">Select</option>
								@foreach($category as $categoryValue)
								<option value="{{$categoryValue->id}}">{{$categoryValue->name}}</option>
								@endforeach
							</select>

						</div>
					</div>
				</div>


				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Client's PO Number <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<input type="text" class="form-control number" name="ponumber" id="ponumber" value="">
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Sales Order Value<span style="color: red">*</span> </label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<input type="text" class="form-control" name="bidvalue" id="bidvalue">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Sales Order Date<span style="color: red">*</span> </label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<input type="text" class="form-control kt_datetimepickerr" name="podate" id="podate">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Labels </label>
						</div>
						<div class="col-md-8 input-group input-group-sm">
							<select class="form-control single-select kt-selectpicker" id="labels" name="labels[]" multiple="">
								@foreach($labels as $labelss)
								<option value="{{$labelss->id}}">{{$labelss->title}}</option>
								@endforeach
							</select>

						</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="form-group row pr-md-3">
						<div class="col-md-2">
							<label>Internal Refrence</label>
						</div>
						<div class="col-md-10 input-group input-group-sm">
							<textarea name="internal_ref" id="internal_ref" class="form-control" cols="30" rows="3"></textarea>
						</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="form-group row pr-md-3">
						<div class="col-md-2">
							<label>Notes</label>
						</div>
						<div class="col-md-10 input-group input-group-sm">
							<textarea name="notes" id="notes" class="form-control" cols="30" rows="3"></textarea>
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
							@can('project add-project')
							<button type="submit" name="projectsubmit" id="projectsubmit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
									<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
									<polyline points="22 4 12 14.01 9 11.01"></polyline>
								</svg> Save</button>
							@endcan
							<button type="button" class="btn btn-secondary float-right mr-2" onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
									<line x1="18" y1="6" x2="6" y2="18"></line>
									<line x1="6" y1="6" x2="18" y2="18"></line>
								</svg> Cancel</button>
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
	function goPrev() {
		window.history.back();
	}

	$('.kt_datetimepickerr').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
	})
	$(document).ready(function() {
		$(".ponumber").select2({
			tags: true
		})
	});



	$(document.body).on("change", ".ponumber", function() {
		var salesorder = $(this).val();

		// if(salesorder == "")
		// {
		// 	$('#bidvalue').attr('disabled',false);
		// 	$('#podate').attr('disabled',false);
		// 	$('#po_number').empty();
		// 	$('#po_number').append('<input type="text" class= "form-control" name="ponumber" id="ponumber">');
		// }
		// else
		// {
		// 	$('#bidvalue').attr('disabled',true);
		// 	$('#podate').attr('disabled',true);
		// 	$('#po_number').empty();
		// 	$('#po_number').append('<select class="form-control single-select kt-selectpicker" name="ponumber" id="ponumber"></select>');
		// }
		$.ajax({
			url: "getsalesorder",
			method: "POST",
			data: {
				_token: $('#token').val(),
				salesorder: salesorder,

			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				$('#bidvalue').val("");
				$('#podate').val("");
				$('#bidvalue').attr('disabled', false);
				$('#podate').attr('disabled', false);
				$.each(data, function(key, value) {
					if (value.id == salesorder) {
						$('#bidvalue').attr('disabled', true);
						$('#podate').attr('disabled', true);
						$('#bidvalue').val(value.grandtotalamount);
						$('#podate').val(value.quotedate1);
					}



				});

			}
		})
	});
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

<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/projects.js" type="text/javascript"></script>

@endsection
@extends('boq.common.layout')
@section('content')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">

					Add Group - {{$parent_name}}

				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="id">
				<div class="row" style="padding-bottom: 6px;">
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Group Name<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control productname" name="productname" id="productname" autocomplete="off" value="">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Description</label>
							</div>
							<div class="col-md-8">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control description" name="description" id="description" autocomplete="off" value="">
								</div>
							</div>
						</div>
					</div>
				</div>

				<input type="hidden" name="parent" id="parent" value="{{$parent}}">
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button id="innerboqsubmitgroup" class="btn btn-primary">{{ __('product.Save') }}</button>
								<button type="button" class="btn btn-secondary float-right mr-2 backHome">{{ __('app.Cancel') }}</button>


							</div>
						</div>
					</div>
				</div>
			</form>
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
@endsection
@section('script')
<script type="text/javascript">
	function goPrev() {
		window.history.back();
	}
</script>
<script type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/boq/innerboq.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.list-boq').addClass('kt-menu__item--active');
	$(document).on('click', '#innerboqsubmitgroup', function(e) {
		e.preventDefault();
		productname = $('#productname').val();
		if (productname == "") {
			$('#productname').addClass('is-invalid');
			toastr.warning(" Add group name!");
			return false;
		} else {
			$('#productname').removeClass('is-invalid');
		}
		$(this).addClass('kt-spinner');
		$(this).prop("disabled", true);
		if ($('#id').val()) {
			var sucess_msg = 'Updated';
		} else {
			var sucess_msg = 'Created';
		}
		$.ajax({
			type: "POST",
			url: "{{ route('innerboqsubmitgroup') }}",
			dataType: "json",
			data: {
				_token: $('#token').val(),
				productname: $('#productname').val(),
				description: $('#description').val(),
				total_quantity: $('#total_quantity').val(),
				total_amount: $('#total_amount').val(),
				total_vat: $('#total_vat').val(),
				grandtotal: $('#grandtotal').val(),
				parent: $('#parent').val(),
			},
			success: function(data) {
				$('#innerboqsubmitgroup').removeClass('kt-spinner');
				$('#innerboqsubmitgroup').prop("disabled", false);
				toastr.success('Group ' + sucess_msg + ' successfuly');
				window.location.href = document.referrer;
			},
			error: function(jqXhr, json, errorThrown) {
				console.log('Error !!');
			}
		});
	});
</script>
@endsection
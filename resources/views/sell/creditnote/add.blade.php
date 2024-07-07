@extends('sell.common.layout')

@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Credit Note
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
					</div>
				</div>
			</div>
		</div>

		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<form method="GET" action="{{ route('creditnote_submit_sell') }}" id="fromGetCreditDetails">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Customer') </label>
							</div>
							<div class="col-md-8  input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="customer" name="customer">
									<option value="">select</option>
									@foreach($customers as $data)
									<option value="{{$data->id}}">{{$data->cust_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Invoice Number') </label>
							</div>
							<div class="col-md-8  input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="invoicenumber" name="invoicenumber">
									<option value="">select</option>

								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-5"></div>
					<div class="col-lg-4">
						<button type="button" class="btn btn-primary" id="btnSubmit" name="">Submit</button>
					</div>
					<div class="col-lg-3"></div>
				</div>
			</form>
			<!--end: Datatable -->

		</div>
	</div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document.body).on("change", "#customer", function() {
		var cid = $(this).val();
		$('select[name="invoicenumber"]').empty();
		$('select[name="invoicenumber"]').append($("<option>", {
			value: "", // Set the value attribute for the new option
			text: 'Select' // Set the text of the new option
		}));
		$('select[name="invoicenumber"]').val('');
		$.ajax({
			url: "getinvoicenumber_sell",
			method: "POST",
			data: {
				_token: $('#token').val(),
				id: cid
			},
			dataType: "json",
			success: function(data) {
				$.each(data, function(key, value) {
					$('select[name="invoicenumber"]').append('<option value="' + value.id + '">' + value.id + '</option>');
				});
				$('.kt-selectpicker').select2();

			}
		})
	});


	$(document.body).on("click", "#btnSubmit", function() {

		if ($('#customer').val() == "") {
			$('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Customer is required.");
			return false;
		} else {
			$('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if ($('#invoicenumber').val() == "") {
			$('#invoicenumber').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Invoice is required.");
			return false;
		} else {
			$('#invoicenumber').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		$('#fromGetCreditDetails').submit();
	});
</script>
<script>
	$(document).ready(function() {
		$('.creditnote_sell').addClass('kt-menu__item--active');
	});
</script>
@endsection
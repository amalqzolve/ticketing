@extends('Reports.common.layout')

@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">
				<a href="#" class="btn kt-subheader__btn-primary">
					@lang('app.Back')
				</a>
				<a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
					@lang('app.Trash ')

				</a>

			</div>
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
					Purchase Vat Report
				</h3>
			</div>

		</div>
		<div class="kt-portlet__body">
			<form method="GET" id="reportForm" action="{{ route('purchase-vat-list') }}" autocomplete="off">
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group  row pr-md-3">
							<div class="col-md-3">
								<label>@lang('app.From Date')</label>
							</div>
							<div class="col-md-9 input-group-sm">
								<input type="text" class="form-control ktdatepicker" name="fromdate" id="fromdate">
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group  row pr-md-3">
							<div class="col-md-3">
								<label>@lang('app.To Date')</label>
							</div>
							<div class="col-md-9 input-group-sm">
								<input type="text" class="form-control ktdatepicker" name="todate" id="todate">
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<button type="button" id="purchasesubmit" class="btn btn-primary" style="float:right;">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@section('script')
<script>
	$('.ktdatepicker').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
		fromToDateCheck();
	});
	$(document.body).on('click', "#purchasesubmit", function(e) {
		e.preventDefault();

		if ($('#fromdate').val() == '') {
			$('#fromdate').addClass('is-invalid');
			return false;
		} else
			$('#fromdate').removeClass('is-invalid');

		if ($('#todate').val() == '') {
			$('#todate').addClass('is-invalid');
			return false;
		} else
			$('#todate').removeClass('is-invalid');

		var dateCheck = fromToDateCheck();
		if (!dateCheck)
			return false;
		$('#reportForm').submit();
	});


	function fromToDateCheck() {
		var fromDate = $("#fromdate").datepicker("getDate");
		var toDate = $("#todate").datepicker("getDate");

		if (fromDate > toDate) {
			$('#fromdate').addClass('is-invalid');
			$('#todate').addClass('is-invalid');
			toastr.warning('To date must be equal to or later than from date');
			return false; // Prevent form submission
		} else {
			$('#fromdate').removeClass('is-invalid');
			$('#todate').removeClass('is-invalid');
			return true;
		}
	}
</script>
<script>
	$('.Purchase').addClass('kt-menu__item--open');
	$('.purchase-vat-index').addClass('kt-menu__item--active');
</script>
@endsection
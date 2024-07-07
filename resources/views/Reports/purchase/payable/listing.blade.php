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
					Payable Report
				</h3>
			</div>

		</div>
		<?php
		$date = date('d-m-Y');
		?>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<form method="GET" id="reportForm" action="{{ route('payable') }}" autocomplete="off">
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.From Date')</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control ktdatepicker" name="fromdate" id="fromdate" value="{{date('d-m-Y',strtotime($fromdate))}}">
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.To Date')</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control ktdatepicker" name="todate" id="todate" value="{{date('d-m-Y',strtotime($todate))}}">
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<button type="button" id="sales_register_submit" class="btn btn-primary">Submit</button>
						@if (!empty($tableOn))
						<br>
						<a style="margin-top: 10px;" href="{{url('/')}}/payablepdf?fromdate={{$fromdate}}&&todate={{$todate}}" target="_blank" class="btn btn-brand btn-elevate btn-icon-sm"> View PDF</a>
						@endif
					</div>
					<br><br>
					<?php if (!empty($tableOn)) { ?>
						<table class="table table-striped table-hover table-checkable dataTable no-footer" id="dt">
							<tr>
								<h2> Report </h2>
							</tr>
							<tr>
								<td>@lang('app.Sl.No')</td>
								<td>Date</td>
								<td>Invoice Number</td>
								<td>Supplier</td>
								<td>Invoiced Amount</td>
								<td>Total Paid</td>
								<td>Balance</td>
							</tr>
							<?php
							$grandtotalamount = 0;
							$paid_amount = 0;
							$balance_amount = 0;
							?>
							@foreach($transaction as $key=>$details)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$details->bill_entry_date}}</td>
								<td>{{$details->id}}</td>
								<td>{{$details->sup_name}}</td>
								<td>{{$details->grandtotalamount}}</td>
								<td>{{$details->grandtotalamount-$details->balance_amount}}</td>
								<td>{{$details->balance_amount}}</td>
							</tr>
							<?php
							$grandtotalamount += $details->grandtotalamount;
							$paid_amount += $details->grandtotalamount - $details->balance_amount;
							$balance_amount += $details->balance_amount;
							?>
							@endforeach
							<tr>
								<td colspan="4" style="text-align: center;"><b>Total </b></td>
								<td> <b><i> {{$grandtotalamount}}</i></b></td>
								<td> <b><i> {{$paid_amount}}</i></b></td>
								<td> <b><i> {{$balance_amount}}</i></b></td>
							</tr>


						</table>

					<?php
					}
					?>


				</div>
			</form>
			<!--end: Datatable -->

		</div>
	</div>
</div>
@endsection
@section('script')
</script>
<script type="text/javascript">
	$('.single-select').select2();
	$('.ktdatepicker').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
		fromToDateCheck();
	});
	$(document.body).on('click', "#sales_register_submit", function(e) {
		e.preventDefault();
		var customer_select = $('#customer').val();
		if (customer_select == "") {
			$('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} else {
			$('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
		}



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
	$('.payable').addClass('kt-menu__item--active');
</script>

@endsection
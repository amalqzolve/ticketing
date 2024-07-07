@extends('Reports.common.layout')

@section('content')
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
					Purchase Refund Report
				</h3>
			</div>

		</div>
		<div class="kt-portlet__body">
			<!--begin: Datatable -->
			<form method="GET" id="reportForm" action="{{ route('purchase-refund-report') }}" autocomplete="off">
				<div class="row">

					<div class="col-lg-5">
						<div class="form-group  row pr-md-3">
							<div class="col-md-3">
								<label>@lang('app.From Date')</label>
							</div>
							<div class="col-md-9 input-group-sm">
								<input type="text" class="form-control ktdatepicker" name="fromdate" id="fromdate" value="{{date('d-m-Y',strtotime($fromdate))}}">
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group  row pr-md-3">
							<div class="col-md-3">
								<label>@lang('app.To Date')</label>
							</div>
							<div class="col-md-9 input-group-sm">
								<input type="text" class="form-control ktdatepicker" name="todate" id="todate" value="{{date('d-m-Y',strtotime($todate))}}">
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<button type="button" id="purchasesubmit" class="btn btn-primary" style="float:right;">Submit</button>
					</div>
				</div>
			</form>
			@if(count($data)>0)
			<hr>
			<div class="row">
				<div class="col-lg-12">
					<a href="{{url('/purchase-refund-report-pdf')}}?fromdate={{$fromdate}}&todate={{$todate}}" class="btn btn-brand btn-elevate btn-icon-sm" target="_blank" style="float:right;">
						PDF
					</a>
				</div>
				<table class="table table-striped table-hover table-checkable dataTable no-footer" id="salesreport_lists">
					<thead>
						<tr>
							<th>Sl.No</th>
							<th>Refund Date</th>
							<th>Supplier Name</th>
							<th>Return ID</th>
							<th>Return Date</th>
							<th>Invoice ID</th>
							<th style="text-align: right;">Amount</th>
						</tr>
					</thead>
					<?php
					$grandTotal = 0;
					?>
					<tbody>
						@foreach($data as $key=>$value)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{date('d-m-Y',strtotime($value->date))}}</td>
							<td>{{$value->sup_name}}</td>
							<td>{{$value->return_id}}</td>
							<td>{{date('d-m-Y',strtotime($value->returndate))}}</td>
							<td>{{$value->invoice_id}}</td>
							<td style="text-align: right;">{{number_format($value->addtotal,2,'.',',')}}</td>
						</tr>
						<?php
						$grandTotal += $value->addtotal;
						?>
						@endforeach
						<tr>
							<td colspan="6" style="text-align: right;"><b>Total</b></td>
							<td style="text-align: right;"><b>{{number_format($grandTotal,2,'.',',')}}</b></td>
						</tr>
					</tbody>


				</table>
			</div>
			@endif
			<!--end: Datatable -->

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
@endsection
@section('script')
<script type="text/javascript">
	$('.kt-selectpicker').select2();
	$('.ktdatepicker').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
		fromToDateCheck();
	});
	$(document.body).on('click', "#purchasesubmit", function(e) {
		e.preventDefault();

		var salesman = $('#salesman').val();
		if (salesman == "") {
			$('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} else {
			$('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
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
	$('.Purchase').addClass('kt-menu__item--open');
	$('.purchase-refund-report').addClass('kt-menu__item--active');
</script>
@endsection
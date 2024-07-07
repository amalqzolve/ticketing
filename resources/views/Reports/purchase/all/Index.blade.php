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
					Purchase Invoice
				</h3>
			</div>

		</div>
		<div class="kt-portlet__body">
			<!--begin: Datatable -->
			<form method="GET" id="reportForm" action="{{ route('purchase-all') }}">
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
					<a href="{{url('/purchase-all-pdf')}}?fromdate={{$fromdate}}&todate={{$todate}}" class="btn btn-brand btn-elevate btn-icon-sm" target="_blank" style="float:right;">
						PDF
					</a>
				</div>
				<table class="table table-striped table-hover table-checkable dataTable no-footer" id="salesreport_lists">
					<thead>
						<tr>
							<th>@lang('app.Sl.No')</th>
							<th>@lang('app.Date')</th>
							<th>Invoice Number</th>
							<th>Supplier</th>
							<th style="text-align: right;">@lang('app.Total Amount Excluding Vat')</th>
							<th style="text-align: right;">@lang('app.Vat Amount')</th>
							<th style="text-align: right;">@lang('app.Total Amount Including Vat')</th>
						</tr>
					</thead>
					<?php
					$total = 0;
					$vatTotal = 0;
					$gTotal = 0;
					?>
					<tbody>
						@foreach($data as $key=>$value)
						<tr data-href='viewsellreport?id={{$value->bill_entry_date}}'>
							<td>{{$key+1}}</td>
							<td>{{$value->bill_entry_date}}</td>
							<td>{{$value->id}}</td>
							<td>{{$value->sup_name}}</td>
							<td style="text-align: right;">{{number_format($value->amountafterdiscount,2,'.',',')}}</td>
							<td style="text-align: right;">{{number_format($value->vatamounts,2,'.',',')}}</td>
							<td style="text-align: right;">{{number_format($value->grandtotalamounts,2,'.',',')}}</td>
						</tr>
						<?php
						$total += $value->amountafterdiscount;
						$vatTotal += $value->vatamounts;
						$gTotal += $value->grandtotalamounts;
						?>
						@endforeach

						<trd F>
							<td colspan="4" style="text-align: center;"><b>Total</b></td>
							<td style="text-align: right;"><b>{{number_format($total,2,'.',',')}}</b></td>
							<td style="text-align: right;"><b>{{number_format($vatTotal,2,'.',',')}}</b></td>
							<td style="text-align: right;"><b>{{number_format($gTotal,2,'.',',')}}</b></td>
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
	$('.purchase-all').addClass('kt-menu__item--active');
</script>
@endsection
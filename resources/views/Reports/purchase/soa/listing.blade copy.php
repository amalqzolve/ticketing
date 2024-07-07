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
					Supplier Statement of Account
				</h3>
			</div>

		</div>
		<?php
		$date = date('d-m-Y');
		?>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<form method="GET" id="reportForm" action="{{ route('purchase-soa') }}" autocomplete="off">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group row pr-md-3">
							<div class="col-md-2">
								<label>Supplier </label>
							</div>
							<div class="col-md-10  input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="supplier" name="supplier">
									<option value="" seelcted>select</option>
									@foreach($suppliers as $data)
									<option value="{{$data->id}}" {{($data->id==$ccid)?'selected':''}}>{{$data->sup_name}} [{{$data->sup_code.'/'.$data->code_id}}]</option>
									<?php
									if ($data->id == $ccid)
										$cust_name = $data->sup_name
									?>
									@endforeach
								</select>
							</div>
						</div>
					</div>
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
						<button type="button" id="soasubmit" class="btn btn-primary">Submit</button>
					</div>
					<br><br>
					<?php if (!empty($ccid)) { ?>
						<table class="table table-striped table-hover table-checkable dataTable no-footer" id="dt">
							<tr>
								<h2>Statement of Account </h2>
							</tr>
							<tr>
								<td>Opening Balance</td>
								<td>Total Debit</td>
								<td>Total Credit</td>
								<td>Balance</td>
								<td>Action</td>
							</tr>
							<tr>
								<td>{{$opening_balance}}</td>
								<td>{{$transaction->dr_amount}}</td>
								<td>{{$transaction->cr_amount}}</td>
								<td>{{$transaction->dr_amount-$transaction->cr_amount}}</td>
								<td>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<a href="{{url('/')}}/purchase-soa-pdf?cid={{$ccid}}&&fromdate={{$fromdate}}&&todate={{$todate}}" target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">PDF</a>&nbsp;
											</div>
										</div>
									</div>
								</td>
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
	$(document.body).on('click', "#soasubmit", function(e) {
		e.preventDefault();
		var supplier_select = $('#supplier').val();
		if (supplier_select == "") {
			$('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} else {
			$('#supplier').next().find('.select2-selection').removeClass('select-dropdown-error');
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
	$('.purchase-soa').addClass('kt-menu__item--active');
</script>

@endsection
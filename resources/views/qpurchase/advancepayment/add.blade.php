@extends('qpurchase.common.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<style type="text/css">
	.form-control {
		height: calc(1.4em + 1rem + 2px);
	}
</style>
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
					Advance Payment
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">
			<!--begin: Datatable -->
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>@lang('app.Supplier') <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8  input-group-sm">
							<select class="form-control single-select kt-selectpicker supplier" id="supplier" name="supplier">
								<option value="">select</option>
								@foreach($suppliers as $data)
								<option value="{{$data->id}}">{{$data->sup_name}} [{{$data->sup_code}}]</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<!-- <div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Receipt Against <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8">
							<div class="kt-radio-inline">
								<label class="kt-radio">
									<input type="radio" class="form-control transactiontype loadInvoice" checked="checked" name="transactiontype" value="1"> On Account
									<span></span>
								</label>
								<label class="kt-radio">
									<input type="radio" class="form-control transactiontype loadInvoice" name="transactiontype" value="2"> Sale Order ID
									<span></span>
								</label>
							</div>
						</div>
					</div>
				</div> -->

				<div class="col-lg-6">
					<div class="form-group  row pr-md-3">
						<div class="col-md-4">
							<label>Date <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8 input-group-sm">
							<input type="text" class="form-control kt_datetimepickerr" name="date" id="date" value="{{date('d-m-Y')}}">
						</div>
					</div>
				</div>

				<!-- <div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Sale Order ID</label>
						</div>
						<div class="col-md-8  input-group-sm">
							<select class="form-control single-select kt-selectpicker" name="purchaseno" id="purchaseno" disabled>
								<option value="" selected>Select</option>
							</select>
						</div>
					</div>
				</div> -->

				<div class="col-lg-12">
					<div class="form-group  row pr-md-3">
						<div class="col-md-2">
							<label>Notes</label>
						</div>
						<div class="col-md-10 input-group-sm">
							<textarea class="form-control" name="notes" id="notes"></textarea>
						</div>
					</div>
				</div>

			</div>
			<div class="row" style="padding-bottom: 6px; margin-top: 44px;">
				<div class="col-lg-12">
					<div class="form-group row pl-md-3">
						<table class="table table-striped table-hover" id="modeofpaymenttable">
							<thead style=" background-color: #306584; color: white;">
								<tr>
									<th class="text-center" style="background-color:  #3f4aa0;  color: white; white-space: nowrap;  padding: 2px 7px !important; width: 30px;">#</th>
									<th class="text-center" style="background-color:  #3f4aa0;  color: white; white-space: nowrap;  padding: 2px 7px !important;">Debit Account</th>
									<th class="text-center" style="background-color:  #3f4aa0;  color: white; white-space: nowrap;  padding: 2px 7px !important;">@lang('app.Reference')</th>
									<th class="text-center" style="background-color:  #3f4aa0;  color: white; white-space: nowrap;  padding: 2px 7px !important;">@lang('app.Amount')</th>
									<th class="text-center" style="background-color:  #3f4aa0;  color: white; white-space: nowrap;  padding: 2px 7px !important; width: 30px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="row_count" id="rowcount" style="padding: 0;">1</td>
									<td style="padding: 0;">
										<select class="form-control single-select kt-selectpicker" name="accountledger_debitaccount[]">
											<option value="">Select</option>
											@foreach($fullLedger as $ledger)
											<option value="{{$ledger->id}}">[{{$ledger->code}}] {{$ledger->name}}</option>
											@endforeach
										</select>
									</td>
									<td style="padding: 0;">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control preference" name="preference[]" id="preference0" data-id="0">
										</div>
									</td>
									<td style="padding: 0;">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control amount integerVal" name="amount[]" id="amount0" data-id="0" value="0">
										</div>
									</td>
									<td style="padding: 0;">
										<div class="kt-demo-icon__preview costremove">
											<i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
										</div>
									</td>
								</tr>
							</tbody>

						</table>
						<table style="width:100%;">
							<tr>
								<td>
									<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right"><i class="la la-plus"></i>Add More</button>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<hr style="width:100%;text-align:left;margin-left:0;padding-bottom: 6px; margin-top: 44px;">
				<div class="row col-lg-12">
					<div class="col-lg-6"></div>
					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>Total </label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="total_amount" id="total_amount" value="0" readonly>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="kt-portlet__foot pr-0">
				<div class="row">
					<div class="col-lg-12 p-0 kt-align-right">
						<button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
								<line x1="18" y1="6" x2="6" y2="18"></line>
								<line x1="6" y1="6" x2="18" y2="18"></line>
							</svg> &nbsp;Cancel</button>
						<button type="button" class="btn btn-primary" id="advancepayment_submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
								<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
								<polyline points="22 4 12 14.01 9 11.01"></polyline>
							</svg> &nbsp;Save</button>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>

@endsection
@section('script')

<script type="text/javascript">
	$(document).ready(function() {
		$('.PaymentVoucher').addClass('kt-menu__item--open');
		$('.qpurchase_advancepayment').addClass('kt-menu__item--active');
	});

	$('.kt_datetimepickerr').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
	});
	$(document).ready(function() {
		var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
		$(".addmorepayments").click(function() {
			var table = '#modeofpaymenttable';
			var $tr = $(table).find('tr:last').clone();
			$tr.find(':text').val('');
			$tr.find('select').val('');
			$tr.find('td').first().html(rowcount);
			$tr.find('span').remove().end();
			$(table).append($tr);
			$('.kt-selectpicker').select2();
		});
	});

	$('body').on('keyup', '.amount', function() {
		findTotalAmount();
	});

	$("body").on("click", ".costremove", function(event) {
		event.preventDefault();
		var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
		if (rowcount > 1) {
			var row = $(this).closest('tr');
			var siblings = row.siblings();
			row.remove();
			siblings.each(function(index) {
				$(this).children().first().text(index);
			});
		} else {
			var row = $(this).closest('tr');
			row.find(':text').val('');
			row.find('select').val('');
			$('.kt-selectpicker').select2();
		}
		findTotalAmount();
	});

	function findTotalAmount() {
		var totalAmt = 0;
		$("input[name^='amount[]']").each(function(input) {
			totalAmt += parseFloat($(this).val());
		});
		$('#total_amount').val(totalAmt);
	}


	// $(document.body).on("change", ".loadInvoice", function() {
	// 	console.log('asdads');
	// 	var customer = $('#customer').val();
	// 	var checkedValue = $('input[name="transactiontype"]:checked').val();
	// 	if (checkedValue == 1) {
	// 		$('select[name="purchaseno"]').attr('disabled', true);
	// 	}
	// 	if (checkedValue == 2) {
	// 		$('select[name="purchaseno"]').attr('disabled', false);
	// 	}

	// 	$('select[name="purchaseno"]').empty();
	// 	$('select[name="purchaseno"]').append('<option value="">select</option>');

	// 	if ((checkedValue == 2) && (customer != '')) {
	// 		$.ajax({
	// 			url: "getcustomerinvoices_advance_sell",
	// 			method: "POST",
	// 			data: {
	// 				_token: $('#token').val(),
	// 				id: checkedValue,
	// 				customer: customer
	// 			},
	// 			dataType: "json",
	// 			success: function(data) {
	// 				if (data.status == 1)
	// 					$.each(data.data, function(key, value) {
	// 						$('select[name="purchaseno"]').append('<option value="' + value.id + '">' + value.id + '</option>');
	// 					});
	// 			}
	// 		})
	// 	}
	// });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{url('/')}}/resources/js/qpurchase/advancepayment.js" type="text/javascript"></script>
@endsection
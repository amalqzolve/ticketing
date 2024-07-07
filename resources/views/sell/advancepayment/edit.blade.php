@extends('sell.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.form-control {
		height: calc(1.4em + 1rem + 2px);
	}
</style>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Edit Advance Receipt (#{{$advancepayment->id}})
				</h3>
			</div>
		</div>

		<div class="kt-portlet__body">
			<input type="hidden" name="id" id="id" value="{{$advancepayment->id}}">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>@lang('app.Customer') <span style="color: red">*</span> </label>
						</div>
						<div class="col-md-8  input-group-sm">
							<select class="form-control single-select kt-selectpicker customer" name="customer" id="customer">
								<option value="">Select</option>
								@foreach($customers as $customerss)
								<option value="{{$customerss->id}}" {{($advancepayment->customer==$customerss->id)?"selected":''}}>{{$customerss->cust_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<!-- <div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Receipt Against </label>
						</div>
						<div class="col-md-8  input-group-sm">
							<select class="form-control single-select kt-selectpicker transactiontype" name="transactiontype" id="transactiontype">
								<option value="1">On Account</option>
								<option value="2">Sale Order ID</option>
							</select>
						</div>
					</div>
				</div> -->


				<div class="col-lg-6">
					<div class="form-group  row pr-md-3">
						<div class="col-md-4">
							<label>Date </label>
						</div>
						<div class="col-md-8 input-group-sm">
							<input type="text" class="form-control kt_datetimepickerr" name="date" id="date" value="{{date('d-m-Y',strtotime($advancepayment->date))}}">
						</div>
					</div>
				</div>

				<!-- <div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>Sale Order ID</label>
						</div>
						<div class="col-md-8  input-group-sm">
							<select class="form-control single-select kt-selectpicker" name="invoice_no" id="invoice_no" disabled="">
							</select>
						</div>
					</div>
				</div> -->

				<div class="col-lg-6">
					<div class="form-group  row pr-md-3">
						<div class="col-md-4">
							<label>Deposit Account <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8 input-group-sm">
							<select class="form-control single-select kt-selectpicker" name="accountledger_depositaccount" id="accountledger_depositaccount">
								<option value="">Select</option>
								@foreach($fullLedger as $ledger)
								<?php
								$lSelected = '';
								if (($advancepayment->accountledger_depositaccount == $ledger['id']) && ($ledger['parent_id'] == '~'))
									$lSelected = 'selected';
								?>
								<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$lSelected}}>
									@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
										@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group  row pr-md-3">
						<div class="col-md-4">
							<label>Notes</label>
						</div>
						<div class="col-md-8 input-group-sm">
							<textarea class="form-control" name="notes" id="notes" rows="1">{{$advancepayment->notes}}</textarea>
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
									<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; width: 30px;">#</th>
									<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Mode of Payment')</th>
									<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Reference')</th>
									<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Amount')</th>
									<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; width: 30px;"></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($advancepaymentMethode as $key => $method)
								<tr>
									<td class="row_count" id="rowcount" style="padding: 0;">{{$key+1}}</td>
									<td style="padding: 0;">
										<select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment{{$key}}" data-id="{{$key}}">
											<option value="">Select</option>
											<option value="1" {{($method->modeofpayment==1)?'selected':""}}>Cash</option>
											<option value="2" {{($method->modeofpayment==2)?'selected':""}}>Card</option>
											<option value="3" {{($method->modeofpayment==3)?'selected':""}}>Bank</option>
											<option value="4" {{($method->modeofpayment==4)?'selected':""}}>Cheque</option>
										</select>
									</td>
									<td style="padding: 0;">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control preference" name="preference[]" id="preference{{$key}}" data-id="{{$key}}" value="{{$method->preference}}">
										</div>
									</td>
									<td style="padding: 0;">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control amount integerVal" name="amount[]" id="amount{{$key}}" data-id="{{$key}}" value="{{$method->amounts}}">
										</div>
									</td>
									<td style="padding: 0;">
										<div class="kt-demo-icon__preview costremove">
											<i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="col-lg-6">&nbsp;</div>
						<div class="col-lg-6">
							<div class="form-group  row pr-md-3">
								<div class="col-md-4">
									<label>Total </label>
								</div>
								<div class="col-md-8 input-group-sm">
									<input type="text" class="form-control" name="totalamount1" id="totalamount1" value="{{$advancepayment->total_amount}}" readonly>
								</div>
							</div>
						</div>
						<table style="width:100%;">
							<tr>
								<td>
								</td>
								<td>
									<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right"><i class="la la-plus"></i>Add More</button>
								</td>
							</tr>
						</table>

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

<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sell/advancepayment.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.kt_datetimepickerr').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
	});

	// 	     $(".kt_datetimepickerr").datetimepicker({
	//     format: 'dd-mm-yyyy'

	// }).on('changeDate', function(e){
	//     $(this).datetimepicker('hide');
	// });

	$(document).ready(function() {
		var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
		$(".addmorepayments").click(function() {
			var sl = ($("#modeofpaymenttable > tbody > tr").length);
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">' + sl + '</td>\
					  <td style="padding: 0;">\
					  <select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment' + rowcount + '" data-id=' + rowcount + '>\
					  <option value="1" selected>Cash</option>\
					   <option value="2">Card</option>\
					    <option value="3">Bank</option>\
					     <option value="4">Cheque</option>\
					  </select>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control preference" name="preference[]" id="preference' + rowcount + '"  data-id=' + rowcount + '>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control amount integerVal" name="amount[]" id="amount' + rowcount + '"  data-id=' + rowcount + ' value="0">\
					  </div>\
					  </td>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview costremove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';
			$('#modeofpaymenttable').append(payment);
			rowcount++;
		});


	});

	$('body').on('keyup', '.amount', function() {
		var id = $(this).attr('data-id');
		amount_calculate(id);
	});

	$("body").on("click", ".costremove", function(event) {
		event.preventDefault();
		var row = $(this).closest('tr');


		var siblings = row.siblings();
		row.remove();
		siblings.each(function(index) {
			$(this).children().first().text(index);
		});

		amount_calculate();
	});

	function amount_calculate() {
		var totalamount = 0;
		var balance = 0;
		var total = 0;
		var totaldueamount = 0;
		$('.amount').each(function() {
			var id = $(this).attr('data-id');
			var amount = $('#amount' + id + '').val();
			amount = (amount == '') ? 0 : amount;
			totalamount += parseFloat(amount);
		});
		$('#totalamount1').val(totalamount);


		var total = $('#totaldueamount').val();
		if (total < totalamount) {
			$('#payingamount').val("");
			$('#balanceamount').val("");
			toastr.warning('Receive Payment is less than or Equal to Total Amount');
			$('#creditinvoice_pay').attr('disabled', true);

		} else {
			totaldueamount = $('#totaldueamount').val();
			balance = parseFloat(totaldueamount) - parseFloat(totalamount);
			$('#payingamount').val(totalamount.toFixed(2));
			$('#creditinvoice_pay').attr('disabled', false);
			$('#balanceamount').val(balance.toFixed(2));
		}
	}

	// $('body').on('change', '.customer', function() {
	// 	$('#invoice_no').val();
	// });
	// $(document.body).on("change", "#transactiontype", function() {
	// 	////////////////
	// 	var customer = $('#customer').val();
	// 	var checkedValue = $('#transactiontype').val();
	// 	if (checkedValue == 1) {
	// 		$('select[name="invoice_no"]').attr('disabled', true);
	// 	}
	// 	if (checkedValue == 2) {
	// 		$('select[name="invoice_no"]').attr('disabled', false);
	// 	}
	// 	$.ajax({
	// 		url: "getcustomerinvoices_advance_sell",
	// 		method: "POST",
	// 		data: {
	// 			_token: $('#token').val(),
	// 			id: checkedValue,
	// 			customer: customer
	// 		},
	// 		dataType: "json",
	// 		success: function(data) {
	// 			console.log(data);
	// 			$('select[name="invoice_no"]').empty();
	// 			$('select[name="invoice_no"]').append('<option value="">select</option>');
	// 			$.each(data, function(key, value) {
	// 				$('select[name="invoice_no"]').append('<option value="' + value.id + '">' + '#' + value.quote_id + '</option>');
	// 			});
	// 			$('input[name="transactiontype"]').val();

	// 		}
	// 	})
	// });
</script>
<script>
	$(document).ready(function() {
		$('.payments').addClass('kt-menu__item--open');
		$('.advancepayment_sell').addClass('kt-menu__item--active');
	});
</script>
@endsection
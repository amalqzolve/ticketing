@extends('qpurchase.common.layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
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
					Bill Settlement For - {{$supplier->sup_name}}
				</h3>
			</div>
		</div>

		<div class="kt-portlet__body">
			@if(count($vouchers)>0)
			<input type="hidden" name="supplier_select" id="supplier_select" value="{{$supplierSelect}}">
			<div id="results">
				<table class="table table-striped table-hover table-checkable dataTable no-footer">
					<thead>
						<tr>
							<th>#</th>
							<th>Invoice ID</th>
							<th>Invoice Date </th>
							<th>Salesman</th>
							<th>Total amount</th>
							<th>Paid amount</th>
							<th>Due amount</th>
						</tr>
					</thead>
					<tbody id="maindetails_list">
						@foreach($vouchers as $key=>$voucherss)
						<tr>
							<td><input type="checkbox" class="vcheck invoices" id="{{$voucherss->vid}}" value="{{$voucherss->balance_amount}}" /></td>
							<td>{{$voucherss->vid}}</td>
							<td>{{($voucherss->bill_entry_date!='')?date('d-m-Y',strtotime($voucherss->bill_entry_date)):''}}</td>
							<td>{{$voucherss->purchaser}}</td>
							<td>{{$voucherss->grandtotalamount}}</td>
							<td>{{$voucherss->grandtotalamount-$voucherss->balance_amount}}</td><!-- $voucherss->paid_amount -->
							<td>{{$voucherss->balance_amount}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>



				<hr style="width:100%;text-align:left;margin-left:0">
				<div class="row" style="padding-bottom: 6px; margin-top: 44px;">


					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Due Amount </label>
							</div>
							<div class="col-md-8  input-group-sm">
								<input type="text" class="form-control" name="dueamount" id="dueamount" value="0" readonly>
							</div>
						</div>
					</div>


					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Paid Amount <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8  input-group-sm">
								<input type="text" class="form-control integerVal" name="paidamount" id="paidamount" value="0">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Transaction Date')</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control kt_datetimepickerr" name="transactiondate" id="transactiondate" value="{{date('d-m-Y')}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>Reference</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="reference" id="reference" value="">
							</div>
						</div>
					</div>


					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4"></div>
							<div class="col-md-8 input-group-sm">
								<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
									<input type="checkbox" id="credit_from_another" name="credit_from_another" value="1"> Credit From Another Ledger
									<span></span>
								</label>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="creditFrom" style="display: none;">
							<div class="form-group  row pr-md-3">
								<div class="col-md-4">
									<label>Credit From <span style="color: red">*</span></label>
								</div>
								<div class="col-md-8 input-group-sm">
									<select name="credit_from_ledjer" id="credit_from_ledjer" class="form-control kt-selectpicker">
										<option value="" selected>Select</option>
										@foreach($allLedger as $ledger)
										<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}}>
											@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
												@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4"></div>
							<div class="col-md-4 input-group-sm">
								<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
									<input type="checkbox" id="use_advance" name="use_advance" value="1"> Use Advance
									<span></span>
								</label>
							</div>
							<div class="col-md-4 useAdvance" style="display:none">
								Debit Balance : {{$debitBalance}}
								<input type="hidden" name="debitBalance" id="debitBalance" value="{{$debitBalance}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="useAdvance" style="display:none">
							<div class="form-group  row pr-md-3">
								<div class="col-md-4">
									<label>Pay From Advance <span style="color: red">*</span></label>
								</div>
								<div class="col-md-8 input-group-sm">
									<input type="text" class="form-control integerVal amount" name="advance_amt" id="advance_amt" value="0">
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="form-group  row pr-md-3">
							<div class="col-md-2">
								<label>Notes</label>
							</div>
							<div class="col-md-10 input-group-sm">
								<textarea class="form-control" name="notes" id="notes" cols="30" rows="4"></textarea>
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
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">#</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 15%;">Debit Account</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 45%;">@lang('app.Reference')</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 30%;">@lang('app.Amount')</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="row_count" id="rowcount" style="padding: 0; text-align: center">1</td>
										<td style="padding: 0;">
											<select class="form-control single-select kt-selectpicker" name="debitaccount[]">
												<option value="">select</option>
												@foreach($fullLedger as $ledger)
												<option value="{{$ledger->id}}"> [{{$ledger->code}}] {{$ledger->name}} </option>
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


							<hr style="width:100%;text-align:left;margin-left:0;padding-bottom: 6px; margin-top: 44px;">
							<div class="row col-lg-12">
								<div class="col-lg-6"></div>
								<div class="col-lg-6">
									<div class="form-group  row pr-md-3">
										<div class="col-md-4">
											<label>Total </label>
										</div>
										<div class="col-md-8 input-group-sm">
											<input type="text" class="form-control" name="addtotal" id="addtotal" value="0" readonly>
										</div>
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
										<button type="submit" name="bill_settlement_submit" id="bill_settlement_submit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
												<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
												<polyline points="22 4 12 14.01 9 11.01"></polyline>
											</svg> Save </button>
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
			@else
			No Pending Invoice Fount For {{$supplier->sup_name}}
			@endif

		</div>
	</div>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$('.PaymentVoucher').addClass('kt-menu__item--open');
		$('.qpurchase-bill-settlement-list').addClass('kt-menu__item--active');


		var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
		var sl = ($("#modeofpaymenttable > tbody > tr").length) + 1;
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
	$('.kt_datetimepickerr').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
	});

	$(document).ready(function() {
		$('#credit_from_another').change(function() {
			if (this.checked) {
				$('.creditFrom').show();
				$('.kt-selectpicker').select2();
			} else {
				$('#credit_from_ledjer').val('');
				$('.creditFrom').hide();
			}
		});
	});

	$(document).ready(function() {
		$('#use_advance').change(function() {
			if (this.checked) {
				$('.useAdvance').show();
				$('.kt-selectpicker').select2();
			} else {
				$('#advance_amt').val(0);
				$('.useAdvance').hide();
				$('#advance_amt').removeClass('is-invalid');
			}
		});
	});

	$("body").on("click", ".costremove", function(event) {
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
		amount_calculate();
	});


	$(document).on('click', '.vcheck', function() {
		var voucher_id = {};
		voucher_id.checkselected = [];
		voucher_id.checkselectedvalues = [];
		$(".vcheck:input:checkbox").each(function() {
			var $this = $(this);
			if ($this.is(":checked")) {
				voucher_id.checkselected.push($this.attr("id"));
				voucher_id.checkselectedvalues.push($this.val());
			} else {
				//
			}
		})
		//
		var totaldue = 0;
		for (var i = 0; i < voucher_id.checkselectedvalues.length; i++) {
			totaldue += parseFloat(voucher_id.checkselectedvalues[i]);
			console.log('asdds' + voucher_id.checkselectedvalues[i]);
		}
		//
		$('#dueamount').val(totaldue);

		var ppaidamount = $('#paidamount').val();
		var pdueamount = $('#dueamount').val();
		if (parseFloat(ppaidamount) > parseFloat(pdueamount)) {
			$('#paidamount').addClass('is-invalid');
		} else
			$('#paidamount').removeClass('is-invalid');

	});

	$(document).on("input", "#paidamount", function() {
		var ppaidamount = $('#paidamount').val();
		var pdueamount = $('#dueamount').val();
		if (parseFloat(ppaidamount) > parseFloat(pdueamount)) {
			$('#paidamount').addClass('is-invalid');
		} else
			$('#paidamount').removeClass('is-invalid');
	});


	$('body').on('keyup', '.amount', function() {
		var id = $(this).attr('data-id');
		amount_calculate(id);
	});


	function amount_calculate() {
		var totalamount = 0;
		var balance = 0;
		var total = 0;
		var totaldueamount = 0;

		if ($("#use_advance").prop('checked') == true) {
			if (($('#advance_amt').val() == "0") || ($('#advance_amt').val() == "") || parseFloat($('#advance_amt').val()) > parseFloat($('#debitBalance').val())) {
				$('#advance_amt').addClass('is-invalid');
			} else
				$('#advance_amt').removeClass('is-invalid');
		} else
			$('#advance_amt').removeClass('is-invalid');

		$('.amount').each(function() {
			var id = $(this).attr('data-id');
			var amount = ($(this).val() == '') ? 0 : $(this).val();;
			totalamount += parseFloat(amount);
		});
		$('#addtotal').val(totalamount);
		var total = $('#paidamount').val();
		if (total < totalamount)
			toastr.warning('Amount is less than or Equal to Paid Amount');
	}

	$(document).on('click', '#bill_settlement_submit', function(e) {
		dueamount = $('#dueamount').val();

		if (dueamount == "") {
			$('#dueamount').addClass('is-invalid');
			toastr.warning("Please Add Due amount!");
			return false;
		} else {
			$('#dueamount').removeClass('is-invalid');
		}

		if ($("#credit_from_another").prop('checked') == true) {
			if ($('#credit_from_ledjer').val() == "") {
				$('#credit_from_ledjer').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning("Please Select Credit From!");
				return false;
			} else
				$('#credit_from_ledjer').next().find('.select2-selection').removeClass('select-dropdown-error');
		} else
			$('#credit_from_ledjer').next().find('.select2-selection').removeClass('select-dropdown-error');

		if ($("#use_advance").prop('checked') == true) {
			if (($('#advance_amt').val() == "0") || ($('#advance_amt').val() == "") || parseFloat($('#advance_amt').val()) > parseFloat($('#debitBalance').val())) {
				$('#advance_amt').addClass('is-invalid');
				toastr.warning("Please Enter a valid Advance Amount!");
				return false;
			} else
				$('#advance_amt').removeClass('is-invalid');
		} else
			$('#advance_amt').removeClass('is-invalid');

		var error = 0;
		if (parseFloat($('#advance_amt').val()) < parseFloat($('#paidamount').val())) {
			var debitaccount = [];
			$("select[name^='debitaccount[]']").each(function(input) {
				debitaccount.push($(this).val());
				if ($(this).val() == "") {
					$(this).next().find('.select2-selection').addClass('select-dropdown-error');
					error++;
				} else
					$(this).next().find('.select2-selection').removeClass('select-dropdown-error');
			});
			var preference = [];
			$("input[name^='preference[]']").each(function(input) {
				preference.push($(this).val());
			});
			var amount = [];
			$("input[name^='amount[]']").each(function(input) {
				amount.push($(this).val());
				if (($(this).val() == "") || ($(this).val() == 0)) {
					error++;
					$(this).addClass('is-invalid');
				} else
					$(this).removeClass('is-invalid');
			});
		} else {
			var debitaccount = [];
			var preference = [];
			var amount = [];
		}
		var addtotal = parseFloat($('#addtotal').val());
		var paidamount = parseFloat($('#paidamount').val());
		if (paidamount != addtotal) {
			toastr.warning('Paid Amount is not equal to Total Amount')
			return false;
		}
		var voucher_id = {};
		voucher_id.checkselected = [];
		$("input:checkbox").each(function() {
			var $this = $(this);
			if ($this.hasClass("invoices")) {
				if ($this.is(":checked")) {
					voucher_id.checkselected.push($this.attr("id"));
				}
			}
		});

		if (voucher_id.checkselected.length === 0) {
			toastr.warning("Please Select Invoice!");
			return false;
		}

		var ppaidamount = $('#paidamount').val();
		var pdueamount = $('#dueamount').val();
		if (parseFloat(ppaidamount) > parseFloat(pdueamount)) {
			$('#paidamount').addClass('is-invalid');
			toastr.warning('Due Amount Larger than Paid Amount')
		} else
			$('#paidamount').removeClass('is-invalid');

		if (error != 0) {
			toastr.warning("Please Remove Validation Error!");
			return false;
		}

		swal.fire({
			title: 'Do you want to save As ?',
			icon: 'warning',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Approved',
			denyButtonText: 'Draft',
			customClass: {
				actions: 'my-actions',
				cancelButton: 'order-1 right-gap',
				confirmButton: 'order-2',
				denyButton: 'order-3',
			},
		}).then((result) => {
			if (result.isConfirmed) {
				// Swal.fire('Saved!', '', 'success')
				saveDetails(result)
			} else if (result.isDenied) {
				// Swal.fire('Changes are not saved', '', 'info')
				saveDetails(result)
			} else {
				$('#bill_settlement_submit').removeClass('kt-spinner');
				$('#bill_settlement_submit').prop("disabled", false);
				swal.fire("Cancelled", "", "error");
			}
		});

		function saveDetails(result) {
			$('#bill_settlement_submit').addClass('kt-spinner');
			$('#bill_settlement_submit').prop("disabled", true);
			var status = (result.isConfirmed) ? "Approved" : "Draft";
			$.ajax({
				type: "POST",
				url: "qpurchase-bill-settle-save",
				dataType: "json",
				data: {
					_token: $('#token').val(),
					supplier_select: $('#supplier_select').val(),
					dueamount: $('#dueamount').val(),
					paidamount: $('#paidamount').val(),
					credit_from_another: ($("#credit_from_another").prop('checked') == true) ? 1 : '',
					credit_from_ledjer: $('#credit_from_ledjer').val(),
					use_advance: $('#use_advance').val(),
					advance_amt: $('#advance_amt').val(),
					notes: $('#notes').val(),
					reference: $('#reference').val(),
					addtotal: $('#addtotal').val(),
					vouchers: voucher_id.checkselected,
					debitaccount: debitaccount,
					preference: preference,
					amount: amount,
					transactiondate: $('#transactiondate').val(),
					status: status,
				},
				success: function(data) {
					$('#bill_settlement_submit').removeClass('kt-spinner');
					$('#bill_settlement_submit').prop("disabled", false);
					window.location.href = "qpurchase-bill-settlement-list";
					toastr.success('New bill settlement added successfuly');
				},
				error: function(jqXhr, json, errorThrown) {
					console.log('Error !!');
				}
			});
		}
	});
</script>
@endsection
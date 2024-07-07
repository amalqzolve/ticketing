@extends('sell.common.layout') @section('content')
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
					Bill Settlement Edit # {{$billSettlement->id}} For - {{$billSettlement->cust_name}}
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">

			@if(count($vouchers)>0)
			<input type="hidden" name="id" id="id" value="{{$billSettlement->id}}">
			<input type="hidden" name="customer_select" id="customer_select" value="{{$billSettlement->customer}}">

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
						<?php $totalBalAmount = 0  ?>
						@foreach($vouchers as $key=>$voucherss)
						<tr>
							<td><input type="checkbox" class="vcheck" checked id="{{$voucherss->vid}}" value="{{$voucherss->balance_amount+$voucherss->curPay}}" /></td>
							<td>{{$voucherss->vid}}</td>
							<td>{{($voucherss->quotedate!='')?date('d-m-Y',strtotime($voucherss->quotedate)):''}}</td>
							<td>{{$voucherss->purchaser}}</td>
							<td>{{$voucherss->grandtotalamount}}</td>
							<td>{{$voucherss->grandtotalamount- $voucherss->balance_amount - $voucherss->curPay}}</td>
							<td>{{$voucherss->balance_amount+$voucherss->curPay}}</td>
						</tr>
						<?php $totalBalAmount += $voucherss->balance_amount + $voucherss->curPay ?>
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
								<input type="text" class="form-control" name="dueamount" id="dueamount" value="{{$totalBalAmount}}" readonly>
							</div>
						</div>
					</div>


					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Paid Amount <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8  input-group-sm">
								<input type="text" class="form-control integerVal" name="paidamount" id="paidamount" value="{{$billSettlement->paidamount}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Transaction Date')</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control kt_datetimepickerr" name="transactiondate" id="transactiondate" value="{{($billSettlement->transactiondate!='')?date('d-m-Y',strtotime($billSettlement->transactiondate)):''}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Deposit Account <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8  input-group-sm">
								<select class="form-control single-select kt-selectpicker depositaccount" id="depositaccount" name="depositaccount">
									<option value="">select</option>
									@foreach($fullLedger as $ledger)
									<?php
									$lSelected = '';
									if (($billSettlement->depositaccount == $ledger['id']) && ($ledger['parent_id'] == '~'))
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
								<input type="text" class="form-control" name="notes" id="notes" value="{{$billSettlement->notes}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>Reference</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="reference" id="reference" value="{{$billSettlement->reference}}">
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
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 15%;">@lang('app.Mode of Payment')</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 45%;">@lang('app.Reference')</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 30%;">@lang('app.Amount')</th>
										<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($billSettlementProducts as $key => $value)
									<tr>
										<td class="row_count" id="rowcount" style="padding: 0; text-align: center">{{$key+1}}</td>
										<td style="padding: 0;">
											<select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment{{$key}}" data-id="{{$key}}">
												<option value="">Select</option>
												<option value="1" {{($value->modeofpayment==1)?'selected':''}}>Cash</option>
												<option value="2" {{($value->modeofpayment==2)?'selected':''}}>Card</option>
												<option value="3" {{($value->modeofpayment==3)?'selected':''}}>Bank</option>
												<option value="4" {{($value->modeofpayment==4)?'selected':''}}>Cheque</option>
											</select>
										</td>
										<td style="padding: 0;">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control preference" name="preference[]" id="preference{{$key}}" data-id="{{$key}}" value="{{$value->preference}}">
											</div>
										</td>
										<td style="padding: 0;">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control amount integerVal" name="amount[]" id="amount{{$key}}" data-id="{{$key}}" value="{{$value->amount}}">
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
											<input type="text" class="form-control" name="addtotal" id="addtotal" value="{{$billSettlement->addtotal}}" readonly>
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
			No Sale Order Fount For {{$billSettlement->cust_name}}
			@endif

		</div>
	</div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.payments').addClass('kt-menu__item--open');
		$('.sales_bill_settlement_sell').addClass('kt-menu__item--active');

		var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
		var sl = ($("#modeofpaymenttable > tbody > tr").length) + 1;
		$(".addmorepayments").click(function() {
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;text-align: center">' + sl + '</td>\
					  <td style="padding: 0;">\
					  <select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment' + rowcount + '" data-id=' + rowcount + '>\
					 <option value="">Select</option>\
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
			sl++;
			rowcount++;
			$('.kt-selectpicker').select2();
		});
	});
	$('.kt_datetimepickerr').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
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


	$(document).on('click', '.vcheck', function() {
		var voucher_id = {};
		voucher_id.checkselected = [];
		voucher_id.checkselectedvalues = [];
		$("input:checkbox").each(function() {
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
		$('.amount').each(function() {
			var id = $(this).attr('data-id');
			var amount = $('#amount' + id + '').val();
			totalamount += parseFloat(amount);
		});
		$('#addtotal').val(totalamount);
		var total = $('#paidamount').val();
		if (total < totalamount) {
			toastr.warning('Amount is less than or Equal to Paid Amount');
		} else {

			/*
			totaldueamount = $('#totaldueamount').val();
			balance = parseFloat(totaldueamount) - parseFloat(totalamount);
			$('#payingamount').val(totalamount.toFixed(2));
			$('#creditinvoice_pay').attr('disabled',false);
			$('#balanceamount').val(balance.toFixed(2));
			*/
		}
	}

	$(document).on('click', '#bill_settlement_submit', function(e) {
		customer_select = $('#customer_select').val();
		dueamount = $('#dueamount').val();
		depositaccount = $('#depositaccount').val();
		if (customer_select == "") {
			$('#customer_select').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Please Select Customer!");
			return false;
		} else {
			$('#customer_select').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (dueamount == "") {
			$('#dueamount').addClass('is-invalid');
			toastr.warning("Please Add Due amount!");
			return false;
		} else {
			$('#dueamount').removeClass('is-invalid');
		}
		if (depositaccount == "") {
			$('#depositaccount').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Please Select Deposit account!");
			return false;
		} else {
			$('#depositaccount').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		var error = 0;
		var modeofpayment = [];
		$("select[name^='modeofpayment[]']").each(function(input) {
			modeofpayment.push($(this).val());
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
		var addtotal = $('#addtotal').val();
		var paidamount = $('#paidamount').val();
		if (paidamount != addtotal) {
			toastr.warning('Paid Amount is not equal to Total Amount')
			return false;
		}
		var voucher_id = {};
		voucher_id.checkselected = [];
		$("input:checkbox").each(function() {
			var $this = $(this);
			if ($this.is(":checked")) {
				voucher_id.checkselected.push($this.attr("id"));
			} else {
				//
			}
		})
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
				url: "sales_bill_settlement_update_sell",
				dataType: "json",
				data: {
					_token: $('#token').val(),
					id: $('#id').val(),
					customer_select: $('#customer_select').val(),
					dueamount: $('#dueamount').val(),
					paidamount: $('#paidamount').val(),
					depositaccount: $('#depositaccount').val(),
					notes: $('#notes').val(),
					reference: $('#reference').val(),
					addtotal: $('#addtotal').val(),
					vouchers: voucher_id.checkselected,
					modeofpayment: modeofpayment,
					preference: preference,
					amount: amount,
					transactiondate: $('#transactiondate').val(),
					status: status,
				},
				success: function(data) {
					$('#bill_settlement_submit').removeClass('kt-spinner');
					$('#bill_settlement_submit').prop("disabled", false);
					window.location.href = "sales_bill_settlement_sell";
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
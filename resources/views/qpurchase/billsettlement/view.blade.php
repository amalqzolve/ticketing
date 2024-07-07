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
					{{$billSettlement->code}}/{{$billSettlement->br_id}} For - {{$billSettlement->sup_name}}
				</h3>
			</div>

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<button class=" backHome btn btn-brand btn-elevate btn-icon-sm">
						<i class="flaticon2-left-arrow-1"></i> Back </button>
				</div>
			</div>

		</div>

		<div class="kt-portlet__body">

			@if(count($vouchers)>0)
			<input type="hidden" name="id" id="id" value="{{$billSettlement->id}}">
			<input type="hidden" name="supplier_select" id="supplier_select" value="{{$billSettlement->supplier}}">

			<div id="results">
				<table class="table table-striped table-hover table-checkable dataTable no-footer">
					<thead>
						<tr>
							<!-- <th>#</th> -->
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
							<!-- <td><input type="checkbox" class="vcheck invoices" checked id="{{$voucherss->vid}}" value="{{$voucherss->balance_amount+$voucherss->curPay}}" /></td> -->
							<td>{{$voucherss->vid}}</td>
							<td>{{($voucherss->bill_entry_date!='')?date('d-m-Y',strtotime($voucherss->bill_entry_date)):''}}</td>
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
								<input type="text" class="form-control integerVal" name="paidamount" id="paidamount" value="{{$billSettlement->paidamount}}" readonly>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Transaction Date')</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control kt_datetimepickerr" name="transactiondate" id="transactiondate" value="{{($billSettlement->transactiondate!='')?date('d-m-Y',strtotime($billSettlement->transactiondate)):''}}" readonly>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label>Reference</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="reference" id="reference" value="{{$billSettlement->reference}}" readonly>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4"></div>
							<div class="col-md-8 input-group-sm">
								<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
									<input type="checkbox" id="credit_from_another" name="credit_from_another" value="1" {{($billSettlement->credit_from_another==1)?'checked':''}}> Credit From Another Ledger
									<span></span>
								</label>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="creditFrom" style="display: {{($billSettlement->credit_from_another==1)?'block':'none'}};">
							<div class="form-group  row pr-md-3">
								<div class="col-md-4">
									<label>Credit From <span style="color: red">*</span></label>
								</div>
								<div class="col-md-8 input-group-sm">
									<select name="credit_from_ledjer" id="credit_from_ledjer" class="form-control kt-selectpicker" disabled>
										<option value="" selected>Select</option>
										@foreach($allLedger as $ledger)
										<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{($ledger['parent_id'] == '~') && ($ledger['id'] == $billSettlement->credit_from_ledjer)?'selected':''}}>
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
									<input type="checkbox" id="use_advance" name="use_advance" value="1" {{($billSettlement->use_advance==1)?'checked':''}}> Use Advance
									<span></span>
								</label>
							</div>
							<div class="col-md-4 useAdvance" style="display: {{($billSettlement->use_advance==1)?'block':'none'}};">
								Credit Balance : {{$debitBalance}}
								<input type="hidden" name="debitBalance" id="debitBalance" value="{{$debitBalance}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="useAdvance" style="display: {{($billSettlement->use_advance==1)?'block':'none'}};">
							<div class="form-group  row pr-md-3">
								<div class="col-md-4">
									<label>Pay From Advance <span style="color: red">*</span></label>
								</div>
								<div class="col-md-8 input-group-sm">
									<input type="text" class="form-control integerVal amount" name="advance_amt" id="advance_amt" value="{{$billSettlement->advance_amt}}" readonly>
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
								<textarea class="form-control" name="notes" id="notes" cols="30" rows="4" readonly>{{$billSettlement->notes}}</textarea>
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
										<!-- <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">Action</th> -->
									</tr>
								</thead>
								<tbody>
									@if(count($billSettlementProducts)>0)
									@foreach ($billSettlementProducts as $key => $value)
									<tr>
										<td class="row_count" id="rowcount" style="padding: 0; text-align: center">{{$key+1}}</td>
										<td style="padding: 0;">
											<select class="form-control single-select kt-selectpicker" name="debitaccount[]" disabled>
												<option value="">Select</option>
												@foreach($fullLedger as $ledger)
												<option value="{{$ledger->id}}" {{(($value->debitaccount==$ledger->id))?'selected':''}}>[{{$ledger->code}}] {{$ledger->name}} </option>
												@endforeach
											</select>
										</td>
										<td style="padding: 0;">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control preference" name="preference[]" id="preference{{$key}}" data-id="{{$key}}" value="{{$value->preference}}" readonly>
											</div>
										</td>
										<td style="padding: 0;">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control amount integerVal" name="amount[]" id="amount{{$key}}" data-id="{{$key}}" value="{{$value->amount}}" readonly>
											</div>
										</td>
										<!-- <td style="padding: 0;">
											<div class="kt-demo-icon__preview costremove">
												<i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
											</div>
										</td> -->
									</tr>
									@endforeach
									@else
									<tr>
										<td class="row_count" id="rowcount" style="padding: 0; text-align: center">1</td>
										<td style="padding: 0;">
											<select class="form-control single-select kt-selectpicker" name="debitaccount[]">
												<option value="">Select</option>
												@foreach($fullLedger as $ledger)
												<option value="{{$ledger->id}}">[{{$ledger->code}}] {{$ledger->name}} </option>
												@endforeach
											</select>
										</td>
										<td style="padding: 0;">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control preference" name="preference[]" id="preference1" data-id="1" value="">
											</div>
										</td>
										<td style="padding: 0;">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control amount integerVal" name="amount[]" id="amount1" data-id="1" value="">
											</div>
										</td>
										<!-- <td style="padding: 0;">
											<div class="kt-demo-icon__preview costremove">
												<i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
											</div>
										</td> -->
									</tr>
									@endif
								</tbody>
							</table>
							<!-- <table style="width:100%;">
								<tr>
									<td>
										<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right"><i class="la la-plus"></i>Add More</button>
									</td>
								</tr>
							</table> -->


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
										<!-- <button type="submit" name="bill_settlement_submit" id="bill_settlement_submit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
												<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
												<polyline points="22 4 12 14.01 9 11.01"></polyline>
											</svg> Save </button> -->
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
			No Sale Order Fount For {{$billSettlement->sup_name}}
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

	});
</script>
@endsection
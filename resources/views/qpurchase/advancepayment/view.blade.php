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
					{{$adwancePaymnt->code}}/{{$adwancePaymnt->br_id}}
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
			<!--begin: Datatable -->
			<input type="hidden" name="id" id="id" value="{{$adwancePaymnt->id}}">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group row pr-md-3">
						<div class="col-md-4">
							<label>@lang('app.Supplier') <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8  input-group-sm">
							<select class="form-control single-select kt-selectpicker supplier loadInvoice" name="supplier" id="supplier" disabled>
								<option value="">Select</option>
								@foreach($suppliers as $data)
								<option value="{{$data->id}}" {{($adwancePaymnt->supplier_id==$data->id)?'selected':''}}>{{$data->sup_name}} [{{$data->sup_code}}]</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group  row pr-md-3">
						<div class="col-md-4">
							<label>Date <span style="color: red">*</span></label>
						</div>
						<div class="col-md-8 input-group-sm">

							<input type="text" class="form-control kt_datetimepickerr" name="date" id="date" value="{{($adwancePaymnt->date!='')?date('d-m-Y',strtotime($adwancePaymnt->date)):''}}" readonly>
						</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="form-group  row pr-md-3">
						<div class="col-md-2">
							<label>Notes</label>
						</div>
						<div class="col-md-10 input-group-sm">
							<textarea class="form-control" name="notes" id="notes" readonly>{{$adwancePaymnt->notes}}</textarea>
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
								</tr>
							</thead>
							<tbody>
								@foreach ($adwancePaymntMethods as $key => $method)
								<tr>
									<td class="row_count" id="rowcount" style="padding: 0;">{{$key+1}}</td>
									<td style="padding: 0;">
										<select class="form-control single-select kt-selectpicker" name="accountledger_debitaccount[]" disabled>
											<option value="">Select</option>
											@foreach($fullLedger as $ledger)
											<option value="{{$ledger->id}}" {{(($method->accountledger_debitaccount==$ledger->id))?'selected':''}}>[{{$ledger->code}}] {{$ledger->name}} </option>
											@endforeach
										</select>
									</td>
									<td style="padding: 0;">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control preference" name="preference[]" id="preference{{$key}}" data-id="{{$key}}" value="{{$method->preference}}" readonly>
										</div>
									</td>
									<td style="padding: 0;">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control amount integerVal" name="amount[]" id="amount{{$key}}" data-id="{{$key}}" value="{{$method->amounts}}" readonly>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>

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
								<input type="text" class="form-control" name="total_amount" id="total_amount" value="{{$adwancePaymnt->total_amount}}" readonly>
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
							</svg> &nbsp;Back</button>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- <script src="{{url('/')}}/resources/js/qpurchase/advancepayment.js" type="text/javascript"></script> -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.PaymentVoucher').addClass('kt-menu__item--open');
		$('.qpurchase_advancepayment').addClass('kt-menu__item--active');
	});
</script>
@endsection
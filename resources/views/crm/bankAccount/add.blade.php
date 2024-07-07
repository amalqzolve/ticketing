@extends('crm.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					{{ __('supplier.New Bank Details For') }} - {{$supplier->sup_name}}
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form">
				<div class="row" style="padding-bottom: 6px;">
					<input type="hidden" name="suppler_id" id="suppler_id" value="{{$supplier->id}}">
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Beneficiary Name') }} <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="beneficiary_name" id="beneficiary_name">
							</div>
						</div>
					</div>



					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Bank Name') }} <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="bank_name" id="bank_name">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Branch Name') }} </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="branch_name" id="branch_name">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Branch Code') }} </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="branch_code" id="branch_code">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Bank Address') }} </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="bank_address" id="bank_address">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Account Number') }} <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="account_number" id="account_number">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.IBAN/ Siwft') }} <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="iban_swift_code" id="iban_swift_code">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>{{ __('supplier.Notes') }} </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="notes" id="notes">
							</div>
						</div>
					</div>



				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="submit" name="tax_submit" id="saveDetails" class="btn btn-primary">@lang('app.Save')</button>
								<button type="reset" class="btn btn-secondary cancel" onclick="back()">@lang('app.Cancel')</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{url('/')}}/resources/js/crm/bankAccount/save.js" type="text/javascript"></script>
<script>
	$('.SupplierManagement').addClass('kt-menu__item--open');
	$('.supplier-bank-account').addClass('kt-menu__item--active');
</script>
@endsection
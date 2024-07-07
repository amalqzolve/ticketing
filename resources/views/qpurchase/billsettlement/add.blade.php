@extends('qpurchase.common.layout')
@section('content')
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
					Bill Settlement
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">
			<form method="GET" id="supplierForm" action="{{ route('qpurchase-supplier-submit') }}">
				<div class="row justify-content-center" style="padding-bottom: 6px;">
					<div class="col-lg-12">
						<div class="form-group row pl-md-3">
							<div class="col-md-4">
								<label>Supplier<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker supplier" id="supplier" name="supplier">
									<option value="" selected>select</option>
									@foreach($suppliers as $data)
									<option value="{{$data->id}}">{{$data->sup_name}} [{{$data->sup_code}}]</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-auto">
						<br>
						<button type="button" id="btnSubmit" class="btn btn-primary" style="float:right;">Submit</button>
					</div>
				</div>
			</form>

		</div>
	</div>





</div>
@endsection

@section('script')
<script type="text/javascript">
	
	$('.PaymentVoucher').addClass('kt-menu__item--open');
	$('.qpurchase-bill-settlement-list').addClass('kt-menu__item--active');

	$(document.body).on('click', "#btnSubmit", function(e) {
		e.preventDefault();
		var supplier = $('#supplier').val();
		if (supplier == "") {
			$('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Supplier is required.");
			return false;
		} else {
			$('#supplier').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		$('#supplierForm').submit();
	});
</script>
@endsection
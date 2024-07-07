@extends('qpurchase.common.layout')

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
					Purchase Return
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
					</div>
				</div>
			</div>
		</div>

		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<form method="GET" id="loadForm" action="{{ route('qpurchase-invoice-load-for-return') }}">
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Supplier')<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8  input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="supplier" name="supplier">
									<option value="">select</option>
									@foreach($suppliers as $data)
									<option value="{{$data->id}}">{{$data->sup_name}} [{{$data->sup_code}}]</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Purchase Invoice ID<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8  input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="purchasenumber" name="purchasenumber">
									<option value="">select</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<button type="button" class="btn btn-primary" id="btnSumbit" name="btnSumbit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@section('script')
<script type="text/javascript">
	$('.qpurchase-return').addClass('kt-menu__item--active');
	$(document.body).on("click", "#btnSumbit", function() {
		if ($('#supplier').val() == "") {
			$('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} else
			$('#supplier').next().find('.select2-selection').removeClass('select-dropdown-error');

		if ($('#purchasenumber').val() == "") {
			$('#purchasenumber').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} else
			$('#purchasenumber').next().find('.select2-selection').removeClass('select-dropdown-error');

		$("#loadForm").trigger("submit");
	});
	$(document.body).on("change", "#supplier", function() {
		var cid = $(this).val();
		$('select[name="purchasenumber"]').find('option').remove().end().append('<option value="">select</option>').val('');
		$.ajax({
			url: "get-purchase-number-for-rerurn",
			method: "POST",
			data: {
				_token: $('#token').val(),
				id: cid
			},
			dataType: "json",
			success: function(data) {
				$.each(data.data, function(key, value) {
					$('select[name="purchasenumber"]').append('<option value="' + value.id + '">' + value.id + '</option>');
				});
			}
		})
	});
</script>
@endsection
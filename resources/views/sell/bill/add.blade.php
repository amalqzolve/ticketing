@extends('sell.common.layout') @section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
			<form method="GET" id="customerForm" action="{{ route('customer_submit_sell') }}">
				<div class="row justify-content-center" style="padding-bottom: 6px;">
					<div class="col-lg-12">
						<div class="form-group row pl-md-3">
							<div class="col-md-4">
								<label>Customer<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker customer" id="customer_select" name="customer_select">
									<option value="" selected>select</option>
									@foreach($customers as $data)
									<option value="{{$data->id}}">{{$data->cust_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-auto">
						<br>
						<button type="button" id="customer_submit" class="btn btn-primary" style="float:right;">Submit</button>
					</div>
				</div>
			</form>




		</div>
	</div>





</div>
@endsection @section('script')
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.payments').addClass('kt-menu__item--open');
	$('.sales_bill_settlement_sell').addClass('kt-menu__item--active');

	$(document.body).on('click', "#customer_submit", function(e) {
		e.preventDefault();
		var customer_select = $('#customer_select').val();
		if (customer_select == "") {
			$('#customer_select').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Customer is required.");
			return false;
		} else {
			$('#customer_select').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		$('#customerForm').submit();
	});
</script>
@endsection
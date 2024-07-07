@extends('boq.common.layout')
@section('content')
<?php
foreach ($boq as $boq) {
	$id = $boq->id;
	$productname = $boq->productname;
	$unit = $boq->unit;
	$quantity = $boq->quantity;
	$rate = $boq->rate;
	$discountamount = $boq->discountamount;
	$amount1 = $boq->amount1;
	$vatamount = $boq->vatamount;
	$totalamount = $boq->totalamount;
	$description = $boq->description;
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					BOQ
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form">
				<div class="row" style="padding-bottom: 6px;">
					<input type="hidden" name="id" id="id" value="{{$id}}">
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>BOQ Line Item</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker" name="productname" id="productname">
									<option value="">Select</option>
									@foreach($productlist as $productlists)
									<option value="{{$productlists->product_id }}" <?php if ($productname == $productlists->product_id) {
																						echo "selected";
																					} ?>> {{$productlists->product_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Unit</label>
							</div>
							<div class="col-md-8">
								<div class="input-group input-group-sm">
									<select class="form-control single-select kt-selectpicker" name="unit" id="unit">
										<option value="">Select</option>
										@foreach($unitlist as $unitlists)
										<option value="{{$unitlists->id }}" <?php if ($unit == $unitlists->id) {
																				echo "selected";
																			} ?>>
											{{$unitlists->unit_name}}
										</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Quantity</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control quantity" name="quantity" id="quantity" autocomplete="off" value="{{$quantity}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Rate</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control rate" name="rate" id="rate" autocomplete="off" value="{{$rate}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Discount</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control discountamount" name="discountamount" id="discountamount" autocomplete="off" value="{{$discountamount}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Amount</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control amount" name="amount" id="amount" autocomplete="off" readonly="" value="{{$amount1}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Vat Percentage</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control vat_percentage" name="vat_percentage" id="vat_percentage" autocomplete="off" value="15%" readonly="">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Vat Amount</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control vatamount" name="vatamount" id="vatamount" autocomplete="off" readonly="" value="{{$vatamount}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row  pr-md-3">
							<div class="col-md-4">
								<label>Total Amount</label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control totalamount" name="totalamount" id="totalamount" autocomplete="off" readonly="" value="{{$totalamount}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Description</label>
							</div>
							<div class="col-md-8">
								<div class="input-group input-group-sm">
									<textarea class="form-control" name="description" id="description" autocomplete="off">{{$description}}
									</textarea>
								</div>
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
								<button id="innerboqupdate" class="btn btn-primary">{{ __('product.Update') }}</button>
								<button type="button" class="btn btn-secondary float-right mr-2 backHome">{{ __('app.Cancel') }}</button>


							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}
</style>
@endsection
@section('script')
<script type="text/javascript">
	function goPrev() {
		window.history.back();
	}
</script>
<script type="text/javascript">
	$('body').on('change', '.quantity', function() {

		row_calculate(id);
	});
	$('body').on('change', '.rate', function() {

		row_calculate(id);
	});
	$('body').on('change', '.discountamount', function() {
		row_calculate(id);
	});

	function row_calculate(id) {
		var quantity = $('#quantity').val();
		var rate = $('#rate').val();
		// var vatamount= $('#vatamount'+id+'').val();
		var discountamount = $('#discountamount').val();
		var total = parseFloat(quantity * rate) - parseFloat(discountamount);

		var vatamount = (total * 15) / 100;
		var grandtotalamount = parseFloat(total) + parseFloat(vatamount)
		$('#amount').val(total.toFixed(2));
		$('#vatamount').val(vatamount.toFixed(2));
		$('#totalamount').val(grandtotalamount.toFixed(2));

	}
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/boq/innerboq.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>

@endsection
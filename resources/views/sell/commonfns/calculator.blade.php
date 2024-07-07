@extends('sell.common.layout') @section('content')

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
					Calculator
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">
			<div class="row p-0" style="background-color:#f2f3f8;">
				<div class="col-12 p-0">
					<hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0;">
					<br>
					<br>
					<div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="product_table">
								<thead class="thead-light">
									<tr>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Quantity')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; width:20%;"> @lang('app.Rate')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"> @lang('app.Amount')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Discount Type</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Discount')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Discount Amount </th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; ">@lang('app.VAT')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.VAT Amount')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"> @lang('app.Total Amount')</th>
									</tr>
								</thead>
								<tbody>

									<tr>
										<td>
											<div class="input-group input-group-sm">
												<input type="text" style="    width: 1cm;" class="form-control quantity integerVal  normalCalculation" data-id="0" name="quantity[]" id="quantity0" value="1">
											</div>
										</td>
										<td>
											<div class="input-group input-group-sm">
												<input type="text" style="width: 1cm;width: 1cm;" class="form-control rate integerVal  normalCalculation" name="rate[]" id="rate0" data-id="0" value="0">
											</div>
										</td>
										<td>
											<div class="input-group input-group-sm">
												<input type="text" class="form-control amount integerVal  normalCalculation" name="amount[]" data-id="0" id="amount0" value="0">
											</div>
										</td>
										<td>
											<select style="width: 2cm;" class="form-control form-control-sm single-select kt-selectpicker selectChanged" data-id="0" id="discount_type">
												<option value="1">Flat</option>
												<option value="2">Percentage</option>
											</select>
										</td>
										<td>
											<div class="input-group input-group-sm">
												<input type="text" class="form-control discount_type_amount integerVal  normalCalculation" data-id="0" name="discount_type_amount[]" id="discount_type_amount0" value="0">
											</div>
										</td>
										<td>
											<div class="input-group input-group-sm">
												<input type="text" class="form-control row_total row_total_change  normalCalculation" data-id="0" name="discountamountData[]" id="discountamountData0" data-id="0" value="0" readonly>
											</div>
										</td>
										<td>
											<select style="width: 2cm;" class="form-control form-control-sm single-select vat_percentage kt-selectpicker selectChanged" data-id="0" name="vat_percentage[]" id="vat_percentage0">
												@foreach ($vatlist as $data)
												<option value="{{ $data->total }}"> {{ $data->total }}</option>
												@endforeach
											</select>
										</td>
										<td>
											<input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount0" data-id=0 value="0" readonly>
										</td>
										<td>
											<div class="input-group input-group-sm">
												<input type="text" class="form-control row_total row_total_change integerVal" data-id="0" name="row_total[]" id="row_total0" value="0">
											</div>
										</td>

									</tr>

								</tbody>
							</table>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!--end::Modal-->
@endsection @section('script')
<script type="text/javascript">
	$('body').on('keyup', '.normalCalculation', function() {
		var row = $(this).attr('data-id');
		normalCalculation(row);
	});

	$('body').on('change', '.selectChanged', function() {
		var row = $(this).attr('data-id');
		normalCalculation(row);
	});


	function normalCalculation(id) {
		var quantity = getNum($('#quantity' + id + '').val());
		var rate = getNum($('#rate' + id + '').val());
		var vat_percentage = getNum($('#vat_percentage' + id + '').val());
		var discount_type_amount = getNum($('#discount_type_amount' + id + '').val());
		var total = parseFloat(quantity * rate);
		var disamount = 0;
		if ($('#discount_type').val() == 1) //discount as flat
			disamount = parseFloat(discount_type_amount);
		else if ($('#discount_type').val() == 2) { ////discount as %
			disamount = total * (discount_type_amount / 100);
		}

		$('#discountamountData' + id + '').val(disamount.toFixed(2));

		var amountafterDiscount = total - disamount;
		var vatamount = 0;
		if (vat_percentage != 0)
			var vatamount = amountafterDiscount * (vat_percentage / 100);

		$('#vatamount' + id + '').val(vatamount.toFixed(2));
		var rowtotal = parseFloat(total - disamount) + parseFloat(vatamount)
		total = getNum(total);
		rowtotal = getNum(rowtotal);
		$('#amount' + id + '').val(total.toFixed(2));
		$('#row_total' + id + '').val(rowtotal.toFixed(2));
	}



	$('body').on('keyup', '.row_total_change', function() {
		var row = $(this).attr('data-id');
		findRevercCalculation(row);

	});

	function findRevercCalculation(row) {
		var vatPercentage = getNum($('#vat_percentage' + row).val());
		var totalAmt = getNum($('#row_total' + row).val());
		var discountText = getNum($('#discount_type_amount' + row).val());
		var qty = getNum($('#quantity' + row).val());
		var amountBoforeDiscount = parseFloat(totalAmt) / (1 + (parseFloat(vatPercentage) / 100));
		var discount = 0;
		if ($('#discount_type').val() == 1) //discount as flat
			discount = parseFloat(discountText);
		else if ($('#discount_type').val() == 2) { ////discount as %
			discount = amountBoforeDiscount * (discountText / 100);
		}
		var amount = amountBoforeDiscount + discount;
		$('#amount' + row).val(amount.toFixed(2));

		var vat_amount = (vatPercentage / 100) * amount;
		$('#vatamount' + row).val(vat_amount.toFixed(2));

		var rate = amount / qty;
		$('#rate' + row).val(rate.toFixed(2));

	}


	function getNum(val) {
		// if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
		// 	return 0;
		// }
		return val;
	}
</script>
@endsection
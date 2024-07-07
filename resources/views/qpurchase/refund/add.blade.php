@extends('qpurchase.common.layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<style>
	.inputpicker-overflow-hidden {
		overflow: hidden;
		width: 100%;
	}

	.inputpicker-div>.inputpicker-input {
		font-size: 11px;
	}

	.inputpicker-arrow {
		top: 8px;
	}

	div.new1 {
		background-color: #f2f3f8;
		height: 20px;
		width: 100%;
		right: -36px;
		position: absolute;
		display: block;
	}

	.table>tbody>tr>td,
	.table>tbody>tr>th,
	.table>tfoot>tr>td,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>thead>tr>th {
		padding: 8px;
		line-height: 1.42857143;
		vertical-align: top;
		border-top: 1px solid #ddd;
	}

	.pluseb {
		background-color: #5d78ff;
		height: 100%;
		padding-top: 22%;
		text-align: center;
	}

	.pluseb:hover {
		background-color: #2a4eff;
	}

	.uppy-size--md .uppy-Dashboard-inner {
		width: 100%;
		height: 550px;
	}

	.table-bordered th,
	.table-bordered td {
		border: 0px solid #ebedf2;
		padding: 0px !important;
	}

	.nav-tabs {
		border-bottom: 0px;
	}

	.nav-tabs .nav-link {
		border: 3px solid transparent;
	}

	.nav-tabs .nav-link:hover,
	.nav-tabs .nav-link:focus {
		border-color: #f8fcff #fefeff #979fa8;
	}

	.nav-tabs .nav-link.active,
	.nav-tabs .nav-item.show .nav-link {
		border-color: #ffffff #ffffff #2275d7;
	}

	.mbtn {
		background-color: white;
		color: #74788d;

	}

	.mbtn:hover {
		color: #ffffff;
		background: #5d78ff;
		border-color: #5d78ff;

	}

	.mbdg1 {
		background: #fff;
		color: #a1a3a5;
	}

	.mbdg1:hover {
		background: #0ABB87;
		color: #fff;
	}

	.mbdg2 {
		background: #fff;
		color: #a1a3a5;
	}

	.mbdg2:hover {
		background: #FD397A;
		color: #fff;
	}

	.dataTables_wrapper .dataTable .selected th,
	.dataTables_wrapper .dataTable .selected td {
		background-color: #f4e92b !important;
		/* color: #595d6e; */
	}

	#productdetails_list_wrapper {
		height: 300px;
		overflow-y: scroll;
	}
</style>



<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Purchase Return refund
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body pl-2 pr-2 pb-0">

			<form class="kt-form" id="kt_form">


				<ul class="nav nav-tabs nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_0">Refund Details</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">Other Information</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
					</li>
				</ul>

				<input type="hidden" name="qbuy_purchase_return_id" id="qbuy_purchase_return_id" value="{{$return->id}}">
				<input type="hidden" name="qbuy_purchase_pi_id" id="qbuy_purchase_pi_id" value="{{$return->qbuy_purchase_pi_id}}">
				<input type="hidden" name="supplier_id" id="supplier_id" value="{{$return->supplier_id}}">

				<input type="hidden" name="id" id="id" value="">


				<div class="tab-content">
					<div class="tab-pane p-3 active" id="kt_tabs_2_0" role="tabpanel">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group  row pr-md-3">
									<div class="col-md-4">
										<label>@lang('app.Date') <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group-sm">
										<input type="text" class="form-control kt_datetimepickerr" name="date" id="date" value="{{date('d-m-Y') }}">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group  row pr-md-3">
									<div class="col-md-4">
										<label>Received By <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group-sm">
										<select class="form-control kt-selectpicker" id="rec_by" name="rec_by">
											<option value="">select</option>
											@foreach($salesmen as $man)
											<option value="{{$man->id}}">{{$man->name}} </option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group  row pr-md-3">
									<div class="col-md-2">
										<label>Notes</label>
									</div>
									<div class="col-md-10 input-group-sm">
										<textarea class="form-control" name="notes" id="notes"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane p-3 " id="kt_tabs_2_2" role="tabpanel">
						<div class="row">

							<div class="col-lg-6">
								<div class="form-group  row pr-md-3">
									<div class="col-md-4">
										<label>Supplier Code</label>
									</div>
									<div class="col-md-8 input-group-sm">
										<input type="text" class="form-control " value="{{$return->sup_code}}" readonly>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group  row pr-md-3">
									<div class="col-md-4">
										<label>Supplier Name</label>
									</div>
									<div class="col-md-8 input-group-sm">
										<input type="text" class="form-control " value="{{$return->sup_name}}" readonly>
									</div>
								</div>
							</div>


							<div class="col-lg-6">
								<div class="form-group  row pr-md-3">
									<div class="col-md-4">
										<label>Return ID</label>
									</div>
									<div class="col-md-8 input-group-sm">
										<input type="text" class="form-control " value="{{$return->id}}" readonly>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group  row pr-md-3">
									<div class="col-md-4">
										<label>Return Date</label>
									</div>
									<div class="col-md-8 input-group-sm">
										<input type="text" class="form-control " value="{{date('d-m-Y',strtotime($return->returndate))}}" readonly>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
						<div class="col-lg-12">
							<div class="form-group  row pr-md-3">
								<div class="col-md-3">
									<label> Terms & conditions</label>
								</div>
								<div class="col-md-9 input-group-sm">
									<select class="form-control single-select kt-selectpicker" id="terms_conditions" name="terms_conditions">
										<option value="">select</option>
										@foreach($termslist as $data)
										<option value="{{$data->id}}">{{$data->term}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>


						<div class="col-lg-12">
							<div class="form-group  row pr-md-3">
								<div class="col-md-12 input-group-sm">
									<div class="kt-tinymce">
										<textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>


				<div class="row p-0" style="background-color:#f2f3f8;">
					<div>
						<hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0;">
						<br>
						<br>
						<div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
							<table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%; ">
								<thead class="thead-light">
									<tr>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="10px">#</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="150px">@lang('app.Item Name')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Description')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="50px">@lang('app.Unit')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">Return Qty </th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Amount')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px;">@lang('app.VAT')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.VAT Amount')</th>
										<th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Total Amount')</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$grandTotal = 0;
									?>
									@foreach($returnedProduct as $key=>$cinvoice_products)

									<tr>
										<td>{{$key+1}}</td>

										<td>
											<input class="form-control  productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products->itemname}}" readonly>
										</td>
										<td><textarea class="form-control" rows="1" name="description[]" id="description{{$key+1}}" data-id="{{$key+1}}" readonly>{{$cinvoice_products->description}}</textarea></td>
										<td><input type="text" name="" id="" value="{{$cinvoice_products->unit_code}}" class="form-control" readonly></td>
										<td>
											<input type="text" class="form-control inv_qty" name="inv_qty[]" id="inv_qty{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->quantity}}" readonly>
										</td>
										<td><input type="text" class="form-control quantity integerVal" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->quantity}}" readonly></td>
										<td><input type="text" class="form-control rate" name="rate[]" id="rate{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rate}}" readonly></td>
										<td><input type="text" class="form-control discountamount" name="discountamount[]" id="discount_type_amount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->discountamount}}" readonly></td>
										<td><input type="text" class="form-control vat_percentage" name="vat_percentage[]" id="vat_percentage{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->vat_percentage}}" readonly></td>
										<td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->vatamount}}" readonly></td>
										<td><input type="text" class="form-control row_total" name="row_total[]" id="row_total{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->row_total}}"></td>
									</tr>
									<?php
									$grandTotal += $cinvoice_products->row_total;
									?>

									@endforeach

								</tbody>
							</table>
						</div>
						<hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">
					</div>
				</div>





				<div class="row mt-5">

					<div class="col-lg-6"></div>
					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label style="    font-size: 1rem;  font-weight: bold; padding-top:4px">Total Credit Note Amount</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{$return->grandtotalamount}}" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
							</div>
						</div>
					</div>
					<div class="col-lg-6"></div>
					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label style="    font-size: 1rem;  font-weight: bold; padding-top:4px">Refunded amount</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{$return->supplier_given_amt}}" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
							</div>
						</div>
					</div>
					<div class="col-lg-6"></div>
					<div class="col-lg-6">
						<div class="form-group  row pr-md-3">
							<div class="col-md-4">
								<label style="    font-size: 1.5rem;  font-weight: bold; padding-top:4px">Balance Amount</label>
							</div>
							<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="pending_balance_amt" id="pending_balance_amt" readonly value="{{$return->grandtotalamount-$return->supplier_given_amt}}" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
							</div>
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
								<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 15%;">Debit Account <span style="color: red">*</span></th>
								<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 45%;">@lang('app.Reference')</th>
								<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 30%;">@lang('app.Amount') <span style="color: red">*</span></th>
								<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="row_count" id="rowcount" style="padding: 0; text-align: center">1</td>
								<td style="padding: 0;">
									<select class="form-control" id="debitaccount[]" name="debitaccount[]">
										<option value="">select</option>
										@foreach($debitLedjer as $ledger)
										<option value="{{$ledger->id}}">[{{$ledger->code}}] {{$ledger->name}} </option>
										@endforeach
									</select>
								</td>
								<td style="padding: 0;">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control reference" name="reference[]" id="reference0" data-id="0">
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
								<button type="button" class="btn btn-primary float-right addmorepayments"><i class="la la-plus"></i>Add More</button>
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

			</div>
		</div>
		<div class="kt-portlet__foot pr-0">
			<div class="kt-form__actions">
				<div class="row">
					<div class="col-lg-6">
					</div>
					<div class="col-lg-6 kt-align-right">
						<button type="button" name="btnSubmit" id="btnSubmit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
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

		</form>
	</div>
</div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/qpurchase/refund.js" type="text/javascript"></script>


<script type="text/javascript">
	$('.qpurchase-return').addClass('kt-menu__item--active');
</script>
@endsection
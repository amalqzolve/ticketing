@extends('carRental.common.layout')
@section('content')



<!-- model -->
<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" href="#">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Trip </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="kt-portlet__body">
					<form class="kt-form kt-form--label-right" id="data-form-confirm" name="data-form-confirm">
						<input type="hidden" name="rental_id" id="rental_id">
						<div class="form-group row">

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Present Odometer <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control " name="trip_start_odometer" id="trip_start_odometer" value="">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Insurance ID <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control" name="ins_id" id="ins_id" value="">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Insurance Type <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control" name="ins_type" id="ins_type" value="">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Insurance Amount <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control integerVal" name="ins_amount" id="ins_amount" value="">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Insurance Start Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="ins_start_date" id="ins_start_date" value="{{date('d-m-Y')}}">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Insurance End Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="ins_end_date" id="ins_end_date" value="{{date('d-m-Y')}}">
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-2">
										<label>Note </label>
									</div>
									<div class="col-md-10 input-group input-group-sm">
										<textarea class="form-control " name="ins_note" id="ins_note" cols="10" rows="5" maxlength="500"></textarea>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Terms And Conditions <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<select class="form-control single-select kt-selectpicker" id="terms_conditions" name="terms_conditions">
											<option value="">Select</option>
											@foreach($termslist as $term)
											<option value="{{$term->id}}">{{$term->term}} </option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnConfirmSave" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg>
					&nbsp;Save
				</button>
			</div>
		</div>
	</div>
</div>
<!-- ./model -->



<!-- model -->
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" href="#">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete The Trip </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="kt-portlet__body">
					<form class="kt-form kt-form--label-right" id="data-form-complete" name="data-form-complete">
						<input type="hidden" name="id" id="id">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip Start Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control" name="trip_start_date" id="trip_start_date" value="" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip End Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control " name="trip_end_date" id="trip_end_date" value="{{date('d-m-Y')}}" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip Start Odometer </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control " name="trip_start_odometer" id="trip_start_odometer_11" value="" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip End Odometer </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control " name="trip_end_odometer" id="trip_end_odometer" value="">
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<center>
									<h4>Additional Cost</h4>
								</center>
							</div>

							<div class="col-lg-2"></div>
							<div class="cellQty col-lg-8">
								<table class="table table-bordered" id="additionalTable">
									<thead>
										<tr>
											<td> Sl No </td>
											<td> Remarks </td>
											<td> Amount </td>
											<td> Action </td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1
											</td>
											<td> <input type="text" name="remarks[]" id="remarks" data-id="remarks" class="form-control" value=""></td>
											<td> <input type="text" name="amount[]" id="amount" data-id="amount" class="form-control integerVal valChanged" value="0"></td>
											<td>
												<div class="kt-demo-icon__preview remove" style="width: fit-content; margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2">
												<h5>Total</h5>
											</td>
											<td> <input type="text" name="otherTotal" id="otherTotal" class="form-control" readonly></td>
										</tr>
									</tfoot>
								</table>
								<table style="width:100%">
									<tbody>
										<tr>
											<td style="width: 73%;">&nbsp;</td>
											<td>
												<button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="addrow"><i class="la la-plus"></i>Add Row</button>&nbsp;
											</td>
										</tr>
									</tbody>
								</table>
								<br>
							</div>
							<div class="col-lg-2"></div>


						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnCompleteSave" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg>
					&nbsp;Save
				</button>
			</div>
		</div>
	</div>
</div>
<!-- ./model -->



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
					Car Rental
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{url('car-rental/car-in-and-out-add')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							{{ __('product.New Record') }}
						</a>&nbsp;
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-download"></i> {{ __('product.Export') }}
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">{{ __('product.Choose an option') }}</span>
									</li>
									<li class="kt-nav__item" id="export-button-print">
										<span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">{{ __('product.Print') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">{{ __('product.Copy') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">{{ __('product.CSV') }}</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">{{ __('product.PDF') }}</span>
										</span>
									</li>
								</ul>
							</div>
						</div>



					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<!--begin::Portlet-->
			<div class="kt-portlet kt-portlet--tabs">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-toolbar">
						<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary nav-tabs-line-2x" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="1" data-toggle="tab" href="#kt_portlet_base_demo_1_1_tab_content" role="tab">
									<i class="la la-cog"></i> Draft
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="2" href="#kt_portlet_base_demo_1_2_tab_content" role="tab">
									<i class="la la-mail-forward"></i> Confirmed
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="3" href="#kt_portlet_base_demo_1_3_tab_content" role="tab">
									<i class="la la-check-circle-o"></i>Completed
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="4" href="#kt_portlet_base_demo_1_4_tab_content" role="tab">
									<i class="la la-times-circle-o"></i>Cancelled
								</a>
							</li>
						</ul>
					</div>
				</div>
				<input type="hidden" name="tblNames" id="tblNames" value="1">
				<div class="kt-portlet__body">
					<div class="tab-content">
						<div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
							<table class="table table-striped table-hover table-checkable dataTable no-footer" id="listDraft">
								<thead>
									<tr>
										<th>{{ __('product.S.No') }}</th>
										<th>Trip ID</th>
										<th>Car Name</th>
										<th>Rental Type</th>
										<th>Trip Start Date</th>
										<th>Trip End Date</th>
										<th>Renter Name</th>
										<th>Renter Phone</th>
										<th>Renter ID</th>
										<th>{{ __('product.Action') }}</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
							<table class="table table-striped table-hover table-checkable dataTable no-footer" id="listConfirmed">
								<thead>
									<tr>
										<th>{{ __('product.S.No') }}</th>
										<th>Trip ID</th>
										<th>Car Name</th>
										<th>Rental Type</th>
										<th>Trip Start Date</th>
										<th>Trip End Date</th>
										<th>Renter Name</th>
										<th>Renter Phone</th>
										<th>Renter ID</th>
										<th>{{ __('product.Action') }}</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
							<table class="table table-striped table-hover table-checkable dataTable no-footer" id="listCompleted">
								<thead>
									<tr>
										<th>{{ __('product.S.No') }}</th>
										<th>Trip Id</th>
										<th>Car Name</th>
										<th>Rental Type</th>
										<th>Trip Start Date</th>
										<th>Trip End Date</th>
										<th>Renter Name</th>
										<th>Renter Phone</th>
										<th>Renter ID</th>
										<th>Payment Status</th>
										<th>{{ __('product.Action') }}</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kt_portlet_base_demo_1_4_tab_content" role="tabpanel">
							<table class="table table-striped table-hover table-checkable dataTable no-footer" id="listCancelled">
								<thead>
									<tr>
										<th>{{ __('product.S.No') }}</th>
										<th>Trip Id</th>
										<th>Car Name</th>
										<th>Rental Type</th>
										<th>Trip Start Date</th>
										<th>Trip End Date</th>
										<th>Renter Name</th>
										<th>Renter Phone</th>
										<th>Renter ID</th>
										<th>{{ __('product.Action') }}</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!--end::Portlet-->

		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/carRental/CarInAndOut/list.js" type="text/javascript"></script>

@endsection
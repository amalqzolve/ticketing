@extends('carRental.common.layout')
@section('content')



<!-- models -->
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Add Milestone</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="data-from" name="data-from">
					<input type="hidden" name="id" id="id" value="">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Title <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="note_title" name="note_title" autocomplete="off">
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Note date<span style="color: red">*</span> </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" value="{{date('d-m-Y')}}" name="note_date" id="note_date">
									</div>
								</div>
							</div>


							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-2">
										<label>Description </label>
									</div>
									<div class="col-md-10">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" name="note_description" id="note_description" cols="30" rows="8" maxlength="1000"></textarea>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="col-lg-6"></div> -->
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>&nbsp; </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<div class="kt-checkbox-list">
											<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
												<input type="checkbox" id="public_flg" name="public_flg" value="1"> &nbsp; &nbsp; &nbsp; &nbsp; Mark as public Note
												<!-- checked="checked" -->
												<span></span>
											</label>
										</div>
									</div>
								</div>
							</div>




						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('customer.Cancel') }}</button>
				<button type="button" id="btnSaveNote" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg>
					&nbsp;Save
				</button>
			</div>
		</div>
	</div>
	</form>
</div>
<!-- ./models -->



<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">TRIP {{$carInOut->id}}</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

					</div>
				</div>
			</div>
		</div>


		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tabs">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary nav-tabs-line-2x" role="tablist">
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-overview',$id)}}" role="tab">
								<i class="la la-television"></i> Overview
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-agreements',$id)}}" role="tab">
								<i class="la la-exclamation"></i>Agreements
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-attachments',$id)}}" role="tab">
								<i class="la la la-chain"></i>Attachments
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link  active" data-toggle="tab" href="{{URL::to('car-rental/trip-notes',$id)}}" role="tab">
								<i class="la la-file-text"></i>Notes
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-additional-cost',$id)}}" role="tab">
								<i class="la la la-at"></i>Additional Cost
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-advance',$id)}}" role="tab">
								<i class="la la-search-plus"></i>Payments
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-proforma-invoice',$id)}}" role="tab">
								<i class="la la-database"></i>Proforma Invoice
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-invoices',$id)}}" role="tab">
								<i class="la la-align-justify"></i>Invoices
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('car-rental/trip-statement-of-accounts',$id)}}" role="tab">
								<i class="la la-rotate-left"></i>Statement Of Accounts
							</a>
						</li>


					</ul>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div class="tab-content">

					<div class="tab-pane active" role="tabpanel">
						<input type="hidden" name="car_in_out_id" id="car_in_out_id" value="{{$carInOut->id}}">
						<div class="kt-portlet__head ">
							<div class="kt-portlet__head-label">
								<h5 class="kt-portlet__head-title">Notes</h5>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions">
										<button type="button" id="btnAdd" class="btn btn-default btn-brand btn-elevate btn-icon-sm" data-type="add"><i class="la la-plus"></i>New Record</button>
									</div>
								</div>
							</div>
						</div>

						<table class="table table-striped  table-hover table-checkable" id="notesTbl">
							<thead>
								<tr>
									<th>{{ __('customer.Sl. No') }}</th>
									<th>Note Date</th>
									<th>Tittle</th>
									<th>Description</th>
									<th>Action</th>
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


@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/carRental/CarInAndOutFunctions/notes.js" type="text/javascript"></script>
@endsection
@extends('carRental.common.layout')
@section('content')
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
							<a class="nav-link  " href="{{URL::to('car-rental/trip-notes',$id)}}" role="tab">
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
							<a class="nav-link  active" data-toggle="tab" href="{{URL::to('car-rental/trip-proforma-invoice',$id)}}" role="tab">
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
						<div class="kt-portlet__head ">
							<div class="kt-portlet__head-label">
								<h5 class="kt-portlet__head-title">Proforma Invoice</h5>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions">
										<a type="button" id="btnAdd" href="{{URL::to('car-rental/trip-proforma-invoice-add',$id)}}" class="btn btn-default btn-brand btn-elevate btn-icon-sm" data-type="add"><i class="la la-plus"></i>New Record</a>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="car_in_out_id" id="car_in_out_id" value="{{$carInOut->id}}">
						<table class="table table-striped  table-hover table-checkable" id="tblProformaInvoice">
							<thead>
								<tr>
									<th>@lang('app.S.No')</th>
									<th>@lang('app.Invoice ID')</th>
									<th>@lang('app.Date')</th>
									<th>Valid Till</th>
									<th>Car In Out ID</th>
									<th>@lang('app.Salesman')</th>
									<th>@lang('app.Grand Total')</th>
									<th>@lang('app.Status')</th>
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
<script src="{{url('/')}}/resources/js/carRental/CarInAndOutFunctions/proformaInvoice.js" type="text/javascript"></script>
@endsection
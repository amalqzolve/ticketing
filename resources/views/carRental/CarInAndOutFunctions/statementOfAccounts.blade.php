@extends('carRental.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">TRIP {{$carInOut->id}} (Statement Of Accounts)</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<a type="button" id="btnAdd" href="{{URL::to('car-rental/trip-statement-of-accounts-pdf',$id)}}" class="btn btn-brand btn-elevate btn-icon-sm" target="_blank"><i class="la la-file-pdf-o"></i>PDF</a>
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-download"></i> @lang('app.Export')
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="export-button-print">
										<span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
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
							<a class="nav-link  active" data-toggle="tab" href="{{URL::to('car-rental/trip-statement-of-accounts',$id)}}" role="tab">
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
						<table class="table table-striped  table-hover table-checkable" id="tblReceipt">
							<thead>
								<tr>
									<th>@lang('app.S.No')</th>
									<th>Transcation Date</th>
									<th>Trans ID</th>
									<th>Trans Type</th>
									<th>Notes</th>
									<th>Debit Amount</th>
									<th>Credit Amount</th>
									<!-- <th>Balance amount</th> -->
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
<script src="{{url('/')}}/resources/js/carRental/CarInAndOutFunctions/statementOfAccounts.js" type="text/javascript"></script>
@endsection
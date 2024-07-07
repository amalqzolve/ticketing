@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<?php
	$date = date('Y-m-d');

	?>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Documents
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-secondary mr-2" onclick="goPrev()"> <i class="la la-undo"></i>Back</button>
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>@lang('customer.Export')</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">

									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="customer_document_details_list_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customer_document_details_list_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>

										</span>
									</li>
									<li class="kt-nav__item" id="customer_document_details_list_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="customer_document_details_list_pdf"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>&nbsp;
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable" id="customer_docs_details_list">
				<thead>
					<tr role="row">

						<th>@lang('customer.Sl. No')</th>
						<th>@lang('customer.Document Name')</th>
						<th>@lang('customer.Expiry Date')</th>
						<th>@lang('customer.Status')</th>

					</tr>
				</thead>
				<tbody>
					@foreach($docs as $key=>$docss)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$docss->docname}}</td>
						<td>{{$docss->expdate1}}</td>
						<td>
							@if($docss->expdate >= $date)
							<span class="badge badge-light-primary text-success ">Active</span>
							@else
							<span class="badge badge-light-primary text-danger ">Expired</span>
						</td>
						@endif

					</tr>
					@endforeach
				</tbody>

			</table>
		</div>
	</div>
</div>.

@endsection
@section('script')
<script type="text/javascript">
	function goPrev() {
		window.history.back();
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

<script src="{{url('/')}}/resources/js/crm/customer.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {

		var customer_docs_details_list_table = $('#customer_docs_details_list').DataTable({
			processing: true,
			serverSide: false,
			pagingType: "full_numbers",
			scrollX: true,
			dom: 'Blfrtip',
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			buttons: [{
					extend: 'copy',
					className: "hidden",
					exportOptions: {
						columns: [0, 1, 2, 3]
					}
				},
				{
					extend: 'csv',
					className: "hidden",
					exportOptions: {
						columns: [0, 1, 2, 3]
					}
				},
				{
					extend: 'excel',
					className: "hidden",
					exportOptions: {
						columns: [0, 1, 2, 3]
					}
				},
				{
					extend: 'pdf',
					className: "hidden",
					exportOptions: {
						columns: [0, 1, 2, 3]
					},
					pageSize: 'A4',
					orientation: 'landscape',
					customize: function(doc) {
						doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
						doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
						doc.content[1].table.widths = ['15%', '15%', '15%', '15%',
							'15%', '15%', '13%'
						];
					}
				},
				{
					extend: 'print',
					className: "hidden",
					exportOptions: {
						columns: [0, 1, 2, 3]
					}
				}
			],

		})


	});
</script>
<script>
	$('.CustomerManagement').addClass('kt-menu__item--open');
	$('.crmcustomerdocuments').addClass('kt-menu__item--active');
</script>

@endsection
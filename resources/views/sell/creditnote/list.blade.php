@extends('sell.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">
				<a href="#" class="btn kt-subheader__btn-primary">
					@lang('app.Back')
				</a>
				<a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
					@lang('app.Trash')
				</a>
			</div>
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
					@lang('app.Credit Note')
				</h3>

			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

						<a href="{{url('/')}}/Add-creditnote_sell" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							@lang('app.New Record')
						</a>
						<div class="dropdown dropdown-inline">
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

		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped table-hover table-checkable dataTable no-footer" id="creditnotedetails_list">
				<thead>
					<tr>
						<th>@lang('app.Sl.No')</th>
						<th>ID</th>
						<th>@lang('app.InvoiceID')</th>
						<th>@lang('app.InvoiceDate')</th>
						<th>@lang('app.Customer')</th>
						<th>Mobile</th>
						<th>@lang('app.Grand Total')</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>

				</tbody>


			</table>

			<!--end: Datatable -->

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
<script type="text/javascript">
	var creditnotedetails_list_table = $('#creditnotedetails_list').DataTable({
		processing: true,
		serverSide: true,
		pagingType: "full_numbers",
		dom: 'Blfrtip',
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		buttons: [{
				extend: 'copy',
				className: "hidden",
				exportOptions: {
					columns: [0, 1, 2, 3, 4]
				}
			},
			{
				extend: 'csv',
				className: "hidden",
				exportOptions: {
					columns: [0, 1, 2, 3, 4]
				}
			},
			{
				extend: 'excel',
				className: "hidden",
				exportOptions: {
					columns: [0, 1, 2, 3, 4]
				}
			},
			{
				extend: 'pdf',
				className: "hidden",
				exportOptions: {
					columns: [0, 1, 2, 3, 4]
				},
				pageSize: 'A4',
				orientation: 'landscape',
				customize: function(doc) {
					doc.pageMargins = [50, 50, 50, 50];
				}
			},
			{
				extend: 'print',
				className: "hidden",
				exportOptions: {
					columns: [0, 1, 2, 3, 4]
				}
			}
		],
		ajax: {
			"url": 'creditnote_sell',
			"type": "POST",
			"data": function(data) {
				data._token = $('#token').val()
			}
		},
		order: [
			[1, 'desc']
		],
		"fnRowCallback": function(nRow, aData, iDisplayIndex) {
			$("td:first", nRow).html(iDisplayIndex + 1);
			return nRow;
		},
		columns: [{
				data: 'DT_RowIndex',
				name: 'DT_RowIndex'
			},
			{
				data: 'id',
				name: 'id',
			},
			{
				data: 'invoiceid',
				name: 'invoiceid',
			},
			{
				data: 'quotedate',
				name: 'quotedate',
			},
			{
				data: 'cust_name',
				name: 'cust_name',
			},
			{
				data: 'mobile1',
				name: 'mobile1'
			},
			{
				data: 'grandtotalamount',
				name: 'grandtotalamount',
			},
			{
				data: 'status',
				name: 'status',
			},
			{
				data: 'action',
				name: 'action'
			},
		],
		columnDefs: [{
			"width": "5%",
			"orderable": false,
			"searchable": false,
			targets: [0, 7, 8]
		}, {
			"width": "5%",
			targets: [6]
		}, {
			"width": "10%",
			targets: [1, 2]
		}, ]

	});
	$(document).on('click', '.creditnoteApprove', function() {
		var id = $(this).attr('id');
		swal.fire({
			title: "Are you sure?",
			text: "Do you want Approve This Credit Note",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Approve",
			cancelButtonText: "Cancel"
		}).then(result => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "creditnote-approve",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Credit Note Approved successfuly');
							window.location.href = "creditnote_sell";
						} else {
							swal.fire({
								title: "Error !!!",
								text: data.msg,
								type: "error",
							});
						}

					},
					error: function(jqXhr, json, errorThrown) {
						console.log('Error !!');
					}
				});

			} else {
				swal.fire("Cancelled", "", "error");
			}
		})
	});

	$(document).on('click', '.creditnoteDelete', function() {
		var id = $(this).attr('id');
		swal.fire({
			title: "Are you sure?",
			text: "Do you want Delete This Credit Note",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
			cancelButtonText: "Cancel"
		}).then(result => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "creditnote-delete",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Credit Deleted successfuly');
							window.location.href = "creditnote_sell";
						} else {
							swal.fire({
								title: "Error !!!",
								text: data.msg,
								type: "error",
							});
						}

					},
					error: function(jqXhr, json, errorThrown) {
						console.log('Error !!');
					}
				});

			} else {
				swal.fire("Cancelled", "", "error");
			}
		})
	});
</script>
<script>
	$(document).ready(function() {
		$('.creditnote_sell').addClass('kt-menu__item--active');
	});
</script>
@endsection
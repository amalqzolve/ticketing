@extends('sell.common.layout')



@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
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
				Advance Receipts

			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

						@can('Advance Receipts Add')
						<a href="{{url('/')}}/advancepayment_add_sell" class="btn btn-brand btn-elevate btn-icon-sm">
							New Record

						</a>@endcan


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
			<table class="table table-striped table-hover table-checkable dataTable no-footer" id="advancepaymentdetails_list">
				<thead>
					<tr>
						<th>@lang('app.Sl.No')</th>
						<th>ID</th>
						<th>@lang('app.Date')</th>
						<th>@lang('app.Customer')</th>
						<th>Mobile</th>
						<th>@lang('app.Grand Total')</th>
						<th>@lang('app.Transaction Type')</th>
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
<script>
	$(document).ready(function() {
		$('.payments').addClass('kt-menu__item--open');
		$('.advancepayment_sell').addClass('kt-menu__item--active');

		var advancepaymentdetails_list_table = $('#advancepaymentdetails_list').DataTable({
			processing: true,
			serverSide: true,
			pagingType: "full_numbers",
			dom: 'Blfrtip',
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			order: [
				[1, 'desc']
			],
			ajax: {
				"url": 'advancepayment_sell',
				"type": "POST",
				"data": function(data) {
					data._token = $('#token').val()
				}
			},
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'id',
					name: 'id'
				},
				{
					data: 'date',
					name: 'date'
				},
				{
					data: 'cust_name',
					name: 'cust_name',
					render: function(data, type, row) {
						var curData = row.cust_name;
						if (curData != null)
							return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
						else
							return '-';
					}
				},
				{
					data: 'mobile1',
					name: 'mobile1'
				},
				{
					data: 'total_amount',
					name: 'total_amount'
				},
				{
					data: 'status',
					name: 'status'
				},
				{
					data: 'action',
					name: 'action',
				},
			],
			columnDefs: [{
				width: '50px',
				"orderable": false,
				"searchable": false,
				targets: [0, 7]
			}, {
				width: '50px',
				targets: [6]
			}, ],

		})


		$("#export-button-print").on("click", function() {
			advancepaymentdetails_list_table.button('.buttons-print').trigger();
		});
		$("#export-button-copy").on("click", function() {
			advancepaymentdetails_list_table.button('.buttons-copy').trigger();
		});
		$("#export-button-csv").on("click", function() {
			advancepaymentdetails_list_table.button('.buttons-csv').trigger();
		});
		$("#export-button-pdf").on("click", function() {
			advancepaymentdetails_list_table.button('.buttons-pdf').trigger();
		});

		$(document).on('click', '.adwance_confirm', function() {
			var id = $(this).attr('id');
			swal.fire({
				title: "Are you sure?",
				text: "Do you want Approve ",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Approve",
				cancelButtonText: "Cancel"
			}).then(result => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: "advancepayment-approve",
						dataType: "json",
						data: {
							_token: $('#token').val(),
							id: id,
						},
						success: function(data) {
							if (data.status == 1) {
								toastr.success('Adwance Approved successfuly');
								window.location.href = "advancepayment_sell";
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


	});
</script>
@endsection
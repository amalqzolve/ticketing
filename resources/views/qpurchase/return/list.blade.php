@extends('qpurchase.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Purchase Return
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{url('qpurchase-return-add')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
									<li class="kt-nav__item" id="debitnotedetails_list_print">
										<span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="debitnotedetails_list_copy">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="debitnotedetails_list_csv">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="debitnotedetails_list_pdf">
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
			<table class="table table-striped table-hover table-checkable dataTable no-footer" id="debitnotedetails_list">
				<thead>
					<tr>
						<th>@lang('app.Sl.No')</th>
						<th>Return ID</th>
						<th>Return Date</th>
						<th>@lang('app.Supplier')</th>
						<th>Invoice NO</th>
						<th>Invoice Date</th>
						<th>Total</th>
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
<script type="text/javascript">
	$('.qpurchase-return').addClass('kt-menu__item--active');
	var debitnotedetails_list_table = $('#debitnotedetails_list').DataTable({
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
		order: [
			[1, 'desc']
		],
		ajax: {
			"url": 'qpurchase-return',
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
				data: 'returndate',
				name: 'returndate'
			},
			{
				data: 'sup_name',
				name: 'sup_name'
			},
			{
				data: 'pur_inv_code',
				name: 'pur_inv_code'
			},
			{
				data: 'quotedate',
				name: 'quotedate'
			},
			{
				data: 'grandtotalamount',
				name: 'grandtotalamount'
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
			targets: [0, 8]
		}, ],

	});



	$(document).on('click', '.purchase_return_approve', function() {
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
					url: "qpurchase-return-approve",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Purchase Return Approved successfuly');
							window.location.href = "qpurchase-return";
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

	$(document).on('click', '.purchase_return_delete', function() {
		var id = $(this).attr('id');
		swal.fire({
			title: "Are you sure?",
			text: "Do you want Delete ",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
			cancelButtonText: "Cancel"
		}).then(result => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "qpurchase-return-delete",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Purchase Return Deleted successfuly');
							window.location.href = "qpurchase-return";
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
@endsection
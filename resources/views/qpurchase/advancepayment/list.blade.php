@extends('qpurchase.common.layout')
@section('content')
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
				Advance Payments
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{url('/')}}/qpurchaseadvancepayment_add" class="btn btn-brand btn-elevate btn-icon-sm">
							New Record
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
			<table class="table table-striped table-hover table-checkable dataTable no-footer" id="advancepaymentdetails_list">
				<thead>
					<tr>
						<th>@lang('app.Sl.No')</th>
						<th>ID</th>
						<th>@lang('app.Date')</th>
						<th>Supplier Name</th>
						<th>Grand Total</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		$('.PaymentVoucher').addClass('kt-menu__item--open');
		$('.qpurchase_advancepayment').addClass('kt-menu__item--active');
		var advancepaymentdetails_list_table = $('#advancepaymentdetails_list').DataTable({
			processing: true,
			serverSide: true,
			pagingType: "full_numbers",
			dom: 'Blfrtip',
			order: [
				[1, 'desc']
			],
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			ajax: {
				"url": 'qpurchase_advancepayment',
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
					data: 'sup_name',
					name: 'sup_name',
					render: function(data, type, row) {
						var curData = row.sup_name;
						if (curData != null)
							return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
						else
							return '-';
					}
				},
				{
					data: 'total_amount',
					name: 'total_amount'
				},
				{
					data: 'status',
					name: 'status',
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
				targets: [0, 6]
			}, {
				width: '80px',
				targets: [2]
			}, {
				width: '70px',
				targets: [1, 2, 5]
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
					url: "qpurchase-advancepayment-approve",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Advance Approved successfuly');
							window.location.href = "qpurchase_advancepayment";
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


	$(document).on('click', '.adwance_delete', function() {
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
					url: "qpurchase-advancepayment-delete",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Advance Deleted successfuly');
							window.location.href = "qpurchase_advancepayment";
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
@extends('qpurchase.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/crm/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Opening Balance
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button>
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('customer.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="tblList_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="tblList_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="tblList_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="tblList_pdf"> <span class="kt-nav__link">
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
			<table class="table table-striped  table-hover table-checkable" id="tblList">
				<thead>
					<tr>
						<th><strong>{{ __('app.Sl. No') }}</strong></th>
						<th><strong>ID</strong></th>
						<th><strong>Supplier</strong></th>
						<th><strong>Date</strong></th>
						<th><strong>Debit Amount</strong></th>
						<th><strong>Credit Amount</strong></th>
						<th><strong>Note</strong></th>
						<th><strong>Reference</strong></th>
						<th><strong>Status</strong></th>
						<th><strong>{{ __('customer.Action') }}</strong></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Opening Balance
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="group-form" name="group-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4 pl-md-4">
										<label style="text-align: left;">Supplier <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<select class="form-control  single-select kt-selectpicker" id="supplier" name="supplier">
												<option value="" selcted>Select</option>
												@foreach ($suppliers as $key => $value)
												<option value="{{$value->id}}">{{$value->sup_name}} [{{$value->sup_code}}]</option>
												@endforeach
											</select>

										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-1">
									<div class="col-md-4">
										<label>Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control kt_datetimepickerr" placeholder="Date" id="date" name="date">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4 pl-md-4">
										<label style="text-align: left;">Method <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<select class="form-control  single-select kt-selectpicker" id="method" name="method">
												<option value="" selected>Select</option>
												<option value="Debit">Debit</option>
												<option value="Credit">Credit</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-1">
									<div class="col-md-4">
										<label>Amount <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control integerVal" placeholder="Amount" id="amount" name="amount" value="0">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4 pl-md-4">
										<label style="text-align: left;">Note</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="Note" id="note" name="note" autocomplete="off"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4 pl-md-4">
										<label style="text-align: left;">Reference</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="Reference" id="reference" name="reference" autocomplete="off"></textarea>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button id="btn_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg> {{ __('app.Save') }}</button>
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg> {{ __('customer.Cancel') }}</button>


			</div>
		</div>
	</div>
	</form>
</div>

@endsection
@section('script')
{{-- Data table Assets --}}
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/settings/group.js" type="text/javascript"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
	$('.kt_datetimepickerr').datepicker({
		todayHighlight: true,
		format: 'dd-mm-yyyy'
	}).on('changeDate', function(e) {
		$(this).datepicker('hide');
	});
	var tblList = $('#tblList').DataTable({
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
				orientation: 'portrait',
				customize: function(doc) {
					doc.content[1].table.widths =
						Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					doc.pageMargins = [100, 100, 100, 100];
					doc.defaultStyle.alignment = 'center';
					doc.styles.tableHeader.alignment = 'center';
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
		order: [
			[1, 'desc']
		],
		ajax: {
			"url": 'qpurchase-opening-balance-index',
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
				data: 'pob_code',
				name: 'pob_code'
			},
			{
				data: 'sup_name',
				name: 'sup_name'
			},
			{
				data: 'date',
				name: 'date'
			},
			{
				data: 'amount',
				name: 'amount',
				render: function(data, type, row) {
					if (row.method == 'Debit')
						return row.amount;
					else
						return '-';
				}
			},

			{
				data: 'amount',
				name: 'amount',
				render: function(data, type, row) {
					if (row.method == 'Credit')
						return row.amount;
					else
						return '-';
				}
			},
			{
				data: 'note',
				name: 'note'
			},
			{
				data: 'reference',
				name: 'reference'
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
			targets: [0, 9]
		}, ],
	});

	$("#customergroupdetails_list_print").on("click", function() {
		tblList.button('.buttons-print').trigger();
	});
	$("#customergroupdetails_list_copy").on("click", function() {
		tblList.button('.buttons-copy').trigger();
	});
	$("#customergroupdetails_list_csv").on("click", function() {
		tblList.button('.buttons-csv').trigger();
	});
	$("#customergroupdetails_list_pdf").on("click", function() {
		tblList.button('.buttons-pdf').trigger();
	});
	$(document).on('click', '#btn_submit', function(e) {
		e.preventDefault();



		if ($('#supplier').val() == "") {
			$('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("Supplier is required.");
			return false;
		} else {
			$('#supplier').next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		if ($('#date').val() == "") {
			$('#date').addClass('is-invalid');
			return false;
		} else {
			$('#date').removeClass('is-invalid');
		}
		if ($('#method').val() == "") {
			$('#method').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning("method is required.");
			return false;
		} else {
			$('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if ($('#amount').val() == 0) {
			$('#amount').addClass('is-invalid');
			return false;
		} else {
			$('#amount').removeClass('is-invalid');
		}

		if ($('#id').val()) {
			var sucess_msg = 'Updated';
		} else {
			var sucess_msg = 'Created';
		}

		swal.fire({
			title: 'Do you want to save As ?',
			icon: 'warning',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Approved',
			denyButtonText: 'Draft',
			customClass: {
				actions: 'my-actions',
				cancelButton: 'order-1 right-gap',
				confirmButton: 'order-2',
				denyButton: 'order-3',
			},
		}).then((result) => {
			if (result.isConfirmed) {
				// Swal.fire('Saved!', '', 'success')
				saveDetails(result)
			} else if (result.isDenied) {
				// Swal.fire('Changes are not saved', '', 'info')
				saveDetails(result)
			} else
				swal.fire("Cancelled", "", "error");
		});

		function saveDetails(result) {
			var status = (result.isConfirmed) ? "Approved" : "Draft";
			$('#btn_submit').addClass('kt-spinner');
			$('#btn_submit').prop("disabled", true);
			$.ajax({
				type: "POST",
				url: "qpurchase-opening-balance-save",
				dataType: "json",
				data: {
					_token: $('#token').val(),
					info_id: $('#id').val(),
					supplier: $('#supplier').val(),
					date: $('#date').val(),
					method: $('#method').val(),
					amount: $('#amount').val(),
					note: $('#note').val(),
					reference: $('#reference').val(),
					status: status
				},
				success: function(data) {
					if (data == false) {
						$('#btn_submit').removeClass('kt-spinner');
						$('#btn_submit').prop("disabled", false);
					} else {
						$('#btn_submit').removeClass('kt-spinner');
						$('#btn_submit').prop("disabled", false);
						closeModel();
						tblList.ajax.reload();
						toastr.success('Opening Balance ' + sucess_msg + ' successfuly');
					}
				},
				error: function(jqXhr, json, errorThrown) {
					$('#btn_submit').removeClass('kt-spinner');
					$('#btn_submit').prop("disabled", false);
					toastr.error('Opening Balance ' + sucess_msg + ' Error');
				}
			});
		}
	});

	$(document).on('click', '.customergroupupdate', function() {
		$('#supplier').val('');
		$('#date').val('');
		$('#method').val('');
		$('#amount').val('');
		$('#note').val('');
		$('#reference').val('');
		$("#id").val('');
		var info_id = $(this).attr("data-id");
		$.ajax({
			url: "qpurchase-opening-balance-update",
			method: "POST",
			data: {
				_token: $('#token').val(),
				info_id: info_id
			},
			dataType: "json",
			success: function(data) {
				if (data.status == 1) {
					$('#supplier').val(data.data.supplier);
					$('#date').val(data.data.date);
					$('#method').val(data.data.method);
					$('#amount').val(data.data.amount);
					$('#note').val(data.data.note);
					$('#reference').val(data.data.reference);
					$("#id").val(info_id);
				}
				$('.kt-selectpicker').select2();
			}
		})
	});

	$(document).on('click', '.close,.closeBtn', function() {
		closeModel();

	});

	function closeModel() {
		$("#kt_modal_4_5").modal("hide");
		$('#supplier').val('');
		$('#date').val('');
		$('#method').val('');
		$('#amount').val('');
		$('#note').val('');
		$('#reference').val('');
		$("#id").val('');
		$('.kt-selectpicker').select2();
	}

	$(document).on('click', '.openingBalanceApprove', function() {
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
					url: "qpurchase-opening-balance-approve",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('opening-balance Approved successfuly');
							tblList.ajax.reload();
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

	$(document).on('click', '.openingBalancedelete', function() {
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
					url: "qpurchase-opening-balance-delete",
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id,
					},
					success: function(data) {
						if (data.status == 1) {
							toastr.success('Opening Balance Deleted successfuly');
							tblList.ajax.reload();
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
	$('.PaymentVoucher').addClass('kt-menu__item--open');
	$('.qpurchase-opening-balance-index').addClass('kt-menu__item--active');
</script>

@endsection
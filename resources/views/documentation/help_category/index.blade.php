@extends('documentation.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="public/assets/css/wheelpicker.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">Categories</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@can('documentation add category')
						<button type="button" id="btnAddRec" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>New Record</button>
						@endcan

						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('customer.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_pdf"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						{{-- <a href="{{url('/')}}/grouptrash" type="button" class="btn btn-secondary btn-hover-warning btn-icon-sm"> @lang('app.Trash')
						</a> --}}
					</div>
				</div>
			</div>
		</div>

		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable" id="help_category_list">
				<thead>
					<tr>
						<th>{{ __('customer.Sl. No') }}</th>
						<th>{{ __('customer.Title') }}</th>
						<th>Description</th>
						<th>Sort</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody></tbody>

			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="model_head">Add Category</h5>
				<button type="button" id="closeBtn" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="group-form" name="group-form" method="POST">
					@csrf
					<div class="kt-portlet__body">
						<input type="hidden" name="post_id" id="post_id">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Title') }}</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="title" name="title" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Description</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="Description" id="description" name="description" autocomplete="off"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Sort</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<input type="number" class="form-control" placeholder="Sort" id="sort" name="sort" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;">
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-lg-6">
								<div class="form-group row  pr-md-3">
									<div class="col-md-4">
										<label>Status</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm ">
											<input type="radio" name="status" value="Active" checked="checked" id="status_active" style="margin-right: 8px;">
											<label for="status_active" class="form-check-label">Active</label>
											<input type="radio" name="status" value="Inactive" id="status_inactive" style="margin-right: 8px; margin-left: 15px;">
											<label for="status_inactive" class="form-check-label">Inactive</label>
										</div>
									</div>

								</div>
							</div> -->


							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Status</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<select class="form-control single-select kt-selectpicker" id="status" aria-label="Floating label select example" name="status" style="border-color: #e5e8ee; display: inline-block;height: 28px;width: 100%;">
												<option value="Active">Active</option>
												<option value="Inactive">Inactive</option>
											</select>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg> Close
				</button>
				<!-- <button class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light" id="add_help_category">{{ __('app.Save') }}</button> -->

				<button id="add_help_category" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
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

<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}
</style>


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

<script type="text/javascript">
	$('.help_support').addClass('kt-menu__item--open');
	$('.help_categories').addClass('kt-menu__item--active');
	/**
	 *Datatable for help Category
	 */

	var help_category_list_table = $('#help_category_list').DataTable({
		processing: true,
		serverSide: true,
		scrollX: true,
		order: [
			[3, 'asc']
		],
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
					doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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

		ajax: {
			"url": 'help_categories',
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
				data: 'title',
				name: 'title',
				className: 'client',
				render: function(data, type, row) {
					var curData = row.title;
					if (curData != null)
						return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
					else
						return '-';
				}
			},
			{
				data: 'description',
				name: 'description',
				className: 'client',
				render: function(data, type, row) {
					var curData = row.description;
					if (curData != null)
						return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
					else
						return '-';
				}
			},
			{
				data: 'sort',
				name: 'sort'
			},
			{
				data: 'status',
				name: 'status'
			},
			{
				data: 'action',
				name: 'action',
			},

		]
	});


	$(document).on('click', '#add_help_category', function(e) {
		e.preventDefault()

		title = $('#title').val();
		description = $('#description').val();
		sort = $('#sort').val();

		if (title == "") {
			$('#title').addClass('is-invalid');
			toastr.warning('Title is Required');
			return false;
		} else
			$('#title').removeClass('is-invalid');


		if (sort == "") {
			$('#sort').addClass('is-invalid');
			toastr.warning('Sort is Required');
			return false;
		} else
			$('#sort').removeClass('is-invalid');

		$('#add_help_category').addClass('kt-spinner');
		$('#add_help_category').prop("disabled", true);
		$.ajax({
			type: "POST",
			url: "help_categoriesSubmit",
			dataType: "json",

			data: {
				_token: $('#token').val(),
				id: $('#id').val(),
				title: $('#title').val(),
				description: $('#description').val(),
				sort: $('#sort').val(),
				status: $('#status').val()
			},

			success: function(data) {
				if (data.status == 1) {
					closeModel();
					help_category_list_table.ajax.reload();
					toastr.success('Help category added successfuly');

					$("#post_id").val(data.id);
					$("#title").val(data.title);
					$("#description").val(data.description);
					$("#sort").val(data.sort);
					$('#kt_modal_4_5').modal('hide');
					$('#add_help_category').removeClass('kt-spinner');
					$('#add_help_category').prop("disabled", false);
				} else {
					if (data.status == 2) {
						$('#title').addClass('is-invalid');
						toastr.error(data.msg);
					}
					if (data.status == 3) {
						$('#sort').addClass('is-invalid');
						toastr.error('Help category sort order is already exist');
						$('#add_help_category').removeClass('kt-spinner');
						$('#add_help_category').prop("disabled", false);
					}
				}
				$('#add_help_category').removeClass('kt-spinner');
				$('#add_help_category').prop("disabled", false);

			},
			error: function(jqXhr, json, errorThrown) {
				console.log('Error !!');
			}

		});
	});

	function closeModel() {
		$('#model_head').text('Add Category');
		$("#kt_modal_4_5").modal("hide");
		$('#id').val("");
		$('#title').val("");
		$('#description').val("");
		$('#sort').val("");

		$('#title').removeClass('is-invalid');
		$('#sort').removeClass('is-invalid');
		$('#status').val('Active');
		refreshItems();

	}


	$(document).on('click', '#closeBtn', function() {
		closeModel();
	});

	// btnAddRec

	$(document).on('click', '.helpcategoryedit', function() {
		var help_category_id = $(this).attr("data-id");
		$('#model_head').text('Edit Category');
		$.ajax({
			url: "getHelpCategory",
			method: "POST",
			data: {
				_token: $('#token').val(),
				help_category_id: help_category_id
			},
			dataType: "json",

			success: function(data) {
				if (data.status == 1) {
					$('#kt_modal_4_5').modal('show');
					$('#title').val(data['helpCategory'].title);
					$('#description').val(data['helpCategory'].description);
					$('#sort').val(data['helpCategory'].sort);
					$('#status').val(data['helpCategory'].status);
					$('#id').val(data['helpCategory'].id);
					refreshItems();
				}


			}

		})
	});

	$(document).on('click', '.helpcategorydelete', function() {
		var id = $(this).attr('id');

		swal.fire({
			title: "Are you sure?",
			text: "You will not be able to recover this Help Category!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel it!"
		}).then(result => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: 'helpCategoryDelete',
					dataType: "json",
					data: {
						_token: $('#token').val(),
						id: id
					},
					success: function(data) {
						if (data.status == 1) {
							swal.fire("Deleted!", "Your help category has been deleted.", "success");
							help_category_list_table.ajax.reload();
						} else {
							toastr.error(data.msg);
						}
					}
				});
			} else {
				swal.fire("Cancelled", "Your Entry is safe :)", "error");
			}
		})
	});
</script>
@endsection
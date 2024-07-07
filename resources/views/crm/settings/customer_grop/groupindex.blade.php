@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/crm/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="public/assets/css/wheelpicker.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					{{ __('customer.Customer Group') }}
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@can('Customer Group Add')
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button> @endcan
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('customer.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_1_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_1_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_1_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="customergroupdetails_list_1_pdf"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<!-- <a href="{{url('/')}}/settingsgrouptrash" type="button" class="btn btn-secondary btn-hover-warning btn-icon-sm"> @lang('app.Trash')
						</a> -->
					</div>
				</div>
			</div>
		</div>

		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable" id="customergroupdetails_list_1">
				<thead>
					<tr>
						<th><strong>{{ __('app.Sl. No') }}</strong></th>
						<th><strong>{{ __('customer.Customer Group') }}</strong></th>
						<th><strong>{{ __('app.Default') }}</strong></th>
						<th><strong>{{ __('customer.Colour') }}</strong></th>
						<th><strong>{{ __('app.Note') }}</strong></th>
						<th><strong>{{ __('app.System ID') }}</strong></th>
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
					{{ __('customer.Customer Group') }}
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
										<label style="text-align: left;">{{ __('customer.Customer Group') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Customer Group') }} " id="title" name="title" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-1">
									<div class="col-md-4">
										<label>{{ __('customer.Colour') }}</label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Colour') }}" id="color" name="color" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4 pl-md-4">
										<label style="text-align: left;">{{ __('app.Note') }}</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="{{ __('app.Note') }}" id="description" name="description" autocomplete="off"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4 pl-md-4">
										<label style="text-align: left;">{{ __('app.Default') }}</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<select class="form-control grpdefault single-select kt-selectpicker" id="grpdefault" name="grpdefault">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row  pr-md-3">


									<input type="hidden" class="form-control" id="branch" name="branch" value="{{$branch}}">
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">

				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg> {{ __('customer.Cancel') }}</button>
				<button id="Group_submit_customer" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg> {{ __('app.Save') }}</button>

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

<script src="{{url('/')}}/public/assets/js/wheelpicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/settings/customer.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/settings/group.js" type="text/javascript"></script>


<script type="text/javascript">
	var customergroupdetails_table = $('#customergroupdetails_list_1').DataTable({
		processing: true,
		serverSide: true,
		scrollX: true,
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

		ajax: {
			"url": 'settingscustomergroup',
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
				name: 'title'
			},
			{
				data: 'default_grp',
				name: 'default_grp',
				render: function(data, type, row) {
					if (row.default_grp == '1') {
						return '<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>';
					} else {
						return '<i class="fa fa-times" aria-hidden="true" style="color: red;"></i>';
					}

				}
			},
			{
				data: 'color',
				name: 'color',
				render: function(data, type, row) {
					return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
				}
			},
			{
				data: 'description',
				name: 'description'
			},
			{
				data: 'id',
				name: 'id'
			},

			{
				data: 'action',
				name: 'action',
				render: function(data, type, row) {
					return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text customergroupupdate" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text kt_del_groupinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
				}
			},

		]
	});

	$("#customergroupdetails_list_print").on("click", function() {
		customergroupdetails_table.button('.buttons-print').trigger();
	});


	$("#customergroupdetails_list_copy").on("click", function() {
		customergroupdetails_table.button('.buttons-copy').trigger();
	});

	$("#customergroupdetails_list_csv").on("click", function() {
		customergroupdetails_table.button('.buttons-csv').trigger();
	});

	$("#customergroupdetails_list_pdf").on("click", function() {
		customergroupdetails_table.button('.buttons-pdf').trigger();
	});

	$(document).on('click', '#Group_submit_customer', function(e) {
		e.preventDefault();

		title = $('#title').val();
		color = $('#color').val();
		description = $('#description').val();
		default_grp = $('#grpdefault').val();

		if (title == "") {
			$('#title').addClass('is-invalid');
			return false;
		} else {
			$('#title').removeClass('is-invalid');
		}





		$(this).addClass('kt-spinner');
		$(this).prop("disabled", true);
		if ($('#id').val()) {
			var sucess_msg = 'Updated';
		} else {
			var sucess_msg = 'Created';
		}


		$.ajax({
			type: "POST",
			url: "settingsCustGroupinfo",
			dataType: "json",
			data: {
				_token: $('#token').val(),
				info_id: $('#id').val(),
				title: $('#title').val(),
				description: $('#description').val(),
				color: $('#color').val(),
				branch: $('#branch').val(),
				default_grp: $('#grpdefault').val()
			},
			success: function(data) {

				if (data == false) {

					$('#Group_submit_customer').removeClass('kt-spinner');
					$('#Group_submit_customer').prop("disabled", false);
					toastr.warning('The Customer Group Name Already Exists');

				} else {
					$('#Group_submit_customer').removeClass('kt-spinner');
					$('#Group_submit_customer').prop("disabled", false);
					closeModel();
					customergroupdetails_table.ajax.reload();
					toastr.success('customer group ' + sucess_msg + ' successfuly');
				}

			},
			error: function(jqXhr, json, errorThrown) {

				console.log('Error !!');
			}
		});
	});

	$(document).on('click', '.customergroupupdate', function() {

		var info_id = $(this).attr("data-id");
		$.ajax({
			url: "settingsgetgroupupdate1",
			method: "POST",
			data: {
				_token: $('#token').val(),
				info_id: info_id
			},
			dataType: "json",
			success: function(data) {
				$.each(data, function(key, value) {

					$(".grpdefault").val(value.default_grp).trigger("change");

					$("#title").val(value.title);
					$("#description").val(value.description);
					$("#color").val(value.color);
					$("#id").val(info_id);

				});
				// console.log(data);
				// 	$('#title').val(data.title);
				// 	$('#description').val(data.default_grp);
				// 	$('#color').val(data.color);
				// 	$('#grpdefault').val(data.default_grp);
				// 	$('#grpdefault').trigger('change');
				// 	$('#id').val(info_id);
			}
		})
	});

	$(document).on('click', '.close,.closeBtn', function() {

		closeModel();

	});

	function closeModel() {

		$("#kt_modal_4_5").modal("hide");
		$('#id').val("");
		$('#title').val("");
		$('#description').val("");
		$('#color').val("");

	}
</script>

<script>
	$('.CRMSettings').addClass('kt-menu__item--open');
	$('.CustomerSettings').addClass('kt-menu__item--open');
	$('.settingscustomergroup').addClass('kt-menu__item--active');
</script>

@endsection
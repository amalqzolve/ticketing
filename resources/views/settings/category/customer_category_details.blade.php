@extends('crm.common.layout')
 @section('content')
 <link href="{{ URL::asset('assets') }}/plugins/crm/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="public/assets/css/wheelpicker.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">	<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ __('customer.Customer Category List') }}										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@can('Customer Category Add')
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_4"><i class="la la-plus"></i>{{ __('app.New Record') }}</button>@endcan
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<i class="la la-download"></i>{{ __('app.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">	<span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_1_print">	<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_1_copy">	<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_1_csv">
										<a href="#" class="kt-nav__link">	<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_1_pdf">	<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						
						<!-- <a href="{{url('/')}}/settingscategorytrash" type="button" class="btn btn-secondary btn-hover-warning btn-icon-sm">	@lang('app.Trash')
						</a> -->
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable" id="customercategorydetails_list_1">
				<thead>
					<tr>
						<th><strong>{{ __('customer.S.No') }}</strong></th>
						<th><strong>{{ __('customer.Customer Category') }}</strong></th>
						<th><strong>{{ __('app.Default') }}</strong></th>
						<th><strong>{{ __('customer.Customer Code') }}</strong></th>
						<th><strong>{{ __('customer.Start From') }}</strong></th>
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
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('customer.Customer Category') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="category-form" name="category-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Customer Category') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Customer Category') }} " id="customer_category" name="customer_category" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
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
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Customer Code') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Customer Code') }} " id="cust_code" name="cust_code" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Start From') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="number" min=0 class="form-control" placeholder="{{ __('customer.Start From') }} " id="start_from" name="start_from" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-1">
									<div class="col-md-4">
										<label style="text-align: left;">{{ __('app.Default') }}</label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<select class="form-control catdefault single-select kt-selectpicker" id="catdefault" name="catdefault">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('app.Note') }}</label>
									</div>
									<div class="col-md-8 pl-2 pr-0">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="{{ __('app.Note') }}" id="description" name="description" autocomplete="off"></textarea>
										</div>
										<input type="hidden" class="form-control" id="branch" name="branch" value="{{$branch}}">
									</div>
								</div>
							</div>
						</div>
						
							
						<div class="form-group row">
							
						</div>
					</div>
					</form>
			</div>
			<div class="modal-footer">
				
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('customer.Cancel') }}</button>
				<button id="Category_submit_customer" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('app.Save') }}</button>

			</div>
		</div>
	</div>
	
</div>
<style type="text/css">
	.hideButton{
	   display: none
	}
	.error{
		color: red
	}
</style>
@endsection
 @section('script')
 <script type="text/javascript">
 
	$(document).on('click', '.close,.closeBtn', function() {

    closeModel1();

});
	function closeModel1() {
		
    $("#kt_modal_4_4").modal("hide");
    $('#id').val("");
    $('#customer_category').val("");
    $('#description').val("");
    $('#color').val("");
    $('#customcode').val("");
    $('#startfrom').val("");
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

<script src="{{url('/')}}/public/assets/js/wheelpicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/settings/customer.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/settings/category.js" type="text/javascript"></script>

<script type="text/javascript">
	var customercategorydetails_table = $('#customercategorydetails_list_1').DataTable({
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
								columns: [0, 1, 2, 3, 4, 5]
						}
				},
				{
						extend: 'csv',
						className: "hidden",
						exportOptions: {
								columns: [0, 1, 2, 3, 4, 5]
						}
				},
				{
						extend: 'excel',
						className: "hidden",
						exportOptions: {
								columns: [0, 1, 2, 3, 4, 5]
						}
				},
				{
						extend: 'pdf',
						className: "hidden",
						exportOptions: {
								columns: [0, 1, 2, 3, 4, 5]
						},
						pageSize: 'A4',
						orientation: 'landscape',
						customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '25%'];
                       }
				},
				{
						extend: 'print',
						className: "hidden",
						exportOptions: {
								columns: [0, 1, 2, 3, 4, 5]
						}
				}
		],

		ajax: {
				"url": 'settingscustomercategorydetails',
				"type": "POST",
				"data": function(data) {
						data._token = $('#token').val()
				}
		},
		columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'customer_category', name: 'customer_category' },
				{ 
            data: 'catdefault', name: 'catdefault', 
            render: function(data, type, row) {
                if (row.catdefault == '1') {
                    return '<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>';
                } else {
                    return '<i class="fa fa-times" aria-hidden="true" style="color: red;"></i>';
                }

            }
          },
				{ data: 'cust_code', name: 'cust_code' },
				{ data: 'start_from', name: 'start_from' },
				{
						data: 'color',
						name: 'color',
						render: function(data, type, row) {
								return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
						}
				},
				{ data: 'description', name: 'description' },
				{ data: 'id', name: 'id' },

				
				
				

				{
						data: 'action',
						name: 'action',
						render: function(data, type, row) {
								return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text Category_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text kt_del_categoryinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
						}
				},

		]
});
$("#customercategorydetails_list_1_print").on("click", function() {
		customercategorydetails_table.button('.buttons-print').trigger();
});


$("#customercategorydetails_list_1_copy").on("click", function() {
		customercategorydetails_table.button('.buttons-copy').trigger();
});

$("#customercategorydetails_list_1_csv").on("click", function() {
		customercategorydetails_table.button('.buttons-csv').trigger();
});

$("#customercategorydetails_list_1_pdf").on("click", function() {
		customercategorydetails_table.button('.buttons-pdf').trigger();
});

$(document).on('click', '#Category_submit_customer', function(e) {
		e.preventDefault();

		customer_category = $('#customer_category').val();
		color = $('#color').val();
		cust_code = $('#cust_code').val();
		start_from = $('#start_from').val();
		description = $('#description').val();

		if (customer_category == "") {
				$('#customer_category').addClass('is-invalid');
				return false;
		} else {
				$('#customer_category').removeClass('is-invalid');
		}
		
		if (cust_code == "") {
				$('#cust_code').addClass('is-invalid');
				return false;
		} else {
				$('#cust_code').removeClass('is-invalid');

		}
		if (start_from == "") {
				$('#start_from').addClass('is-invalid');
				return false;
		} else {
				$('#start_from').removeClass('is-invalid');

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
				url: "settingsCategoryinfo",
				dataType: "json",
				data: {
						_token: $('#token').val(),
						info_id: $('#id').val(),
						customer_category: $('#customer_category').val(),
						description: $('#description').val(),
						color: $('#color').val(),
						cust_code: $('#cust_code').val(),
						start_from: $('#start_from').val(),
						branch : $('#branch').val(),
						catdefault : $('#catdefault').val()

				},
				success: function(data) {

					if(data == false)
					{
						$('#Category_submit_customer').removeClass('kt-spinner');
						 $('#Category_submit_customer').prop("disabled", false);
						 toastr.warning('Customer Category Name Is Already Exist');

					}
					else
					{
						$('#Category_submit_customer').removeClass('kt-spinner');
						$('#Category_submit_customer').prop("disabled", false);
						closeModelcust();
						customercategorydetails_table.ajax.reload();
						toastr.success('Customer Category ' + sucess_msg + ' successfuly');
					}

				},
				error: function(jqXhr, json, errorThrown) {

						console.log('Error !!');
				}
		});
});

$(document).on('click', '.Category_update', function() {

		var info_id = $(this).attr("data-id");
		$.ajax({
				url: "settingsgetcategorylist",
				method: "POST",
				data: {
						_token: $('#token').val(),
						info_id: info_id
				},
				dataType: "json",
				success: function(data) {
					$.each(data, function(key, value) 
					{
						console.log(data['users']);
						$('#customer_category').val(value.customer_category);
						$('#description').val(value.description);
						$('#color').val(value.color);
						$('#cust_code').val(value.cust_code);
						$('#start_from').val(value.start_from);
						$(".catdefault").val(value.catdefault).trigger("change");
						
						$('#id').val(info_id);
					});
					

						// $("#usersInformation").modal("hide");

				}
		})
});
</script>


@endsection
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
				<h3 class="kt-portlet__head-title">Categories (Knowledge base)</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>Add category</button> 
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
			<table class="table table-striped  table-hover table-checkable" id="knowledge_base_list">
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
				<h5 class="modal-title" id="exampleModalLabel">Add category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="group-form" name="group-form" method="POST">
					 @csrf
					<div class="kt-portlet__body">
						 <input type="hidden" name="post_id" id="post_id">
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-6">
										<label>{{ __('customer.Title') }}</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="title" name="title" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-6">
										<label>Description</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="Description" id="description" name="description" autocomplete="off"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-6">
										<label>Sort</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm">
											<input type="number" class="form-control" placeholder="Sort" id="sort" name="sort" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row  pr-md-3">
									<div class="col-md-6">
										<label>Status</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm ">
											<input type="radio" name="status" value="Active" checked="checked" id="status_active" style="margin-right: 8px;">
											<label for="status_active" class="form-check-label">Active</label>
											<input type="radio" name="status" value="Inactive" id="status_inactive" style="margin-right: 8px; margin-left: 15px;">
											<label for="status_inactive" class="form-check-label">Inactive</label>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
			</div>
				<div class="modal-footer">
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">Close</button>
				<button class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light" id="add_knowledge_base_category">{{ __('app.Save') }}</button>
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

/**
 *Datatable for Knowledge Base Category
 */
 
	var knowledge_base_category_list_table = $('#knowledge_base_list').DataTable({
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
							 	doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
								doc.pageMargins = [100, 100, 100,100];
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
					"url": 'knowledge_base_categories',
					"type": "POST",
					"data": function(data) {
						data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'title', name: 'title' },
					{ data: 'description', name: 'description' },
					{ data: 'sort', name: 'sort' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text knowledgebasecategoryedit" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text knowledgebasecategorydelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});


	$(document).on('click', '#add_knowledge_base_category', function(e){
		e.preventDefault()
		
		title = $('#title').val();
		description = $('#description').val();
		sort = $('#sort').val();

    	$.ajax({
    		type: "POST",
    		url: "knowledge_base_categoriesSubmit",
    		dataType: "json",

    		data: {
    			_token		: $('#token').val(),
          		id 			: $('#id').val(),
          		title 		: $('#title').val(),
          		description : $('#description').val(),
          		sort 		:  $('#sort').val(),
          		status: $('input[name="status"]:checked').val()
        	},

        	success:function(data){
        		if(data){
            	closeModel();
            	toastr.success('Knowledge base category added successfuly');
            	knowledge_base_category_list_table.ajax.reload();
           
        		}

        		else{
        			closeModel();
        			toastr.success('Knowledge base category is already exist');
        		}
        		$("#post_id").val(data.id);
            	$("#title").val(data.title);
            	$("#description").val(data.description);
            	$("#sort").val(data.sort);
            	$('#kt_modal_4_5').modal('hide');
        	},
        	error: function(jqXhr, json, errorThrown) {
         		console.log('Error !!');
        	}
        
    	});
	});

	function closeModel() {

	    $("#kt_modal_4_5").modal("hide");
	    $('#id').val("");
	    $('#title').val("");
	    $('#description').val("");
	    $('#sort').val("");

	}


	$(document).on('click', '.knowledgebasecategoryedit', function() {

		var knowledge_base_category_id = $(this).attr("data-id");
		$.ajax({
			url: "getKnowledgeBaseCategory",
			method: "POST",
			data: {
				_token: $('#token').val(),
				knowledge_base_category_id: knowledge_base_category_id
			},
			dataType: "json",

			success: function(data) {
				 console.log(data);
				$('#title').val(data['knowledgeBaseCategory'].title);
				$('#description').val(data['knowledgeBaseCategory'].description);
				$('#sort').val(data['knowledgeBaseCategory'].sort);
				$('input[name="status"][value="'+data['knowledgeBaseCategory'].status+'"]').prop('checked',true);
				
				$('#id').val(data['knowledgeBaseCategory'].id);
				

			}

		})
	});

	$(document).on('click', '.knowledgebasecategorydelete', function() {
		var id = $(this).attr('id');
		
		swal.fire({
			title: "Are you sure?",
			text: "You will not be able to recover this knowledge base Category!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel it!"
		}).then(result => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: 'knowledgeBaseCategoryDelete',
					data: {
						_token: $('#token').val(),
						id: id
					},
					success: function(data) {
						// table.ajax.reload();
						swal.fire("Deleted!", "Your knowledge base category has been deleted.", "success");
						knowledge_base_category_list_table.ajax.reload();
					}
				});
			} else {
				swal.fire("Cancelled", "Your Entry is safe :)", "error");
			}
		})
	});




</script>

@endsection
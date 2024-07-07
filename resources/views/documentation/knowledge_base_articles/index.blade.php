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
				<h3 class="kt-portlet__head-title">Articles (Knowledge base)</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

						<a href="{{url('/')}}/addArticlebase" type="button" class="btn btn-brand btn-elevate btn-icon-sm">Add Neew Article</a>
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
			<table class="table table-striped  table-hover table-checkable" id="base_article_list">
				<thead>
					<tr>
						<th>{{ __('customer.Sl. No') }}</th>
						<th>{{ __('customer.Title') }}</th>
						<th>Category</th>
						<th>Status</th>
						<th>Sort</th>
						<th>{{ __('customer.Action') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
			display: none
		}
		.error {
			color: red
		}
	.tox-tinymce{
		width: 98%;
	}

</style>
@endsection
@section('script')

<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript">
</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript">
</script>

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
 *Datatable for help Category
 */
 	var base_article_list_table = $('#base_article_list').DataTable({
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
					"url": 'knowledge_base_articles',
					"type": "POST",
					"data": function(data) {
						data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'title', name: 'title' },
					{ data: 'category_title', name: 'category_title' },
					{ data: 'sort', name: 'sort' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
						<a href="basearticleedit?id=' + row.id + '" data-type="edit" data-target=""><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="basearticleview?id=' + row.id + '&&cid='+row.category+'" data-type="edit" data-target=""><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" data-cid="'+row.category+'">View</span>\
                        </span></li></a>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text helparticledelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});


	

$(document).on('click', '.helparticledelete', function() {
		var id = $(this).attr('id');
		
		swal.fire({
			title: "Are you sure?",
			text: "You will not be able to recover this Help Article!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel it!"
		}).then(result => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: 'deletebaseArticle',
					data: {
						_token: $('#token').val(),
						id: id
					},
					success: function(data) {
						// table.ajax.reload();
						swal.fire("Deleted!", "Your Base article has been deleted.", "success");
						base_article_list_table.ajax.reload();
					}
				});
			} else {
				swal.fire("Cancelled", "Your Entry is safe :)", "error");
			}
		})
	});




</script>

@endsection
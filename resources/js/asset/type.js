
var typedetails_list_table = $('#typedetails_list').DataTable({
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
									columns: [0, 1]
							}
					},
					{
							extend: 'csv',
							className: "hidden",
							exportOptions: {
									columns: [0, 1]
							}
					},
					{
							extend: 'excel',
							className: "hidden",
							exportOptions: {
									columns: [0, 1]
							}
					},
					{
							extend: 'pdf',
							className: "hidden",
							exportOptions: {
									columns: [0, 1]
							},
							pageSize: 'A4',
							orientation: 'landscape',
							customize: function(doc) {
									doc.pageMargins = [50, 50, 50, 50];
									doc.content[1].table.widths = [ '10%', '20%', '10%', '20%', '40%'];
							}
					},
					{
							extend: 'print',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4]
							}
					}
			],

			ajax: {
					"url": 'typelisting',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'id', name: 'id' },
					{ data: 'name', name: 'name' },
					{ data: 'description', name: 'description' },
					
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="editassettype?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-contract"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text typedelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},
			]
		});
$(document).on('click', '#assettype_submit', function(e) {
				e.preventDefault();
				var name = $('#name').val();
				var description = $('#description').val();
				

				$(this).addClass('kt-spinner');
				$(this).prop("disabled", true);
				if($('#id').val()){
				var sucess_msg ='Updated';
				} else{
				var sucess_msg ='Created';
				}

				$.ajax({
						type: "POST",
						url: "submit-assettype",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								name: $('#name').val(),
								description: $('#description').val(),
						},
						success: function(data) {
							if(data == true)
							{
								$('#assettype_submit').removeClass('kt-spinner');
								$('#assettype_submit').prop("disabled", false);
								// location.reload();
								toastr.success('Type '+sucess_msg+' Successfuly');
							     window.location.href = "typelisting";
							}
							else
							{
								toastr.warning('Type already exist');

							}
								
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});
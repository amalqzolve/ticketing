var componentsdetails_list_table = $('#componentsdetails_list').DataTable({
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
					"url": 'componentslisting',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'id', name: 'id' },
					
					{ data: 'component_name', name: 'component_name' },
					{ data: 'component_date', name: 'component_date' },
					
					
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
								return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												</div></div></span>';
									
							}
					},
			]
		});
$(document).on('click', '#component_submit', function(e) {
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
						url: "submit-assetcomponent",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								name: $('#name').val(),
								description: $('#description').val(),
								componentdate: $('#componentdate').val(),
								days : $('#days').val(),
						},
						success: function(data) {
								$('#component_submit').removeClass('kt-spinner');
								$('#component_submit').prop("disabled", false);
								location.reload();
								toastr.success('Component '+sucess_msg+' Successfuly');
							      window.location.href = "componentslisting";
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});
$('.ktdatepicker').datepicker({
     todayHighlight: true,

    format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});
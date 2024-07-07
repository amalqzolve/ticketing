			var productunitdetails_table = $('#productunitdetails_list').DataTable({
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
									columns: [0, 1, 2, 3,4,5,6]
							}
					},
					{
							extend: 'csv',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4,5]
							}
					},
					{
							extend: 'excel',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4,5]
									// doc.content[1].table.widths = [ '10%', '30%', '10%', '10%', '20%', '20%', '10%'];
							}
					},
					{
							extend: 'pdf',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4,5]
							},
							pageSize: 'A4',
							orientation: 'landscape',
							customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '15%', 
                                                           '10%','15%'];
                       }
					},
					{
							extend: 'print',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4,5]
							}
					}
			],

			ajax: {
					"url": 'unitlisting',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'id', name: 'id' },
					
					{ data: 'unit_name', name: 'unit_name' },
					{ data: 'unit_code', name: 'unit_code' },
					{ 
						data: 'base_unit', name: 'base_unit', 
						render: function(data, type, row) {
								if (row.base_unit == '1') {
										return '<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>';
								} else {
										return '<i class="fa fa-times" aria-hidden="true" style="color: red;"></i>';
								}

						}
					},
					// { data: 'parent_unit', name: 'parent_unit' },
					{ data: 'unit_value', name: 'unit_value' },
					{ data: 'description', name: 'description' },
					
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
		$(document).on('click', '#Productunitsubmit', function(e) {
				e.preventDefault();
				unit_name = $('#unit_name').val();
				unit_code = $('#unit_code').val();
				base_unit = $('#base_unit').val();
				parent_unit = $('#parent_unit').val();
				unit_value = $('#unit_value').val();
			
				

				if (unit_name == "") {
				
						$('#unit_name').addClass('is-invalid');
						return false;
				} else {
						$('#unit_name').removeClass('is-invalid');
				}
				if (unit_code == "") {
						$('#unit_code').addClass('is-invalid');
						return false;
				} else {
						$('#unit_code').removeClass('is-invalid');
				}
				if (base_unit == "") {
					$('#base_unit').addClass('is-invalid');
	   toastr.warning('Base Unit is required.');
	   return false;
	   } else {
					$('#base_unit').removeClass('is-invalid');
	   }
				

				// if (parent_unit == "") {
				//     $('#parent_unit').next().find('.select2-selection').addClass('select-dropdown-error');
				//     return false;
				// } else {
				//     $('#parent_unit').next().find('.select2-selection').removeClass('select-dropdown-error');
				// }
				if (unit_value == "") {
						$('#unit_value').addClass('is-invalid');
						return false;
				} else {
						$('#unit_value').removeClass('is-invalid');
				}
				
				$(this).addClass('kt-spinner');
				$(this).prop("disabled", true);
				if($('#id').val()){
				var sucess_msg ='Updated';
				} else{
				var sucess_msg ='Created';
				}
				$.ajax({
						type: "POST",
						url: "assetunitSubmit",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								prounit_id: $('#id').val(),
								unit_name: $('#unit_name').val(),
								unit_code: $('#unit_code').val(),
								base_unit: $("#base_unit").val(),
								parent_unit: $('#parent_unit').val(),
								unit_value: $('#unit_value').val(),
								description: $('#description').val(),
								
						},
						success: function(data) {
							if(data == true)
					{
						$('#Productunitsubmit').removeClass('kt-spinner');
										$('#Productunitsubmit').prop("disabled", false);
										productunitdetails_table.ajax.reload();
										toastr.success('Unit Details '+sucess_msg+' Successfuly');
										window.location.href = "unitlisting";
					}
					else
					{
										toastr.warning('Unit already exist');
										
									}
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});
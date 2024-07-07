var voucher_list_table = $('#voucher_list').DataTable({
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
									columns: [0, 1, 2, 3, 4]
							}
					},
					{
							extend: 'csv',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3, 4]
							}
					},
					{
							extend: 'excel',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3, 4]
							}
					},
					{
							extend: 'pdf',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3]
							},
							pageSize: 'A4',
							orientation: 'landscape',
							customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '35%',  '25%', '25%','15%'];
                       }
					},
					{
							extend: 'print',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3, 4]
							}
					}
			],
			ajax: {
					"url": 'voucehersettings',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'voucher_name', name: 'voucher_name' },
					{data: 'prefix', name: 'prefix' },
					{data: 'startingno', name: 'startingno' },
					{data: 'name', name: 'name' },
					{data: 'financeposting', name: 'financeposting' ,
					render: function(data, type, row) {
                  if(row.financeposting == 1)
                  {
                    
                    return 'Automatic';
                    
                  }
                  if(row.financeposting == 2)
                  {
                    return 'Manual';
                  }
              }
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
												<a href="settingsedit_voucher?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
											 <li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text voucherdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});

$(document).on('click', '#voucher_submit', function(e) {
		e.preventDefault();


				

		 $(this).addClass('kt-spinner');
		 $(this).prop("disabled", true);
		 if($('#id').val()){
				var sucess_msg ='Updated';
		 } else{
				var sucess_msg ='Created';
		 }
		

		$.ajax({
				type: "POST",
				url: "vouchersettingssubmit",
				dataType: "json",
				data: {
						_token: $('#token').val(),
						info_id: $('#id').val(),
						vouchername : $('#vouchername').val(),
						prefix         : $('#prefix').val(),
						startingno   : $('#startingno').val(),
						entrytypes  : $('#entrytypes').val(),
						financeposting : $('#financeposting').val(),
						branch        : $('#branch').val()
				},
				success: function(data) {
					

						 $('#voucher_submit').removeClass('kt-spinner');
						 $('#voucher_submit').prop("disabled", false);
							window.location.href = "voucehersettings";
						 toastr.success('Voucher '+sucess_msg+' successfuly');
						 closeModel();


				},
				error: function(jqXhr, json, errorThrown) {
				 
					console.log('Error !!');
				}
		});
});



$(document).on('click', '.voucherdelete', function() {
				var id = $(this).attr('id');
				swal.fire({
						title: "Are you sure?",
						text: "You will not be able to recover this!",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Yes, delete it!",
						cancelButtonText: "No, cancel it!"
				}).then(result => {
						if (result.value) {

								$.ajax({
										type: "POST",
										url: 'settingsdelete-voucher',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {
											
												swal.fire("Deleted!", "Your Entry Has Been Deleted.", "success");
												voucher_list_table.ajax.reload();
											
											
												
										}
								});
						} else {

								swal.fire("Cancelled", "Your Entry is safe :)", "error");
						}
				})
		});

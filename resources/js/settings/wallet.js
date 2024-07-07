var wallet_list_table = $('#wallet_list').DataTable({
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
					"url": 'walletaccount',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'name', name: 'name' },
					{data: 'ledgername', name: 'ledgername' },
					


					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="edit_wallet?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
											 <li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text walletaccountdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});

$(document).on('click', '#wallet_submit', function(e) {
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
				url: "walletaccountsubmit",
				dataType: "json",
				data: {
						_token: $('#token').val(),
						info_id: $('#id').val(),
						accountname : $('#accountname').val(),
						ledger         : $('#ledger').val(),
					
						branch        : $('#branch').val()
				},
				success: function(data) {
					

						 $('#wallet_submit').removeClass('kt-spinner');
						 $('#wallet_submit').prop("disabled", false);
							window.location.href = "walletaccount";
						 toastr.success('Wallet Account '+sucess_msg+' successfuly');
						 closeModel();


				},
				error: function(jqXhr, json, errorThrown) {
				 
					console.log('Error !!');
				}
		});
});

$(document).on('click', '.walletaccountdelete', function() {
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
										url: 'delete-wallet',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {
											
												swal.fire("Deleted!", "Your Entry Has Been Deleted.", "success");
												wallet_list_table.ajax.reload();
											
											
												
										}
								});
						} else {

								swal.fire("Cancelled", "Your Entry is safe :)", "error");
						}
				})
		});

var wallet_transaction_list_table = $('#wallet_transaction_list').DataTable({
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
					"url": 'wallettransactions',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'date', name: 'date' },
					{data: 'name', name: 'name' },
					{ data: 'drcr', name: 'drcr', 
				  render: function(data, type, row) {
                  if(row.drcr == 1)
                  {
                    
                    return 'Debit';
                    
                  }
                  if(row.drcr == 2)
                  {
                    return 'Credit';
                  }
              }
				  },
					{data: 'amounts', name: 'amounts' },
					


					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="edit_wallettransaction?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
											 <li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text wallettransactiondelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});


$(document).on('click', '#wallettransaction_submit', function(e) {
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
				url: "wallettransactionsubmit",
				dataType: "json",
				data: {
						_token: $('#token').val(),
						info_id: $('#id').val(),
						date : $('#date').val(),
						accountname         : $('#accountname').val(),
					  drcr : $('#drcr').val(),
					  amounts : $('#amounts').val(),
					  notes : $('#notes').val(),
						branch        : $('#branch').val()
				},
				success: function(data) {
					

						 $('#wallettransaction_submit').removeClass('kt-spinner');
						 $('#wallettransaction_submit').prop("disabled", false);
							window.location.href = "wallettransactions";
						 toastr.success('Wallet Transactions '+sucess_msg+' successfuly');
						 closeModel();


				},
				error: function(jqXhr, json, errorThrown) {
				 
					console.log('Error !!');
				}
		});
});

$(document).on('click', '.wallettransactiondelete', function() {
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
										url: 'delete-wallettransaction',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {
											
												swal.fire("Deleted!", "Your Entry Has Been Deleted.", "success");
												wallet_transaction_list_table.ajax.reload();
											
											
												
										}
								});
						} else {

								swal.fire("Cancelled", "Your Entry is safe :)", "error");
						}
				})
		});
	/**
		 *Datatable for customer group
		 */
 
	

 /**
		 *Function call for close button
		 */

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

 /**
		 *Customer group submit action
		 */



/**
		 *Customer group get data for update 
		 */



/**
		 *Customer group deletion
		 */

$(document).on('click', '.kt_del_groupinformation', function() {
		var id = $(this).attr('id');
		swal.fire({
				title: "Are you sure?",
				text: "You will not be able to recover this Customer Group Entry!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel it!"
						}).then(result => {
				if (result.value) {
						$.ajax({
								type: "POST",
								url: 'settingsdeletegroup',
								data: {
										_token: $('#token').val(),
										id: id
								},
								success: function(data) {
									console.log(data);
									 if(data == 2)
										{
									 swal.fire("Deleted!", "Your Group has been deleted.", "success");
									 customergroupdetails_table.ajax.reload();
										}
										else
										{
									 swal.fire("Not Deleted!", "Your Group is used in Customer Details.", "success");
									 customergroupdetails_table.ajax.reload();
										}

								}
						});
				} else {
						swal.fire("Cancelled", "Your Customer Group Entry is safe :)", "error");

				}
		})
});

/**
		 *Customer group data restore
		 */

$(document).on('click', '.grouprestoredetails', function() {
		var id = $(this).attr('id');
		
		swal.fire({
				title: "Are you sure?",
				text: "You will be able to recover this  Customer Group Entry!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, Restore it!",
				cancelButtonText: "No, cancel it!"
		}).then(result => {
				if (result.value) {
						$.ajax({
								type: "POST",
								url: 'settingsgrouptrashrestore',
								data: {
										_token: $('#token').val(),
										id: id
								},
								success: function(data) {
										swal.fire("Restored!", "Your Customer Group Entry has been Restored.", "success");
										window.location.href ="settingscustomergroup";
									
								}
						});
				} else {
						swal.fire("Cancelled", "Your Customer Group Entry is not Restored)", "error");

				}
		})
});
/**
		 *Customer group  trash datatable
		 */

		var trashgroupdetails_table = $('#trashgroupdetails').DataTable({
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
					"url": 'settingsgrouptrash',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
				columns: [
						{data: 'DT_RowIndex', name: 'DT_RowIndex'},
						{data: 'title', name: 'title'},
						{data: 'description', name: 'description'},
						{ data: 'color', name: 'color', render:function(data, type, row){
							return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#'+row.color+'">&nbsp;&nbsp;</div>';
						}},
						{ data: 'action', name: 'action', render:function(data, type, row){
						 return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon-upload-1"></i>\
												<span class="kt-nav__link-text grouprestoredetails" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
												</span></li></a>\
											 </ul></div></div></span>';
						}},
						
				]
		});
		
 

/**
	 *Customer Group DataTable Export
	 */

	

	/**
	 *Customer Group trash DataTable Export
	 */

	$("#trashgroupdetails_print").on("click", function() {
			trashgroupdetails_table.button('.buttons-print').trigger();
	});


	$("#trashgroupdetails_copy").on("click", function() {
			trashgroupdetails_table.button('.buttons-copy').trigger();
	});

	$("#trashgroupdetails_csv").on("click", function() {
			trashgroupdetails_table.button('.buttons-csv').trigger();
	});

	$("#trashgroupdetails_pdf").on("click", function() {
			trashgroupdetails_table.button('.buttons-pdf').trigger();
	});






	


	var trashcategorydetails_table = $('#trashdetailslistcategory').DataTable({
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
				"url": 'settingscategorytrash',
				"type": "POST",
				"data": function(data) {
						data._token = $('#token').val()
				}
		},
		columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'customer_category', name: 'customer_category' },
				{ data: 'description', name: 'description' },

				{
						data: 'color',
						name: 'color',
						render: function(data, type, row) {
								return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
						}
				},
				{ data: 'cust_code', name: 'cust_code' },
				{ data: 'start_from', name: 'start_from' },
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
												<i class="kt-nav__link-icon flaticon-upload-1"></i>\
												<span class="kt-nav__link-text kt_restore_categoryinformation" id=' + row.id + ' data-id="' + row.id + '" >Restore</span>\
												</span></li></a>\
											 </ul></div></div></span>';
						}
				},

		]
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
					console.log(data['users']);
						$('#customer_category').val(data['users'].customer_category);
						$('#description').val(data['users'].description);
						$('#color').val(data['users'].color);
						$('#cust_code').val(data['users'].cust_code);
						$('#start_from').val(data['users'].start_from);
						
						
						$('#id').val(info_id);

						// $("#usersInformation").modal("hide");

				}
		})
});

$(document).on('click', '.kt_del_categoryinformation', function() {
		var id = $(this).attr('id');
		swal.fire({
				title: "Are you sure?",
				text: "You will not be able to recover this Category Entry Details!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel it!"
		}).then(result => {
				if (result.value) {

						$.ajax({
								type: "POST",
								url: 'settingsdeletecategory',
								data: {
										_token: $('#token').val(),
										id: id
								},
							success: function(data) {
									

										

		if(data == 2)
		{
			swal.fire("Deleted!", "Your Category has been deleted.", "success");
			customercategorydetails_table.ajax.reload();
		}
		else
		{
			swal.fire("Not Deleted!", "Your Category is used in Customer Details.", "success");
			customercategorydetails_table.ajax.reload();
		}


								}
						});
				} else {

						swal.fire("Cancelled", "Your Category  Entry is safe :)", "error");
				}
		})
});

$(document).on('click', '.kt_restore_categoryinformation', function() {
		var id = $(this).attr('id');
		swal.fire({
				title: "Are you sure?",
				text: "You will be able to recover this Customer Category Entry !",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, Restore it!",
				cancelButtonText: "No, cancel it!"
		}).then(result => {
				if (result.value) {

						$.ajax({
								type: "POST",
								url: 'settingscategoryTrashRestore',
								data: {
										_token: $('#token').val(),
										id: id
								},
								success: function(data) {

										swal.fire("Restored!", "Your Customer Category Entry has been Restored.", "success");
										window.location.href='settingscustomercategorydetails';


								}
						});
				} else {
						swal.fire("Cancelled", "Your Customer Entry is not Restored)", "error");

				}
		})
});

function closeModelcust() {

		$("#kt_modal_4_4").modal("hide");
		$('#customer_category').val("");
		$('#description').val("");
		$('#color').val("");
		$('#cust_code').val("");
		$('#start_from').val("");
		
}



$("#trashdetailslistcategory_print").on("click", function() {
		trashcategorydetails_table.button('.buttons-print').trigger();
});


$("#trashdetailslistcategory_copy").on("click", function() {
		trashcategorydetails_table.button('.buttons-copy').trigger();
});

$("#trashdetailslistcategory_csv").on("click", function() {
		trashcategorydetails_table.button('.buttons-csv').trigger();
});

$("#trashdetailslistcategory_pdf").on("click", function() {
		trashcategorydetails_table.button('.buttons-pdf').trigger();
});







var trashtypedetails_table = $('#trashdetailslisttype').DataTable({
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
						orientation: 'landscape',
						 customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '30%', '25%'];
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
				"url": 'settingstypetrash',
				"type": "POST",
				"data": function(data) {
						data._token = $('#token').val()
				}
		},
		columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'title', name: 'title' },
				{ data: 'discription', name: 'discription' },
				{
						data: 'color',
						name: 'color',
						render: function(data, type, row) {
								return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
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
												<a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon-upload-1"></i>\
												<span class="kt-nav__link-text kt_restore_typeinformation" id=' + row.id + ' data-id="' + row.id + '" >Restore</span>\
												</span></li></a>\
											 </ul></div></div></span>';
						}
				},

		]
});



$(document).on('click', '.Type_update', function() {

		var info_id = $(this).attr("data-id");
		$.ajax({
				url: "settingsgettypeupdate",
				method: "POST",
				data: {
						_token: $('#token').val(),
						info_id: info_id
				},
				dataType: "json",
				success: function(data) {
						$('#title').val(data['users'].title);
						$('#description').val(data['users'].discription);
						$('#color').val(data['users'].color);
						

						$('#id').val(info_id);

						// $("#usersInformation").modal("hide");

				}
		})
});

$(document).on('click', '.kt_del_typeinformation', function() {
		var id = $(this).attr('id');
		swal.fire({
				title: "Are you sure?",
				text: "You will not be able to recover this Customer Type Details Entry ",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel it!"
		}).then(result => {
				if (result.value) {

						$.ajax({
								type: "POST",
								url: 'settingsdeletetypeInfo',
								data: {
										_token: $('#token').val(),
										id: id
								},
								success: function(data) {
										console.log(data);
										if(data == 0)
										{
									 swal.fire("Deleted!", "Your Type has been deleted.", "success");
										customertypedetails_table.ajax.reload();
								}
								if(data == 1){
									 swal.fire("Not Deleted!", "Your Type is used in Customer Details.", "success");

										customertypedetails_table.ajax.reload();

								}
								}
						});
				} else {

						swal.fire("Cancelled", "Your Customer Type Entry is safe :)", "error");
				}
		})
});
/**
 *Customer  type DataTable Export
 */


/**
 *Customer trash type DataTable Export
 */

$("#trashdetailslisttype_print").on("click", function() {
    trashtypedetails_table.button('.buttons-print').trigger();
});


$("#trashdetailslisttype_copy").on("click", function() {
    trashtypedetails_table.button('.buttons-copy').trigger();
});

$("#trashdetailslisttype_csv").on("click", function() {
    trashtypedetails_table.button('.buttons-csv').trigger();
});

$("#trashdetailslisttype_pdf").on("click", function() {
    trashtypedetails_table.button('.buttons-pdf').trigger();
});

$(document).on('click', '.kt_restore_typeinformation', function() {
		var id = $(this).attr('id');
		swal.fire({
				title: "Are you sure?",
				text: "You will be able to recover this Customer Type Entry!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, Restore it!",
				cancelButtonText: "No, cancel it!"
		}).then(result => {
				if (result.value) {

						$.ajax({
								type: "POST",
								url: 'settingstypeTrashRestore',
								data: {
										_token: $('#token').val(),
										id: id
								},
								success: function(data) {

										swal.fire("Restored!", "Your Type Entry has been Restored.", "success");
										window.location.href="settingscustomertypedetails";


								}
						});
				} else {
						swal.fire("Cancelled", "Your Type Entry is not Restored)", "error");

				}
		})
});

function closeModels() {

		$("#kt_modal_4_5").modal("hide");
		$('#title').val("");
		$('#description').val("");
		$('#color').val("");

}
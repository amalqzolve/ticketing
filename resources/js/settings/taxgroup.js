var taxgroups_list_table = $('#taxgroups_list').DataTable({
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
					"url": 'settingstaxgroups',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'taxgroup_name', name: 'taxgroup_name' },
					// { data: 'taxes', name: 'taxes' },
					{data: 'total', name: 'total' },
					{data: 'description', name: 'description' },
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="settingsedit_taxgroups?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-edit"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
												<a href="settingstaxgroupsview?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon-background"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
												</span></li></a>\
											 <li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text taxgroupdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});


var taxgroupstrash_list_table = $('#taxgroupstrash_list').DataTable({
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
									columns: [0, 1, 2, 3, 4]
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
					"url": 'settingstaxgroupsTrash',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'taxgroup_name', name: 'taxgroup_name' },
					// { data: 'taxes', name: 'taxes' },
					{data: 'total', name: 'total' },
					{data: 'description', name: 'description' },
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
											return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon-upload-1"></i>\
												<span class="kt-nav__link-text taxgrouprestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text taxgrouptrashdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},

			]
	});
function taxgroup()
{
		window.location.href="settingstaxgroups";
}
$(document).on('click', '#taxgroup_submit', function(e) {
		e.preventDefault();

				taxgroup_name = $('#taxgroup_name').val();
				taxes         = $('#taxes').val();
				// description   = $('#description').val();
				checkedValue  = $('#default').is(":checked");
				// default       = $("#default").is(":checked");

			 
				if (taxgroup_name == "") {
	$('#taxgroup_name').addClass('is-invalid');
	toastr.warning('Tax Group name is required.');
	return false;
	} else {
	$('#taxgroup_name').removeClass('is-invalid');
	}
		if (taxes == "") {
	$('#taxes').addClass('is-invalid');
	toastr.warning('Taxes is required.');
	return false;
	} else {
	$('#taxes').removeClass('is-invalid');
	}
		if (checkedValue == "") {
	$('#checkedValue').addClass('is-invalid');
	toastr.warning('Checked Value is required.');
	return false;
	} else {
	$('#checkedValue').removeClass('is-invalid');
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
				url: "settingstaxgroupsubmit",
				dataType: "json",
				data: {
						_token: $('#token').val(),
						info_id: $('#id').val(),
						taxgroup_name : $('#taxgroup_name').val(),
						taxes         : $('#taxes').val(),
						description   : $('#description').val(),
						checkedValue  : $('#default').is(":checked"),
						branch        : $('#branch').val()
				},
				success: function(data) {
					if(data == false)
					{
						$('#taxgroup_submit').removeClass('kt-spinner');
						$('#taxgroup_submit').prop("disabled", false);
						 toastr.success('The Taxgroup Name Already Exists.');

					 }
else
{
						 $('#taxgroup_submit').removeClass('kt-spinner');
						 $('#taxgroup_submit').prop("disabled", false);
							window.location.href = "settingstaxgroups";
						 toastr.success('Taxgroups '+sucess_msg+' successfuly');
						 closeModel();

}
				},
				error: function(jqXhr, json, errorThrown) {
				 
					console.log('Error !!');
				}
		});
});

$(document).on('click', '.cancel', function() {

		closeModel();

});

function closeModel() {
		$('#currency_name').val("");
		$('#value').val("");
		$('#symbol').val("");
		$('#notes').val("");


}
$(document).on('click', '.taxgroupdelete', function() {
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
										url: 'settingsdelete-taxgroups',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {
											if(data == 'true')
											{
												swal.fire("Deleted!", "Your Entry Has Been Deleted.", "success");
												taxgroups_list_table.ajax.reload();
											}
											else
											{
												swal.fire("Not Deleted!", "This Taxgroup  Already Used", "success");
												taxgroups_list_table.ajax.reload();
											}
												
										}
								});
						} else {

								swal.fire("Cancelled", "Your Entry is safe :)", "error");
						}
				})
		});



	 $(document).on('click', '.taxgrouprestore', function() {
				var id = $(this).attr('id');
				swal.fire({
						title: "Are you sure?",
						text: "You will be able to recover this!",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Yes, Restore it!",
						cancelButtonText: "No, cancel it!"
				}).then(result => {
						if (result.value) {

								$.ajax({
										type: "POST",
										url: 'settingsrestore-taxgroups',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {

												swal.fire("Restored!", "Your Entry has been restored.", "success");
												location.reload();
										}
								});
						} else {

								swal.fire("Cancelled", "Your Entry is safe :)", "error");
						}
				})
		});
		$(document).on('click', '.taxgrouptrashdelete', function() {
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
										url: 'settingstrashdelete-taxgroups',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {

												swal.fire("Deleted!", "Your Entry has been deleted.", "success");
												location.reload();
										}
								});
						} else {

								swal.fire("Cancelled", "Your Entry is safe :)", "error");
						}
				})
		});

	$("#taxgroups_list_print").on("click", function() {
			taxgroups_list_table.button('.buttons-print').trigger();
	});


	$("#taxgroups_list_copy").on("click", function() {
			taxgroups_list_table.button('.buttons-copy').trigger();
	});

	$("#taxgroups_list_csv").on("click", function() {
			taxgroups_list_table.button('.buttons-csv').trigger();
	});

	$("#taxgroups_list_pdf").on("click", function() {
			taxgroups_list_table.button('.buttons-pdf').trigger();
	});
	$("#taxgroupstrash_list_print").on("click", function() {
			taxgroupstrash_list_table.button('.buttons-print').trigger();
	});


	$("#taxgroupstrash_list_copy").on("click", function() {
			taxgroupstrash_list_table.button('.buttons-copy').trigger();
	});

	$("#taxgroupstrash_list_csv").on("click", function() {
			taxgroupstrash_list_table.button('.buttons-csv').trigger();
	});

	$("#taxgroupstrash_list_pdf").on("click", function() {
			taxgroupstrash_list_table.button('.buttons-pdf').trigger();
	});


	$(document).ready(function() {
			 $('.kt-select2').select2();
	 });
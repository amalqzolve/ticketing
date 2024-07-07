$(document).ready(function() {
/**
	*Datatable for Brand Products Listing
	*/
	var branddetails_table = $('#branddetails_list').DataTable({
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
							customize: function(doc) {
									doc.pageMargins = [50, 50, 50, 50];
									doc.content[1].table.widths = [ '10%', '20%', '10%', '20%', '40%'];
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
					"url": 'BrandList',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'brand_name', name: 'brand_name' },
					{ data: 'brand_code', name: 'brand_code' },
					{ data: 'id', name: 'id' },
					/*{ data: 'logo', name: 'logo', 
					render: function(data, type, row) {
// alert(data);
					 // if(row.logo !=null){
					return '<img src="public/'+ row.logo+'" class="img-thumbnail" width="75" />';
					
						 // }
						}
				 },*/
				/*	{ data: 'vendor', name: 'vendor' },*/
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="editbrand?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-contract"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
												</span></li></a>\
												<li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text branddelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
											 </ul></div></div></span>';
							}
					},
			]
		});
/**
*Brand Products Trash datatable
 */
		var branddetails_trash_table = $('#branddetails_trash').DataTable({
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
									columns: [0, 1, 2, 3,4]
							},
							pageSize: 'A4',
							orientation: 'landscape',
							customize: function(doc) {
									doc.pageMargins = [50, 50, 50, 50];
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
					"url": 'brandtrashlist',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
				columns: [
						{data: 'DT_RowIndex', name: 'DT_RowIndex'},
						{data: 'brand_name',  name: 'brand_name'},
						{data: 'brand_code',  name: 'brand_code'},
						{data: 'id',  name: 'id'},
						/*{data: 'logo',        name: 'logo', 
					render: function(data, type, row) {
					return '<img src="public/'+ row.logo+'"  class="img-thumbnail" width="75" />';
							}
						},
						{data: 'vendor',      name: 'vendor'},*/
						{data: 'action', name: 'action', render:function(data, type, row){
						 return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
												<span class="kt-nav__link-text brand_recover" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
												</span></li></a>\
											 </ul></div></div></span>';
						}},
				]
		});
/**
*Product Brands DataTable Export
*/

	$("#branddetails_list_print").on("click", function() {
			branddetails_table.button('.buttons-print').trigger();
	});
	$("#branddetails_list_copy").on("click", function() {
			branddetails_table.button('.buttons-copy').trigger();
	});
	$("#branddetails_list_csv").on("click", function() {
			branddetails_table.button('.buttons-csv').trigger();
	});
	$("#branddetails_list_pdf").on("click", function() {
			branddetails_table.button('.buttons-pdf').trigger();
	});

/**
	 *Product Group trash DataTable Export
*/
	$("#branddetails_trash_print").on("click", function() {
			branddetails_trash_table.button('.buttons-print').trigger();
	});


	$("#branddetails_trash_copy").on("click", function() {
			branddetails_trash_table.button('.buttons-copy').trigger();
	});

	$("#branddetails_trash_csv").on("click", function() {
			branddetails_trash_table.button('.buttons-csv').trigger();
	});

	$("#branddetails_trash_pdf").on("click", function() {
			branddetails_trash_table.button('.buttons-pdf').trigger();
	});

/**
*Product Brand Recover
*/
$(document).on('click', '.brand_recover', function () {
		 var id = $(this).attr('id');
			 swal.fire({
				title: "Are you sure?",
				text: "You will be able to recover this  Entry !",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, recover it!",
				cancelButtonText: "No, cancel it!" }).then(result => {
				if (result.value){
				$.ajax({
							type: "POST",
							url : 'restorebrand',
							data: {
										 _token : $('#token').val(),
										 id     : id
										},
							success: function(data){
									swal.fire("Deleted!", "Your Entry has been restored.", "success");
										location.reload();
									window.location.href="BrandList";

						 }
					});
					} else{
						swal.fire("Cancelled", "Your Entry is not safe ", "error");
					}
				})
			 });

		const uppy = Uppy.Core({
				autoProceed: false,
				allowMultipleUploads: false,
				 restrictions: {
	maxNumberOfFiles: 1,
	minNumberOfFiles: 1,
	allowedFileTypes: ["image/*"]
  },
   meta: {
			   brand_id       : $('#id').val(),
		   },
				// meta: {
				//         UniqueID       : $('#UniqueID').val()
				//     },
				onBeforeUpload: (files) => {
						fileData = [];
						const updatedFiles = {};

						Object.keys(files).forEach(fileID => {
										fileData.push('Brandinfodata/' + files[fileID].name)
								})
								//return updatedFiles
						$('#fileData').val(fileData);

				},

		})

		uppy.use(Uppy.Dashboard, {
				metaFields: [
						{ id: 'name', name: 'Name', placeholder: 'File name' },
						{ id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
				],
				browserBackButtonClose: true,
				target: '#choose-files',
				inline: true,
				replaceTargetContent: true,
				width:'100%'
		})
		uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
		uppy.use(Uppy.XHRUpload, {
				endpoint: 'brandstoreFileUpload',
				// UniqueID       : $('#UniqueID').val(),
				fieldName: 'filenames[]',
				headers: {
						'X-CSRF-TOKEN': $('#token').val(),
						// UniqueID       : $('#UniqueID').val()
				}
		})

		if ($('#fileData').val() != '') {
				var img_array = $('#fileData').val().split(",");
				console.log(img_array);
				$.each(img_array, function(i) {
						onuppyImageClicked('public/' + img_array[i]);
				});
		}

		function onuppyImageClicked(img) {

				var str = img.toString();
				var n = str.lastIndexOf('/');
				var img_name = str.substring(n + 1);
				// assuming the image lives on a server somewhere
				return fetch(img)
						.then((response) => response.blob()) // returns a Blob
						.then((blob) => {
								uppy.addFile({
										name: img_name,
										type: 'image/jpeg',
										data: blob
								})
						})
		}

/**
*Product Brand submission
*/
		$(document).on('click', '#branddetailsubmit', function(e) {
				e.preventDefault();
				brand_name = $('#brand_name').val();
				brand_code = $('#brand_code').val();
				vendor = $('#vendor').val();
				description = $('#description').val();
				fileData = $('#fileData').val();
				if (brand_name == "") {
						$('#brand_name').addClass('is-invalid');
       					 toastr.warning('Brand Name is required.');      
						return false;
				} else {
						$('#brand_name').removeClass('is-invalid');
				}
				if (brand_code == "") {
						$('#brand_code').addClass('is-invalid');
        				toastr.warning('Brand Code is required.');      
						return false;
				} else {
						$('#brand_code').removeClass('is-invalid');
				}
				// if (vendor == "") {
				//     $('#vendor').next().find('.select2-selection').addClass('select-dropdown-error');
				//     return false;
				// } else {
				//     $('#vendor').next().find('.select2-selection').removeClass('select-dropdown-error');
				// }
				$(this).addClass('kt-spinner');
				$(this).prop("disabled", true);
				if($('#id').val()){
				var sucess_msg ='Updated';
				} else{
				var sucess_msg ='Created';
				}

				$.ajax({
						type: "POST",
						url: "submit-brand",
						dataType: "text",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								brand_name: $('#brand_name').val(),
								brand_code: $('#brand_code').val(),
								fileData: $('#fileData').val(),
								vendor: $('#vendor').val(),
								description : $('#description').val(),
								branch : $('#branch').val()
						},
						success: function(data) {
							console.log(data);
					if(data == 0)
					{
						$('#branddetailsubmit').removeClass('kt-spinner');
						$('#branddetailsubmit').prop("disabled", false);
						toastr.warning('Brand name already exist');
					}
					else
					{
								uppy.reset();

								$('#branddetailsubmit').removeClass('kt-spinner');
								$('#branddetailsubmit').prop("disabled", false);
								branddetails_table.ajax.reload();
								toastr.success('Products Brand Details '+sucess_msg+' Successfuly');
								window.location.href = "BrandList";
					}
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});
});
/**
*Product Brand Trash Delete
*/
$(document).on('click', '.Productbrandtrashdelete', function() {
				var id = $(this).attr('id');
				// alert(id);
				swal.fire({
						title: "Are you sure?",
						text: "You will not be able to recover this Entry",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Yes, delete it!",
						cancelButtonText: "No, cancel it!"
				}).then(result => {
						if (result.value) {

								$.ajax({
										type: "POST",
										url: 'DeleteTrashProdctbrand',
										data: {
												_token: $('#token').val(),
												id: id
										},
										success: function(data) {
													// alert(data);
												swal.fire("Deleted!", "Your entry has been deleted.", "success");
												location.reload();
										}
								});
						} else {

								swal.fire("Cancelled", "Your  Entry is safe ", "error");
						}
				})
		});
/**
*Product Brand Delete
*/

$(document).on('click', '.branddelete', function() {
		var id = $(this).attr('id');
		swal.fire({
				title: "Are you sure?",
				text: "You will not be able to recover this Entry",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel it!"
		}).then(result => {
				if (result.value) {

						$.ajax({
								type: "POST",
								url: 'delete-brand',
								data: {
										_token: $('#token').val(),
										id: id
								},
								success: function(data) {

										swal.fire("Deleted!", "Your entry has been deleted.", "success");
										location.reload();
								}
						});
				} else {
						swal.fire("Cancelled", "Your Entry is safe ", "error");
				}
		})
});
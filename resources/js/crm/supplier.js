
/**
 *Datatable for Supplier Type Information
 */
var suppliertypedetails_table = $('#crmsuppliertypedetails_list').DataTable({
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
		"url": 'supplier_type',
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
						<a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_7"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-edit"></i>\
						<span class="kt-nav__link-text suppliertypedetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
						</span></li></a>\
						<li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-trash"></i>\
						<span class="kt-nav__link-text kt_del_supplierinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
					   </ul></div></div></span>';
			}
		},

	]
});
/**
 *Supplier type  Information DataTable Export
 */

$("#suppliertypedetails_list_print").on("click", function() {
	suppliertypedetails_table.button('.buttons-print').trigger();
});


$("#suppliertypedetails_list_copy").on("click", function() {
	suppliertypedetails_table.button('.buttons-copy').trigger();
});

$("#suppliertypedetails_list_csv").on("click", function() {
	suppliertypedetails_table.button('.buttons-csv').trigger();
});

$("#suppliertypedetails_list_pdf").on("click", function() {
	suppliertypedetails_table.button('.buttons-pdf').trigger();
});

var trashtypedetails_table = $('#trashtype').DataTable({
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
		"url": 'suppliertrash',
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
						<li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon-upload-1"></i>\
						<span class="kt-nav__link-text typerestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
					   </ul></div></div></span>';
			}
		},

	]
});
/**
 *Supplier  trash type DataTable Export
 */

$("#trashtype_print").on("click", function() {
	trashtypedetails_table.button('.buttons-print').trigger();
});


$("#trashtype_copy").on("click", function() {
	trashtypedetails_table.button('.buttons-copy').trigger();
});

$("#trashtype_csv").on("click", function() {
	trashtypedetails_table.button('.buttons-csv').trigger();
});

$("#trashtype_pdf").on("click", function() {
	trashtypedetails_table.button('.buttons-pdf').trigger();
});
/**
   *Datatable for Supplier  type trash 
 */
/**
   *Supplier  type Restore confirmation message 
 */
$(document).on('click', '.typerestore', function() {
	var id = $(this).attr('id');
	swal.fire({
		title: "Are you sure?",
		text: "You will not be able to recover this Supplier Type Entry  Details!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, Restore it!",
		cancelButtonText: "No, cancel it!"
	}).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url: 'typeTrashRestores',
				data: {
					_token: $('#token').val(),
					id: id
				},
				success: function(data) {

					swal.fire("Restored!", "Your Supplier Type Entry has been deleted.", "success");
					window.location.href = "supplier_type";

				}
			});
		} else {
			swal.fire("Cancelled", "Your Supplier Entry is safe :)", "error");

		}
	})
});



/**
   *Supplier Type Submission
 */
$(document).on('click', '#suppliertypedetail_submit', function(e) {
e.preventDefault();

	title = $('#title').val();
	color = $('#color').val();

	if (title == "") {
		$('#title').addClass('is-invalid');
		return false;
	} else {
		$('#title').removeClass('is-invalid');
	}
	if (color == "") {
		$('#color').addClass('is-invalid');
		return false;
	} else {
		$('#color').removeClass('is-invalid');

	}
	
	


	$(this).addClass('kt-spinner');
	$(this).prop("disabled", true);
	if ($('#id').val()) {
		var sucess_msg = 'Updated';
	} else {
		var sucess_msg = 'Created';
	}


	$.ajax({
		type: "POST",
		url: "suppliertypeSubmit",
		dataType: "json",
		data: {
			_token: $('#token').val(),
			info_id: $('#id').val(),
			title: $('#title').val(),
			discription: $('#discription').val(),
			color: $('#color').val(),
			branch : $('#branch').val()
			

		},
		success: function(data) {

		  if(data == false)
		  {
			$('#suppliertypedetail_submit').removeClass('kt-spinner');
			$('#suppliertypedetail_submit').prop("disabled", false);
			 toastr.success('Supplier type name is already exist');

		  }
		  else
		  {
			$('#suppliertypedetail_submit').removeClass('kt-spinner');
			$('#suppliertypedetail_submit').prop("disabled", false);
			closeModel();
			suppliertypedetails_table.ajax.reload();
			toastr.success('Supplier type ' + sucess_msg + ' successfuly');
		  }

		},
		error: function(jqXhr, json, errorThrown) {

			console.log('Error !!');
		}
	});
});
/**
 *Supplier Type close model after submission
 */
function closeModel() {

	$("#kt_modal_4_7").modal("hide");

	$('#title').val("");
	$('#discription').val("");
	$('#color').val("");

	$('#id').val("");


}

$(document).on('click', '.close,.closeBtn', function() {
	closeModel();
});

/**
 *Supplier Type Update
 */
$(document).on('click', '.suppliertypedetail_update', function() {
	var cust_id = $(this).attr("data-id");
	$.ajax({
		url: "getsuppliertype",
		method: "POST",
		data: {
			_token: $('#token').val(),
			cust_id: cust_id
		},
		dataType: "json",
		success: function(data) {
			$('#title').val(data['users'].title);
			$('#discription').val(data['users'].discription);
			$('#color').val(data['users'].color);

			$('#id').val(cust_id);
			

		}
	})
});

/**
 *Supplier Type delete confirmation message
 */
$(document).on('click', '.kt_del_supplierinformation', function() {
	var id = $(this).attr('id');
	swal.fire({
		title: "Are you sure?",
		text: "You will not be able to recover this  Entry !",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel it!"
	}).then(result => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: 'deletesuppliertypeInfo',
				data: {
					_token: $('#token').val(),
					id: id
				},
				success: function(data) {
				  console.log(data);
				   if(data == 'true')
				  {
					swal.fire("Deleted!", "Your Type has been deleted.", "success");
					suppliertypedetails_table.ajax.reload();
				  }
				  else
				  {
					swal.fire("Not Deleted!", "Your Type is used in Supplier Details.", "success");
					suppliertypedetails_table.ajax.reload();
				  }
				}
			});
		} else {
			swal.fire("Cancelled", "Your  Entry is safe :)", "error");
		}
	})
});


/**
 *Datatable for supplier Information
 */

var supplierdetails_list_table = $('#supplierdetails_list').DataTable({
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
            doc.content[1].table.widths = [ '15%',  '15%', '15%', '15%', 
                                                           '15%', '25%'];
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
		"url": 'supplierdetails',
		"type": "POST",
		"data": function(data) {
			data._token = $('#token').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'sup_name', name: 'sup_name' },
		{ data: 'sup_name_ar', name: 'sup_name_ar' },
		{ data: 'email1', name: 'email1' },
		{ data: 'mobile1', name: 'mobile1' },
		{ data: 'title', name: 'title' },

		{ data: 'supplier_category', name: 'supplier_category' },
		{ data: 'sup_code', name: 'sup_code' },

		
		{
			data: 'action',
			name: 'action',
			render: function(data, type, row) {
				return '<span style="overflow: visible; position: relative; width: 80px;">\
			<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
						<i class="fa fa-cog"></i></a>\
						<div class="dropdown-menu dropdown-menu-right">\
						<ul class="kt-nav">\
						<a href="supplier_pdf?id=' + row.id + '" data-type="edit" target="blank"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-file-1"></i>\
						<span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
						</span></li></a>\
						<a href="edit_suppliers?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-edit"></i>\
						<span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
						</span></li></a>\
						<li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-trash"></i>\
						<span class="kt-nav__link-text kt_del_supplierdetails" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
					   </ul></div></div></span>';

			}
		},

	]
});



var supplierdocuments_list_more_table = $('#supplierdocuments_list_more').DataTable({
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
			customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '2%',  '15%'];
                       }
		},
		{
			extend: 'print',
			className: "hidden",
			exportOptions: {
				columns: [0, 1]
			}
		}
	],

	ajax: {
		"url": 'sup_doc_view',
		"type": "POST",
		"data": function(data) {
			data._token = $('#token').val(),
			data.supplier_id = $('#supplier_id').val()
			
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'caption', name: 'caption' },
		{ data: 'file', name: 'file' },
	  
	  /*  {
			data: 'download',
			name: 'download',
			render: function(data, type, row) {
				if (row.documents === undefined || row.documents === null) {
					return '';
				} else {
					return '<a href="supplier_download?id=' + row.id + '"><button class="btn btn-success btn-elevate btn-icon-sm" style="padding: 1px 6px !important;">Download &nbsp; <i class="fa fa-download" aria-hidden="true"></i> </button></a>';
				}

			}
		},*/
		{
			data: 'action',
			name: 'action',
			render: function(data, type, row) {
				j='<a href="ssdownload?id='+ row.supplier_id+'&&file='+ row.file+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon-download"></i>\
						<span class="kt-nav__link-text" data-id="' + row.id + '" >Download</span>\
						</span></li></a><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-trash"></i>\
						<span class="kt-nav__link-text kt_del_supplier_document_file" id=' + row.id + ' data-id=' + row.id + ' data-file=' + row.file + '  data-supplier_id=' + row.supplier_id + '>Delete</span></span></li>';

				return '<span style="overflow: visible; position: relative; width: 80px;">\
			<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
						<i class="fa fa-cog"></i></a>\
						<div class="dropdown-menu dropdown-menu-right">\
						<ul class="kt-nav">'+j+'\
					   </ul></div></div></span>';
 
			}
		},

	]
});


$(document).on('click', '.kt_del_supplier_document_file', function() {

	var id = $(this).attr('id');
	 var file = $(this).attr('data-file');
	var supplier_id = $(this).attr('data-supplier_id');

 
	swal.fire({
		title: "Are you sure?",
		text: "You will not be able to recover this document!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel it!"
	}).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url: 'deleteSupplierdocumentfile',
				data: {
					_token: $('#token').val(),
					id: id,
					file:file,
					supplier_id:supplier_id
				},
				success: function(data) {

					swal.fire("Deleted!", "Your Supplier document has been deleted.", "success");
					location.reload();
				}
			});
		} else {

			swal.fire("Cancelled", "Your Supplier document is safe :)", "error");
		}
	})
});


/**
 *Datatable for supplier documents Information
 */

var supplierdocuments_list_table = $('#supplierdocuments_list').DataTable({
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
            doc.content[1].table.widths = [ '10%',  '10%', '10%', '10%', 
                                                           '15%', '15%', '15%','13%'];
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
		"url": 'supplierdocuments',
		"type": "POST",
		"data": function(data) {
			data._token = $('#token').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		
		{ data: 'sup_name', name: 'sup_name' },
		{ data: 'total', name: 'total' },
        { data: 'exp', name: 'exp' },
        { data: 'ac', name: 'ac' },
		
	
		{
			data: 'action',
			name: 'action',
			render: function(data, type, row) {
				j='<a href="edit_supplier_document?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-edit"></i>\
						<span class="kt-nav__link-text" data-id="' + row.id + '" >{{ __("app.Update") }}</span>\
						</span></li></a>';
						j+='<a href="edit_supplier_docs?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-file-1 supplierdocuments_list"></i>\
						<span class="kt-nav__link-text" data-id="' + row.id + '" >{{ __("app.Documents") }}</span>\
						</span></li></a>';

					  
						if (!row.documents=='') {
							 j+='<a href="sup_doc_view?id=' + row.supplier_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon-folder-1"></i>\
						<span class="kt-nav__link-text" data-id="' + row.supplier_id + '" >{{ __("app.Attachments") }}</span>\
						</span></li></a>'; 
						}
						
				if (row.supid==row.id) {
					j+='<a href="sup_docpdf?id=' + row.id + '" data-type="edit" target="blank"><li class="kt-nav__item">\
						<span class="kt-nav__link">\
						<i class="kt-nav__link-icon flaticon2-file-1"></i>\
						<span class="kt-nav__link-text" data-id="' + row.id + '" >{{ __("app.PDF") }}</span>\
						</span></li></a>';}
					
				
				return '<span style="overflow: visible; position: relative; width: 80px;">\
			<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
						<i class="fa fa-cog"></i></a>\
						<div class="dropdown-menu dropdown-menu-right">\
						<ul class="kt-nav">'+j+'\
					   </ul></div></div></span>';
 
			}
		},

	]
});






/**
 *Datatable for supplier trash Information
 */

var suppliertrashdetails_list_table = $('#supplierdetailstrash_list').DataTable({
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
				columns: [0, 1, 2, 3, 4, 5, 6, 7]
			}
		},
		{
			extend: 'csv',
			className: "hidden",
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 5, 6, 7]
			}
		},
		{
			extend: 'excel',
			className: "hidden",
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 5, 6, 7]
			}
		},
		{
			extend: 'pdf',
			className: "hidden",
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 5, 6, 7]
			},
			pageSize: 'A4',
			orientation: 'landscape',
			customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '15%',  '15%', '15%', '15%', 
                                                           '15%', '25%'];
                       }
		},
		{
			extend: 'print',
			className: "hidden",
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 5, 6, 7]
			}
		}
	],

	ajax: {
		"url": 'supplierdetailstrash',
		"type": "POST",
		"data": function(data) {
			data._token = $('#token').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'sup_code', name: 'sup_code' },
		{ data: 'supplier_type', name: 'supplier_type' },
		{ data: 'supplier_category', name: 'supplier_category' },
		{ data: 'salesman', name: 'salesman' },
		{ data: 'sup_name', name: 'sup_name' },
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
						<span class="kt-nav__link-text kt_restore_supplierinformation" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
					   </ul></div></div></span>';

			}
		},

	]
});


// $(document).on('click', '#Supplier_submit', function(e) {
//     e.preventDefault();

//     var info_id = $('#id').val();

//     var contact_personvalue = [];

//     var contact_person_incharges = [];
//     var mobiles = [];
//     var offices = [];
//     var emails = [];
//     var departments = [];
//     var locations = [];
//     $(".addmore").each(function() {
//         contact_personvalue.push($(this).find(".contact_personvalue").val());
//         contact_person_incharges.push($(this).find(".contact_person_incharge").val());

//         mobiles.push($(this).find(".mobiles").val());
//         offices.push($(this).find(".offices").val());
//         emails.push($(this).find(".emails").val());
//         departments.push($(this).find(".departments").val());
//         locations.push($(this).find(".locations").val());
//     });

//     $.ajax({
//         type: "POST",
//         url: "SupplierSubmit",
//         dataType: "json",
//         data: {
//             _token: $('#token').val(),
//             info_id: $('#id').val(),
//             sup_code: $('#sup_code').val(),
//             sup_type: $('#sup_type').val(),
//             sup_category: $('#sup_category').val(),
//             salesman: $('#salesman').val(),
//             key_account: $('#key_account').val(),
//             sup_name_alias: $("#sup_name_alias").val(),
//             sup_note: $('#sup_note').val(),
//             sup_name: $('#sup_name').val(),
//             sup_add1: $('#sup_add1').val(),
//             sup_add2: $('#sup_add2').val(),
//             sup_country: $('#sup_country').val(),
//             sup_region: $('#sup_region').val(),
//             sup_city: $('#sup_city').val(),
//             sup_zip: $('#sup_zip').val(),
//             email1: $('#email1').val(),
//             email2: $('#email2').val(),
//             office_phone1: $('#office_phone1').val(),
//             office_phone2: $('#office_phone2').val(),
//             mobile1: $('#mobile1').val(),
//             mobile2: $('#mobile2').val(),
//             fax: $('#fax').val(),
//             website: $('#website').val(),
//             contact_person: $('#contact_person').val(),
//             contact_person_incharge: $('#contact_person_incharge').val(),
//             mobile: $('#mobile').val(),
//             office: $('#office').val(),
//             contact_department: $('#contact_department').val(),
//             email: $('#email').val(),
//             location: $('#location').val(),
//             name_areas:$('#name_areas').val(),

//             portal: $('#portal').val(),
//             username: $('#username').val(),
//             registerd_email: $('#registerd_email').val(),
//             password: $('#password').val(),
//             contact_personvalue: contact_personvalue,
//             contact_person_incharges: contact_person_incharges,
//             mobiles: mobiles,
//             offices: offices,
//             emails: emails,
//             departments: departments,
//             locations: locations,

//         },
//         success: function(data) {
//             swal.fire("Done", "Submission Sucessfully", "success");
//             location.reload();
//             window.location.href = "supplierdetails";
//         },
//         error: function(jqXhr, json, errorThrown) {
//             var errors = jqXhr.responseJSON;
//             var errorsHtml = '';
//             $.each(errors, function(key, value) {
//                 if (jQuery.isPlainObject(value)) {

//                     $.each(value, function(index, ndata) {
//                         errorsHtml += '<li>' + ndata + '</li>';
//                     });

//                 } else {

//                     errorsHtml += '<li>' + value + '</li>';

//                 }
//             });
//             toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
//         }
//     });

//     return false;

// });


$(document).on('click', '.kt_restore_supplierinformation', function() {
	var id = $(this).attr('id');
	swal.fire({
		title: "Are you sure?",
		text: "You will be able to recover this  Supplier  Entry  Details!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, Restore it!",
		cancelButtonText: "No, cancel it!"
	}).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url: 'supplierTrashRestore',
				data: {
					_token: $('#token').val(),
					id: id
				},
				success: function(data) {

					swal.fire("Restored!", "Your Supplier Entry has been Restored.", "success");
				   window.location.href="supplierdetails";

				}
			});
		} else {
			swal.fire("Cancelled", "Your Supplier Entry is not Restored :)", "error");

		}
	})
});






$(document.body).on("change", "#payment_terms", function() {
	var grp_id = this.value;

	$.ajax({
		url: "getpayterms",
		method: "POST",
		data: {
			_token: $('#token').val(),
			grp_id: grp_id
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			CKEDITOR.instances['description1'].setData(data['payterm'].description);
		}
	})


});

$('.ktdatepicker').datepicker({
	format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
	$(this).datepicker('hide');
});

$(document).on('click', '.kt_del_supplierdetails', function() {
	var id = $(this).attr('id');
	swal.fire({
		title: "Are you sure?",
		text: "You will not be able to recover this Supplier Details Entry Details!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel it!"
	}).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url: 'deletesupplierInfo',
				data: {
					_token: $('#token').val(),
					id: id
				},
				success: function(data) {

					swal.fire("Deleted!", "Your Supplier Details Entry has been deleted.", "success");
					window.location.href="supplierdetails";
				}
			});
		} else {

			swal.fire("Cancelled", "Your Supplier Details Entry is safe :)", "error");
		}
	})
});



/**
 *Supplier details DataTable Export
 */

$("#supplierdetails_list_print").on("click", function() {
	supplierdetails_list_table.button('.buttons-print').trigger();
});


$("#supplierdetails_list_copy").on("click", function() {
	supplierdetails_list_table.button('.buttons-copy').trigger();
});

$("#supplierdetails_list_csv").on("click", function() {
	supplierdetails_list_table.button('.buttons-csv').trigger();
});

$("#supplierdetails_list_pdf").on("click", function() {
	supplierdetails_list_table.button('.buttons-pdf').trigger();
});

/**
 *Supplier details trash DataTable Export
 */

$("#supplierdetailstrash_list_print").on("click", function() {
	suppliertrashdetails_list_table.button('.buttons-print').trigger();
});


$("#supplierdetailstrash_list_copy").on("click", function() {
	suppliertrashdetails_list_table.button('.buttons-copy').trigger();
});

$("#supplierdetailstrash_list_csv").on("click", function() {
	suppliertrashdetails_list_table.button('.buttons-csv').trigger();
});

$("#supplierdetailstrash_list_pdf").on("click", function() {
	suppliertrashdetails_list_table.button('.buttons-pdf').trigger();
});

/**
 *Supplier documents and contracts trash DataTable Export
 */

$("#supplierdocuments_list_print").on("click", function() {
	supplierdocuments_list_table.button('.buttons-print').trigger();
});


$("#supplierdocuments_list_copy").on("click", function() {
	supplierdocuments_list_table.button('.buttons-copy').trigger();
});

$("#supplierdocuments_list_csv").on("click", function() {
	supplierdocuments_list_table.button('.buttons-csv').trigger();
});

$("#supplierdocuments_list_pdf").on("click", function() {
	supplierdocuments_list_table.button('.buttons-pdf').trigger();
});




$("#supplierdocuments_list_more_print").on("click", function() {
	supplierdocuments_list_more_table.button('.buttons-print').trigger();
});


$("#supplierdocuments_list_more_copy").on("click", function() {
	supplierdocuments_list_more_table.button('.buttons-copy').trigger();
});

$("#supplierdocuments_list_more_csv").on("click", function() {
	supplierdocuments_list_more_table.button('.buttons-csv').trigger();
});

$("#supplierdocuments_list_more_pdf").on("click", function() {
	supplierdocuments_list_more_table.button('.buttons-pdf').trigger();
});


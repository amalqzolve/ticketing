
/**
 *Datatable for supplier Information
 */

var supplierTbl = $('#supplierTbl').DataTable({
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
			// doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
			// doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
			// doc.content[1].table.widths = ['15%', '15%', '15%', '15%',
			// 	'15%', '25%'];
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
		"url": 'supplier-bank-account',
		"type": "POST",
		"data": function (data) {
			data._token = $('#token').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'sup_name', name: 'sup_name' },
		{ data: 'sup_code', name: 'sup_code' },
		{ data: 'title', name: 'title' },
		{ data: 'supplier_category', name: 'supplier_category' },
		{ data: 'bank_account', name: 'bank_account' }
	],
	columnDefs: [
		{ "width": "1%", "targets": 5 }
	]
});

$('#supplierTbl').on('click', 'tbody td', function () {
	var data = supplierTbl.row(this).data();
	window.location.href = 'supplier-bank-account-specific?id=' + data.id;
});

$(document).on('click', '#addRec', function () {
	if ($('#supplier').val() == '') {
		toastr.warning("Please Select A User for Add Bank Account !");
		$('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
	} else {
		// alert($('#usersList').val());
		window.location.href = "supplier-bank-account-add?id=" + $('#supplier').val();
	}
});

$("#supplierTbl_list_print").on("click", function() {
    supplierTbl.button('.buttons-print').trigger();
});


$("#supplierTbl_list_copy").on("click", function() {
    supplierTbl.button('.buttons-copy').trigger();
});

$("#supplierTbl_list_csv").on("click", function() {
    supplierTbl.button('.buttons-csv').trigger();
});

$("#supplierTbl_list_pdf").on("click", function() {
    supplierTbl.button('.buttons-pdf').trigger();
});

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
			doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
			doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
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
		"url": 'supplier-bank-account-specific',
		"type": "POST",
		"data": function (data) {
			data._token = $('#token').val(),
				data.id = $('#supplier_id').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'sup_name', name: 'sup_name' },
		{ data: 'beneficiary_name', name: 'beneficiary_name' },
		{ data: 'bank_name', name: 'bank_name' },
		{ data: 'branch_name', name: 'branch_name' },
		{ data: 'branch_code', name: 'branch_code' },
		{ data: 'account_number', name: 'account_number' },
		{ data: 'iban_swift_code', name: 'iban_swift_code' },
		{
			data: 'action',
			name: 'action',
			render: function (data, type, row) {
				var j = '<a href="supplier-bank-account-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="supplier-bank-account-edit-view?id=' + row.id + '"  data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                    </span></li></a>';

				return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+ j + '\
                       </ul></div></div></span>';
			}
		},
	],
	columnDefs: [
		{ "width": "1%", "targets": 8 }
	]

});
function back() {
	window.history.back();
}




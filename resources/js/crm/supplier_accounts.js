
/* Datatable for supplier account Information */

var supplieraccounts_list_table = $('#supplierdetails_list').DataTable({
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
			columns: [0, 1, 2, 3, 4, 5, 6]
		}
	},
	{
		extend: 'csv',
		className: "hidden",
		exportOptions: {
			columns: [0, 1, 2, 3, 4, 5, 6]
		}
	},
	{
		extend: 'excel',
		className: "hidden",
		exportOptions: {
			columns: [0, 1, 2, 3, 4, 5, 6]
		}
	},
	{
		extend: 'pdf',
		className: "hidden",
		exportOptions: {
			columns: [0, 1, 2, 3, 4, 5, 6]
		},
		pageSize: 'A4',
		orientation: 'landscape',
		customize: function (doc) {
			doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
			doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
			doc.content[1].table.widths = ['15%', '15%', '15%', '15%',
				'15%', '15%', '13%'];
		}
	},
	{
		extend: 'print',
		className: "hidden",
		exportOptions: {
			columns: [0, 1, 2, 3, 4, 5, 6]
		}
	}
	],
	ajax: {
		"url": 'supplieraccounts',
		"type": "POST",
		"data": function (data) {
			data._token = $('#token').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'sup_code', name: 'sup_code' },
		{ data: 'sup_name', name: 'sup_name' },
		{ data: 'ledger', name: 'ledger' },
		{ data: 'action', name: 'action' },
	]
});

$(document).on('click', '.kt_edit_accounts', function () {
	var info_id = $(this).attr("data-id");
	$.ajax({
		url: "getsupplieraccounts",
		method: "POST",
		data: {
			_token: $('#token').val(),
			info_id: info_id
		},
		dataType: "json",
		success: function (data) {
			$('#accounts_ledger').val(data['accounts'].account_ledger);
			$('#accounts_ledger').trigger('change');
			$('#id').val(info_id);
			$('#kt_modal_4_5').modal('show');
		}
	})
});

$(document).on('click', '.close,.closeBtn', function () {
	closeModel();
});

function closeModel() {
	$("#kt_modal_4_5").modal("hide");
	$('#accounts_ledger').val("");
}

$(document).on('click', '#Group_submit', function (e) {
	e.preventDefault();
	if ($('#accounts_ledger').val() == "") {
		$('#accounts_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
		toastr.warning('Ledger is required.');
		return false;
	} else
		$('#accounts_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

	$(this).addClass('kt-spinner');
	$(this).prop("disabled", true);

	$.ajax({
		type: "POST",
		url: "SupAccountSubmit",
		dataType: "json",
		data: {
			_token: $('#token').val(),
			cust_id: $('#id').val(),
			accounts_ledger: $('#accounts_ledger').val(),
		},
		success: function (data) {
			$('#Group_submit').removeClass('kt-spinner');
			$('#Group_submit').prop("disabled", false);
			closeModel();
			supplieraccounts_list_table.ajax.reload();
			toastr.success('supplier accounts updated successfuly');
		},
		error: function (jqXhr, json, errorThrown) {
			var errors = jqXhr.responseJSON;
			var errorsHtml = '';
			$.each(errors, function (key, value) {
				if (jQuery.isPlainObject(value)) {
					$.each(value, function (index, ndata) {
						errorsHtml += '<li>' + ndata + '</li>';
					});
				} else {
					errorsHtml += '<li>' + value + '</li>';
				}
			});
			$('#Customerdetail_submit').removeClass('kt-spinner');
			$('#Customerdetail_submit').prop("disabled", false);
			$('#customerdetails_list').DataTable().ajax.reload();
			toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
		}
	});
	return false;
});

/* Supplier accounts DataTable Export */

$("#supplierdetails_list_print").on("click", function () {
	supplieraccounts_list_table.button('.buttons-print').trigger();
});
$("#supplierdetails_list_copy").on("click", function () {
	supplieraccounts_list_table.button('.buttons-copy').trigger();
});
$("#supplierdetails_list_csv").on("click", function () {
	supplieraccounts_list_table.button('.buttons-csv').trigger();
});
$("#supplierdetails_list_pdf").on("click", function () {
	supplieraccounts_list_table.button('.buttons-pdf').trigger();
});
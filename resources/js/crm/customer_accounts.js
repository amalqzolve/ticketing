
/**
 *Datatable for customer Information
 */
var customeraccounts_list_table = $('#customeraccounts_list').DataTable({
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
		"url": 'customeraccounts',
		"type": "POST",
		"data": function (data) {
			data._token = $('#token').val()
		}
	},
	columns: [
		{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
		{ data: 'cust_code', name: 'cust_code' },
		{ data: 'cust_name', name: 'cust_name' },
		{ data: 'ledger', name: 'ledger' },
		{ data: 'action', name: 'action' },
	]
});

$(document).on('click', '.kt_edit_accounts', function () {
	var info_id = $(this).attr("data-id");
	$.ajax({
		url: "getcustomeraccounts",
		method: "POST",
		data: {
			_token: $('#token').val(),
			info_id: info_id
		},
		dataType: "json",
		success: function (data) {
			$('#customer_ledger').val(data['accounts'].account_ledger);
			$('#customer_ledger').trigger('change');
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
	$('#accounts_group').val("");
	$('#accounts_code').val("");
	$('#accounts_ledger').val("");
}

$(document).on('click', '#Group_submit', function (e) {
	e.preventDefault();
	customer_ledger = $('#customer_ledger').val();
	if ($('#customer_ledger').val() == "") {
		$('#customer_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
		toastr.warning('Account Ledger is required.');
		return false;
	} else
		$('#customer_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

	$(this).addClass('kt-spinner');
	$(this).prop("disabled", true);

	$.ajax({
		type: "POST",
		url: "CustAccountSubmit",
		dataType: "text",
		data: {
			_token: $('#token').val(),
			cust_id: $('#id').val(),
			customer_ledger: $('#customer_ledger').val(),
		},
		success: function (data) {
			$('#Group_submit').removeClass('kt-spinner');
			$('#Group_submit').prop("disabled", false);
			closeModel();
			customeraccounts_list_table.ajax.reload();
			toastr.success('customer accounts updated successfuly');
		},
		error: function (jqXhr, json, errorThrown) {
			var errors = jqXhr.responseJSON;
			var errorsHtml = '';
			$.each(errors, function (key, value) {
				if (jQuery.isPlainObject(value)) {
					$.each(value, function (index, ndata) {
						errorsHtml += '<li>' + ndata + '</li>';
					});
				} else
					errorsHtml += '<li>' + value + '</li>';
			});
			//for spinner button reactive
			$('#Customerdetail_submit').removeClass('kt-spinner');
			$('#Customerdetail_submit').prop("disabled", false);
			//end for spinner button reactive
			$('#customerdetails_list').DataTable().ajax.reload();
			toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
		}
	});

	return false;

});

/**
 *Customer accounts DataTable Export
 */
$("#customeraccounts_list_print").on("click", function () {
	customeraccounts_list_table.button('.buttons-print').trigger();
});
$("#customeraccounts_list_copy").on("click", function () {
	customeraccounts_list_table.button('.buttons-copy').trigger();
});
$("#customeraccounts_list_csv").on("click", function () {
	customeraccounts_list_table.button('.buttons-csv').trigger();
});
$("#customeraccounts_list_pdf").on("click", function () {
	customeraccounts_list_table.button('.buttons-pdf').trigger();
});


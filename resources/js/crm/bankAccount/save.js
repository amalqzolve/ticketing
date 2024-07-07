
$(document).on('click', '#saveDetails', function (e) {
	e.preventDefault();

	var error = 0;
	if ($('#beneficiary_name').val() == '') {
		$('#beneficiary_name').addClass('is-invalid');
		error++;
	} else
		$('#beneficiary_name').removeClass('is-invalid');

	if ($('#bank_name').val() == '') {
		$('#bank_name').addClass('is-invalid');
		error++;
	} else
		$('#bank_name').removeClass('is-invalid');

	if ($('#branch_name').val() == '') {
		$('#branch_name').addClass('is-invalid');
		error++;
	} else
		$('#branch_name').removeClass('is-invalid');

	if ($('#branch_code').val() == '') {
		$('#branch_code').addClass('is-invalid');
		error++;
	} else
		$('#branch_code').removeClass('is-invalid');

	if ($('#bank_address').val() == '') {
		$('#bank_address').addClass('is-invalid');
		error++;
	} else
		$('#bank_address').removeClass('is-invalid');

	if ($('#account_number').val() == '') {
		$('#account_number').addClass('is-invalid');
		error++;
	} else
		$('#account_number').removeClass('is-invalid');

	if ($('#iban_swift_code').val() == '') {
		$('#iban_swift_code').addClass('is-invalid');
		error++;
	} else
		$('#iban_swift_code').removeClass('is-invalid');

	if (error == 0) {
		$('#saveDetails').addClass('kt-spinner');
		$('#saveDetails').prop("disabled", false);
		$.ajax({
			type: "POST",
			url: "supplier-bank-account-save",
			dataType: "json",
			data: {
				_token: $('#token').val(),
				suppler_id: $('#suppler_id').val(),
				beneficiary_name: $('#beneficiary_name').val(),
				bank_name: $('#bank_name').val(),
				branch_name: $('#branch_name').val(),
				branch_code: $('#branch_code').val(),
				bank_address: $('#bank_address').val(),
				account_number: $('#account_number').val(),
				iban_swift_code: $('#iban_swift_code').val(),
				notes: $('#notes').val(),

			},
			success: function (data) {
				if (data.status == 1) {
					$('#saveDetails').removeClass('kt-spinner');
					$('#saveDetails').prop("disabled", false);
					toastr.success('Bank Details Saved successfuly');
					window.location.href = "supplier-bank-account-specific?id=" + $('#suppler_id').val();
				}
			},
			error: function (jqXhr, json, errorThrown) {
				console.log('Error !!');
			}
		});
	} else
		toastr.error('Please fill the mandetory field !!!!');
});

function back() {
	window.history.back();
}



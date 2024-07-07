

$(document).on('click', '#innerboqupdate', function (e) {
	e.preventDefault();




	$(this).addClass('kt-spinner');
	$(this).prop("disabled", true);
	if ($('#id').val()) {
		var sucess_msg = 'Updated';
	} else {
		var sucess_msg = 'Created';
	}


	$.ajax({
		type: "POST",
		url: "innerboqupdate",
		dataType: "json",
		data: {
			_token: $('#token').val(),
			id: $('#id').val(),
			productname: $('#productname').val(),
			unit: $('#unit').val(),
			quantity: $('#quantity').val(),
			rate: $('#rate').val(),
			discountamount: $('#discountamount').val(),
			amount: $('#amount').val(),
			vat_percentage: $('#vat_percentage').val(),
			vatamount: $('#vatamount').val(),
			totalamount: $('#totalamount').val(),
			description: $('#description').val(),
		},
		success: function (data) {


			$('#innerboqupdate').removeClass('kt-spinner');
			$('#innerboqupdate').prop("disabled", false);
			closeModel();

			toastr.success(+sucess_msg + ' successfuly');
			location.reload();

		},
		error: function (jqXhr, json, errorThrown) {

			console.log('Error !!');
		}
	});
});


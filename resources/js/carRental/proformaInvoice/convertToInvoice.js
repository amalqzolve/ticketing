$('.car-in-and-out').addClass('kt-menu__item--active');
function final_calculate() {
    if ($('#amount').val() == '')
        $('#amount').val(0);
    if ($('#discount_percentage').val() == '')
        $('#discount_percentage').val(0);
    var totalamount = parseFloat($('#amount').val()).toFixed(2);
    var discount_percentage = parseFloat($('#discount_percentage').val());
    var discount = (totalamount * discount_percentage) / 100;
    var amountafterdiscount = totalamount - discount;
    var vat_percentage = $('#vat_percentage').val();
    var totalvatamount = (amountafterdiscount * vat_percentage) / 100;
    var grandtotalamount = amountafterdiscount + totalvatamount;
    $('#totalamount').val(totalamount);
    $('#discount').val(discount);
    $('#amountafterdiscount').val(amountafterdiscount.toFixed(2));
    $('#totalvatamount').val(totalvatamount.toFixed(2));
    $('#grandtotalamount').val(grandtotalamount);
}


$(document.body).on("keyup", ".valChanged", function () {
    final_calculate();
});

$(document.body).on("change", "#vat_percentage", function () {
    final_calculate();
});

$(document).on('click', '#performainvoice_submit', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#salesman').val() == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Salesman!");
        error++;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if ($('#method').val() == "") {
        $('#method').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Method!");
        error++;
    } else {
        $('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if ($('#quotedate').val() == "") {
        $('#quotedate').addClass('is-invalid');
        error++;
    } else
        $('#quotedate').removeClass('is-invalid');



    if ($('#amount').val() == "") {
        $('#amount').addClass('is-invalid');
        error++;
    } else
        $('#amount').removeClass('is-invalid');

    if ($('#valid_till').val() == "") {
        $('#valid_till').addClass('is-invalid');
        error++;
    } else
        $('#valid_till').removeClass('is-invalid');

    if ($('#vat_percentage').val() == "") {
        $('#vat_percentage').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add vat Percentage !");
        error++;
    } else {
        $('#vat_percentage').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if ($('#additional_vat_percentage').val() == "") {
        $('#additional_vat_percentage').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add vat Percentage !");
        error++;
    } else {
        $('#additional_vat_percentage').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    $("select[name^='additional_cost_vat[]']").each(function (input) {
        if ($(this).val() == "") {
            $(this).next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add vat Percentage !");
            error++;
        } else {
            $(this).next().find('.select2-selection').removeClass('select-dropdown-error');
        }
    });

    var balanced_amount = $('#balanced_amount').val();
    var amount = $('#amount').val();
    if (balanced_amount < amount) {
        $('#balanced_amount').addClass('is-invalid');
        $('#amount').addClass('is-invalid');
        error++;
        toastr.warning("Amount Must be smaller than Balance Amount !");
    } else {
        $('#balanced_amount').removeClass('is-invalid');
        $('#amount').removeClass('is-invalid');
    }

    var additional_balanced_amount = $('#additional_amount').val();
    var additional_amount = $('#additional_amount').val();
    if (additional_balanced_amount < additional_amount) {
        $('#additional_balanced_amount').addClass('is-invalid');
        $('#additional_amount').addClass('is-invalid');
        error++;
        toastr.warning("Amount Must be smaller than Balance Amount !");
    } else {
        $('#additional_balanced_amount').removeClass('is-invalid');
        $('#additional_amount').removeClass('is-invalid');
    }

    if (!error) {
        $('#invoice_submit').addClass('kt-spinner');
        $('#invoice_submit').prop("disabled", true);

        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }

        $.ajax({
            type: "POST",
            url: "../trip-invoice-from-performa-submit",
            dataType: "json",
            data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#invoice_submit').removeClass('kt-spinner');
                    $('#invoice_submit').prop("disabled", false);
                    toastr.success('Invoice ' + sucess_msg + ' Successfuly');
                    window.location.href = "../trip-invoices/" + data.key;
                }
                else {
                    $('#invoice_submit').removeClass('kt-spinner');
                    $('#invoice_submit').prop("disabled", false);
                    toastr.error(data.msg);

                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});



$('body').on('keypress keyup blur', '.integerValDiscount', function (e) {
    $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
    if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
    if ($(this).val() > 100) {
        toastr.error('maximum 100');
        $(this).val(100);
        e.preventDefault();
    }
});


$(".vatamount").prop("readonly", true);

$(document.body).on("change", "#currency", function () {
    var cid = $(this).val();
    $.ajax({
        url: "../../getcurrency_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            $.each(data, function (key, value) {
                cvalue = value.value;
            });
            cvalue = getNum(cvalue);
            $('#currencyvalue').val(cvalue);
        }
    })
});

$(document.body).on("change", "#terms_conditions", function () {
    var cid = $(this).val();
    $.ajax({
        url: "../../get-terms-from-id",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            var termcondition = '';
            $.each(data, function (key, value) {
                termcondition = value.description;
            });

            $('#kt-tinymce-4').val(termcondition);
            tinymce.activeEditor.setContent(termcondition);
            console.log(termcondition);

        }
    })
});
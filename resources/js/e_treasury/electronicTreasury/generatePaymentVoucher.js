/**
*Datatable for product details Information
*/
$('.electronicTreasury').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});



$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#payment_cr_account').val() == '') {
        error++;
        $('#payment_cr_account').find('.select2-selection').addClass('select-dropdown-error');
    } else
        $('#payment_cr_account').find('.select2-selection').removeClass('select-dropdown-error');


    if ($('#voucher_date').val() == '') {
        error++;
        $('#voucher_date').addClass('is-invalid');
    } else
        $('#voucher_date').removeClass('is-invalid');


    if ($('#amount').val() == '') {
        error++;
        $('#amount').addClass('is-invalid');
    } else
        $('#amount').removeClass('is-invalid');

    if ($('#payment_method').val() == '') {
        error++;
        $('#payment_method').find('.select2-selection').addClass('select-dropdown-error');
    } else
        $('#payment_method').find('.select2-selection').removeClass('select-dropdown-error')

    if ($(this).val() == 1) {
        if ($('#cash_transaction_id').val() == '') {
            error++;
            $('#cash_transaction_id').addClass('is-invalid');
        } else
            $('#cash_transaction_id').removeClass('is-invalid');
        if ($('#cash_transaction_referance').val() == '') {
            error++;
            $('#cash_transaction_referance').addClass('is-invalid');
        } else
            $('#cash_transaction_referance').removeClass('is-invalid');
    } else if ($(this).val() == 2) {
        if ($('#bank_account').val() == '') {
            error++;
            $('#bank_account').addClass('is-invalid');
        } else
            $('#bank_account').removeClass('is-invalid');

        if ($('#bank_transaction_id').val() == '') {
            error++;
            $('#bank_transaction_id').addClass('is-invalid');
        } else
            $('#bank_transaction_id').removeClass('is-invalid');

        if ($('#bank_transaction_referance').val() == '') {
            error++;
            $('#bank_transaction_referance').addClass('is-invalid');
        } else
            $('#bank_transaction_referance').removeClass('is-invalid');
    } else if ($(this).val() == 3) {

        if ($('#cheque_number').val() == '') {
            error++;
            $('#cheque_number').addClass('is-invalid');
        } else
            $('#cheque_number').removeClass('is-invalid');

        if ($('#cheque_date').val() == '') {
            error++;
            $('#cheque_date').addClass('is-invalid');
        } else
            $('#cheque_date').removeClass('is-invalid');

        if ($('#cheque_transaction_id').val() == '') {
            error++;
            $('#cheque_transaction_id').addClass('is-invalid');
        } else
            $('#cheque_transaction_id').removeClass('is-invalid');

        if ($('#cheque_transaction_referance').val() == '') {
            error++;
            $('#cheque_transaction_referance').addClass('is-invalid');
        } else
            $('#cheque_transaction_referance').removeClass('is-invalid');

    } else if ($(this).val() == 4) {
        $('#card').show();
        // 
        if ($('#card_transaction_id').val() == '') {
            error++;
            $('#card_transaction_id').addClass('is-invalid');
        } else
            $('#card_transaction_id').removeClass('is-invalid');
        // 
        if ($('#card_transaction_reference').val() == '') {
            error++;
            $('#card_transaction_reference').addClass('is-invalid');
        } else
            $('#card_transaction_reference').removeClass('is-invalid');
    }
    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "generate-payment-voucher-add",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                epr_id: $('#epr_id').val(),
                po_id: $('#po_id').val(),
                invoice_id: $('#invoice_id').val(),
                supplier_payement_id: $('#supplier_payement_id').val(),
                supplier_id: $('#supplier_id').val(),
                payment_cr_account: $('#payment_cr_account').val(),
                voucher_date: $('#voucher_date').val(),
                voucher_notes: $('#voucher_notes').val(),
                voucher_reference: $('#voucher_reference').val(),
                amount: $('#amount').val(),
                payment_method: $('#payment_method').val(),
                cash_transaction_id: $('#cash_transaction_id').val(),
                cash_transaction_referance: $('#cash_transaction_referance').val(),
                bank_account: $('#bank_account').val(),
                bank_transaction_id: $('#bank_transaction_id').val(),
                bank_transaction_referance: $('#bank_transaction_referance').val(),
                cheque_number: $('#cheque_number').val(),
                cheque_date: $('#cheque_date').val(),
                cheque_transaction_id: $('#cheque_transaction_id').val(),
                cheque_transaction_referance: $('#cheque_transaction_referance').val(),
                card_transaction_id: $('#card_transaction_id').val(),
                card_transaction_reference: $('#card_transaction_reference').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
            },
            success: function (data) {
                $('#btnSave').removeClass('kt-spinner');
                $('#btnSave').prop("disabled", false);
                toastr.success(' Payment Voucher generated successfuly');
                window.location.href = "electronic-treasury";
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please fill Mandatory Fields');
});

$('body').on('change', '#payment_method', function () {
    if ($(this).val() == 1) {
        $('#cash').show();
        $('#bank').hide();
        $('#cheque').hide();
        $('#card').hide();
    } else if ($(this).val() == 2) {
        $('#cash').hide();
        $('#bank').show();
        $('#cheque').hide();
        $('#card').hide();
    } else if ($(this).val() == 3) {
        $('#cash').hide();
        $('#bank').hide();
        $('#cheque').show();
        $('#card').hide();
    } else if ($(this).val() == 4) {
        $('#cash').hide();
        $('#bank').hide();
        $('#cheque').hide();
        $('#card').show();
    }
});

$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
        url: "../gettermsquote",
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
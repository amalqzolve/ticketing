$(document).ready(function () {
    $('.kt-selectpicker').select2();
    var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
    var sl = ($("#modeofpaymenttable > tbody > tr").length) + 1;
    $(".addmorepayments").click(function () {
        var table = '#modeofpaymenttable';
        var $tr = $(table).find('tr:last').clone();
        $tr.find(':text').val('');
        $tr.find('select').val('');
        $tr.find('span').remove().end();
        $tr.find('td').first().html(rowcount);
        $(table).append($tr);

    });

    $("body").on("click", ".costremove", function (event) {
        event.preventDefault();
        var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
        if (rowcount > 1) {
            var row = $(this).closest('tr');
            var siblings = row.siblings();
            row.remove();
            siblings.each(function (index) {
                $(this).children().first().text(index);
            });
        } else {
            var row = $(this).closest('tr');
            row.find(':text').val('');
            row.find('select').val('');
            $('.kt-selectpicker').select2();
        }
        amount_calculate();
    });

});
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});


$('body').on('keyup', '.amount', function () {
    var id = $(this).attr('data-id');
    amount_calculate(id);
});


function amount_calculate() {
    var totalamount = 0;
    var balance = 0;
    var total = 0;
    var totaldueamount = 0;


    $('.amount').each(function () {
        var id = $(this).attr('data-id');
        var amount = ($(this).val() == '') ? 0 : $(this).val();
        totalamount += parseFloat(amount);
    });
    $('#addtotal').val(totalamount);
    var total = parseFloat($('#pending_balance_amt').val());
    if (total < totalamount)
        toastr.warning('Amount is less than or Equal Balance Amount');
}

$(document.body).on("change", "#terms_conditions", function () {
    var cid = $(this).val();

    $.ajax({
        url: "../gettermsquote_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            //  console.log(data);
            var termcondition = '';
            $.each(data, function (key, value) {
                termcondition = value.description;
            });

            $('#kt-tinymce-4').val(termcondition);
            tinymce.activeEditor.setContent(termcondition);
        }
    })
});

$(document).on('click', '#btnSubmit', function (e) {
    if ($('#rec_by').val() == "") {
        $('#rec_by').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Received By!");
        return false;
    } else {
        $('#rec_by').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if ($('#date').val() == '') {
        $('#date').addClass('is-invalid');
        toastr.warning("Please enter Date!");
    } else
        $('#date').removeClass('is-invalid');

    var error = 0;
    var enterAmt = parseFloat($('#addtotal').val());
    var balaceAmt = parseFloat($('#pending_balance_amt').val());
    if (balaceAmt < enterAmt) {
        error++;
        toastr.warning('Amount is less than or Equal Balance Amount');
        $("input[name^='amount[]']").each(function (input) {
            $(this).addClass('is-invalid');
        });
        $('#addtotal').addClass('is-invalid');
    } else {
        $("input[name^='amount[]']").each(function (input) {
            $(this).removeClass('is-invalid');
        });
        $('#addtotal').removeClass('is-invalid');
    }
    var debitaccount = [];
    $("select[name^='debitaccount[]']").each(function (input) {
        debitaccount.push($(this).val());
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });
    var reference = [];
    $("input[name^='reference[]']").each(function (input) {
        reference.push($(this).val());
    });
    var amount = [];
    $("input[name^='amount[]']").each(function (input) {
        amount.push($(this).val());
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });
    if (error != 0) {
        toastr.warning("Please Remove Validation Error!");
        return false;
    }
    swal.fire({
        title: 'Do you want to save As ?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Approved',
        denyButtonText: 'Draft',
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            saveDetails(result)
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            saveDetails(result)
        } else {
            $('#btnSubmit').removeClass('kt-spinner');
            $('#btnSubmit').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });


    function saveDetails(result) {
        $('#btnSubmit').addClass('kt-spinner');
        $('#btnSubmit').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "../qpurchase-refund-save",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                supplier_id: $('#supplier_id').val(),
                qbuy_purchase_return_id: $('#qbuy_purchase_return_id').val(),
                qbuy_purchase_pi_id: $('#qbuy_purchase_pi_id').val(),
                date: $('#date').val(),
                rec_by: $('#rec_by').val(),
                notes: $('#notes').val(),
                pending_balance_amt: $('#pending_balance_amt').val(),
                debitaccount: debitaccount,
                reference: reference,
                amount: amount,
                addtotal: $('#addtotal').val(),
                terms_conditions: $('#terms_conditions').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),
                status: status,
            },
            success: function (data) {

                $('#btnSubmit').removeClass('kt-spinner');
                $('#btnSubmit').prop("disabled", false);
                toastr.success('New bill settlement added successfuly');
                window.location.href = "../qpurchase-refund-list";
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }

});
/**
*Datatable for product details Information
*/
$('.invoiceList').addClass('kt-menu__item--active');

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});

$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');

    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
    totalamount_calculate();
});

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var eprPoProductId = [];
    $("input[name^='eprPoProductId[]']")
        .each(function (input) {
            eprPoProductId.push($(this).val());
        });
    var error = 0;
    var eprPoinvloiceProductId = [];
    $("input[name^='eprPoinvloiceProductId[]']")
        .each(function (input) {
            eprPoinvloiceProductId.push($(this).val());
        });

    var payed = [];
    $("input[name^='payed[]']")
        .each(function (input) {
            payed.push($(this).val());
        });

    var payment = [];
    $("input[name^='payment[]']").each(function (input) {
        payment.push($(this).val());
    });
    var qutyChk = checkQty();
    error = error + qutyChk;
    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "generate-supplier-payment-add",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                po_id: $('#poId').val(),
                epr_id: $('#materialRequestid').val(),
                invoice_id: $('#invoice_id').val(),
                payement_book_date: $('#payement_book_date').val(),
                eprPoProductId: eprPoProductId,
                eprPoinvloiceProductId: eprPoinvloiceProductId,
                payed: payed,
                payment: payment,
                terms: $('#terms').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                grandtotalamount: $('#grandtotalamount').val(),
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.success('Supplier payment successfuly Saved');
                    loaderClose();
                    window.location.href = "supplier-payment";
                } else
                    toastr.error(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});

$('body').on('change', '.payment', function () {
    var id = $(this).attr('data-id');
    var payed = $('#payed' + id + '').val();
    var payment = $('#payment' + id + '').val();
    var row_total = $('#row_total' + id + '').val();
    var balance = parseFloat(row_total) - (parseFloat(payed) + parseFloat(payment));

    if (balance < 0) {
        $(this).addClass('is-invalid');
        $(this).val('');
        toastr.error('Please Enter a Valid Payment !!!!');
    } else {
        $('#balance' + id + '').val(balance);
        $(this).removeClass('is-invalid');
        totalamount_calculate();
    }
});
function checkQty() {
    var id;
    var error = 0;
    var balanceQty;
    var quantity;
    $("input[name^='payed[]']").each(function (input) {
        var id = $(this).attr('data-id');
        var payed = $('#payed' + id + '').val();
        var payment = $('#payment' + id + '').val();
        var row_total = $('#row_total' + id + '').val();
        var balance = parseFloat(row_total) - (parseFloat(payed) + parseFloat(payment));
        if (balance < 0) {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });
    return error;
}

$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
        url: "get-terms-from-id",
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
            console.log(termcondition);

        }
    })
});

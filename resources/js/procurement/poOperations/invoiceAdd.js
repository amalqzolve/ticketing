/**
*Datatable for product details Information
*/
$('.openedPoList').addClass('kt-menu__item--active');

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


    var productname = [];
    $("input[name^='productname[]']").each(function (input) {
        productname.push($(this).val());
    });



    var product_description = [];

    $("textarea[name^='product_description[]']").each(function (input) {
        product_description.push($(this).val());
    });
    var error = 0;
    var payment = [];
    var rowCount = 0;
    $("input[name^='payment[]']").each(function (input) {
        rowCount++;
        payment.push($(this).val());
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });
    if (!rowCount) {
        toastr.warning('Add at least one row');
        error++;
    }

    if ($('#supplier_invoice_number').val() == '') {
        error++;
        $('#supplier_invoice_number').addClass('is-invalid');
    } else
        $('#supplier_invoice_number').removeClass('is-invalid');
    if ($('#bill_entry_date').val() == '') {
        error++;
        $('#bill_entry_date').addClass('is-invalid');
    } else
        $('#bill_entry_date').removeClass('is-invalid');
    if ($('#supplier_invoice_date').val() == '') {
        error++;
        $('#supplier_invoice_date').addClass('is-invalid');
    } else
        $('#supplier_invoice_date').removeClass('is-invalid');


    var payed = [];
    $("input[name^='payed[]']").each(function (input) {
        payed.push($(this).val());
    });

    var qutyChk = checkQty();
    error = error + qutyChk;
    var epr_id = $('#materialRequestid').val();
    var po_id = $('#poId').val();
    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "epr-po-invoice-save",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                po_id: po_id,
                epr_id: epr_id,
                eprPoProductId: eprPoProductId,
                productname: productname,
                product_description: product_description,
                payment: payment,
                payed: payed,
                // 
                supplier_invoice_number: $('#supplier_invoice_number').val(),
                supplier_invoice_date: $('#supplier_invoice_date').val(),
                supplier_invoice_over_due_date: $('#supplier_invoice_over_due_date').val(),
                supplier_invoice_credit_period: $('#supplier_invoice_credit_period').val(),
                bill_entry_date: $('#bill_entry_date').val(),
                // 
                quotedate: $('#quotedate').val(),
                dateofsupply: $('#dateofsupply').val(),
                request_type: $('#request_type').val(),
                mr_category: $('#mr_category').val(),
                request_priority: $('#request_priority').val(),
                request_against: $('#request_against').val(),
                client: $('#client').val(),
                project: $('#project').val(),
                supplier: $('#supplier_vendor_name').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
                grandtotalamount: $('#grandtotalamount').val(),
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.success('EPR PO Edited successfuly');
                    loaderClose();
                    window.location.href = "epr-po-invoice-list";
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
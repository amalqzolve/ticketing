/**
 *Datatable for product details Information
 */
$('.rfqList').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
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


$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');


    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });

    var vatamounts = 0;
    $('.vatamount').each(function () {
        var id = $(this).attr('data-id');
        var vatamount = $('#vatamount' + id + '').val();

        vatamounts += parseFloat(vatamount);

    });
    $('#totalvatamount').val(vatamounts.toFixed(2));


    totalamount_calculate();
    discount_calculate();
    final_calculate1();


});

$(document).on('click', '#epr_update', function (e) {
    e.preventDefault();

    var eprProductId = [];
    $("input[name^='eprProductId[]']")
        .each(function (input) {
            eprProductId.push($(this).val());
        });
    var productname = [];
    $("input[name^='productname[]']")
        .each(function (input) {
            productname.push($(this).val());
        });

    var product_description = [];

    $("textarea[name^='product_description[]']")
        .each(function (input) {
            product_description.push($(this).val());
        });

    var unit = [];

    $("select[name^='unit[]']")
        .each(function (input) {
            unit.push($(this).val());
        });
    var error = 0;
    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function (input) {
            quantity.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });

    var rate = [];
    $("input[name^='rate[]']")
        .each(function (input) {
            rate.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var amount = [];
    $("input[name^='amount[]']")
        .each(function (input) {
            amount.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var discountamount = [];
    $("input[name^='discountamount[]']")
        .each(function (input) {
            discountamount.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var vat_percentage = [];
    $("select[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var vatamount = [];
    $("input[name^='vatamount[]']")
        .each(function (input) {
            vatamount.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var row_total = [];
    $("input[name^='row_total[]']")
        .each(function (input) {
            row_total.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });

    if ($('#supp_quot_id').val() == '') {
        error++;
        $('#supp_quot_id').addClass('is-invalid');
    }
    else
        $('#supp_quot_id').removeClass('is-invalid');

    if ($('#quot_date').val() == '') {
        error++;
        $('#quot_date').addClass('is-invalid');
    }
    else
        $('#quot_date').removeClass('is-invalid');

    if ($('#request_type').val() == '') {
        error++;
        $('#request_type').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#request_type').next().find('.select2-selection').removeClass('select-dropdown-error');
    if ($('#mr_category').val() == '') {
        error++;
        $('#mr_category').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#mr_category').next().find('.select2-selection').removeClass('select-dropdown-error');
    if ($('#request_against').val() == '') {
        error++;
        $('#request_against').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#request_against').next().find('.select2-selection').removeClass('select-dropdown-error');
    var epr_id = $('#materialRequestid').val();
    var id = $('#id').val();
    if (error == 0) {
        $('#epr_update').addClass('kt-spinner');
        $('#epr_update').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "epr-rfq-submit-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: id,
                epr_id: epr_id,
                eprProductId: eprProductId,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                rate: rate,
                amount: amount,
                discountamount: discountamount,
                vat_percentage: vat_percentage,
                vatamount: vatamount,
                row_total: row_total,
                supp_quot_id: $('#supp_quot_id').val(),
                quot_date: $('#quot_date').val(),
                quote_valid_date: $('#quote_valid_date').val(),
                rfq_date: $('#rfq_date').val(),
                rfq_valid_till: $('#rfq_valid_till').val(),
                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),
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
            },
            success: function (data) {
                if (data.status) {
                    $('#epr_update').removeClass('kt-spinner');
                    $('#epr_update').prop("disabled", false);
                    toastr.success('EPR RFQ Submited successfuly');
                    loaderClose();
                    window.location.href = "epr-rfq-list";
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please fill the mandetory field !!!!');
});
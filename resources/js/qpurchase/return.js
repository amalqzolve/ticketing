$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();

    var cnt = 0;
    var item_details_id = [];
    $("input[name^='item_details_id[]']").each(function (input) {
        cnt++;
        item_details_id.push($(this).val());
    });

    var new_product_id = [];
    $("input[name^='new_product_id[]']").each(function (input) {
        new_product_id.push($(this).val());
    });

    if (cnt == 0) {
        toastr.warning("Please add Item");
        return false;
    }

    var qbuy_purchase_pi_products_id = [];
    $("input[name^='qbuy_purchase_pi_products_id[]']").each(function (input) {
        qbuy_purchase_pi_products_id.push($(this).val());
    });

    var quantity = [];
    $("input[name^='quantity[]']").each(function (input) {
        if ($(this).val() < 0 || !$(this).val()) {
            toastr.warning("Please add a valid Quantity");
            return false;
        } else {
            quantity.push($(this).val());
        }
    });


    var rate = [];

    $("input[name^='rate[]']").each(function (input) {
        rate.push($(this).val());
    });

    var amount = [];

    $("input[name^='amount[]']").each(function (input) {
        amount.push($(this).val());
    });

    var vatamount = [];

    $("input[name^='vatamount[]']").each(function (input) {
        vatamount.push($(this).val());
    });
    var vat_percentage = [];

    $("select[name^='vat_percentage[]']").each(function (input) {
        vat_percentage.push($(this).val());
    });

    var discountamount = [];

    $("input[name^='discountamount[]']").each(function (input) {
        discountamount.push($(this).val());
    });

    var row_total = [];

    $("input[name^='row_total[]']").each(function (input) {
        row_total.push($(this).val());
    });

    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
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
            $('#btnSave').removeClass('kt-spinner');
            $('#btnSave').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });


    function saveDetails(result) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "qpurchase-return-save",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),

                qbuy_purchase_pi_id: $('#qbuy_purchase_pi_id').val(),
                supplier_id: $('#supplier_id').val(),

                returndate: $('#returndate').val(),
                reason: $('#reason').val(),

                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),


                item_details_id: item_details_id,
                new_product_id: new_product_id,
                qbuy_purchase_pi_products_id: qbuy_purchase_pi_products_id,
                quantity: quantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                vat_percentage: vat_percentage,
                discountamount: discountamount,
                row_total: row_total,
                status: status,
            },
            success: function (data) {
                if (data == false) {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                }
                else {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.success('Purchase details ' + sucess_msg + ' successfuly');
                    window.location.href = "qpurchase-return";
                }
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
                toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
                $('#btnSave').removeClass('kt-spinner');
                $('#btnSave').prop("disabled", false);
            }
        });
    }

});

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});


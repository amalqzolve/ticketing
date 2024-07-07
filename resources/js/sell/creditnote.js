$(document).on('click', '#creditnote_submit', function (e) {
    e.preventDefault();
    salesman = $('#salesman').val();
    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    var item_id = [];
    $("input[name^='item_id[]']").each(function (input) {
        item_id.push($(this).val());
    });

    var qsell_saleinvoice_product_id = [];
    $("input[name^='qsell_saleinvoice_product_id[]']").each(function (input) {
        qsell_saleinvoice_product_id.push($(this).val());
    });

    var description = [];

    $("textarea[name^='description[]']").each(function (input) {
        description.push($(this).val());
    });

    var unit = [];

    $("select[name^='unit[]']").each(function (input) {
        unit.push($(this).val());
    });

    var quantity = [];
    var zeroProduct = 0;
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
        if ($(this).val() == 0)
            zeroProduct++;
    });

    if (zeroProduct != 0) {
        toastr.warning("Return Quantity must be grater than zero!");
        return false;
    }
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

    $("input[name^='vat_percentage[]']").each(function (input) {
        vat_percentage.push($(this).val());
    });


    var rdiscount = [];

    $("input[name^='discountamount[]']").each(function (input) {
        rdiscount.push($(this).val());
    });


    var row_total = [];

    $("input[name^='row_total[]']").each(function (input) {
        row_total.push($(this).val());
    });


    var ttotal = 0;
    $.each(row_total, function () {
        ttotal += parseInt(this, 10);
    });
    if (ttotal > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any Product!");
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
            swal.fire("Cancelled", "", "error");
            $('#creditnote_submit').removeClass('kt-spinner');
            $('#creditnote_submit').prop("disabled", false);
        }
    });

    function saveDetails(result) {
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $('#creditnote_submit').addClass('kt-spinner');
        $('#creditnote_submit').prop("disabled", true);

        if ($('#id').val())
            var sucess_msg = 'Updated';
        else
            var sucess_msg = 'Created';

        $.ajax({
            type: "POST",
            url: "creditnotesubmit_sell",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                invoiceid: $('#invoiceid').val(),
                returndate: $('#returndate').val(),
                reason: $('#reason').val(),
                quotedate: $('#quotedate').val(),
                valid_till: $('#valid_till').val(),
                method: $('#method').val(),
                qtn_ref: $('#qtn_ref').val(),
                po_ref: $('#po_ref').val(),
                attention: $('#attention').val(),
                salesman: $('#salesman').val(),
                currency: $('#currency').val(),
                currencyvalue: $('#currency_value').val(),
                payment_terms: $('#payment_terms').val(),
                discount_type: $('#discount_type').val(),
                notes: $('#notes').val(),
                internal_reference: $('#internal_reference').val(),
                terms: $('#terms').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),

                customer: $('#customer').val(),

                item_id: item_id,
                qsell_saleinvoice_product_id: qsell_saleinvoice_product_id,
                description: description,
                unit: unit,
                quantity: quantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                rdiscount: rdiscount,
                vat_percentage: vat_percentage,
                row_total: row_total,
                status: status
            },
            success: function (data) {
                window.location.href = "creditnote_sell";
                toastr.success('Credit Note' + sucess_msg + ' successfuly');
                $('#creditnote_submit').removeClass('kt-spinner');
                $('#creditnote_submit').prop("disabled", false);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
                toastr.error('Credit Note' + sucess_msg + ' successfuly');
                $('#creditnote_submit').removeClass('kt-spinner');
                $('#creditnote_submit').prop("disabled", false);
            }
        });
    }
});



$(document).on('click', '#convertcreditnote_submit', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();


    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;

    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    var item_id = [];

    $("input[name^='item_id[]']")
        .each(function (input) {
            item_id.push($(this).val());
        });

    var description = [];

    $("textarea[name^='description[]']")
        .each(function (input) {
            description.push($(this).val());
        });

    var unit = [];

    $("select[name^='unit[]']")
        .each(function (input) {
            unit.push($(this).val());
        });

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function (input) {
            quantity.push($(this).val());
        });

    var rate = [];

    $("input[name^='rate[]']")
        .each(function (input) {
            rate.push($(this).val());
        });

    var amount = [];

    $("input[name^='amount[]']")
        .each(function (input) {
            amount.push($(this).val());
        });

    var vatamount = [];

    $("input[name^='vatamount[]']")
        .each(function (input) {
            vatamount.push($(this).val());
        });



    var vat_percentage = [];

    $("input[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
        });


    var rdiscount = [];

    $("input[name^='discountamount[]']")
        .each(function (input) {
            rdiscount.push($(this).val());
        });


    var row_total = [];

    $("input[name^='row_total[]']")
        .each(function (input) {
            row_total.push($(this).val());
        });


    var ttotal = 0;
    $.each(row_total, function () {
        ttotal += parseInt(this, 10);
    });


    if (ttotal > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any Product!");
        return false;
    }


    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "creditnotesubmit_sell1",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            invoiceid: $('#invoiceid').val(),
            returndate: $('#returndate').val(),
            reason: $('#reason').val(),
            quotedate: $('#quotedate').val(),
            valid_till: $('#valid_till').val(),
            method: $('#method').val(),
            qtn_ref: $('#qtn_ref').val(),
            po_ref: $('#po_ref').val(),
            attention: $('#attention').val(),
            salesman: $('#salesman').val(),
            currency: $('#currency').val(),
            currencyvalue: $('#currency_value').val(),
            payment_terms: $('#payment_terms').val(),
            discount_type: $('#discount_type').val(),
            notes: $('#notes').val(),
            internal_reference: $('#internal_reference').val(),
            terms: $('#terms').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),

            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),

            customer: $('#customer').val(),
            rid: $('#rid').val(),

            item_id: item_id,
            description: description,
            unit: unit,
            quantity: quantity,
            rate: rate,
            amount: amount,
            vatamount: vatamount,
            rdiscount: rdiscount,
            vat_percentage: vat_percentage,
            row_total: row_total,



        },
        success: function (data) {


            //  $('#convertcreditnote_submit').removeClass('kt-spinner');
            window.location.href = "creditnote_sell";
            toastr.success('Credit Note' + sucess_msg + ' successfuly');
            $('#convertcreditnote_submit').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
$(document).on('click', '#performainvoice_submit', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();
    mmethod = $('#method').val();
    cust_code = $('#cust_code').val();
    cust_group = $('#cust_group').val();
    cust_type = $('#cust_type').val();
    cust_category = $('#cust_category').val();
    cust_name = $('#cust_name').val();
    cust_country = $('#cust_country').val();



    if (quotedate == "") {
        $('#quotedate').addClass('is-invalid');
        toastr.warning("Please Quote Date!");
        return false;
    } else {
        $('#quotedate').removeClass('is-invalid');
    }

    if (valid_till == "") {
        $('#valid_till').addClass('is-invalid');
        toastr.warning("Please Add Valid Till Date!");
        return false;
    } else {
        $('#valid_till').removeClass('is-invalid');
    }



    if ($('#newcustomer').val() == 2) {
        if ($('#customer').val() == '') {
            $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Customer!");
            return false;
        }
        else
            $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
    } else {//new customer
        if ($('#cust_name').val() == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer Name!");
            return false;
        } else {
            $('#cust_name').removeClass('is-invalid');
        }
    }


    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;

    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if (preparedby == "") {
        $('#preparedby').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Prepared by!");
        return false;

    } else {
        $('#preparedby').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if (mmethod == "") {
        $('#method').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Method!");
        return false;
    } else {
        $('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    var item_id = [];

    $("input[name^='item_id[]']").each(function (input) {
        item_id.push($(this).val());
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

    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
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

    $('#performainvoice_submit').addClass('kt-spinner');
    $('#performainvoice_submit').prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }
    $.ajax({
        type: "POST",
        url: "performainvoicesubmit_sell",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            qtn_ref: $('#qtn_ref').val(),
            po_ref: $('#po_ref').val(),
            delivery_period: $('#delivery_period').val(),
            attention: $('#attention').val(),
            salesman: $('#salesman').val(),
            currency: $('#currency').val(),
            currencyvalue: $('#currencyvalue').val(),
            preparedby: $('#preparedby').val(),
            approvedby: $('#approvedby').val(),
            payment_terms: $('#payment_terms').val(),
            discount_type: $('#discount_type').val(),
            notes: $('#notes').val(),
            internalreference: $('#internalreference').val(),
            terms_conditions: $('#terms_conditions').val(),
            quotedate: $('#quotedate').val(),
            valid_till: $('#valid_till').val(),
            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),

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

            customer: $('#customer').val(),
            customer_type: $('#newcustomer').val(),
            reference: $('#reference').val(),

            shipping_address: $('#shipping_address').val(),
            billing_address: $('#billing_address').val(),
            contact_phone: $('#contact_phone').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            cust_category: $('#cust_category').val(),
            cust_code: $('#cust_code').val(),
            cust_type: $('#cust_type').val(),
            cust_group: $('#cust_group').val(),
            cust_name: $('#cust_name').val(),
            cust_country: $('#cust_country').val(),
            building_no: $('#building_no').val(),
            cust_region: $('#cust_region').val(),
            cust_district: $('#cust_district').val(),
            cust_city: $('#cust_city').val(),
            cust_zip: $('#cust_zip').val(),
            mobile: $('#mobile').val(),
            vatno: $('#vatno').val(),
            buyerid_crno: $('#buyerid_crno').val(),
            dateofsupply: $('#dateofsupply').val(),
            method: $('#method').val(),
            paidamount: $('#paidamount').val(),
            balanceamount: $('#balanceamount').val(),

        },
        success: function (data) {


            //   $('#performainvoice_submit').removeClass('kt-spinner');
            $('#performainvoice_submit').prop("disabled", false);
            window.location.href = "sell_performainvoice_list";
            toastr.success('Performa Invoice' + sucess_msg + ' successfuly');


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});


$(document).on('click', '#performainvoice_update', function (e) {
    e.preventDefault();
    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();
    mmethod = $('#method').val();
    cust_code = $('#cust_code').val();
    cust_group = $('#cust_group').val();
    cust_type = $('#cust_type').val();
    cust_category = $('#cust_category').val();
    cust_name = $('#cust_name').val();
    cust_country = $('#cust_country').val();

    if ($('#salesman').val() == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if (cust_name == "") {
        toastr.warning('Cusomer is Required.');
        return false;
    }

    if (mmethod == "") {
        $('#method').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Method!");
        return false;
    } else {
        $('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    var item_id = [];
    $("input[name^='item_id[]']").each(function (input) {
        item_id.push($(this).val());
    });

    var so_item_id = [];
    $("input[name^='so_item_id[]']").each(function (input) {
        so_item_id.push($(this).val());
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

    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
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


    var rdiscount = [];

    $("input[name^='discountamount[]']").each(function (input) {
        rdiscount.push($(this).val());
    });

    var row_total = [];

    $("input[name^='row_total[]']").each(function (input) {
        row_total.push($(this).val());
    });

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

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
    $('#performainvoice_update').addClass('kt-spinner');
    $('#performainvoice_update').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "performainvoiceupdate_sell",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            saleorder_id: $('#saleorder_id').val(),
            qtn_ref: $('#qtn_ref').val(),
            po_ref: $('#po_ref').val(),
            delivery_period: $('#delivery_period').val(),
            attention: $('#attention').val(),
            salesman: $('#salesman').val(),
            currency: $('#currency').val(),
            currencyvalue: $('#currencyvalue').val(),
            preparedby: $('#preparedby').val(),
            approvedby: $('#approvedby').val(),
            payment_terms: $('#payment_terms').val(),
            discount_type: $('#discount_type').val(),
            notes: $('#notes').val(),
            internalreference: $('#internalreference').val(),
            terms_conditions: $('#terms_conditions').val(),
            quotedate: $('#quotedate').val(),
            valid_till: $('#valid_till').val(),
            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),

            item_id: item_id,
            so_item_id: so_item_id,
            description: description,
            unit: unit,
            quantity: quantity,
            rate: rate,
            amount: amount,
            vatamount: vatamount,
            rdiscount: rdiscount,
            vat_percentage: vat_percentage,
            row_total: row_total,

            customer: $('#customer_id').val(),
            customer_type: $('#newcustomer').val(),
            reference: $('#reference').val(),

            shipping_address: $('#shipping_address').val(),
            billing_address: $('#billing_address').val(),
            contact_phone: $('#contact_phone').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            method: $('#method').val(),
            paidamount: $('#paidamount').val(),
            balanceamount: $('#balanceamount').val(),

        },
        success: function (data) {
            $('#performainvoice_update').removeClass('kt-spinner');
            $('#performainvoice_update').prop("disabled", false);
            window.location.href = "sell_performainvoice_list";
            toastr.success('Performa Invoice Updated successfuly');
        },
        error: function (jqXhr, json, errorThrown) {
            $('#performainvoice_update').removeClass('kt-spinner');
            $('#performainvoice_update').prop("disabled", false);
            toastr.error('Error While Update');
            console.log('Error !!');
        }
    });
});


$(document).on('click', '#performainvoice_convert', function (e) {
    e.preventDefault();
    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();
    mmethod = $('#method').val();
    cust_code = $('#cust_code').val();
    cust_group = $('#cust_group').val();
    cust_type = $('#cust_type').val();
    cust_category = $('#cust_category').val();
    cust_name = $('#cust_name').val();
    cust_country = $('#cust_country').val();

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if (cust_name == "") {
        // $('#cust_name').addClass('is-invalid');
        toastr.warning('Cusomer is Required.');
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }


    if (mmethod == "") {
        $('#method').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Method!");
        return false;
    } else {
        $('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    var item_id = [];
    $("input[name^='item_id[]']").each(function (input) {
        item_id.push($(this).val());
    });

    var so_item_id = [];
    $("input[name^='so_item_id[]']").each(function (input) {
        so_item_id.push($(this).val());
    });


    var description = [];
    $("textarea[name^='description[]']").each(function (input) {
        description.push($(this).val());
    });

    var unit = [];
    $("select[name^='unit[]']").each(function (input) {
        unit.push($(this).val());
    });

    var purchaserate = [];
    $("input[name^='purchaserate[]']").each(function (input) {
        purchaserate.push($(this).val());
    });

    var quantity = [];
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
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


    var rdiscount = [];
    $("input[name^='discountamount[]']").each(function (input) {
        rdiscount.push($(this).val());
    });
    var row_total = [];
    $("input[name^='row_total[]']").each(function (input) {
        row_total.push($(this).val());
    });
    var soid = [];
    $("input[name^='soid[]']").each(function (input) {
        soid.push($(this).val());
    });


    var type = [];
    $("select[name^='type[]']").each(function (input) {
        type.push($(this).val());
    });

    var depositaccount = [];
    $("select[name^='depositaccount[]']").each(function (input) {
        depositaccount.push($(this).val());
    });

    var reference = [];
    $("input[name^='reference[]']").each(function (input) {
        reference.push($(this).val());
    });
    var pay_amount = [];
    $("input[name^='pay_amount[]']").each(function (input) {
        pay_amount.push($(this).val());
    });



    var payments = checkPayements(); //chek payments at the time of invoice
    if (payments)
        return false;

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
            saveInvoice(result)
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            saveInvoice(result)
        } else {
            swal.fire("Cancelled", "", "error");
            $('#performainvoice_convert').removeClass('kt-spinner');
            $('#performainvoice_convert').prop("disabled", false);
        }
    });

    function saveInvoice(result) {

        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $('#invoice_edit_sell_byquote').addClass('kt-spinner');
        $('#invoice_edit_sell_byquote').prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "performainvoiceconvert_sell",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                saleorder_id: $('#saleorder_id').val(),
                qtn_ref: $('#qtn_ref').val(),
                po_ref: $('#po_ref').val(),
                delivery_period: $('#delivery_period').val(),
                attention: $('#attention').val(),
                salesman: $('#salesman').val(),
                currency: $('#currency').val(),
                currencyvalue: $('#currencyvalue').val(),
                preparedby: $('#preparedby').val(),
                approvedby: $('#approvedby').val(),
                payment_terms: $('#payment_terms').val(),
                discount_type: $('#discount_type').val(),
                notes: $('#notes').val(),
                internalreference: $('#internalreference').val(),
                terms_conditions: $('#terms_conditions').val(),
                quotedate: $('#quotedate').val(),
                valid_till: $('#valid_till').val(),
                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                item_id: item_id,
                so_item_id: so_item_id,
                description: description,
                unit: unit,
                purchaserate: purchaserate,
                quantity: quantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                rdiscount: rdiscount,
                vat_percentage: vat_percentage,
                row_total: row_total,
                soid: soid,

                customer: $('#customer_id').val(),
                customer_type: $('#newcustomer').val(),
                reference: $('#reference').val(),

                shipping_address: $('#shipping_address').val(),
                billing_address: $('#billing_address').val(),
                contact_phone: $('#contact_phone').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),
                method: $('#method').val(),

                mark_payments: ($("#markPayments").prop('checked') == true) ? 1 : 0,
                use_advance: ($("#use_advance").prop('checked') == true) ? 1 : 0,
                advance_amt: $('#advance_amt').val(),

                type: type,
                depositaccount: depositaccount,
                reference: reference,
                pay_amount: pay_amount,

                paidamount: $('#paidamount').val(),
                balanceamount: $('#balanceamount').val(),
            },
            success: function (data) {
                $('#invoice_edit_sell_byquote').removeClass('kt-spinner');
                $('#invoice_edit_sell_byquote').prop("disabled", false);
                window.location.href = "sell_invoice_list";
                toastr.success('Performa Invoice converted to Sales Invoice');
            },
            error: function (jqXhr, json, errorThrown) {
                $('#invoice_edit_sell_byquote').removeClass('kt-spinner');
                $('#invoice_edit_sell_byquote').prop("disabled", false);
                toastr.error('Error While Save');
                console.log('Error !!');
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
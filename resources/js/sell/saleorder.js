$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});

$(document.body).on("change", "#terms_conditions", function () {
    var cid = $(this).val();

    $.ajax({
        url: "gettermsquote_sell",
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


$(document).on('click', '#saleorder_delivery_update', function (e) {
    e.preventDefault();
    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();


    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Customer!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    var product_row_id = [];

    $("input[name^='product_row_id[]']").each(function (input) {
        product_row_id.push($(this).val());
    });


    var item_id = [];

    $("input[name^='item_id[]']").each(function (input) {
        item_id.push($(this).val());
    });

    var description = [];

    $("textarea[name^='description[]']").each(function (input) {
        description.push($(this).val());
    });



    var quantity = [];

    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
    });

    var delivery_quantity = [];

    $("input[name^='delivery_quantity[]']").each(function (input) {
        delivery_quantity.push($(this).val());
    });





    var tdelivery_quantity = 0;
    $.each(delivery_quantity, function () {
        tdelivery_quantity += parseInt(this, 10);
    });


    if (tdelivery_quantity > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any Product for Delivery!");
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
        url: "saleorder_generate_delivery",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            saleorder_id: $('#id').val(),
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
            internal_reference: $('#internal_reference').val(),
            terms_conditions: $('#terms_conditions').val(),
            quotedate: $('#quotedate').val(),
            valid_till: $('#valid_till').val(),
            product_row_id: product_row_id,
            item_id: item_id,
            description: description,
            quantity: quantity,
            delivery_quantity: delivery_quantity,


            customer: $('#cid').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            dateofsupply: $('#dateofsupply').val(),

        },
        success: function (data) {


            //    $('#saleorder_delivery_update').removeClass('kt-spinner');
            window.location.href = "sell_delivery_list";
            toastr.success('Delivery Order Created successfuly');
            $('#saleorder_delivery_update').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});


$(document).on('click', '#saleorder_invoice', function (e) {
    e.preventDefault();
    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();


    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Customer!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;

    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }




    var product_row_id = [];

    $("input[name^='product_row_id[]']")
        .each(function (input) {
            product_row_id.push($(this).val());
        });

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

    $("select[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
        });


    var rdiscount = [];

    $("input[name^='discount_type_amount[]']")
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
        url: "saleorder_invoice_sell",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            invoicenumber: $('#invoice_number').val(),
            saleorder_id: $('#id').val(),
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
            internal_reference: $('#internal_reference').val(),
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
            reference: $('#reference').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            dateofsupply: $('#dateofsupply').val(),
            method: $('#method').val(),
            paidamount: $('#paidamount').val(),
            balanceamount: $('#balanceamount').val(),
            product_row_id: product_row_id,
            useadvance: $('#useadvance').val(),


        },
        success: function (data) {


            //   $('#saleorder_invoice').removeClass('kt-spinner');
            window.location.href = "sell_invoice_list";
            toastr.success('Invoice Order Created successfuly');
            $('#saleorder_invoice').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});
$(document).on('click', '#salesorder_update', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();


    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Customer!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }

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

    $("select[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
        });


    var rdiscount = [];

    $("input[name^='discount_type_amount[]']")
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
        url: "newsalesorderupdate_sell",
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
            internal_reference: $('#internal_reference').val(),
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

            customer: $('#cid').val(),
            customer_type: $('#newcustomer').val(),
            reference: $('#reference').val(),

            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            dateofsupply: $('#dateofsupply').val(),
            method: $('#method').val(),

        },
        success: function (data) {

            //   $('#salesorder_update').removeClass('kt-spinner');

            window.location.href = "sell_saleorder_list";
            toastr.success('Sales Order ' + sucess_msg + ' successfuly');
            $('#salesorder_update').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});


$(document).on('click', '#saleorder_purchase_orders', function (e) {
    e.preventDefault();
    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();


    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Customer!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;

    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }




    var product_row_id = [];

    $("input[name^='product_row_id[]']")
        .each(function (input) {
            product_row_id.push($(this).val());
        });


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

    $("select[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
        });


    var rdiscount = [];

    $("input[name^='discount_type_amount[]']")
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
        url: "saleorder_purchase_orders_sell",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            saleorder_id: $('#id').val(),
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
            internal_reference: $('#internal_reference').val(),
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
            reference: $('#reference').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            dateofsupply: $('#dateofsupply').val(),
            method: $('#method').val(),
            paidamount: $('#paidamount').val(),
            balanceamount: $('#balanceamount').val(),
            product_row_id: product_row_id,

        },
        success: function (data) {

            //$('#saleorder_purchase_orders').removeClass('kt-spinner');
            window.location.href = "sell_invoice_list";
            toastr.success('Purchase Order Created successfuly');
            $('#saleorder_purchase_orders').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});


$(document).on('click', '#convert_po', function (e) {
    e.preventDefault();

    customer = $('#customer1').val();
    reference = $('#reference').val();
    attention = $('#attention').val();
    salesman = $('#salesman').val();
    quotedate = $('#quotedate').val();
    validity = $('#dateofsupply').val();
    currency = $('#currency').val();
    currencyvalue = $('#currency_value').val();

    totalamount = $('#totalamount').val();
    discount = $('#discount').val();
    amountafterdiscount = $('#amountafterdiscount').val();
    totalvatamount = $('#totalvatamount').val();
    grandtotalamount = $('#grandtotalamount').val();

    terms = $('#terms').val();
    notes = $('#notes').val();
    preparedby = $('#preparedby').val();
    approvedby = $('#approvedby').val();
    cust_name = $('#cust_name').val();


    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Supplier!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }

    var productname = [];

    $("input[name^='item_id[]']")
        .each(function (input) {
            productname.push($(this).val());
        });

    var product_description = [];

    $("textarea[name^='description[]']")
        .each(function (input) {
            product_description.push($(this).val());
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

    $("select[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
        });


    var rdiscount = [];

    $("input[name^='discount_type_amount[]']")
        .each(function (input) {
            rdiscount.push($(this).val());
        });


    var row_total = [];

    $("input[name^='row_total[]']")
        .each(function (input) {
            row_total.push($(this).val());
        });

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    //        var ttotal = 0;
    // $.each(row_total,function() {
    //     ttotal += parseInt(this, 10);
    // });


    // if (ttotal > 0) {
    //     // the array is defined and has at least one element
    // }else{
    //        toastr.warning("Please Add Any Product!");
    //           return false;
    // }


    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "so_convert_po",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            soid: $('#soid').val(),
            quotedate: $('#quotedate').val(),
            valid_till: $('#valid_till').val(),
            qtnref: $('#qtnref').val(),
            po_wo_ref: $('#po_wo_ref').val(),
            attention: $('#attention').val(),
            salesman: $('#salesman').val(),
            currency: $('#currency').val(),
            currencyvalue: $('#currency_value').val(),
            preparedby: $('#preparedby').val(),
            approvedby: $('#approvedby').val(),
            internalreference: $('#internalreference').val(),
            notes: $('#notes').val(),
            terms: $('#terms').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            supplier: $('#customer1').val(),
            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),

            productname: productname,
            product_description: product_description,
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

            //$('#convert_po').removeClass('kt-spinner');
            $('#convert_po').prop("disabled", false);
            location.reload();
            window.location.href = "sell_saleorder_list";
            toastr.success('New PO ' + sucess_msg + ' successfuly');


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});
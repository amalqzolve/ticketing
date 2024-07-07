
$(document).on('click', '#invoice_submit', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();
    mmethod = $('#method').val();
    sup_code = $('#sup_code').val();
    cust_group = $('#cust_group').val();
    cust_type = $('#cust_type').val();
    cust_category = $('#cust_category').val();
    cust_name = $('#cust_name').val();
    cust_country = $('#cust_country').val();

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

    $("input[name^='discount_type_amount[]']").each(function (input) {
        rdiscount.push($(this).val());
    });


    var row_total = [];

    $("input[name^='row_total[]']").each(function (input) {
        row_total.push($(this).val());
    });

    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning('Supplier Name is Required.');
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }


    if ($('#currency').val() == "") {
        $('#currency').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Currency!");
        return false;
    } else {
        $('#currency').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if ($('#salesman').val() == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Sales man!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    if (mmethod == "") {
        $('#method').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Method!");
        return false;
    } else {
        $('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
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



    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "../expenditure-submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            sales_order_id: $('#sales_order_id').val(),
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

            customer: $('#customer1').val(),
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
            useadvance: $('#useadvance').val(),
            invoicenumber: $('#invoicenumber').val(),


        },
        success: function (data) {
            $('#invoice_submit').prop("disabled", false);
            toastr.success('Expenditure' + sucess_msg + ' successfuly');
            window.location.href = "../expenditure_list/" + $('#sales_order_id').val();

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




$(document.body).on("change", "#customer", function () {

    var cid = $(this).val();

    $.ajax({
        url: "getcustomeraddressquote_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var inv_address = '';
            var ship_address = '';
            var cust_phone = '';
            $.each(data, function (key, value) {

                inv_address = value.invoice_add1 + ' ' + value.invoice_add2 + ' ' + value.invoice_city + ' ' + value.invoice_country;

                ship_address = value.shipping1 + ' ' + value.shipping2 + ' ' + value.shipping_city + ' ' + value.invoice_country;

                cust_phone = value.mobile1;
                $('#cust_name').val(value.cust_name);
                $('#building_no').val(value.cust_add1);
                $('#cust_region').val(value.cust_add2);
                $('#cust_district').val(value.cust_region);
                $('#cust_city').val(value.cust_city);
                $('#cust_zip').val(value.cust_zip);
                $('#email').val(value.email1);
                $('#mobile').val(value.mobile1);
                $('#vatno').val(value.vatno);
                $('#buyerid_crno').val(value.buyerid_crno);
                $('#cust_category').val(value.cust_category).trigger('change');
                $('#cust_type').val(value.cust_type).trigger('change');
                $('#cust_group').val(value.cust_group).trigger('change');
                $('#cust_country').val(value.cust_country).trigger('change');




            });

            $('#billing_address').val(inv_address);
            $('#shipping_address').val(ship_address);
            $('#contact_phone').val(cust_phone);



        }
    })
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

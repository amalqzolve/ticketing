$(document).on('click', '#enquiry_submit', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();
    internal_reference = $('#internal_reference').val();
    cust_name = $('#cust_name').val();
    quotedate = $('#quotedate').val();
    valid_till = $('#valid_till').val();
    preparedby = $('#preparedby').val();


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
    } else {  //new customer
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
        url: "newenquirysubmit_sell",
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
        },
        success: function (data) {
            //$('#enquiry_submit').removeClass('kt-spinner');
            window.location.href = "enquiry_list";
            toastr.success('New Enquiry ' + sucess_msg + ' successfuly');
            $('#enquiry_submit').prop("disabled", false);
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







$(document).on('click', '.quotation_send', function () {
    var id = $(this).attr('id');

    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this Quotation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        /* cancelButtonText: "No"
      }).then(result => {*/
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            window.location = "Quotation-Send?id=" + id;
        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});

$(document).on('click', '.quotation_negotiation', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Negotiate this Quotation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
    }).then(result => {
        if (result.value) {

            window.location = "Quotation-Negotiation?id=" + id;
        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});

$(document).on('click', '.enquiry_approve', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Convert To Sales Quotation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
    }).then(result => {
        if (result.value) {
            window.location = "Enquiry-Approve?id=" + id;

        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});

$(document).on('click', '.quotation_rejected', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this Quotation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
    }).then(result => {
        if (result.value) {
            window.location = "Quotation-Reject?id=" + id;

        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});

$(document).on('click', '.quotation_revised', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Revise this Quotation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
    }).then(result => {
        if (result.value) {

            window.location = "Quotation-Revise?id=" + id;
        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});



$(document).on('click', '.quotation_delete', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Delete this Quotation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
    }).then(result => {
        if (result.value) {

            window.location = "Quotation-Delete?id=" + id;
        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});





$(document).on('click', '#quotation_revise', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();
    quotedate = $('#quotedate').val();
    valid_till = $('#valid_till').val();
    preparedby = $('#preparedby').val();



    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Customer!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }


    if (quotedate == "") {
        $('#quotedate').addClass('is-invalid');
        toastr.warning("Please Add Quote Date!");
        return false;
    } else {
        $('#quotedate').removeClass('is-invalid');
    }

    if (valid_till == "") {
        $('#valid_till').addClass('is-invalid');
        toastr.warning("Please Add Valid Till!");
        return false;
    } else {
        $('#valid_till').removeClass('is-invalid');
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
        url: "sellquotationrevise",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            quote_id: $('#id').val(),
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


            //$('#quotation_revise').removeClass('kt-spinner');

            window.location.href = "quotation_list";
            toastr.success('Quotation revised successfuly');
            $('#quotation_revise').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});





$(document).on('click', '#enquiry_approve', function (e) {
    e.preventDefault();

    salesman = $('#salesman').val();
    cust_name = $('#cust_name').val();
    podate = $('#podate').val();
    quotedate = $('#quotedate').val();
    valid_till = $('#valid_till').val();
    po_ref = $('#po_ref').val();
    preparedby = $('#preparedby').val();

    if (podate == "") {
        $('#podate').addClass('is-invalid');
        toastr.warning("Please Add SO Date!");
        return false;
    } else {
        $('#podate').removeClass('is-invalid');
    }
    /*      if (po_ref == "") {
              $('#po_ref').addClass('is-invalid');
              toastr.warning("Please Add Po Reference!");
              return false;
          } else {
               $('#po_ref').removeClass('is-invalid');
           }*/
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
    if (preparedby == "") {
        $('#preparedby').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Psrepared by!");
        return false;

    } else {
        $('#preparedby').next().find('.select2-selection').removeClass('select-dropdown-error');
    }




    if (quotedate == "") {
        $('#quotedate').addClass('is-invalid');
        toastr.warning("Please Add Quote Date!");
        return false;
    } else {
        $('#quotedate').removeClass('is-invalid');
    }


    if (valid_till == "") {
        $('#valid_till').addClass('is-invalid');
        toastr.warning("Please Add Quotation Validity!");
        return false;
    } else {
        $('#valid_till').removeClass('is-invalid');
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
        url: "sellenquiryapprove",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            quote_id: $('#id').val(),
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
            terms_conditions: $('#terms_conditions').val(),
            quotedate: $('#quotedate').val(),
            valid_till: $('#valid_till').val(),
            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),
            podate: $("#podate").val(),

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
            document: $('#fileData').val(),
            internal_reference: $('#internal_reference').val()


        },
        success: function (data) {



            // $('#enquiry_approve').removeClass('kt-spinner');

            window.location.href = "quotation_list";
            toastr.success('Quotation Generated Successfuly');
            $('#enquiry_approve').prop("disabled", false);


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
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

                $('#cust_name').val(value.cust_name).attr('readonly', true);
                $('#building_no').val(value.cust_add1).attr('readonly', true);
                $('#cust_region').val(value.cust_add2).attr('readonly', true);
                $('#cust_district').val(value.cust_region).attr('readonly', true);
                $('#cust_city').val(value.cust_city).attr('readonly', true);
                $('#cust_zip').val(value.cust_zip).attr('readonly', true);
                $('#email').val(value.email1).attr('readonly', true);
                $('#mobile').val(value.mobile1).attr('readonly', true);
                $('#vatno').val(value.vatno).attr('readonly', true);
                $('#buyerid_crno').val(value.buyerid_crno).attr('readonly', true);
                $('#cust_category').val(value.cust_category).trigger('change');
                $('#cust_type').val(value.cust_type).trigger('change');
                $('#cust_group').val(value.cust_group).trigger('change');
                $('#cust_country').val(value.cust_country).trigger('change').attr('disabled', true);




            });

            $('#billing_address').val(inv_address);
            $('#shipping_address').val(ship_address);
            $('#contact_phone').val(cust_phone);



        }
    })
});
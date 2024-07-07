$(document).on('click', '#dpo_submit', function (e) {
    e.preventDefault();

    if ($('#supplier_source').val() == 1) {// New Customer
        if ($('#sup_name').val() == "") {
            $('#sup_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier name!");
            return false;
        } else {
            $('#sup_name').removeClass('is-invalid');
        }
    } else
        if ($('#supplier_source').val() == 2) {  // from DB
            if ($('#supplier').val() == "") {
                $('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
                toastr.warning("Please Select Supplier!");
                return false;
            } else {
                $('#supplier').next().find('.select2-selection').removeClass('select-dropdown-error');
            }
        }

    var productname = [];
    $("input[name^='item_details_id[]']").each(function (input) {
        productname.push($(this).val());
    });

    var product_description = [];
    $("textarea[name^='product_description[]']").each(function (input) {
        product_description.push($(this).val());
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
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    $('#dpo_submit').addClass('kt-spinner');
    $('#dpo_submit').prop("disabled", true);
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
            $('#dpo_submit').removeClass('kt-spinner');
            $('#dpo_submit').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#dpo_submit').addClass('kt-spinner');
        $('#dpo_submit').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "newposubmit_qpurchase",
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
                discount_type: $('#discount_type').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),
                supplier: $('#supplier').val(),
                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),

                // 
                supplier_source: $('#supplier_source').val(),
                supplier: $('#supplier').val(),
                sup_category: $('#sup_category').val(),
                sup_group: $('#sup_group').val(),
                sup_type: $('#sup_type').val(),
                sup_name: $('#sup_name').val(),
                building_no: $('#building_no').val(),
                sup_region: $('#sup_region').val(),
                sup_district: $('#sup_district').val(),
                sup_city: $('#sup_city').val(),
                sup_country: $('#sup_country').val(),
                sup_zip: $('#sup_zip').val(),
                mobile: $('#mobile').val(),
                vatno: $('#vatno').val(),
                buyerid_crno: $('#buyerid_crno').val(),
                // 

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
                status: status
            },
            success: function (data) {
                $('#dpo_submit').removeClass('kt-spinner');
                $('#dpo_submit').prop("disabled", false);
                window.location.href = "qpurchase_order";
                toastr.success('New PO Saved successfuly');
            },
            error: function (jqXhr, json, errorThrown) {
                $('#dpo_submit').removeClass('kt-spinner');
                $('#dpo_submit').prop("disabled", false);
                toastr.error('Error While SAve');
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
$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
        url: "gettermsqpurchase",
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

$(document).on('click', '#enquiry_po_update_edit', function (e) {
    e.preventDefault();

    customer = $('#customer').val();
    reference = $('#reference').val();
    attention = $('#attention').val();
    salesman = $('#salesman').val();
    rfqdate = $('#rfqdate').val();
    validity = $('#validity').val();
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

    var productname = [];

    $("input[name^='item_details_id[]']")
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

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    var ttotal = 0;
    $.each(row_total, function () {
        ttotal += parseInt(this, 10);
    });


    if (productname.length > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any Product!");
        return false;
    }

    $('#enquiry_po_update_edit').addClass('kt-spinner');
    $('#enquiry_po_update_edit').prop("disabled", true);
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
            $('#enquiry_po_update_edit').removeClass('kt-spinner');
            $('#enquiry_po_update_edit').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#enquiry_po_update_edit').addClass('kt-spinner');
        $('#enquiry_po_update_edit').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";

        $.ajax({
            type: "POST",
            url: "qpurchase_order_update",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
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
                supplier: $('#suppliernames').val(),
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
                status: status

            },
            success: function (data) {
                $('#enquiry_po_update_edit').removeClass('kt-spinner');
                $('#enquiry_po_update_edit').prop("disabled", false);
                window.location.href = "qpurchase_order";
                toastr.success('PO Updated successfuly');
            },
            error: function (jqXhr, json, errorThrown) {
                $('#enquiry_po_update_edit').removeClass('kt-spinner');
                $('#enquiry_po_update_edit').prop("disabled", false);
                toastr.error('Error While Update');
            }
        });
    }
});




$(document).on('click', '#enquiry_po_update_issue', function (e) {
    e.preventDefault();

    customer = $('#customer').val();
    reference = $('#reference').val();
    attention = $('#attention').val();
    salesman = $('#salesman').val();
    rfqdate = $('#rfqdate').val();
    validity = $('#validity').val();
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


    /*   if (cust_name == "") {
           $('#cust_name').addClass('is-invalid');
           toastr.warning("Please Add Supplier/Vendor!");
           return false;
       } else {
            $('#cust_name').removeClass('is-invalid');
        }*/

    var productname = [];

    $("input[name^='item_details_id[]']")
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

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    var ttotal = 0;
    $.each(row_total, function () {
        ttotal += parseInt(this, 10);
    });


    if (productname.length > 0) {
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
        url: "qpurchase_order_issue_submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
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
            supplier: $('#suppliernames').val(),
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


            $('#enquiry_po_update_issue').removeClass('kt-spinner');
            $('#enquiry_po_update_issue').prop("disabled", false);

            window.location.href = "qpurchase_order";
            toastr.success('PO Issued successfuly');



        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});

$(document).on('click', '#grn_update_edit', function (e) {
    e.preventDefault();

    customer = $('#customer').val();
    reference = $('#reference').val();
    attention = $('#attention').val();
    salesman = $('#salesman').val();
    quotedate = $('#quotedate').val();
    validity = $('#validity').val();
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
        toastr.warning("Please Add Supplier/Vendor!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }

    var rid = [];

    $("input[name^='rid[]']")
        .each(function (input) {
            rid.push($(this).val());
        });
    var productname = [];

    $("input[name^='item_details_id[]']")
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

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function (input) {
            quantity.push($(this).val());
        });

    var grn_quantity = [];

    $("input[name^='grn_quantity[]']")
        .each(function (input) {
            grn_quantity.push($(this).val());
        });

    var oquantity = [];

    $("input[name^='oquantity[]']")
        .each(function (input) {
            oquantity.push($(this).val());
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

    var itemcost_details = [];

    $("select[name^='itemcost_details[]']")
        .each(function (input) {
            itemcost_details.push($(this).val());
        });

    var costrate = [];

    $("input[name^='costrate[]']")
        .each(function (input) {
            costrate.push($(this).val());
        });

    var costtax_group = [];

    $("select[name^='costtax_group[]']")
        .each(function (input) {
            costtax_group.push($(this).val());
        });

    var costtax_amount = [];

    $("input[name^='costtax_amount[]']")
        .each(function (input) {
            costtax_amount.push($(this).val());
        });

    var costtax_notes = [];

    $("input[name^='costtax_notes[]']")
        .each(function (input) {
            costtax_notes.push($(this).val());
        });

    var costsupplier = [];

    $("input[name^='costsupplier[]']")
        .each(function (input) {
            costsupplier.push($(this).val());
        });




    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
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


    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "grnsubmit_qpurchase",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            po_id: $('#id').val(),
            quotedate: $('#quotedate').val(),
            validity: $('#validity').val(),
            qtnref: $('#qtnref').val(),
            attention: $('#attention').val(),
            salesman: $('#salesman').val(),
            currency: $('#currency').val(),
            currencyvalue: $('#currency_value').val(),
            preparedby: $('#preparedby').val(),
            approvedby: $('#approvedby').val(),
            po_wo_ref: $('#po_wo_ref').val(),
            purchaser: $('#purchaser').val(),
            po_ref_number: $('#po_ref_number').val(),
            purchasebillid: $('#purchasebillid').val(),
            purchasemethod: $('#purchasemethod').val(),
            internalreference: $('#internalreference').val(),
            terms: $('#terms').val(),
            notes: $('#notes').val(),
            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),
            name: $('#suppliernames').val(),
            tpreview: tinymce.get("kt-tinymce-4").getContent(),

            rid: rid,
            productname: productname,
            product_description: product_description,
            unit: unit,
            quantity: quantity,
            grn_quantity: grn_quantity,
            oquantity: oquantity,
            rate: rate,
            amount: amount,
            vatamount: vatamount,
            rdiscount: rdiscount,
            vat_percentage: vat_percentage,
            row_total: row_total,

            itemcost_details: itemcost_details,
            costrate: costrate,
            costtax_group: costtax_group,
            costtax_amount: costtax_amount,
            costtax_notes: costtax_notes,
            costsupplier: costsupplier,

        },
        success: function (data) {


            $('#grn_update_edit').removeClass('kt-spinner');
            $('#grn_update_edit').prop("disabled", false);

            window.location.href = "qpurchasegrn";
            toastr.success('New GRN ' + sucess_msg + ' successfuly');



        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});

$(document).on('click', '#pi_update_edit', function (e) {
    e.preventDefault();
    customer = $('#customer').val();
    reference = $('#reference').val();
    attention = $('#attention').val();
    salesman = $('#salesman').val();
    quotedate = $('#quotedate').val();
    validity = $('#validity').val();
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
    var error = 0;
    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    var rowcount = ($("#product_table > tbody > tr").length) + 1;
    for (let index = 1; index < rowcount; index++) {
        var quantity = $('#quantity' + index + '').val();
        var remainQty = $('#pi_remaining_quantity' + index + '').val();
        if (parseInt(remainQty) < parseInt(quantity)) {
            $('#quantity' + index + '').addClass('is-invalid');
            error++;
        } else
            $('#quantity' + index + '').removeClass('is-invalid');
    }
    if (error) {
        toastr.warning("Please Remove validation Errror!");
        return false;
    }
    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Supplier/Vendor!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }
    var rid = [];

    $("input[name^='rid[]']").each(function (input) {
        rid.push($(this).val());
    });

    var item_details_id = [];
    $("input[name^='item_details_id[]']").each(function (input) {
        item_details_id.push($(this).val());
    });
    var productname = [];
    $("input[name^='productname[]']").each(function (input) {
        productname.push($(this).val());
    });

    var save_as = [];
    $("select[name^='save_as[]']").each(function (input) {
        save_as.push($(this).val());
    });


    var product_description = [];

    $("textarea[name^='product_description[]']").each(function (input) {
        product_description.push($(this).val());
    });

    var unit = [];

    $("select[name^='unit[]']").each(function (input) {
        unit.push($(this).val());
    });

    var quantity = [];

    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
    });

    var pi_quantity = [];

    $("input[name^='pi_quantity[]']").each(function (input) {
        pi_quantity.push($(this).val());
    });

    var oquantity = [];

    $("input[name^='oquantity[]']").each(function (input) {
        oquantity.push($(this).val());
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

    var itemcost_details = [];

    $("input[name^='itemcost_details[]']").each(function (input) {
        itemcost_details.push($(this).val());
    });

    var costrate = [];

    $("input[name^='costrate[]']").each(function (input) {
        costrate.push($(this).val());
    });

    var costtax_group = [];

    $("select[name^='costtax_group[]']").each(function (input) {
        costtax_group.push($(this).val());
    });

    var costtax_amount = [];

    $("input[name^='costtax_amount[]']").each(function (input) {
        costtax_amount.push($(this).val());
    });

    var costtax_notes = [];

    $("input[name^='costtax_notes[]']").each(function (input) {
        costtax_notes.push($(this).val());
    });

    var costsupplier = [];

    $("input[name^='costsupplier[]']").each(function (input) {
        costsupplier.push($(this).val());
    });




    var type = [];
    $("select[name^='type[]']").each(function (input) {
        type.push($(this).val());
    });

    var debitaccount = [];
    $("select[name^='debitaccount[]']").each(function (input) {
        debitaccount.push($(this).val());
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
            saveDetails(result)
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            saveDetails(result)
        } else {
            $('#pi_update_edit').removeClass('kt-spinner');
            $('#pi_update_edit').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#pi_update_edit').addClass('kt-spinner');
        $('#pi_update_edit').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";

        $.ajax({
            type: "POST",
            url: "pisubmit_qpurchase",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                po_id: $('#id').val(),
                quotedate: $('#quotedate').val(),
                validity: $('#validity').val(),
                qtnref: $('#qtnref').val(),
                attention: $('#attention').val(),
                salesman: $('#salesman').val(),
                currency: $('#currency').val(),
                currencyvalue: $('#currency_value').val(),
                preparedby: $('#preparedby').val(),
                approvedby: $('#approvedby').val(),
                po_wo_ref: $('#po_wo_ref').val(),
                purchaser: $('#purchaser').val(),
                po_ref_number: $('#po_ref_number').val(),
                purchasebillid: $('#purchasebillid').val(),
                purchasemethod: $('#purchasemethod').val(),
                internalreference: $('#internalreference').val(),
                bill_entry_date: $('#bill_entry_date').val(),
                terms: $('#terms').val(),
                notes: $('#notes').val(),
                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),
                name: $('#suppliernames').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                status: status,

                // paid_by_bank: $('#paid_by_bank').val(),
                // paid_by_card: $('#paid_by_card').val(),
                // paid_by_cash: $('#paid_by_cash').val(),
                // useadvance: $('#useadvance').val(),
                // paid_from_adwance: $('#paid_from_adwance').val(),
                // paid_amount: $('#paidamount').val(),
                // balance_amount: $('#balanceamount').val(),

                mark_payments: ($("#markPayments").prop('checked') == true) ? 1 : 0,
                use_advance: ($("#use_advance").prop('checked') == true) ? 1 : 0,

                advance_amt: $('#advance_amt').val(),
                type: type,
                debitaccount: debitaccount,
                reference: reference,
                pay_amount: pay_amount,

                paid_amount: $('#paidamount').val(),
                balance_amount: $('#balanceamount').val(),

                job_id: $('#job_id').val(),
                discount_type: $('#discount_type').val(),

                rid: rid,
                productname: productname,
                save_as: save_as,
                item_details_id: item_details_id,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                pi_quantity: pi_quantity,
                oquantity: oquantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                rdiscount: rdiscount,
                vat_percentage: vat_percentage,
                row_total: row_total,


                itemcost_details: itemcost_details,
                costrate: costrate,
                costtax_group: costtax_group,
                costtax_amount: costtax_amount,
                costtax_notes: costtax_notes,
                costsupplier: costsupplier,


            },
            success: function (data) {
                $('#pi_update_edit').removeClass('kt-spinner');
                $('#pi_update_edit').prop("disabled", false);
                window.location.href = "qpurchaseinvoice";
                toastr.success('Purchase Invoice ' + sucess_msg + ' successfuly');
            },
            error: function (jqXhr, json, errorThrown) {
                $('#pi_update_edit').removeClass('kt-spinner');
                $('#pi_update_edit').prop("disabled", false);
                toastr.error('Error While Save Details');
            }
        });
    }
});
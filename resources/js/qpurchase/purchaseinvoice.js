$(document).on('click', '#pi_submit', function (e) {
    e.preventDefault();

    if ($('#salesman').val() == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

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
    var save_as_old = [];
    $("input[name^='save_as_old[]']").each(function (input) {
        save_as_old.push($(this).val());
    });
    var quantity_old = [];
    $("input[name^='quantity_old[]']").each(function (input) {
        quantity_old.push($(this).val());
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
            $('#pi_submit').removeClass('kt-spinner');
            $('#pi_submit').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#pi_submit').addClass('kt-spinner');
        $('#pi_submit').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "purchaseinvoicesubmit",
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
                tpreview: tinymce.get("kt-tinymce-4").getContent(),
                bill_entry_date: $('#bill_entry_date').val(),
                rid: rid,
                item_details_id: item_details_id,
                productname: productname,
                save_as_old: save_as_old,
                quantity_old: quantity_old,
                save_as: save_as,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                rdiscount: rdiscount,
                vat_percentage: vat_percentage,
                row_total: row_total,
                status: status, //Draft /Approved


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

                // paid_by_bank: $('#paid_by_bank').val(),
                // paid_by_card: $('#paid_by_card').val(),
                // paid_by_cash: $('#paid_by_cash').val(),
                // useadvance: $('#useadvance').val(),
                // paid_from_adwance: $('#paid_from_adwance').val(),


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


                itemcost_details: itemcost_details,
                costrate: costrate,
                costtax_group: costtax_group,
                costtax_amount: costtax_amount,
                costtax_notes: costtax_notes,
                costsupplier: costsupplier,

            },
            success: function (data) {
                $('#pi_submit').removeClass('kt-spinner');
                $('#pi_submit').prop("disabled", false);
                window.location.href = "qpurchaseinvoice";
                toastr.success('Purchase Invoice Saved successfuly');
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
                toastr.error('Error While Save');
                $('#pi_submit').removeClass('kt-spinner');
                $('#pi_submit').prop("disabled", false);
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

$(document).on('click', '#pi_update', function (e) {
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

    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
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
    var new_product_id = [];
    $("input[name^='new_product_id[]']").each(function (input) {
        new_product_id.push($(this).val());
    });
    var product_transaction_id = [];
    $("input[name^='product_transaction_id[]']").each(function (input) {
        product_transaction_id.push($(this).val());
    });
    var save_as = [];
    $("select[name^='save_as[]']").each(function (input) {
        save_as.push($(this).val());
    });

    var save_as_old = [];
    $("input[name^='save_as_old[]']").each(function (input) {
        save_as_old.push($(this).val());
    });

    var quantity_old = [];
    $("input[name^='quantity_old[]']").each(function (input) {
        quantity_old.push($(this).val());
    });
    var productname = [];
    $("input[name^='productname[]']").each(function (input) {
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
            $('#pi_update').removeClass('kt-spinner');
            $('#pi_update').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#pi_update').addClass('kt-spinner');
        $('#pi_update').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "purchaseinvoiceupdate",
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
                name: $('#customer1').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),
                bill_entry_date: $('#bill_entry_date').val(),
                job_id: $('#job_id').val(),
                discount_type: $('#discount_type').val(),
                rid: rid,
                item_details_id: item_details_id,
                productname: productname,
                new_product_id: new_product_id,
                product_transaction_id: product_transaction_id,
                save_as_old: save_as_old,
                quantity_old: quantity_old,
                save_as: save_as,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                rdiscount: rdiscount,
                vat_percentage: vat_percentage,
                row_total: row_total,
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

                itemcost_details: itemcost_details,
                costrate: costrate,
                costtax_group: costtax_group,
                costtax_amount: costtax_amount,
                costtax_notes: costtax_notes,
                costsupplier: costsupplier,
                piid: $('#piid').val(),

            },
            success: function (data) {
                $('#pi_update').removeClass('kt-spinner');
                $('#pi_update').prop("disabled", false);
                window.location.href = "qpurchaseinvoice";
                toastr.success('Purchase Invoice Updated successfuly');
            },
            error: function (jqXhr, json, errorThrown) {
                toastr.error('Error While Save');
                $('#pi_update').removeClass('kt-spinner');
                $('#pi_update').prop("disabled", false);
                console.log('Error !!');
            }
        });
    }
});


$(document).on('click', '#pi_updateByPO', function (e) {
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
    console.log('fff' + $('#invoice_type').val());
    var invoice_type = $('#invoice_type').val();
    if (invoice_type == 'By Po') {
        var error = 0;
        var rowcount = ($("#product_table > tbody > tr").length) + 1;
        for (let index = 1; index < rowcount; index++) {
            var quantity = $('#quantity' + index + '').val();
            var remainQty = $('#bquantity' + index + '').val();
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
    }




    if (salesman == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Salesman!");
        return false;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if (cust_name == "") {
        $('#cust_name').addClass('is-invalid');
        toastr.warning("Please Add Supplier/Vendor!");
        return false;
    } else {
        $('#cust_name').removeClass('is-invalid');
    }
    var qbuy_purchase_order_product_id = [];
    $("input[name^='qbuy_purchase_order_product_id[]']").each(function (input) {
        qbuy_purchase_order_product_id.push($(this).val());
    });
    var item_details_id = [];
    $("input[name^='item_details_id[]']").each(function (input) {
        item_details_id.push($(this).val());
    });
    var productname = [];
    $("input[name^='productname[]']").each(function (input) {
        productname.push($(this).val());
    });


    var new_product_id = [];
    $("input[name^='new_product_id[]']").each(function (input) {
        new_product_id.push($(this).val());
    });
    var product_transaction_id = [];
    $("input[name^='product_transaction_id[]']").each(function (input) {
        product_transaction_id.push($(this).val());
    });

    var save_as_old = [];
    $("input[name^='save_as_old[]']").each(function (input) {
        save_as_old.push($(this).val());
    });
    var quantity_old = [];
    $("input[name^='quantity_old[]']").each(function (input) {
        quantity_old.push($(this).val());
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

    ///ffffffffffffffffffffffff

    var error = 0;
    var rowcount = ($("#product_table > tbody > tr").length)
    for (let index = 0; index < rowcount; index++) {
        var quantity11 = $('#quantity' + index + '').val();
        var remainQty11 = $('#bquantity' + index + '').val();

        if (parseInt(remainQty11) < parseInt(quantity11)) {
            $('#quantity' + index + '').addClass('is-invalid');
            error++;
        } else
            $('#quantity' + index + '').removeClass('is-invalid');
    }
    if (error) {
        toastr.warning('Remove Validation Error');
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
            $('#pi_updateByPO').removeClass('kt-spinner');
            $('#pi_updateByPO').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#pi_updateByPO').addClass('kt-spinner');
        $('#pi_updateByPO').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "purchaseinvoiceupdate",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                invoice_type: $('#invoice_type').val(),
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
                name: $('#customer1').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),
                bill_entry_date: $('#bill_entry_date').val(),
                job_id: $('#job_id').val(),
                discount_type: $('#discount_type').val(),


                qbuy_purchase_order_product_id: qbuy_purchase_order_product_id,
                item_details_id: item_details_id,
                productname: productname,
                new_product_id: new_product_id,
                product_transaction_id: product_transaction_id,
                save_as_old: save_as_old,
                quantity_old: quantity_old,
                save_as: save_as,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                rate: rate,
                amount: amount,
                vatamount: vatamount,
                rdiscount: rdiscount,
                vat_percentage: vat_percentage,
                row_total: row_total,
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


                itemcost_details: itemcost_details,
                costrate: costrate,
                costtax_group: costtax_group,
                costtax_amount: costtax_amount,
                costtax_notes: costtax_notes,
                costsupplier: costsupplier,
                piid: $('#piid').val(),

            },
            success: function (data) {
                $('#pi_updateByPO').removeClass('kt-spinner');
                $('#pi_updateByPO').prop("disabled", false);
                window.location.href = "qpurchaseinvoice";
                toastr.success('Purchase Invoice Updated successfuly');
            },
            error: function (jqXhr, json, errorThrown) {
                toastr.error('Error While Save');
                $('#pi_updateByPO').removeClass('kt-spinner');
                $('#pi_updateByPO').prop("disabled", false);
                console.log('Error !!');
            }
        });
    }
});
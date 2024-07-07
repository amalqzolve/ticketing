

$(document).on('click', '#btnSaveFromPO', function (e) {
    e.preventDefault();

    if ($('#grn_date').val() == '') {
        $('#grn_date').addClass('is-invalid');
        toastr.warning("Please Enter GRN Date!");
        return false;
    } else
        $('#grn_date').removeClass('is-invalid');

    if ($('#preparedby').val() == "") {
        $('#preparedby').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Preparedby!");
        return false;
    } else {
        $('#preparedby').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    var purchase_order_products_id = [];
    $("input[name^='purchase_order_products_id[]']").each(function (input) {
        purchase_order_products_id.push($(this).val());
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

    var product_price = [];
    $("input[name^='product_price[]']").each(function (input) {
        product_price.push($(this).val());
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
    var ttotal = 0;
    var error = 0;
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
        ttotal += parseInt($(this).val());
        if ($(this).val() == 0) {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });

    if (error)
        toastr.warning("Please Add GRN Qty!");

    if (ttotal > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any GRN Qty!");
        return false;
    }

    error11 = 0;
    $("input[name^='balance_quantity[]']").each(function (input) {
        curVal = parseInt($(this).val());
        if (curVal < 0) {
            $(this).addClass('is-invalid');
            error11++;
        } else
            $(this).removeClass('is-invalid');
    });
    if (error11) {
        toastr.warning("Please Enter A valid Qty!");
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
            $('#btnSaveFromPO').removeClass('kt-spinner');
            $('#btnSaveFromPO').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetails(result) {
        $('#btnSaveFromPO').addClass('kt-spinner');
        $('#btnSaveFromPO').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "grn-save-from-po",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                po_id: $('#po_id').val(),
                inv_id: $('#inv_id').val(),
                supplier_id: $('#supplier_id').val(),
                source: $('#source').val(),
                grn_date: $('#grn_date').val(),
                attention: $('#attention').val(),
                vehicle: $('#vehicle').val(),
                driver: $('#driver').val(),
                preparedby: $('#preparedby').val(),
                deliverynote: $('#deliverynote').val(),
                terms: $('#terms').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                purchase_order_products_id: purchase_order_products_id,
                item_details_id: item_details_id,
                productname: productname,
                save_as: save_as,
                product_price: product_price,
                product_description: product_description,
                unit: unit,
                quantity: quantity,

                status: status
            },
            success: function (data) {
                $('#btnSaveFromPO').removeClass('kt-spinner');
                $('#btnSaveFromPO').prop("disabled", false);
                if (data.status == 1) {
                    toastr.success('Purchase GRN Saved successfuly');
                    window.location.href = "qpurchasegrn";
                } else
                    toastr.error(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                $('#btnSaveFromPO').removeClass('kt-spinner');
                $('#btnSaveFromPO').prop("disabled", false);
                toastr.error('Error While Save');
            }
        });
    }
});



$(document).on('click', '#btnSaveFromInvoice', function (e) {
    e.preventDefault();

    if ($('#grn_date').val() == '') {
        $('#grn_date').addClass('is-invalid');
        toastr.warning("Please Enter GRN Date!");
        return false;
    } else
        $('#grn_date').removeClass('is-invalid');

    if ($('#preparedby').val() == "") {
        $('#preparedby').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Preparedby!");
        return false;
    } else {
        $('#preparedby').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    var purchase_order_products_id = [];
    $("input[name^='purchase_order_products_id[]']").each(function (input) {
        purchase_order_products_id.push($(this).val());
    });
    var purchase_invoice_products_id = [];
    $("input[name^='purchase_invoice_products_id[]']").each(function (input) {
        purchase_invoice_products_id.push($(this).val());
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


    var product_price = [];
    $("input[name^='product_price[]']").each(function (input) {
        product_price.push($(this).val());
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
    var ttotal = 0;
    var error = 0;
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
        ttotal += parseInt($(this).val());
        if ($(this).val() == 0) {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });

    if (error)
        toastr.warning("Please Add GRN Qty!");

    if (ttotal > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any GRN Qty!");
        return false;
    }

    error11 = 0;
    $("input[name^='balance_quantity[]']").each(function (input) {
        curVal = parseInt($(this).val());
        if (curVal < 0) {
            $(this).addClass('is-invalid');
            error11++;
        } else
            $(this).removeClass('is-invalid');
    });
    if (error11) {
        toastr.warning("Please Enter A valid Qty!");
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
            saveDetailsFromInvoice(result)
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            saveDetailsFromInvoice(result)
        } else {
            $('#btnSaveFromInvoice').removeClass('kt-spinner');
            $('#btnSaveFromInvoice').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function saveDetailsFromInvoice(result) {
        $('#btnSaveFromInvoice').addClass('kt-spinner');
        $('#btnSaveFromInvoice').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "grn-save-from-invoice",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                po_id: $('#po_id').val(),
                inv_id: $('#inv_id').val(),
                supplier_id: $('#supplier_id').val(),
                source: $('#source').val(),
                grn_date: $('#grn_date').val(),
                attention: $('#attention').val(),
                vehicle: $('#vehicle').val(),
                driver: $('#driver').val(),
                preparedby: $('#preparedby').val(),
                deliverynote: $('#deliverynote').val(),
                terms: $('#terms').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                purchase_order_products_id: purchase_order_products_id,
                purchase_invoice_products_id: purchase_invoice_products_id,
                item_details_id: item_details_id,
                productname: productname,
                save_as: save_as,
                product_price: product_price,
                product_description: product_description,
                unit: unit,
                quantity: quantity,

                status: status
            },
            success: function (data) {
                $('#btnSaveFromInvoice').removeClass('kt-spinner');
                $('#btnSaveFromInvoice').prop("disabled", false);
                if (data.status == 1) {
                    toastr.success('Purchase GRN Saved successfuly');
                    window.location.href = "qpurchasegrn";
                } else
                    toastr.error(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                $('#btnSaveFromInvoice').removeClass('kt-spinner');
                $('#btnSaveFromInvoice').prop("disabled", false);
                toastr.error('Error While Save');
            }
        });
    }
});



$(document).on('click', '#btnUpdate', function (e) {
    e.preventDefault();

    if ($('#grn_date').val() == '') {
        $('#grn_date').addClass('is-invalid');
        toastr.warning("Please Enter GRN Date!");
        return false;
    } else
        $('#grn_date').removeClass('is-invalid');

    if ($('#preparedby').val() == "") {
        $('#preparedby').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Preparedby!");
        return false;
    } else {
        $('#preparedby').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    var purchase_order_products_id = [];
    $("input[name^='purchase_order_products_id[]']").each(function (input) {
        purchase_order_products_id.push($(this).val());
    });
    var purchase_invoice_products_id = [];
    $("input[name^='purchase_invoice_products_id[]']").each(function (input) {
        purchase_invoice_products_id.push($(this).val());
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

    var quantity_old = [];
    $("input[name^='quantity_old[]']").each(function (input) {
        quantity_old.push($(this).val());
    });

    var save_as_old = [];
    $("input[name^='save_as_old[]']").each(function (input) {
        save_as_old.push($(this).val());
    });

    var save_as = [];
    $("select[name^='save_as[]']").each(function (input) {
        save_as.push($(this).val());
    });

    var product_price = [];
    $("input[name^='product_price[]']").each(function (input) {
        product_price.push($(this).val());
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
    var ttotal = 0;
    var error = 0;
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
        ttotal += parseInt($(this).val());
        if ($(this).val() == 0) {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });

    if (error)
        toastr.warning("Please Add GRN Qty!");


    if (ttotal > 0) {
        // the array is defined and has at least one element
    } else {
        toastr.warning("Please Add Any GRN Qty!");
        return false;
    }


    error11 = 0;
    $("input[name^='balance_quantity[]']").each(function (input) {
        curVal = parseInt($(this).val());
        if (curVal < 0) {
            $(this).addClass('is-invalid');
            error11++;
        } else
            $(this).removeClass('is-invalid');
    });
    if (error11) {
        toastr.warning("Please Enter A valid Qty!");
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
            updateDetails(result)
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            updateDetails(result)
        } else {
            $('#btnUpdate').removeClass('kt-spinner');
            $('#btnUpdate').prop("disabled", false);
            swal.fire("Cancelled", "", "error");
        }
    });

    function updateDetails(result) {
        $('#btnUpdate').addClass('kt-spinner');
        $('#btnUpdate').prop("disabled", true);
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $.ajax({
            type: "POST",
            url: "qpurchasegrn-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                po_id: $('#po_id').val(),
                inv_id: $('#inv_id').val(),
                supplier_id: $('#supplier_id').val(),
                source: $('#source').val(),
                grn_date: $('#grn_date').val(),
                attention: $('#attention').val(),
                vehicle: $('#vehicle').val(),
                driver: $('#driver').val(),
                preparedby: $('#preparedby').val(),
                deliverynote: $('#deliverynote').val(),
                terms: $('#terms').val(),
                tpreview: tinymce.get("kt-tinymce-4").getContent(),

                purchase_order_products_id: purchase_order_products_id,
                purchase_invoice_products_id: purchase_invoice_products_id,
                item_details_id: item_details_id,
                new_product_id: new_product_id,
                product_transaction_id: product_transaction_id,
                quantity_old: quantity_old,
                save_as_old: save_as_old,
                save_as: save_as,
                product_price: product_price,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,

                status: status
            },
            success: function (data) {
                $('#btnUpdate').removeClass('kt-spinner');
                $('#btnUpdate').prop("disabled", false);
                if (data.status == 1) {
                    toastr.success('Purchase GRN Saved successfuly');
                    window.location.href = "qpurchasegrn";
                } else
                    toastr.error(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                $('#btnUpdate').removeClass('kt-spinner');
                $('#btnUpdate').prop("disabled", false);
                toastr.error('Error While Save');
            }
        });
    }
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

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
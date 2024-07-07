$('.car-in-and-out').addClass('kt-menu__item--active');

$(document).on('click', '#performainvoice_submit', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#salesman').val() == "") {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Salesman!");
        error++;
    } else {
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if ($('#method').val() == "") {
        $('#method').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add Any Method!");
        error++;
    } else {
        $('#method').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if ($('#quotedate').val() == "") {
        $('#quotedate').addClass('is-invalid');
        error++;
    } else
        $('#quotedate').removeClass('is-invalid');


    if ($('#amount').val() == "") {
        $('#amount').addClass('is-invalid');
        error++;
    } else
        $('#amount').removeClass('is-invalid');

    if ($('#valid_till').val() == "") {
        $('#valid_till').addClass('is-invalid');
        error++;
    } else
        $('#valid_till').removeClass('is-invalid');

    if ($('#vat_percentage').val() == "") {
        $('#vat_percentage').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add vat Percentage !");
        error++;
    } else {
        $('#vat_percentage').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if ($('#additional_vat_percentage').val() == "") {
        $('#additional_vat_percentage').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Add vat Percentage !");
        error++;
    } else {
        $('#additional_vat_percentage').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    $("select[name^='additional_cost_vat[]']").each(function (input) {
        if ($(this).val() == "") {
            $(this).next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add vat Percentage !");
            error++;
        } else {
            $(this).next().find('.select2-selection').removeClass('select-dropdown-error');
        }
    });
    var balanced_amount = $('#balanced_amount').val();
    var amount = $('#amount').val();
    if (balanced_amount < amount) {
        $('#balanced_amount').addClass('is-invalid');
        $('#amount').addClass('is-invalid');
        error++;
        toastr.warning("Amount Must be smaller than Balance Amount !");
    } else {
        $('#balanced_amount').removeClass('is-invalid');
        $('#amount').removeClass('is-invalid');
    }

    var additional_balanced_amount = $('#additional_amount').val();
    var additional_amount = $('#additional_amount').val();
    if (additional_balanced_amount < additional_amount) {
        $('#additional_balanced_amount').addClass('is-invalid');
        $('#additional_amount').addClass('is-invalid');
        error++;
        toastr.warning("Amount Must be smaller than Balance Amount !");
    } else {
        $('#additional_balanced_amount').removeClass('is-invalid');
        $('#additional_amount').removeClass('is-invalid');
    }

    if (!error) {
        // if (1) {
        $('#performainvoice_submit').addClass('kt-spinner');
        $('#performainvoice_submit').prop("disabled", true);


        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }

        $.ajax({
            type: "POST",
            url: "../trip-proforma-invoice-submit",
            dataType: "json",
            data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#performainvoice_submit').removeClass('kt-spinner');
                    $('#performainvoice_submit').prop("disabled", false);
                    toastr.success('Proforma Invoice ' + sucess_msg + ' Successfuly');
                    window.location.href = "../trip-proforma-invoice/" + data.key;
                }
                else {
                    $('#performainvoice_submit').removeClass('kt-spinner');
                    $('#performainvoice_submit').prop("disabled", false);
                    toastr.error(data.msg);

                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('validation Error');

});



$('body').on('keypress keyup blur', '.integerValDiscount', function (e) {
    $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
    if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
    if (($(this).val() > 100) && ($('#discount_type').val() != 1)) {
        toastr.error('maximum 100');
        $(this).val(100);
        e.preventDefault();
    }
});


$(".vatamount").prop("readonly", true);

$(document.body).on("change", "#currency", function () {
    var cid = $(this).val();
    $.ajax({
        url: "../../getcurrency_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            $.each(data, function (key, value) {
                cvalue = value.value;
            });
            cvalue = getNum(cvalue);
            $('#currencyvalue').val(cvalue);
        }
    })
});

$(document.body).on("change", "#terms_conditions", function () {
    var cid = $(this).val();
    $.ajax({
        url: "../../get-terms-from-id",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
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

var product_list_table = $('#productdetails_list').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    dom: 'Blfrtip',
    columnDefs: [
        {
            "defaultContent": "-",
            "targets": "_all"
        }
    ],
    ajax: {
        "url": '../trip-additional-cost/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val();
            data.car_in_out_id = $('#car_in_out_id').val();
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'remarks', name: 'remarks', render: function (data, type, row) {
                var curData = row.remarks;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'amount', name: 'amount' },
    ]
});

$('#productdetails_list tbody').on('click', 'tr', function () {
    $(this).toggleClass('selected');

    $('#selected_items').val(product_list_table.rows('.selected').data().length);

    var versement_each = 0;
    selectArr = new Array();
    var ids = $.map(product_list_table.rows('.selected').data(), function (item) {
        versement_each += parseFloat(item.amount) || 0;

        var idx = $.inArray(item.product_id, selectArr);
        if (idx == -1) {
            selectArr.push(item.product_id);
        } else {
            selectArr.splice(idx, item.product_id);
        }
        //



    });


    $('#selected_amount').val(versement_each.toFixed(2));
});

$(document.body).on("keyup", ".valChanged", function () {
    calculation();
});

$(document.body).on("change", ".selectChanged", function () {
    calculation();
});



$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');
    $("#additionalTable tbody tr td").removeClass("selected");
    if ($('#additionalTable tbody tr').length == 1) {
        $('input[name="amount[]"]').val('');
        $('input[name="remarks[]"]').val('');
    } else {
        var siblings = row.siblings();
        row.remove();
        siblings.each(function (index) {
            $(this).children().first().text(index + 1);
        });
    }
    calculation();
});




function calculation() {
    var grandTotalAmountBeforeTax = 0;
    var grandDiscount = 0;
    var grandAmountAfterDiscount = 0;
    var grandVATAmount = 0;
    var grandTotalAmount = 0;

    $("#product_table tbody tr").each(function () {

        var vat = 0;
        var amount = 0;
        var discount = 0;
        var vat_amount = 0;
        var total_amount = 0;
        $(this).children('td').each(function (index, td) {
            $(this).find("select").each(function () {
                var val = 0;
                if ($(this).val() != '')
                    val = $(this).val();
                vat = parseFloat(val);
            });

            $(this).find("input").each(function () {
                var attrValue = $(this).attr('data-id');
                if (attrValue == 'amount') {
                    var val = 0;
                    if ($(this).val() != '')
                        val = $(this).val();
                    amount = parseFloat(val);
                    grandTotalAmountBeforeTax += amount;
                }
                if (attrValue == 'discount') {
                    var val = 0;
                    if ($(this).val() != '')
                        val = $(this).val();
                    discount = parseFloat(val);
                    grandDiscount += discount;
                }
                if (attrValue == 'vat_amount') {
                    var discountAmount = 0;
                    if ($('#discount_type').val() == 1)
                        discountAmount = discount;
                    else
                        discountAmount = amount * (discount / 100);
                    var amountAfterDiscount = amount - discountAmount;
                    vat_amount = amountAfterDiscount * (vat / 100);
                    $(this).val(vat_amount);
                    grandAmountAfterDiscount += amountAfterDiscount;
                    grandVATAmount += vat_amount;
                    total_amount = amountAfterDiscount + vat_amount;
                }
                if (attrValue == 'total_amount') {
                    $(this).val(total_amount);
                    grandTotalAmount += total_amount;
                }

            });

        });
    });

    $('#totalamount').val(grandTotalAmountBeforeTax);
    $('#discount').val(grandDiscount);
    $('#amountafterdiscount').val(grandAmountAfterDiscount.toFixed(2));
    $('#totalvatamount').val(grandVATAmount.toFixed(2));
    $('#grandtotalamount').val(grandTotalAmount.toFixed(2));
}
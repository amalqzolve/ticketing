/**
 *Datatable for product details Information
 */
$('.rfqList').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
       url: "get-terms-from-id",
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


$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');


    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });

    var vatamounts = 0;
    $('.vatamount').each(function () {
        var id = $(this).attr('data-id');
        var vatamount = $('#vatamount' + id + '').val();

        vatamounts += parseFloat(vatamount);

    });
    $('#totalvatamount').val(vatamounts.toFixed(2));


    totalamount_calculate();
    discount_calculate();
    final_calculate1();


});

$(document).on('click', '#epr_update', function (e) {
    e.preventDefault();

    var eprProductId = [];
    $("input[name^='eprProductId[]']")
        .each(function (input) {
            eprProductId.push($(this).val());
        });

    var productname = [];
    $("input[name^='productname[]']")
        .each(function (input) {
            productname.push($(this).val());
        });

    var product_description = [];

    $("textarea[name^='product_description[]']")
        .each(function (input) {
            product_description.push($(this).val());
        });

    var error = 0;
    var unit = [];

    $("select[name^='unit[]']")
        .each(function (input) {
            unit.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });

    var quantity = [];

    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
    });
    var po_assigned_qty = [];
    $("input[name^='po_assigned_qty[]']").each(function (input) {
        po_assigned_qty.push($(this).val());
    });
    var rate = [];
    $("input[name^='rate[]']")
        .each(function (input) {
            rate.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var amount = [];
    $("input[name^='amount[]']")
        .each(function (input) {
            amount.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var discountamount = [];
    $("input[name^='discountamount[]']")
        .each(function (input) {
            discountamount.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var vat_percentage = [];
    $("select[name^='vat_percentage[]']")
        .each(function (input) {
            vat_percentage.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var vatamount = [];
    $("input[name^='vatamount[]']")
        .each(function (input) {
            vatamount.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    var row_total = [];
    $("input[name^='row_total[]']")
        .each(function (input) {
            row_total.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    if ($('#request_type').val() == '') {
        error++;
        $('#request_type').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#request_type').next().find('.select2-selection').removeClass('select-dropdown-error');
    if ($('#mr_category').val() == '') {
        error++;
        $('#mr_category').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#mr_category').next().find('.select2-selection').removeClass('select-dropdown-error');
    if ($('#request_against').val() == '') {
        error++;
        $('#request_against').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#request_against').next().find('.select2-selection').removeClass('select-dropdown-error');
    var epr_id = $('#materialRequestid').val();
    var id = $('#id').val();
    var qutyChk = checkQty();
    error = error + qutyChk;
    if (error == 0) {
        $('#epr_update').addClass('kt-spinner');
        $('#epr_update').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "epr-rfq-submit-po",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                rfq_id: id,
                epr_id: epr_id,
                eprProductId: eprProductId,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                po_assigned_qty: po_assigned_qty,
                rate: rate,
                amount: amount,
                discountamount: discountamount,
                vat_percentage: vat_percentage,
                vatamount: vatamount,
                row_total: row_total,
                po_date: $('#po_date').val(),
                po_valid_till: $('#po_valid_till').val(),
                totalamount: $('#totalamount').val(),
                discount: $('#discount').val(),
                amountafterdiscount: $('#amountafterdiscount').val(),
                totalvatamount: $('#totalvatamount').val(),
                grandtotalamount: $('#grandtotalamount').val(),
                quotedate: $('#quotedate').val(),
                dateofsupply: $('#dateofsupply').val(),
                request_type: $('#request_type').val(),
                mr_category: $('#mr_category').val(),
                request_priority: $('#request_priority').val(),
                request_against: $('#request_against').val(),
                client: $('#client').val(),
                project: $('#project').val(),
                supplier: $('#supplier_vendor_name').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
            },
            success: function (data) {
                if (data.status) {
                    $('#epr_update').removeClass('kt-spinner');
                    $('#epr_update').prop("disabled", false);
                    toastr.success('EPR PO Genarated successfuly');
                    loaderClose();
                    window.location.href = "epr-po-list";
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please fill the mandetory field !!!!');
});

$('body').on('change', '.quantity', function () {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
    var id = $(this).attr('data-id');
    row_calculate(id);
    row_vatcalculate(id);
});
$('body').on('change', '.rate', function () {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
    var id = $(this).attr('data-id');
    row_vatcalculate(id);
    row_calculate(id);
    row_vatcalculate(id);
});
$('body').on('change', '.vatamount', function () {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
    var id = $(this).attr('data-id');
    row_calculate(id);
    row_vatcalculate(id);
});

$('body').on('change', '.discountamount', function () {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
    var id = $(this).attr('data-id');

    discount_calculate();
    row_vatcalculate(id);
    row_calculate(id);
});



$('body').on('change', '.vat_percentage', function () {
    var id = $(this).attr('data-id');
    row_vatcalculate(id);
    row_calculate(id);
});

function discount_calculate() {
    var totaldiscamount = 0;
    $('.discountamount').each(function () {
        var id = $(this).attr('data-id');
        var damount = $('#discountamount' + id + '').val();
        totaldiscamount += parseFloat(damount);
    });
    totaldiscamount = getNum(totaldiscamount);
    $('#discount').val(totaldiscamount);
}


function row_vatcalculate(id) {
    var vatpercentage = $('#vat_percentage' + id + '').val();
    vatpercentage = getNum(vatpercentage);
    var quantity = $('#quantity' + id + '').val();
    quantity = getNum(quantity);
    var rate = $('#rate' + id + '').val();
    rate = getNum(rate);
    var rdiscount = $('#discountamount' + id + '').val();
    rdiscount = getNum(rdiscount);
    var total = parseFloat(quantity * rate) - parseFloat(rdiscount);
    vat_amount = (vatpercentage / 100) * total;
    vat_amount = getNum(vat_amount);
    $('#vatamount' + id + '').val(vat_amount.toFixed(2));
    var vatamounts = 0;
    $('.vatamount').each(function () {
        var id = $(this).attr('data-id');
        var vatamount = $('#vatamount' + id + '').val();
        vatamounts += parseFloat(vatamount);
    });
    vatamounts = getNum(vatamounts);
    $('#totalvatamount').val(vatamounts.toFixed(2));

}

function row_calculate(id) {
    var quantity = $('#quantity' + id + '').val();
    var rate = $('#rate' + id + '').val();
    var vatamount = $('#vatamount' + id + '').val();
    var disamount = $('#discountamount' + id + '').val();
    var total = parseFloat(quantity * rate);
    var rowtotal = parseFloat(total - disamount) + parseFloat(vatamount)
    total = getNum(total);
    rowtotal = getNum(rowtotal);
    $('#amount' + id + '').val(total.toFixed(2));
    $('#row_total' + id + '').val(rowtotal.toFixed(2));
    row_vatcalculate(id);
    totalamount_calculate();
    discount_calculate();
    final_calculate1();
}

$('body').on('change', '.vatamount', function () {
    var vatamounts = 0;
    $('.vatamount').each(function () {
        var id = $(this).attr('data-id');
        var vatamount = $('#vatamount' + id + '').val();
        vatamounts += parseFloat(vatamount);
    });
    vatamounts = getNum(vatamounts);
    $('#totalvatamount').val(vatamounts.toFixed(2));
});

function totalamount_calculate() {
    var totalamount = 0;
    $('.amount').each(function () {
        var id = $(this).attr('data-id');
        var amount = $('#amount' + id + '').val();
        totalamount += parseFloat(amount);
    });
    totalamount = getNum(totalamount);
    $('#totalamount').val(totalamount.toFixed(2));
}

$('body').on('change', '.discount', function () {
    final_calculate1();
});

function final_calculate1() {
    var vatamounts = 0;
    $('.vatamount').each(function () {
        var id = $(this).attr('data-id');
        var vatamount = $('#vatamount' + id + '').val();

        vatamounts += parseFloat(vatamount);

    });
    vatamounts = getNum(vatamounts);
    $('#totalvatamount').val(vatamounts.toFixed(2));
    var amountafterdiscount = 0;
    var grandtotalamount = 0;
    var discount = $('#discount').val();
    var totalamount = $('#totalamount').val();
    var totalvatamount = $('#totalvatamount').val();

    var discountamount = $('#discount').val();
    amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
    grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
    amountafterdiscount = getNum(amountafterdiscount);
    grandtotalamount = getNum(grandtotalamount);
    $('#amountafterdiscount').val(amountafterdiscount.toFixed(2));
    $('#grandtotalamount').val(grandtotalamount.toFixed(2));
}

function getNum(val) {
    if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
        return 0;
    }
    return val;
}

$('body').on('change', '.qtyCheck', function () {
    var id = $(this).attr('data-id');
    var epr_quantity = $('#epr_quantity' + id + '').val();
    var po_assigned_qty = $('#po_assigned_qty' + id + '').val();
    var quantity = $('#quantity' + id + '').val();
    var balance = parseInt(epr_quantity) - (parseInt(po_assigned_qty) + parseInt(quantity));
    if (balance < 0) {
        $(this).addClass('is-invalid');
        $(this).val('');
        toastr.error('Please Enter a Valid Quantity !!!!');
    } else {
        $('#balanceQty' + id + '').val(balance);
        $(this).removeClass('is-invalid');
    }
});
function checkQty() {
    var id;
    var error = 0;
    var epr_quantity
    var po_assigned_qty
    var quantity
    var balance
    $("input[name^='quantity[]']")
        .each(function (input) {
            id = $(this).attr('data-id');
            epr_quantity = $('#epr_quantity' + id + '').val();
            po_assigned_qty = $('#po_assigned_qty' + id + '').val();
            quantity = $('#quantity' + id + '').val();
            balance = parseInt(epr_quantity) - (parseInt(po_assigned_qty) + parseInt(quantity));
            if (balance < 0) {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    return error;
}
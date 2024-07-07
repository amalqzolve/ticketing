/**
*Datatable for product details Information
*/
$('.procurement').addClass('kt-menu__item--open');
$('.transfer-stock-list').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
        url: "gettermsquote",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            // console.log(data);
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
    totalCalculate();
});

$(document).on('click', '#save', function (e) {
    e.preventDefault();

    var eprProductId = [];
    $("input[name^='eprProductId[]']").each(function (input) {
        eprProductId.push($(this).val());
    });

    var stock_transfer_product_id = [];
    $("input[name^='stock_transfer_product_id[]']").each(function (input) {
        stock_transfer_product_id.push($(this).val());
    });

    var quantity = [];
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
    });

    var assigned_qty = [];
    $("input[name^='assigned_qty[]']").each(function (input) {
        assigned_qty.push($(this).val());
    });


    var error = 0;
    if ($('#request_type').val() == '') {
        error++;
        $('#request_type').next().find('.select2-selection').addClass('select-dropdown-error');
    }

    var qutyChk = checkQty();
    error = error + qutyChk;
    if (error == 0) {
        $('#save').addClass('kt-spinner');
        $('#save').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "transfer-stock-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                epr_id: $('#materialRequestid').val(),
                stock_transfer_id: $('#stock_transfer_id').val(),
                eprProductId: eprProductId,
                quantity: quantity,
                stock_transfer_product_id: stock_transfer_product_id,
                assigned_qty: assigned_qty,
                transfer_date: $('#transfer_date').val(),
                delivery_terms: $('#delivery_terms').val(),
                total_qty: $('#total_qty').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#save').removeClass('kt-spinner');
                    $('#save').prop("disabled", false);
                    toastr.success('Transfer Stock Added successfuly');
                    window.location.href = "transfer-stock-list";
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});

$('body').on('change', '.qtyCheck', function () {
    var id = $(this).attr('data-id');
    var total_quantity = $('#total_quantity' + id + '').val();
    var assigned_qty = $('#assigned_qty' + id + '').val();
    var quantity = $('#quantity' + id + '').val();
    var balance = parseInt(total_quantity) - (parseInt(assigned_qty) + parseInt(quantity));
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
    var total_quantity
    var assigned_qty
    var quantity
    var balance
    $("input[name^='quantity[]']")
        .each(function (input) {
            id = $(this).attr('data-id');
            total_quantity = $('#total_quantity' + id + '').val();
            assigned_qty = $('#assigned_qty' + id + '').val();
            quantity = $('#quantity' + id + '').val();
            balance = parseInt(total_quantity) - (parseInt(assigned_qty) + parseInt(quantity));
            if (balance < 0) {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    return error;
}
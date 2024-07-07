/**
*Datatable for product details Information
*/
$('.stock-transfer-list').addClass('kt-menu__item--active');
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

    var id = $(this).attr('data-id');
    alert(id);
    var product_id = $('#eprProductId' + id).val();
    alert(product_id);
    var deleted = $('#deleted_elements').val();
    if (deleted != '')
        deleted = deleted + '~' + product_id;
    else
        deleted = product_id;
    $('#deleted_elements').val(deleted);


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

    var unit = [];

    $("input[name^='unit[]']").each(function (input) {
        unit.push($(this).val());
    });

    var quantity = [];
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());
    });

    var po_assigned_qty = [];
    $("input[name^='po_assigned_qty[]']").each(function (input) {
        po_assigned_qty.push($(this).val());
    });

    var warehouse;
    $("input[name^='warehouse_id[]']").each(function (input) {
        warehouse = $(this).val();
    });
    var error = 0;

    var qutyChk = checkQty();
    error = error + qutyChk;
    if (error == 0) {
        $('#save').addClass('kt-spinner');
        $('#save').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "stock-transfer-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                epr_id: $('#materialRequestid').val(),
                eprProductId: eprProductId,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                po_assigned_qty: po_assigned_qty,
                warehouse: warehouse,
                deleted_elements: $('#deleted_elements').val(),
                t_req_date: $('#t_req_date').val(),
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
                    toastr.success('Stock Transfer Edited successfuly');
                    loaderClose();
                    window.location.href = "stock-transfer-list";
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
    $("input[name^='quantity[]']").each(function (input) {
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

    var i = 0;
    var warehouseError = 0;
    var value = 0;
    $("input[name^='warehouse_id[]']").each(function (input) {
        id = $(this).attr('data-id');
        if (i == 0)
            value = $(this).val();
        else {
            var curValue = $(this).val();
            if (value != curValue) {
                warehouseError++;
            }
            $('#warehouse_name' + id + '').addClass('is-invalid');
        }
        i++;
    });
    if (warehouseError != 0)
        toastr.error('Please add products in same warehouse !!!!');

    return error + warehouseError;
}
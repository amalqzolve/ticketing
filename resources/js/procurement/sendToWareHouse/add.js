$('.grnList').addClass('kt-menu__item--active');

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});

$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');

    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
    totalQtyCalculate();
});
$('body').on('keyup', '.receivedQty', function () {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
});
$(document).on('click', '#save_details', function (e) {
    e.preventDefault();
    var error = 0;
    var eprPoProductId = [];
    $("input[name^='eprPoProductId[]']")
        .each(function (input) {
            eprPoProductId.push($(this).val());
        });
    var grnProductId = [];
    $("input[name^='grnProductId[]']")
        .each(function (input) {
            grnProductId.push($(this).val());
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
    $("input[name^='unit[]']")
        .each(function (input) {
            unit.push($(this).val());
        });

    var quantity = [];
    $("input[name^='receivedQty[]']")
        .each(function (input) {
            quantity.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');

        });
    var deleiverdQty = [];
    $("input[name^='deleiverdQty[]']")
        .each(function (input) {
            deleiverdQty.push($(this).val());
        });

    var epr_id = $('#materialRequestid').val();
    var po_id = $('#poId').val();
    var grn_id = $('#grnId').val();

    if ($('#transfer_type').val() == '') {
        $('#transfer_type').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#transfer_type').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#transfer_type').val() == 'Send To Warehouse') {
        if ($('#warehouses').val() == '') {
            $('#warehouses').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('select warehouses');
            error++;
        } else {
            $('#warehouses').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
    }

    var qutyChk = checkQty();
    error = error + qutyChk;
    if (error == 0) {
        $('#save_details').addClass('kt-spinner');
        $('#save_details').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "grn-send-to-ware-house-save",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                epr_id: epr_id,
                po_id: po_id,
                grn_id: grn_id,
                transfer_type: $('#transfer_type').val(),
                ware_house_id: $('#warehouses').val(),
                warehouse_transfer_date: $('#warehouse_transfer_date').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
                total_qty: $('#total_qty').val(),
                eprPoProductId: eprPoProductId,
                grnProductId: grnProductId,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                deleiverdQty: deleiverdQty
            },
            success: function (data) {
                loaderClose();
                if (data.status == 1) {
                    $('#save_details').removeClass('kt-spinner');
                    $('#save_details').prop("disabled", false);
                    toastr.success('Stock in successfuly');
                    window.location.href = "epr-po-grn-stock-in";
                } else
                    toastr.error(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});
$('body').on('change', '.receivedQty', function () {
    var id = $(this).attr('data-id');
    var totalQty = $('#totalQty' + id + '').val();
    var deleiverdQty = $('#deleiverdQty' + id + '').val();
    var receivedQty = $('#receivedQty' + id + '').val();
    var balanceQty = parseInt(totalQty) - (parseInt(deleiverdQty) + parseInt(receivedQty));//
    if (balanceQty < 0) {
        $('#receivedQty' + id + '').addClass('is-invalid');
        error++;
    } else {
        $('#balanceQty' + id + '').val(balanceQty);
        $('#receivedQty' + id + '').removeClass('is-invalid');
        totalQtyCalculate();
    }
});
function checkQty() {
    var id;
    var error = 0;
    var totalQty;
    var deleiverdQty;
    var receivedQty;
    var balanceQty;
    var atleats = 0;
    $("input[name^='receivedQty[]']")
        .each(function (input) {
            if ($(this).val() != 0)
                atleats++
            id = $(this).attr('data-id');
            totalQty = $('#totalQty' + id + '').val();
            deleiverdQty = $('#deleiverdQty' + id + '').val();
            receivedQty = $('#receivedQty' + id + '').val();
            balanceQty = parseInt(totalQty) - (parseInt(deleiverdQty) + parseInt(receivedQty));
            if (balanceQty < 0) {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    if (!atleats) {
        toastr.warning('Enter a Quantity');
        error++;
    }
    return error;
}

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


$(document.body).on("change", "#transfer_type", function () {
    var type = $(this).val();
    $('#warehouses').val('');
    if (type == 'Send To Warehouse') {
        $('#lblTo').text('Warehouse');
        $('#warehouseDiv').show();
        $('#projectDiv').hide();
    } else if ((type == 'Send To Project') || (type == 'Allocate To Project')) {
        $('#lblTo').text('Project');
        $('#warehouseDiv').hide();
        $('#projectDiv').show();
    } else {
        $('#lblTo').text('');
        $('#warehouseDiv').hide();
        $('#projectDiv').hide();
    }

});
$('.grnList').addClass('kt-menu__item--active');

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

    var id = $(this).attr('data-id');
    var product_id = $('#eprPoProductId' + id).val();
    var deleted = $('#deleted_elements').val();
    if (deleted != '')
        deleted = deleted + '~' + product_id;
    else
        deleted = product_id;
    $('#deleted_elements').val(deleted);

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

    $("select[name^='unit[]']")
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
    // alert('eprPoProductId' + eprPoProductId);
    var qutyChk = checkQty();
    error = error + qutyChk;
    if (error == 0) {
        $('#save_details').addClass('kt-spinner');
        $('#save_details').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "epr-po-grn-resubmit-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                version: $('#version').val(),
                epr_id: epr_id,
                po_id: po_id,
                eprPoProductId: eprPoProductId,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                deleiverdQty: deleiverdQty,
                deleted_elements: $('#deleted_elements').val(),
                mr_category: $('#mr_category').val(),
                supplier: $('#supplier_vendor_name').val(),
                grn_created_date: $('#grn_created_date').val(),
                grn_date: $('#grn_date').val(),
                total_qty: $('#total_qty').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
            },
            success: function (data) {
                loaderClose();
                if (data.status == 1) {
                    $('#save_details').removeClass('kt-spinner');
                    $('#save_details').prop("disabled", false);
                    toastr.success('Grn Reviced successfuly');
                    window.location.href = "epr-po-grn-list";
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
    var poQty = $('#poQty' + id + '').val();
    var deleiverdQty = $('#deleiverdQty' + id + '').val();
    var receivedQty = $('#receivedQty' + id + '').val();
    var balanceQty = parseInt(poQty) - (parseInt(deleiverdQty) + parseInt(receivedQty));//
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
    var poQty;
    var deleiverdQty;
    var receivedQty;
    var balanceQty;
    $("input[name^='receivedQty[]']")
        .each(function (input) {
            id = $(this).attr('data-id');
            poQty = $('#poQty' + id + '').val();
            deleiverdQty = $('#deleiverdQty' + id + '').val();
            receivedQty = $('#receivedQty' + id + '').val();
            balanceQty = parseInt(poQty) - (parseInt(deleiverdQty) + parseInt(receivedQty));
            if (balanceQty < 0) {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    return error;
}
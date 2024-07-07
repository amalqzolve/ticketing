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
    var error = 0;
    var procuctEnter = 0;
    var eprProductId = [];
    $("input[name^='eprProductId[]']")
        .each(function (input) {
            eprProductId.push($(this).val());
        });
    var productname = [];
    $("input[name^='productname[]']")
        .each(function (input) {
            productname.push($(this).val());
            procuctEnter++;
        });
    if (!procuctEnter) {
        error++;
        toastr.error('Add atleast an Item !!!');
    }
    var product_description = [];

    $("textarea[name^='product_description[]']")
        .each(function (input) {
            product_description.push($(this).val());
        });

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

    $("input[name^='quantity[]']")
        .each(function (input) {
            quantity.push($(this).val());
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
    if ($('#supplier_vendor_name').val() == '') {
        $('#supplier_vendor_name').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('select supplier/ vendor');
        error++;
    } else {
        $('#supplier_vendor_name').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    var epr_id = $('#materialRequestid').val();
    var id = $('#id').val();
    if (error == 0) {
        $('#epr_update').addClass('kt-spinner');
        $('#epr_update').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "epr-rfq-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: id,
                epr_id: epr_id,
                productname: productname,
                eprProductId: eprProductId,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                rfq_date: $('#rfq_date').val(),
                rfq_valid_till: $('#rfq_valid_till').val(),
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
                loaderClose();
                if (data.status == 1) {
                    $('#epr_update').removeClass('kt-spinner');
                    $('#epr_update').prop("disabled", false);
                    toastr.success('RFQ Updated successfuly');
                    window.location.href = "epr-rfq-list";
                } else
                    toastr.error(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please fill the mandetory field !!!!');

});
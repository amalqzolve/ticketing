/**
 *Datatable for product details Information
 */
$('.procurementList').addClass('kt-menu__item--active');

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
            procuctEnter++;
        });
    if (!procuctEnter) {
        error++;
        toastr.error('Add atleast an Item !!!');
    }
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
    var id = $('#materialRequestid').val();
    if ($('#supplier_vendor_names').val() == '') {
        $('#supplier_vendor_names').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('select supplier/ vendor');
        error++;
    } else {
        $('#supplier_vendor_names').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (error == 0) {
        $('#epr_update').addClass('kt-spinner');
        $('#epr_update').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "epr-save-rfq",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: id,
                eprProductId: eprProductId,
                productname: productname,
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
                supplier: $('#supplier_vendor_names').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#epr_update').removeClass('kt-spinner');
                    $('#epr_update').prop("disabled", false);
                    toastr.success('RFQ Generated successfuly');
                    loaderClose();
                    window.location.href = "epr-rfq-list";
                }


            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please fill the mandetory field !!!!');
    // console.log(data);
    // material-request-save
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
        , {
            "targets": [11],
            "visible": false
        }],
    ajax: {
        "url": 'ProductpurchaseListing',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'product_name', name: 'product_name', "render": function (data, type, row, meta) {
                return type === 'display' && data.length > 40 ?
                    '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                    data;
            }
        },


        {
            data: 'description', name: 'description', "render": function (data, type, row, meta) {

                if (data != null && data.length > 1) {
                    return type === 'display' && data.length > 40 ?
                        '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                        data;
                } else {
                    return data;
                }


            }
        },
        { data: 'product_code', name: 'product_code' },
        { data: 'bar_code', name: 'bar_code' },
        { data: 'unit', name: 'unit' },
        { data: 'product_price', name: 'product_price' },
        { data: 'selling_price', name: 'selling_price' },
        { data: 'available_stock', name: 'available_stock' },
        { data: 'warehouse', name: 'warehouse' },
        { data: 'store', name: 'store' },
        { data: 'category_name', name: 'category_name' },

    ]
});

$(document).ready(function () {
    // $('#terms').trigger('change');
    $('#productdetails_list tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');

        $('#selected_items').val(product_list_table.rows('.selected').data().length);

        var versement_each = 0;
        selectArr = new Array();
        var ids = $.map(product_list_table.rows('.selected').data(), function (item) {
            versement_each += parseFloat(item.unit_price) || 0;
            var idx = $.inArray(item.product_id, selectArr);
            if (idx == -1) {
                selectArr.push(item.product_id);
            } else {
                selectArr.splice(idx, item.product_id);
            }
        });
        $('#selected_amount').val(versement_each.toFixed(2));
    });



});



$("#datatableadd").on("click", function () {
    $('#kt_modal_4_4').modal('hide');
    product_list_table.rows('.selected').nodes().to$().removeClass('selected');
    $('#selected_amount').val('');
    $('#selected_items').val('');
    createproductvialoop(selectArr);

});




/**
 *products details DataTable Export
 */

$("#productdetails_list_print").on("click", function () {

    product_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function () {
    product_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function () {
    product_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function () {
    product_list_table.button('.buttons-pdf').trigger();
});


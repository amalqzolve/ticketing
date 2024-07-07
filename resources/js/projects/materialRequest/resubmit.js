$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

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
        url: "../get-terms-from-id",
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
$('#terms').trigger("change");
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

    var product_id = [];
    $("input[name^='product_id[]']").each(function (input) {
        product_id.push($(this).val());
    });

    var productname = [];
    $("input[name^='productname[]']").each(function (input) {
        productname.push($(this).val());
    });

    var product_description = [];

    $("textarea[name^='product_description[]']").each(function (input) {
        product_description.push($(this).val());
    });

    var error = 0;
    var unit = [];

    $("select[name^='unit[]']").each(function (input) {
        unit.push($(this).val());
        if ($(this).val() == '') {
            $(this).next().find('.select2-selection').addClass('select-dropdown-error');
            error++;
        } else
            $(this).next().find('.select2-selection').removeClass('select-dropdown-error');
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

    var error = 0;

    var warehouse;
    $("input[name^='warehouse_id[]']").each(function (input) {
        warehouse = $(this).val();
    });

    if ($('#quotedate').val() == '') {
        error++;
        $('#quotedate').addClass('is-invalid');
    } else
        $('#quotedate').removeClass('is-invalid');


    if ($('#dateofsupply').val() == '') {
        error++;
        $('#dateofsupply').addClass('is-invalid');
    } else
        $('#dateofsupply').removeClass('is-invalid');

    if ($('#mr_category').val() == '') {
        error++;
        $('#mr_category').next().find('.select2-selection').addClass('select-dropdown-error');
    } else
        $('#mr_category').next().find('.select2-selection').removeClass('select-dropdown-error');


    if ($('#t_req_date').val() == '') {
        error++;
        $('#t_req_date').addClass('is-invalid');
    } else
        $('#t_req_date').removeClass('is-invalid');

    var qutyChk = checkQty();
    error = error + qutyChk;
    // error = 1;
    if (error == 0) {
        alert($('#epr_id').val());
        alert($('#id').val());
        $('#save').addClass('kt-spinner');
        $('#save').prop("disabled", true);
        // loaderShow();
        $.ajax({
            type: "POST",
            url: "../project-stock-transfer-resubmit-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                epr_id: $('#epr_id').val(),
                id: $('#id').val(),
                product_id: product_id,
                productname: productname,
                product_description: product_description,
                unit: unit,
                quantity: quantity,
                po_assigned_qty: po_assigned_qty,
                warehouse: warehouse,
                t_req_date: $('#t_req_date').val(),
                delivery_terms: $('#delivery_terms').val(),
                total_qty: $('#total_qty').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
                dateofsupply: $('#dateofsupply').val(),
                quotedate: $('#quotedate').val(),
                request_type: $('#request_type').val(),
                request_against: $('#request_against').val(),
                request_priority: $('#request_priority').val(),
                mr_category: $('#mr_category').val(),
                project: $('#project').val(),
                client: $('#client').val(),
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#save').removeClass('kt-spinner');
                    $('#save').prop("disabled", false);
                    toastr.success('Stock Transfer Generated successfuly');
                    loaderClose();
                    window.location.href = "../project-material-request/" + data.project_id;
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else {
        toastr.error('Please fill the mandetory field !!!!');
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
    var epr_quantity;
    var po_assigned_qty;
    var quantity;
    var balance;
    var rowNumbers = 0;
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
        rowNumbers++;
    });

    if (rowNumbers == 0) {
        error++;
        toastr.error('Please add a product');
    }

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
            "targets": [7],
            "visible": false
        }],
    ajax: {
        "url": '../product-purchase-listing',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'product_name', name: 'product_name', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1)
                    return type === 'display' && data.length > 40 ? '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' : data;
                else
                    return data;
            }
        },
        {
            data: 'description', name: 'description', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1)
                    return type === 'display' && data.length > 40 ? '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' : data;
                else
                    return data;
            }
        },
        { data: 'product_code', name: 'product_code' },
        { data: 'unit', name: 'unit' },
        { data: 'available_stock', name: 'available_stock' },
        { data: 'warehouse', name: 'warehouse' },
        { data: 'store', name: 'store' }

    ]
});


$(document).ready(function () {
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


$('#addNewItem').click(function () {
    $('#kt_modal_4_4').modal('show');
});
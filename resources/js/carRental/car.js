$('.settings').addClass('kt-menu__item--open');
$('.car').addClass('kt-menu__item--active');
var tax_list_table = $('#tax_list').DataTable({
    processing: true,
    serverSide: true,

    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
    ],
    "pageLength": 20,

    buttons: [{
        extend: 'copy',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        },
        pageSize: 'A4',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['35%', '35%', '25%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    }
    ],
    ajax: {
        "url": 'car',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'car_name', name: 'car_name', render: function (data, type, row) {
                var curData = row.car_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'brand', name: 'brand', render: function (data, type, row) {
                var curData = row.brand;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'model', name: 'model', render: function (data, type, row) {
                var curData = row.model;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'number_plate', name: 'number_plate', render: function (data, type, row) {
                var curData = row.number_plate;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'owner_name', name: 'owner_name', render: function (data, type, row) {
                var curData = row.owner_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'action', name: 'action' },
    ]
});


var tax_trash_list_table = $('#tax_trash_list').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
    ],
    "pageLength": 20,

    buttons: [{
        extend: 'copy',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['35%', '35%', '25%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    }
    ],
    ajax: {
        "url": 'car-settingstaxTrash',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'car_name', name: 'car_name' },
        { data: 'brand', name: 'brand' },
        { data: 'model', name: 'model' },
        { data: 'number_plate', name: 'number_plate' },
        { data: 'owner_name', name: 'owner_name' },
        { data: 'action11', name: 'action11' },
    ]
});

$(document).on('click', '#car-submit', function (e) {
    e.preventDefault();

    var error = 0;

    if ($('#car_name').val() == "") {
        $('#car_name').addClass('is-invalid');
        error++;
    } else {
        $('#car_name').removeClass('is-invalid');
    }

    if ($('#model').val() == "") {
        $('#model').addClass('is-invalid');
        error++;
    } else {
        $('#model').removeClass('is-invalid');
    }

    if ($('#number_plate').val() == "") {
        $('#number_plate').addClass('is-invalid');
        error++;
    } else {
        $('#number_plate').removeClass('is-invalid');
    }
    if ($('#car_category_id').val() == "") {
        $('#car_category_id').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else {
        $('#car_category_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if ($('#monthly_charge').val() == "") {
        $('#monthly_charge').addClass('is-invalid');
        error++;
    } else {
        $('#monthly_charge').removeClass('is-invalid');
    }

    if ($('#monthly_limit').val() == "") {
        $('#monthly_limit').addClass('is-invalid');
        error++;
    } else {
        $('#monthly_limit').removeClass('is-invalid');
    }

    if ($('#additional_charge').val() == "") {
        $('#additional_charge').addClass('is-invalid');
        error++;
    } else {
        $('#additional_charge').removeClass('is-invalid');
    }

    if ($('#dayily_charge').val() == "") {
        $('#dayily_charge').addClass('is-invalid');
        error++;
    } else {
        $('#dayily_charge').removeClass('is-invalid');
    }

    if ($('#daily_limit').val() == "") {
        $('#daily_limit').addClass('is-invalid');
        error++;
    } else {
        $('#daily_limit').removeClass('is-invalid');
    }

    if ($('#dayily_additional_charge').val() == "") {
        $('#dayily_additional_charge').addClass('is-invalid');
        error++;
    } else {
        $('#dayily_additional_charge').removeClass('is-invalid');
    }

    if ($('#hourly_charge').val() == "") {
        $('#hourly_charge').addClass('is-invalid');
        error++;
    } else {
        $('#hourly_charge').removeClass('is-invalid');
    }

    if ($('#hourly_limit').val() == "") {
        $('#hourly_limit').addClass('is-invalid');
        error++;
    } else {
        $('#hourly_limit').removeClass('is-invalid');
    }

    if ($('#hourly_additional_charge').val() == "") {
        $('#hourly_additional_charge').addClass('is-invalid');
        error++;
    } else {
        $('#hourly_additional_charge').removeClass('is-invalid');
    }

    if ($('#contract_charge').val() == "") {
        $('#contract_charge').addClass('is-invalid');
        error++;
    } else {
        $('#contract_charge').removeClass('is-invalid');
    }

    if ($('#contract_limit').val() == "") {
        $('#contract_limit').addClass('is-invalid');
        error++;
    } else {
        $('#contract_limit').removeClass('is-invalid');
    }

    if ($('#contract_additional_charge').val() == "") {
        $('#contract_additional_charge').addClass('is-invalid');
        error++;
    } else {
        $('#contract_additional_charge').removeClass('is-invalid');
    }

    if (!error) {
        $('#car-submit').addClass('kt-spinner');
        $('#car-submit').prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "car-submit",
            dataType: "json",
            data: $('#car-form').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 0) {
                    $('#tax_submit').removeClass('kt-spinner');
                    $('#tax_submit').prop("disabled", false);
                    toastr.error(data.msg);
                }
                else {
                    $('#tax_submit').removeClass('kt-spinner');
                    $('#tax_submit').prop("disabled", false);
                    window.location.href = "car";
                    toastr.success('Car Details' + sucess_msg + ' successfuly');
                }

            },
            error: function (jqXhr, json, errorThrown) {

                console.log('Error !!');
            }
        });
    } else
        toastr.error('Remove Validation Error');

});

$(document).on('click', '.cancel', function () {
    closeModel();
});

function closeModel() {
    $('#currency_name').val("");
    $('#value').val("");
    $('#symbol').val("");
    $('#notes').val("");
}

$(document).on('click', '.mrCatdelete', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'car-category-delete',
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    if (data.status == 1) {
                        swal.fire("Deleted!", data.msg, "success"); location.reload();
                    }
                    else
                        swal.fire("Cancelled", data.msg + "Your Entry is safe :)", "error");

                }
            });
        } else {

            swal.fire("Cancelled", "Your Entry is safe :)", "error");
        }
    })
});
$(document).on('click', '.taxrestore', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'car-settingsrestore-tax',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {

                    swal.fire("Restored!", "Your Entry has been restored.", "success");
                    window.location.href = "settingstax";
                }
            });
        } else {

            swal.fire("Cancelled", "Your Entry is safe :)", "error");
        }
    })
});
$(document).on('click', '.taxtrashdelete', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'car-settingstrashdelete-tax',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {

                    swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Entry is safe :)", "error");
        }
    })
});

$("#tax_list_print").on("click", function () {
    tax_list_table.button('.buttons-print').trigger();
});


$("#tax_list_copy").on("click", function () {
    tax_list_table.button('.buttons-copy').trigger();
});

$("#tax_list_csv").on("click", function () {
    tax_list_table.button('.buttons-csv').trigger();
});

$("#tax_list_pdf").on("click", function () {
    tax_list_table.button('.buttons-pdf').trigger();
});
$("#tax_trash_list_print").on("click", function () {
    tax_trash_list_table.button('.buttons-print').trigger();
});


$("#tax_trash_list_copy").on("click", function () {
    tax_trash_list_table.button('.buttons-copy').trigger();
});

$("#tax_trash_list_csv").on("click", function () {
    tax_trash_list_table.button('.buttons-csv').trigger();
});

$("#tax_trash_list_pdf").on("click", function () {
    tax_trash_list_table.button('.buttons-pdf').trigger();
});
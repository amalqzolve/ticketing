$('.settings').addClass('kt-menu__item--open');
$('.car-category').addClass('kt-menu__item--active');
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
        "url": 'car-category',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'decription', name: 'decription', render: function (data, type, row) {
                var curData = row.decription;
                if (curData != null)
                    return curData.length > 120 ? curData.substr(0, 120) + '…' : curData;
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
        { data: 'taxname', name: 'taxname' },
        { data: 'tax_percentage', name: 'tax_percentage' },
        { data: 'action11', name: 'action11' },

    ]
});

$(document).on('click', '#tax_submit', function (e) {
    e.preventDefault();
    var error = 0;

    if ($('#name').val() == "") {
        $('#name').addClass('is-invalid');
        error++;
    } else {
        $('#name').removeClass('is-invalid');
    }

    if (!error) {
        $('#tax_submit').addClass('kt-spinner');
        $('#tax_submit').prop("disabled", true);
        if ($('#id').val())
            var sucess_msg = 'Updated';
        else
            var sucess_msg = 'Created';
        $.ajax({
            type: "POST",
            url: "car-category-submit",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                info_id: $('#id').val(),
                name: $('#name').val(),
                decription: $('#decription').val()
            },
            success: function (data) {
                if (data.status == 0) {
                    $('#tax_submit').removeClass('kt-spinner');
                    $('#tax_submit').prop("disabled", false);
                    toastr.error('Category Name is already exist');
                }
                else {
                    $('#tax_submit').removeClass('kt-spinner');
                    $('#tax_submit').prop("disabled", false);
                    window.location.href = "car-category";
                    toastr.success('Car Category ' + sucess_msg + ' Successfuly');
                    closeModel();
                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
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


$("#tax_trash_list_copy").on("click", function () {
    tax_trash_list_table.button('.buttons-copy').trigger();
});

$("#tax_trash_list_csv").on("click", function () {
    tax_trash_list_table.button('.buttons-csv').trigger();
});

$("#tax_trash_list_pdf").on("click", function () {
    tax_trash_list_table.button('.buttons-pdf').trigger();
});
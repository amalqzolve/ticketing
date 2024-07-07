$('.settings').addClass('kt-menu__item--open');
$('.task-state').addClass('kt-menu__item--active');
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
    order: [[2, 'asc']],

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
        "url": 'task-state',
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
        { data: 'data_order', name: 'data_order' },
        {
            data: 'style', name: 'style', render: function (data, type, row) {
                if (row.style == 'primary')
                    return 'Primary';
                // else if (row.style == 'secondary')
                //     return 'Secondary';
                else if (row.style == 'danger')
                    return 'Danger';
                else if (row.style == 'warning')
                    return 'Warning';
                else if (row.style == 'info')
                    return 'Info';
                else if (row.style == 'light')
                    return 'Light';
                else if (row.style == 'dark')
                    return 'Dark';
                // else if (row.style == 'link')
                //     return 'Link';
                else
                    return '';
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
        "url": 'task-state-trash',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'taxname', name: 'taxname' },
        { data: 'tax_percentage', name: 'tax_percentage' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                      <i class="fa fa-cog"></i></a>\
                      <div class="dropdown-menu dropdown-menu-right">\
                      <ul class="kt-nav">\
                      <li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                      <span class="kt-nav__link-text taxrestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                      <li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-trash"></i>\
                      <span class="kt-nav__link-text taxtrashdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                     </ul></div></div></span>';
            }
        },

    ]
});

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    tax_name = $('#name').val();
    var error = 0;

    if (tax_name == "") {
        $('#name').addClass('is-invalid');
        error++;
    } else {
        $('#name').removeClass('is-invalid');
    }

    if ($('#data_order').val() == "") {
        $('#data_order').addClass('is-invalid');
        error++;
    } else {
        $('#data_order').removeClass('is-invalid');
    }

    if ($('#style').val() == "") {
        $('#style').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else {
        $('#style').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    if (!error) {
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "task-state-submit",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                info_id: $('#id').val(),
                name: $('#name').val(),
                decription: $('#decription').val(),
                data_order: $('#data_order').val(),
                style: $('#style').val(),
            },
            success: function (data) {
                if (data == false) {
                    $('#tax_submit').removeClass('kt-spinner');
                    $('#tax_submit').prop("disabled", false);
                    toastr.success('Tax Name is already exist');
                }
                else {
                    $('#tax_submit').removeClass('kt-spinner');
                    $('#tax_submit').prop("disabled", false);
                    window.location.href = "task-state";
                    toastr.success('category ' + sucess_msg + ' successfuly');
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
                url: 'task-state-delete',
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
                url: 'task-state-restore',
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
                url: 'task-state-trash-delete',
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
$('.procurementSettings').addClass('kt-menu__item--open');
$('.MR_Category').addClass('kt-menu__item--active');
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
        "url": 'material-category',
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
                    return curData.length > 80 ? curData.substr(0, 80) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'decription', name: 'decription', render: function (data, type, row) {
                var curData = row.decription;
                if (curData != null)
                    return curData.length > 80 ? curData.substr(0, 80) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                      <i class="fa fa-cog"></i></a>\
                      <div class="dropdown-menu dropdown-menu-right">\
                      <ul class="kt-nav">\
                      <a href="material-category-edit?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-edit"></i>\
                      <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                      </span></li></a>\
                      <a href="material-category-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon-background"></i>\
                      <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                      </span></li></a>\
                      <li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-trash"></i>\
                      <span class="kt-nav__link-text mrCatdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                     </ul></div></div></span>';
            }
        },

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
        "url": 'settingstaxTrash',
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
function back() {
    window.location.href = "material-category";
}
$(document).on('click', '#tax_submit', function (e) {
    e.preventDefault();
    tax_name = $('#name').val();
    tax_percentage = $('#decription').val();

    if (tax_name == "") {
        $('#name').addClass('is-invalid');
        return false;
    } else {
        $('#name').removeClass('is-invalid');
    }

    if (tax_percentage == "") {
        $('#decription').addClass('is-invalid');
        return false;
    } else {
        $('#decription').removeClass('is-invalid');
    }

    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "material-category-submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            name: $('#name').val(),
            decription: $('#decription').val()
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
                window.location.href = "material-category";
                toastr.success('material category ' + sucess_msg + ' successfuly');
                closeModel();
            }

        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
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
                url: 'material-category-delete',
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
                url: 'settingsrestore-tax',
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
                url: 'settingstrashdelete-tax',
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
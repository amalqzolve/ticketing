$('.estimationSettings').addClass('kt-menu__item--open');
$('.catColumns').addClass('kt-menu__item--active');
// catRows
var tax_list_table = $('#tax_list').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],

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
        "url": 'estimation-column',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'name', name: 'name' },
        { data: 'decription', name: 'decription' },
        { data: 'percentage', name: 'percentage' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                       <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                      <i class="fa fa-cog"></i></a>\
                      <div class="dropdown-menu dropdown-menu-right">\
                      <ul class="kt-nav">\
                      <a href="estimation-column-edit?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-edit"></i>\
                      <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                      </span></li></a>\
                      <a href="estimation-column-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon-background"></i>\
                      <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                      </span></li></a>\
                     </ul></div></div></span>';
            }
        },

    ]
});

{/* <li class="kt-nav__item">\
<span class="kt-nav__link">\
<i class="kt-nav__link-icon flaticon2-trash"></i>\
<span class="kt-nav__link-text catCatdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\ */}


$(document).on('click', '#save', function (e) {
    alert($('#percentage').val());
    e.preventDefault();
    if ($('#name').val() == "") {
        $('#name').addClass('is-invalid');
        return false;
    } else
        $('#name').removeClass('is-invalid');

    if ($('#percentage').val() == "") {
        $('#percentage').addClass('is-invalid');
        return false;
    } else
        $('#percentage').removeClass('is-invalid');

    if ($('#decription').val() == "") {
        $('#decription').addClass('is-invalid');
        return false;
    } else
        $('#decription').removeClass('is-invalid');

    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "estimation-column-submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            name: $('#name').val(),
            decription: $('#decription').val(),
            percentage: $('#percentage').val(),
        },
        success: function (data) {
            if (data == false) {
                $('#save').removeClass('kt-spinner');
                $('#save').prop("disabled", false);
                toastr.success('Tax Name is already exist');
            }
            else {
                $('#save').removeClass('kt-spinner');
                $('#save').prop("disabled", false);
                toastr.success('Saved successfuly');
                window.location.href = "estimation-column";
            }

        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
});


$(document).on('click', '.catCatdelete', function () {
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
                url: 'estimation-column-delete',
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    if (data.status == 1) {
                        swal.fire("Deleted!", data.msg, "success");
                        location.reload();
                    }
                    else
                        swal.fire("Cancelled", data.msg + "Your Entry is safe :)", "error");

                }
            });
        } else
            swal.fire("Cancelled", "Your Entry is safe :)", "error");
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
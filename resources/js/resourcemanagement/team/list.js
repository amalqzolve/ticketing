$('.teams-list').addClass('kt-menu__item--active');
var teamTbl = $('#teamTbl').DataTable({
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
        orientation: 'landscape',
        customize: function (doc) {
            doc.pageMargins = [50, 50, 50, 50];
            doc.content[1].table.widths = ['10%', '20%', '10%'];
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
        "url": 'teams-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'name', name: 'name' },
        { data: 'decription', name: 'decription' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                  <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                    <ul class="kt-nav">\
                                    <a href="teams-edit/'+ row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-contract"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                                    </span></li></a>\
                                    <li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>\
                                    <span class="kt-nav__link-text costmatrixdelete"  id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                                  </ul></div></div></span>';
            }
        },
    ]
});


$("#export-button-print").on("click", function () {
    teamTbl.button('.buttons-print').trigger();
});
$("#export-button-copy").on("click", function () {
    teamTbl.button('.buttons-copy').trigger();
});
$("#export-button-csv").on("click", function () {
    teamTbl.button('.buttons-csv').trigger();
});
$("#export-button-pdf").on("click", function () {
    teamTbl.button('.buttons-pdf').trigger();
});

$(document).on('click', '.costmatrixdelete', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Entry",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'delete-costmatrix',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    swal.fire("Deleted!", "Your entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe ", "error");
        }
    })
});
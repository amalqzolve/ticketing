$('.approvalSynthesis').addClass('kt-menu__item--open');
$('.grnWorkflow').addClass('kt-menu__item--active');
var poWorkflow = $('#poWorkflow').DataTable({
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
        "url": 'grn-workflow',
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
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
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
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                      <i class="fa fa-cog"></i></a>\
                      <div class="dropdown-menu dropdown-menu-right">\
                      <ul class="kt-nav">\
                      <a href="grn-workflow-edit-view?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-edit"></i>\
                      <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                      </span></li></a>\
                      <a href="grn-workflow-clone?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon-background"></i>\
                      <span class="kt-nav__link-text" data-id="' + row.id + '" >Clone</span>\
                      </span></li></a>\
                      <li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-trash"></i>\
                      <span class="kt-nav__link-text mrWorkFlowdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                     </ul></div></div></span>';
            }
        },

    ]
});

$(document).on('click', '.mrWorkFlowdelete', function () {
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
                url: 'grn-workflow-delete',
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    if (data.status == 1)
                        swal.fire("Deleted!", data.msg, "success");
                    else
                        swal.fire("Cancelled", data.msg + "Your Entry is safe :)", "error");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Entry is safe :)", "error");
        }
    })
});

$("#export-button-print").on("click", function () {
    poWorkflow.button('.buttons-print').trigger();
});
$("#export-button-copy").on("click", function () {
    poWorkflow.button('.buttons-copy').trigger();
});

$("#export-button-csv").on("click", function () {
    poWorkflow.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    poWorkflow.button('.buttons-pdf').trigger();
});



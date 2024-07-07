$('.tasks').addClass('kt-menu__item--open');
$('.task-list').addClass('kt-menu__item--active');
var taskTbl = $('#taskTbl').DataTable({
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
        "url": 'task-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id_filter').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'start_date', name: 'start_date' },
        { data: 'deadline', name: 'deadline' },
        { data: 'milestone', name: 'milestone' },
        { data: 'project', name: 'project' },
        { data: 'assign_to', name: 'assign_to' },
        { data: 'collaborators', name: 'collaborators' },
        { data: 'state_name', name: 'state_name' },
        { data: 'action', name: 'action' },
    ]
});



$(document).on('click', '#btnViewTask', function (e) {
    taskTbl.ajax.reload();
})


$(document).on('click', '.viewTask', function () {
    var info_id = $(this).attr("data-id");
    loadModel(info_id);
});


$(document).on('click', '.taskDelete', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '../task-delete',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        swal.fire("Deleted!", "Your Task has been deleted.", "success");
                        taskTbl.ajax.reload();
                    }
                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");

        }
    })
});


$("#labels_details_list_print").on("click", function () {
    labels_details_list_table.button('.buttons-print').trigger();
});


$("#labels_details_list_copy").on("click", function () {
    labels_details_list_table.button('.buttons-copy').trigger();
});

$("#labels_details_list_csv").on("click", function () {
    labels_details_list_table.button('.buttons-csv').trigger();
});

$("#labels_details_list_pdf").on("click", function () {
    labels_details_list_table.button('.buttons-pdf').trigger();
});
$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');


var milestonesTbl = $('#milestonesTbl').DataTable({
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
        "url": '../project-milestones/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },

        { data: 'milestone_due_date', name: 'milestone_due_date' },
        {
            data: 'milestone_title', name: 'milestone_title', render: function (data, type, row) {
                var curData = row.milestone_title;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'action', name: 'action' }
    ]
});



$(document).on('click', '.editView', function () {
    var milestoneId = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "../get-project-milestone",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: milestoneId

        },
        success: function (data) {
            if (data.status == 1) {
                $('#modalLabel').text('Edit Milestone');
                $('#milestone_title').val(data.data.milestone_title);
                $('#milestone_description').val(data.data.milestone_description);
                $('#milestone_due_date').val(data.data.milestone_due_date);
                $('#milestone_title').removeClass('is-invalid');
                $('#milestone_due_date').removeClass('is-invalid');
                $('#id').val(data.data.id);
                $('#kt_modal_4_5').modal('show');
            } else
                toastr.success('Data Not Found');

        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });

});


$(document).on('click', '.delete', function () {
    var milestoneId = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this milestone",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "../project-milestone-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: milestoneId
                },
                success: function (data) {
                    if (data.status == 1) {
                        closeModel()
                        toastr.warning('milestone Trashed successfuly');
                    } else
                        toastr.error(data.msg);

                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

        } else
            swal.fire("Cancelled", "", "error");
    })
});



$(document).on('click', '#btnAdd', function (e) {
    $('#modalLabel').text('Add Milestone');
    $('#milestone_title').val('');
    $('#milestone_description').val('');
    $('#milestone_title').removeClass('is-invalid');
    $('#milestone_due_date').removeClass('is-invalid');
    $('#id').val('');
    $('#kt_modal_4_5').modal('show');
});

$(document).on('click', '#btnSaveMilestone', function (e) {
    e.preventDefault();
    tax_name = $('#name').val();
    var error = 0;

    if ($('#milestone_title').val() == "") {
        $('#milestone_title').addClass('is-invalid');
        error++;
    } else {
        $('#milestone_title').removeClass('is-invalid');
    }

    if ($('#milestone_due_date').val() == "") {
        $('#milestone_due_date').addClass('is-invalid');
        error++;
    } else {
        $('#milestone_due_date').removeClass('is-invalid');
    }

    if (!error) {
        $('#btnSaveMilestone').addClass('kt-spinner');
        $('#btnSaveMilestone').prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "../project-milestone-submit",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSaveMilestone').removeClass('kt-spinner');
                    $('#btnSaveMilestone').prop("disabled", false);
                    toastr.success('Milestone Saved ' + sucess_msg + ' successfuly');
                    closeModel();
                }
                else {
                    $('#btnSaveMilestone').removeClass('kt-spinner');
                    $('#btnSaveMilestone').prop("disabled", false);
                    toastr.error(data.msg);
                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});

function closeModel() {
    $('#modalLabel').text('');
    $('#milestone_title').val('');
    $('#milestone_description').val('');
    $('#milestone_title').removeClass('is-invalid');
    $('#milestone_due_date').removeClass('is-invalid');
    $('#id').val('');

    milestonesTbl.ajax.reload();
    $('#kt_modal_4_5').modal('hide');
}
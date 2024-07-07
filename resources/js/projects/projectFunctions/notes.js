$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');


var notesTbl = $('#notesTbl').DataTable({
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
        "url": '../project-notes/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'note_date', name: 'note_date' },
        {
            data: 'note_title', name: 'note_title', render: function (data, type, row) {
                var curData = row.note_title;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'note_description', name: 'note_description', render: function (data, type, row) {
                var curData = row.note_description;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'lebals', name: 'lebals' },
        { data: 'action', name: 'action' }

    ],
    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        $("td:nth-child(5)", nRow).html($("td:nth-child(5)", nRow).text());
    },
});



$(document).on('click', '.editView', function () {
    var milestoneId = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "../get-project-note",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: milestoneId
        },
        success: function (data) {
            if (data.status == 1) {
                $('#modalLabel').text('Edit Milestone');
                $('#note_title').val(data.data.note_title);
                $('#note_description').val(data.data.note_description);
                $('#note_date').val(data.data.note_date);
                $('#note_title').removeClass('is-invalid');
                $('#note_date').removeClass('is-invalid');
                $('#id').val(data.data.id);
                $('#labels').val(data.lebals);
                refreshItems();
                if (data.data.public_flg == 1)
                    $('#public_flg').prop('checked', true);
                else
                    $('#public_flg').prop('checked', false);

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
    var noteId = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Note",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "../project-note-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: noteId
                },
                success: function (data) {
                    if (data.status == 1) {
                        closeModel()
                        toastr.warning('Note Trashed successfuly');
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
    $('#modalLabel').text('Add Note');
    $('#note_title').val('');
    $('#note_description').val('');
    $('#note_title').removeClass('is-invalid');
    $('#note_date').removeClass('is-invalid');
    $('#id').val('');
    $('#labels').val('');
    refreshItems();
    $('#public_flg').prop('checked', false);
    $('#kt_modal_4_5').modal('show');
});

$(document).on('click', '#btnSaveNote', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#note_title').val() == "") {
        $('#note_title').addClass('is-invalid');
        error++;
    } else {
        $('#note_title').removeClass('is-invalid');
    }
    if ($('#note_date').val() == "") {
        $('#note_date').addClass('is-invalid');
        error++;
    } else {
        $('#note_date').removeClass('is-invalid');
    }
    if (!error) {
        $('#btnSaveNote').addClass('kt-spinner');
        $('#btnSaveNote').prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "../project-note-submit",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSaveNote').removeClass('kt-spinner');
                    $('#btnSaveNote').prop("disabled", false);
                    toastr.success('Note ' + sucess_msg + ' successfuly');
                    closeModel();
                }
                else {
                    $('#btnSaveNote').removeClass('kt-spinner');
                    $('#btnSaveNote').prop("disabled", false);
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
    $('#note_title').val('');
    $('#note_description').val('');
    $('#note_title').removeClass('is-invalid');
    $('#note_date').removeClass('is-invalid');
    $('#id').val('');
    $('#public_flg').prop('checked', false);
    $('#labels').val('');
    refreshItems();
    notesTbl.ajax.reload();
    $('#kt_modal_4_5').modal('hide');
}
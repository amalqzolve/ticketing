$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

$(function () {
    $('#from').datetimepicker({
        format: 'dd-mm-yyyy h:i:s'
    });
    $('#to').datetimepicker({
        // useCurrent: false, //Important! See issue #1075
        format: 'dd-mm-yyyy h:i:s'
    });
    $("#from").on("dp.change", function (e) {
        $('#to').data("DateTimePicker").minDate(e.date);
    });
    $("#to").on("dp.change", function (e) {
        $('#from').data("DateTimePicker").maxDate(e.date);
    });
});

var timeSheetTbl = $('#timeSheetTbl').DataTable({
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
        "url": '../project-time-sheet/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },

        {
            data: 'title', name: 'title', render: function (data, type, row) {
                var curData = row.title;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'employee_name_field', name: 'employee_name_field', render: function (data, type, row) {
                var curData = row.employee_name_field;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'from', name: 'from' },
        { data: 'to', name: 'to' },
        { data: 'hr_worked', name: 'hr_worked' },
        { data: 'action', name: 'action' },
    ]
});



$(document).on('click', '.editView', function () {
    var milestoneId = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "../get-project-time-sheet",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: milestoneId

        },
        success: function (data) {
            if (data.status == 1) {
                $('#modalLabel').text('Edit Time Sheet');
                $('#id').val(data.data.id);
                $('#task').val(data.data.task);
                $('#employee').val(data.data.employee);
                $('#from').val(data.data.from);
                $('#to').val(data.data.to);
                $('#description').val(data.data.description);
                $('#employee').next().find('.select2-selection').removeClass('select-dropdown-error');
                $('#from').removeClass('is-invalid')
                $('#to').removeClass('is-invalid');
                refreshItems();
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
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Timesheet",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "../project-time-sheet-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    if (data.status == 1) {
                        closeModel()
                        toastr.warning('Timesheet Trashed successfuly');
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
    $('#modalLabel').text('Add Time Sheet');
    $('#task').val('');
    $('#employee').val('');
    $('#from').val('');
    $('#to').val('');
    $('#id').val('');
    $('#description').val('');
    $('#employee').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#from').removeClass('is-invalid')
    $('#to').removeClass('is-invalid');
    $('#kt_modal_4_5').modal('show');
});

$(document).on('click', '#btnSaveTimeSheet', function (e) {
    e.preventDefault();

    var error = 0;

    if ($('#employee').val() == "") {
        $('#employee').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else {
        $('#employee').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    if ($('#from').val() == "") {
        $('#from').addClass('is-invalid');
        error++;
    } else {
        $('#from').removeClass('is-invalid');
    }

    if ($('#to').val() == "") {
        $('#to').addClass('is-invalid');
        error++;
    } else {
        $('#to').removeClass('is-invalid');
    }

    if (!error) {
        $('#btnSaveTimeSheet').addClass('kt-spinner');
        $('#btnSaveTimeSheet').prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "../project-time-sheet-submit",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSaveTimeSheet').removeClass('kt-spinner');
                    $('#btnSaveTimeSheet').prop("disabled", false);
                    toastr.success('Time Sheet Saved ' + sucess_msg + ' successfuly');
                    closeModel();
                }
                else {
                    $('#btnSaveTimeSheet').removeClass('kt-spinner');
                    $('#btnSaveTimeSheet').prop("disabled", false);
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
    $('#task').val('');
    $('#employee').val('');
    $('#from').val('');
    $('#to').val('');
    $('#id').val('');
    $('#description').val('');
    $('#employee').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#from').removeClass('is-invalid')
    $('#to').removeClass('is-invalid');
    timeSheetTbl.ajax.reload();
    $('#kt_modal_4_5').modal('hide');
}
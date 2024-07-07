$('.car-in-and-out').addClass('kt-menu__item--active');

var additionalCostTbl = $('#additionalCostTbl').DataTable({
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
        "url": '../trip-additional-cost/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.car_in_out_id = $('#car_in_out_id').val()
        }
    },

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'remarks', name: 'remarks', render: function (data, type, row) {
                var curData = row.remarks;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'amount', name: 'amount' },
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
        url: "../get-additional-cost",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: milestoneId
        },
        success: function (data) {
            if (data.status == 1) {
                $('#modalLabel').text('Edit Additional Cost');
                $('#amount').val(data.data.amount);
                $('#remarks').val(data.data.remarks);
                $('#amount').removeClass('is-invalid');
                $('#remarks').removeClass('is-invalid');
                $('#id').val(data.data.id);
                $('#kt_modal_4_5').modal('show');
            } else
                toastr.error('Data Not Found');

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
                url: "../additional-cost-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: noteId
                },
                success: function (data) {
                    if (data.status == 1) {
                        closeModel()
                        toastr.success('Additional Cost Trashed successfuly');
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
    $('#modalLabel').text('Add Additional Cost');
    $('#amount').val('');
    $('#remarks').val('');
    $('#amount').removeClass('is-invalid');
    $('#remarks').removeClass('is-invalid');
    $('#kt_modal_4_5').modal('show');
});

$(document).on('click', '#btnSaveNote', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#amount').val() == "") {
        $('#amount').addClass('is-invalid');
        error++;
    } else {
        $('#amount').removeClass('is-invalid');
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
            url: "../additional-cost-submit",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&car_in_out_id=" + $('#car_in_out_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSaveNote').removeClass('kt-spinner');
                    $('#btnSaveNote').prop("disabled", false);
                    toastr.success('Additional Cost ' + sucess_msg + ' successfuly');
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
    $('#amount').val('');
    $('#remarks').val('');
    $('#amount').removeClass('is-invalid');
    $('#remarks').removeClass('is-invalid');
    $('#id').val('');
    additionalCostTbl.ajax.reload();
    $('#kt_modal_4_5').modal('hide');
}
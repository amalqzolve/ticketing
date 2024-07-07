$('.car-in-and-out').addClass('kt-menu__item--active');


var tblInvoice = $('#tblInvoice').DataTable({
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
        "url": '../trip-invoices/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.car_in_out_id = $('#car_in_out_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id', name: 'id', render: function (data, type, row) {
                return 'INV -' + row.id;
            }
        },
        { data: 'quotedate', name: 'quotedate' },
        { data: 'valid_till', name: 'valid_till' },
        {
            data: 'salesman', name: 'salesman', render: function (data, type, row) {
                var curData = row.salesman;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == 0)
                    return '<span style="color: black">Draft</span>';
                else (row.status == 1)//if
                return '<span style="color: blue">Approved</span>';
                // else if (row.status == 2)
                //     return '<span style="color: green">Receipt Generated</span>';
                // else
                //     return '';
            }
        },
        { data: 'action', name: 'action' }

    ],
    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        $("td:nth-child(5)", nRow).html($("td:nth-child(5)", nRow).text());
    },
});



$(document).on('click', '.delete', function () {
    var noteId = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Invoice",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "../trip-invoice-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: noteId
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('Invoice Trashed successfuly');
                        location.reload();
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


$(document).on('click', '.send', function () {
    var noteId = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this Invoice",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Send",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "../trip-invoice-send",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: noteId
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('Invoice Send successfuly');
                        location.reload();
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
$('.car-in-and-out').addClass('kt-menu__item--active');


var tblReceipt = $('#tblReceipt').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
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
            columns: [0, 1, 2, 3, 4, 5, 6]
        }
    }
    ],

    ajax: {
        "url": '../trip-statement-of-accounts/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.car_in_out_id = $('#car_in_out_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'transcation_date', name: 'transcation_date' },
        {
            data: 'id', name: 'id', render: function (data, type, row) {

                return '#' + row.id;
            }
        },
        {
            data: 'trans_type', name: 'trans_type', render: function (data, type, row) {

                return row.trans_type;
            }
        },
        {
            data: 'notes', name: 'notes', render: function (data, type, row) {
                var curData = row.notes;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'debit_amount', name: 'debit_amount', render: function (data, type, row) {
                if (row.debit_amount != 0)
                    return row.debit_amount;
                else
                    return row.debit_amount;
            }
        },
        {
            data: 'credit_amount', name: 'credit_amount', render: function (data, type, row) {
                if (row.credit_amount != 0)
                    return row.credit_amount;
                else
                    return row.credit_amount;
            }
        },
    ],
    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        $("td:nth-child(5)", nRow).html($("td:nth-child(5)", nRow).text());
    },
});



$("#export-button-print").on("click", function () {
    tblReceipt.button('.buttons-print').trigger();
});
$("#export-button-copy").on("click", function () {
    tblReceipt.button('.buttons-copy').trigger();
});
$("#export-button-csv").on("click", function () {
    tblReceipt.button('.buttons-csv').trigger();
});
$("#export-button-pdf").on("click", function () {
    tblReceipt.button('.buttons-pdf').trigger();
});

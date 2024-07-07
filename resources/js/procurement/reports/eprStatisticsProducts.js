$('.procurementReports').addClass('kt-menu__item--open');
$('.epr-statistics').addClass('kt-menu__item--active');
var eprSatisticsProduct = $('#eprSatisticsProduct').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    }
    ],

    ajax: {
        "url": '../epr-product-list/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.epr_id = $('#epr_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'itemname', name: 'itemname' },
        {
            data: 'description', name: 'description', render: function (data, type, row) {
                var curData = row.description;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'unit_name', name: 'unit_name' },
        { data: 'quantity', name: 'quantity' },
        { data: 'po_assigned_qty', name: 'po_assigned_qty' },
        {
            data: 'po_assigned_qty', name: 'po_assigned_qty', render: function (data, type, row) {
                var balanceQty = row.quantity - row.po_assigned_qty;
                return balanceQty;
            }
        },

    ]
});
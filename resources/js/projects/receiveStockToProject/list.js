$('.projectMaterials').addClass('kt-menu__item--open');
$('.procurement-stock-in-to-project').addClass('kt-menu__item--active');
var pendingTbl = $('#pendingTbl').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    }
    ],

    ajax: {
        "url": 'procurement-stock-in-to-project',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'S-IN ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'warehouse_transfer_date', name: 'warehouse_transfer_date' },
        {
            data: 'grn_id',
            name: 'grn_id',
            render: function (data, type, row) {
                return 'GRN ' + row.grn_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'po_id',
            name: 'po_id',
            render: function (data, type, row) {
                return 'PO ' + row.po_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'sup_name', name: 'sup_name', render: function (data, type, row) {
                var curData = row.sup_name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
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
            data: 'mr_category', name: 'mr_category', render: function (data, type, row) {
                var curData = row.mr_category;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'transfer_type', name: 'transfer_type', render: function (data, type, row) {
                var curData = row.transfer_type;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname', render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'warehouse_receive_status',
            name: 'warehouse_receive_status',
            render: function (data, type, row) {
                if (row.warehouse_receive_status == 0)
                    return '<span style="color: black">Not Receive</span>';
                if (row.warehouse_receive_status == 1)
                    return '<span style="color: blue">Received</span>';
            }
        },
        { data: 'action', name: 'action' },
    ]
});


var doneTbl = $('#doneTbl').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    }
    ],

    ajax: {
        "url": 'procurement-stock-in-to-project-received',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'S-IN ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'warehouse_transfer_date', name: 'warehouse_transfer_date' },
        {
            data: 'grn_id',
            name: 'grn_id',
            render: function (data, type, row) {
                return 'GRN ' + row.grn_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'po_id',
            name: 'po_id',
            render: function (data, type, row) {
                return 'PO ' + row.po_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'sup_name', name: 'sup_name', render: function (data, type, row) {
                var curData = row.sup_name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
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
            data: 'mr_category', name: 'mr_category', render: function (data, type, row) {
                var curData = row.mr_category;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'transfer_type', name: 'transfer_type', render: function (data, type, row) {
                var curData = row.transfer_type;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname', render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'warehouse_receive_status',
            name: 'warehouse_receive_status',
            render: function (data, type, row) {
                if (row.warehouse_receive_status == 0)
                    return '<span style="color: black">Not Receive</span>';
                if (row.warehouse_receive_status == 1)
                    return '<span style="color: blue">Received</span>';
            }
        },
        { data: 'action', name: 'action' },
    ]
});




$(document).on('click', '.sendForApproval', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this Stock For Approval",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Send",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            loaderShow();
            $.ajax({
                type: "POST",
                url: "epr-po-grn-stock-in-send",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        loaderClose();
                        toastr.success('Stock in Send for Approval successfuly');
                        window.location.href = "epr-po-grn-stock-in";
                    } else {
                        swal.fire({
                            title: "Error !!!",
                            text: data.msg,
                            type: "error",
                        });
                    }
                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});



$('.kt-wizard-v3__nav-item').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        doneTbl.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        doneTbl.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-copy').trigger();
    else if (tbl == 2)
        doneTbl.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-csv').trigger();
    else if (tbl == 2)
        doneTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        doneTbl.button('.buttons-pdf').trigger();
});













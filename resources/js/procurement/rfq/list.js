$('.rfqList').addClass('kt-menu__item--active');
var internal_use_list = $('#internal_use_list').DataTable({
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
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%'];
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
        "url": 'epr-rfq-list',
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
                return '#EPR-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'quotedate', name: 'quotedate' },
        {
            data: 'request_type',
            name: 'request_type',
            render: function (data, type, row) {
                if (row.request_type == 1)
                    return 'Internal use';
                else if (row.request_type == 2)
                    return 'Department use';
                else if (row.request_type == 3)
                    return 'Personal Use';
                else if (row.request_type == 4)
                    return 'Project Purpose';
            }
        },

        {
            data: 'request_against',
            name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'BOQ';
                else if (row.request_against == 2)
                    return 'Non BOQ';
                else if (row.request_against == 3)
                    return 'Stock request';
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
            data: 'rfqstatus',
            name: 'rfqstatus',
        },

    ]
});


$('#internal_use_list').on('click', 'tbody td', function () {
    var data = internal_use_list.row(this).data();
    window.location.href = 'epr-detail-list?id=' + data.id;
});


var DeptTable = $('#DeptTable').DataTable({
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
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%'];
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
        "url": 'epr-rfq-list-department',
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
                return '#EPR-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'quotedate', name: 'quotedate' },
        {
            data: 'request_type',
            name: 'request_type',
            render: function (data, type, row) {
                if (row.request_type == 1)
                    return 'Internal use';
                else if (row.request_type == 2)
                    return 'Department use';
                else if (row.request_type == 3)
                    return 'Personal Use';
                else if (row.request_type == 4)
                    return 'Project Purpose';
            }
        },
        {
            data: 'request_against',
            name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'BOQ';
                else if (row.request_against == 2)
                    return 'Non BOQ';
                else if (row.request_against == 3)
                    return 'Stock request';
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
            data: 'rfqstatus',
            name: 'rfqstatus',
        },
    ]
});

$('#DeptTable').on('click', 'tbody td', function () {
    var data = DeptTable.row(this).data();
    window.location.href = 'epr-detail-list?id=' + data.id;
});

var personalTable = $('#personalTable').DataTable({
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
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%'];
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
        "url": 'epr-rfq-list-personal',
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
                return '#EPR-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'quotedate', name: 'quotedate' },
        {
            data: 'request_type',
            name: 'request_type',
            render: function (data, type, row) {
                if (row.request_type == 1)
                    return 'Internal use';
                else if (row.request_type == 2)
                    return 'Department use';
                else if (row.request_type == 3)
                    return 'Personal Use';
                else if (row.request_type == 4)
                    return 'Project Purpose';
            }
        },

        {
            data: 'request_against',
            name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'BOQ';
                else if (row.request_against == 2)
                    return 'Non BOQ';
                else if (row.request_against == 3)
                    return 'Stock request';
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
            data: 'rfqstatus',
            name: 'rfqstatus',
        },
    ]
});

$('#personalTable').on('click', 'tbody td', function () {
    var data = personalTable.row(this).data();
    window.location.href = 'epr-detail-list?id=' + data.id;
});

var projectTable = $('#projectTable').DataTable({
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
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%'];
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
        "url": 'epr-rfq-list-project',
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
                return '#EPR-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'quotedate', name: 'quotedate' },
        {
            data: 'request_type',
            name: 'request_type',
            render: function (data, type, row) {
                if (row.request_type == 1)
                    return 'Internal use';
                else if (row.request_type == 2)
                    return 'Department use';
                else if (row.request_type == 3)
                    return 'Personal Use';
                else if (row.request_type == 4)
                    return 'Project Purpose';
            }
        },

        {
            data: 'request_against',
            name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'BOQ';
                else if (row.request_against == 2)
                    return 'Non BOQ';
                else if (row.request_against == 3)
                    return 'Stock request';
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
            data: 'cust_name', name: 'cust_name', render: function (data, type, row) {
                var curData = row.cust_name;
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
            data: 'rfqstatus',
            name: 'rfqstatus',
        },
    ]
});

$('#projectTable').on('click', 'tbody td', function () {
    var data = projectTable.row(this).data();
    window.location.href = 'epr-detail-list?id=' + data.id;
});



$('.kt-wizard-v3__nav-item').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        internal_use_list.button('.buttons-print').trigger();
    else if (tbl == 2)
        DeptTable.button('.buttons-print').trigger();
    else if (tbl == 3)
        personalTable.button('.buttons-print').trigger();
    else if (tbl == 4)
        projectTable.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        internal_use_list.button('.buttons-print').trigger();
    else if (tbl == 2)
        DeptTable.button('.buttons-print').trigger();
    else if (tbl == 3)
        personalTable.button('.buttons-print').trigger();
    else if (tbl == 4)
        projectTable.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        internal_use_list.button('.buttons-copy').trigger();
    else if (tbl == 2)
        DeptTable.button('.buttons-copy').trigger();
    else if (tbl == 3)
        personalTable.button('.buttons-copy').trigger();
    else if (tbl == 4)
        projectTable.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        internal_use_list.button('.buttons-csv').trigger();
    else if (tbl == 2)
        DeptTable.button('.buttons-csv').trigger();
    else if (tbl == 3)
        personalTable.button('.buttons-csv').trigger();
    else if (tbl == 4)
        projectTable.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        internal_use_list.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        DeptTable.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        personalTable.button('.buttons-pdf').trigger();
    else if (tbl == 4)
        projectTable.button('.buttons-pdf').trigger();

});




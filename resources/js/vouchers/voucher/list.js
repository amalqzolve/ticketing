$('.voucherEntry').addClass('kt-menu__item--active');

var draft = $('#draft').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'vouchers',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id', name: 'id',
            render: function (data, type, row) {
                return 'VC ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'voucher_name', name: 'voucher_name' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'purchase_type', name: 'purchase_type',
            render: function (data, type, row) {
                if (row.purchase_type == 1)
                    return "Cash";
                else if (row.purchase_type == 2)
                    return "Credit";
                else
                    return "-";
            }
        },
        { data: 'bill_id', name: 'bill_id' },
        { data: 'quotedate', name: 'quotedate' },
        { data: 'entrydate', name: 'entrydate' },
        { data: 'po_wo_ref', name: 'po_wo_ref' },
        { data: 'purchaser', name: 'purchaser' },
        { data: 'totalamount', name: 'totalamount' },
        { data: 'totalvatamount', name: 'totalvatamount' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'paidamount', name: 'paidamount' },
        { data: 'balanceamount', name: 'balanceamount' },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                            </span></li></a>\
                            <a href="voucher-edit-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item send_req" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                            </span></li></a>';
                }
                if (row.status == 2) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 3) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 4) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';

                }
                if (row.status == 5 || row.status == 6) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 0) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                            </span></li></a>';

                }
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">'+ j + '\
                           </ul></div></div></span>';
            }
        },
    ]
});

// 

var draft = $('#sendTbl').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'vouchers-send-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id', name: 'id',
            render: function (data, type, row) {
                return 'VC ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'voucher_name', name: 'voucher_name' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'purchase_type', name: 'purchase_type',
            render: function (data, type, row) {
                if (row.purchase_type == 1)
                    return "Cash";
                else if (row.purchase_type == 2)
                    return "Credit";
                else
                    return "-";
            }
        },
        { data: 'bill_id', name: 'bill_id' },
        { data: 'quotedate', name: 'quotedate' },
        { data: 'entrydate', name: 'entrydate' },
        { data: 'po_wo_ref', name: 'po_wo_ref' },
        { data: 'purchaser', name: 'purchaser' },
        { data: 'totalamount', name: 'totalamount' },
        { data: 'totalvatamount', name: 'totalvatamount' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'paidamount', name: 'paidamount' },
        { data: 'balanceamount', name: 'balanceamount' },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                            </span></li></a>\
                            <a href="voucher-edit-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item send_req" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                            </span></li></a>';
                }
                if (row.status == 2) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 3) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 4) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';

                }
                if (row.status == 5 || row.status == 6) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 0) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                            </span></li></a>';

                }
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">'+ j + '\
                           </ul></div></div></span>';
            }
        },
    ]
});
// 

var draft = $('#approvedTbl').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'vouchers-approved',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id', name: 'id',
            render: function (data, type, row) {
                return 'VC ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'voucher_name', name: 'voucher_name' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'purchase_type', name: 'purchase_type',
            render: function (data, type, row) {
                if (row.purchase_type == 1)
                    return "Cash";
                else if (row.purchase_type == 2)
                    return "Credit";
                else
                    return "-";
            }
        },
        { data: 'bill_id', name: 'bill_id' },
        { data: 'quotedate', name: 'quotedate' },
        { data: 'entrydate', name: 'entrydate' },
        { data: 'po_wo_ref', name: 'po_wo_ref' },
        { data: 'purchaser', name: 'purchaser' },
        { data: 'totalamount', name: 'totalamount' },
        { data: 'totalvatamount', name: 'totalvatamount' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'paidamount', name: 'paidamount' },
        { data: 'balanceamount', name: 'balanceamount' },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                            </span></li></a>\
                            <a href="voucher-edit-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item send_req" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                            </span></li></a>';
                }
                if (row.status == 2) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 3) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 4) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';

                }
                if (row.status == 5 || row.status == 6) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 0) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                            </span></li></a>';

                }
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">'+ j + '\
                           </ul></div></div></span>';
            }
        },
    ]
});
// 

var draft = $('#rejectedTbl').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'vouchers-rejected',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id', name: 'id',
            render: function (data, type, row) {
                return 'VC ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'voucher_name', name: 'voucher_name' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'purchase_type', name: 'purchase_type',
            render: function (data, type, row) {
                if (row.purchase_type == 1)
                    return "Cash";
                else if (row.purchase_type == 2)
                    return "Credit";
                else
                    return "-";
            }
        },
        { data: 'bill_id', name: 'bill_id' },
        { data: 'quotedate', name: 'quotedate' },
        { data: 'entrydate', name: 'entrydate' },
        { data: 'po_wo_ref', name: 'po_wo_ref' },
        { data: 'purchaser', name: 'purchaser' },
        { data: 'totalamount', name: 'totalamount' },
        { data: 'totalvatamount', name: 'totalvatamount' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'paidamount', name: 'paidamount' },
        { data: 'balanceamount', name: 'balanceamount' },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                            </span></li></a>\
                            <a href="voucher-edit-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item send_req" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                            </span></li></a>';
                }
                if (row.status == 2) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 3) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 4) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';

                }
                if (row.status == 5 || row.status == 6) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                        </span></li></a>';
                }
                if (row.status == 0) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                            </span></li></a>\
                            <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                            </span></li></a>';

                }
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">'+ j + '\
                           </ul></div></div></span>';
            }
        },
    ]
});



$(document).on('click', '.send_req', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this vouchers For Approval",
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
                url: "vouchers-send",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        loaderClose();
                        toastr.success('voucher Send for Approval successfuly');
                        window.location.href = "vouchers";
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



$(document).on('click', '.viewSynHistory', function () {
    var id = $(this).attr('id');
    $('.statusDiv').html('');
    $.ajax({
        type: "POST",
        url: "get-voucher-approval-history",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
        },
        success: function (data) {
            if (data.status == 1) {

                var timeLine = '<ul class="timeline" id="timeline">';
                $.each(data.data, function (key, val) {
                    var status = '';
                    var curClass = '';
                    var timeOfAction = "";
                    if (val.status == 0) {
                        status = 'waiting ';
                        curClass = '';
                        timeOfAction = '----';
                    }
                    else if (val.status == 1) {
                        status = 'Pending ';
                        curClass = '';
                        timeOfAction = '&nbsp;&nbsp;';

                    }
                    else if (val.status == 2) {
                        status = 'Approved ';
                        curClass = 'complete';//
                        timeOfAction = val.status_changed;
                    }
                    else if (val.status == 3) {
                        status = 'Returned ';
                        curClass = 'returned';
                        timeOfAction = val.status_changed;
                    }
                    else if (val.status == 4) {
                        status = 'Rejected ';
                        curClass = 'rejected';
                        timeOfAction = val.status_changed;
                    }

                    timeLine = timeLine + '<li class="li ' + curClass + '">\
                                        <div class="timestamp text-center">\
                                            <span class="author">'+ val.name + '</span>\
                                            <span class="date">'+ timeOfAction + '<span>\
                                        </div>\
                                        <div class="status pt-4 mb-3">\
                                            <h4> '+ status + ' </h4>\
                                        </div>\
                                        </li>';
                });
                timeLine = timeLine + '</ul>';
                $('.statusDiv').html(timeLine);

                $('#modelProgress').modal('toggle');
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
});


$('.kt-wizard-v3__nav-item').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        draft.button('.buttons-print').trigger();
    else if (tbl == 2)
        sendTbl.button('.buttons-print').trigger();
    else if (tbl == 3)
        approvedTbl.button('.buttons-print').trigger();
    else if (tbl == 4)
        rejectedTbl.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        draft.button('.buttons-print').trigger();
    else if (tbl == 2)
        sendTbl.button('.buttons-print').trigger();
    else if (tbl == 3)
        approvedTbl.button('.buttons-print').trigger();
    else if (tbl == 4)
        rejectedTbl.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        draft.button('.buttons-copy').trigger();
    else if (tbl == 2)
        sendTbl.button('.buttons-copy').trigger();
    else if (tbl == 3)
        approvedTbl.button('.buttons-copy').trigger();
    else if (tbl == 4)
        rejectedTbl.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        draft.button('.buttons-csv').trigger();
    else if (tbl == 2)
        sendTbl.button('.buttons-csv').trigger();
    else if (tbl == 3)
        approvedTbl.button('.buttons-csv').trigger();
    else if (tbl == 4)
        rejectedTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        draft.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        sendTbl.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        approvedTbl.button('.buttons-pdf').trigger();
    else if (tbl == 4)
        rejectedTbl.button('.buttons-pdf').trigger();

});





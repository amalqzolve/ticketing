$('.supplierQuotation').addClass('kt-menu__item--active');
var boqListTable = $('#internal_use_list').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    }
    ],

    ajax: {
        "url": 'supplier-quotation',
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
                return '#EPR-' + row.epr_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return '#RFQ-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'rfq_date', name: 'rfq_date' },
        { data: 'supp_quot_id', name: 'supp_quot_id' },
        { data: 'quot_date', name: 'quot_date' },
        { data: 'quote_valid_date', name: 'quote_valid_date' },
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
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: green">Quote Submited</span>';
                if (row.status == 3)
                    return '<span style="color: blue">Send</span>';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-edit?id=' + row.id + '"  data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                    </span></li></a>\
                    <a href="#" data-target="#kt_form" ><li class="kt-nav__item send" id="' + row.id + '">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Send</span>\
                    </span></li></a>';
                }
                if (row.status == 2) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-generate-po?id=' + row.id + '" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate PO</span>\
                    </span></li></a>';
                }
                if (row.status == 3) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-submit?id=' + row.id + '" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Submit</span>\
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


var nonboqListTable = $('#quotCampare').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    }
    ],

    ajax: {
        "url": 'supplier-quotation-compare',
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
                return '#RFQ-' + row.id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return '#EPR-' + row.epr_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'rfq_date', name: 'rfq_date' },
        // 'epr_rfq.','epr_rfq.','epr_rfq.'
        {
            data: 'totalamount',
            name: 'totalamount',
        },
        {
            data: 'discount',
            name: 'discount',
        },
        {
            data: 'amountafterdiscount',
            name: 'amountafterdiscount',
        },
        {
            data: 'totalvatamount',
            name: 'totalvatamount',
        },
        {
            data: 'grandtotalamount',
            name: 'grandtotalamount',
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-edit?id=' + row.id + '"  data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                    </span></li></a>\
                    <a href="#" data-target="#kt_form" ><li class="kt-nav__item send" id="' + row.id + '">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Send</span>\
                    </span></li></a>';
                }
                if (row.status == 2) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-generate-po?id=' + row.id + '" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate PO</span>\
                    </span></li></a>';
                }
                if (row.status == 3) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-submit?id=' + row.id + '" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Submit</span>\
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



var stockRequestTable = $('#groupByTable').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    }
    ],

    ajax: {
        "url": 'supplier-quotation-group',
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
            data: 'project', name: 'project', render: function (data, type, row) {
                var curData = row.project;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        // {
        //     data: 'action',
        //     name: 'action',
        //     render: function (data, type, row) {
        //         var j = '';
        //         // if (row.status == 1) {
        //         j = '<a href="epr-detail-list?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
        //             <span class="kt-nav__link">\
        //             <i class="kt-nav__link-icon flaticon2-file-1"></i>\
        //             <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
        //             </span></li></a>';
        //         // }
        //         return '<span style="overflow: visible; position: relative; width: 80px;">\
        //     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
        //                 <i class="fa fa-cog"></i></a>\
        //                 <div class="dropdown-menu dropdown-menu-right">\
        //                 <ul class="kt-nav">'+ j + '\
        //                </ul></div></div></span>';
        //     }
        // },
    ]
});



$(document).on('click', '.send', function () {
    var id = $(this).attr('id');
    alert(id);
    swal.fire({
        title: "Are you sure?",
        text: "Send this RFQ !!",
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
                url: "send-rfq",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('RFQ Send successfuly');
                        window.location.href = "supplier-quotation";
                    } else
                        toastr.error(data.msg);

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

$('#groupByTable tbody').on('click', 'tr td:eq(0)', function () {
    alert(1)
});

$('#groupByTable').on('click', 'tbody td', function () {
    var data = stockRequestTable.row(this).data();
    window.location.href = 'quote-comparison-detail-list?id=' + data.id;
});






$('.kt-wizard-v3__nav-item').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-print').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-print').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-copy').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-copy').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-copy').trigger();
});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-csv').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-csv').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-pdf').trigger();
});










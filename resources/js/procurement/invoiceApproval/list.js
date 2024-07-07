$('.invoiceApproveList').addClass('kt-menu__item--active');
var actionTbl = $('#actionTbl').DataTable({
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
        "url": 'epr-po-invoice-approve-list',
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
                return 'S-INV ' + row.invoice_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'created_at', name: 'created_at' },
        {
            data: 'sup_name', name: 'sup_name', render: function (data, type, row) {
                var curData = row.sup_name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'supplier_invoice_number', name: 'supplier_invoice_number' },
        { data: 'supplier_invoice_date', name: 'supplier_invoice_date' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'booked_amount', name: 'booked_amount' },
        {
            data: 'po_id', name: 'po_id',
            render: function (data, type, row) {
                return 'PO# ' + row.po_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'po_date', name: 'po_date' },
        {
            data: 'request_type', name: 'request_type',
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
            data: 'invoice_status',
            name: 'invoice_status',
            render: function (data, type, row) {
                if (row.invoice_status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.invoice_status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.invoice_status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.invoice_status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.invoice_status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.invoice_status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.invoice_status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },

        {
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Approval Pending</span>';
                if (row.status == 2)
                    return '<span style="color: green">Returned</span>';
                if (row.status == 3)
                    return '<span style="color: red">Rejected</span>';

            }
        },

        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {//approval pending
                    j = '<a href="epr-po-invoice-pdf?id=' + row.invoice_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.invoice_id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.invoice_id + '&type=S-INV" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.invoice_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.invoice_id + '" id=' + row.invoice_id + '>Synthesis Milestone </span>\
                        </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item approve_btn" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + ' > Approve </span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form"><li class="kt-nav__item return_btn" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Revise</span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item reject_btn" id=' + row.id + ' >\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Reject</span>\
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

var oldActionTbl = $('#oldActionTbl').DataTable({
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
        "url": 'epr-po-invoice-approved-list',
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
                return 'S-INV ' + row.invoice_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'created_at', name: 'created_at' },
        {
            data: 'sup_name', name: 'sup_name', render: function (data, type, row) {
                var curData = row.sup_name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'supplier_invoice_number', name: 'supplier_invoice_number' },
        { data: 'supplier_invoice_date', name: 'supplier_invoice_date' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'booked_amount', name: 'booked_amount' },
        {
            data: 'po_id', name: 'po_id',
            render: function (data, type, row) {
                return 'PO# ' + row.po_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'po_date', name: 'po_date' },
        {
            data: 'request_type', name: 'request_type',
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
            data: 'invoice_status',
            name: 'invoice_status',
            render: function (data, type, row) {
                if (row.invoice_status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.invoice_status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.invoice_status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.invoice_status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.invoice_status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.invoice_status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.invoice_status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },

        {
            data: 'last_action',
            name: 'last_action',
            render: function (data, type, row) {
                if (row.last_action == 1)
                    return '<span style="color: black">Approval Pending</span>';
                else if (row.last_action == 2)
                    return '<span style="color: green">Approved</span>';
                else if (row.last_action == 3)
                    return '<span style="color: red">returned</span>';
                else if (row.last_action == 4)
                    return '<span style="color: red">rejected</span>';
                else return row.last_action;

            }
        },

        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {

                var j = ' <a href="epr-po-invoice-pdf?id=' + row.invoice_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.invoice_id + '&type=S-INV" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.invoice_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.invoice_id + '" id=' + row.invoice_id + '>Synthesis Milestone </span>\
                        </span></li></a>';
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



$(document).on('click', '.approve_btn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Approve this Invoice",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Approve",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            loaderShow();
            $.ajax({
                type: "POST",
                url: "po-invoice-approve",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('Invoice  Approved successfuly');
                        window.location.href = "epr-po-invoice-approve-list";
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


$(document).on('click', '.return_btn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want return this Invoice for revice",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Revice",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            loaderShow();
            $.ajax({
                type: "POST",
                url: "po-invoice-return",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('EPR Resubmited successfuly');
                        window.location.href = "epr-po-invoice-approve-list";
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

$(document).on('click', '.reject_btn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this Invoice",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Reject",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            loaderShow();
            $.ajax({
                type: "POST",
                url: "po-invoice-reject",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('EPR Rejected successfuly');
                        window.location.href = "epr-po-invoice-approve-list";
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



$(document).on('click', '.viewSynHistory', function () {
    var id = $(this).attr('id');
    $('.statusDiv').html('');
    $.ajax({
        type: "POST",
        url: "get-invoice-approval-history",
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
        actionTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        oldActionTbl.button('.buttons-print').trigger();


});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        oldActionTbl.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTbl.button('.buttons-copy').trigger();
    else if (tbl == 2)
        oldActionTbl.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTbl.button('.buttons-csv').trigger();
    else if (tbl == 2)
        oldActionTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTbl.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        oldActionTbl.button('.buttons-pdf').trigger();
});






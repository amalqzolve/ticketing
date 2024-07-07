$('.stockInApproval').addClass('kt-menu__item--active');
var actionTble = $('#actionTble').DataTable({
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
        "url": 'epr-po-grn-stock-in-approval-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'stock_in_id',
            name: 'stock_in_id',
            render: function (data, type, row) {
                return 'S-IN ' + row.stock_in_id + '&nbsp;&nbsp;';
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
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Approval Pending</span>';
                if (row.status == 2)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 3)
                    return '<span style="color: blue">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {//approval pending
                    j = '<a href="epr-po-grn-stock-in-pdf?id=' + row.stock_in_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.stock_in_id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.stock_in_id + '&type=S-IN" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.stock_in_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.stock_in_id + '" id=' + row.stock_in_id + '>Synthesis Milestone </span>\
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


var oldActionTble = $('#oldActionTble').DataTable({
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
        "url": 'epr-po-grn-stock-in-approved-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'stock_in_id',
            name: 'stock_in_id',
            render: function (data, type, row) {
                return 'S-IN ' + row.stock_in_id + '&nbsp;&nbsp;';
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
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Approval Pending</span>';
                if (row.status == 2)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 3)
                    return '<span style="color: blue">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == '')
                    return '---';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                j = '<a href="epr-po-grn-stock-in-pdf?id=' + row.stock_in_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.stock_in_id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.stock_in_id + '&type=S-IN" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.stock_in_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.stock_in_id + '" id=' + row.stock_in_id + '>Synthesis Milestone </span>\
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
        text: "Do you want Approve this Stock in",
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
                url: "epr-po-grn-stock-in-approve",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('Stock in  Approved successfuly');
                        window.location.href = "epr-po-grn-stock-in-approval-list";
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
        text: "Do you want return this Stock in revice",
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
                url: "epr-po-grn-stock-in-return",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('Returnde for revice Stock successfuly');
                        window.location.href = "epr-po-grn-stock-in-approval-list";
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
        text: "Do you want Reject this Stock in",
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
                url: "epr-po-grn-stock-in-reject",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('Stock in Rejected successfuly');
                        window.location.href = "epr-po-grn-stock-in-approval-list";
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
        url: "get-stockin-approval-history",
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
        actionTble.button('.buttons-print').trigger();
    else if (tbl == 2)
        oldActionTble.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTble.button('.buttons-print').trigger();
    else if (tbl == 2)
        oldActionTble.button('.buttons-print').trigger();
});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTble.button('.buttons-copy').trigger();
    else if (tbl == 2)
        oldActionTble.button('.buttons-copy').trigger();
});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTble.button('.buttons-csv').trigger();
    else if (tbl == 2)
        oldActionTble.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        actionTble.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        oldActionTble.button('.buttons-pdf').trigger();

});







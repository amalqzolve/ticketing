$('.approval').addClass('kt-menu__item--active');

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
        "url": 'tender-approve-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'tender_id', name: 'tender_id',
            render: function (data, type, row) {
                return 'TNDR ' + row.tender_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'client', name: 'client', render: function (data, type, row) {
                var curData = row.client;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'project_name', name: 'project_name', render: function (data, type, row) {
                var curData = row.project_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'date_of_submission', name: 'date_of_submission' },
        { data: 'date_of_release', name: 'date_of_release' },
        { data: 'bid_extension_date', name: 'bid_extension_date' },
        { data: 'bid_submission_date', name: 'bid_submission_date' },
        {
            data: 'bid_bond', name: 'bid_bond', render: function (data, type, row) {
                var curData = row.bid_bond;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'consultant', name: 'consultant', render: function (data, type, row) {
                var curData = row.consultant;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'scope_of_work', name: 'scope_of_work', render: function (data, type, row) {
                var curData = row.scope_of_work;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },

        // {
        //     data: 'tender_status', name: 'tender_status',
        //     render: function (data, type, row) {
        //         if (row.tender_status == 1)
        //             return '<span style="color: black">Draft</span>';
        //         if (row.tender_status == 2)
        //             return '<span style="color: blue">Send</span>';
        //         if (row.tender_status == 3)
        //             return '<span style="color: orange">Returned</span>';
        //         if (row.tender_status == 4)
        //             return '<span style="color: red">Rejected</span>';
        //         if (row.tender_status == 5)
        //             return '<span style="color: blue">Resubmited</span>';
        //         if (row.tender_status == 6)
        //             return '<span style="color: green">Approved</span>';
        //         if (row.tender_status == 0)
        //             return '<span style="color: red">Trashed</span>';
        //     }
        // },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {//approval pending
                    j = '<a href="tender-pdf?id=' + row.tender_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="../suggestion-send?id=' + row.tender_id + '&type=TNDR" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text">Suggestion</span>\
                        </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.tender_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.tender_id + '" id=' + row.tender_id + '>Synthesis Milestone </span>\
                        </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item approveBtn" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + ' > Approve </span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item rejectBtn" id=' + row.id + ' >\
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


var pendingTbl = $('#approvedTbl').DataTable({
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
        "url": 'tender-approved-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'tender_id', name: 'tender_id',
            render: function (data, type, row) {
                return 'TNDR ' + row.tender_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'client', name: 'client', render: function (data, type, row) {
                var curData = row.client;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'project_name', name: 'project_name', render: function (data, type, row) {
                var curData = row.project_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'date_of_submission', name: 'date_of_submission' },
        { data: 'date_of_release', name: 'date_of_release' },
        { data: 'bid_extension_date', name: 'bid_extension_date' },
        { data: 'bid_submission_date', name: 'bid_submission_date' },
        {
            data: 'bid_bond', name: 'bid_bond', render: function (data, type, row) {
                var curData = row.bid_bond;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'consultant', name: 'consultant', render: function (data, type, row) {
                var curData = row.consultant;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'scope_of_work', name: 'scope_of_work', render: function (data, type, row) {
                var curData = row.scope_of_work;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        // { data: 'heyrarchy', name: 'heyrarchy' },
        {
            data: 'heyrarchy', name: 'heyrarchy',
            render: function (data, type, row) {
                if (row.heyrarchy == 2)
                    return '<span style="color: green">Approved</span>';
                if (row.heyrarchy == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.heyrarchy == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.heyrarchy == 5)
                    return '<span style="color: blue">Resubmited</span>';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                j = '<a href="tender-pdf?id=' + row.tender_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="../suggestion-send?id=' + row.tender_id + '&type=TNDR" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text">Suggestion</span>\
                        </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.tender_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.tender_id + '" id=' + row.tender_id + '>Synthesis Milestone </span>\
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




$(document).on('click', '.approveBtn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Approve this Tender",
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
                url: "tender-approve",
                dataType: "text",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data == 1) {
                        loaderClose();
                        toastr.success('Tender Approved successfuly');
                        window.location.href = "tender-approve-list";
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



$(document).on('click', '.rejectBtn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this Tender",
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
                url: "tender-reject",
                dataType: "text",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data == 1) {
                        loaderClose();
                        toastr.success('Tender Rejected successfuly');
                        window.location.href = "tender-approve-list";
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
        url: "get-tender-approval-history",
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
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-print').trigger();


});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-copy').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-csv').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-pdf').trigger();

});







$('.eprApproval').addClass('kt-menu__item--active');
var pendingTbl = $('#pending').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    }
    ],

    ajax: {
        "url": 'epr-approval',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'epr_id',
            name: 'epr_id',
            render: function (data, type, row) {
                return '#EPR-' + row.epr_id + '&nbsp;&nbsp;';
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
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'heyrarchy', name: 'heyrarchy', render: function (data, type, row) {
                var curData = row.heyrarchy;
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
                    return '<span style="color: blue">Approval Pending</span>';
                if (row.status == 2)
                    return '<span style="color: green">Re submitted</span>';
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
                    j = '<a href="epr_view?id=' + row.epr_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.epr_id + '&type=epr" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a href="epr-pocess-list?id=' + row.epr_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.epr_id + '" >Process Milestone </span>\
                        </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.epr_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.epr_id + '" id=' + row.epr_id + '>Synthesis Milestone </span>\
                        </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item epr_approve" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + ' > Approve </span>\
                        </span></li></a>\
                    <a data-type="edit" data-target="#kt_form"><li class="kt-nav__item epr_resubmit" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Revise</span>\
                        </span></li></a>\
                    <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item epr_reject" id=' + row.id + ' >\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Reject</span>\
                        </span></li></a>';
                }

                j = j + '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item commentspoup" data-id="EPR" id=' + row.epr_id + '>\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon-comment"></i>\
                <span class="kt-nav__link-text" data-id="' + row.epr_id + '" id=' + row.epr_id + '>Comments</span>\
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
    order: [[1, 'desc']],
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
        "url": 'epr-approval-done',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'epr_id',
            name: 'epr_id',
            render: function (data, type, row) {
                return '#EPR-' + row.epr_id + '&nbsp;&nbsp;';
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
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
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
                if (row.status == 0)
                    return '<span >Waiting</span>';
                if (row.status == 1)
                    return '<span style="color: blue">Approval Pending</span>';
                else if (row.status == 2)
                    return '<span style="color: green">Approved</span>';
                else if (row.status == 3)
                    return '<span style="color: yellow">Returned</span>';
                else if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                else
                    return '';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '<a href="epr_view?id=' + row.epr_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.epr_id + '&type=epr" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a href="epr-pocess-list?id=' + row.epr_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.epr_id + '" >Process Milestone </span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.epr_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.epr_id + '" id=' + row.epr_id + '>Synthesis Milestone </span>\
                        </span></li></a>';

                j = j + '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item commentspoup" data-id="EPR" id=' + row.epr_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-comment"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.epr_id + '" id=' + row.epr_id + '>Comments</span>\
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



$(document).on('click', '.epr_approve', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Approve this EPR",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Approve",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            loaderShow();
            swal.fire({
                title: 'Submit your Comments',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Approve',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == '') {
                        swal.showValidationMessage(
                            `Enter A Comment First: `
                        )
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "epr-approve",
                            dataType: "json",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                loaderClose();
                                if (data.status == 1) {
                                    toastr.success('EPR Approved successfuly');
                                    window.location.href = "epr-approval";
                                } else
                                    toastr.error(data.msg);
                            },
                            error: function (jqXhr, json, errorThrown) {
                                console.log('Error !!');
                            }
                        });

                    }

                },
            })
        } else {
            swal.fire("Cancelled", "", "error");
        }
    })
});


$(document).on('click', '.epr_resubmit', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want return for Revice this EPR",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Revice",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {


            swal.fire({
                title: 'Submit your Comments',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Revice',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == '') {
                        swal.showValidationMessage(
                            `Enter A Comment First: `
                        )
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "epr-resubmit",
                            dataType: "json",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                loaderClose();
                                if (data.status == 1) {
                                    toastr.success('EPR Returned for resubmit successfuly');
                                    window.location.href = "epr-approval";
                                } else
                                    toastr.error(data.msg);

                            },
                            error: function (jqXhr, json, errorThrown) {
                                console.log('Error !!');
                            }
                        });

                    }

                },
            })


        } else {
            swal.fire("Cancelled", "", "error");
        }
    })
});

$(document).on('click', '.epr_reject', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this EPR",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Reject",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            swal.fire({
                title: 'Submit your Comments',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Reject',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == '') {
                        swal.showValidationMessage(
                            `Enter A Comment First: `
                        )
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "epr-reject",
                            dataType: "json",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                loaderClose();
                                if (data.status == 1) {
                                    toastr.success('EPR Rejected successfuly');
                                    window.location.href = "epr-approval";
                                } else
                                    toastr.error(data.msg);

                            },
                            error: function (jqXhr, json, errorThrown) {
                                console.log('Error !!');
                            }
                        });

                    }

                },
            })

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
        url: "get-epr-approval-history",
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
                        // status = 'Approved ';
                        status = val.if_accepted_note;
                        curClass = 'complete';//
                        timeOfAction = val.status_changed;
                    }
                    else if (val.status == 3) {
                        status = 'Returned ';
                        curClass = 'returned';
                        timeOfAction = val.status_changed;
                    }
                    else if (val.status == 4) {
                        // status = 'Rejected ';
                        status = val.if_rejected_note;
                        curClass = 'rejected';
                        timeOfAction = val.status_changed;
                    }
                    var comments = val.comments;
                    if ((val.comments != '') && (val.comments != null))
                        comments = val.comments;
                    else
                        comments = '';
                    timeLine = timeLine + '<li class="li ' + curClass + '">\
                                        <div class="timestamp text-center">\
                                            <span class="author">'+ val.name + '</span>\
                                            <span class="date">'+ timeOfAction + '<span>\
                                            <br/><span class="date">'+ comments + '<span>\
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

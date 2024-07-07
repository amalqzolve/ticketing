$('.approval-list').addClass('kt-menu__item--active');
var boqListTable = $('#pendingTbl').DataTable({
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
        "url": 'request-approval-list',
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
                return '#REQ-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'request_tittle', name: 'request_tittle' },
        { data: 'required_on', name: 'required_on' },
        {
            data: 'request_priority',
            name: 'request_priority',
            render: function (data, type, row) {
                if (row.request_priority == 1)
                    return 'Low';
                else if (row.request_priority == 2)
                    return 'Medium';
                else if (row.request_priority == 3)
                    return 'High';
                else if (row.request_priority == 4)
                    return 'Top Priority';
                else
                    return '';
            }




        },

        {
            data: 'request_against',
            name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'Personal';
                else if (row.request_against == 2)
                    return 'Client';
                else if (row.request_against == 3)
                    return 'Project';
                else if (row.request_against == 4)
                    return 'Department';
                else if (row.request_against == 5)
                    return 'Official';
                else
                    return '';
            }
        },
        { data: 'name', name: 'name' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                j = '<a href="request-pdf/' + row.enc_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.req_id + '" >PDF</span>\
                        </span></li></a>';

                j += '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.req_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.req_id + '" id=' + row.req_id + '>Synthesis Milestone </span>\
                        </span></li></a>';

                j += '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item request_approve" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a>';

                j += '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item request_revise" id=' + row.id + ' >\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Revise</span>\
                        </span></li></a>';

                j += '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item request_reject" id=' + row.id + ' >\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Reject</span>\
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
        "url": 'request-approval-list-done',
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
                return '#REQ-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'request_tittle', name: 'request_tittle' },
        { data: 'required_on', name: 'required_on' },
        {
            data: 'request_priority',
            name: 'request_priority',
            render: function (data, type, row) {
                if (row.request_priority == 1)
                    return 'Low';
                else if (row.request_priority == 2)
                    return 'Medium';
                else if (row.request_priority == 3)
                    return 'High';
                else if (row.request_priority == 4)
                    return 'Top Priority';
                else
                    return '';
            }




        },

        {
            data: 'request_against',
            name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'Personal';
                else if (row.request_against == 2)
                    return 'Client';
                else if (row.request_against == 3)
                    return 'Project';
                else if (row.request_against == 4)
                    return 'Department';
                else if (row.request_against == 5)
                    return 'Official';
                else
                    return '';
            }
        },
        { data: 'name', name: 'name' },
        {
            data: 'last_action', name: 'last_action', render: function (data, type, row) {
                if (row.last_action == 0)
                    return '<span >Waiting</span>';
                if (row.last_action == 1)
                    return '<span style="color: blue">Approval Pending</span>';
                else if (row.last_action == 2)
                    return '<span style="color: green">Approved</span>';
                else if (row.last_action == 3)
                    return '<span style="color: yellow">Returned</span>';
                else if (row.last_action == 4)
                    return '<span style="color: red">Rejected</span>';
                else
                    return '';

            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                j = '<a href="request-pdf/' + row.enc_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.req_id + '" >PDF</span>\
                        </span></li></a>';

                j += '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.req_id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.req_id + '" id=' + row.req_id + '>Synthesis Milestone </span>\
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



$(document).on('click', '.request_approve', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Approve this Request",
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
                            url: "request-approve",
                            dataType: "json",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    loaderClose();
                                    toastr.success('Request Approved successfuly');
                                    window.location.href = "request-approval-list";
                                }

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



$(document).on('click', '.request_revise', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want return for Revice this Request",
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
                        loaderShow();
                        $.ajax({
                            type: "POST",
                            url: "request-revise",
                            dataType: "text",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                if (data == 1) {
                                    toastr.success('Request Returned for resubmit successfuly');
                                    window.location.href = "request-approval-list";
                                }
                                loaderClose();
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

$(document).on('click', '.request_reject', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this Request",
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
                        loaderShow();
                        $.ajax({
                            type: "POST",
                            url: "request-reject",
                            dataType: "text",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                if (data == 1) {
                                    toastr.success('Request Rejected successfuly');
                                    window.location.href = "request-approval-list";
                                }
                                loaderClose();
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
        url: "get-request-approval-history",
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
                        // status = 'waiting ';
                        if (val.approve_type == 1)
                            status = 'waiting Approval';
                        else if (val.approve_type == 2)
                            status = 'waiting Notification ';
                        curClass = 'complete';//
                        timeOfAction = val.status_changed;
                        curClass = '';
                        timeOfAction = '----';
                    }
                    else if (val.status == 1) {
                        status = 'Pending Approval';
                        curClass = '';
                        timeOfAction = '&nbsp;&nbsp;';

                    }
                    else if (val.status == 2) {
                        // status = 'Approved ';
                        // status = val.if_accepted_note;
                        if (val.approve_type == 1)
                            status = 'Approved';
                        else if (val.approve_type == 2)
                            status = 'Notified';
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
                    var comments = val.comment;
                    if ((val.comment != '') && (val.comment != null))
                        comments = val.comment;
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
        boqListTable.button('.buttons-print').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-print').trigger();
    else if (tbl == 4)
        rejectedTable.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-print').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-print').trigger();
    else if (tbl == 4)
        rejectedTable.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-copy').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-copy').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-copy').trigger();
    else if (tbl == 4)
        rejectedTable.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-csv').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-csv').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-csv').trigger();
    else if (tbl == 4)
        rejectedTable.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTable.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        nonboqListTable.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-pdf').trigger();
    else if (tbl == 4)
        rejectedTable.button('.buttons-pdf').trigger();

});


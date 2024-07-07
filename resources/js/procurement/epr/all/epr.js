$('.eprList').addClass('kt-menu__item--open');
$('.all-material-request').addClass('kt-menu__item--active');
var boqListTbl = $('#boq_list').DataTable({
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
        "url": 'all-material-request',
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
            data: 'client', name: 'client', render: function (data, type, row) {
                var curData = row.client;
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
                var j = '<a href="epr_view?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="suggestion-send?id=' + row.id + '&type=epr" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text">Suggestion</span>\
                    </span></li></a>\
                    <a href="epr-pocess-list?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Process Milestone </span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                    </span></li></a>\
                    <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item commentspoup" data-id="EPR" id=' + row.id + '>\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-comment"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Comments</span>\
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


var nonboqListTbl = $('#nonBoqTable').DataTable({
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
        "url": 'all-list-non-boq',
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
            data: 'client', name: 'client', render: function (data, type, row) {
                var curData = row.client;
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
                var j = '<a href="epr_view?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                </span></li></a>\
                <a href="suggestion-send?id=' + row.id + '&type=epr" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text">Suggestion</span>\
                </span></li></a>\
                <a href="epr-pocess-list?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >Process Milestone </span>\
                </span></li></a>\
                <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                </span></li></a>\
                <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item commentspoup" data-id="EPR" id=' + row.id + '>\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon-comment"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Comments</span>\
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


var stockRequestTbl = $('#stockRequestTable').DataTable({
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
        "url": 'all-list-stock-req',
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
            data: 'client', name: 'client', render: function (data, type, row) {
                var curData = row.client;
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
                var j = '<a href="epr_view?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                </span></li></a>\
                <a href="suggestion-send?id=' + row.id + '&type=epr" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text">Suggestion</span>\
                </span></li></a>\
                <a href="epr-pocess-list?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >Process Milestone </span>\
                </span></li></a>\
                <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone </span>\
                </span></li></a>\
                <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item commentspoup" data-id="EPR" id=' + row.id + '>\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon-comment"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Comments</span>\
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
        boqListTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        nonboqListTbl.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTbl.button('.buttons-print').trigger();
});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTbl.button('.buttons-copy').trigger();
    else if (tbl == 2)
        nonboqListTbl.button('.buttons-copy').trigger();
    else if (tbl == 3)
        stockRequestTbl.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTbl.button('.buttons-csv').trigger();
    else if (tbl == 2)
        nonboqListTbl.button('.buttons-csv').trigger();
    else if (tbl == 3)
        stockRequestTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        boqListTbl.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        nonboqListTbl.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        stockRequestTbl.button('.buttons-pdf').trigger();
});




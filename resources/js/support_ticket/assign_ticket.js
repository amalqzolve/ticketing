var assigndtickets;
var delegadtickets;

$(function () {
    $("#asigntickt_status").select2({ tags: true });
    $(".kt-selectpicker").select2();

    /**
     * Details : Assigned Tickets
     * Date    : 15-12-2022
     */
    assigndtickets = $('#assigntickets_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
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
            customize: function (doc) {
                doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                doc.content[1].table.widths = ['10%', '30%', '15%', '15%', '20%', '5%', '5%'];
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
            "url": 'assign_ticket',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {
                data: 'ticketID', name: 'ticketID',
                render: function (data, type, row) {
                    return '<a href="view_assignedticket?id=' + row.id + '&&asid=' + row.assignid + '" class="kt-nav__link">' + row.ticketID + '</a>';
                }
            },
            { data: 'ticket_date', name: 'ticket_date' },
            { data: 'cust_name', name: 'cust_name' },
            { data: 'ticket_title', name: 'ticket_title' },
            { data: 'due_date', name: 'due_date' },
            { data: 'expirydays', name: 'expirydays' },
            { data: 'present_status', name: 'present_status' },
            // { data: 'assignd_user', name: 'assignd_user' },
            {
                data: 'ticket_status', name: 'ticket_status',
                render: function (data, type, row) {
                    if (row.ticketstatus == "Open")
                        return "<span class='kt-badge kt-badge--inline kt-badge--success'>" + row.ticketstatus + "</span>";
                    else if (row.ticketstatus == "Closed")
                        return "<span class='kt-badge kt-badge--inline kt-badge--danger'>" + row.ticketstatus + "</span>";
                    else
                        return row.ticketstatus;
                }
            },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    if (row.delegation_flag == 0) {
                        return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                <i class="fa fa-cog"></i></a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                <ul class="kt-nav">\
                                    <li class="kt-nav__item updateticket_status" data-id=' + row.id + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>\
                                    <span class="kt-nav__link-text">Update Status</span>\
                                    </span></li>\
                                    <li class="kt-nav__item closeticket" data-id=' + row.id + ' data-asid=' + row.assignid + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-close"></i>\
                                    <span class="kt-nav__link-text">Close Ticket</span>\
                                    </span></li>\
                                    <li class="kt-nav__item delegateticket" data-id=' + row.id + ' data-asid=' + row.assignid + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-user-add"></i>\
                                    <span class="kt-nav__link-text">Delegate Ticket</span>\
                                    </span></li>\
                                    <li class="kt-nav__item">\
                                    <a href="view_assignedticket?id=' + row.id + '&&asid=' + row.assignid + '" class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-eye"></i>\
                                    <span class="kt-nav__link-text">View</span>\
                                    </a>\
                                </li>\
                                </ul></div></div></span>';
                    }
                    else if (row.delegation_flag == 2) {
                        return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                <i class="fa fa-cog"></i></a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                <ul class="kt-nav">\
                                    <li class="kt-nav__item updateticket_status" data-id=' + row.id + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>\
                                    <span class="kt-nav__link-text">Update Status</span>\
                                    </span></li>\
                                    <li class="kt-nav__item closeticket" data-id=' + row.id + ' data-asid=' + row.assignid + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-close"></i>\
                                    <span class="kt-nav__link-text">Close Ticket</span>\
                                    </span></li>\
                                    <li class="kt-nav__item">\
                                    <a href="view_assignedticket?id=' + row.id + '&&asid=' + row.assignid + '" class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-eye"></i>\
                                    <span class="kt-nav__link-text">View</span>\
                                    </a>\
                                </li>\
                                </ul></div></div></span>';
                    }
                    else {
                        return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                <i class="fa fa-cog"></i></a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                <ul class="kt-nav">\
                                    <li class="kt-nav__item updateticket_status" data-id=' + row.id + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>\
                                    <span class="kt-nav__link-text">Update Status</span>\
                                    </span></li>\
                                    <li class="kt-nav__item">\
                                        <a href="view_assignedticket?id=' + row.id + '&&asid=' + row.assignid + '" class="kt-nav__link">\
                                        <i class="kt-nav__link-icon flaticon-eye"></i>\
                                        <span class="kt-nav__link-text">View</span>\
                                        </a>\
                                    </li>\
                                </ul></div></div></span>';
                    }
                }
            },

        ]
    });

    /**
     * Details : Delegated Tickets
     * Date    : 15-12-2022
     */
    delegadtickets = $('#ticket_delegatedtbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
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
            customize: function (doc) {
                doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                doc.content[1].table.widths = ['10%', '30%', '15%', '15%', '20%', '5%', '5%'];
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
            "url": 'delegatd_ticket',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {
                data: 'ticketID', name: 'ticketID',
                render: function (data, type, row) {
                    return '<a href="view_delegatedticket?id=' + row.id + '" class="kt-nav__link">' + row.ticketID + '</a>';
                }
            },
            { data: 'ticket_date', name: 'ticket_date' },
            { data: 'cust_name', name: 'cust_name' },
            { data: 'ticket_title', name: 'ticket_title' },
            { data: 'due_date', name: 'due_date' },
            { data: 'expirydays', name: 'expirydays' },
            { data: 'present_status', name: 'present_status' },
            // { data: 'assignd_user', name: 'assignd_user' },
            {
                data: 'delgn_ticketstatus', name: 'delgn_ticketstatus',
                render: function (data, type, row) {
                    if (row.delgn_ticketstatus == "Open")
                        return "<span class='kt-badge kt-badge--inline kt-badge--success'>" + row.delgn_ticketstatus + "</span>";
                    else if (row.delgn_ticketstatus == "Closed")
                        return "<span class='kt-badge kt-badge--inline kt-badge--danger'>" + row.delgn_ticketstatus + "</span>";
                    else
                        return row.delgn_ticketstatus;
                }
            },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                <i class="fa fa-cog"></i></a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                <ul class="kt-nav">\
                                    <li class="kt-nav__item updateticket_status" data-id=' + row.id + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>\
                                    <span class="kt-nav__link-text">Update Status</span>\
                                    </span></li>\
                                    <li class="kt-nav__item dlgcloseticket" data-id=' + row.id + ' data-did=' + row.delgn_id + ' data-asid=' + row.delgn_assignid + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-close"></i>\
                                    <span class="kt-nav__link-text">Close Ticket</span>\
                                    </span></li>\
                                    <li class="kt-nav__item">\
                                    <a href="view_delegatedticket?id=' + row.id + '&&did=' + row.delgn_id + '&&asid=' + row.delgn_assignid + '" class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-eye"></i>\
                                    <span class="kt-nav__link-text">View</span>\
                                    </a>\
                                </li>\
                                </ul></div></div>\
                        </span>';
                }
            },

        ]
    });


}); // End DOM

/**
 * Detail : Update Ticket Status
 * Date   : 09-11-2022
 */
$(document).on('click', '.updateticket_status', function () {
    var ticketid = $(this).data('id');
    // var asignid  = $(this).data('asid');

    $("#asigntickt_tid").val(ticketid);
    // $("#asigntickt_aid").val(asignid);
    $("#updatestatus_modal").modal({ backdrop: 'static' });
    $("#updatestatus_modal").modal('show');
});

/**
 * Detail : Ticket Status Update
 * Date   : 30-11-2022
 */
$(document).on('click', '#ticketstatuss_update', function (e) {
    e.preventDefault();
    var id = $("#asigntickt_tid").val();
    // var assignid     = $("#asigntickt_aid").val();
    var st_date = $("#asigntickt_date").val();
    var status_id = $("#asigntickt_status").val();
    var present_stat = $("#asigntickt_presentstatus").val();
    var comments = $("#asigntickt_comments").val();

    if (st_date == '') {
        $('#asigntickt_date').addClass('is-invalid');
        toastr.warning('Date is required');
        return false;
    }
    else {
        $('#asigntickt_date').removeClass('is-invalid');
    }

    if (status_id == '') {
        $('#asigntickt_status').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Status is required');
        return false;
    }
    else {
        $('#asigntickt_status').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketstat_update",
        data: { iid: id, st_date: st_date, status_id: status_id, present_stat: present_stat, comments: comments, _token: $('#token').val()/*, assignid : assignid*/ },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;

            toastr[type](messg);

            window.location.href = 'assign_ticket';
        }
    });

});

/**
  * Detail : Close Ticket
  * Date   : 01-12-2022
  */
$(document).on('click', '.closeticket', function () {
    var ticketid = $(this).data('id');
    var assignid = $(this).data('asid');

    swal.fire({
        title: "Are you sure?",
        input: "text",
        inputPlaceholder: 'Enter your Comments...',
        text: "You will not be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, close ticket!",
        cancelButtonText: "No, cancel it!"
    }).then(function (result) {
        if (!result.dismiss) {
            var comment = result.value;

            $.ajax({
                type: "POST",
                // datatype: "JSON",
                url: "closeticket",
                data: { iid: ticketid, comment: comment, assignid: assignid, _token: $('#token').val() },
                success: function (rslt) {
                    swal.fire("Closed!", "Your Ticket Closed Sucessfully", "success");
                    location.reload();
                }
            });

        } else {
            swal.fire("Cancelled", "The request has been cancelled.", "error");
        }
    })

});

/**
 * Detail : Delegate Ticket
 * Date   : 03-12-2022
 */
$(document).on('click', '.delegateticket', function () {
    var ticketid = $(this).data('id');
    var assignmntid = $(this).data('asid');

    $("#delegate_ticktid").val(ticketid);
    $("#delegate_assignid").val(assignmntid);
    $("#delegateticket_modal").modal({ backdrop: 'static' });
    $("#delegateticket_modal").modal('show');
});

/**
  * Detail : Delegate Ticket Submit
  * Date   : 03-12-2022
  */
$(document).on('click', '#delegateticket_submit', function (e) {
    e.preventDefault();
    var id = $("#delegate_ticktid").val();
    var assignid = $("#delegate_assignid").val();
    var user_id = $("#delegate_user").val();
    var comments = $("#delegate_comments").val();

    if (user_id == '') {
        $('#delegate_user').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('User is required');
        return false;
    }
    else {
        $('#delegate_user').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "delegateticket_submit",
        data: { iid: id, assignid: assignid, user_id: user_id, comments: comments, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);

            var messg = obj.toast_msg;
            var type = obj.toast_stat;

            toastr[type](messg);

            location.reload();
        }
    });

});

/**
 * Detail : Close Tickets for Delegates
 * Date   : 15-12-2022
 */
$(document).on('click', '.dlgcloseticket', function () {
    var ticketid = $(this).data('id');
    var delgnid = $(this).data('did');
    var assgn_id = $(this).data('asid');

    swal.fire({
        title: "Are you sure?",
        input: "text",
        inputPlaceholder: 'Enter your Comments...',
        text: "You will not be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, close ticket!",
        cancelButtonText: "No, cancel it!"
    }).then(function (result) {
        if (!result.dismiss) {
            var comment = result.value;

            $.ajax({
                type: "POST",
                // datatype: "JSON",
                url: "delegtcloseticket",
                data: { iid: ticketid, comment: comment, delgnid: delgnid, assgn_id: assgn_id, _token: $('#token').val() },
                success: function (rslt) {
                    swal.fire("Closed!", "Your Ticket Closed Sucessfully", "success");
                    location.reload();
                }
            });

        } else {
            swal.fire("Cancelled", "The request has been cancelled.", "error");
        }
    })

});

/**
 * Details : View Ticket Details : Save as note
 * Date    : 12-12-2022
 */
$('#Ticketcomments_Form').on('submit', function (e) {
    e.preventDefault();
    var comments = $("#ticket_cmn_comment").val();
    var ticketid = $("#cmnt_ticketid").val();
    var assgnid = $("#cmnt_assignid").val();

    var form = $('#Ticketcomments_Form')[0];
    var formData = new FormData(form);

    if (comments == '') {
        $('#ticket_cmn_comment').addClass('is-invalid');
        toastr.warning('Comments is required');
        return false;
    }
    else {
        $('#ticket_cmn_comment').removeClass('is-invalid');
    }
    formData.append('_token', $('#token').val());
    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketcomments_submit",
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;

            toastr[type](messg);

            if (type == "success") {
                window.location.href = 'view_assignedticket?id=' + ticketid + '&&asid=' + assgnid;
            }

        }
    });

});
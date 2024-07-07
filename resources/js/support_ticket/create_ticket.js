var unassigned_tbl;

$(function () {
    // ---------------------------------------
    $(".kt-selectpicker").select2();

    $('.kt_datetimepickerr').datepicker({
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
    });

    //----------------------------------------
    /**
     * Detail : Unassigned Tickets List
     * Date   : 24-11-2022
     */
    unassigned_tbl = $('#ticket_unassignedtbl').DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        // scrollX: true,
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
                doc.content[1].table.widths = ['5%', '15%', '15%', '15%', '15%', '20%', '10%', '5%'];
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
            "url": 'create_ticket',
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
                    return '<a href="view_ticket?id=' + row.id + '" class="kt-nav__link">' + row.ticketID + '</a>';
                }
            },
            { data: 'ticket_date', name: 'ticket_date' },
            { data: 'cust_name', name: 'cust_name' },
            { data: 'ticket_title', name: 'ticket_title' },
            { data: 'due_date', name: 'due_date' },
            { data: 'expirydays', name: 'expirydays' },
            { data: 'ticket_status', name: 'ticket_status' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">\
                                            <li class="kt-nav__item" >\
                                                <a href="edit_ticket/'+ row.id + '" class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-edit"></i>\
                                                    <span class="kt-nav__link-text">Edit</span>\
                                                </a>\
                                            </li>\
                                            <li class="kt-nav__item ticket_delete" data-id=' + row.id + '>\
                                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-trash"></i>\
                                                    <span class="kt-nav__link-text">Delete</span>\
                                                </span>\
                                            </li>\
                                            <li class="kt-nav__item">\
                                                <a href="view_ticket?id=' + row.id + '" class="kt-nav__link">\
                                                <i class="kt-nav__link-icon flaticon-eye"></i>\
                                                <span class="kt-nav__link-text">View</span>\
                                                </span>\
                                            </li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </span>';
                }
            },
        ]
    });

    /**
     * Detail : Assigned Tickets List
     * Date   : 24-11-2022
     */
    var assigned_tbl = $('#ticket_assignedtbl').DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        // scrollX: true,
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
                doc.content[1].table.widths = ['5%', '20%', '15%', '15%', '10%', '20%', '5%', '10%'];
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
            "url": 'assignd_ticket',
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
                    return '<a href="view_ticket?id=' + row.id + '" class="kt-nav__link">' + row.ticketID + '</a>';
                }
            },
            { data: 'ticket_date', name: 'ticket_date' },
            { data: 'cust_name', name: 'cust_name' },
            { data: 'ticket_title', name: 'ticket_title' },
            { data: 'due_date', name: 'due_date' },
            { data: 'expirydays', name: 'expirydays' },
            { data: 'assignd_user', name: 'assignd_user' },
            { data: 'ticket_status', name: 'ticket_status' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                              <i class="fa fa-cog"></i></a>\
                              <div class="dropdown-menu dropdown-menu-right">\
                              <ul class="kt-nav">\
                                <li class="kt-nav__item">\
                                    <a href="view_ticket?id=' + row.id + '" class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-eye"></i>\
                                    <span class="kt-nav__link-text">View</span>\
                                    </a>\
                                </li>\
                              </ul>\
                              </div>\
                            </div>\
                            </span>';
                }
            },
        ]
    });

    /**
     * Detail : Onselect Project
     * Date   : 22-11-2022
     */
    $('#tickt_against').on('select2:select', function (e) {
        var opt_selcted = $(this).val();

        if (opt_selcted == 2) {
            $("#project_div").removeClass('d-none');
        }
        else {
            $("#project_div").addClass('d-none');
        }
    });

}); // End DOM

/**
 * Detail : Onchange client load projects
 * Date   : 22-11-2022
 */
$(document).on('change', '#tickt_client', function () {
    var id = $(this).val();

    $.ajax({
        type: "POST",
        url: "getclient_projects",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
        },
        success: function (data) {
            $('#tickt_project').empty().trigger("change");
            var newOption = new Option('--select--', '', false, false);
            if (data.status == 1) {
                $('#tickt_project').append(newOption).trigger('change');
                $.each(data.data, function (i, val) {
                    var newOption = new Option(val.projectname, val.id, false, false);
                    $('#tickt_project').append(newOption).trigger('change');
                });
            } else
                console.log('Error !!');

        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
});

/**
 * Detail : Ticket Submit
 * Date   : 22-11-2022
 */
$(document).on('click', '#tickt_submit', function (e) {
    e.preventDefault();
    var client = $("#tickt_client").val();
    var ticketagnst = $("#tickt_against").val();
    var project = $("#tickt_project").val();
    var title = $("#tickt_title").val();
    var category = $("#tickt_category").val();
    var ticket_dt = $("#tickt_date").val();
    var compltn_dt = $("#tickt_completiondate").val();
    var scopeofwork = $("#tickt_scopeof_work").val();
    var priority = $("#tickt_priority").val();
    var assignd_to = $("#tickt_assignedto").val();
    var reference = $("#tickt_reference").val();
    var tickt_det = $("#tickt_details").val();
    var upldfiles = $("#fileData").val();
    var upldstatus = $("#upload_status").val();
    var tick_against_na = $("#tickt_against").find(":selected").text();
    var priority_na = $("#tickt_priority").find(":selected").text();

    if (client == '') {
        $('#tickt_client').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Client is required');
        return false;
    }
    else {
        $('#tickt_client').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (ticketagnst == '') {
        $('#tickt_against').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Ticket Against is required');
        return false;
    }
    else {
        $('#tickt_against').next().find('.select2-selection').removeClass('select-dropdown-error');

        if (ticketagnst == 2) {
            project = $("#tickt_project").val();

            if (project == '') {
                $('#tickt_project').next().find('.select2-selection').addClass('select-dropdown-error');
                toastr.warning('Project is required');
                return false;
            }
            else {
                $('#tickt_project').next().find('.select2-selection').removeClass('select-dropdown-error');
            }
        }
    }

    if (title == '') {
        $('#tickt_title').addClass('is-invalid');
        toastr.warning('Ticket Title is required');
        return false;
    }
    else {
        $('#tickt_title').removeClass('is-invalid');
    }

    if (category == '') {
        $('#tickt_category').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Ticket Category is required');
        return false;
    }
    else {
        $('#tickt_category').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (ticket_dt == '') {
        $('#tickt_date').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Ticket Date is required');
        return false;
    }
    else {
        $('#tickt_date').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (tickt_det == '') {
        $('#tickt_details').addClass('is-invalid');
        toastr.warning('Ticket Details is required');
        return false;
    }
    else {
        $('#tickt_details').removeClass('is-invalid');
    }

    if (upldfiles != "") {
        if (upldstatus == 0) {
            swal.fire({
                title: "Cancelled!",
                text: "Incomplete File Upload.",
                type: "error"
            });

            return false;
        }
    }

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketsubmit",
        data: {
            _token: $('#token').val(),
            client: client, ticketagnst: ticketagnst, tick_against_na: tick_against_na, project: project,
            title: title, category: category, ticket_dt: ticket_dt, compltn_dt: compltn_dt, scopeofwork: scopeofwork,
            priority: priority, priority_na: priority_na, assignd_to: assignd_to, reference: reference,
            tickt_det: tickt_det, upldfiles: upldfiles, _token: $('#token').val()
        },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;

            toastr[type](messg);

            window.location.href = 'create_ticket';
        }
    });

});

/**
 * Detail : Ticket Update
 * Date   : 29-11-2022
 */
$(document).on('click', '#tickt_update', function (e) {
    e.preventDefault();
    var id = $("#tickt_id").val();
    var client = $("#e_tickt_client").val();
    var ticketagnst = $("#e_tickt_against").val();
    var project = $("#e_tickt_project").val();
    var title = $("#e_tickt_title").val();
    var category = $("#e_tickt_category").val();
    var ticket_dt = $("#e_tickt_date").val();
    var compltn_dt = $("#e_tickt_completiondate").val();
    var scopeofwork = $("#e_tickt_scopeof_work").val();
    var priority = $("#e_tickt_priority").val();
    var assignd_to = $("#e_tickt_assignedto").val();
    var reference = $("#e_tickt_reference").val();
    var tickt_det = $("#e_tickt_details").val();
    var upldfiles = $("#fileData").val();
    var upldstatus = $("#e_upload_status").val();
    var tick_against_na = $("#e_tickt_against").find(":selected").text();
    var priority_na = $("#e_tickt_priority").find(":selected").text();

    if (client == '') {
        $('#e_tickt_client').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Client is required');
        return false;
    }
    else {
        $('#e_tickt_client').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (ticketagnst == '') {
        $('#e_tickt_against').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Ticket Against is required');
        return false;
    }
    else {
        $('#e_tickt_against').next().find('.select2-selection').removeClass('select-dropdown-error');

        if (ticketagnst == 2) {
            project = $("#e_tickt_project").val();

            if (project == '') {
                $('#e_tickt_project').next().find('.select2-selection').addClass('select-dropdown-error');
                toastr.warning('Project is required');
                return false;
            }
            else {
                $('#e_tickt_project').next().find('.select2-selection').removeClass('select-dropdown-error');
            }
        }
    }

    if (title == '') {
        $('#e_tickt_title').addClass('is-invalid');
        toastr.warning('Ticket Title is required');
        return false;
    }
    else {
        $('#e_tickt_title').removeClass('is-invalid');
    }

    if (category == '') {
        $('#e_tickt_category').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Ticket Category is required');
        return false;
    }
    else {
        $('#e_tickt_category').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (ticket_dt == '') {
        $('#e_tickt_date').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Ticket Date is required');
        return false;
    }
    else {
        $('#e_tickt_date').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (tickt_det == '') {
        $('#e_tickt_details').addClass('is-invalid');
        toastr.warning('Ticket Details is required');
        return false;
    }
    else {
        $('#e_tickt_details').removeClass('is-invalid');
    }

    if (upldfiles != "") {
        if (upldstatus == 0) {
            swal.fire({
                title: "Cancelled!",
                text: "Incomplete File Upload.",
                type: "error"
            });

            return false;
        }
    }

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "../ticketupdate",
        data: {
            _token: $('#token').val(), iid: id,
            client: client, ticketagnst: ticketagnst, tick_against_na: tick_against_na, project: project,
            title: title, category: category, ticket_dt: ticket_dt, compltn_dt: compltn_dt, scopeofwork: scopeofwork,
            priority: priority, priority_na: priority_na, assignd_to: assignd_to, reference: reference,
            tickt_det: tickt_det, upldfiles: upldfiles, _token: $('#token').val()
        },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;

            toastr[type](messg);

            window.location.href = '../create_ticket';
        }
    });

});

/**
 * Detail : Delete Ticket
 * Date   : 30-11-2022
 */
$(document).on('click', '.ticket_delete', function () {
    var ticktid = $(this).data('id');

    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'ticket_dlt',
                data: {
                    _token: $('#token').val(),
                    id: ticktid,
                },
                success: function (data) {
                    if (data > 0)
                        swal.fire("Deleted!", "Your Ticket Entry has been deleted", "success");
                    else
                        swal.fire("Cancelled", "Your Ticket Entry is safe :)", "error");
                    unassigned_tbl.ajax.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Ticket Entry is safe :)", "error");
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
                window.location.href = 'view_ticket?id=' + ticketid;
            }

        }
    });

});
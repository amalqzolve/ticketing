var ticketstatus;

$(function () {
    ticketstatus = $('#ticketstatus_tbl').DataTable({
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
                columns: [0, 1]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            },
            pageSize: 'A4',
            customize: function (doc) {
                doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                doc.content[1].table.widths = ['25%', '50%', '25%'];
            }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        }
        ],
        ajax: {
            "url": 'ticket_status',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
            { data: 'status', name: 'status' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">\
                                            <li class="kt-nav__item ticketstatus_edit" data-id=' + row.id + ' >\
                                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-edit"></i>\
                                                    <span class="kt-nav__link-text">Edit</span>\
                                                </span>\
                                            </li>\
                                            <li class="kt-nav__item ticketstatus_delete" data-id=' + row.id + '>\
                                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-trash"></i>\
                                                    <span class="kt-nav__link-text">Delete</span>\
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
}); // End DOM

/**
 * Detail : Ticket Status Submit
 * Date   : 19-11-2022
 */
$(document).on('click', '#ticketstatussubmit', function (e) {
    e.preventDefault();
    var statusname = $("#tickstatus_name").val();
    var desc = $("#tickstatus_desc").val();

    if (statusname == '') {
        $('#tickstatus_name').addClass('is-invalid');
        toastr.warning('Status is required');
        return false;
    }
    else {
        $('#tickstatus_name').removeClass('is-invalid');
    }

    $('#ticketstatussubmit').addClass('kt-spinner');
    $('#ticketstatussubmit').prop("disabled", true);
    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketstatus_submit",
        data: { statusname: statusname, statusdesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                ticketstatus.ajax.reload();
                $("#ticketstatuscreate_modal").modal('hide');
                $("#tickstatus_name").val('');
                $("#tickstatus_desc").val('');
            }
            $('#ticketstatussubmit').removeClass('kt-spinner');
            $('#ticketstatussubmit').prop("disabled", false);
        }

    });
});

/**
 * Detail : Ticket Status Edit
 * Date   : 19-11-2022
 */
$(document).on('click', '.ticketstatus_edit', function () {
    var statusid = $(this).data('id');

    $.ajax({
        datatype: "JSON",
        type: "POST",
        url: "ticketstatusdet_ajax",
        data: { id: statusid, _token: $('#token').val() },
        success: function (result) {
            var obj = JSON.parse(result);

            $("#e_tickstatus_id").val(obj.id);
            $("#e_tickstatus_name").val(obj.status);
            $("#e_tickstatus_desc").val(obj.description);

            $("#ticketstatusedit_modal").modal({ backdrop: 'static' });
            $("#ticketstatusedit_modal").modal('show');
        }
    });
});

/**
 * Detail : Ticket Status Update
 * Date   : 19-11-2022
 */
$(document).on('click', '#ticketstatusupdate', function (e) {
    e.preventDefault();
    var id = $("#e_tickstatus_id").val();
    var statname = $("#e_tickstatus_name").val();
    var desc = $("#e_tickstatus_desc").val();

    if (statname == '') {
        $('#e_tickstatus_name').addClass('is-invalid');
        toastr.warning('Status is required');
        return false;
    }
    else {
        $('#e_tickstatus_name').removeClass('is-invalid');
    }

    $('#ticketstatusupdate').addClass('kt-spinner');
    $('#ticketstatusupdate').prop("disabled", true);
    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketstatus_update",
        data: { iid: id, statusname: statname, statusdesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                ticketstatus.ajax.reload();
                $("#ticketstatusedit_modal").modal('hide');
                $("#e_tickstatus_name").val('');
                $("#e_tickstatus_desc").val('');
            }
            $('#ticketstatusupdate').removeClass('kt-spinner');
            $('#ticketstatusupdate').prop("disabled", false);
        }

    });
});

/**
 * Detail : Ticket Status Delete
 * Date   : 09-11-2022
 */
$(document).on('click', '.ticketstatus_delete', function () {
    var statusid = $(this).data('id');

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
                url: 'ticketstat_dlt',
                data: {
                    id: statusid, _token: $('#token').val()
                },
                success: function (data) {
                    if (data > 0)
                        swal.fire("Deleted!", "Your Ticket Status Entry has been deleted", "success");
                    else
                        swal.fire("Cancelled", "Your Ticket Status Entry is safe :)", "error");
                    ticketstatus.ajax.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Ticket Status Entry is safe :)", "error");
        }
    })
});
var tickettype;

$(function () {
    tickettype = $('#tickettype_tbl').DataTable({
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
            "url": 'ticket_type',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
            { data: 'type_name', name: 'type_name' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">\
                                            <li class="kt-nav__item tickettype_edit" data-id=' + row.id + ' >\
                                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-edit"></i>\
                                                    <span class="kt-nav__link-text">Edit</span>\
                                                </span>\
                                            </li>\
                                            <li class="kt-nav__item tickettype_delete" data-id=' + row.id + '>\
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
 * Detail : Ticket Type Submit
 * Date   : 09-11-2022
 */
$(document).on('click', '#tickettypesubmit', function (e) {
    e.preventDefault();
    var typename = $("#ticktype_name").val();
    var desc = $("#ticktype_desc").val();

    if (typename == '') {
        $('#ticktype_name').addClass('is-invalid');
        toastr.warning('Type Name is required');
        return false;
    }
    else {
        $('#ticktype_name').removeClass('is-invalid');
    }
    $('#tickettypesubmit').addClass('kt-spinner');
    $('#tickettypesubmit').prop("disabled", true);
    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "tickettype_submit",
        data: { typename: typename, typedesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                tickettype.ajax.reload();
                $("#tickettypecreate_modal").modal('hide');
                $("#ticktype_name").val('');
                $("#ticktype_desc").val('');
            } else
                $(this).attr('disable', false);
            $('#tickettypesubmit').removeClass('kt-spinner');
            $('#tickettypesubmit').prop("disabled", false);
        }
    });

});

/**
 * Detail : Ticket Type Edit
 * Date   : 09-11-2022
 */
$(document).on('click', '.tickettype_edit', function () {
    var typeid = $(this).data('id');

    $.ajax({
        datatype: "JSON",
        type: "POST",
        url: "tickettypedet_ajax",
        data: { id: typeid, _token: $('#token').val() },
        success: function (result) {
            var obj = JSON.parse(result);

            $("#e_ticktype_id").val(obj.id);
            $("#e_ticktype_name").val(obj.type_name);
            $("#e_ticktype_desc").val(obj.description);

            $("#tickettypeedit_modal").modal({ backdrop: 'static' });
            $("#tickettypeedit_modal").modal('show');
        }
    });
});

/**
 * Detail : Ticket Type Update
 * Date   : 09-11-2022
 */
$(document).on('click', '#tickettypeupdate', function (e) {
    e.preventDefault();
    var id = $("#e_ticktype_id").val();
    var typename = $("#e_ticktype_name").val();
    var desc = $("#e_ticktype_desc").val();

    if (typename == '') {
        $('#e_ticktype_name').addClass('is-invalid');
        toastr.warning('Type Name is required');
        return false;
    }
    else {
        $('#e_ticktype_name').removeClass('is-invalid');
    }
    $('#tickettypeupdate').addClass('kt-spinner');
    $('#tickettypeupdate').prop("disabled", true);

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "tickettype_update",
        data: { iid: id, typename: typename, typedesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                tickettype.ajax.reload();
                $("#tickettypeedit_modal").modal('hide');
                $("#e_ticktype_name").val('');
                $("#e_ticktype_desc").val('');
            }
            $('#tickettypeupdate').removeClass('kt-spinner');
            $('#tickettypeupdate').prop("disabled", false);
        }
    });

});

/**
 * Detail : Ticket Type Delete
 * Date   : 09-11-2022
 */
$(document).on('click', '.tickettype_delete', function () {
    var typeid = $(this).data('id');

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
                url: 'tickettyp_dlt',
                data: {
                    id: typeid, _token: $('#token').val()
                },
                success: function (data) {
                    if (data > 0)
                        swal.fire("Deleted!", "Your Ticket Type Entry has been deleted", "success");
                    else
                        swal.fire("Cancelled", "Your Ticket Type Entry is safe :)", "error");
                    tickettype.ajax.reload();
                }
            });
        } else {
            swal.fire("Cancelled", "Your Ticket Type Entry is safe :)", "error");
        }
    })
});

var ticketctg;

$(function () {
    ticketctg = $('#ticketcatg_tbl').DataTable({
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
            "url": 'ticket_category',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
            { data: 'category', name: 'category' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">\
                                            <li class="kt-nav__item ticketcatg_edit" data-id=' + row.id + ' >\
                                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-edit"></i>\
                                                    <span class="kt-nav__link-text">Edit</span>\
                                                </span>\
                                            </li>\
                                            <li class="kt-nav__item ticketcatg_delete" data-id=' + row.id + '>\
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
 * Detail : Ticket Category Submit
 * Date   : 18-11-2022
 */
$(document).on('click', '#ticketcatgsubmit', function (e) {
    e.preventDefault();
    var catgname = $("#tickctg_name").val();
    var desc = $("#tickctg_desc").val();

    if (catgname == '') {
        $('#tickctg_name').addClass('is-invalid');
        toastr.warning('Category is required');
        return false;
    }
    else {
        $('#tickctg_name').removeClass('is-invalid');
    }
    $('#ticketcatgsubmit').addClass('kt-spinner');
    $('#ticketcatgsubmit').prop("disabled", true);

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketcatg_submit",
        data: { catgname: catgname, ctgdesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                ticketctg.ajax.reload();
                $("#ticketcatgcreate_modal").modal('hide');
                $("#tickctg_name").val('');
                $("#tickctg_desc").val('');
            }
            $('#ticketcatgsubmit').removeClass('kt-spinner');
            $('#ticketcatgsubmit').prop("disabled", false);
        }

    });
});

/**
 * Detail : Ticket Category Edit
 * Date   : 18-11-2022
 */
$(document).on('click', '.ticketcatg_edit', function () {
    var ctgid = $(this).data('id');

    $.ajax({
        datatype: "JSON",
        type: "POST",
        url: "ticketctgdet_ajax",
        data: { id: ctgid, _token: $('#token').val() },
        success: function (result) {
            var obj = JSON.parse(result);

            $("#e_tickctg_id").val(obj.id);
            $("#e_tickctg_name").val(obj.category);
            $("#e_tickctg_desc").val(obj.description);

            $("#ticketctgedit_modal").modal({ backdrop: 'static' });
            $("#ticketctgedit_modal").modal('show');
        }
    });
});

/**
 * Detail : Ticket Category Update
 * Date   : 18-11-2022
 */
$(document).on('click', '#ticketcatgupdate', function (e) {
    e.preventDefault();
    var id = $("#e_tickctg_id").val();
    var catgname = $("#e_tickctg_name").val();
    var desc = $("#e_tickctg_desc").val();

    if (catgname == '') {
        $('#e_tickctg_name').addClass('is-invalid');
        toastr.warning('Category is required');
        return false;
    }
    else {
        $('#e_tickctg_name').removeClass('is-invalid');
    }

    $('#ticketcatgupdate').addClass('kt-spinner');
    $('#ticketcatgupdate').prop("disabled", true);
    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "ticketcatg_update",
        data: { iid: id, catgname: catgname, ctgdesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                ticketctg.ajax.reload();
                $("#ticketctgedit_modal").modal('hide');
                $("#e_tickctg_name").val('');
                $("#e_tickctg_desc").val('');
            }
            $('#ticketcatgupdate').removeClass('kt-spinner');
            $('#ticketcatgupdate').prop("disabled", false);
        }

    });
});

/**
 * Detail : Ticket Category Delete
 * Date   : 19-11-2022
 */
$(document).on('click', '.ticketcatg_delete', function () {
    var ctgid = $(this).data('id');

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
                url: 'ticketctg_dlt',
                data: {
                    id: ctgid, _token: $('#token').val()
                },
                success: function (data) {
                    if (data > 0)
                        swal.fire("Deleted!", "Your Ticket Category Entry has been deleted", "success");
                    else
                        swal.fire("Cancelled", "Your Ticket Category Entry is safe :)", "error");
                    ticketctg.ajax.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Ticket Category Entry is safe :)", "error");
        }
    })
});

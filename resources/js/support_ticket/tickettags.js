var tickettags;
$(function () {
    tickettags = $('#tickettags_tbl').DataTable({
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
            "url": 'ticket_tags',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
            { data: 'tag_name', name: 'tag_name' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
              <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                          <i class="fa fa-cog"></i></a>\
                          <div class="dropdown-menu dropdown-menu-right">\
                          <ul class="kt-nav">\
                            <li class="kt-nav__item tickettag_edit" data-id=' + row.id + ' >\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-edit"></i>\
                            <span class="kt-nav__link-text">Edit</span>\
                            </span></li>\
                            <li class="kt-nav__item tickettag_delete" data-id=' + row.id + '>\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-trash"></i>\
                            <span class="kt-nav__link-text">Delete</span></span></li>\
                         </ul></div></div></span>';
                }
            },

        ]
    });
}); // End DOM

/**
 * Detail : Tag Submit
 * Date   : 10-11-2022
 */
$(document).on('click', '#tickettagsubmit', function (e) {
    e.preventDefault();
    var flag = 0;
    var tags = $("#ticktag_name").val();
    var desc = $("#ticktag_desc").val();

    if (tags == '') {
        flag = 1;
        $('#ticktag_name').addClass('is-invalid');
        toastr.warning('Tag Name is required');
        return false;
    }
    else {
        $('#ticktag_name').removeClass('is-invalid');
    }

    $('#tickettagsubmit').addClass('kt-spinner');
    $('#tickettagsubmit').prop("disabled", true);
    if (flag == 0) {
        $.ajax({
            type: "POST",
            datatype: "JSON",
            url: "tickettag_submit",
            data: { tagname: tags, tagdesc: desc, _token: $('#token').val() },
            success: function (rslt) {
                var obj = JSON.parse(rslt);
                var messg = obj.toast_msg;
                var type = obj.toast_stat;
                var flg = obj.flag;

                toastr[type](messg);

                if (flg == 0) {
                    tickettags.ajax.reload();
                    $("#tickettagcreate_modal").modal('hide');
                    $("#ticktag_name").val('');
                    $("#ticktag_desc").val('');
                }
                $('#tickettagsubmit').removeClass('kt-spinner');
                $('#tickettagsubmit').prop("disabled", false);
            }

        });
    }

});

/**
 * Detail : Tag Edit
 * Date   : 18-11-2022
 */
$(document).on('click', '.tickettag_edit', function () {
    var tagid = $(this).data('id');

    $.ajax({
        datatype: "JSON",
        type: "POST",
        url: "tickettagdet_ajax",
        data: { id: tagid, _token: $('#token').val() },
        success: function (result) {
            var obj = JSON.parse(result);

            $("#e_ticktag_id").val(obj.id);
            $("#e_ticktag_name").val(obj.tag_name);
            $("#e_ticktag_desc").val(obj.description);

            $("#tickettagedit_modal").modal({ backdrop: 'static' });
            $("#tickettagedit_modal").modal('show');
        }
    });
});

/**
 * Detail : Ticket Tags Update
 * Date   : 18-11-2022
 */
$(document).on('click', '#tickettagupdate', function (e) {
    e.preventDefault();
    var id = $("#e_ticktag_id").val();
    var tagname = $("#e_ticktag_name").val();
    var desc = $("#e_ticktag_desc").val();

    if (tagname == '') {
        $('#e_ticktag_name').addClass('is-invalid');
        toastr.warning('Tag Name is required');
        return false;
    }
    else {
        $('#e_ticktag_name').removeClass('is-invalid');
    }

    $('#tickettagupdate').addClass('kt-spinner');
    $('#tickettagupdate').prop("disabled", true);
    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "tickettag_update",
        data: { iid: id, tagname: tagname, tagdesc: desc, _token: $('#token').val() },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;
            var flg = obj.flag;

            toastr[type](messg);

            if (flg == 0) {
                tickettags.ajax.reload();
                $("#tickettagedit_modal").modal('hide');
                $("#e_ticktag_name").val('');
                $("#e_ticktag_desc").val('');
            }
            $('#tickettagupdate').removeClass('kt-spinner');
            $('#tickettagupdate').prop("disabled", false);
        }

    });
});


/**
 * Detail : Tags Delete
 * Date   : 10-11-2022
 */
$(document).on('click', '.tickettag_delete', function () {
    var tagid = $(this).data('id');

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
                url: 'tickettag_dlt',
                dataType: "json",
                data: {
                    id: tagid, _token: $('#token').val()
                },
                success: function (data) {
                    if (data > 0)
                        swal.fire("Deleted!", "Your Tag Entry has been deleted", "success");
                    else
                        swal.fire("Cancelled", "Your Tag Entry is safe :)", "error");
                    tickettags.ajax.reload();
                }
            });
        } else {
            swal.fire("Cancelled", "Your Tag Entry is safe :)", "error");
        }
    })
});

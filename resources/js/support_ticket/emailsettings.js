var email_setng;

$(function () {
    email_setng = $('#emailsettings_tbl').DataTable({
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
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            },
            pageSize: 'A4',
            customize: function (doc) {
                doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                doc.content[1].table.widths = ['5%', '30%', '10%', '10%', '40%', '5%'];
            }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        }
        ],
        ajax: {
            "url": 'emailsetting',
            "type": "POST",
            "data": function (data) {
                data._token = $('#token').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
            { data: 'host', name: 'host' },
            { data: 'port_no', name: 'port_no' },
            { data: 'smtpsecure_status', name: 'smtpsecure_status' },
            { data: 'sender_email', name: 'sender_email' },
            {
                data: 'action', name: 'action',
                orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">\
                                            <li class="kt-nav__item emailsetting_edit" data-id=' + row.id + ' >\
                                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-edit"></i>\
                                                    <span class="kt-nav__link-text">Edit</span>\
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
 * Detail : Ticket Status Edit
 * Date   : 19-11-2022
 */
$(document).on('click', '.emailsetting_edit', function () {
    var email_id = $(this).data('id');

    $.ajax({
        datatype: "JSON",
        type: "POST",
        url: "emailsettingsdet_ajax",
        data: { id: email_id, _token: $('#token').val() },
        success: function (result) {
            var obj = JSON.parse(result);

            $("#e_email_id").val(obj.id);
            $("#e_mailhost").val(obj.host);
            $("#e_mailsmtpusername").val(obj.username);
            $("#e_mailsmtppasswrd").val(obj.passwrd);
            $("#e_mailsmtpsecure").val(obj.smtpsecure_status);
            $("#e_mailport").val(obj.port_no);
            $("#e_mailsender").val(obj.sender_email);

            $("#emailsettingedit_modal").modal({ backdrop: 'static' });
            $("#emailsettingedit_modal").modal('show');
        }
    });
});

/**
 * Detail : Email Settings Update
 * Date   : 01-01-2023
 */
$(document).on('click', '#emailsettingsupdate', function (e) {
    e.preventDefault();
    var id = $("#e_email_id").val();
    var host = $("#e_mailhost").val();
    var smtpusername = $("#e_mailsmtpusername").val();
    var smtp_pwd = $("#e_mailsmtppasswrd").val();
    var smtp_secure = $("#e_mailsmtpsecure").val();
    var port = $("#e_mailport").val();
    var sender_email = $("#e_mailsender").val();

    if (host == '') {
        $('#e_mailhost').addClass('is-invalid');
        toastr.warning('Host is required');
        return false;
    }
    else {
        $('#e_mailhost').removeClass('is-invalid');
    }

    if (smtpusername == '') {
        $('#e_mailsmtpusername').addClass('is-invalid');
        toastr.warning('SMTP Username is required');
        return false;
    }
    else {
        $('#e_mailsmtpusername').removeClass('is-invalid');
    }

    if (smtp_pwd == '') {
        $('#e_mailsmtppasswrd').addClass('is-invalid');
        toastr.warning('SMTP Password is required');
        return false;
    }
    else {
        $('#e_mailsmtppasswrd').removeClass('is-invalid');
    }

    if (smtp_secure == '') {
        $('#e_mailsmtpsecure').addClass('is-invalid');
        toastr.warning('SMTP Secure is required');
        return false;
    }
    else {
        $('#e_mailsmtpsecure').removeClass('is-invalid');
    }

    if (port == '') {
        $('#e_mailport').addClass('is-invalid');
        toastr.warning('Port is required');
        return false;
    }
    else {
        $('#e_mailport').removeClass('is-invalid');
    }

    if (sender_email == '') {
        $('#e_mailsender').addClass('is-invalid');
        toastr.warning('Sender Email is required');
        return false;
    }
    else {
        $('#e_mailsender').removeClass('is-invalid');
    }

    $.ajax({
        type: "POST",
        datatype: "JSON",
        url: "emailsettings_update",
        data: { _token: $('#token').val(), iid: id, host: host, smtpusername: smtpusername, smtp_pwd: smtp_pwd, smtp_secure: smtp_secure, port: port, sender_email: sender_email },
        success: function (rslt) {
            var obj = JSON.parse(rslt);
            var messg = obj.toast_msg;
            var type = obj.toast_stat;

            toastr[type](messg);

            email_setng.ajax.reload();
            $("#emailsettingedit_modal").modal('hide');
        }

    });
});


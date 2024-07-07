/*
 * Author : Siffy
 * Detail : Datatable for Email Settings Information
 * Date   : 21-07-2022
 */

var emailsetngs_list_table = $('#emailsettings_list').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
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
            columns: [0, 1, 2, 3, 4]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4]
        },
        pageSize: 'A4',
        orientation: 'landscape'
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4]
        }
    }
    ],

    ajax: {
        "url": 'settings_emailset',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'host', name: 'host' },
        { data: 'port_no', name: 'port' },
        { data: 'smtpsecure_status', name: 'smtpsecure' },
        { data: 'sender_email', name: 'sender' },

        /*   {
           data: 'description',
           name: 'description',
           render: function(data, type, row) {
             //  return  row.description;
                return $("<div/>").html(row.description).text();
           }
       },*/


        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                         <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#emailsettings"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text emailsettngs_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                       </ul></div></div></span>';

            }
        },

    ]
});

/*
 * Author : Siffy
 * Detail : Loading Email Settings details for Edit
 * Date   : 21-07-2022
 */
$(document).on('click', '.emailsettngs_update', function () {

    var email_id = $(this).attr("data-id");
    $.ajax({
        url: "settingsgetemailconfg",
        method: "POST",
        data: {
            _token: $('#token').val(),
            email_id: email_id
        },
        dataType: "json",

        success: function (data) {

            $('#id').val(data['emaildet'].id);
            $('#mail_host').val(data['emaildet'].host);
            $('#mail_usrname').val(data['emaildet'].username);
            $('#mail_passwrd').val(data['emaildet'].passwrd);
            $('#mail_smtpsecure').val(data['emaildet'].smtpsecure_status);
            $('#mail_port').val(data['emaildet'].port_no);
            $('#mail_sender').val(data['emaildet'].sender_email);

        }

    })
});

/*
 * Author : Siffy
 * Detail : Email Settings Save
 * Date   : 21-07-2022
 */
$(document).on('click', '#emailsetng_submit', function () {

    host = $('#mail_host').val();
    usrname = $('#mail_usrname').val();
    passwrd = $('#mail_passwrd').val();
    smtpsecure = $('#mail_smtpsecure').val();
    port = $('#mail_port').val();
    sender = $('#mail_sender').val();

    if (host == "") {
        $('#mail_host').addClass('is-invalid');
        return false;
    }
    else {
        $('#mail_host').removeClass('is-invalid');
    }

    if (usrname == "") {
        $('#mail_usrname').addClass('is-invalid');
        return false;
    }
    else {
        $('#mail_usrname').removeClass('is-invalid');
    }

    if (passwrd == "") {
        $('#mail_passwrd').addClass('is-invalid');
        return false;
    }
    else {
        $('#mail_passwrd').removeClass('is-invalid');
    }

    if (smtpsecure == "") {
        $('#mail_smtpsecure').addClass('is-invalid');
        return false;
    }
    else {
        $('#mail_smtpsecure').removeClass('is-invalid');
    }

    if (port == "") {
        $('#mail_port').addClass('is-invalid');
        return false;
    }
    else {
        $('#mail_port').removeClass('is-invalid');
    }

    if (sender == "") {
        $('#mail_sender').addClass('is-invalid');
        return false;
    }
    else {
        $('#mail_sender').removeClass('is-invalid');
    }

    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "settingsemailSubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            branch: $('#branch').val(),
            email_id: $('#id').val(),
            host: $('#mail_host').val(),
            usrname: $('#mail_usrname').val(),
            passwrd: $('#mail_passwrd').val(),
            smtpsecure: $('#mail_smtpsecure').val(),
            port: $('#mail_port').val(),
            sender: $('#mail_sender').val()
        },
        success: function (data) {
            if (data == false) {
                $('#emailsetng_submit').removeClass('kt-spinner');
                $('#emailsetng_submit').prop("disabled", false);
                toastr.success('Terms name is already exist');
            }
            else {
                $('#emailsetng_submit').removeClass('kt-spinner');
                $('#emailsetng_submit').prop("disabled", false);
                closeModel();


                swal.fire("Done", "Submission Sucessfully", "success");
                emailsetngs_list_table.ajax.reload();
            }
        },
        error: function (jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function (key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function (index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

});

/*
* Close Model
*/
function closeModel() {

    $("#emailsettings").modal("hide");
    $('#mail_host').val("");
    $('#mail_usrname').val("");
    $('#mail_passwrd').val("");
    $('#mail_smtpsecure').val("");
    $('#mail_port').val("");
    $('#mail_sender').val("");
}

$(document).on('click', '.closeBtn,.close', function () {
    closeModel();
});

$(document).on('click', '#btnSubmit', function (e) {
    e.preventDefault();
    if ($('#db_datasource').val() == "") {
        $('#db_datasource').addClass('is-invalid');
        return false;
    } else
        $('#db_datasource').removeClass('is-invalid');

    if ($('#db_host').val() == "") {
        $('#db_host').addClass('is-invalid');
        return false;
    } else
        $('#db_host').removeClass('is-invalid');

    if ($('#db_port').val() == "") {
        $('#db_port').addClass('is-invalid');
        return false;
    } else
        $('#db_port').removeClass('is-invalid');

    if ($('#db_schema').val() == "") {
        $('#db_schema').addClass('is-invalid');
        return false;
    } else
        $('#db_schema').removeClass('is-invalid');

    if ($('#db_login').val() == "") {
        $('#db_login').addClass('is-invalid');
        return false;
    } else
        $('#db_login').removeClass('is-invalid');

    if ($('#db_password').val() == "") {
        $('#db_password').addClass('is-invalid');
        return false;
    } else
        $('#db_password').removeClass('is-invalid');

    $('#btnSubmit').addClass('kt-spinner');
    $('#btnSubmit').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "accounting-db-connection-test",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            db_datasource: $('#db_datasource').val(),
            db_host: $('#db_host').val(),
            db_port: $('#db_port').val(),
            db_schema: $('#db_schema').val(),
            db_login: $('#db_login').val(),
            db_password: $('#db_password').val(),
        },
        success: function (data) {
            if (data.status == 0) {
                toastr.error('Invalid Connection.. Please Check Connection');
                $('#btnSubmit').removeClass('kt-spinner');
                $('#btnSubmit').prop("disabled", false);
            } else {
                swal.fire({
                    title: 'Connection Success Do you Want to Save ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        saveDetails(result)
                    } else {
                        swal.fire("Cancelled", "", "error");
                        $('#btnSubmit').removeClass('kt-spinner');
                        $('#btnSubmit').prop("disabled", false);
                    }
                });
            }

        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
});


function saveDetails(result) {
    $('#btnSubmit').addClass('kt-spinner');
    $('#btnSubmit').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "accounting-db-connection-save",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            db_datasource: $('#db_datasource').val(),
            db_host: $('#db_host').val(),
            db_port: $('#db_port').val(),
            db_schema: $('#db_schema').val(),
            db_login: $('#db_login').val(),
            db_password: $('#db_password').val(),
        },
        success: function (data) {
            if (data.status == 1) {
                toastr.success('Accounting Connection Successfully Saved');
                $('#btnSubmit').removeClass('kt-spinner');
                $('#btnSubmit').prop("disabled", false);
                window.location.href = "branch-settings";
            }
        },
        error: function (jqXhr, json, errorThrown) {
            $('#btnSubmit').removeClass('kt-spinner');
            $('#btnSubmit').prop("disabled", false);
            toastr.success('Error While Save');
        }
    });
}

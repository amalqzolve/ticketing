$('.rmusers').addClass('kt-menu__item--active');

$(document.body).on("change", ".employeename", function () {

    var curentVal = $(this).val();
    var tr = $(this).closest('tr');

    if (curentVal.indexOf('_') > -1) {
        var newValue = curentVal.text().replace('_', '');
        tr.find('input[name="category[]"]').val('');
        tr.find('input[name="employee_name_field[]"]').val(newValue);
        tr.find('select[name="department[]"]').val('');
        tr.find('input[name="jobtitle[]"]').val('');
        tr.find('input[name="employeeid[]"]').val('');
        tr.find('input[name="contractno[]"]').val('');
        tr.find('input[name="nationality[]"]').val('');
        tr.find('input[name="nationalid[]"]').val('');
        tr.find('input[name="nationalidexp[]"]').val('');
        tr.find('input[name="passportno[]"]').val('');
        tr.find('input[name="passportnoexp[]"]').val('');
        tr.find('input[name="overhead[]"]').val(0);
    } else {
        $.ajax({
            url: "get-hr-user-from-id",
            method: "POST",
            data: {
                _token: $('#token').val(),
                id: curentVal
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    tr.find('input[name="category[]"]').val('');
                    tr.find('input[name="employee_name_field[]"]').val(data.data.f_name + ' ' + data.data.l_name);
                    tr.find('select[name="department[]"]').val(data.data.department_id);
                    tr.find('input[name="jobtitle[]"]').val('');
                    tr.find('input[name="employeeid[]"]').val(data.data.employee_code);
                    if (data.data.phno_1 != '')
                        tr.find('input[name="contractno[]"]').val(data.data.phno_1);
                    else
                        tr.find('input[name="contractno[]"]').val(data.data.phno_2);
                    tr.find('input[name="nationality[]"]').val(data.data.country);
                    tr.find('input[name="nationalid[]"]').val(data.data.national_id);
                    tr.find('input[name="nationalidexp[]"]').val('');
                    tr.find('input[name="passportno[]"]').val(data.data.passport_num);
                    tr.find('input[name="passportnoexp[]"]').val(data.data.passport_expdate);
                    tr.find('input[name="overhead[]"]').val(0);
                    $(".kt-selectpicker").select2();
                } else {
                    alert(data.msg);
                }
            }
        })
    }
});



$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();

    var error = 0;
    var rowCount = 0;
    $('#usersTbl > tbody  > tr').each(function (index, tr) {
        // var tr = tr1.closest('tr');
        rowCount++;

        if ($(tr).find('select[name="employeename[]"]').val() == '') {
            $(tr).find('select[name="employeename[]"]').next().find('.selectize-input').addClass('select-dropdown-error');
            error++;
        } else
            $(tr).find('select[name="employeename[]"]').next().find('.selectize-input').removeClass('select-dropdown-error');

        if ($(tr).find('input[name="category[]"]').val() == '') {
            $(tr).find('input[name="category[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="category[]"]').removeClass('is-invalid');
        if ($(tr).find('select[name="department[]"]').val() == '') {
            $(tr).find('select[name="department[]"]').next().find('.select2-selection').addClass('select-dropdown-error');
            error++;
        } else
            $(tr).find('select[name="department[]"]').next().find('.select2-selection').removeClass('select-dropdown-error');
        if ($(tr).find('input[name="jobtitle[]"]').val() == '') {
            $(tr).find('input[name="jobtitle[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="jobtitle[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="employeeid[]"]').val() == '') {
            $(tr).find('input[name="employeeid[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="employeeid[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="contractno[]"]').val() == '') {
            $(tr).find('input[name="contractno[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="contractno[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="nationality[]"]').val() == '') {
            $(tr).find('input[name="nationality[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="nationality[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="nationalid[]"]').val() == '') {
            $(tr).find('input[name="nationalid[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="nationalid[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="nationalidexp[]"]').val() == '') {
            $(tr).find('input[name="nationalidexp[]"]').addClass('is-invalid');
            error++;
        } else $(tr).find('input[name="nationalidexp[]"]').removeClass('is-invalid');

        if ($(tr).find('input[name="passportno[]"]').val() == '') {
            $(tr).find('input[name="passportno[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="passportno[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="passportnoexp[]"]').val() == '') {
            $(tr).find('input[name="passportnoexp[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="passportnoexp[]"]').removeClass('is-invalid');
        if ($(tr).find('input[name="overhead[]"]').val() == '') {
            $(tr).find('input[name="overhead[]"]').addClass('is-invalid');
            error++;
        } else
            $(tr).find('input[name="overhead[]"]').removeClass('is-invalid');

    });

    if (rowCount == 0) {
        error++;
        toastr.error('Add atleast One Employee Then Save');
    }
    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "save-employees",
            dataType: "json",
            data: $('#data-form').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSave').addClass('kt-spinner');
                    $('#btnSave').prop("disabled", true);
                    toastr.success('Employees added Successfuly');
                    window.location.href = "rmusers";
                } else
                    alert(data.msg);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.warning("Please Fill mandatory Fields !!");

});

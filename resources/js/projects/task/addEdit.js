

$(document).on('click', '.close', function (e) {
    clearForm();
})
$(document).on('click', '#btnSaveTask', function (e) {
    e.preventDefault();
    var error = validateForm();
    if (!error) {
        $('#btnSaveTask').addClass('kt-spinner');
        $('#btnSaveTask').attr("disabled", true);
        $('#btnSaveAndNext').attr("disabled", true);
        $.ajax({
            type: "POST",
            url: "task-submit",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                $('#btnSaveTask').removeClass('kt-spinner');
                $('#btnSaveAndNext').attr("disabled", false);
                $('#btnSaveTask').attr("disabled", false);
                if (data.status == 1) {
                    toastr.success('Task Saved Successfully.');
                    $("#kt_modal_4_5").modal("hide");
                    clearForm();
                } else {
                    alert(data.msg);
                    data_saved = 0;
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});

$(document).on('click', '#btnSaveAndNext', function (e) {
    e.preventDefault();
    var error = validateForm();
    if (!error) {
        $('#btnSaveAndNext').addClass('kt-spinner');
        $('#btnSaveAndNext').attr("disabled", true);
        $('#btnSaveTask').attr("disabled", true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "task-submit",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    toastr.success('Task Saved Successfully.');
                    $('#btnSaveAndNext').removeClass('kt-spinner');
                    $('#btnSaveAndNext').attr("disabled", false);
                    $('#btnSaveTask').attr("disabled", false);
                    clearForm();
                } else {
                    alert(data.msg);
                    $('#btnSaveAndNext').removeClass('kt-spinner');
                    $('#btnSaveAndNext').attr("disabled", false);
                    $('#btnSaveTask').attr("disabled", false);
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});

function validateForm() {
    var error = 0;
    if ($('#title').val() == "") {
        $('#title').addClass('is-invalid');
        error++;
    } else
        $('#title').removeClass('is-invalid');

    if ($('#project_id').val() == "") {
        $('#project_id').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#project_id').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#assign_to').val() == "") {
        $('#assign_to').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#assign_to').next().find('.select2-selection').removeClass('select-dropdown-error');


    if ($('#state_id').val() == "") {
        $('#state_id').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#state_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    if ($('#start_date').val() == "") {
        $('#start_date').addClass('is-invalid');
        error++;
    } else
        $('#start_date').removeClass('is-invalid');

    if ($('#deadline').val() == "") {
        $('#deadline').addClass('is-invalid');
        error++;
    } else
        $('#deadline').removeClass('is-invalid');

    return error;
}

function clearForm() {
    $('#id').val('');
    $('#title').val('');
    $('#description').val('');
    $('#project_id').val('');
    $('#points').val('');
    $('#milestone').val('');
    $('#assign_to').val('');
    $('#collaborators').val('');
    $('#state_id').val('');
    $('#priority').val('');
    $('#labels').val('');
    $('#start_date').val('');
    $('#deadline').val('');

    $('#title').removeClass('is-invalid');
    $('#project_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#assign_to').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#state_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#start_date').removeClass('is-invalid');
    $('#deadline').removeClass('is-invalid');
    $('#btnSaveAndNext').show();
    $('#milestone').children().remove().end().append('<option selected value="">--select--</option>');
    $("#assign_to").children().remove().end().append('<option selected value="">--select--</option>');
    refreshItems();
    $('#btnViewTask').trigger('click');
}

function loadModel(id) {
    $.ajax({
        url: "task-view",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: id
        },
        dataType: "json",
        success: function (data) {
            $("#kt_modal_4_5").modal("show");
            $('#btnSaveAndNext').hide();
            if (data.status == 1) {
                $('#milestone').children().remove().end().append('<option selected value="">--select--</option>');
                $("#assign_to").children().remove().end().append('<option selected value="">--select--</option>');
                $.each(data.milestone, function () {
                    var optionhtml = '<option value="' + this.id + '">' + this.milestone_title + '</option>';
                    $("#milestone").append(optionhtml);
                });
                $.each(data.members, function () {
                    var optionhtml = '<option value="' + this.id + '">' + this.employee_name_field + '</option>';
                    $("#assign_to").append(optionhtml);
                });
                $('#id').val(data.data.id);
                $('#title').val(data.data.title);
                $('#description').val(data.data.description);
                $('#project_id').val(data.data.project_id);
                $('#points').val(data.data.points);
                $('#milestone').val(data.data.milestone);
                $('#assign_to').val(data.data.assign_to);
                $('#state_id').val(data.data.state_id);
                $('#priority').val(data.data.priority);

                $('#start_date').val(data.data.start_date);
                $('#deadline').val(data.data.deadline);

                $('#labels').val(data.labels);//
                refreshItems();
            } else {
                console.log(data.msg);
            }
        }
    });
}


$(document).on('change', '#project_id', function () {
    var id = $(this).val();
    $.ajax({
        url: "get-milestone-and-members-from-project-id",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: id
        },
        dataType: "json",
        success: function (data) {
            $('#milestone').children().remove().end().append('<option selected value="">--select--</option>');
            $("#assign_to").children().remove().end().append('<option selected value="">--select--</option>');
            if (data.status == 1) {
                $.each(data.milestone, function () {
                    var optionhtml = '<option value="' + this.id + '">' + this.milestone_title + '</option>';
                    $("#milestone").append(optionhtml);
                });
                $.each(data.members, function () {
                    var optionhtml = '<option value="' + this.id + '">' + this.employee_name_field + '</option>';
                    $("#assign_to").append(optionhtml);
                });
                refreshItems();
            }
            else
                console.log(data.msg)
        }
    })
});

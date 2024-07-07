

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
            url: "../task-submit",
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
                    location.reload();
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



function validateForm() {
    var error = 0;
    if ($('#title').val() == "") {
        $('#title').addClass('is-invalid');
        error++;
    } else
        $('#title').removeClass('is-invalid');

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
    $('#assign_to').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#state_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#start_date').removeClass('is-invalid');
    $('#deadline').removeClass('is-invalid');
    refreshItems();
    $('#btnViewTask').trigger('click');
}

function loadModel(id) {
    $.ajax({
        url: "../task-view",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: id
        },
        dataType: "json",
        success: function (data) {
            $("#kt_modal_4_5").modal("show");
            if (data.status == 1) {
                $('#id').val(data.data.id);
                $('#title').val(data.data.title);
                $('#description').val(data.data.description);
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

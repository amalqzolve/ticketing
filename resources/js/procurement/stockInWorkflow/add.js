$('.approvalSynthesis').addClass('kt-menu__item--open');
$('.stockInWorkflow').addClass('kt-menu__item--active');
$(document).on('click', '#saveMrWorkFlow', function (e) {
    e.preventDefault();

    if ($('#mrCat').val() == '') {
        $('#mrCat').addClass('is-invalid');
        return null;
    }
    $('#saveMrWorkFlow').addClass('kt-spinner');
    $('#saveMrWorkFlow').prop("disabled", true);

    var users = [];
    $("select[name^='users[]']")
        .each(function (input) {
            users.push($(this).val());
        });

    var ifAccepted = [];

    $("input[name^='ifAccepted[]']")
        .each(function (input) {
            ifAccepted.push($(this).val());
        });
    var ifRejected = [];
    $("input[name^='ifRejected[]']")
        .each(function (input) {
            ifRejected.push($(this).val());
        });
    $.ajax({
        type: "POST",
        url: "stock-in-workflow-save",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            users: users,
            ifAccepted: ifAccepted,
            ifRejected: ifRejected,
            mrCat: $('#mrCat').val(),
        },
        success: function (data) {
            if (data.status == 1) {
                $('#saveMrWorkFlow').removeClass('kt-spinner');
                $('#saveMrWorkFlow').prop("disabled", false);
                toastr.success('New Stock In Approval synthesis Created successfuly');
                window.location.href = "stock-in-workflow";
            } else
                toastr.error(data.msg);

        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });

});

$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');
    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
});
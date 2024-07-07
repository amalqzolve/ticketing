
$('.approvalSynthesis').addClass('kt-menu__item--open');
$('.MRApprovalSynthesis').addClass('kt-menu__item--active');
$(document).on('click', '#saveMrWorkFlow', function (e) {
    e.preventDefault();

    if ($('#mrCat').val() == '') {
        $('#mrCat').addClass('is-invalid');
        return null;
    }
    $('#saveMrWorkFlow').addClass('kt-spinner');
    $('#saveMrWorkFlow').prop("disabled", true);

    var old_id = [];
    $("input[name^='old_id[]']")
        .each(function (input) {
            old_id.push($(this).val());
        });


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
        url: "mr-workflow-update",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            old_id: old_id,
            users: users,
            ifAccepted: ifAccepted,
            ifRejected: ifRejected,
            mrCat: $('#mrCat').val(),
        },
        success: function (data) {
            if (data.status == 1) {
                $('#saveMrWorkFlow').removeClass('kt-spinner');
                $('#saveMrWorkFlow').prop("disabled", false);
                // location.reload();
                // window.location.href = "material-request";
                toastr.success('New MR Approval synthesis Created successfuly');
                window.location.href = "mr-workflow";
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

    var vatamounts = 0;
    $('.vatamount').each(function () {
        var id = $(this).attr('data-id');
        var vatamount = $('#vatamount' + id + '').val();

        vatamounts += parseFloat(vatamount);

    });
    $('#totalvatamount').val(vatamounts.toFixed(2));


    totalamount_calculate();
    discount_calculate();
    final_calculate1();


});
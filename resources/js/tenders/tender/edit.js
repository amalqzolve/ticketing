/**
*Datatable for product details Information
*/
$('.tenders').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});



$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#client').val() == '') {
        error++;
        $('#client').find('.select2-selection').addClass('select-dropdown-error');
        $('#client').addClass('is-invalid');
    } else
        $('#client').find('.select2-selection').removeClass('select-dropdown-error');


    if ($('#voucher_date').val() == '') {
        error++;
        $('#voucher_date').addClass('is-invalid');
    } else
        $('#voucher_date').removeClass('is-invalid');

    if ($('#payment_method').val() == '') {
        error++;
        $('#payment_method').find('.select2-selection').addClass('select-dropdown-error');
    } else
        $('#payment_method').find('.select2-selection').removeClass('select-dropdown-error')

    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "tender-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                client: $('#client').val(),
                project_name: $('#project_name').val(),
                date_of_submission: $('#date_of_submission').val(),
                date_of_release: $('#date_of_release').val(),
                reference: $('#reference').val(),
                bid_extension_date: $('#bid_extension_date').val(),
                bid_submission_date: $('#bid_submission_date').val(),
                bid_bond: $('#bid_bond').val(),
                consultant: $('#consultant').val(),
                scope_of_work: $('#scope_of_work').val(),
                category_id: $('#category_id').val(),
                upload: $('#fileData').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val()
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.success('Tender generated successfuly');
                    window.location.href = "tender";
                } else {
                    toastr.error('Error');
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please fill Mandatory Fields');
});

$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
        url: "../gettermsquote_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            var termcondition = '';
            $.each(data, function (key, value) {

                termcondition = value.description;
            });

            $('#kt-tinymce-4').val(termcondition);
            tinymce.activeEditor.setContent(termcondition);
            console.log(termcondition);

        }
    })
});
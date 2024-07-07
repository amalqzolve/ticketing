/**
*Datatable for product details Information
*/
$('.electronicTreasury').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
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

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;


    if ($('#receiver_name').val() == '') {
        error++;
        $('#receiver_name').addClass('is-invalid');
    } else
        $('#receiver_name').removeClass('is-invalid');


    if ($('#relation_with_supplier').val() == '') {
        error++;
        $('#relation_with_supplier').addClass('is-invalid');
    } else
        $('#relation_with_supplier').removeClass('is-invalid');


    if ($('#phone_number').val() == '') {
        error++;
        $('#phone_number').addClass('is-invalid');
    } else
        $('#phone_number').removeClass('is-invalid');


    if ($('#issued_date').val() == '') {
        error++;
        $('#issued_date').addClass('is-invalid');
    } else
        $('#issued_date').removeClass('is-invalid');

    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "issue-payment-voucher-add",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                epr_id: $('#epr_id').val(),
                po_id: $('#po_id').val(),
                invoice_id: $('#invoice_id').val(),
                supplier_payement_id: $('#supplier_payement_id').val(),
                voucher_id: $('#voucher_id').val(),
                supplier_id: $('#supplier_id').val(),
                receiver_name: $('#receiver_name').val(),
                relation_with_supplier: $('#relation_with_supplier').val(),
                designation: $('#designation').val(),
                department: $('#department').val(),
                national_id: $('#national_id').val(),
                phone_number: $('#phone_number').val(),
                issued_date: $('#issued_date').val(),
                comments: $('#comments').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
                amount: $('#amount').val(),
            },
            success: function (data) {
                $('#btnSave').removeClass('kt-spinner');
                $('#btnSave').prop("disabled", false);
                toastr.success('Issued Payment Voucher generated successfuly');
                window.location.href = "electronic-treasury";
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
        url: "../gettermsquote",
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

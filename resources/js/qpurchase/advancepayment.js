$(document).on('click', '#advancepayment_submit', function (e) {
    e.preventDefault();

    var error = 0;
    if ($('#supplier').val() == "") {
        $('#supplier').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#supplier').next().find('.select2-selection').removeClass('select-dropdown-error');

    // var checkedValue = $('input[name="transactiontype"]:checked').val();
    // if (checkedValue == 2) {
    //     if ($('#invoice_no').val() == "") {
    //         $('#invoice_no').next().find('.select2-selection').addClass('select-dropdown-error');
    //         error++;
    //     } else
    //         $('#invoice_no').next().find('.select2-selection').removeClass('select-dropdown-error');
    // } else
    //     $('#invoice_no').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#date').val() == "") {
        $('#date').addClass('is-invalid');
        error++;
    } else {
        $('#date').removeClass('is-invalid');
    }


    var totalRowCount = 0;
    var accountledger_debitaccount = [];
    $("select[name^='accountledger_debitaccount[]']").each(function (input) {
        totalRowCount++;
        accountledger_debitaccount.push($(this).val());
        if ($(this).val() == "") {
            $(this).next().find('.select2-selection').addClass('select-dropdown-error');
            error++;
        } else
            $(this).next().find('.select2-selection').removeClass('select-dropdown-error');
    });
    if (totalRowCount == 0) {
        toastr.warning("Please Select Debit Account !");
        return false;
    }

    var amount = [];
    $("input[name^='amount[]']").each(function (input) {
        amount.push($(this).val());
        if (($(this).val() == "") || ($(this).val() == 0)) {
            $(this).addClass('is-invalid');
            error++;
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    var preference = [];
    $("input[name^='preference[]']").each(function (input) {
        preference.push($(this).val());
    });
    if (error != 0) {
        toastr.warning("Please Remove Validation Error !");
        return false;
    }

    swal.fire({
        title: 'Do you want to save As ?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Approved',
        denyButtonText: 'Draft',
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            saveDetails(result)
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            saveDetails(result)
        } else {
            swal.fire("Cancelled", "", "error");
            $('#advancepayment_submit').removeClass('kt-spinner');
            $('#advancepayment_submit').prop("disabled", false);
        }
    });
    function saveDetails(result) {
        var status = (result.isConfirmed) ? "Approved" : "Draft";
        $('#advancepayment_submit').addClass('kt-spinner');
        $('#advancepayment_submit').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "advancepaymentsubmit_qpurchase",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                supplier: $('#supplier').val(),
                transactiontype: $('input[name="transactiontype"]:checked').val(),
                date: $('#date').val(),
                purchaseno: $('#purchaseno').val(),
                // accountledger_depositaccount: $('#accountledger_depositaccount').val(),
                notes: $('#notes').val(),
                total_amount: $('#total_amount').val(),
                status: status,

                preference: preference,
                accountledger_debitaccount: accountledger_debitaccount,
                amount: amount,

            },
            success: function (data) {
                toastr.success('Successfully Saved');
                $('#advancepayment_submit').removeClass('kt-spinner');
                $('#advancepayment_submit').prop("disabled", false);
                window.location.href = "qpurchase_advancepayment";
            },
            error: function (jqXhr, json, errorThrown) {
                $('#advancepayment_submit').removeClass('kt-spinner');
                $('#advancepayment_submit').prop("disabled", false);
                toastr.error('Error While Save');
                console.log(errorThrown);

            }
        });
    }

});
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
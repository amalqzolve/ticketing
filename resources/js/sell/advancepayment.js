$(document).on('click', '#advancepayment_submit', function (e) {
    e.preventDefault();


    if ($('#customer').val() == "") {
        $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Customer!");
        return false;
    } else {
        $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if ($('#accountledger_depositaccount').val() == "") {
        $('#accountledger_depositaccount').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Customer!");
        return false;
    } else {
        $('#accountledger_depositaccount').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if ($('#totalamount1').val() == 0) {
        toastr.warning("Please Add Any Mode of Payement!");
        return false;
    }


    var modeofpayment = [];
    $("select[name^='modeofpayment[]']").each(function (input) {
        modeofpayment.push($(this).val());
    });

    var amount = [];
    $("input[name^='amount[]']").each(function (input) {
        amount.push($(this).val());
    });

    var preference = [];
    $("input[name^='preference[]']").each(function (input) {
        preference.push($(this).val());
    });

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
            url: "advancepaymentsubmit_sell",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                customer: $('#customer').val(),
                // transactiontype : $('#transactiontype').val(),
                date: $('#date').val(),
                // invoice_no  : $('#invoice_no').val(),
                accountledger_depositaccount: $('#accountledger_depositaccount').val(),
                total_amount: $('#totalamount1').val(),
                notes: $('#notes').val(),
                status: status,
                preference: preference,
                modeofpayment: modeofpayment,
                amount: amount,
            },
            success: function (data) {
                toastr.success('Successfully Saved');
                window.location.href = "advancepayment_sell";
            },
            error: function (jqXhr, json, errorThrown) {
                $('#advancepayment_submit').removeClass('kt-spinner');
                $('#advancepayment_submit').prop("disabled", false);
                toastr.success('Error While Save');
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
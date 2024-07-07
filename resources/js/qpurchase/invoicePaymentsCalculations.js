// $(document).ready(function () {
$('#markPayments').change(function () {
    if (this.checked) {
        $('.markPayments').show();
    } else {
        $('#use_advance').prop('checked', false);
        $('#advance_amt').val(0);
        $('.markPayments').hide();
        $('.useAdvance').hide();
        $('#advance_amt').removeClass('is-invalid');
    }
});
$('#use_advance').change(function () {
    if (this.checked) {
        $('.useAdvance').show();
    } else {
        $('#advance_amt').val(0);
        $('.useAdvance').hide();
        $('#advance_amt').removeClass('is-invalid');
    }
    findSum();
});

$('.addmorepayments').click(function () {
    var tblRowCount = $("#modeofpaymenttable tr").length;
    var $tableBody = $('#modeofpaymenttable').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.clone();
    $trNew.find('td:first').text(tblRowCount);
    $trNew.find('select[name="type[]"]').val('');
    $trNew.find('select[name="debitaccount[]"]').val('');
    $trNew.find('input[name="reference[]"]').val('');
    $trNew.find('input[name="pay_amount[]"]').val('0');
    $trLast.after($trNew);
});


$('body').on('keyup', "#advance_amt", function (e) {
    findSum();
    chekPayFromAdvance();
});

$('body').on('keyup', "input[name^='pay_amount[]']", function (e) {
    findSum();
});


$("body").on("click", ".costremove_payments", function (event) {
    event.preventDefault();
    var tblRowCount = $("#modeofpaymenttable tr").length;
    if (tblRowCount > 2) {
        var row = $(this).closest('tr');
        var siblings = row.siblings();
        row.remove();
        siblings.each(function (index) {
            $(this).children().first().text(index + 1);
        });
    } else {
        $('select[name="type[]"]').val('');
        $('select[name="debitaccount[]"]').val('');
        $('input[name="reference[]"]').val('');
        $('input[name="pay_amount[]"]').val('0');
    }
    findSum();
});

function findSum() {
    var totalPayAmount = 0;
    $("input[name^='pay_amount[]']").each(function (input) {
        totalPayAmount += parseFloat(($(this).val() != '') ? $(this).val() : 0);
    });
    totalPayAmount += parseFloat(($('#advance_amt').val() != '') ? $('#advance_amt').val() : 0);
    $('#paidamount').val(totalPayAmount);
    var totalinvoicedamount = parseFloat(($('#grandtotalamount').val() != '') ? $('#grandtotalamount').val() : 0);
    $('#totalinvoicedamount').val(totalinvoicedamount);
    var totalBalanceAmount = totalinvoicedamount - totalPayAmount;
    $('#balanceamount').val(totalBalanceAmount.toFixed(2));

    if (totalBalanceAmount < 0) {
        if ($('#use_advance').prop('checked') == true)
            $("#advance_amt").addClass('is-invalid');
        else
            $("#advance_amt").removeClass('is-invalid');
        $("input[name^='pay_amount[]']").addClass('is-invalid');
    } else {
        $("input[name^='pay_amount[]']").removeClass('is-invalid');
        $("#advance_amt").removeClass('is-invalid');
    }
}

function checkPayements() {
    var error = 0;
    if ($('#markPayments').prop('checked') == true) {
        if ($('#use_advance').prop('checked') == true) {//chek advance
            var chk = chekPayFromAdvance();
            (chk == 0) ? error++ : '';
        }

        var totalPayAmount = 0;
        $("input[name^='pay_amount[]']").each(function (input) {
            totalPayAmount += parseFloat(($(this).val() != '') ? $(this).val() : 0);
        });
        totalPayAmount += parseFloat(($('#advance_amt').val() != '') ? $('#advance_amt').val() : 0);
        var totalinvoicedamount = parseFloat(($('#grandtotalamount').val() != '') ? $('#grandtotalamount').val() : 0);
        var totalBalanceAmount = totalinvoicedamount - totalPayAmount;
        if (totalBalanceAmount < 0) {
            toastr.error('Total Invoiced Amount must be smaller than Total Paid Amount');
            error++
        }

        if (parseFloat($('#advance_amt').val()) != parseFloat($('#paidamount').val())) {
            $("select[name^='type[]']").each(function (input) {
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    error++;
                } else
                    $(this).removeClass('is-invalid');
            });
            $("select[name^='debitaccount[]']").each(function (input) {
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    error++;
                } else
                    $(this).removeClass('is-invalid');
            });
            $("input[name^='pay_amount[]']").each(function (input) {
                if (($(this).val() == 0) || ($(this).val() == '')) {
                    $(this).addClass('is-invalid');
                    error++;
                } else
                    $(this).removeClass('is-invalid');
            });
        }
        return error;
        // $('#advance_amt').addClass('is-invalid')
    } else
        return 0;
}

function chekPayFromAdvance() {
    var existBalance = parseFloat(($('#debitBalance').val() != '') ? $('#debitBalance').val() : 0);//$('#creditBalance').val(); //
    var enterAdv = parseFloat(($('#advance_amt').val() != '') ? $('#advance_amt').val() : 0);//$('#advance_amt').val(); //
    if (existBalance < enterAdv) {
        toastr.error('Please Enter a valid Pay from Advance');
        $('#advance_amt').addClass('is-invalid');
        return 0;
    } else
        return 1;
}



// });
function tableForwardCalculation() {
    var rowcount = $('#product_table tr').length;

    var totalAmt = 0;
    var totalDiscount = 0;
    var totalAmountAfterDiscount = 0;
    var totalVatAmount = 0;
    var grandTotalAmount = 0;

    for (let rowId = 1; rowId <= rowcount; rowId++) {
        var qty = getNumAsFloat($('#quantity' + rowId).val());
        var rate = getNumAsFloat($('#rate' + rowId).val());
        var amt = qty * rate;
        totalAmt += amt;
        $('#amount' + rowId).val(amt.toFixed(2));//
        var discountType = $('#discount_type').val(); //1=>Flat,2=>Percentage

        var discEnterAmount = getNumAsFloat($('#discountamount' + rowId).val());

        var rowDiscountAmount = (discountType == 1) ? discEnterAmount : ((amt * discEnterAmount) / 100);
        totalDiscount += rowDiscountAmount;

        var vatPercentage = getNumAsFloat($('#vat_percentage' + rowId).val());
        var amountAfterDiscount = amt - rowDiscountAmount;
        totalAmountAfterDiscount += amountAfterDiscount;
        var vatAmount = (amountAfterDiscount * vatPercentage) / 100;
        totalVatAmount += vatAmount;
        $('#vatamount' + rowId).val(vatAmount.toFixed(2));

        var rowTotal = amountAfterDiscount + vatAmount;
        grandTotalAmount += rowTotal;

        $('#row_total' + rowId).val(rowTotal.toFixed(2));
    }

    $('#totalamount').val(totalAmt.toFixed(2));
    $('#discount').val(totalDiscount.toFixed(2));
    $('#amountafterdiscount').val(totalAmountAfterDiscount.toFixed(2));
    $('#totalvatamount').val(totalVatAmount.toFixed(2));
    $('#grandtotalamount').val(grandTotalAmount.toFixed(2));
}


function getNumAsFloat(val) {
    if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
        return 0;
    }
    return parseFloat(val);
}
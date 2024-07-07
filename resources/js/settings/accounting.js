$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;
    //  ledjer 
    if ($('#default_customer_ledger').val() == "") {
        $('#default_customer_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#default_customer_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#default_supplier_ledger').val() == "") {
        $('#default_supplier_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#default_supplier_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#sales_invoice_ledger').val() == "") {
        $('#sales_invoice_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#sales_invoice_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#sales_invoice_vat_ledger').val() == "") {
        $('#sales_invoice_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#sales_invoice_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#sales_return_ledger').val() == "") {
        $('#sales_return_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#sales_return_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');


    if ($('#sales_return_vat_ledger').val() == "") {
        $('#sales_return_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#sales_return_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

    // ./ ledjer 

    if ($('#sales_invoice_entry_type').val() == "") {
        $('#sales_invoice_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#sales_invoice_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');


    if (!error) {
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "settingsaccountssubmit",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                //    ledger
                default_customer_ledger: $('#default_customer_ledger').val(),
                default_supplier_ledger: $('#default_supplier_ledger').val(),

                sales_invoice_ledger: $('#sales_invoice_ledger').val(),
                sales_invoice_vat_ledger: $('#sales_invoice_vat_ledger').val(),
                sales_return_ledger: $('#sales_return_ledger').val(),
                sales_return_vat_ledger: $('#sales_return_vat_ledger').val(),
                // ./   ledger

                // entry_type
                sales_invoice_entry_type: $('#sales_invoice_entry_type').val(),
                sales_return_entry_type: $('#sales_return_entry_type').val(),
                sales_billsettilement_entry_type: $('#sales_billsettilement_entry_type').val(),
                sales_adwance_entry_type: $('#sales_adwance_entry_type').val(),
                // ./ entry_type

            },
            success: function (data) {
                if (data.status == 1)
                    toastr.success('Data Saved Success');
                $('#btnSave').removeClass('kt-spinner');
                $('#btnSave').prop("disabled", false);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Please Filll Mandatory Fieldes');
});

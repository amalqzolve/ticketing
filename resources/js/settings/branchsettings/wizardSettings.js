wizard = new KTWizard('kt_wizard_v2', {
    startStep: 1, // Initial active step number
    clickableSteps: true, // Allow step clicking
});
wizard.on('beforeNext', function (wizardObj) {
    console.log(wizardObj); //
    var canGoNextStep = 1;
    if (wizardObj.currentStep == 1) {
        if ($('#company_name').val() == "") {
            $('#company_name').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#company_name').removeClass('is-invalid');

        if ($('#country').val() == "") {
            $('#country').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#country').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#company_cr').val() == "") {
            $('#company_cr').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#company_cr').removeClass('is-invalid');


        if ($('#company_vat').val() == "") {
            $('#company_vat').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#company_vat').removeClass('is-invalid');

    } else if (wizardObj.currentStep == 4) {
        if (($('#pdfheader_top').val() == "") || ($('#pdfheader_top').val() == 0)) {
            $('#pdfheader_top').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#pdfheader_top').removeClass('is-invalid');


        if (($('#pdffooter_bottom').val() == "") || ($('#pdffooter_bottom').val() == 0)) {
            $('#pdffooter_bottom').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#pdffooter_bottom').removeClass('is-invalid');

        if (($('#pdfletterheader_top').val() == "") || ($('#pdfletterheader_top').val() == 0)) {
            $('#pdfletterheader_top').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#pdfletterheader_top').removeClass('is-invalid');

        if (($('#pdfletterfooter_bottom').val() == "") || ($('#pdfletterfooter_bottom').val() == 0)) {
            $('#pdfletterfooter_bottom').addClass('is-invalid');
            canGoNextStep = 0;
        } else
            $('#pdfletterfooter_bottom').removeClass('is-invalid');
    } else if (wizardObj.currentStep == 5) {

        if ($('#default_customer_ledger').val() == "") {
            $('#default_customer_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#default_customer_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#default_supplier_ledger').val() == "") {
            $('#default_supplier_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#default_supplier_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_invoice_ledger').val() == "") {
            $('#sales_invoice_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_invoice_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_invoice_vat_ledger').val() == "") {
            $('#sales_invoice_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_invoice_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_return_ledger').val() == "") {
            $('#sales_return_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_return_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_return_vat_ledger').val() == "") {
            $('#sales_return_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_return_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_invoice_ledger').val() == "") {
            $('#purchase_invoice_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_invoice_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_invoice_vat_ledger').val() == "") {
            $('#purchase_invoice_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_invoice_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_return_ledger').val() == "") {
            $('#purchase_return_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_return_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_return_vat_ledger').val() == "") {
            $('#purchase_return_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_return_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_invoice_entry_type').val() == "") {
            $('#sales_invoice_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_invoice_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_invoice_entry_type').val() == "") {
            $('#purchase_invoice_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_invoice_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_return_entry_type').val() == "") {
            $('#sales_return_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_return_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_return_entry_type').val() == "") {
            $('#purchase_return_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_return_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_billsettilement_entry_type').val() == "") {
            $('#sales_billsettilement_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_billsettilement_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_billsettilement_entry_type').val() == "") {
            $('#purchase_billsettilement_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_billsettilement_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_adwance_entry_type').val() == "") {
            $('#sales_adwance_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#sales_adwance_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_adwance_entry_type').val() == "") {
            $('#purchase_adwance_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            canGoNextStep = 0;
        } else
            $('#purchase_adwance_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (!canGoNextStep)
        wizardObj.stop();

});
wizard.on('change', function (wizardObj) {

    if (wizardObj.currentStep > 4) { // on stage 1
        if ($('#company_name').val() == "") {
            $('#company_name').addClass('is-invalid');
            wizardObj.goTo(1);
            return '';
        } else
            $('#company_name').removeClass('is-invalid');

        if ($('#country').val() == "") {
            $('#country').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(1);
            return '';
        } else
            $('#country').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#company_cr').val() == "") {
            $('#company_cr').addClass('is-invalid');
            wizardObj.goTo(1);
            return '';
        } else
            $('#company_cr').removeClass('is-invalid');


        if ($('#company_vat').val() == "") {
            $('#company_vat').addClass('is-invalid');
            wizardObj.goTo(1);
            return '';
        } else
            $('#company_vat').removeClass('is-invalid');
    }

    if (wizardObj.currentStep > 4) { // on stage 4
        if (($('#pdfheader_top').val() == "") || ($('#pdfheader_top').val() == 0)) {
            $('#pdfheader_top').addClass('is-invalid');
            wizardObj.goTo(4);
            return '';
        } else
            $('#pdfheader_top').removeClass('is-invalid');


        if (($('#pdffooter_bottom').val() == "") || ($('#pdffooter_bottom').val() == 0)) {
            $('#pdffooter_bottom').addClass('is-invalid');
            wizardObj.goTo(4);
            return '';
        } else
            $('#pdffooter_bottom').removeClass('is-invalid');

        if (($('#pdfletterheader_top').val() == "") || ($('#pdfletterheader_top').val() == 0)) {
            $('#pdfletterheader_top').addClass('is-invalid');
            wizardObj.goTo(4);
            return '';
        } else
            $('#pdfletterheader_top').removeClass('is-invalid');

        if (($('#pdfletterfooter_bottom').val() == "") || ($('#pdfletterfooter_bottom').val() == 0)) {
            $('#pdfletterfooter_bottom').addClass('is-invalid');
            wizardObj.goTo(4);
            return '';
        } else
            $('#pdfletterfooter_bottom').removeClass('is-invalid');
    }
    if (wizardObj.currentStep > 5) { // on stage 5

        if ($('#default_customer_ledger').val() == "") {
            $('#default_customer_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#default_customer_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#default_supplier_ledger').val() == "") {
            $('#default_supplier_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#default_supplier_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_invoice_ledger').val() == "") {
            $('#sales_invoice_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_invoice_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_invoice_vat_ledger').val() == "") {
            $('#sales_invoice_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_invoice_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_return_ledger').val() == "") {
            $('#sales_return_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_return_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_return_vat_ledger').val() == "") {
            $('#sales_return_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_return_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_invoice_ledger').val() == "") {
            $('#purchase_invoice_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_invoice_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_invoice_vat_ledger').val() == "") {
            $('#purchase_invoice_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_invoice_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_return_ledger').val() == "") {
            $('#purchase_return_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_return_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_return_vat_ledger').val() == "") {
            $('#purchase_return_vat_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_return_vat_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_invoice_entry_type').val() == "") {
            $('#sales_invoice_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_invoice_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_invoice_entry_type').val() == "") {
            $('#purchase_invoice_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_invoice_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_return_entry_type').val() == "") {
            $('#sales_return_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_return_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_return_entry_type').val() == "") {
            $('#purchase_return_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_return_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_billsettilement_entry_type').val() == "") {
            $('#sales_billsettilement_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_billsettilement_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_billsettilement_entry_type').val() == "") {
            $('#purchase_billsettilement_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_billsettilement_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#sales_adwance_entry_type').val() == "") {
            $('#sales_adwance_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#sales_adwance_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        if ($('#purchase_adwance_entry_type').val() == "") {
            $('#purchase_adwance_entry_type').next().find('.select2-selection').addClass('select-dropdown-error');
            wizardObj.goTo(5);
        } else
            $('#purchase_adwance_entry_type').next().find('.select2-selection').removeClass('select-dropdown-error');

    }
});

$('#company_name').change(function () {
    $('.company_name_summary').text($(this).val());
});


$('#building_no').change(function () {
    $('.building_no_summary').text($(this).val());
});

$('#street_name').change(function () {
    $('.street_name_summary').text($(this).val());
});

$('#district').change(function () {
    $('.district_summary').text($(this).val());
});

$('#province_state').change(function () {
    $('.province_state_summary').text($(this).val());
});

$('#city').change(function () {
    $('.city_summary').text($(this).val());
});


$('#country').change(function () {
    var selectedText = $('option:selected', this).text();
    $('.country_summary').text(selectedText);
});

$('#postal_code').change(function () {
    $('.postal_code_summary').text($(this).val());
});

$('#phone_number').change(function () {
    $('.phone_number_summary').text($(this).val());
});

$('#company_cr').change(function () {
    $('.company_cr_summary').text($(this).val());
});

$('#company_vat').change(function () {
    $('.company_vat_summary').text($(this).val());
});

// images

$('#fileDataSeal').change(function () {
    alert($(this).val());
});


$('#pdfheader_top').change(function () {
    $('.pdfheader_top_summary').text($(this).val());
});

$('#pdffooter_bottom').change(function () {
    $('.pdffooter_bottom_summary').text($(this).val());
});

$('#pdfletterheader_top').change(function () {
    $('.pdfletterheader_top_summary').text($(this).val());
});

$('#pdfletterfooter_bottom').change(function () {
    $('.pdfletterfooter_bottom_summary').text($(this).val());
});



$('#default_customer_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.default_customer_ledger_summary').text(slelctedTrimmed);
});

$('#country').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.country_summary').text(slelctedTrimmed);
});

$('#default_supplier_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.default_supplier_ledger_summary').text(slelctedTrimmed);
});

$('#sales_invoice_vat_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_invoice_vat_ledger_summary').text(slelctedTrimmed);
});

$('#sales_return_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_return_ledger_summary').text(slelctedTrimmed);
});

$('#sales_return_vat_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_return_vat_ledger_summary').text(slelctedTrimmed);
});

$('#purchase_invoice_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_invoice_ledger_summary').text(slelctedTrimmed);
});

$('#purchase_invoice_vat_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_invoice_vat_ledger_summary').text(slelctedTrimmed);
});

$('#purchase_return_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_return_ledger_summary').text(slelctedTrimmed);
});

$('#purchase_return_vat_ledger').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_return_vat_ledger_summary').text(slelctedTrimmed);
});

$('#sales_invoice_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_invoice_entry_type_summary').text(slelctedTrimmed);
});

$('#purchase_invoice_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_invoice_entry_type_summary').text(slelctedTrimmed);
});

$('#sales_return_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_return_entry_type_summary').text(slelctedTrimmed);
});

$('#purchase_return_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_return_entry_type_summary').text(slelctedTrimmed);
});

$('#sales_billsettilement_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_billsettilement_entry_type_summary').text(slelctedTrimmed);
});

$('#purchase_billsettilement_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_billsettilement_entry_type_summary').text(slelctedTrimmed);
});

$('#sales_adwance_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_adwance_entry_type_summary').text(slelctedTrimmed);
});

$('#purchase_adwance_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_adwance_entry_type_summary').text(slelctedTrimmed);
});

$('#sales_return_refund_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.sales_return_refund_entry_type_summary').text(slelctedTrimmed);
});

$('#purchase_return_refund_entry_type').change(function () {
    var selectedText = $('option:selected', this).text();
    var slelctedTrimmed = selectedText.replace(/\s/g, '');
    $('.purchase_return_refund_entry_type_summary').text(slelctedTrimmed);
});
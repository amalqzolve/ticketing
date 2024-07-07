<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class BranchSettingsModel extends Model
{
    //
    protected $table = 'qsettings_company';
    protected $fillable = [
        'company_name',  'building_no', 'street_name', 'district', 'province_state', 'city', 'country', 'postal_code', 'phone_number', 'company_cr', 'company_vat',

        'companylogo', 'seal', 'pdfheader', 'pdffooter',

        'preview', 'pdfletterheader_top', 'pdfletterfooter_bottom', 'pdfheader_top', 'pdffooter_bottom',

        'common_customer_database',

        'storeavailable',  'salesquotation', 'salesorder', 'deliveryorder', 'purchaseorder', 'proformainvoice', 'salesinvoice', 'salesreturn', 'purchasereturn', 'debitnote', 'creditnote', 'advancerequest', 'paymentrequest', 'advancereceipt', 'paymentreceipt',

        'salesquotation_sufix', 'salesorder_sufix', 'deliveryorder_sufix', 'purchaseorder_sufix', 'proformainvoice_sufix', 'salesinvoice_sufix', 'salesreturn_sufix', 'purchasereturn_sufix', 'debitnote_sufix', 'creditnote_sufix', 'advancerequest_sufix', 'paymentrequest_sufix', 'advancereceipt_sufix', 'paymentreceipt_sufix',

        'default_customer_ledger', 'default_supplier_ledger', 'sales_invoice_ledger', 'sales_invoice_vat_ledger', 'sales_return_ledger', 'sales_return_vat_ledger', 'purchase_invoice_ledger', 'purchase_invoice_vat_ledger', 'purchase_return_ledger', 'purchase_return_vat_ledger', 'sales_invoice_entry_type', 'sales_return_entry_type', 'sales_billsettilement_entry_type', 'sales_adwance_entry_type', 'sales_return_refund_entry_type', 'purchase_invoice_entry_type', 'purchase_return_entry_type', 'purchase_billsettilement_entry_type', 'purchase_adwance_entry_type', 'purchase_return_refund_entry_type',

        'branch', 'settings_completed',


    ];

    protected static $logOnlyDirty = true;
}

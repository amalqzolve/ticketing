<?php
namespace App\crm;
use Illuminate\Database\Eloquent\Model;
class Vendor_documents_Model extends Model
{
    protected $table    = 'qcrm_vendors_documents';
    protected $fillable = ['vendor_id', 'vat_no', 'license_no', 'cr_no', 'vat_expiring_date', 'license_expiring_date', 'cr_expiring_date', 'no_of_invoices', 'credit_period_of_each_invoices', 'total_amount', 'credit_period_of_total_invoices', 'payment_terms', 'description', 'contract_no', 'contractno_expiry_date', 'documents','branch'];
    protected static $logOnlyDirty = true;
}


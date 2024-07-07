<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoInvoiceModel extends Authenticatable
{
    protected $table = 'epr_po_invoice';
    protected $fillable = [
        'version',
        'epr_id',
        'po_id',
        'supplier_invoice_number',
        'supplier_invoice_date',
        'supplier_invoice_over_due_date',
        'supplier_invoice_credit_period',
        'bill_entry_date',
        'quotedate',
        'dateofsupply',
        'request_type',
        'mr_category',
        'request_priority',
        'request_against',
        'client',
        'project',
        'supplier_id',
        'internalreference',
        'notes',
        'terms',
        // 'totalamount',
        // 'discount',
        // 'amountafterdiscount',
        // 'totalvatamount',
        'grandtotalamount',
        'user_id',
        'status',
        'supplier_payment_status',
        'po_status'
    ];
    protected static $logOnlyDirty = true;
}

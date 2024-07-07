<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoModel extends Authenticatable
{
    protected $table = 'epr_po';
    protected $fillable = [
        'version',
        'epr_id',
        'rfq_id',
        'po_date',
        'po_valid_till',
        'delivery_terms',
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
        'totalamount',
        'discount',
        'amountafterdiscount',
        'totalvatamount',
        'grandtotalamount',
        'issued_payemnts_amount',
        'user_id',
        'status',
        'po_status',
        'grn_status',
        'warehouse_received_qty',
        'invoice_status',
        'created_at',
        'po_closed'
    ];
    protected static $logOnlyDirty = true;
}

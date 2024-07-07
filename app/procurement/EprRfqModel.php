<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprRfqModel extends Authenticatable
{
    protected $table = 'epr_rfq';
    protected $fillable = [
        'epr_id',
        'supp_quot_id',
        'quot_date',
        'quote_valid_date',
        'rfq_date',
        'rfq_valid_till',
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
        'user_id',
        'totalamount',
        'discount',
        'amountafterdiscount',
        'totalvatamount',
        'grandtotalamount',
        'status',
        'rfq_submitted',
        'po_status'
    ];
    protected static $logOnlyDirty = true;
}

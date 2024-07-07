<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoRevisedModel extends Authenticatable
{
    protected $table = 'epr_po_revised';
    protected $fillable = [
        'version',
        'epr_id',
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
        'user_id',
        'status',
        'po_status'
    ];
    protected static $logOnlyDirty = true;
}

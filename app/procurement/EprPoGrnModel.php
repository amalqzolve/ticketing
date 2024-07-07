<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoGrnModel extends Authenticatable
{
    protected $table = 'epr_po_grn';
    protected $fillable = [
        'version',
        'epr_id',
        'po_id',
        'mr_category',
        'supplier_id',
        'internalreference',
        'notes',
        'terms',
        'grn_created_date',
        'grn_date',
        'total_qty',
        'user_id',
        'status',
        'po_status'
    ];
    protected static $logOnlyDirty = true;
}

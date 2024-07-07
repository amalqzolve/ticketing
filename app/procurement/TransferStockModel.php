<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class TransferStockModel extends Authenticatable
{
    protected $table = 'epr_transfer_stock';
    protected $fillable = [
        'epr_id',
        'stock_transfer_id',
        'transfer_date',
        'delivery_terms',
        'total_qty',
        'internalreference',
        'notes',
        'terms',
        'user_id',
        'status',
        'received_status',
        'received_comment',
        'received_at',
        'created_at',
        'updated_at'
    ];
    protected static $logOnlyDirty = true;
}

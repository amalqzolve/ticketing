<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class StockTransferRevisedModel extends Authenticatable
{
    protected $table = 'epr_stock_transfer_reviced';
    protected $fillable = [
        'version',
        'epr_id',
        'warehouse',
        't_req_date',
        'delivery_terms',
        'total_qty',
        'internalreference',
        'notes',
        'terms',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];
    protected static $logOnlyDirty = true;
}

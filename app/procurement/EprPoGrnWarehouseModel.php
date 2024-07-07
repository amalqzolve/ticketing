<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoGrnWarehouseModel extends Authenticatable
{
    protected $table = 'epr_po_grn_warehouse'; //warehouse or project Transfer 
    protected $fillable = [
        'version',
        'epr_id',
        'po_id',
        'grn_id',
        'transfer_type',
        'warehouse_id',
        'warehouse_transfer_date',
        'internalreference',
        'notes',
        'terms',
        'user_id',
        'status',
        'warehouse_receive_status'
    ];
    protected static $logOnlyDirty = true;
}

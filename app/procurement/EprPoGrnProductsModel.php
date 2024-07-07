<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoGrnProductsModel extends Authenticatable
{
    protected $table = 'epr_po_grn_products';
    protected $fillable = [
        'epr_po_grn_id',
        'epr_po_product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'send_to_warehouse_qty'
    ];
    protected static $logOnlyDirty = true;
}

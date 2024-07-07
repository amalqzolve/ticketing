<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoGrnWareHouseProductsModel extends Authenticatable
{
    protected $table = 'epr_po_grn_warehouse_products';
    protected $fillable = [
        'epr_po_grn_warehouse_id',
        'epr_po_product_id',
        'epr_po_grn_product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'deleted'
    ];
    protected static $logOnlyDirty = true;
}

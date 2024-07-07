<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class StockTransferProductsModel extends Authenticatable
{
    protected $table = 'epr_stock_transfer_products';
    protected $fillable = [
        'epr_stock_transfer_id',
        'epr_product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'trns_qty',
        'branch',
    ];
    protected static $logOnlyDirty = true;
}

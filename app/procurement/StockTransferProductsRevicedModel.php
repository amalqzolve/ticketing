<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class StockTransferProductsRevicedModel extends Authenticatable
{
    protected $table = 'epr_stock_transfer_products_reviced';
    protected $fillable = [
        'epr_stock_transfer_id',
        'epr_product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'branch',
    ];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class TransferStockProductsModel extends Authenticatable
{
    protected $table = 'epr_transfer_stock_products';
    protected $fillable = [
        'epr_transfer_stock_id',
        'epr_product_id',
        'stock_transfer_product_id',
        'quantity',
        'branch',
    ];
    protected static $logOnlyDirty = true;
}

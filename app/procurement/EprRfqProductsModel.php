<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprRfqProductsModel extends Authenticatable
{
    protected $table = 'epr_rfq_products';
    protected $fillable = [
        'epr_product_id',
        'epr_rfq_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'rate',
        'amount',
        'discont',
        'vat',
        'vat_amount',
        'total',
        'branch',
    ];
    protected static $logOnlyDirty = true;
}

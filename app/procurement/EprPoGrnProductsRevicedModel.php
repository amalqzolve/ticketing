<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoGrnProductsRevicedModel extends Authenticatable
{
    protected $table = 'epr_po_grn_products_reviced';
    protected $fillable = [
        'epr_po_grn_id',
        'epr_po_product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
    ];
    protected static $logOnlyDirty = true;
}
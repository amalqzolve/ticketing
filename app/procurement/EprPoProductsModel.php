<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoProductsModel extends Authenticatable
{
    protected $table = 'epr_po_products';
    protected $fillable = [
        'epr_po_id',
        'epr_product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'grn_generated_qty',
        'rate',
        'amount',
        'discont',
        'vat',
        'vat_amount',
        'total',
        'invoice_generated_amount_total',
        'branch',
    ];
    protected static $logOnlyDirty = true;
}

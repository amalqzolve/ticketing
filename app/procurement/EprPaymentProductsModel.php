<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPaymentProductsModel extends Authenticatable
{
    protected $table = 'epr_payment_products';
    protected $fillable = [
        'epr_payment_id',
        'epr_po_product_id',
        'epr_po_invoice_product_id',
        'supplier_payment_product_id',
        'amount'
    ];
    protected static $logOnlyDirty = true;
}

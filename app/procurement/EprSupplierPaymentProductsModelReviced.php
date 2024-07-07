<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprSupplierPaymentProductsModelReviced extends Authenticatable
{
    protected $table = 'epr_supplier_payment_products_reviced';
    protected $fillable = [
        'epr_supplier_payment_id',
        'epr_po_product_id',
        'epr_po_invoice_product_id',
        'amount',
        'next_level_amount'
    ];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPoInvoiceProductsModel extends Authenticatable
{
    protected $table = 'epr_po_invoice_products';
    protected $fillable = [
        'epr_po_invoice_id',
        'epr_po_product_id',
        'itemname',
        'description',
        'amount',
        'payment_created_amount'
    ];
    protected static $logOnlyDirty = true;
}

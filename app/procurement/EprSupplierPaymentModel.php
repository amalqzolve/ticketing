<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprSupplierPaymentModel extends Authenticatable
{
    protected $table = 'epr_supplier_payment';
    protected $fillable = [
        'version',
        'epr_id',
        'po_id',
        'invoice_id',
        'payement_book_date',
        'terms',
        'internalreference',
        'notes',
        'grandtotalamount',
        'user_id',
        'status',
        'payment_voucher_status'
    ];
    protected static $logOnlyDirty = true;
}

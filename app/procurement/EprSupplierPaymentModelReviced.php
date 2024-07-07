<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprSupplierPaymentModelReviced extends Authenticatable
{
    protected $table = 'epr_supplier_payment_reviced';
    protected $fillable = [
        'version',
        'epr_id',
        'po_id',
        'invoice_id',
        'status'
    ];
    protected static $logOnlyDirty = true;
}

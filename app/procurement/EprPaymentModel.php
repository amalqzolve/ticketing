<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPaymentModel extends Authenticatable
{
    protected $table = 'epr_payment';
    protected $fillable = [
        'version',
        'epr_id',
        'po_id',
        'invoice_id',
        'supplier_payment_id',
        'status'
    ];
    protected static $logOnlyDirty = true;
}

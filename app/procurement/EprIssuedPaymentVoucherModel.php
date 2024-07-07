<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprIssuedPaymentVoucherModel extends Authenticatable
{
    protected $table = 'epr_issued_payment_voucher';
    protected $fillable = [
        'epr_id',
        'po_id',
        'invoice_id',
        'supplier_payement_id', //from epr 
        'buy_voucher_id', //from 
        'supplier_id',
        'voucher_id',
        'receiver_name',
        'relation_with_supplier',
        'designation',
        'department',
        'national_id',
        'phone_number',
        'issued_date',
        'comments',
        'internalreference',
        'notes',
        'terms',
        'created_by',
        'status'
    ];
    protected static $logOnlyDirty = true;
}

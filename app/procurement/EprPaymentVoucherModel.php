<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprPaymentVoucherModel extends Authenticatable
{
    protected $table = 'epr_payment_voucher';
    protected $fillable = [
        'epr_id',
        'po_id',
        'invoice_id',
        'supplier_payement_id', //from epr
        'buy_voucher_id', //from voucher 
        'supplier_id',
        'payment_cr_account',
        'voucher_date',
        'voucher_notes',
        'voucher_reference',
        'amount',
        'payment_method',
        'cash_transaction_id',
        'cash_transaction_referance',
        'bank_account',
        'bank_transaction_id',
        'bank_transaction_referance',
        'cheque_number',
        'cheque_date',
        'cheque_transaction_id',
        'cheque_transaction_referance',
        'card_transaction_id',
        'card_transaction_reference',
        'internalreference',
        'notes',
        'terms',
        'status',
        'created_by',
    ];
    protected static $logOnlyDirty = true;
}

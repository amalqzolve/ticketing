<?php

namespace App\vouchers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EmailVerifyKeysVoucherModel extends Authenticatable
{
    protected $table = 'email_verify_keys_voucher';
    protected $fillable = [
        'email',
        'doc_type',
        'doc_id',
        'transaction_id',
        'token',
        'created_at',
    ];
    protected static $logOnlyDirty = true;
}

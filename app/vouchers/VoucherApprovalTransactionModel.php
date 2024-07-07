<?php

namespace App\vouchers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class VoucherApprovalTransactionModel extends Authenticatable
{
    protected $table = 'voucher_approval_transaction';
    protected $fillable = [
        'voucher_synthesis_id',
        'voucher_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

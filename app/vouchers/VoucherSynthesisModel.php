<?php

namespace App\vouchers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class VoucherSynthesisModel extends Authenticatable
{
    protected $table = 'voucher_synthesis';
    protected $fillable = [
        'id',
        'qsettings_voucher_id',
        'priority',
        'user_id',
        'if_accepted_note',
        'if_rejected_note',
        'branch',
        'created_by',
        'status',
        'del_flag'
    ];
    protected static $logOnlyDirty = true;
}

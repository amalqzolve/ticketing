<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class PoApprovalTransactionModel extends Authenticatable
{
    protected $table = 'epr_po_approval_transaction';
    protected $fillable = [
        'poworkflow_id',
        'po_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by',
    ];
    protected static $logOnlyDirty = true;
}

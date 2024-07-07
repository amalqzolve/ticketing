<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprApprovalTransactionModel extends Authenticatable
{
    protected $table = 'epr_approval_transaction';
    protected $fillable = [
        'mrworkflow_id',
        'epr_id', //material_request_id
        'created_by',
        'status',
        'del_flag',
        'status_changed_by',
        'comments'
    ];
    protected static $logOnlyDirty = true;
}

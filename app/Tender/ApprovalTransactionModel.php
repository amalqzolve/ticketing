<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class ApprovalTransactionModel extends Authenticatable
{
    protected $table = 'approval_transaction';
    protected $fillable = [
        'category_synthesis_id',
        'tender_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

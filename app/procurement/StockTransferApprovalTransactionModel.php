<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class StockTransferApprovalTransactionModel extends Authenticatable
{
    protected $table = 'epr_stock_transfer_approval_transaction';
    protected $fillable = [
        'stock_transfer_workflow_id',
        'stock_transfer_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

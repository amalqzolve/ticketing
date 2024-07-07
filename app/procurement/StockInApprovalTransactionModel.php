<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class StockInApprovalTransactionModel extends Authenticatable
{
    protected $table = 'stock_in_approval_transaction';
    protected $fillable = [
        'stock_in_workflow_id',
        'epr_po_grn_warehouse_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

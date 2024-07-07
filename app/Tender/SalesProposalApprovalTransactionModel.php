<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SalesProposalApprovalTransactionModel extends Authenticatable
{
    protected $table = 'sales_proposal_approval_transaction';
    protected $fillable = [
        'sales_proposal_category_synthesis_id',
        'sales_proposal_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

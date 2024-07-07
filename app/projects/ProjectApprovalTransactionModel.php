<?php

namespace App\projects;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class ProjectApprovalTransactionModel extends Authenticatable
{
    protected $table = 'project_approval_transaction';
    protected $fillable = [
        'project_category_synthesis_id',
        'project_id',
        'comment',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

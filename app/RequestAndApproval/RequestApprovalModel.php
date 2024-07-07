<?php

namespace App\RequestAndApproval;

use Illuminate\Database\Eloquent\Model;

class RequestApprovalModel extends Model
{
    protected $table = 'request_approval';
    protected $fillable = ['request_id', 'user', 'approve_type', 'comment', 'status'];
}

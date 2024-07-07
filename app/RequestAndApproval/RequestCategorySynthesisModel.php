<?php

namespace App\RequestAndApproval;

use Illuminate\Database\Eloquent\Model;

class RequestCategorySynthesisModel extends Model
{
    protected $table = 'request_category_synthesis'; //mrworkflow
    protected $fillable = [
        'id',
        'cat_id',
        'priority',
        'user_id',
        'if_accepted_note',
        'if_rejected_note',
        'branch',
        'created_by',
        'status',
        'del_flag'
    ];
}

<?php

namespace App\projects;

use Illuminate\Foundation\Auth\User as Authenticatable;


class ProjectCategorySynthesisModel extends Authenticatable
{
    protected $table = 'project_category_synthesis';
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
    protected static $logOnlyDirty = true;
}

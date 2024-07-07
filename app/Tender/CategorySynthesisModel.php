<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class CategorySynthesisModel extends Authenticatable
{
    protected $table = 'category_synthesis';
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

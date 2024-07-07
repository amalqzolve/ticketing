<?php

namespace App\costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class EstimationCategoryModel extends Authenticatable
{
    protected $table = 'estimation_category';
    protected $fillable = [
        'estimation_id',
        'boq_id',
        'cost_category_id',
        'percenatge',
        'amount'
    ];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class CostCategoryModel extends Authenticatable
{
    protected $table = 'cost_category';
    protected $fillable = ['name', 'decription', 'percentage', 'branch'];
    protected static $logOnlyDirty = true;
}

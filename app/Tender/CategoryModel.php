<?php

namespace App\Tender;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryModel extends Authenticatable
{
    protected $table = 'category';
    protected $fillable = ['name', 'decription', 'branch', 'flow_created'];
    protected static $logOnlyDirty = true;
}
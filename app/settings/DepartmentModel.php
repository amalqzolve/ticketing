<?php
namespace App\settings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class DepartmentModel extends Authenticatable
{
    protected $table    = 'qcrm_department';
    protected $fillable = ['name', 'note','branch'];
    protected static $logOnlyDirty = true;
}


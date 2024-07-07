<?php
namespace App\crm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class salesDepartmentModel extends Authenticatable
{
    protected $table = 'qcrm_sales_dept';
    protected $fillable = ['title', 'description', ];
    protected static $logOnlyDirty = true;
}


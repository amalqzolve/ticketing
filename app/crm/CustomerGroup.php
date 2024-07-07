<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class CustomerGroup extends Authenticatable
{
    protected $table = 'qcrm_customer_groupdetails';
    protected $fillable = ['title', 'description','color','branch','default_grp'];
    protected static $logOnlyDirty = true;
}


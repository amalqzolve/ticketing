<?php
namespace App\settings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class CustomerTypeModel extends Authenticatable
{
    protected $table = 'qcrm_customer_typedetails';
    protected $fillable = ['title', 'discription', 'color', 'branch','typedefault'];
    protected static $logOnlyDirty = true;
}


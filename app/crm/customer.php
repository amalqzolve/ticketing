<?php
namespace App\crm;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class customer extends Authenticatable
{
    protected $table = 'qcrm_customer';
    protected $fillable = ['info_id', 'contact_personvalue', 'mobiles', 'offices', 'emails', 'departments', 'locations','branch'];
    protected static $logOnlyDirty = true;
}


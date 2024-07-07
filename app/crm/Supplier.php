<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class Supplier extends Authenticatable
{
    protected $table = 'qcrm_supplier_table';
    protected $fillable = ['info_id', 'contact_person_incharges', 'contact_personvalue', 'mobiles', 'offices', 'emails', 'departments', 'locations','branch'
    ];
    protected static $logOnlyDirty = true;
}


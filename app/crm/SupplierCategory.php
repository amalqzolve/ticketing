<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class SupplierCategory extends Authenticatable
{
    protected $table = 'qcrm_suppliercatogry';
    protected $fillable = ['title', 'cust_start', 'discription', 'color', 'customcode', 'startfrom','increment','branch'];
    protected static $logOnlyDirty = true;
}


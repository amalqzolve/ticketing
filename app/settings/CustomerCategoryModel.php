<?php
namespace App\settings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class CustomerCategoryModel extends Authenticatable
{
    protected $table    = 'qcrm_customer_categorydetails';
    protected $fillable = ['customer_category','cust_start', 'description','color','cust_code','start_from','increment','branch','catdefault'];
}


<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class VendorGroupModel extends Authenticatable
{
    protected $table    = 'qcrm_vendor_groups';
    protected $fillable = ['title', 'description', 'color','branch'];
}

   
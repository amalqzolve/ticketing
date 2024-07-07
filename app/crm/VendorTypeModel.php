<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class VendorTypeModel extends Authenticatable
{
    protected $table = 'qcrm_vendor_type_details';
    protected $fillable = ['vendor_type', 'description', 'color','branch'];
}


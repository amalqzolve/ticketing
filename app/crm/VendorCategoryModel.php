<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class VendorCategoryModel extends Authenticatable
{
    protected $table    = 'qcrm_vendor_category_details';
    protected $fillable = [ 'vendor_category', 'vendor_start', 'description', 'color', 'customcode', 'startfrom','increment','branch'];
}


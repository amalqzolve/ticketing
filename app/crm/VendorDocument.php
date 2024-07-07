<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class VendorDocument extends Authenticatable
{
    protected $table    = 'qcrm_vendor_documents';
    protected $fillable = ['name', 'title', 'description', 'uniqueid', 'file_data',
                          'cust_users'];
    protected static $logOnlyDirty = true;
}


<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class TaxInformation extends Authenticatable
{
    protected $table    = 'qcrm_tax_informations';
    protected $fillable = ['vat_no', 'vat_name', 'uniqueid', 'file_data', 'cust_users'];
    protected static $logOnlyDirty = true;
}


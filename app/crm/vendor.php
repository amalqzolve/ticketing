<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class vendor extends Authenticatable
{
    protected $table = 'qcrm_vendors';
    protected $fillable = ['vendor_name_alias', 'vendor_code', 'vendor_type', 'vendor_category', 'salesman', 'vendor_group', 'key_account', 'vendor_name', 'contact_person', 'vendor_add1', 'vendor_add2', 'vendor_country', 'vendor_region', 'vendor_city', 'vendor_zip', 'email1', 'email2', 'office_phone1', 'office_phone2', 'mobile1', 'mobile2', 'fax', 'website', 'contact_persons', 'mobile', 'office', 'contact_department', 'email', 'location', 'portal', 'username', 'registerd_email', 'password', 'account_group', 'account_ledger', 'account_code','branch','main_ledger','sub_ledger','ledger_type','vendor_name_alias_ar','vendor_name_ar','vendor_add1_ar','vendor_add2_ar','vendor_country_ar','vendor_region_ar','vendor_city_ar','vendor_zip_ar','province_state','province_state_ar','additionalno','ar_additionalno','vatno','ar_vatno','buyerid_crno','ar_buyerid_crno'
    ];
}


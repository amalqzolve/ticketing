<?php

namespace App\crm;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SupplierModel extends Authenticatable
{
    protected $table = 'qcrm_supplier';
    protected $fillable = ['sup_code', 'sup_type', 'sup_category', 'salesman', 'key_account', 'sup_note', 'sup_name', 'sup_add1', 'sup_add2', 'sup_country', 'sup_region', 'sup_city', 'sup_zip', 'email1', 'email2', 'office_phone1', 'office_phone2', 'mobile1', 'mobile2', 'fax', 'website', 'contact_person', 'contact_person_incharge', 'mobile', 'office', 'contact_department', 'email', 'location', 'sup_name_alias', 'portal', 'username', 'registerd_email', 'password', 'account_group', 'account_ledger', 'account_code', 'Checkedinvoice_value', 'invoice_add1', 'invoice_add2', 'invoice_country', 'invoice_region', 'invoice_city', 'invoice_zip', 'invoice_email1', 'invoice_email2', 'invoice_office_phone1', 'invoice_office_phone2', 'invoice_mobile1', 'invoice_mobile2', 'Checkedshipping_value', 'shipping1', 'shipping2', 'shipping_country', 'shipping_region', 'shipping_city', 'shipping_zip', 'shipping_email2', 'shipping_email1', 'shipping_office_phone1', 'shipping_office_phone2', 'shipping_mobile2', 'shipping_mobile1', 'branch', 'main_ledger', 'sub_ledger', 'ledger_type', 'additionalno', 'vatno', 'buyerid_crno', 'sup_name_alias_ar', 'sup_name_ar', 'sup_add1_ar', 'sup_add2_ar', 'sup_country_ar', 'sup_region_ar', 'sup_city_ar', 'sup_zip_ar', 'vatno_ar', 'buyerid_crno_ar', 'sup_state_ar', 'additionalno_ar', 'sup_state'];
    protected static $logOnlyDirty = true;
}

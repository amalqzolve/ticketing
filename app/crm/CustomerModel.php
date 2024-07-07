<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class CustomerModel extends Authenticatable
{
    protected $table = 'qcrm_customer_details';
    protected $fillable = ['id', 'cust_code', 'cust_group', 'cust_type', 'cust_category', 'salesman', 'key_account', 'cust_note', 'cust_name', 'cust_add1', 'cust_add2', 'cust_country', 'cust_region', 'cust_city', 'cust_zip', 'email1', 'email2', 'office_phone1', 'office_phone2', 'mobile1', 'mobile2', 'fax', 'website', 'contact_person', 'contact_person_incharge', 'mobile', 'office', 'contact_department', 'email', 'location', 'custcontact_person', 'cust_name_alias','Checkedinvoice_value','invoice_add1','invoice_add2','invoice_country','invoice_region','invoice_city','invoice_zip','invoice_email1','invoice_email2','invoice_office_phone1','invoice_office_phone2','invoice_mobile1','invoice_mobile2','Checkedshipping_value','shipping1','shipping2','shipping_country','shipping_region','shipping_city','shipping_zip','shipping_email2','shipping_email1','shipping_office_phone1','shipping_office_phone2','shipping_mobile2','shipping_mobile1', 'portal', 'username', 'registerd_email', 'password', 'contact_person_incharges', 'contact_personvalue', 'mobiles', 'offices', 'emails', 'departments', 'locations', 'account_group', 'account_ledger', 'account_code','branch','main_ledger','sub_ledger','ledger_type','cust_district','vatno','buyerid_crno','building_no','ar_cust_name','ar_cust_add1','ar_cust_add2','ar_cust_country','ar_cust_region','ar_cust_city','ar_cust_zip','additionalno','ar_additionalno','province_state','ar_province_state','ar_vatno','ar_buyerid_crno'];
    protected static $logOnlyDirty = true;
}


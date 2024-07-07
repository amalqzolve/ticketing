<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class CustomerModel extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'customer_details';
    protected $fillable = ['cust_code', 'cust_type', 'cust_category', 'salesman', 'key_account', 'cust_note', 'cust_name', 'cust_add1', 'cust_add2', 'cust_country', 'cust_region', 'cust_city', 'cust_zip', 'email1', 'email2', 'office_phone1', 'office_phone2', 'mobile1', 'mobile2', 'fax', 'website', 'contact_person', 'contact_person_incharge', 'mobile', 'office', 'contact_department', 'email', 'location',

    'portal', 'username', 'registerd_email', 'password', 'contact_person_incharges', 'contact_personvalue', 'mobiles', 'offices', 'emails', 'departments', 'locations'];
    protected static $logOnlyDirty = true;
}


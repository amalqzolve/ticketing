<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class SupplierModel extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'supplier';
    protected $fillable = ['sup_code', 'sup_type', 'sup_category', 'salesman', 'key_account', 'sup_note', 'sup_name', 'sup_add1', 'sup_add2', 'sup_country', 'sup_region', 'sup_city', 'sup_zip', 'email1', 'email2', 'office_phone1', 'office_phone2', 'mobile1', 'mobile2', 'fax', 'website', 'contact_person', 'contact_person_incharge', 'mobile', 'office', 'contact_department', 'email', 'location',

    'portal', 'username', 'registerd_email', 'password'];
    protected static $logOnlyDirty = true;
}


<?php

namespace App\inventory;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class vendor extends Authenticatable
{
    protected $table = 'qcrm_vendors';
    protected $fillable = [
    	                    'vendor_code',
                            'vendor_type',
							'vendor_category',
							'salesman',
							'key_account',
							'vendor_name',
							'contact_person',
							'vendor_add1',
							'vendor_add2',
							'vendor_country',
							'vendor_region',
							'vendor_city',
							'vendor_zip',
							'email1',
							'email2',
							'office_phone1',
							'office_phone2',
							'mobile1',
							'mobile2',
							'fax',
							'website',
							'contact_persons',
							'mobile',
							'office',
							'contact_department',
							'email',
							'location',
							'invoice_add1',
							'invoice_add2',
							'shipping1',
							'shipping2',
							'portal',
							'username',
							'registerd_email',
							'password',
							

    ];
}

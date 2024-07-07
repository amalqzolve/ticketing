<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Userinfo extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'information';

    protected $fillable = [

							'cust_type',
							'cust_name',
							'cust_add1',
							'cust_add2',
							'cust_country',
							'cust_city',
							'cust_region',
							'cust_zip',
							'cust_email',
							'cust_officephone',
							'cust_mobile',
							'cust_fax',
							'cust_website',
							'uniqueid',
							'file_data',
                            'cust_users'
    ];



    protected static $logOnlyDirty = true;

}

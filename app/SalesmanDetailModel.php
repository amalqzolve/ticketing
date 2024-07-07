<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class  SalesmanDetailModel extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'qcrm_salesman_details';

    protected $fillable = ['user_id', 'name','email','password', 'address1', 'address2', 'address3', 'zip', 'country', 'region', 'place', 'salesman_route', 'department', 'department_head'

    ];

    protected static $logOnlyDirty = true;

}


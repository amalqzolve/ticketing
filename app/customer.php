<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class customer extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'customer';

    protected $fillable = ['info_id', 'contact_person_incharges', 'contact_personvalue', 'mobiles', 'offices', 'emails', 'departments', 'locations'

    ];

    protected static $logOnlyDirty = true;

}


<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class UserActivity extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $table = 'activity_log';

    protected $fillable = [

		'log_name',
		'description',
		'subject_id',
		'subject_type',
		'causer_id',
		'causer_type',
		'properties' 
    ];

    protected static $logAttributes = [
		'log_name',
		'description',
		'subject_id',
		'subject_type',
		'causer_id',
		'causer_type',
		'properties'
						];
    
    protected static $logOnlyDirty = true;
 
}

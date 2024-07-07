<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;


class SuppliergroupModel extends Authenticatable
{
    protected $table ='suppliergroup';
    protected $fillable =[
    	'title',
    	'description',
    	'color'
    ];
    protected static $logOnlyDirty = true;
}

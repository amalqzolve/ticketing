<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class prodcutdetailscontroller extends Authenticatable
{
  protected $table ='product_detailsdata';
    protected $fillable =[

    	'cust_code',
    	'cust_type',
    	
    ];
    protected static $logOnlyDirty = true;

}

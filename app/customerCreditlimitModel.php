<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class customerCreditlimitModel extends Authenticatable
{
  protected $table ='customer_creditlimit';
    protected $fillable =[

    	'cust_name',
    	'numberinvoice',
    	'totalamount',
    	'eachinvoice',
    	'panelcharges',
    ];
    protected static $logOnlyDirty = true;

}

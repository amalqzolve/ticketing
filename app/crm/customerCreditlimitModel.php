<?php
namespace App\crm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class customerCreditlimitModel extends Authenticatable
{
  protected $table ='qcrm_customer_creditlimit';
    protected $fillable =[
        'cust_id',
    	'cust_name',
    	'numberinvoice',
    	'totalamount',
    	'eachinvoice',
    	'panelcharges',
    ];
    protected static $logOnlyDirty = true;
}

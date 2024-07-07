<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class SalesmanDetailModel extends Authenticatable
{
    protected $table = 'qcrm_salesman_details';
    protected $fillable = ['user_id', 'name', 'email', 'password', 'address1', 'address2', 'address3', 'zip', 'country', 'region', 'place', 'salesman_route', 'department', 'department_head', 'account_group', 'account_ledger', 'account_code','target','commission','branch','keysalesman','signature'];
    protected static $logOnlyDirty = true;
}


<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class salesmanroute_settingModel extends Authenticatable
{
    protected $table = 'salemanroute';
    protected $fillable = ['routename', 'startpalce', 'endplace', 'totalkm'];
    protected static $logOnlyDirty = true;
}


<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class CustomerTypeModel extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'qcrm_customer_typedetails';
    protected $fillable = ['title', 'discription', 'color', ];
    protected static $logOnlyDirty = true;
}


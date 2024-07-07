<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class SupplierCategory extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'suppliercatogry';

    protected $fillable = ['title','cust_start','discription', 'color', 'customcode', 'startfrom'

    ];

    protected static $logOnlyDirty = true;

}


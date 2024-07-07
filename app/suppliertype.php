<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class suppliertype extends Authenticatable
{
    protected $table = 'supplier_type';
    protected $fillable = ['title', 'discription', 'color'];
    protected static $logOnlyDirty = true;
}


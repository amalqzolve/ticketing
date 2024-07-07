<?php
namespace App\settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class Suppliertype extends Authenticatable
{
    protected $table    = 'qcrm_supplier_type';
    protected $fillable = ['title', 'discription', 'color' ,'branch'];
    protected static $logOnlyDirty = true;
}


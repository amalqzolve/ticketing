<?php
namespace App\settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class SuppliergroupModel extends Authenticatable
{
    protected $table = 'qcrm_suppliergroup';
    protected $fillable = ['title', 'description', 'color','branch'];
    protected static $logOnlyDirty = true;
}


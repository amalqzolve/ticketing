<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class TermsconditionsModel extends Authenticatable
{
    protected $table    = 'qcrm_termsandconditions';
    protected $fillable = ['term', 'description','branch'];
    protected static $logOnlyDirty = true;
}


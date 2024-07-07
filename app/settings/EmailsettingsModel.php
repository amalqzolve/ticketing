<?php
namespace App\settings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class EmailsettingsModel extends Authenticatable
{
    protected $table    = 'qcrm_emailsettings';
    protected $fillable = ['branch','host','username','passwrd','smtpsecure_status','port_no','sender_email','receiver_email','updated_at'];
    protected static $logOnlyDirty = true;
}


<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class UserActivity extends Authenticatable
{
    protected $table = 'qcrm_activity_log';
    protected $fillable = ['log_name', 'description', 'subject_id', 'subject_type',
                          'causer_id', 'causer_type', 'properties'];
    protected static $logAttributes = ['log_name', 'description', 'subject_id', 'subject_type', 'causer_id', 'causer_type', 'properties'];
    protected static $logOnlyDirty = true;
}


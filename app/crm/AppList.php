<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
class AppList extends Model
{
	protected $table = 'qcrm_apps';
    protected $fillable = [
        'app_name',
        'app_desc',
        'url',
        'status',
        'icon',
        'unique_id'
    ];
}

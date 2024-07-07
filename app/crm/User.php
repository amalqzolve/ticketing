<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';
    protected $fillable = ['name', 'email', 'password', ];
    protected $hidden = ['password', 'remember_token', ];
    protected $casts = ['email_verified_at' => 'datetime', ];
}


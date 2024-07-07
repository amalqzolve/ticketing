<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EmailVerifyKeysModel extends Authenticatable
{
    protected $table = 'email_verify_keys';
    protected $fillable = [
        'email',
        'doc_type',
        'doc_id',
        'transaction_id',
        'token',
        'created_at',
    ];
    protected static $logOnlyDirty = true;
}

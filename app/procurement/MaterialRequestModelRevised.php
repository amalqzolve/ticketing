<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class MaterialRequestModelRevised extends Authenticatable
{
    protected $table = 'material_request_revised';
    protected $fillable = [
        'version',
        'quotedate',
        'dateofsupply',
        'request_type',
        'mr_category',
        'request_priority',
        'request_against',
        'client',
        'project',
        'internalreference',
        'notes',
        'terms',
        'user_id',
        'status'
    ];
    protected static $logOnlyDirty = true;
}

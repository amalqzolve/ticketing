<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class EprSuggestion extends Authenticatable
{
    protected $table = 'epr_suggestion';
    protected $fillable = [
        'type', 'doc_id', 'from', 'to', 'comment', 'responce_status', 'read_status', 'created_at', 'updated_at'
    ];
    protected static $logOnlyDirty = true;
}

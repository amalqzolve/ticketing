<?php

namespace App\projects;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class LabelModel extends Authenticatable
{
    protected $table = 'qprojects_labels';
    protected $fillable = ['title', 'color', 'branch'];
    protected static $logOnlyDirty = true;
}

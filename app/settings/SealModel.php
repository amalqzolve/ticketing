<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class SealModel extends Model
{
    //
    protected $table = 'qsettings_seal';
    protected $fillable = ['seal','branch'];
    protected static $logOnlyDirty = true;
}

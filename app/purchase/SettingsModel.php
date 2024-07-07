<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
     protected $table    = 'qpurchase_settings';
     protected $fillable = ['invoice_number','prefix','suffix','settings_from','settings_to','branch'];
    protected static $logOnlyDirty = true;
}

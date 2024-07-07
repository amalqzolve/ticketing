<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class CurrencyModel extends Model
{
    //
    protected $table = 'qpurchase_currency';
    protected $fillable = ['currency_name','value','symbol','note','currency_default','branch'];
    protected static $logOnlyDirty = true;
}

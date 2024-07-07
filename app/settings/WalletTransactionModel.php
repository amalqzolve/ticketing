<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class WalletTransactionModel extends Model
{
    //
    protected $table = 'qsettings_wallettransactions';
    protected $fillable = ['date','account','drcr','amounts','notes','branch'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class WalletModel extends Model
{
    //
    protected $table = 'qsettings_wallet';
    protected $fillable = ['name','ledger','branch'];
    protected static $logOnlyDirty = true;
}

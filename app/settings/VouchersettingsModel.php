<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class VouchersettingsModel extends Model
{
    //
    protected $table = 'qsettings_voucher';
    protected $fillable = ['voucher_name', 'prefix', 'entry_types', 'financeposting', 'startingno', 'branch', 'flow_created'];
    protected static $logOnlyDirty = true;
}

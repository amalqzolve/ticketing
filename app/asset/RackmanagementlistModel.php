<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class RackmanagementlistModel extends Model
{
    //
     protected $table = 'assets_rack_management';
    protected $fillable = ['warehouse','store','rack_name','rack_manager','rack_in_charge','branch','rack_default'];
    protected static $logOnlyDirty = true;
}

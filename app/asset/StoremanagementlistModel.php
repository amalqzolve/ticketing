<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class StoremanagementlistModel extends Model
{
    //
     protected $table = 'assets_store_management';
    protected $fillable = ['warehouse','store_name','store_manager','store_incharge','store_location','store_keeper','total_rack_availability','branch','store_default'];
    protected static $logOnlyDirty = true;
}
<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class ComponentModel extends Model
{
   protected $table = 'assets_components';
   
    protected $fillable = ['component_name','component_date','reminderdays','asset_id'];
    protected static $logOnlyDirty = true;
}
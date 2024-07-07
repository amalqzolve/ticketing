<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class PartsModel extends Model
{
   protected $table = 'assets_parts';
   
    protected $fillable = ['part_name','part_date','reminderdays','asset_id','notes'];
    protected static $logOnlyDirty = true;
}
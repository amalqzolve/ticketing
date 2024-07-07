<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
   protected $table = 'assets_area';
   
    protected $fillable = ['name','description','branch'];
    protected static $logOnlyDirty = true;
}
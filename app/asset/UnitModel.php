<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnitModel extends Model
{
    
    protected $table    = 'assets_unit';
    protected $fillable = ['id','unit_name', 'unit_code', 'base_unit', 'parent_unit', 'unit_value', 'description','branch'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductUnitModel extends Model
{
    
    protected $table    = 'qinventory_product_unit';
    protected $fillable = ['id','unit_name', 'unit_code', 'base_unit', 'parent_unit', 'unit_value', 'description','branch'];
    protected static $logOnlyDirty = true;
}

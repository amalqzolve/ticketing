<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeModel extends Model
{
    protected $table    = 'qinventory_attribute';
    protected $fillable = ['attribute_name', 'attribute_code','options','branch'];
    protected static $logOnlyDirty = true;
}

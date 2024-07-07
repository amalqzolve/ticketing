<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attributeoptionsmodel extends Model
{
    protected $table    = 'qinventory_attributeoptions';
    protected $fillable = ['attribute_id', 'option_name'];
    protected static $logOnlyDirty = true;
}

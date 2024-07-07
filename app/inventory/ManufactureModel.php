<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class ManufactureModel extends Model
{
    protected $table    = 'qinventory_manufacture';
    protected $fillable = ['manufacture_name','manufacture_code','logo','vendor','branch','description'];
    protected static $logOnlyDirty = true;
}

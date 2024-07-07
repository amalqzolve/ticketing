<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class BrandModel extends Model
{
    protected $table    = 'qinventory_brand';
    protected $fillable = ['brand_name', 'brand_code','logo','vendor','description','branch'];
    protected static $logOnlyDirty = true;
}

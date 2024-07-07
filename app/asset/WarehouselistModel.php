<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class WarehouselistModel extends Model
{
    //

    protected $table = 'assets_warehouse';
    protected $fillable = ['warehouse_name','warehouse_code','address_1','address_2','city','country','region','state','zipcode','phone','email','manager','incharge','branch','warehouse_default'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class WarehousemanagerslistModel extends Model
{
    //

    protected $table = 'qinventory_warehouse_manager';
    protected $fillable = ['manager_name','manager_code','city','country_region','phone','email','branch'];
    protected static $logOnlyDirty = true;
}

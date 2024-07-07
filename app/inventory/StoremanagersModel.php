<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class StoremanagersModel extends Model
{
    //
    protected $table = 'qinventory_storemanagers';
    protected $fillable = ['name','email','manager_code','city','country_region','phone','branch'];
    protected static $logOnlyDirty = true;
}

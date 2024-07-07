<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class StorekeepersModel extends Model
{
    //
    protected $table = 'qinventory_storekeepers';
    protected $fillable = ['name','email','code','city','country_region','phone','branch'];
    protected static $logOnlyDirty = true;
}

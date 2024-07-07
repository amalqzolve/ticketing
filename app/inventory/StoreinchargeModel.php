<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class StoreinchargeModel extends Model
{
    //
     protected $table = 'qinventory_storeincharge';
    protected $fillable = ['name','email','code','city','country_region','phone','branch'];
    protected static $logOnlyDirty = true;
}

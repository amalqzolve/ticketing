<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class RackinchargeModel extends Model
{
    //
     protected $table = 'qinventory_rackincharge';
    protected $fillable = ['name','email','code','city','country_region','phone','branch'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class RackmanagerModel extends Model
{
    //
    protected $table = 'qinventory_rackmanagers';
    protected $fillable = ['name','email','manager_code','city','country_region','phone','branch'];
    protected static $logOnlyDirty = true;
}

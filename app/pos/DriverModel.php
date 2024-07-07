<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class DriverModel extends Model
{
   protected $table = 'qpos_driver';
    protected $fillable = ['name','phoneno','notes','branch','nationalid','employeeid','country'];
    protected static $logOnlyDirty = true;
}
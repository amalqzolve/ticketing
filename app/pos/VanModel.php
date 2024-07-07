<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class VanModel extends Model
{
   protected $table = 'qpos_van';
    protected $fillable = ['route','salesman','driver','branch','vanname','licenseno','username','password','notes'];
    protected static $logOnlyDirty = true;
}
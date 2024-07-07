<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
   protected $table = 'assets_department';
   
    protected $fillable = ['name','description','branch'];
    protected static $logOnlyDirty = true;
}
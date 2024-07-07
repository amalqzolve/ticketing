<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
   protected $table = 'assets_type';
    protected $fillable = ['name','description','branch'];
    protected static $logOnlyDirty = true;
}
<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
   protected $table = 'assets_category';
    protected $fillable = ['name','description','branch'];
    protected static $logOnlyDirty = true;
}
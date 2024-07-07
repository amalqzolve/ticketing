<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
   protected $table = 'assets_groups';
    protected $fillable = ['name','description','branch'];
    protected static $logOnlyDirty = true;
}
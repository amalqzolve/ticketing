<?php

namespace App\boq;

use Illuminate\Database\Eloquent\Model;

class MaterialDirectoryModel extends Model
{
   protected $table = 'material_directory';

   protected $fillable = [
      'material_name',
      'description',
      'code',
      'unit',
      'category',
      'group',
      'amount',
      'branch',
      'warehouse',
      'created_by',
      'valid_till',
      'del_flag'
   ];
   protected static $logOnlyDirty = true;
}

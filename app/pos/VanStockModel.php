<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class VanStockModel extends Model
{
   protected $table = 'qpos_van_stock';
    protected $fillable = ['vanid','productid','available_quantity','branch','invoiced_quantity','return_quantity','rate'];
    protected static $logOnlyDirty = true;
}
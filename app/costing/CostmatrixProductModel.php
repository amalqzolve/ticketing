<?php

namespace App\costing;

use Illuminate\Database\Eloquent\Model;

class CostmatrixProductModel extends Model
{
   protected $table = 'costmatrix_products';

   protected $fillable = ['costmatrixid', 'product_name', 'branch', 'description', 'unit', 'quantity', 'rate', 'amount'];
   //   'discount','vatpercentage','vatamount','totalamount'
   protected static $logOnlyDirty = true;
}

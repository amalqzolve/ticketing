<?php

namespace App\costing;

use Illuminate\Database\Eloquent\Model;

class CostmatrixModel extends Model
{
   protected $table = 'costmatrix';

   protected $fillable = ['costmatrixname', 'description', 'branch', 'grandtotalamount','del_flag'];
   // 'totalamount', 'discount', 'amountafterdiscount', 'totalvatamount'

   protected static $logOnlyDirty = true;
}

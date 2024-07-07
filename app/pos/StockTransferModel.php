<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class StockTransferModel extends Model
{
   protected $table = 'qpos_stocktransfer';
    protected $fillable = ['van','date','notes','branch','totalitems','totalquantity','totalamount'];
    protected static $logOnlyDirty = true;
}
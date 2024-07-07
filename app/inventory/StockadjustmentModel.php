<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class StockadjustmentModel extends Model
{
    protected $table = 'qinventory_stock_adjustment';
    protected $fillable = ['product_id','quantity','reason','user_id','branch'];
    protected static $logOnlyDirty = true;
}




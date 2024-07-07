<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class StockReturnModel extends Model
{
   protected $table = 'qpos_stockreturn';
    protected $fillable = ['van','date','notes','branch','receiver','returneditems','returnedquantity'];
    protected static $logOnlyDirty = true;
}
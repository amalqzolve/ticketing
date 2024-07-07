<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class CostheadModel extends Model
{
    //
     protected $table = 'qpurchase_costhead';
    protected $fillable = ['cost_name','cost_rate','branch'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductvariantModel extends Model
{
    protected $table = 'qinventory_products_variant';
    protected $fillable = ['product_id','variants','sku','cost_price','selling_price','unit_price'];
    protected static $logOnlyDirty = true;
}


<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class ProductsbatchlistModel extends Model
{
    protected $table = 'qpurchase_products_batch';
    protected $fillable = ['purchase_id','product_id','variant_id','batch_id','stock','status','branch'];
    protected static $logOnlyDirty = true;
}

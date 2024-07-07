<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchasestockModel extends Model
{
    protected $table = 'qpurchase_stock';
    protected $fillable = ['product_id','variants','sku','cost_price','selling_price','unit_price','stock','unit','sales_price','batch','warehouse','store','rack','purchase_id','branch'];
    protected static $logOnlyDirty = true;
}

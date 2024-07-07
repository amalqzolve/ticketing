<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchaseProductModel extends Model
{
    //
     protected $table = 'qpurchase_products';
    protected $fillable = ['purchase_id','product_name','product_variants','unit','quantity','rate','batch','costpercentage','amount','vat_percentage','vat_amount','discount','row_total','purchase_sub_total','grandtotal_discount','grandtotal_tax','net_amount','paid_amount','due_amount','totalcost_amount','status','productname_id','quantity_value','branch','description','so_id','grn_id','pi_id'];
    protected static $logOnlyDirty = true;
}

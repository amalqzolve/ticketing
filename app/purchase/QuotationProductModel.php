<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class QuotationProductModel extends Model
{
   protected $table = 'qpurchase_quotation_products';
    protected $fillable = ['purchase_id','product_name','product_variants','unit','quantity','rate','batch','costpercentage','amount','tax_group','tax_amount','discount','row_total','purchase_sub_total','grandtotal_discount','grandtotal_tax','net_amount','paid_amount','due_amount','totalcost_amount','status','productname_id','quantity_value'];
    protected static $logOnlyDirty = true;
}

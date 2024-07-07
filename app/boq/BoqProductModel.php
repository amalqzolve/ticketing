<?php

namespace App\boq;

use Illuminate\Database\Eloquent\Model;

class BoqProductModel extends Model
{
   protected $table = 'boq_products';
   
      protected $fillable = ['boq_product_id','product_varient','product_type','product_name','category','unit','product_code','sku','barcode','barcode_format','available_stock','product_price','product_status','out_of_stock_status','provider','provider_id','description','opening_stock','enable_minus_stock_billing','reorder_quantity_alert','reorder_quantity','inventory_type','refundable','manufacturer','brand','serial_number','model_no','part_no','hsn_code','maintain_batches','batch_name','manufacturing_date','expiry_date','expiry_reminder','warranty_date','warranty_reminder','upc','ean','jan','isbn','mpn','image','branch','selling_price','lotno','shelflife','countryoforigin','cfds','reference','catno','warehouse','main_product_id'];
    protected $primaryKey = 'boq_product_id';
    protected static $logOnlyDirty = true;
}

	
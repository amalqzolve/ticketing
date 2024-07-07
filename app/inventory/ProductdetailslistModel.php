<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class ProductdetailslistModel extends Model
{
    protected $table = 'qinventory_products';
    protected $fillable = ['product_id','product_varient','product_type','product_name','category','unit','product_code','sku','barcode','barcode_format','available_stock','product_price','product_status','out_of_stock_status','provider','provider_id','description','opening_stock','enable_minus_stock_billing','reorder_quantity_alert','reorder_quantity','inventory_type','refundable','manufacturer','brand','serial_number','model_no','part_no','hsn_code','maintain_batches','batch_name','manufacturing_date','expiry_date','expiry_reminder','warranty_date','warranty_reminder','upc','ean','jan','isbn','mpn','image','branch','selling_price','lotno','shelflife','countryoforigin','cfds','reference','catno','warehouse','main_product_id','store','rack','unit_name','warehouse_name','supplier_name','category_name','manufacturer_name','brand_name'];
    protected $primaryKey = 'product_id';
    protected static $logOnlyDirty = true;

}




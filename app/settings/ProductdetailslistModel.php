<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class ProductdetailslistModel extends Model
{
    protected $table = 'qinventory_products';
    protected $fillable = ['id','product_id','product_name','product_code','bar_code','unit','category','out_of_stock_status','product_status','description','opening_stock','enable_minus_stock_billing','reorder_quantity_alert','taxable','sales_tax_group','purchase_tax _group','item_type','refundable','manufacturer','brand','serial_number','model_no','part_no','image','maintain_bathes','batch_lot_no','manufacturing_date','expiry_date','expiry_reminder','warranty_date','warranty_reminder','sku','upc','ean','jan','isbn','mpn','sales_accountant','purchase_accountant','inventory_accountant','fileData','stock','sales_price','batch','warehouse','store','rack','variant','branch','product_type','unit_price','type'];
    protected static $logOnlyDirty = true;
}

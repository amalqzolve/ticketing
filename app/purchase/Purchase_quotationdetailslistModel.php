<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class Purchase_quotationdetailslistModel extends Model
{
    protected $table = 'qpurchase_quotation';
    protected $fillable = ['vendor_supplier','vendor_supplier_name','purchase_date','deliverto','deliver_name','purchaseno','paymentterms','notes','terms','currency','purchase_sub_total','grandtotal_discount','grandtotal_tax','net_amount','paid_amount','due_amount','totalcost_amount','currency_value','image'];
    protected static $logOnlyDirty = true;
}

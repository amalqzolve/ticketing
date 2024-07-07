<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchasedetailslistModel extends Model
{
    //
    protected $table = 'qpurchase_purchase';
    protected $fillable = ['vendor_supplier','vendor_supplier_name','purchase_date','deliverto','deliver_name','purchaseno','paymentterms','notes','terms','currency','purchase_sub_total','grandtotal_discount','grandtotal_tax','net_amount','paid_amount','due_amount','totalcost_amount','currency_value','image','reciever','recievedto','purchasemethod','branch','purchasebillid','po_ref_number','qtnref','totalamount','discount','amountafterdiscount','vatamount','grandtotalamount','vat_no','cr_no','status','purchaser','bill_entry_date','so_id','grn_id','purchasetype','attention','salesman','preparedby','approvedby','poid','pi_id'];
    protected static $logOnlyDirty = true;
}

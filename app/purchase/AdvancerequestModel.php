<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class AdvancerequestModel extends Model
{
   protected $table = 'qpurchase_advance_request';
    protected $fillable = ['quote_id','reference','attention','salesman','quotedate','validity','currency','currencyvalue','totalamount','discount','amountafterdiscount','vatamount','grandtotalamount','terms','notes','preparedby','approvedby','branch','status','shipping_address','billing_address','contact_phone','delivery','invoice','invoice_type','dateofsupply','method','quotedate1','user_id','qtnref','po_wo_ref','ctype','paid_amount','due_amount','po_date','category','code','type','group','name','buildingno','streetname','district','city','country',' postalcode','mobile','vatno','crno','inv_pur_no','payingagainst','documentno'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
   protected $table = 'qpos_invoice';
    protected $fillable = ['customer','quote_id','reference','attention','salesman','quotedate','validity','currency','currencyvalue','totalamount','discount','amountafterdiscount','vatamount','grandtotalamount','terms','notes','preparedby','approvedby','branch','status','shipping_address','billing_address','contact_phone','delivery','invoice','invoice_type','dateofsupply','method','quotedate1','user_id','qtnref','po_wo_ref','ctype','paid_amount','due_amount','po_date','tpreview','vanid'];
    protected static $logOnlyDirty = true;
}

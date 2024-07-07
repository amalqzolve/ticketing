<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class AdvancePaymentModel extends Model
{
   protected $table = 'qpurchase_advancepayment';
    protected $fillable = ['name','notes','branch','invoice_no','date','transactiontype','accountledger_depositaccount','provider'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class AccountsModel extends Model
{
    //
    protected $table = 'qpurchase_accounts';
    protected $fillable = ['purchase_debit','purchase_credit','sales_debit','sales_credit','branch'];
    protected static $logOnlyDirty = true;
}

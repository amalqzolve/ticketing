<?php

namespace App\buy;

use Illuminate\Database\Eloquent\Model;

class BuyAccountModel extends Model
{
   protected $table = 'buy_account_head';
   
    protected $fillable = ['head_name','head_description','account_head_ledger','branch'];
    protected static $logOnlyDirty = true;
}

	


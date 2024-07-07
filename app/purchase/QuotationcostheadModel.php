<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class QuotationcostheadModel extends Model
{
    protected $table = 'qpurchase_quotation_costhead';
    protected $fillable = ['purchase_id','costheadname','rate','tax','amount'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class ProductcostheadModel extends Model
{
    protected $table = 'qpurchase_products_costhead';
    protected $fillable = ['purchase_id','costheadname','rate','tax','amount','branch','costtax_notes','costsupplier','so_id','grn_id','pi_id'];
    protected static $logOnlyDirty = true;
}

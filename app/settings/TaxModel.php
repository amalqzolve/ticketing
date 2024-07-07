<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class TaxModel extends Model
{
    //
    protected $table = 'qpurchase_tax';
    protected $fillable = ['taxname','tax_percentage','branch'];
    protected static $logOnlyDirty = true;
}

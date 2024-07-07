<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class TaxgroupModel extends Model
{
     protected $table = 'qpurchase_taxgroup';
    protected $fillable = ['taxgroup_name','total','description','branch'];
    protected static $logOnlyDirty = true;
}

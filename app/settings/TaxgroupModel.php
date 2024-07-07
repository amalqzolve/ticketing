<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class TaxgroupModel extends Model
{
     protected $table = 'qpurchase_taxgroup';
    protected $fillable = ['taxgroup_name','total','description','branch','default_tax'];
    protected static $logOnlyDirty = true;
}

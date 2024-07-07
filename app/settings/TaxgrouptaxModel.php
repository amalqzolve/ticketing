<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class TaxgrouptaxModel extends Model
{
    protected $table = 'qpurchase_taxgroup_taxes';
    protected $fillable = ['taxgroupid','taxes','branch'];
    protected static $logOnlyDirty = true;
}

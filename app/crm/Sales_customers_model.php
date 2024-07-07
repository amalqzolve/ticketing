<?php

namespace App\crm;

use Illuminate\Database\Eloquent\Model;

class Sales_customers_model extends Model
{
    protected $table = 'qcrm_salesman_customers';
    protected $fillable = ['salesmanid', 'customers', ];
    protected static $logOnlyDirty = true;
}

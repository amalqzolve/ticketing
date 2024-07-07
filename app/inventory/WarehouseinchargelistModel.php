<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class WarehouseinchargelistModel extends Model
{
    //
    protected $table = 'qinventory_warehouse_incharge';
    protected $fillable = ['incharge_name','incharge_code','city','country_region','phone','email'];
}

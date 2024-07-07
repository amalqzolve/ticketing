<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class WarehouseinchargeModel extends Model
{
    //

    //  use Notifiable;

    // use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'qinventory_warehouse_incharge';
    protected $fillable = ['incharge_name','incharge_code','city','country_region','phone','email','branch'];
    protected static $logOnlyDirty = true;
}

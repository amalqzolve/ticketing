<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class MaterialRequestProductsModel extends Authenticatable
{
    protected $table = 'material_request_products';
    protected $fillable = [
        'mr_id',
        'product_id',
        'itemname',
        'description',
        'unit',
        'quantity',
        'po_assigned_qty',
        'branch',
    ];
    protected static $logOnlyDirty = true;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class MaterialCategoryModel extends Authenticatable
{
    protected $table = 'ma_category';
    protected $fillable = ['name', 'decription', 'branch', 'flow_created', 'flow_created_stock_transfer', 'flow_created_po', 'flow_created_grn', 'flow_created_invoice', 'flow_created_supplier_payment', 'flow_created_stock_in'];
    protected static $logOnlyDirty = true;
}

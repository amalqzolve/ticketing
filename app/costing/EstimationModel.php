<?php

namespace App\costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class EstimationModel extends Authenticatable
{
    protected $table = 'estimation';
    protected $fillable = [
        'boq_id',
        'costmatrx_id',
        'costmatrx_product_id',
        'head_name',
        'product_description',
        'unit',
        'quantity',
        'rate',
        'amount',
        'row_total',
        'branch',
        'created_by'
    ];
    public function category()
    {
        return $this->hasMany(EstimationCategoryModel::class, 'estimation_id');
    }
}

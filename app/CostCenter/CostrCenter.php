<?php

namespace App\CostCenter;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class CostrCenter extends Model
{
    use NodeTrait;
    protected $table = 'cost_centers';
    protected $fillable = [
        'name',
        'code',
        'category_code',
        'department',
        'description',
        'business_area',
        'functional_area',
        'responsible_person',
        'is_parent',
        'amount'
    ];
}

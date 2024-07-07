<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectStockAllocatedModel extends Model
{
    use SoftDeletes;
    protected $table = 'project_stocks_allocated';
    protected $fillable = ['project_id', 'product_id', 'quantity', 'rate'];
}

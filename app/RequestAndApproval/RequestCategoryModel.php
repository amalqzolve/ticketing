<?php

namespace App\RequestAndApproval;

use Illuminate\Database\Eloquent\Model;

class RequestCategoryModel extends Model
{
    protected $table = 'request_category';
    protected $fillable = ['name', 'decription', 'flow_created', 'branch'];
}

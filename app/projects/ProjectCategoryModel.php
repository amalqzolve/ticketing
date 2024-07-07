<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ProjectCategoryModel extends Authenticatable
{
    protected $table = 'poject_category';
    protected $fillable = ['name', 'decription', 'branch', 'flow_created'];
}

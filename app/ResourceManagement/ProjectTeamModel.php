<?php

namespace App\ResourceManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTeamModel extends Model
{

    use SoftDeletes;
    protected $table = 'project_team';
    protected $fillable = [
        'name',
        'decription',
        'branch',
        'created_by',
    ];
}

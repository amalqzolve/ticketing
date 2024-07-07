<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTimeSheetModel extends Model
{
    use SoftDeletes;
    protected $table = 'project_time_sheets';
    protected $fillable = ['project_id', 'task', 'employee', 'from', 'to', 'description', 'created_by'];
}

<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskModel extends Model
{
    use SoftDeletes;
    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'project_id', 'points', 'milestone', 'assign_to', 'state_id', 'priority', 'start_date', 'deadline', 'created_by'];
}
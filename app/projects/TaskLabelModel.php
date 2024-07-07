<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;

class TaskLabelModel extends Model
{
    protected $table = 'task_labels';
    protected $fillable = ['taskid', 'labels'];
}

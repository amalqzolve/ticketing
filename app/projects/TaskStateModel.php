<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStateModel extends Model
{

    use SoftDeletes;
    protected $table = 'task_state';
    protected $fillable = ['name', 'decription', 'data_order', 'style', 'branch'];
}

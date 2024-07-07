<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStateChangeTransactionModel extends Model
{

    use SoftDeletes;
    protected $table = 'task_state_change_trancaction';
    protected $fillable = ['task_id', 'state_id_from', 'state_id_to', 'comments', 'changed_by'];
}

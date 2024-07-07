<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectSubCustomerFeedbackModel extends Model
{

    use SoftDeletes;
    protected $table = 'project_sub_customer_feedback';
    protected $fillable = ['project_id', 'comment_id', 'sub_comment', 'sub_file_path', 'created_by', 'entry_date'];
}

<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCustomerFeedbackModel extends Model
{

    use SoftDeletes;
    protected $table = 'project_customer_feedback';
    protected $fillable = ['project_id', 'comment', 'file_path', 'created_by', 'entry_date'];

    public function sub_comments()
    {
        return $this->hasMany(ProjectSubCustomerFeedbackModel::class, 'comment_id');
    }
}

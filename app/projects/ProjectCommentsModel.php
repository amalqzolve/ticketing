<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCommentsModel extends Model
{

    use SoftDeletes;
    protected $table = 'project_comments';
    protected $fillable = ['project_id', 'comment', 'file_path', 'created_by', 'entry_date'];

    public function sub_comments()
    {
        return $this->hasMany(ProjectSubCommentsModel::class, 'comment_id');
    }
}

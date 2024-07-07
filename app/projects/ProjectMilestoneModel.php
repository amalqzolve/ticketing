<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMilestoneModel extends Model
{
    use SoftDeletes;
    protected $table = 'project_milestones';
    protected $fillable = ['milestone_title', 'milestone_due_date', 'milestone_description', 'project_id', 'created_by'];
}

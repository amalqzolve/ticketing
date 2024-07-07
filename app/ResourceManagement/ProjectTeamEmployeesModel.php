<?php

namespace App\ResourceManagement;

use Illuminate\Database\Eloquent\Model;

class ProjectTeamEmployeesModel extends Model
{

    protected $table = 'project_team_members';
    protected $fillable = [
        'project_team_id',
        'member_id',
    ];
}

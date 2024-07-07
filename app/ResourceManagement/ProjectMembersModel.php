<?php

namespace App\ResourceManagement;

use Illuminate\Database\Eloquent\Model;

class ProjectMembersModel extends Model
{

    protected $table = 'project_members';
    protected $fillable = [
        'project_id',
        'member_id',
    ];
}

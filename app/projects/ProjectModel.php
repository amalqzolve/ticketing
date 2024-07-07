<?php

namespace App\projects;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class ProjectModel extends Authenticatable
{
    protected $table = 'qprojects_projects';
    protected $fillable = ['client', 'projectname', 'description', 'poject_category_id', 'startdate', 'enddate', 'salesorder', 'ponumber', 'povalue', 'podate', 'branch', 'internal_ref', 'notes', 'status', 'user_id', 'resources_alc_flg', 'project_leader'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
   protected $table = 'assets_projects';
   
    protected $fillable = ['project_name'];
    protected static $logOnlyDirty = true;
}
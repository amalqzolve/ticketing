<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFileModel extends Model
{
    use SoftDeletes;
    protected $table = 'project_files';
    protected $fillable = ['file',  'file_path', 'description', 'uploded_by', 'uploded_date', 'project_id'];
}

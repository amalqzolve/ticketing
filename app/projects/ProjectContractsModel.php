<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectContractsModel extends Model
{
    use SoftDeletes;
    protected $table = 'project_contracts';
    protected $fillable = ['file',  'file_path', 'description', 'uploded_by', 'uploded_date', 'project_id'];
}

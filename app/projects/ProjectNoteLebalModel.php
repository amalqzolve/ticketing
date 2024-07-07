<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectNoteLebalModel extends Model
{
    protected $table = 'project_note_lebals';
    protected $fillable = ['lebal_id', 'project_note_id'];
}

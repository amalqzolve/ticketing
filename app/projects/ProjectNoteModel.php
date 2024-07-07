<?php

namespace App\projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNoteModel extends Model
{
    use SoftDeletes;
    protected $table = 'project_notes';
    protected $fillable = ['note_title', 'note_date', 'note_description', 'public_flg', 'project_id', 'created_by'];
}

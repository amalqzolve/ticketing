<?php

namespace App\documentation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model
{
/*    use HasFactory;*/
    protected $table    = 'qdoc_help_category';
    protected $fillable = [
        'title', 'description', 'sort', 'status'
    ];
    protected static $logOnlyDirty = true;
}


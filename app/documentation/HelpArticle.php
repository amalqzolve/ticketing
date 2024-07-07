<?php

namespace App\documentation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpArticle extends Model
{
/*    use HasFactory;*/
    protected $table    = 'qdoc_help_article';
    protected $fillable = [
        'title', 'category', 'notes', 'sort', 'status'
    ];
    protected static $logOnlyDirty = true;
}
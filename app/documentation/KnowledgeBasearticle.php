<?php

namespace App\documentation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeBasearticle extends Model
{
/*    use HasFactory;*/
    protected $table    = 'qdoc_base_article';
    protected $fillable = [
        'title', 'category', 'notes', 'sort', 'status'
    ];
    protected static $logOnlyDirty = true;
}
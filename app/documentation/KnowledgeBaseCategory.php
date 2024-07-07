<?php

namespace App\documentation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeBaseCategory extends Model
{
/*    use HasFactory;*/
    protected $table    = 'qdoc_knowledge_base_category';
    protected $fillable = [
        'title', 'description', 'sort', 'status'
    ];
    protected static $logOnlyDirty = true;
}


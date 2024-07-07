<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'type', 'doc_id', 'from', 'to', 'comment', 'responce_status', 'read_status', 'created_at', 'updated_at'
    ];
}

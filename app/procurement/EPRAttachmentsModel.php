<?php

namespace App\procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EPRAttachmentsModel extends Model
{
    use SoftDeletes;
    protected $table = 'epr_attachments';
    protected $fillable = ['file',  'file_path', 'description', 'uploded_by', 'uploded_date', 'epr_id'];
}

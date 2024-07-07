<?php

namespace App\RequestAndApproval;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestAttachmentsModel extends Model
{
    use SoftDeletes;
    protected $table = 'request_attachments';
    protected $fillable = ['file',  'file_path', 'description', 'uploded_by', 'uploded_date', 'request_id'];
}

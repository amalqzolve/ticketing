<?php

namespace App\RequestAndApproval;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RequestModel extends Model
{
    use SoftDeletes;
    protected $table = 'requests';
    protected $fillable = [
        'version',
        'request_tittle',
        'required_on',
        'request_priority',
        'reference',
        'request_against',
        'note',
        'client',
        'project',
        'department',
        'internalreference',
        'terms',
        'creted_by',
        'updated_by',
        'branch',
        'status'
    ];
}

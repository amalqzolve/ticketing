<?php

namespace App\Tender;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class TenderModel extends Authenticatable
{
    protected $table = 'tenders';
    protected $fillable = [
        'client',
        'project_name',
        'date_of_submission',
        'date_of_release',
        'bid_extension_date',
        'bid_submission_date',
        'reference',
        'bid_bond',
        'consultant',
        'scope_of_work',
        'category_id',
        'upload',
        'internalreference',
        'notes',
        'status',
        'participation_status'
    ];
    protected static $logOnlyDirty = true;
}

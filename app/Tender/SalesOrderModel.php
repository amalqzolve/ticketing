<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SalesOrderModel extends Authenticatable
{
    protected $table = 'sales_orders';
    protected $fillable = [
        'sales_proposal_id',
        'client_id',
        'projectname',
        'description',
        'startdate',
        'enddate',
        'poject_category_id',
        'salesorder',
        'clients_po_number',
        'sovalue',
        'sodate',
        'internal_ref',
        'notes',
        'project_conversion_flg',
        'project_converted_by',
        'branch',
        'del_flag',
        'user_id'
    ];
    protected static $logOnlyDirty = true;
}

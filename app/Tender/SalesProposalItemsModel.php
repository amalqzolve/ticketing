<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SalesProposalItemsModel extends Authenticatable
{
    protected $table = 'sales_proposal_items';
    protected $fillable = [
        'sales_proposal_id',
        'item_name',
        'description',
        'amount',
        'status',
        'user_id',
    ];
    protected static $logOnlyDirty = true;
}

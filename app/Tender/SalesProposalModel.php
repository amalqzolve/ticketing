<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SalesProposalModel extends Authenticatable
{
    protected $table = 'sales_proposal';
    protected $fillable = [
        'boq_id',
        'quotedate',
        'valid_till',
        'salesman',
        'sales_proposal_category_id',
        'attention',
        'file_data',
        'reference',
        'internalreference',
        'notes',
        'terms',
        'linetotalamount',
        'estimated_amount',
        'net_amount',
        'profit_percenatge',
        'profit_amount',
        'total_amount_including_profit',
        'discount_percenatge',
        'discount_amount',
        'amount_after_discount',
        'vat_percenatge',
        'vat_amount',
        'grandtotalamount',
        'status',
        'sales_order_generated_flg',
        'user_id',
    ];
    protected static $logOnlyDirty = true;
}

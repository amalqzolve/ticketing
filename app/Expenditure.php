<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    protected $table = 'expenditures';
    protected $fillable = [
        'sales_order_id',
        'quotedate',
        'invoice_date',
        'valid_till',
        'qtn_ref',
        'po_ref',
        'delivery_period',
        'attention',
        'salesman',
        'currency',
        'currencyvalue',
        'preparedby',
        'approvedby',
        'payment_terms',
        'discount_type',
        'sup_id',
        'sup_name',
        'salesman_name',
        'terms_conditions',
        'notes',
        'internal_reference',
        'tpreview',
        'documents',
        'totalamount',
        'discount',
        'amountafterdiscount',
        'vatamount',
        'grandtotalamount',
        'sale_method',
        'status',
        'del_flag',
        'branch',
        'created_at',
        'updated_at',
        'user_id',
        'entry_id',
    ];
}

<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentModel extends Model
{
    use SoftDeletes;
    protected $table = 'car_rent_payment';
    protected $fillable = [
        'car_in_out_id',
        'quotedate',
        'valid_till',
        'method',
        'salesman',
        'currency',
        'currencyvalue',
        // 'qtn_ref',
        // 'po_ref',
        // 'payment_terms',
        // 'discount_type',
        'preparedby',
        'approvedby',
        'notes',
        'internalreference',
        'terms_conditions',
        'name',
        'description',
        'amount',
        'discount_percentage',
        'vat_percentage',
        'totalamount',
        'discount',
        'amountafterdiscount',
        'totalvatamount',
        'grandtotalamount',
        'branch',
        'user_id',
        'status',
        
    ];
}

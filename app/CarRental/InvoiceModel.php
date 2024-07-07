<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceModel extends Model
{
    use SoftDeletes;
    protected $table = 'car_rent_invoice';
    protected $fillable = [
        'car_in_out_id',
        'car_rent_performa_invoice_id',
        'quotedate',
        'valid_till',
        'method',
        'salesman',
        'currency',
        'currencyvalue',
        'qtn_ref',
        'po_ref',
        'payment_terms',
        'discount_type',
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

        'vat_amount',
        'total_amount',
        'additional_name',
        'additional_description',
        'additional_amount',
        'additional_discount_percentage',
        'additional_vat_percentage',
        'additional_vat_amount',
        'additional_total_amount',

        //summary
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

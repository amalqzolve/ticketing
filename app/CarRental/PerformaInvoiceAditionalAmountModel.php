<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;

class PerformaInvoiceAditionalAmountModel extends Model
{
    protected $table = 'car_rent_performa_invoice_aditional_amount';
    protected $fillable = [
        'car_in_out_id',
        'car_rent_performa_invoice_id',
        'additional_cost_id',
        'additional_remarks',
        'additional_desc',
        'additional_cost_amount',
        'additional_cost_discount',
        'additional_cost_vat',
        'additional_cost_vat_amount',
        'additional_cost_total_amount'
    ];
}

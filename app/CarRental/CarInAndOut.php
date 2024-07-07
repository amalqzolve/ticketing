<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarInAndOut extends Model
{
    use SoftDeletes;
    protected $table = 'car_in_out';
    protected $fillable = [
        'isue_date',
        'exp_date',
        'car_id',
        'trip_start_date',
        'trip_end_date',
        'trip_start_odometer',
        'trip_end_odometer',
        'rental_type',
        'rate',
        'limit',
        'aditional_amount',
        'customer_id',
        'renter_iqama',
        'iqama_issue_date',
        'iqama_exp_date',
        'renter_licence_number',
        'renter_licence_issue_date',
        'renter_licence_exp_date',
        'additional_driver_name',
        'additional_driver_licence_issue_date',
        'additional_driver_licence_exp_date',
        'adwance_amount',
        'amount',
        'aditional_amount_total',
        'discount',
        'total_amount',
        'vat_percentage',
        'vat_amount',
        'grand_total_amount',
        'total_amount_invoiced',
        'total_additional_amount_invoiced',
        'total_amount_performa_invoiced',
        'total_additional_amount_performa_invoiced',

        'ins_id',
        'ins_type',
        'ins_amount',
        'ins_start_date',
        'ins_end_date',
        'ins_note',
        'terms_conditions',

        'status',
        'branch'
    ];
}

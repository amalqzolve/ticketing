<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use SoftDeletes;
    protected $table = 'car';
    protected $fillable = [
        'car_name',
        'model',
        'number_plate',
        'registration_number',
        'chais_number',
        'color',
        'made',
        'brand',
        'present_odometer',
        'type',
        'car_category_id',
        'ownership_type',
        'owner_name',
        'phone',
        'email',
        'address',
        'monthly_charge',
        'monthly_limit',
        'monthly_additional_charge',
        'dayily_charge',
        'daily_limit',
        'dayily_additional_charge',
        'hourly_charge',
        'hourly_limit',
        'hourly_additional_charge',
        'contract_charge',
        'contract_limit',
        'contract_additional_charge',
        'out_status',
        'branch'



    ];
}

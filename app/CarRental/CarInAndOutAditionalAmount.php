<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;

class CarInAndOutAditionalAmount extends Model
{
    protected $table = 'car_in_out_aditional_amount';
    protected $fillable = [
        'car_in_out_id',
        'amount',
        'remarks',
        'status'
    ];
}

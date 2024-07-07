<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarCategoryModel extends Model
{
    use SoftDeletes;
    protected $table = 'car_category';
    protected $fillable = ['name', 'decription', 'branch'];
}

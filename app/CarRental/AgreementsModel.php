<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementsModel extends Model
{
    use SoftDeletes;
    protected $table = 'car_reant_agreements';
    protected $fillable = ['file',  'file_path', 'description', 'uploded_by', 'uploded_date', 'car_in_out_id'];
}

<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarInAndOutNoteModel extends Model
{
    use SoftDeletes;
    protected $table = 'car_reant_notes';
    protected $fillable = ['note_title', 'note_date', 'note_description', 'public_flg', 'car_in_out_id', 'created_by'];
}

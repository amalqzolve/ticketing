<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class CountrieslistModel extends Model
{
    //
    protected $table = 'countries';
    protected $fillable = ['id','cntry_name'];
    protected static $logOnlyDirty = true;
}

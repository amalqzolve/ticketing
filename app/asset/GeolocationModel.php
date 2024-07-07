<?php

namespace App\asset;

use Illuminate\Database\Eloquent\Model;

class GeolocationModel extends Model
{
   protected $table = 'assets_geolocation';
    protected $fillable = ['name','location','branch'];
    protected static $logOnlyDirty = true;
}
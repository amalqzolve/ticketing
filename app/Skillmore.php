<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillmore extends Model
{
    
      public $table = "skill_more";

      public $fillable = ['info_id','skill','value'];

}

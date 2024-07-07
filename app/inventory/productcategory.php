<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class productcategory extends Model
{
	
    protected $table    = 'qinvoice_category';
    protected $fillable = ['category_name', 'starting_number', 'description','increment','branch','category_code'];
 
    protected static $logOnlyDirty = true;
}




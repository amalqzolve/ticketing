<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;


class VendorCategoryModel extends Authenticatable
{
	use Notifiable;
    use LogsActivity;
   
    protected $table = 'vendor_category_details';
    protected $fillable = [
    	                    'vendor_category',
                            'description',
                             'color',
                             'customcode',
    	                     'startfrom'
                          ];
}

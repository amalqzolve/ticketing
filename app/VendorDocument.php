<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;


class VendorDocument extends Authenticatable
{
	use Notifiable;

    use LogsActivity;

     protected $table = 'vendor_documents';

    protected $fillable = [

							'name',
                            'title',
							'description',
							'uniqueid',
							'file_data',
                            'cust_users'
    ];



    protected static $logOnlyDirty = true;
}

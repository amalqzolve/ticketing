<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;


class TaxInformation extends Authenticatable
{
	use Notifiable;

    use LogsActivity;

     protected $table = 'tax_informations';

    protected $fillable = [

							'vat_no',
							'vat_name',
							'uniqueid',
							'file_data',
                            'cust_users'
    ];



    protected static $logOnlyDirty = true;
}

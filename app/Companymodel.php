<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Companymodel extends Authenticatable
{
    public function boot()
    {

        $company = DB::table('qsettings_company')->select('common_customer_database')->get();
        // View::share('company',$company);  
        config(['yourconfig.company' => $company]);
    }
}

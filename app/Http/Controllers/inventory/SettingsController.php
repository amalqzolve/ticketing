<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class SettingsController extends Controller
{
     /**
     * Display a listing of Various Accounts.
     */

    public function SettingstListing()
    {
        
         return view('inventory.settings.listing');
    }


    /**
     * Add New store managements Form.
     */
    public function addsettings()
    {
         return view('inventory.settings.addsettings');
    }

    
}

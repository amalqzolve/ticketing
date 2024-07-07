<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Auth;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Session;
// use Spatie\Activitylog\Models\Activity;
use DB;
class DashboardController extends Controller
{
   
 public function show() 
    {
     

            $currency           = DB::table('qpurchase_currency')->count();
            $tax               = DB::table('qpurchase_taxgroup')->count();

       return view('settings.dashboard.index', ['currency' => $currency,'tax' => $tax]);


    } 

   
    

}
?>

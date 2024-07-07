<?php

namespace App\Http\Controllers\documentation;

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
   
       return view('documentation.dashboard.index');

    } 

   
    

}
?>

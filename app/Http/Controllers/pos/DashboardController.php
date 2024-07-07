<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Boq;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pos()
    {

         return view('pos.dashboard.index');
    }
   


   
     

  
}

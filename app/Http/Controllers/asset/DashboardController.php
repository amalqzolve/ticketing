<?php

namespace App\Http\Controllers\asset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function asset_manage()
    {

         return view('asset.dashboard.index');
    }
   


   
     

  
}

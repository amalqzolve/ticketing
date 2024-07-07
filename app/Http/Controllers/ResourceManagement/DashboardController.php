<?php

namespace App\Http\Controllers\ResourceManagement;

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
    public function resourcemanagement()
    {

        return view('resourcemanagement.dashboard.index');
    }
}

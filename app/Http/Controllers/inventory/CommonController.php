<?php

namespace App\Http\Controllers\inventory;
use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('inventory.home');
    }

    /***
    Get unique id
    ***/
    public function detUniqueID()
    {
        return json_encode(uniqid());
    }


}

<?php

namespace App\Http\Controllers\boq;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Boq;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boqs = Boq::get()->toTree();
        return view('boq.dashboard.index', compact('boqs'));
    }

}

<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;


class HomeController extends Controller
{

    public function index()
    {
        return view('tenders.home');
    }
}

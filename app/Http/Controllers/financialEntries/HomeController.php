<?php

namespace App\Http\Controllers\financialEntries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;


class HomeController extends Controller
{

    public function index()
    {
        return view('financialEntries.home');
    }
}

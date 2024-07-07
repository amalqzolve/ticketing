<?php

namespace App\Http\Controllers\vouchers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;


class HomeController extends Controller
{

    public function index()
    {
        return view('vouchers.home');
    }
}

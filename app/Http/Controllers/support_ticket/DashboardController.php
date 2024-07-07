<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        return view('support_ticket.dashboard');
    }
}
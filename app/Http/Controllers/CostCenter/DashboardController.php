<?php

namespace App\Http\Controllers\CostCenter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $aut = $user->can('Cost Center Module');
        if ($aut) {
            return view('cost-center.dashboard.index');
        } else {
            echo "No Permission";
        }
    }
}

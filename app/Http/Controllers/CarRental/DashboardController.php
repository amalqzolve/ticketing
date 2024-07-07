<?php

namespace App\Http\Controllers\CarRental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\CarRental\CarCategoryModel;
use App\CarRental\CarInAndOut;
use App\CarRental\CarModel;
use Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $branch = Session::get('branch');
        $totalTrip =  CarInAndOut::where('car_in_out.branch', $branch)->count();
        $tripCompleted = CarInAndOut::where('car_in_out.branch', $branch)->where('car_in_out.status', 3)->count();
        $tripConfirmed = CarInAndOut::where('car_in_out.branch', $branch)->where('car_in_out.status', 2)->count();
        $tripDraft = CarInAndOut::where('car_in_out.branch', $branch)->where('car_in_out.status', 1)->count();
        $tripCancelled = CarInAndOut::where('car_in_out.branch', $branch)->where('car_in_out.status', -1)->count();
        $totalCars = CarModel::where('branch',  $branch)->count();
        $carOnTrip = CarModel::where('branch',  $branch)->where('out_status', 0)->count();
        $carAvailableForTrip = $totalCars - $carOnTrip;
        return view('carRental.dashboard.index', compact('totalTrip', 'tripCompleted', 'tripConfirmed', 'tripDraft', 'tripCancelled', 'totalCars', 'carOnTrip', 'carAvailableForTrip'));
    }
}

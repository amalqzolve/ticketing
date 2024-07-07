<?php

namespace App\Http\Controllers\CarRental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\CarRental\CarModel;
use App\CarRental\CarCategoryModel;
use Session;
use Auth;

class CarController extends Controller
{
    public function list(Request $request)
    {

        if ($request->ajax()) {

            $user = Auth::user();
            $query = CarModel::orderby('id', 'desc');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $j .= '<a href="car-edit?id=' . $row->id . '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-edit"></i>
                      <span class="kt-nav__link-text" data-id="' . $row->id . '" >Edit</span>
                      </span></li></a>';
                $j .= '<li class="kt-nav__item">
                      <span class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-trash"></i>
                      <span class="kt-nav__link-text mrCatdelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span></li>';
                return '<span style="overflow: visible; position: relative; width: 80px;">
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                      <i class="fa fa-cog"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                      <ul class="kt-nav">' . $j . '</ul></div></div></span>';
            })->rawColumns(['action'])->make(true);
        } else
            return view('carRental.car.listing');
    }
    public function add(Request $request)
    {
        $branch = Session::get('branch');
        $carCategory = CarCategoryModel::select('id', 'name')->where('branch', $branch)->get();
        return view('carRental.car.add', compact('carCategory'));
    }
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $query = CarModel::orderby('id', 'desc');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('carRental.car.trashlisting');
    }
    public function submit(Request $request)
    {
        $postID = $request->id;
        $branch = Session::get('branch');

        if (($postID == null) || ($postID == ''))
            $numberPlateAlreadyExist = CarModel::where('number_plate', $request->number_plate)->count();
        else
            $numberPlateAlreadyExist = CarModel::where('number_plate', $request->number_plate)->where('id', '!=', $postID)->count();
        if ($numberPlateAlreadyExist == 0) {
            $data = [
                'car_name' => $request->car_name,
                'model' => $request->model,
                'number_plate' => $request->number_plate,
                'registration_number' => $request->registration_number,
                'chais_number' => $request->chais_number,
                'color' => $request->color,
                'made' => $request->made,
                'brand' => $request->brand,
                'present_odometer' => $request->present_odometer,
                'type' => $request->type,
                'car_category_id' => $request->car_category_id,
                'ownership_type' => $request->ownership_type,
                'owner_name' => $request->owner_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'monthly_charge' => $request->monthly_charge,
                'monthly_limit' => $request->monthly_limit,
                'monthly_additional_charge' => $request->monthly_additional_charge,
                'dayily_charge' => $request->dayily_charge,
                'daily_limit' => $request->daily_limit,
                'dayily_additional_charge' => $request->dayily_additional_charge,
                'hourly_charge' => $request->hourly_charge,
                'hourly_limit' => $request->hourly_limit,
                'hourly_additional_charge' => $request->hourly_additional_charge,
                'contract_charge' => $request->contract_charge,
                'contract_limit' => $request->contract_limit,
                'contract_additional_charge' => $request->contract_additional_charge,
                'branch' => $branch
            ];
            $car = CarModel::updateOrCreate(['id' => $postID], $data);
            $out = array(
                'status' => 1
            );
        } else
            $out = array(
                'status' => 0,
                'msg' => 'Number Plate is already exist'
            );
        echo json_encode($out);
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $data = CarModel::where('id', $id)->first();
        $carCategory = CarCategoryModel::select('id', 'name')->where('branch', $branch)->get();
        return view('carRental.car.edit', compact('data', 'branch', 'carCategory'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $MaterialCategory = CarModel::find($request->id);
        CarModel::where('id', $id)->delete();
        $data = array(
            'status' => 1,
            'msg' => "Your Entry has been deleted",
        );
        echo json_encode($data);
    }
    public function restore(Request $request)
    {
        $id = $request->id;
        CarModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        CarModel::where('id', $id)->delete();
        return 'true';
    }



    public function getReant(Request $request)
    {
        if ($request->ajax()) {
            $data = CarModel::where('id', $request->car_id)->first();
            if (isset($data->id)) {
                if ($request->rental_type == 'Monthly') {
                    $out = array(
                        'status' => 1,
                        'data' => array(
                            'charge' => $data->monthly_charge,
                            'limit' => $data->monthly_limit,
                            'additonal' => $data->monthly_additional_charge
                        )
                    );
                } else  if ($request->rental_type == 'Daily') {
                    $out = array(
                        'status' => 1,
                        'data' => array(
                            'charge' => $data->dayily_charge,
                            'limit' => $data->daily_limit,
                            'additonal' => $data->dayily_additional_charge
                        )
                    );
                } else if ($request->rental_type == 'Hourly') {
                    $out = array(
                        'status' => 1,
                        'data' => array(
                            'charge' => $data->hourly_charge,
                            'limit' => $data->hourly_limit,
                            'additonal' => $data->hourly_additional_charge
                        )
                    );
                } else if ($request->rental_type == 'Contract') {
                    $out = array(
                        'status' => 1,
                        'data' => array(
                            'charge' => $data->contract_charge,
                            'limit' => $data->contract_limit,
                            'additonal' => $data->contract_additional_charge
                        )
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'data' => array(
                            'charge' => 0,
                            'limit' => 0,
                        )
                    );
                }
            } else
                $out = array(
                    'status' => 0,
                    'data' => array(
                        'charge' => 0,
                        'limit' => 0,
                    )
                );
            echo json_encode($out);
        }
    }
}

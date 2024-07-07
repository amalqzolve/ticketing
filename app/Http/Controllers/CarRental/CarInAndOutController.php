<?php

namespace App\Http\Controllers\CarRental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\CarRental\CarInAndOutAditionalAmount;
use App\CarRental\CarModel;
use App\CarRental\CarInAndOut;

use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use PDF;
use App\CarRental\AgreementsModel;
use File;
use Storage;
use App\settings\BranchSettingsModel;

class CarInAndOutController extends Controller
{
    public function list(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = CarInAndOut::select('car_in_out.id', 'car.car_name', 'car_in_out.rental_type', DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'qcrm_customer_details.cust_name as renter_name', 'qcrm_customer_details.mobile1 as mobile', 'car_in_out.renter_iqama', 'car_in_out.status')
                ->leftjoin('car', 'car.id', 'car_in_out.car_id')
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
                ->where('car_in_out.branch', $branch)
                ->where('car_in_out.status',  1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $out = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">';

                $out .= '<a href="car-in-and-out-edit/' . Crypt::encrypt($row->id) . '"  data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-edit"></i>
                        <span class="kt-nav__link-text" data-id="' . Crypt::encrypt($row->id) . '" >Edit</span>
                        </span></li></a>';

                $out .= '<a href="car-in-and-out-pdf/' . Crypt::encrypt($row->id) . '" target="_blank" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' . Crypt::encrypt($row->id) . '" >PDF</span>
                        </span></li></a>
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item confirmTrip" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Confirm Trip </span>
                        </span></li></a>
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item cancelTrip" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-cross"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Cancel Trip </span>
                        </span></li></a>';

                $out .= '<li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text trashTrip" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span>
                        </li>';

                $out .= '</ul></div></div></span>';
                return $out;
            })->addColumn('trip_id', function ($row) use ($user) {
                $url = URL::to('car-rental/trip-overview', Crypt::encryptString($row->id));
                return 'TRIP-' . $row->id;
            })->rawColumns(['action', 'trip_id'])->make(true);
        } else {
            $cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();
            $branch = Session::get('branch');
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
            return view('carRental.CarInAndOut.list', compact('cars', 'termslist'));
        }
    }

    public function listConfirmed(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = CarInAndOut::select('car_in_out.id', 'car.car_name', 'car_in_out.rental_type', DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'qcrm_customer_details.cust_name as renter_name', 'qcrm_customer_details.mobile1 as mobile', 'car_in_out.renter_iqama', 'car_in_out.status')
                ->leftjoin('car', 'car.id', 'car_in_out.car_id')
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
                ->where('car_in_out.branch', $branch)
                ->where('car_in_out.status',  2);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $out = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">';

                $out .= '<a href="car-in-and-out-pdf/' . Crypt::encrypt($row->id) . '" target="_blank" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' . Crypt::encrypt($row->id) . '" >PDF</span>
                        </span></li></a>
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item completeTrip" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Complete Trip </span>
                        </span></li></a>
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item cancelTrip" id=' . $row->id . '>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-cross"></i>
                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Cancel Trip </span>
                        </span></li></a>';

                $out .= '<li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text trashTrip" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span>
                        </li>';

                $out .= '</ul></div></div></span>';
                return $out;
            })->addColumn('trip_id', function ($row) use ($user) {
                $url = URL::to('car-rental/trip-overview', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab">TRIP-' . $row->id . '</a>';
            })->rawColumns(['action', 'trip_id'])->make(true);
        } else
            return Null;
    }
    public function listCompleted(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = CarInAndOut::select('car_in_out.id', 'car.car_name', 'car_in_out.rental_type', DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'qcrm_customer_details.cust_name as renter_name', 'qcrm_customer_details.mobile1 as mobile', 'car_in_out.renter_iqama', 'car_in_out.status')
                ->leftjoin('car', 'car.id', 'car_in_out.car_id')
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
                ->where('car_in_out.branch', $branch)
                ->where('car_in_out.status',  3);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $out = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">';
                // $out .= '<a href="car-in-and-out-edit/' . Crypt::encrypt($row->id) . '" data-type="edit"><li class="kt-nav__item">
                //         <span class="kt-nav__link">
                //         <i class="kt-nav__link-icon flaticon2-edit"></i>
                //         <span class="kt-nav__link-text" data-id="' . Crypt::encrypt($row->id) . '" >Edit</span>
                //         </span></li></a>';

                $out .= '<a href="car-in-and-out-pdf/' . Crypt::encrypt($row->id) . '" target="_blank" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' . Crypt::encrypt($row->id) . '" >PDF</span>
                        </span></li></a>';


                $out .= '</ul></div></div></span>';
                return $out;
            })->addColumn('trip_id', function ($row) use ($user) {
                $url = URL::to('car-rental/trip-overview', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab">TRIP-' . $row->id . '</a>';
            })->addColumn('payment_status', function ($row) use ($user) {
                return 'eeee';
            })
                ->rawColumns(['action', 'trip_id', 'payment_status'])->make(true);
        } else
            return Null;
    }
    public function listCanceled(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $user = Auth::user();
            $query = CarInAndOut::select('car_in_out.id', 'car.car_name', 'car_in_out.rental_type', DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'qcrm_customer_details.cust_name as renter_name', 'qcrm_customer_details.mobile1 as mobile', 'car_in_out.renter_iqama', 'car_in_out.status')
                ->leftjoin('car', 'car.id', 'car_in_out.car_id')
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
                ->where('car_in_out.branch', $branch)
                ->where('car_in_out.status',  -1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $out = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">';

                $out .= '<a href="car-in-and-out-pdf/' . Crypt::encrypt($row->id) . '" target="_blank" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' . Crypt::encrypt($row->id) . '" >PDF</span>
                        </span></li></a>';

                $out .= '<li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text trashTrip" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span>
                        </li>';

                $out .= '</ul></div></div></span>';
                return $out;
            })->addColumn('trip_id', function ($row) use ($user) {
                $url = URL::to('car-rental/trip-overview', Crypt::encryptString($row->id));
                return '<a  href="' . $url . '" role="tab">TRIP-' . $row->id . '</a>';
            })->rawColumns(['action', 'trip_id'])->make(true);
        } else
            return null;
    }

    public function add(Request $request)
    {
        if (!$request->ajax()) {
            $branch = Session::get('branch');
            $cars =  CarModel::select('id', 'registration_number', 'car_name', 'number_plate')->where('out_status', 0)->where('branch', $branch)->get();
            $countries = DB::table('countries')->select('id', 'cntry_name')->get();

            $customers = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaList = DB::table('qcrm_customer_categorydetails')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();

            $areaLists = DB::table('qcrm_customer_typedetails')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = DB::table('qcrm_customer_groupdetails')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
            return view('carRental.CarInAndOut.add', compact('cars', 'countries', 'customers', 'areaList', 'areaLists', 'group'));
        } else
            return null;
    }
    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            $branch = Session::get('branch');
            $id = Crypt::decrypt($id);

            $rental = CarInAndOut::select('car_in_out.*', 'qcrm_customer_details.cust_code', 'qcrm_customer_details.cust_type', 'qcrm_customer_details.cust_category', 'qcrm_customer_details.cust_group', 'qcrm_customer_details.cust_name', 'qcrm_customer_details.cust_add1', 'qcrm_customer_details.cust_add2', 'qcrm_customer_details.cust_country', 'qcrm_customer_details.cust_region', 'qcrm_customer_details.cust_city', 'qcrm_customer_details.cust_zip', 'qcrm_customer_details.mobile1', 'qcrm_customer_details.branch', 'qcrm_customer_details.cust_district', 'qcrm_customer_details.building_no', 'qcrm_customer_details.email1', 'qcrm_customer_details.vatno', 'qcrm_customer_details.buyerid_crno', 'qcrm_customer_details.account_ledger')
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
                ->where('car_in_out.id', $id)
                ->first();
            $cars =  CarModel::select('id', 'registration_number', 'car_name', 'number_plate')->where('branch', $branch)->get();
            $countries = DB::table('countries')->select('id', 'cntry_name')->get();
            $customers = DB::table('qcrm_customer_details')->select('id', 'cust_name')->where('branch', $branch)->where('del_flag', 1)->get();
            $areaList = DB::table('qcrm_customer_categorydetails')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();

            $areaLists = DB::table('qcrm_customer_typedetails')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
            $group = DB::table('qcrm_customer_groupdetails')->select('*')->where('branch', $branch)->where('del_flag', 1)->get();
            return view('carRental.CarInAndOut.edit', compact('rental', 'cars', 'countries', 'customers', 'areaList', 'areaLists', 'group'));
        } else
            return null;
    }
    public function save(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $postID = $request->id;
                    $branch = Session::get('branch');

                    // /Check IF new customer/
                    if ($request->newcustomer == 1) {
                        $customer_default = 0;
                        $customer_default = DB::table('qsettings_company_accounts')->where('branch', $branch)->value('customer_default');
                        $customer_data = array(
                            'cust_code' => $request->cust_code,
                            'cust_type' => $request->cust_type,
                            'cust_category' => $request->cust_category,
                            'cust_group' => $request->cust_group,
                            'cust_name' => $request->cust_name,
                            'cust_add1' => $request->building_no,
                            'cust_add2' => $request->cust_region,
                            'cust_country' => $request->cust_country,
                            'cust_region' => $request->cust_district,
                            'cust_city' => $request->cust_city,
                            'cust_zip' => $request->cust_zip,
                            'mobile1' => $request->mobile,
                            'branch' => $branch,
                            'cust_district' => $request->cust_district,
                            'building_no' => $request->building_no,
                            'email1' => $request->email,
                            'vatno' => $request->vatno,
                            'buyerid_crno' => $request->buyerid_crno,
                            'account_ledger' => $customer_default
                        );

                        DB::table('qcrm_customer_details')->insert($customer_data);
                        $customer_id = DB::getPdo()->lastInsertId();
                    } else
                        $customer_id = $request->customer;

                    $data = array(
                        'isue_date' => isset($request->isue_date) ? Carbon::parse($request->isue_date)->format('Y-m-d') : NULL,
                        'exp_date' => isset($request->exp_date) ? Carbon::parse($request->exp_date)->format('Y-m-d') : NULL,
                        'car_id' => $request->car_id,
                        'trip_start_date' => isset($request->trip_start_date) ? Carbon::parse($request->trip_start_date)->format('Y-m-d') : NULL,
                        'trip_end_date' => isset($request->trip_end_date) ? Carbon::parse($request->trip_end_date)->format('Y-m-d') : NULL,
                        'trip_start_odometer' => $request->trip_start_odometer,
                        'trip_end_odometer' => $request->trip_end_odometer,
                        'rental_type' => $request->rental_type,
                        'rate' => $request->rate,
                        'limit' => $request->limit,
                        'aditional_amount' => $request->aditional_amount,
                        'customer_id' => $customer_id,
                        'renter_iqama' => $request->renter_iqama,
                        'iqama_issue_date' => isset($request->iqama_issue_date) ? Carbon::parse($request->iqama_issue_date)->format('Y-m-d') : NULL,
                        'iqama_exp_date' => isset($request->iqama_exp_date) ? Carbon::parse($request->iqama_exp_date)->format('Y-m-d') : NULL,
                        'renter_licence_number' => $request->renter_licence_number,
                        'renter_licence_issue_date' => isset($request->renter_licence_issue_date) ? Carbon::parse($request->renter_licence_issue_date)->format('Y-m-d') : NULL,
                        'renter_licence_exp_date' => isset($request->renter_licence_exp_date) ? Carbon::parse($request->renter_licence_exp_date)->format('Y-m-d') : NULL,
                        'additional_driver_name' => $request->additional_driver_name,
                        'additional_driver_licence_issue_date' => isset($request->additional_driver_licence_issue_date) ? Carbon::parse($request->additional_driver_licence_issue_date)->format('Y-m-d') : NULL,
                        'additional_driver_licence_exp_date' => isset($request->additional_driver_licence_exp_date) ? Carbon::parse($request->additional_driver_licence_exp_date)->format('Y-m-d') : NULL,
                        'adwance_amount' => $request->adwance_amount,
                        'status' => 1,
                        'branch' => $branch
                    );
                    $carInAndOut = CarInAndOut::updateOrCreate(['id' => $postID], $data);
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Success'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }
    public function confirm(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ifFound = CarInAndOut::find($request->rental_id);
                if ($ifFound) {
                    DB::transaction(function () use ($request, $ifFound) {
                        $uploded_by = Auth::user()->id;
                        $carId = $ifFound->car_id;
                        $data = array(
                            'trip_start_odometer' => $request->trip_start_odometer,
                            'ins_id' => $request->ins_id,
                            'ins_type' => $request->ins_type,
                            'ins_amount' => $request->ins_amount,
                            'ins_start_date' =>  isset($request->ins_start_date) ? Carbon::parse($request->ins_start_date)->format('Y-m-d') : NULL,
                            'ins_end_date' => isset($request->ins_end_date) ? Carbon::parse($request->ins_end_date)->format('Y-m-d') : NULL,
                            'ins_note' => $request->ins_note,
                            'terms_conditions' => $request->terms_conditions,
                            'status' => 2
                        );
                        $ifFound->update($data);
                        $out = array(
                            'status' => 1,
                            'msg' => 'Saved Success'
                        );

                        $car_in_out_id = $request->rental_id;
                        $path = public_path('car_reant_agreements/' . $car_in_out_id);
                        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
                        $id = $car_in_out_id;
                        $branch = Session::get('branch');
                        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
                        $companysettings = BranchSettingsModel::where('branch', $branch)->get();
                        $tripData = CarInAndOut::select('car_in_out.id', DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"), DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'car_in_out.customer_id', 'car_in_out.car_id', 'car_in_out.trip_start_odometer', 'car_in_out.trip_end_odometer', 'car_in_out.ins_note', 'qcrm_termsandconditions.description')
                            ->leftjoin('qcrm_termsandconditions', 'car_in_out.terms_conditions', '=', 'qcrm_termsandconditions.id')
                            ->where('car_in_out.id',  $id)
                            ->first();

                        $trip = 'TRIP ' . $tripData->id . '_' . date('d-m-Y', strtotime($tripData->trip_start_date));
                        $configuration = [];

                        $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')
                            ->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
                            ->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')
                            ->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
                            ->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')
                            ->where('qcrm_customer_details.id', $tripData->customer_id)
                            ->get();

                        $pdf = PDF::loadView('carRental.CarInAndOut.termsPreview', compact('tripData', 'branchsettings', 'companysettings', 'customers'), $configuration,  [
                            'title'      => $trip,
                            'margin_top' => 0
                        ]);
                        Storage::put('public/pdf/car_reant_agreements/' . $car_in_out_id . '.pdf', $pdf->output());
                        $inArray = array(
                            'car_in_out_id' => $car_in_out_id,
                            'file' => $car_in_out_id . '.pdf',
                            'file_path' => 'public/pdf/car_reant_agreements/' . $car_in_out_id . '.pdf',
                            'description' => 'Agreements',
                            'uploded_by' => $uploded_by,
                            'uploded_date' => Carbon::now(),
                        );
                        AgreementsModel::Create($inArray);

                        CarModel::where('id', $carId)->update(array('out_status' => 1));
                    });
                    $out = array(
                        'status' => 1,
                        'msg' => 'Confirmed Successfully',
                    );
                } else
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not found',
                        'id' => $request->rental_id
                    );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Confirm'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function complete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ifFound = CarInAndOut::find($request->id);
                if ($ifFound) {
                    DB::transaction(function () use ($request, $ifFound) {
                        $carId = $ifFound->car_id;
                        $ifFound->update(array(
                            'status' => 3,
                            'additional_charge' => $request->otherTotal,
                            'trip_start_odometer' => $request->trip_start_odometer,
                            'trip_end_odometer' => $request->trip_end_odometer,
                        ));
                        foreach ($request->amount as $key => $value) {
                            if (($value != 0) || ($value != '')) {
                                $data = array(
                                    'car_in_out_id' => $request->id,
                                    'amount' => $request->remarks[$key],
                                    'remarks' => $value,

                                );
                                CarInAndOutAditionalAmount::Create($data);
                            }
                        }
                        CarModel::where('id', $carId)->update(array('out_status' => 0));
                    });
                    $out = array(
                        'status' => 1,
                        'msg' => 'Saved Success'
                    );
                } else
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not found'
                    );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function cancell(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ifFound = CarInAndOut::find($request->id);
                if ($ifFound) {
                    DB::transaction(function () use ($request, $ifFound) {
                        $carId = $ifFound->car_id;
                        $ifFound->update(array('status' => -1));
                        CarModel::where('id', $carId)->update(array('out_status' => 0));
                    });
                    $out = array(
                        'status' => 1,
                        'msg' => 'Saved Success'
                    );
                } else
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not found'
                    );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ifFound = CarInAndOut::find($request->id);
                if ($ifFound) {
                    DB::transaction(function () use ($request, $ifFound) {
                        $carId = $ifFound->car_id;
                        CarModel::where('id', $carId)->update(array(
                            'out_status' => 0,
                        ));
                        $ifFound->delete();
                    });
                    $out = array(
                        'status' => 1,
                        'msg' => 'Saved Success'
                    );
                } else
                    $out = array(
                        'status' => 0,
                        'msg' => 'Data Not found'
                    );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function getCarInAndOut(Request $request)
    {
        if ($request->ajax()) {
            $ifFound = CarInAndOut::select('id', DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'car_in_out.trip_start_odometer')->where('id', $request->id)
                ->first();
            if (isset($ifFound->id))
                $out = array(
                    'status' => 1,
                    'data' => $ifFound
                );
            else
                $out = array(
                    'status' => 0,
                    'msg' => 'Data Not found'
                );
            echo json_encode($out);
        }
    }

    public function pdf(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $branch = Session::get('branch');
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $companysettings = BranchSettingsModel::where('branch', $branch)->get();
        $tripData = CarInAndOut::select('id', DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"), DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'car_in_out.customer_id', 'car_in_out.car_id', 'trip_start_odometer', 'trip_end_odometer', 'ins_note')->where('id',  $id)->first();

        $trip = 'TRIP ' . $tripData->id . '_' . date('d-m-Y', strtotime($tripData->trip_start_date));
        $configuration = [];

        $customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')
            ->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
            ->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')
            ->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
            ->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')
            ->where('qcrm_customer_details.id', $tripData->customer_id)
            ->get();

        $pdf = PDF::loadView('carRental.CarInAndOut.preview', compact('tripData', 'branchsettings', 'companysettings', 'customers'), $configuration,  [
            'title'      => $trip,
            'margin_top' => 0
        ]);

        return $pdf->stream($trip . '.pdf');
    }
}

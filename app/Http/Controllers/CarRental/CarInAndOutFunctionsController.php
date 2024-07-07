<?php

namespace App\Http\Controllers\CarRental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\CarRental\AgreementsModel;
use App\CarRental\AttachmentsModel;
use App\CarRental\CarInAndOutNoteModel;
use DataTables;
use Carbon\Carbon;
use Auth;
use File;
use Session;
use App\projects\LabelModel;
use App\CarRental\PerformaInvoiceModel;
use App\CarRental\InvoiceModel;
use App\CarRental\PaymentModel;
use App\CarRental\ReceiptModel;
use App\CarRental\CarInAndOutAditionalAmount;
use App\CarRental\StatementOfAccountsModel;
use App\settings\BranchSettingsModel;



use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use App\CarRental\CarInAndOut;
use App\CarRental\CarModel;
use PDF;


class CarInAndOutFunctionsController extends Controller
{

    public function overView(Request $request, $id)
    {
        if (!$request->ajax()) {
            $branch = Session::get('branch');
            // $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            $carInAndOut =    CarInAndOut::select(
                'car_in_out.id',
                'car_in_out.car_id',
                'car_in_out.rental_type',
                'car_in_out.rate',
                'car_in_out.limit',
                'car_in_out.aditional_amount',
                'qcrm_customer_details.cust_name as renter_name',
                DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"),
                DB::raw("DATE_FORMAT(car_in_out.exp_date, '%d-%m-%Y') as exp_date"),
                DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"),
                DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"),
                'car_in_out.total_amount_invoiced',
                'car_in_out.trip_start_odometer',
                'car_in_out.trip_end_odometer'
            )->where('car_in_out.id', Crypt::decryptString($id))
                ->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
                ->first();
            $cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();
            if (isset($carInAndOut->id)) {
                $currentUser = Auth::user()->id;
                $totalAttachments = AttachmentsModel::where('car_in_out_id', Crypt::decryptString($id))->count();
                $totalNotes = CarInAndOutNoteModel::where('car_in_out_id', Crypt::decryptString($id))->count();
                $additionalCost = CarInAndOutAditionalAmount::where('car_in_out_id', Crypt::decryptString($id))->sum('amount');
                $paymentsGenerated = PaymentModel::where('car_in_out_id', Crypt::decryptString($id))->sum('grandtotalamount');
                $proformaInvoicedAmount = PerformaInvoiceModel::where('car_in_out_id', Crypt::decryptString($id))->sum('grandtotalamount');
                $totalInvoicedAmount = InvoiceModel::where('car_in_out_id', Crypt::decryptString($id))->sum('grandtotalamount');
                return view('carRental.CarInAndOutFunctions.overview', compact('carInAndOut', 'cars', 'id', 'totalAttachments', 'totalNotes', 'additionalCost', 'paymentsGenerated', 'proformaInvoicedAmount', 'totalInvoicedAmount'));
            } else
                return 'Trip Not Found';
        } else
            return null;
    }

    public function agreements(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = AgreementsModel::select('car_reant_agreements.id', 'car_reant_agreements.car_in_out_id', 'car_reant_agreements.description', 'car_reant_agreements.file_path', 'file', DB::raw("DATE_FORMAT(car_reant_agreements.uploded_date, '%d-%m-%Y') as uploded_date"), 'users.name')
                ->leftjoin('users', 'car_reant_agreements.uploded_by', 'users.id')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '';
                $filePath =  'download-file-from-storage/' . encrypt($row->file_path);
                $filePathDnl =  URL::to($filePath);
                $j .= '<a href="' . $filePathDnl . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-arrow-down"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Download</span>
                </span></li></a>';

                return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.agreements', compact('carInOut', 'id'));
            } else
                return 'Trip Not Found';
        }
    }


    public function agreementsUpload(Request $request)
    {

        $uploded_by = Auth::user()->id;
        $car_in_out_id = $request->car_in_out_id;
        $path = public_path('car_reant_agreements/' . $car_in_out_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {

                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $inArray = array(
                    'car_in_out_id' => $car_in_out_id,
                    'file' => $name,
                    'file_path' => $path,
                    'description' => $request->description,
                    'uploded_by' => $uploded_by,
                    'uploded_date' => Carbon::now(),
                );
                AgreementsModel::Create($inArray);
            }
        }
        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function getAgreementsDetails(Request $request)
    {
        if ($request->ajax()) {
            $value = AgreementsModel::select('id', 'description')
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value,
            );
            echo json_encode($out);
        } else
            return Null;
    }
    public function agreementsUpdate(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $postID = $request->id;
                    $data =  array(
                        'description' => $request->description,
                    );
                    $projectNote = AgreementsModel::updateOrCreate(['id' => $postID], $data);
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

    public function agreementsDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $if_found = AgreementsModel::find($request->id);
                    if ($if_found) {
                        if (File::exists($if_found->file_path . '/' . $if_found->file))
                            File::delete($if_found->file_path . '/' . $if_found->file);
                        $if_found->delete();
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Deleted Successfully'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Delete'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }




    public function attachments(Request $request, $id)
    {

        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = AttachmentsModel::select('car_reant_attachments.id', 'car_reant_attachments.car_in_out_id', 'car_reant_attachments.description', 'car_reant_attachments.file_path', 'file', DB::raw("DATE_FORMAT(car_reant_attachments.uploded_date, '%d-%m-%Y') as uploded_date"), 'users.name')
                ->leftjoin('users', 'car_reant_attachments.uploded_by', 'users.id')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';

                $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                $j .= '<a href="' . $row->file_path . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-arrow-down"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Download</span>
                </span></li></a>';

                return '<span style="overflow: visible; position: relative; width: 80px;">
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.attachments', compact('carInOut', 'id'));
            } else
                return 'Trip Not Found';
        }
    }


    public function attachmentsUpload(Request $request)
    {

        $uploded_by = Auth::user()->id;
        $car_in_out_id = $request->car_in_out_id;
        $path = public_path('car_reant_attachments/' . $car_in_out_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {

                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $inArray = array(
                    'car_in_out_id' => $car_in_out_id,
                    'file' => $name,
                    'file_path' => $path,
                    'description' => $request->description,
                    'uploded_by' => $uploded_by,
                    'uploded_date' => Carbon::now(),
                );
                AttachmentsModel::Create($inArray);
            }
        }
        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function getAttachmentsDetails(Request $request)
    {
        if ($request->ajax()) {
            $value = AttachmentsModel::select('id', 'description')
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value,
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function attachmentsUpdate(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $postID = $request->id;
                    $data =  array(
                        'description' => $request->description,
                    );
                    $projectNote = AttachmentsModel::updateOrCreate(['id' => $postID], $data);
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

    public function attachmentsDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $if_found = AttachmentsModel::find($request->id);
                    if ($if_found) {
                        if (File::exists($if_found->file_path . '/' . $if_found->file))
                            File::delete($if_found->file_path . '/' . $if_found->file);
                        $if_found->delete();
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Deleted Successfully'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Delete'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }


    public function additionalCost(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = CarInAndOutAditionalAmount::select('id', 'amount', 'remarks', 'status')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '';
                $k = 0;
                if ($row->status == 0) {
                    $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
                } else
                    return 'invoiced';
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.additionalCost', compact('carInOut', 'id', 'labels'));
            } else
                return 'Trip Not Found';
        }
    }

    public function additionalCostSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'car_in_out_id' => $request->car_in_out_id,
                        'amount' => $request->amount,
                        'remarks' => $request->remarks,
                    );
                    $projectNote = CarInAndOutAditionalAmount::updateOrCreate(['id' => $postID], $data);
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

    public function getAdditionalCost(Request $request)
    {
        if ($request->ajax()) {
            $value = CarInAndOutAditionalAmount::select('id', 'car_in_out_id', 'amount', 'remarks')
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value,
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function additionalCostDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    CarInAndOutNoteModel::find($request->id)->delete();
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Deleted Successfully'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Delete'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }




    public function advance(Request $request, $id)
    {

        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = PaymentModel::select('car_rent_payment.id', DB::raw("DATE_FORMAT(car_rent_payment.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(car_rent_payment.valid_till, '%d-%m-%Y') as valid_till"), 'qcrm_salesman_details.name as salesman', 'car_rent_payment.car_in_out_id', 'car_rent_payment.grandtotalamount', 'car_rent_payment.status', 'car_rent_payment.amount', 'car_rent_payment.preparedby', 'car_rent_payment.approvedby')

                ->leftjoin('qcrm_salesman_details', 'car_rent_payment.salesman', 'qcrm_salesman_details.id')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '';
                if ($row->status == 0) {
                    $j .= '<a href="../trip-advance-edit/' . Crypt::encryptString($row->id) . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-edit-1"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
            </span></li></a>';

                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item generate_receipt" id=' . $row->id . ' >
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-file"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" >Generate Receipt</span>
            </span></li></a>';

                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-delete"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
            </span></li></a>';
                } else {
                    $j = '<a target="_blank" href="../trip-receipt-pdf/' . Crypt::encryptString($row->id) . '" data-type="edit"><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id . '" >Receipt PDF</span>
                    </span></li></a>';
                }

                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
            })->addColumn('prepared_by', function ($row) {
                $preparedby = DB::table('qcrm_salesman_details')->select('id', 'name')->where('id', $row->preparedby)->first();
                if (isset($preparedby->name))
                    return $preparedby->name;
                else
                    return '';
                return 'prepared_by';
            })->addColumn('approved_by', function ($row) {
                $approvedby = DB::table('qcrm_salesman_details')->select('id', 'name')->where('id', $row->approvedby)->first();
                if (isset($approvedby->name))
                    return $approvedby->name;
                else
                    return '';
                return 'approved_by';
            })->rawColumns(['action'])->make(true);
        } else {
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.advance', compact('carInOut', 'id'));
            } else
                return 'Trip Not Found';
        }
    }


    public function proformaInvoice(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = PerformaInvoiceModel::select('car_rent_performa_invoice.id', DB::raw("DATE_FORMAT(car_rent_performa_invoice.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(car_rent_performa_invoice.valid_till, '%d-%m-%Y') as valid_till"), 'qcrm_salesman_details.name as salesman', 'car_rent_performa_invoice.car_in_out_id', 'car_rent_performa_invoice.grandtotalamount', 'status')
                ->leftjoin('qcrm_salesman_details', 'car_rent_performa_invoice.salesman', 'qcrm_salesman_details.id')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '<a href="../trip-performa-invoice-pdf/' . Crypt::encryptString($row->id) . '" target="_blank" data-type="edit"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-file-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >PDF</span>
                </span></li></a>';
                if ($row->status == 0) {
                    $j .= '<a href="../trip-proforma-invoice-edit/' . Crypt::encryptString($row->id) . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-edit-1"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
            </span></li></a>';

                    $j .= '<a href="../proforma-invoice-convert-to-invoice/' . Crypt::encryptString($row->id) . '" data-type="edit"><li class="kt-nav__item">
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-file"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" >Convert To Invoice</span>
            </span></li></a>';

                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-delete"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
            </span></li></a>';
                }

                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.proformaInvoice', compact('carInOut', 'id'));
            } else
                return 'Trip Not Found';
        }
    }
    public function invoices(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = InvoiceModel::select('car_rent_invoice.id', DB::raw("DATE_FORMAT(car_rent_invoice.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(car_rent_invoice.valid_till, '%d-%m-%Y') as valid_till"), 'qcrm_salesman_details.name as salesman', 'car_rent_invoice.car_in_out_id', 'car_rent_invoice.grandtotalamount', 'status')
                ->leftjoin('qcrm_salesman_details', 'car_rent_invoice.salesman', 'qcrm_salesman_details.id')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '<a href="../trip-invoice-pdf/' . Crypt::encryptString($row->id) . '" target="_blank" data-type="edit"><li class="kt-nav__item">
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-file-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >PDF</span>
                </span></li></a>';
                if ($row->status == 0) {
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item send" id=' . $row->id . ' >
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-check-mark "></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id . '" >Send</span>
                    </span></li></a>';


                    $j .= '<a href="../trip-invoice-edit/' . Crypt::encryptString($row->id) . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-edit-1"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
            </span></li></a>';
                    $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
            <span class="kt-nav__link">
            <i class="kt-nav__link-icon flaticon-delete"></i>
            <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
            </span></li></a>';
                }
                //     if ($row->status == 1) {
                //         $j .= '<a href="../invoice-convert-to-receipt/' . Crypt::encryptString($row->id) . '" data-type="edit"><li class="kt-nav__item">
                // <span class="kt-nav__link">
                // <i class="kt-nav__link-icon flaticon-file"></i>
                // <span class="kt-nav__link-text" data-id="' . $row->id . '" >Generate Receipt</span>
                // </span></li></a>';
                //     }

                return '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">' . $j . '
                       </ul></div></div></span>';
            })->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.invoices', compact('carInOut', 'id'));
            } else
                return 'Trip Not Found';
        }
    }
    public function statementOfAccounts(Request $request, $id)
    {

        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = StatementOfAccountsModel::select('car_rent_statement_of_accounts.id',  DB::raw("DATE_FORMAT(car_rent_statement_of_accounts.transcation_date, '%d-%m-%Y') as transcation_date"), 'car_rent_statement_of_accounts.trans_type', 'car_rent_statement_of_accounts.notes', 'car_rent_statement_of_accounts.debit_amount', 'car_rent_statement_of_accounts.credit_amount', 'car_rent_statement_of_accounts.balance_amount')
                ->where('car_rent_statement_of_accounts.car_in_out_id', $request->car_in_out_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('file_path', function ($row) {
                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                return URL::to($filePath);
            })->rawColumns(['action'])->make(true);
        } else {
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.statementOfAccounts', compact('carInOut', 'id'));
            } else
                return 'Trip Not Found';
        }
    }

    public function statementOfAccountsPdf(Request $request, $id)
    {
        if (!$request->ajax()) {
            $data = StatementOfAccountsModel::select('car_rent_statement_of_accounts.id',  DB::raw("DATE_FORMAT(car_rent_statement_of_accounts.transcation_date, '%d-%m-%Y') as transcation_date"), 'car_rent_statement_of_accounts.trans_type', 'car_rent_statement_of_accounts.notes', 'car_rent_statement_of_accounts.debit_amount', 'car_rent_statement_of_accounts.credit_amount', 'car_rent_statement_of_accounts.balance_amount')
                ->where('car_rent_statement_of_accounts.car_in_out_id', Crypt::decryptString($id))
                ->get();
            $id = Crypt::decryptString($id);

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

            $pdf = PDF::loadView('carRental.CarInAndOutFunctions.statementOfAccountsPreview', compact('tripData', 'branchsettings', 'companysettings', 'customers'), $configuration,  [
                'title'      => $trip,
                'margin_top' => 0
            ]);

            return $pdf->stream($trip . '.pdf');
        } else
            return null;
    }

    public function notes(Request $request, $id)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = CarInAndOutNoteModel::select('id', 'note_description', 'note_title', DB::raw("DATE_FORMAT(car_reant_notes.note_date, '%d-%m-%Y') as note_date"), 'public_flg')
                ->where('car_in_out_id', $request->car_in_out_id)
                ->where(function ($query) use ($currentUser) {
                    $query->orwhere('public_flg', 1)
                        ->orWhere('created_by', $currentUser->id);
                })
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {
                $j = '';
                $k = 0;
                $j = '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item editView" id=' . $row->id . '>
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-edit-1"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Edit </span>
                </span></li></a>';
                $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                return '<span style="overflow: visible; position: relative; width: 80px;">
                          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">' . $j . '
                           </ul></div></div></span>';
            })->rawColumns(['action'])->make(true);
        } else {
            $projectId = $id;
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();
            $carInOut = CarInAndOut::where('id', Crypt::decryptString($id))->first();
            if (isset($carInOut->id)) {
                $currentUser = Auth::user()->id;
                return view('carRental.CarInAndOutFunctions.notes', compact('carInOut', 'id', 'labels'));
            } else
                return 'Trip Not Found';
        }
    }

    public function notesSubmit(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $postID = $request->id;
                    $data =  array(
                        'car_in_out_id' => $request->car_in_out_id,
                        'note_title' => $request->note_title,
                        'note_description' => $request->note_description,
                        'note_date' => isset($request->note_date) ? Carbon::parse($request->note_date)->format('Y-m-d  h:i') : NULL,
                        'public_flg' => $request->public_flg,
                        'created_by' => $createdBy
                    );
                    $projectNote = CarInAndOutNoteModel::updateOrCreate(['id' => $postID], $data);
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

    public function getNotes(Request $request)
    {
        if ($request->ajax()) {
            $value = CarInAndOutNoteModel::select('id', 'note_title', 'note_description', DB::raw("DATE_FORMAT(note_date, '%d-%m-%Y') as note_date"), 'public_flg')
                ->where('id', $request->id)
                ->first();
            $out = array(
                'status' => 1,
                'data' => $value,
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function notesDelete(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    CarInAndOutNoteModel::find($request->id)->delete();
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Deleted Successfully'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Delete'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }
}

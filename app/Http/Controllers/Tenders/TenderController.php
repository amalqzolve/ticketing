<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\crm\CustomerModel;
use App\Tender\TenderModel;
use App\Tender\CategoryModel;
use App\Tender\CategorySynthesisModel;
use App\Tender\ApprovalTransactionModel;
use Session;
use DB;
use Carbon\Carbon;
use Auth;
use PDF;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;
use App\User;
use App\settings\BranchSettingsModel;


class TenderController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TenderModel::select(
                'tenders.id',
                'tenders.project_name',
                DB::raw("DATE_FORMAT(tenders.date_of_submission, '%d-%m-%Y') as date_of_submission"),
                DB::raw("DATE_FORMAT(tenders.date_of_release, '%d-%m-%Y') as date_of_release"),
                DB::raw("DATE_FORMAT(tenders.bid_extension_date, '%d-%m-%Y') as bid_extension_date"),
                DB::raw("DATE_FORMAT(tenders.bid_submission_date, '%d-%m-%Y') as bid_submission_date"),
                'tenders.bid_bond',
                'tenders.consultant',
                'tenders.scope_of_work',
                'qcrm_customer_details.cust_name as client',
                'users.name',
                'tenders.status'
            )
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->where('tenders.status', 1)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.tender.list');
    }
    public function sendList(Request $request)
    {
        if ($request->ajax()) {
            $data = TenderModel::select(
                'tenders.id',
                'tenders.project_name',
                DB::raw("DATE_FORMAT(tenders.date_of_submission, '%d-%m-%Y') as date_of_submission"),
                DB::raw("DATE_FORMAT(tenders.date_of_release, '%d-%m-%Y') as date_of_release"),
                DB::raw("DATE_FORMAT(tenders.bid_extension_date, '%d-%m-%Y') as bid_extension_date"),
                DB::raw("DATE_FORMAT(tenders.bid_submission_date, '%d-%m-%Y') as bid_submission_date"),
                'tenders.bid_bond',
                'tenders.consultant',
                'tenders.scope_of_work',
                'qcrm_customer_details.cust_name as client',
                'users.name',
                'tenders.status'
            )
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->where('tenders.status', 2)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function ApprovedList(Request $request)
    {
        if ($request->ajax()) {
            $data = TenderModel::select(
                'tenders.id',
                'tenders.project_name',
                DB::raw("DATE_FORMAT(tenders.date_of_submission, '%d-%m-%Y') as date_of_submission"),
                DB::raw("DATE_FORMAT(tenders.date_of_release, '%d-%m-%Y') as date_of_release"),
                DB::raw("DATE_FORMAT(tenders.bid_extension_date, '%d-%m-%Y') as bid_extension_date"),
                DB::raw("DATE_FORMAT(tenders.bid_submission_date, '%d-%m-%Y') as bid_submission_date"),
                'tenders.bid_bond',
                'tenders.consultant',
                'tenders.scope_of_work',
                'qcrm_customer_details.cust_name as client',
                'users.name',
                'tenders.status'
            )
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->where('tenders.status', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function rejectedList(Request $request)
    {
        if ($request->ajax()) {
            $data = TenderModel::select(
                'tenders.id',
                'tenders.project_name',
                DB::raw("DATE_FORMAT(tenders.date_of_submission, '%d-%m-%Y') as date_of_submission"),
                DB::raw("DATE_FORMAT(tenders.date_of_release, '%d-%m-%Y') as date_of_release"),
                DB::raw("DATE_FORMAT(tenders.bid_extension_date, '%d-%m-%Y') as bid_extension_date"),
                DB::raw("DATE_FORMAT(tenders.bid_submission_date, '%d-%m-%Y') as bid_submission_date"),
                'tenders.bid_bond',
                'tenders.consultant',
                'tenders.scope_of_work',
                'qcrm_customer_details.cust_name as client',
                'users.name',
                'tenders.status'
            )
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->where('tenders.status', 4)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }


    public function participationList(Request $request)
    {
        if ($request->ajax()) {
            $data = TenderModel::select(
                'tenders.id',
                'tenders.project_name',
                DB::raw("DATE_FORMAT(tenders.date_of_submission, '%d-%m-%Y') as date_of_submission"),
                DB::raw("DATE_FORMAT(tenders.date_of_release, '%d-%m-%Y') as date_of_release"),
                DB::raw("DATE_FORMAT(tenders.bid_extension_date, '%d-%m-%Y') as bid_extension_date"),
                DB::raw("DATE_FORMAT(tenders.bid_submission_date, '%d-%m-%Y') as bid_submission_date"),
                'tenders.bid_bond',
                'tenders.consultant',
                'tenders.scope_of_work',
                'qcrm_customer_details.cust_name as client',
                'users.name',
                'tenders.status',
                'tenders.participation_status'
            )
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->where('tenders.status', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.tender.participation');
    }


    public function add(Request $request)
    {
        if (!$request->ajax()) {
            $branch = Session::get('branch');
            $client = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
            $category = CategoryModel::select('name', 'id')->where('branch', $branch)->get();
            return view('tenders.tender.add', compact('client', 'category'));
        } else
            return NULL;
    }



    public function save(Request $request)
    {
        if ($request->ajax()) {
            $useasr_id = Auth::user()->id;
            $data = array(
                'client' => $request->client,
                'project_name' => $request->project_name,
                'date_of_submission' => Carbon::parse($request->date_of_submission)->format('Y-m-d  h:i'),
                'date_of_release' => Carbon::parse($request->date_of_release)->format('Y-m-d  h:i'),
                'reference' => $request->reference,
                'bid_extension_date' => Carbon::parse($request->bid_extension_date)->format('Y-m-d  h:i'),
                'bid_submission_date' => Carbon::parse($request->bid_submission_date)->format('Y-m-d  h:i'),
                'bid_bond' => $request->bid_bond,
                'consultant' => $request->consultant,
                'scope_of_work' => $request->scope_of_work,
                'category_id' => $request->category_id,
                'upload' => $request->upload,
                'internalreference' => $request->internalreference,
                'notes' => $request->notes,
                'terms' => $request->terms,
                'user_id' => $useasr_id
            );
            $postID = NULL;
            $ifCreted = TenderModel::updateOrCreate(['id' => $postID], $data);
            if ($ifCreted)
                echo json_encode(array('status' => 1, 'mesage' => 'success'));
        } else
            return NULL;
    }



    public function edit(Request $request)
    {
        if (!$request->ajax()) {
            $branch = Session::get('branch');
            $client = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
            $tender = TenderModel::select('*')->find($request->id);
            $category = CategoryModel::select('name', 'id')->where('branch', $branch)->get();
            return view('tenders.tender.edit', compact('client', 'category', 'tender'));
        } else
            return NULL;
    }



    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = array(
                'client' => $request->client,
                'project_name' => $request->project_name,
                'date_of_submission' => Carbon::parse($request->date_of_submission)->format('Y-m-d  h:i'),
                'date_of_release' => Carbon::parse($request->date_of_release)->format('Y-m-d  h:i'),
                'reference' => $request->reference,
                'bid_extension_date' => Carbon::parse($request->bid_extension_date)->format('Y-m-d  h:i'),
                'bid_submission_date' => Carbon::parse($request->bid_submission_date)->format('Y-m-d  h:i'),
                'bid_bond' => $request->bid_bond,
                'consultant' => $request->consultant,
                'scope_of_work' => $request->scope_of_work,
                'category_id' => $request->category_id,
                'upload' => $request->upload,
                'internalreference' => $request->internalreference,
                'notes' => $request->notes,
            );
            $postID = $request->id;
            $ifCreted = TenderModel::updateOrCreate(['id' => $postID], $data);
            if ($ifCreted)
                echo json_encode(array('status' => 1, 'mesage' => 'success'));
        } else
            return NULL;
    }


    public function send(Request $request)
    {
        if ($request->ajax()) {
            $createdBy = Auth::user()->id;
            $id = $request->id;
            $materialReq = TenderModel::find($id);
            if ($materialReq) {
                $workflow =  CategorySynthesisModel::select('category_synthesis.id', 'users.email', 'users.name')
                    ->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')
                    ->where('cat_id', '=', $materialReq->category_id)->orderBy('priority', 'asc')->get();
                $i = 0;
                foreach ($workflow as $key => $value) {
                    $status = ($key == 0) ? 1 : 0;
                    $data = array(
                        'category_synthesis_id' => $value->id,
                        'tender_id' => $id,
                        'created_by' => $createdBy,
                        'status' => $status
                    );
                    $tData = ApprovalTransactionModel::create($data);

                    if ($status == 1) {
                        $toMailId = $value->email;
                        $this->sendMail('TNDR', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                    }

                    $i++;
                }
                if ($i != 0) {
                    $data = array('status' => 2);
                    $materialReq->update($data);
                    $out = array(
                        'status' => 1,
                        'msg' => 'success',
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Sysnthesis Not Found Contact Admin !!',
                    );
                }
                echo json_encode($out);
            } else {
                $out = array(
                    'status' => 0,
                    'msg' => 'error Please Try After Some time',
                );
                echo json_encode($out);
            }
        } else
            return NULL;
    }

    public function participationSend(Request $request)
    {
        $id =  $request->id;
        $tender = TenderModel::find($id);
        if ($tender) {
            $tender->update(array('participation_status' => 1));
            $out = array(
                'status' => 1,
                'msg' => 'Success !!',
            );
        } else {
            $out = array(
                'status' => 0,
                'msg' => 'Error !!',
            );
        }
        echo json_encode($out);
    }

    public function pdf(Request $request)
    {
        $branch =  $branch = Session::get('branch');
        $id = $request->id;
        $mainData = TenderModel::select('tenders.*', 'users.name as created_name', 'category.name as category', 'qcrm_customer_details.cust_name as client')
            ->leftjoin('qcrm_customer_details', 'tenders.client', '=', 'qcrm_customer_details.id')
            ->leftjoin('category', 'tenders.category_id', '=', 'category.id')
            ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
            ->find($id);
        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = ApprovalTransactionModel::select('approval_transaction.status', 'approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('category_synthesis', 'approval_transaction.category_synthesis_id', '=', 'category_synthesis.id')
                ->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')
                ->whereIn('approval_transaction.status', [2, 3, 4])
                ->where('approval_transaction.tender_id', '=', $id)
                ->orderBy('approval_transaction.id', 'asc')
                ->get();

            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                if ($value->status_changed_by != null) {
                    $user = $this->getDescUser($value->status_changed_by);
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $user->name,
                        'sign' => $user->sign,
                        'designation' => $user->designation,
                        'department' => $user->department,
                        'status' => $value->status,
                    );
                } else {
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $value->name,
                        'sign' => $value->sign,
                        'designation' => $value->designation,
                        'department' => $value->department,
                        'status' => $value->status,
                    );
                }
                return $outArray;
            });
        } else
            $approvalLevel = array();

        $products = array();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'TNDR ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->date_of_submission));
        $pdf = PDF::loadView('tenders.tender.prview', compact('mainData', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');

        // return view('tenders.email.tender', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
    }

    public function trash(Request $request)
    {
        $id = $request->id;
        $data = array('status' => 0);
        $materialReq = TenderModel::find($id);
        if ($materialReq) {
            $materialReq->update($data);
            echo 1;
        } else
            echo 0;
    }



    public function tenderFileUpload(Request $request)
    {
        $path = public_path('tender');
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $data[] = $name;
            }
        }
        return back()->with('success', 'Data Your files has been successfully added');
    }

    public function sendMail($docType = 'TNDR', $docId, $toMailId, $transactionId, $userName, $date)
    {
        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now()
        ];
        DB::table('email_verify_keys')->insert($data);

        $data['userName'] = $userName;
        $data['document_name'] = 'Tender';
        $data['document'] = 'TNDR';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequired($data));
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }
}

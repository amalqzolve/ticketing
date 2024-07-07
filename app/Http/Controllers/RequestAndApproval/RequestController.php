<?php

namespace App\Http\Controllers\RequestAndApproval;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\RequestAndApproval\RequestModel;
use App\RequestAndApproval\RequestApprovalModel;
use App\RequestAndApproval\RequestAttachmentsModel;
use App\RequestAndApproval\RequestItemsModel;
use DataTables;
use App\crm\CustomerModel;
use App\projects\ProjectModel;
use Illuminate\Support\Str;

use DB;
use Session;
use App\User;
use Carbon\Carbon;
use Auth;
use File;
use PDF;
use App\Mail\ActionRequired;
use App\Mail\RequestNotification;
use Mail;
use App\settings\BranchSettingsModel;



class RequestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = RequestModel::select('requests.id', 'requests.request_tittle', 'requests.request_priority', 'requests.request_against', DB::raw("DATE_FORMAT(requests.required_on, '%d-%m-%Y') as required_on"), 'requests.status', 'users.name')
                ->leftjoin('users', 'requests.creted_by',  'users.id')
                ->whereIn('requests.status', [1, 3])
                ->where('requests.creted_by', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('enc_id', function ($row) {
                return Crypt::encryptString($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('request_and_approval.request.list');
    }

    public function sendList(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = RequestModel::select('requests.id', 'requests.request_tittle', 'requests.request_priority', 'requests.request_against', DB::raw("DATE_FORMAT(requests.required_on, '%d-%m-%Y') as required_on"), 'requests.status', 'users.name')
                ->leftjoin('users', 'requests.creted_by',  'users.id')
                ->where('requests.status', 2) //send
                ->where('requests.creted_by', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('enc_id', function ($row) {
                return Crypt::encryptString($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function approvedList(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = RequestModel::select('requests.id', 'requests.request_tittle', 'requests.request_priority', 'requests.request_against', DB::raw("DATE_FORMAT(requests.required_on, '%d-%m-%Y') as required_on"), 'requests.status', 'users.name')
                ->leftjoin('users', 'requests.creted_by',  'users.id')
                ->where('requests.status', 6) //approved
                ->where('requests.creted_by', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('enc_id', function ($row) {
                return Crypt::encryptString($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function rejectedList(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = RequestModel::select('requests.id', 'requests.request_tittle', 'requests.request_priority', 'requests.request_against', DB::raw("DATE_FORMAT(requests.required_on, '%d-%m-%Y') as required_on"), 'requests.status', 'users.name')
                ->leftjoin('users', 'requests.creted_by',  'users.id')
                ->where('requests.status', 4) // 4 rejected
                ->where('requests.creted_by', '=', $currentUser)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('enc_id', function ($row) {
                return Crypt::encryptString($row->id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }


    public function add(Request $request)
    {
        $branch = Session::get('branch');
        $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = ProjectModel::select('id', 'projectname')->where('branch', $branch)->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('request_and_approval.request.add', compact('termslist', 'customers', 'projects', 'users'));
    }
    public function save(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $user_id = Auth::user()->id;
                    $branch = Session::get('branch');
                    $postID = $request->id;
                    $data = array(
                        'request_tittle' => $request->request_tittle,
                        'required_on' => Carbon::parse($request->required_on)->format('Y-m-d  h:i'),
                        'request_priority' => $request->request_priority,
                        'request_against' => $request->request_against,
                        'reference' => $request->reference,
                        'request_type' => $request->request_type,
                        'note' => $request->note,
                        'client' => $request->client,
                        'project' => $request->project,
                        'department' => $request->department,
                        'internalreference' => $request->internalreference,
                    );
                    if ($postID == '')
                        $data['creted_by'] = $user_id;
                    else {
                        $data['updated_by'] = $user_id;
                        $data['branch']   = $branch;
                    }

                    $requestData = RequestModel::updateOrCreate(['id' => $postID], $data);
                    $request_id = $requestData->id;
                    RequestItemsModel::where('request_id', $request_id)->delete();
                    if (is_array($request->item_name)) {
                        $reqProducts = array();
                        foreach ($request->item_name as $key => $value) {
                            $tempArray = array(
                                'request_id' => $request_id,
                                'itemname' => $request->item_name[$key],
                                'item_description' => $request->item_description[$key],
                            );
                            array_push($reqProducts, $tempArray);
                        }
                        RequestItemsModel::insert($reqProducts);
                    }

                    RequestApprovalModel::where('request_id', $request_id)->delete();
                    if (is_array($request->users)) {
                        $reqAuthority = array();
                        foreach ($request->users as $key => $value) {
                            $tempArray = array(
                                'request_id' => $request_id,
                                'user' => $request->users[$key],
                                'approve_type' => $request->approve_type[$key],
                                'status' => 0
                            );
                            array_push($reqAuthority, $tempArray);
                        }
                        RequestApprovalModel::insert($reqAuthority);
                    }

                    $attachment =   Session::get('attachmentRequest');
                    if ($attachment != '') {
                        $attachmentArray = json_decode($attachment);
                        RequestAttachmentsModel::whereNull('request_id')->whereIn('id', $attachmentArray)->update(array('request_id' => $request_id));
                        Session::put('attachmentRequest', '');
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Successfully'
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



    public function edit(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = ProjectModel::select('id', 'projectname')->where('branch', $branch)->get();
        $users = User::where('synthesis_user_flg', 1)->get();

        $request = RequestModel::select('*')->where('id', $id)->first();
        $requestItems = RequestItemsModel::where('request_id', $id)->orderBy('id', 'asc')->get();
        $approval = RequestApprovalModel::where('request_id', $id)->orderBy('id', 'asc')->get();
        return view('request_and_approval.request.edit', compact('termslist', 'customers', 'projects', 'users', 'request', 'requestItems', 'approval'));
    }
    public function reviseView(Request $request, $id)
    {
        // default data
        $id = Crypt::decryptString($id);
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = ProjectModel::select('id', 'projectname')->where('branch', $branch)->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        // ./default data
        $request = RequestModel::select('*')->where('id', $id)->first();
        $requestItems = RequestItemsModel::where('request_id', $id)->orderBy('id', 'asc')->get();
        $approval = RequestApprovalModel::where('request_id', $id)->orderBy('id', 'asc')->get();
        return view('request_and_approval.request.resend', compact('termslist', 'customers', 'projects', 'users', 'request', 'requestItems', 'approval'));
    }


    public function reviseSave(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $user_id = Auth::user()->id;
                    $branch = Session::get('branch');
                    $postID = $request->id;
                    $data = array(
                        'request_tittle' => $request->request_tittle,
                        'required_on' => Carbon::parse($request->required_on)->format('Y-m-d  h:i'),
                        'request_priority' => $request->request_priority,
                        'request_against' => $request->request_against,
                        'reference' => $request->reference,
                        'request_type' => $request->request_type,
                        'note' => $request->note,
                        'client' => $request->client,
                        'project' => $request->project,
                        'department' => $request->department,
                        'internalreference' => $request->internalreference,

                    );
                    if ($postID == '')
                        $data['creted_by'] = $user_id;
                    else {
                        $data['updated_by'] = $user_id;
                        $data['branch']   = $branch;
                    }

                    $requestData = RequestModel::updateOrCreate(['id' => $postID], $data);
                    $request_id = $requestData->id;
                    RequestItemsModel::where('request_id', $request_id)->delete();
                    if (is_array($request->item_name)) {
                        $reqProducts = array();
                        foreach ($request->item_name as $key => $value) {
                            $tempArray = array(
                                'request_id' => $request_id,
                                'itemname' => $request->item_name[$key],
                                'item_description' => $request->item_description[$key],
                            );
                            array_push($reqProducts, $tempArray);
                        }
                        RequestItemsModel::insert($reqProducts);
                    }

                    // RequestApprovalModel::where('request_id', $request_id)->delete();
                    if (is_array($request->users)) {
                        $reqAuthority = array();
                        foreach ($request->users as $key => $value) {
                            $tempArray = array(
                                'request_id' => $request_id,
                                'user' => $request->users[$key],
                                'approve_type' => $request->approve_type[$key],
                                'status' => 0
                            );
                            array_push($reqAuthority, $tempArray);
                        }
                        RequestApprovalModel::insert($reqAuthority);
                    }

                    // resend portion
                    $workflow =  RequestApprovalModel::select('request_approval.*', 'users.email', 'users.name')
                        ->where('request_approval.request_id', $request_id)
                        ->where('request_approval.status', 0)
                        ->leftjoin('users', 'request_approval.user', 'users.id')
                        ->get();
                    foreach ($workflow as $key => $value) {
                        if ($value->status == 0) {
                            if ($value->approve_type == 1) { //approvar
                                RequestApprovalModel::where('id', $value->id)->update(array(
                                    'status' => 1 //approve pending
                                ));
                                $req = RequestModel::find($request->id);
                                $req->update(array(
                                    'status' => 5
                                ));
                                break;
                                $this->sendMail('REQ', $request->id, $value->email, $value->id, $value->name, Carbon::now(), 'Aproval');
                            } else { //notifier
                                RequestApprovalModel::where('id', $value->id)->update(array(
                                    'status' => 2 //completed
                                ));
                                $this->sendMail('REQ', $request->id, $value->email, $value->id, $value->name, Carbon::now(), 'Notification');
                            }
                        }
                    }
                    // resend pertion

                    $attachment =   Session::get('attachmentRequest');
                    if ($attachment != '') {
                        $attachmentArray = json_decode($attachment);
                        RequestAttachmentsModel::whereNull('request_id')->whereIn('id', $attachmentArray)->update(array('request_id' => $request_id));
                        Session::put('attachmentRequest', '');
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Successfully'
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

    public function pdf(Request $request, $id)
    {
        $id = $request->id;
        $id = Crypt::decryptString($id);
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = ProjectModel::select('id', 'projectname')->where('branch', $branch)->get();
        $users = User::where('synthesis_user_flg', 1)->get();

        $request = RequestModel::select('requests.*', 'users.name')
            ->where('requests.id', $id)
            ->leftjoin('users', 'requests.creted_by', 'users.id')
            ->first();
        $requestItems = RequestItemsModel::where('request_id', $id)->orderBy('id', 'asc')->get();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')
            ->where('del_flag', 1)
            ->where('branch', $branch)
            ->get();

        if (($request->status != 1) || $request->status != 0) {
            $approvalLevel = RequestApprovalModel::select('request_approval.approve_type', 'request_approval.status', 'request_approval.comment', 'users.name', 'users.sign', 'qcrm_department.name as department', 'request_approval.updated_at')
                ->where('request_approval.request_id', $id)
                ->where('request_approval.status', '!=', 0)
                ->where('request_approval.status', '!=', 1)
                ->orderBy('request_approval.id', 'asc')
                ->leftjoin('users', 'request_approval.user', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->get();

            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                $outArray = array(
                    'updated_at' => $value->updated_at,
                    'name' =>  $value->name,
                    'sign' =>  $value->sign,
                    'designation' => $value->designation,
                    'department' => $value->department,
                    'status' => $value->status,
                    'if_accepted_note' => ($value->approve_type == 1) ? 'Approved' : 'Notifiyed',
                    'if_rejected_note' => 'Rejected',
                    'comments' => $value->comment,
                );

                return $outArray;
            });
        } else
            $approvalLevel = array();


        $eprId = 'REQ ' . $request->id . '_' . date('d-m-Y', strtotime($request->created_at));
        $configuration = [];
        $pdf = PDF::loadView('request_and_approval.request.preview', compact('request', 'requestItems', 'approvalLevel', 'branchsettings'), $configuration,  [
            'title'      => $eprId,
            'margin_top' => 0
        ]);

        return $pdf->stream($eprId . '.pdf');
    }

    public function attachmentsUpload(Request $request)
    {
        $uploded_by = Auth::user()->id;
        $request_id = $request->request_id;
        $path = public_path('request_attachments/');
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $inArray = array(
                    'request_id' => $request_id,
                    'file' => $name,
                    'file_path' => $path,
                    'description' => $request->description,
                    'uploded_by' => $uploded_by,
                    'uploded_date' => Carbon::now(),
                );
                $attchment =  RequestAttachmentsModel::Create($inArray);
                if ($request_id == '') {
                    $attachmentSession =  Session::get('attachmentRequest');
                    if ($attachmentSession != '') {
                        $attachmentArray = json_decode($attachmentSession);
                        array_push($attachmentArray, $attchment->id);
                        $attachmentVal = json_encode($attachmentArray);
                        Session::put('attachmentRequest', $attachmentVal);
                    } else {
                        $attachmentArray = array($attchment->id);
                        $attachmentVal = json_encode($attachmentArray);
                        Session::put('attachmentRequest', $attachmentVal);
                    }
                }
            }
        }

        $out = array(
            'status' => 1,
            'msg' => 'success',
        );
        echo json_encode($out);
    }

    public function attachmentsList(Request $request, $id)
    {

        if ($request->ajax()) {
            $currentUser = Auth::user();
            $data = RequestAttachmentsModel::select('request_attachments.id', 'request_attachments.request_id', 'request_attachments.description', 'request_attachments.file_path', 'file', DB::raw("DATE_FORMAT(request_attachments.uploded_date, '%d-%m-%Y') as uploded_date"), 'users.name')
                ->leftjoin('users', 'request_attachments.uploded_by', 'users.id')
                ->where('request_attachments.request_id', $request->request_id)
                ->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($currentUser) {

                $filePath =  'download-file/' . encrypt($row->file_path . '/' . $row->file);
                $path = URL::to($filePath);
                $j = '';

                $j .= '<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item delete" id=' . $row->id . ' >
                <span class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon-delete"></i>
                <span class="kt-nav__link-text" data-id="' . $row->id . '" >Delete</span>
                </span></li></a>';
                $j .= '<a href="' . $path . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
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
        } else
            return null;
    }


    public function trash(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    RequestModel::where('id', $request->id)->delete();
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Successfully'
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
            return null;
    }
    public function send(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $req = RequestModel::find($id);
                if ($req) {
                    DB::transaction(function () use ($request, $req) {
                        $workflow =  RequestApprovalModel::select('request_approval.*', 'users.email', 'users.name')
                            ->where('request_approval.request_id', $request->id)
                            ->leftjoin('users', 'request_approval.user', 'users.id')
                            ->get();
                        foreach ($workflow as $key => $value) {
                            if ($value->status == 0) {
                                if ($value->approve_type == 1) { //approvar
                                    RequestApprovalModel::where('id', $value->id)->update(array(
                                        'status' => 1 //approve pending
                                    ));
                                    $req = RequestModel::find($request->id);
                                    $req->update(array(
                                        'status' => 2
                                    ));
                                    $this->sendMail('REQ', $request->id, $value->email, $value->id, $value->name, Carbon::now(), 'Aproval');
                                    break;
                                } else { //notifier
                                    RequestApprovalModel::where('id', $value->id)->update(array(
                                        'status' => 2 //completed
                                    ));
                                    $this->sendMail('REQ', $request->id, $value->email, $value->id, $value->name, Carbon::now(), 'Notification');
                                }
                            }
                        }
                    });
                    $out = array(
                        'status' => 1,
                        'msg' => 'Success ',
                    );
                    echo json_encode($out);
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'error Please Try After Some time',
                    );
                    echo json_encode($out);
                }
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Send'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function sendMail($docType = 'REQ', $docId, $toMailId, $transactionId, $userName, $date, $type)
    {
        if ($type == 'Aproval') {
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
            $data['document_name'] = 'Request';
            $data['document'] = 'REQ';
            $data['date'] = $date;

            Mail::to($toMailId)->queue(new ActionRequired($data));
        } else { //Notification
            $token = Str::random(64);
            $data = [
                'email' => $toMailId,
                'doc_type' => $docType,
                'doc_id' => $docId,
                'transaction_id' => $transactionId,
                'token' => $token,
                'created_at' => Carbon::now()
            ];
            $data['userName'] = $userName;
            $data['document_name'] = 'Request';
            $data['document'] = 'REQ';
            $data['date'] = $date;

            Mail::to($toMailId)->queue(new RequestNotification($data));
        }
    }
}

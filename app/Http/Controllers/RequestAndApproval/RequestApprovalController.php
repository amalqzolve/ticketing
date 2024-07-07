<?php

namespace App\Http\Controllers\RequestAndApproval;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\RequestAndApproval\RequestApprovalModel;
use App\RequestAndApproval\RequestModel;
use Auth;
use DB;
use DataTables;
use App\Mail\ActionRequired;
use App\Mail\RequestNotification;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class RequestApprovalController extends Controller
{

    public function requestApprovalList(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = RequestApprovalModel::select('request_approval.id', 'requests.id as req_id', 'requests.request_tittle', 'requests.request_priority', 'requests.request_against', DB::raw("DATE_FORMAT(requests.required_on, '%d-%m-%Y') as required_on"), 'requests.status', 'users.name')
                ->leftjoin('requests', 'request_approval.request_id',  'requests.id')
                ->leftjoin('users', 'requests.creted_by',  'users.id')
                ->where('request_approval.user', '=', $currentUser)
                ->where('request_approval.status', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('enc_id', function ($row) {
                return Crypt::encryptString($row->req_id);
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('request_and_approval.request_approval.list');
    }
    public function requestApprovalListDone(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = RequestApprovalModel::select('request_approval.id', 'requests.id as req_id', 'requests.request_tittle', 'requests.request_priority', 'requests.request_against', DB::raw("DATE_FORMAT(requests.required_on, '%d-%m-%Y') as required_on"), 'requests.status', 'users.name')
                ->leftjoin('requests', 'request_approval.request_id',  'requests.id')
                ->leftjoin('users', 'requests.creted_by',  'users.id')
                ->where('request_approval.user', '=', $currentUser)
                ->where('request_approval.status', '!=', 1)
                ->where('request_approval.status', '!=', 0)
                ->where('request_approval.approve_type', 1) //only approval                
                ->groupBy('request_approval.request_id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('enc_id', function ($row) {
                return Crypt::encryptString($row->req_id);
            })->addColumn('last_action', function ($row) {
                $reqs = RequestApprovalModel::select('status')
                    ->where('request_approval.status', '!=', 0)
                    ->where('request_approval.status', '!=', 1)
                    ->where('request_approval.approve_type', 1)
                    ->orderBy('id', 'desc')
                    ->first();
                return $reqs->status;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }


    public function approve(Request $request)
    {
        if ($request->ajax()) {
            try {
                $createdBy = Auth::user()->id;
                $id = $request->id;
                $req = RequestApprovalModel::find($id);
                if ($req) {
                    DB::transaction(function () use ($request, $req) {
                        $req->update(
                            array('status' => 2, 'comment' => $request->comment)
                        );
                        $req_id = $req->request_id;
                        $workflow =  RequestApprovalModel::select('request_approval.*', 'users.email', 'users.name')
                            ->where('request_approval.request_id', $req_id)
                            ->where('request_approval.status', 0)
                            ->leftjoin('users', 'request_approval.user', 'users.id')
                            ->get();
                        foreach ($workflow as $key => $value) {
                            if ($value->status == 0) {
                                if ($value->approve_type == 1) { //approvar
                                    RequestApprovalModel::where('id', $value->id)->update(array(
                                        'status' => 1 //approve pending
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
                        $reqExist = RequestApprovalModel::where('request_id', $req_id)
                            ->where('status', 0)->count();
                        if ($reqExist == 0) { // no approval is pending so requst change to approved Status 
                            $req = RequestModel::find($req_id);
                            $req->update(array(
                                'status' => 6
                            ));
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

    public function reject(Request $request)
    {
        if ($request->ajax()) {
            try {
                $createdBy = Auth::user()->id;
                $id = $request->id;
                $req = RequestApprovalModel::find($id);
                if ($req) {
                    DB::transaction(function () use ($request, $req) {
                        $req->update(
                            array('status' => 4, 'comment' => $request->comment)
                        );
                        $req_id = $req->request_id;
                        RequestApprovalModel::where('request_id', $req_id)
                            ->where('status', 0)
                            ->delete();
                        $req = RequestModel::find($req_id);
                        $req->update(array(
                            'status' => 4 //rejected
                        ));
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

    public function revise(Request $request)
    {
        if ($request->ajax()) {
            try {
                $createdBy = Auth::user()->id;
                $id = $request->id;
                $req = RequestApprovalModel::find($id);
                if ($req) {
                    DB::transaction(function () use ($request, $req) {
                        $req->update(
                            array('status' => 3, 'comment' => $request->comment)
                        );
                        $req_id = $req->request_id;
                        RequestApprovalModel::where('request_id', $req_id)
                            ->where('status', 0)
                            ->delete();
                        $req = RequestModel::find($req_id);
                        $req->update(array(
                            'status' => 3 //returned
                        ));
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


    public function getHistoryFromReqId(Request $request)
    {
        if ($request->ajax()) {
            $reqId = $request->id;
            $data = RequestApprovalModel::select('request_approval.approve_type', 'request_approval.status', 'request_approval.comment', 'users.name', 'request_approval.updated_at as status_changed')
                ->leftjoin('users', 'request_approval.user', 'users.id')
                ->where('request_approval.request_id', '=', $reqId)
                ->orderBy('request_approval.id', 'asc')
                ->get();

            $out = array(
                'status' => 1,
                'data' => $data
            );
            echo json_encode($out);
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

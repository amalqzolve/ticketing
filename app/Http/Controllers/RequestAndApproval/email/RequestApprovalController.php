<?php

namespace App\Http\Controllers\RequestAndApproval\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\procurement\EmailVerifyKeysModel;
use App\RequestAndApproval\RequestApprovalModel;
use App\RequestAndApproval\RequestModel;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;
use App\Mail\RequestNotification;

class RequestApprovalController extends Controller
{
    public function markDesc(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //
            $this->deleteTocken($request->token);
            $id = $request->t_id;
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
            }
        } else if ($action == 'Revice') { ///  Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
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
            }
        } else if ($action == 'Reject') { //  Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
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
            }
        }
        return back()->with('message', 'We have Marked Your decision Thankyou!');
    }

    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
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

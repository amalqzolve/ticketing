<?php

namespace App\Http\Controllers\Projects\EmailApprove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\MaterialRequestModel;
use App\procurement\MrWorkflowModel;
use App\procurement\EprApprovalTransactionModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;


class EprApprovalController extends Controller
{

    public function markEpr(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = EprApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } else if ($action == 'Revice') { ///  Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = EprApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeEprStatus($ifFind, 3); //change status to re sumbited
            }
        } else if ($action == 'Reject') { //  Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = EprApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 4);
                $ifFind->update($data);
                $this->changeEprStatus($ifFind, 4); //change status to reject

            }
        }
        return back()->with('message', 'We have Marked Your decision Thankyou!');
    }

    public function updateNextApproval($data)
    {
        $eprId = $data->epr_id;
        $ifdata = EprApprovalTransactionModel::where('epr_id', '=', $eprId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            EprApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = MrWorkflowModel::select('mrworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                ->where('mrworkflow.id', '=', $ifdata->mrworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('epr', $ifdata->epr_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = MaterialRequestModel::find($eprId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = EprApprovalTransactionModel::where('epr_id', '=', $data->epr_id)->where('status', '=', 0)->delete();
        return 1;
    }
    public function changeEprStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->epr_id;
        $ifFind = MaterialRequestModel::find($eprId);
        if ($ifFind) {
            if (($ifFind->request_against == 1) && ($status == 4))
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'epr', $docId, $toMailId, $transactionId, $userName, $date)
    {
        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now(),
        ];
        DB::table('email_verify_keys')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'Electronic Purchase Request';
        $data['document'] = 'EPR';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

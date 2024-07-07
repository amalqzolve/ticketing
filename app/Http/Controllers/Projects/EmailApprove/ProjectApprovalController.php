<?php

namespace App\Http\Controllers\Projects\EmailApprove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\projects\ProjectModel;
use App\projects\ProjectApprovalTransactionModel;
use App\projects\ProjectCategorySynthesisModel;

use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class ProjectApprovalController extends Controller
{

    public function markProject(Request $request)
    {
        $action = $request->currentAction;
        $currentUser = Auth::user()->id;
        if ($action == 'Approve') { //
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = ProjectApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2, 'comment' => $request->comment, 'status_changed_by' => $currentUser);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        }
        // else if ($action == 'Revice') { ///  Input::get('revice')
        //     $this->deleteTocken($request->token);
        //     $id = $request->t_id;
        //     $ifFind = ProjectApprovalTransactionModel::find($id);
        //     if ($ifFind) {
        //         $data = array('status' => 3);
        //         $ifFind->update($data);
        //         $this->deleteNextApproval($ifFind);
        //         $this->changeEprStatus($ifFind, 3); //change status to re sumbited
        //     }
        // }
        else if ($action == 'Reject') { //  Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = ProjectApprovalTransactionModel::find($id);
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
        $projectId = $data->project_id;
        $ifdata = ProjectApprovalTransactionModel::where('project_id', '=', $projectId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            ProjectApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = ProjectCategorySynthesisModel::select('project_category_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'project_category_synthesis.user_id', '=', 'users.id')
                ->where('project_category_synthesis.id', '=', $ifdata->project_category_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('PROJECT', $ifdata->project_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $tender = ProjectModel::find($projectId);
            if ($tender) {
                $dataStatus = array('status' => 6);
                $tender->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = ProjectApprovalTransactionModel::where('project_id', '=', $data->project_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $projectId = $eprAthority->project_id;
        $ifFind = ProjectModel::find($projectId);
        if ($ifFind) {
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }
    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
    }

    public function sendMail($docType = 'PROJECT', $docId, $toMailId, $transactionId, $userName, $date)
    {
        DB::table('email_verify_keys')->where('doc_type', 'PROJECT')->where('doc_id', $docId)->delete();
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
        $data['document_name'] = 'Project';
        $data['document'] = 'PROJECT';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $projectId = $request->id;
            $data = ProjectApprovalTransactionModel::select('project_approval_transaction.status', 'project_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(project_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('project_category_synthesis', 'project_approval_transaction.project_category_synthesis_id', '=', 'project_category_synthesis.id')
                ->leftjoin('users', 'project_category_synthesis.user_id', '=', 'users.id')
                ->where('project_approval_transaction.project_id', '=', $projectId)
                ->orderBy('project_approval_transaction.id', 'asc')
                ->get();
            $data = $data->map(function ($value, $key) {
                if ($value->status_changed_by != null)
                    $user = $this->getDescUser($value->status_changed_by);
                $outArray = array(
                    'status' => $value->status,
                    'name' => ($value->status_changed_by != null) ? $user->name : $value->name,
                    'status_changed' => $value->status_changed,
                );
                return $outArray;
            });
            $out = array(
                'status' => 1,
                'data' => $data
            );
            echo json_encode($out);
        } else
            return null;
    }
    public function getDescUser($id)
    {
        return User::find($id);
    }
}

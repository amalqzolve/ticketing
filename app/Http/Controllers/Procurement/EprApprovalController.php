<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\EprApprovalTransactionModel;
use App\procurement\MaterialRequestModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\MrWorkflowModel;
use App\procurement\EmailVerifyKeysModel;
use App\Boq;
use App\User;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
use App\Mail\ActionRequired;
use User as GlobalUser;

class EprApprovalController extends Controller
{
    public function index(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = EprApprovalTransactionModel::select('epr_approval_transaction.id', 'material_request.id as ma_id', 'epr_approval_transaction.status', 'epr_approval_transaction.epr_id', 'material_request.request_type', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'users.name', 'ma_category.name as mr_category', 'ma_category.id as ma_id')
                ->leftjoin('material_request', 'epr_approval_transaction.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                ->where('mrworkflow.user_id', '=', $currentUser)
                ->where('epr_approval_transaction.status', '=', 1) //waiting for approval
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'users.name')
                    ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                    ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                    ->where('epr_approval_transaction.epr_id', '=', $row->epr_id)->orderBy('epr_approval_transaction.id', 'asc')->get();
                $str = '';
                foreach ($data as $key => $value) {
                    $statu = '';
                    if ($value->status == 0)
                        $statu = 'waiting ';
                    else if ($value->status == 1)
                        $statu = 'Approval Pending From ';
                    else if ($value->status == 2)
                        $statu = 'Approved ';
                    else if ($value->status == 3)
                        $statu = 'Returned From ';
                    else if ($value->status == 4)
                        $statu = 'Rejected ';

                    $str .= $statu . $value->name;
                }
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.eprApproval.listing');
    }
    public function listDone(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = EprApprovalTransactionModel::select('epr_approval_transaction.id', 'material_request.id as ma_id', 'epr_approval_transaction.status', 'epr_approval_transaction.epr_id', 'material_request.request_type', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'users.name', 'ma_category.name as mr_category')
                ->leftjoin('material_request', 'epr_approval_transaction.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                ->where('mrworkflow.user_id', '=', $currentUser)
                ->where('epr_approval_transaction.status', '!=', 1) //waiting for approval but active for taking desc
                ->where('epr_approval_transaction.status', '!=', 0) //waiting for approval
                ->groupBy('epr_approval_transaction.epr_id')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('status', function ($row) use ($currentUser) {
                $data = EprApprovalTransactionModel::select('epr_approval_transaction.status')
                    ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                    ->where('epr_approval_transaction.epr_id', '=', $row->epr_id)
                    ->where('mrworkflow.user_id', '=', $currentUser)
                    ->orderBy('epr_approval_transaction.id', 'desc')
                    ->first();
                return isset($data->status) ? $data->status : '';
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function epr_approve(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = EprApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    $data = array('status' => 2, 'status_changed_by' => $currentUser, 'comments' => $request->comment);
                    $ifFind->update($data);
                    EmailVerifyKeysModel::where('doc_type', '=', 'epr')->where('transaction_id', $id)->delete();
                    $this->updateNextApproval($ifFind);
                }
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
                'msg' => 'Mail Error'
            );
            echo json_encode($out);
        }
    }
    public function epr_resubmit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = EprApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type',  '=', 'epr')->where('transaction_id', $id)->delete();
                    $data = array('status' => 3, 'status_changed_by' => $currentUser, 'comments' => $request->comment);
                    $ifFind->update($data);
                    $this->deleteNextApproval($ifFind);
                    $this->changeEprStatus($ifFind, 3); //change status to re sumbited
                }
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
                'msg' => 'Mail Error'
            );
            echo json_encode($out);
        }
    }
    public function epr_reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = EprApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'epr')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser, 'comments' => $request->comment);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to reject

                }
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
                'msg' => 'Mail Error'
            );
            echo json_encode($out);
        }
    }

    public function removeOldRecords($data)
    {
        $products = MaterialRequestProductsModel::where('mr_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $boq = Boq::find($value->product_id);
            if ($boq) {
                $newQty = $boq->epr_requested_quantity - $value->quantity;
                $boq->update(['epr_requested_quantity' => $newQty]);
            }
        }
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

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $eprId = $request->id;
            $data = EprApprovalTransactionModel::select('epr_approval_transaction.status', 'epr_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(epr_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"), 'epr_approval_transaction.comments', 'mrworkflow.if_accepted_note', 'mrworkflow.if_rejected_note')
                ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                ->where('epr_approval_transaction.epr_id', '=', $eprId)
                ->orderBy('epr_approval_transaction.id', 'asc')
                ->get();
            $data = $data->map(function ($value, $key) {
                if ($value->status_changed_by != null)
                    $user = $this->getDescUser($value->status_changed_by);
                $outArray = array(
                    'status' => $value->status,
                    'name' => ($value->status_changed_by != null) ? $user->name : $value->name,
                    'status_changed' => $value->status_changed,
                    'comments' => $value->comments,
                    'if_accepted_note' => $value->if_accepted_note,
                    'if_rejected_note' => $value->if_rejected_note,
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

<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Tender\ApprovalTransactionModel;
use App\Tender\CategorySynthesisModel;
use App\Tender\TenderModel;


use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class TenderApprovalController extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = ApprovalTransactionModel::select(
                'approval_transaction.id',
                'approval_transaction.status',
                'tenders.id as tender_id',
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
                'tenders.status as tender_status'
            )
                ->leftjoin('tenders', 'approval_transaction.tender_id', '=', 'tenders.id')
                ->leftjoin('category_synthesis', 'approval_transaction.category_synthesis_id', '=', 'category_synthesis.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                ->where('category_synthesis.user_id', '=', $currentUser)
                ->where('approval_transaction.status', '=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.approval.list');
    }
    public function listApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = ApprovalTransactionModel::select(
                'approval_transaction.id',
                'approval_transaction.status',
                'tenders.id as tender_id',
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
                'tenders.status as tender_status'
            )
                ->leftjoin('tenders', 'approval_transaction.tender_id', '=', 'tenders.id')
                ->leftjoin('category_synthesis', 'approval_transaction.category_synthesis_id', '=', 'category_synthesis.id')
                ->leftJoin('qcrm_customer_details', 'tenders.client', 'qcrm_customer_details.id')
                ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                // ->where('category_synthesis.user_id', '=', $currentUser)
                ->where('approval_transaction.status_changed_by', $currentUser)
                ->where('approval_transaction.status', '!=', 1)
                ->where('approval_transaction.status', '!=', 0)
                ->groupBy('tenders.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) use ($currentUser) {
                $data = ApprovalTransactionModel::select('status')
                    ->orderBy('id', 'desc')
                    ->where('approval_transaction.status', '!=', 1)
                    ->where('approval_transaction.status', '!=', 0)
                    ->where('approval_transaction.tender_id', $row->tender_id)
                    ->where('approval_transaction.status_changed_by', $currentUser)

                    ->first();
                if ($data->status == 0)
                    $status = 'waiting';
                else if ($data->status == 1)
                    $status = 'Approval Pending';
                else if ($data->status == 2)
                    $status = 'Approved';
                else if ($data->status == 3)
                    $status = 'Resubmited';
                else if ($data->status == 4)
                    $status = 'rejected';

                return $data->status;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function approve(Request $request)
    {
        $id = $request->id;
        $ifFind = ApprovalTransactionModel::find($id);
        if ($ifFind) {
            $currentUser = Auth::user()->id;
            EmailVerifyKeysModel::where('doc_type', '=', 'TNDR')->where('transaction_id', $id)->delete();
            $data = array('status' => 2, 'status_changed_by' => $currentUser);
            $ifFind->update($data);
            $this->updateNextApproval($ifFind);
        }
        return 1;
    }
    // public function resubmit(Request $request)
    // {
    //     $id = $request->id;
    //     $ifFind = ApprovalTransactionModel::find($id);
    //     if ($ifFind) {
    //         $currentUser = Auth::user()->id;
    //         EmailVerifyKeysModel::where('doc_type', '=', 'TNDR')->where('transaction_id', $id)->delete();
    //         $data = array('status' => 3, 'status_changed_by' => $currentUser);
    //         $ifFind->update($data);
    //         $this->deleteNextApproval($ifFind);
    //         $this->changeEprStatus($ifFind, 3); //change status to re sumbited
    //     }
    //     return 1;
    // }
    public function reject(Request $request)
    {
        $id = $request->id;
        $ifFind = ApprovalTransactionModel::find($id);
        if ($ifFind) {
            $currentUser = Auth::user()->id;
            EmailVerifyKeysModel::where('doc_type', '=', 'TNDR')->where('transaction_id', $id)->delete();
            $data = array('status' => 4, 'status_changed_by' => $currentUser);
            $ifFind->update($data);
            $this->changeEprStatus($ifFind, 4); //change status to re sumbited
        }
        return 1;
    }
    public function updateNextApproval($data)
    {
        $tenderId = $data->tender_id;
        $ifdata = ApprovalTransactionModel::where('tender_id', '=', $tenderId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            ApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = CategorySynthesisModel::select('category_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')
                ->where('category_synthesis.id', '=', $ifdata->category_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('TNDR', $ifdata->tender_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $tender = TenderModel::find($tenderId);
            if ($tender) {
                $dataStatus = array('status' => 6);
                $tender->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = ApprovalTransactionModel::where('tender_id', '=', $data->tender_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $tenderId = $eprAthority->tender_id;
        $ifFind = TenderModel::find($tenderId);
        if ($ifFind) {
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }


    public function sendMail($docType = 'TNDR', $docId, $toMailId, $transactionId, $userName, $date)
    {
        DB::table('email_verify_keys')->where('doc_type', 'TNDR')->where('doc_id', $docId)->delete();
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
        $data['document_name'] = 'Tender';
        $data['document'] = 'TNDR';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $tenderId = $request->id;
            $data = ApprovalTransactionModel::select('approval_transaction.status', 'approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('category_synthesis', 'approval_transaction.category_synthesis_id', '=', 'category_synthesis.id')
                ->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')
                ->where('approval_transaction.tender_id', '=', $tenderId)
                ->orderBy('approval_transaction.id', 'asc')
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

<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Tender\SalesProposalApprovalTransactionModel;
use App\Tender\SalesProposalCategorySynthesisModel;
use App\Tender\SalesProposalModel;


use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class SalesProposalApprovalController extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = SalesProposalApprovalTransactionModel::select(
                'sales_proposal_approval_transaction.id',
                'sales_proposal_approval_transaction.status',
                DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"),
                DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"),
                'sales_proposal.boq_id',
                'sales_proposal_category.name as category_name',
                'boqs.tender_id',
                'boqs.type',
                'tenders.project_name',
                'sales_proposal.id as sales_proposal_id',
                'sales_proposal.status as sales_proposal_status',
                'sales_proposal.net_amount',
                'sales_proposal.profit_amount',
                'sales_proposal.discount_amount',
                'sales_proposal.vat_amount',
                'sales_proposal.grandtotalamount',
                'users.name as created_by',
                'qcrm_customer_details.cust_name as client_name',
            )
                ->leftjoin('sales_proposal', 'sales_proposal_approval_transaction.sales_proposal_id', '=', 'sales_proposal.id')
                ->leftjoin('sales_proposal_category_synthesis', 'sales_proposal_approval_transaction.sales_proposal_category_synthesis_id', '=', 'sales_proposal_category_synthesis.id')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')
                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')

                ->where('sales_proposal_category_synthesis.user_id', '=', $currentUser)
                ->where('sales_proposal_approval_transaction.status', '=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.salesProposalApproval.list');
    }
    public function listApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = SalesProposalApprovalTransactionModel::select(
                'sales_proposal_approval_transaction.id',
                'sales_proposal_approval_transaction.status',
                DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"),
                DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"),
                'sales_proposal.boq_id',
                'sales_proposal_category.name as category_name',
                'boqs.tender_id',
                'boqs.type',
                'tenders.project_name',
                'sales_proposal.id as sales_proposal_id',
                'sales_proposal.status as sales_proposal_status',
                'sales_proposal.net_amount',
                'sales_proposal.profit_amount',
                'sales_proposal.discount_amount',
                'sales_proposal.vat_amount',
                'sales_proposal.grandtotalamount',
                'users.name as created_by',
                'qcrm_customer_details.cust_name as client_name',
            )
                ->leftjoin('sales_proposal', 'sales_proposal_approval_transaction.sales_proposal_id', '=', 'sales_proposal.id')
                ->leftjoin('sales_proposal_category_synthesis', 'sales_proposal_approval_transaction.sales_proposal_category_synthesis_id', '=', 'sales_proposal_category_synthesis.id')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')
                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('sales_proposal_approval_transaction.status_changed_by', $currentUser)
                ->where('sales_proposal_approval_transaction.status', '!=', 1)
                ->where('sales_proposal_approval_transaction.status', '!=', 0)
                ->groupBy('tenders.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) use ($currentUser) {
                $data = SalesProposalApprovalTransactionModel::select('status')
                    ->orderBy('id', 'desc')
                    ->where('sales_proposal_approval_transaction.status', '!=', 1)
                    ->where('sales_proposal_approval_transaction.status', '!=', 0)
                    ->where('sales_proposal_approval_transaction.sales_proposal_id', $row->sales_proposal_id)
                    ->where('sales_proposal_approval_transaction.status_changed_by', $currentUser)

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

        try {
            DB::transaction(function () use ($request) {

                $id = $request->id;
                $ifFind = SalesProposalApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'PROPS')->where('transaction_id', $id)->delete();
                    $data = array('status' => 2, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);

                    $this->updateNextApproval($ifFind);
                }
            });
            return 1;
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Approve'
            );
            echo json_encode($out);
        }
    }
    // public function resubmit(Request $request)
    // {
    //     $id = $request->id;
    //     $ifFind = SalesProposalApprovalTransactionModel::find($id);
    //     if ($ifFind) {
    //         $currentUser = Auth::user()->id;
    //         EmailVerifyKeysModel::where('doc_type', '=', 'PROPS')->where('transaction_id', $id)->delete();
    //         $data = array('status' => 3, 'status_changed_by' => $currentUser);
    //         $ifFind->update($data);
    //         $this->deleteNextApproval($ifFind);
    //         $this->changeEprStatus($ifFind, 3); //change status to re sumbited
    //     }
    //     return 1;
    // }
    public function reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = SalesProposalApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'PROPS')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to rejected
                }
            });
            return 1;
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Approve'
            );
            echo json_encode($out);
        }
    }
    public function updateNextApproval($data)
    {
        $dataId = $data->sales_proposal_id;
        $ifdata = SalesProposalApprovalTransactionModel::where('sales_proposal_id', '=', $dataId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            SalesProposalApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = SalesProposalCategorySynthesisModel::select('sales_proposal_category_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')
                ->where('sales_proposal_category_synthesis.id', '=', $ifdata->sales_proposal_category_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('PROP', $ifdata->sales_proposal_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $tender = SalesProposalModel::find($dataId);
            if ($tender) {
                $dataStatus = array('status' => 6);
                $tender->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = SalesProposalApprovalTransactionModel::where('sales_proposal_id', '=', $data->sales_proposal_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $tenderId = $eprAthority->sales_proposal_id;
        $ifFind = SalesProposalModel::find($tenderId);
        if ($ifFind) {
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }


    public function sendMail($docType = 'PROPS', $docId, $toMailId, $transactionId, $userName, $date)
    {
        DB::table('email_verify_keys')->where('doc_type', 'PROPS')->where('doc_id', $docId)->delete();
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
        $data['document_name'] = 'Sales Proposal';
        $data['document'] = 'PROPS';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $dataId = $request->id;
            $data = SalesProposalApprovalTransactionModel::select('sales_proposal_approval_transaction.status', 'sales_proposal_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(sales_proposal_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('sales_proposal_category_synthesis', 'sales_proposal_approval_transaction.sales_proposal_category_synthesis_id', '=', 'sales_proposal_category_synthesis.id')
                ->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')
                ->where('sales_proposal_approval_transaction.sales_proposal_id', '=', $dataId)
                ->orderBy('sales_proposal_approval_transaction.id', 'asc')
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

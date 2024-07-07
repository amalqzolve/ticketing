<?php

namespace App\Http\Controllers\vouchers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\vouchers\VoucherModel;
use App\vouchers\VoucherApprovalTransactionModel;
use App\vouchers\VoucherSynthesisModel;
use App\vouchers\EmailVerifyKeysVoucherModel;

use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequiredVoucher;

class VoucherApprovalController  extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = VoucherApprovalTransactionModel::select('voucher_approval_transaction.id', 'voucher_approval_transaction.voucher_id', 'voucher_approval_transaction.status', 'buy_voucher.purchase_type', 'buy_voucher.bill_id', 'buy_voucher.quotedate', 'buy_voucher.entrydate', 'buy_voucher.po_wo_ref', 'buy_voucher.totalamount', 'buy_voucher.totalvatamount', 'buy_voucher.grandtotalamount', 'buy_voucher.paidamount', 'buy_voucher.balanceamount', 'buy_voucher.status as voucher_status', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser')
                ->leftjoin('buy_voucher', 'voucher_approval_transaction.voucher_id', '=', 'buy_voucher.id')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->leftjoin('voucher_synthesis', 'voucher_approval_transaction.voucher_synthesis_id', '=', 'voucher_synthesis.id')
                ->where('voucher_synthesis.user_id', '=', $currentUser)
                ->where('voucher_approval_transaction.status', '=', 1) //waiting for approval
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('vouchers.voucherApproval.list');
    }

    public function listOld(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = VoucherApprovalTransactionModel::select('voucher_approval_transaction.id', 'voucher_approval_transaction.voucher_id', 'voucher_approval_transaction.status', 'buy_voucher.purchase_type', 'buy_voucher.bill_id', 'buy_voucher.quotedate', 'buy_voucher.entrydate', 'buy_voucher.po_wo_ref', 'buy_voucher.totalamount', 'buy_voucher.totalvatamount', 'buy_voucher.grandtotalamount', 'buy_voucher.paidamount', 'buy_voucher.balanceamount', 'buy_voucher.status as voucher_status', 'qsettings_voucher.voucher_name', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as purchaser')
                ->leftjoin('buy_voucher', 'voucher_approval_transaction.voucher_id', '=', 'buy_voucher.id')
                ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                ->leftjoin('qcrm_supplier', 'buy_voucher.cust_id', '=', 'qcrm_supplier.id')
                ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                ->leftjoin('voucher_synthesis', 'voucher_approval_transaction.voucher_synthesis_id', '=', 'voucher_synthesis.id')
                ->where('voucher_approval_transaction.status_changed_by', '=', $currentUser)
                ->groupBy('voucher_approval_transaction.voucher_id')
                // ->where('voucher_approval_transaction.status', '!=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('last_action', function ($row) use ($currentUser) {
                $lastAction = VoucherApprovalTransactionModel::select('status')->where('status_changed_by', '=', $currentUser)->where('voucher_id', '=', $row->voucher_id)->orderBy('id', 'desc')->first();
                return $lastAction->status;
            })
                ->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }


    public function approve(Request $request)
    {
        $id = $request->id;
        $ifFind = VoucherApprovalTransactionModel::find($id);
        if ($ifFind) {
            $currentUser = Auth::user()->id;
            $data = array('status' => 2, 'status_changed_by' => $currentUser);
            $ifFind->update($data);
            EmailVerifyKeysVoucherModel::where('doc_type', '=', 'Voucher')->where('transaction_id', $id)->delete();
            $this->updateNextApproval($ifFind);
        }
        return 1;
    }
    public function reject(Request $request)
    {
        $id = $request->id;
        $ifFind = VoucherApprovalTransactionModel::find($id);
        if ($ifFind) {
            $currentUser = Auth::user()->id;
            EmailVerifyKeysVoucherModel::where('doc_type', '=', 'Voucher')->where('transaction_id', $id)->delete();
            $data = array('status' => 4, 'status_changed_by' => $currentUser);
            $ifFind->update($data);
            $this->changeEprStatus($ifFind, 4); //change status to reject
            $this->deleteNextApproval($ifFind);
        }
        return 1;
    }

    public function updateNextApproval($data)
    {
        $docId = $data->voucher_id;
        $ifdata = VoucherApprovalTransactionModel::where('voucher_id', '=', $docId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            VoucherApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = VoucherSynthesisModel::select('voucher_synthesis.id', 'users.email', 'users.name')
                ->leftjoin('users', 'voucher_synthesis.user_id', '=', 'users.id')
                ->where('voucher_synthesis.id', '=', $ifdata->voucher_synthesis_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('Voucher', $ifdata->voucher_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = VoucherModel::find($docId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }

    public function deleteNextApproval($data)
    {
        $ifdata = VoucherApprovalTransactionModel::where('voucher_id', '=', $data->voucher_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($athority, $status)
    {
        $docId = $athority->voucher_id;
        $ifFind = VoucherModel::find($docId);
        if ($ifFind) {
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $docId = $request->id;
            $data = VoucherApprovalTransactionModel::select('voucher_approval_transaction.status', 'voucher_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(voucher_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('voucher_synthesis', 'voucher_approval_transaction.voucher_synthesis_id', '=', 'voucher_synthesis.id')
                ->leftjoin('users', 'voucher_synthesis.user_id', '=', 'users.id')
                ->where('voucher_approval_transaction.voucher_id', '=', $docId)
                ->orderBy('voucher_approval_transaction.id', 'asc')
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

    public function sendMail($docType = 'Voucher', $docId, $toMailId, $transactionId, $userName, $date)
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
        DB::table('email_verify_keys_voucher')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'Voucher';
        $data['document'] = 'VC';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequiredVoucher($data));
    }
}

<?php

namespace App\Http\Controllers\vouchers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\vouchers\EmailVerifyKeysVoucherModel;
use App\vouchers\VoucherApprovalTransactionModel;
use App\vouchers\VoucherSynthesisModel;
use App\vouchers\VoucherModel;

use App\procurement\EprPoGrnModel;
use App\procurement\EprPoProductsModel;
use App\procurement\GrnApprovalTransactionModel;
use App\procurement\GrnWorkflowModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequiredVoucher;



class VoucherEmailApprovalController extends Controller
{

    public function markVouchers(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = VoucherApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = VoucherApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 4);
                $ifFind->update($data);
                $this->changeMainStatus($ifFind, 4); //change status to reject
                $this->deleteNextApproval($ifFind);
            }
        }

        return back()->with('message', 'We have Marked Your decision Thankyou!');
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
    public function changeMainStatus($athority, $status)
    {
        $docId = $athority->voucher_id;
        $ifFind = VoucherModel::find($docId);
        if ($ifFind) {
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function deleteTocken($toc)
    {
        EmailVerifyKeysVoucherModel::where('token', $toc)->delete();
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

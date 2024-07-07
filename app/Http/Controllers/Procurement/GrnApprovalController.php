<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\GrnApprovalTransactionModel;
use App\procurement\EprPoGrnModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\EprPoProductsModel;
use App\procurement\GrnWorkflowModel;
use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class GrnApprovalController  extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id;
            $data = GrnApprovalTransactionModel::select('epr_po_grn_approval_transaction.id', 'epr_po_grn_approval_transaction.status', 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), DB::raw("DATE_FORMAT(epr_po_grn.grn_date, '%d-%m-%Y') as grn_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn.status as grn_status')
                ->leftjoin('epr_po_grn', 'epr_po_grn_approval_transaction.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
                ->leftjoin('grnworkflow', 'epr_po_grn_approval_transaction.grnworkflow_id', '=', 'grnworkflow.id')
                ->where('grnworkflow.user_id', '=', $currentUser)
                ->where('epr_po_grn_approval_transaction.status', '=', 1)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dtTble->make(true);
        } else
            return view('procurement.grnApproval.list');
    }


    public function doneList(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id;
            $data = GrnApprovalTransactionModel::select('epr_po_grn_approval_transaction.id', 'epr_po_grn_approval_transaction.status', 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), DB::raw("DATE_FORMAT(epr_po_grn.grn_date, '%d-%m-%Y') as grn_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn.status as grn_status')
                ->leftjoin('epr_po_grn', 'epr_po_grn_approval_transaction.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
                ->leftjoin('grnworkflow', 'epr_po_grn_approval_transaction.grnworkflow_id', '=', 'grnworkflow.id')
                ->where('grnworkflow.user_id', '=', $currentUser)
                ->where('epr_po_grn_approval_transaction.status', '!=', 1)
                ->groupBy('epr_po_grn.id')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $row->id;
                })->addColumn('decision', function ($row) {

                    $data = GrnApprovalTransactionModel::select('epr_po_grn_approval_transaction.status', 'users.name')
                        ->leftjoin('grnworkflow', 'epr_po_grn_approval_transaction.grnworkflow_id', '=', 'grnworkflow.id')
                        ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_grn_approval_transaction.grn_id', '=', $row->grn_id)
                        ->where('grnworkflow.user_id', '=', Auth::user()->id)
                        ->orderBy('epr_po_grn_approval_transaction.id', 'desc')->first();
                    if ($data->status == 2)
                        return 'Re submitted';
                    if ($data->status == 3)
                        return 'Rejected';
                });
            return $dtTble->make(true);
        } else
            return view('procurement.grnApproval.list');
    }

    public function approve(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = GrnApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'grn')->where('transaction_id', $id)->delete();
                    $data = array('status' => 2, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
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
    public function resubmit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $id = $request->id;
                $ifFind = GrnApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'grn')->where('transaction_id', $id)->delete();
                    $data = array('status' => 3, 'status_changed_by' => $currentUser);
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
    public function reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $id = $request->id;
                $ifFind = GrnApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'grn')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to re sumbited
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
    public function updateNextApproval($data)
    {
        $poId = $data->grn_id;
        $ifdata = GrnApprovalTransactionModel::where('grn_id', '=', $poId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            GrnApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = GrnWorkflowModel::select('grnworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                ->where('grnworkflow.id', '=', $ifdata->grnworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('grn', $ifdata->grn_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprPoGrnModel::find($poId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = GrnApprovalTransactionModel::where('grn_id', '=', $data->grn_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->grn_id;
        $ifFind = EprPoGrnModel::find($eprId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }
    public function removeOldRecords($data)
    {
        $products = EprPoGrnProductsModel::where('epr_po_grn_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprPoProduct = EprPoProductsModel::find($value->epr_po_product_id);
            if ($eprPoProduct) {
                $newQty = $eprPoProduct->grn_generated_qty - $value->quantity;
                $eprPoProduct->update(['grn_generated_qty' => $newQty]);
            }
        }
    }

    public function sendMail($docType = 'grn', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Goods Received Note';
        $data['document'] = 'GRN';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $grnId = $request->id;
            $data = GrnApprovalTransactionModel::select('epr_po_grn_approval_transaction.status', 'epr_po_grn_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(epr_po_grn_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('grnworkflow', 'epr_po_grn_approval_transaction.grnworkflow_id', '=', 'grnworkflow.id')
                ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                ->where('epr_po_grn_approval_transaction.grn_id', '=', $grnId)
                ->orderBy('epr_po_grn_approval_transaction.id', 'asc')
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

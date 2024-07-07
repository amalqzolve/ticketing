<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\PoApprovalTransactionModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\procurement\PoWorkflowModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EmailVerifyKeysModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class PoApprovalController extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.id', 'epr_po.id as po_id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status as po_status', 'epr_po_approval_transaction.status')
                ->leftjoin('epr_po', 'epr_po_approval_transaction.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                ->where('poworkflow.user_id', '=', $currentUser)
                ->where('epr_po_approval_transaction.status', '=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'users.name')
                        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_approval_transaction.po_id', '=', $row->po_id)
                        ->whereIn('epr_po_approval_transaction.status', [2, 3, 4])
                        ->orderBy('epr_po_approval_transaction.id', 'asc')
                        ->limit(1)
                        ->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending';
                        else if ($value->status == 2)
                            $statu = 'Approved';
                        else if ($value->status == 3)
                            $statu = 'Resubmited';
                        else if ($value->status == 4)
                            $statu = 'rejected';

                        $str .= $value->name . '(' . $statu . ')</br>';
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.poApproval.list');
    }
    public function listApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.id', 'epr_po.id as po_id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status as po_status', 'epr_po_approval_transaction.status')
                ->leftjoin('epr_po', 'epr_po_approval_transaction.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                ->where('poworkflow.user_id', '=', $currentUser)
                ->where('epr_po_approval_transaction.status', '!=', 1)
                ->groupBy('epr_po.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'users.name')
                        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_approval_transaction.po_id', '=', $row->po_id)
                        ->whereIn('epr_po_approval_transaction.status', [2, 3, 4])
                        ->orderBy('epr_po_approval_transaction.id', 'asc')
                        ->limit(1)
                        ->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending';
                        else if ($value->status == 2)
                            $statu = 'Approved';
                        else if ($value->status == 3)
                            $statu = 'Resubmited';
                        else if ($value->status == 4)
                            $statu = 'rejected';

                        $str .= $value->name . '(' . $statu . ')</br>';
                    }
                } else
                    $str = '--';
                return $str;
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
                $ifFind = PoApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'po')->where('transaction_id', $id)->delete();
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function resubmit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = PoApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'po')->where('transaction_id', $id)->delete();
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = PoApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'po')->where('transaction_id', $id)->delete();
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
                'msg' => 'Error'
            );
            echo json_encode($out);
        }
    }
    public function updateNextApproval($data)
    {
        $poId = $data->po_id;
        $ifdata = PoApprovalTransactionModel::where('po_id', '=', $poId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            PoApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = PoWorkflowModel::select('poworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                ->where('poworkflow.id', '=', $ifdata->poworkflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('po', $ifdata->po_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $po = EprPoModel::find($poId);
            if ($po) {
                $dataStatus = array('status' => 6);
                $po->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = PoApprovalTransactionModel::where('po_id', '=', $data->po_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->po_id;
        $ifFind = EprPoModel::find($eprId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }


    public function removeOldRecords($data)
    {
        $products = EprPoProductsModel::where('epr_po_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprProduct = MaterialRequestProductsModel::find($value->epr_product_id);
            if ($eprProduct) {
                $newQty = $eprProduct->po_assigned_qty - $value->quantity;
                $eprProduct->update(['po_assigned_qty' => $newQty]);
            }
        }
    }

    public function sendMail($docType = 'po', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'PO';
        $data['document'] = 'PO';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $poId = $request->id;
            $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'epr_po_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(epr_po_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                ->where('epr_po_approval_transaction.po_id', '=', $poId)
                ->orderBy('epr_po_approval_transaction.id', 'asc')
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

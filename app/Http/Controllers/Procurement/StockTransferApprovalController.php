<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\StockTransferModel;
use App\procurement\StockTransferProductsModel;

use App\procurement\StockTransferApprovalTransactionModel;

use App\procurement\MaterialRequestProductsModel;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\StockTransferWorkflowModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;


class StockTransferApprovalController extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id

            $data = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.id', 'epr_stock_transfer.id as stock_transfer_id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer.status as stock_transfer_status')
                ->leftjoin('epr_stock_transfer', 'epr_stock_transfer_approval_transaction.stock_transfer_id', '=', 'epr_stock_transfer.id')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                ->where('epr_stock_transfer_workflow.user_id', '=', $currentUser)
                ->where('epr_stock_transfer_approval_transaction.status', '=', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.status', 'users.name')
                        ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                        ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                        ->where('epr_stock_transfer_approval_transaction.stock_transfer_id', '=', $row->stock_transfer_id)
                        ->whereIn('epr_stock_transfer_approval_transaction.status', [2, 3, 4])
                        ->orderBy('epr_stock_transfer_approval_transaction.id', 'asc')
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
            return view('procurement.stockTransferApproval.list');
    }


    public function listApproved(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = StockTransferApprovalTransactionModel::select('epr_stock_transfer.id as stock_transfer_id', 'epr_stock_transfer.epr_id', 'qinventory_warehouse.warehouse_name', DB::raw("DATE_FORMAT(epr_stock_transfer.t_req_date, '%d-%m-%Y') as t_req_date"), 'users.name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer.status as stock_transfer_status')
                ->leftjoin('epr_stock_transfer', 'epr_stock_transfer_approval_transaction.stock_transfer_id', '=', 'epr_stock_transfer.id')
                ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                ->where('epr_stock_transfer_workflow.user_id', '=', $currentUser)
                ->where('epr_stock_transfer_approval_transaction.status', '!=', 1)
                ->groupBy('epr_stock_transfer.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('last_action', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.status', 'users.name')
                        ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                        ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                        ->where('epr_stock_transfer_approval_transaction.stock_transfer_id', '=', $row->stock_transfer_id)
                        ->where('epr_stock_transfer_workflow.user_id', Auth::user()->id)
                        ->whereIn('epr_stock_transfer_approval_transaction.status', [2, 3, 4])
                        ->orderBy('epr_stock_transfer_approval_transaction.id', 'desc')
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
            })->rawColumns(['action', 'last_action']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function approve(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = StockTransferApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'stock-transfer')->where('transaction_id', $id)->delete();
                    $data = array('status' => 2, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->updateNextApproval($ifFind);
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function resubmit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = StockTransferApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'stock-transfer')->where('transaction_id', $id)->delete();
                    $data = array('status' => 3, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->deleteNextApproval($ifFind);
                    $this->changeEprStatus($ifFind, 3); //change status to re sumbited
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function reject(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = StockTransferApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'stock-transfer')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to rejected
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function updateNextApproval($data)
    {
        $stock_transfer_id = $data->stock_transfer_id;
        $ifdata = StockTransferApprovalTransactionModel::where('stock_transfer_id', '=', $stock_transfer_id)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            StockTransferApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = StockTransferWorkflowModel::select('epr_stock_transfer_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->where('epr_stock_transfer_workflow.id', '=', $ifdata->stock_transfer_workflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('stock-transfer', $ifdata->stock_transfer_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = StockTransferModel::find($stock_transfer_id);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = StockTransferApprovalTransactionModel::where('stock_transfer_id', '=', $data->stock_transfer_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->stock_transfer_id;
        $ifFind = StockTransferModel::find($eprId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }


    public function removeOldRecords($data)
    {
        $products = StockTransferProductsModel::where('epr_stock_transfer_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprProduct = MaterialRequestProductsModel::find($value->epr_product_id);
            if ($eprProduct) {
                $newQty = $eprProduct->po_assigned_qty - $value->quantity;
                $eprProduct->update(['po_assigned_qty' => $newQty]);
            }
        }
    }


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $poId = $request->id;
            $data = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(epr_stock_transfer_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->where('epr_stock_transfer_approval_transaction.stock_transfer_id', '=', $poId)
                ->orderBy('epr_stock_transfer_approval_transaction.id', 'asc')
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

    public function sendMail($docType = 'stock-transfer', $docId, $toMailId, $transactionId, $userName, $date)
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
        DB::table('email_verify_keys')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'Stock Transfer';
        $data['document'] = 'ST';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

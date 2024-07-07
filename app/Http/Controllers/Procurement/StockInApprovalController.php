<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\StockInApprovalTransactionModel;
use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\EprPoGrnWareHouseProductsModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\StockInWorkflowModel;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;

class StockInApprovalController  extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {

            $currentUser = Auth::user()->id; //current user Id
            $data = StockInApprovalTransactionModel::select('stock_in_approval_transaction.id', 'epr_po_grn_warehouse.id as stock_in_id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status as stock_in_status', 'epr_po_grn_warehouse.warehouse_receive_status', 'stock_in_approval_transaction.status')
                ->leftjoin('epr_po_grn_warehouse', 'stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', 'epr_po_grn_warehouse.id')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
                // ->groupBy('epr_po_grn_warehouse.id')
                ->where('stock_in_workflow.user_id', '=', $currentUser)
                ->where('stock_in_approval_transaction.status', '=', 1)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $row->id;
                })->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('procurement.stockInApproval.list');
    }
    public function listOldAction(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id; //current user Id
            $data = StockInApprovalTransactionModel::select('stock_in_approval_transaction.id', 'epr_po_grn_warehouse.id as stock_in_id', DB::raw("DATE_FORMAT(epr_po_grn_warehouse.warehouse_transfer_date, '%d-%m-%Y') as warehouse_transfer_date"), 'epr_po_grn.id as grn_id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn_warehouse.status as stock_in_status', 'epr_po_grn_warehouse.warehouse_receive_status', 'stock_in_approval_transaction.status')
                ->leftjoin('epr_po_grn_warehouse', 'stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', 'epr_po_grn_warehouse.id')
                ->leftjoin('epr_po_grn', 'epr_po_grn_warehouse.grn_id', '=', 'epr_po_grn.id')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
                ->groupBy('epr_po_grn_warehouse.id')
                ->where('stock_in_workflow.user_id', '=', $currentUser)
                ->where('stock_in_approval_transaction.status', '!=', 1)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $row->id;
                })->addColumn('last_action', function ($row) {
                    $data = StockInApprovalTransactionModel::select('stock_in_approval_transaction.status', 'users.name')
                        ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
                        ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                        ->where('stock_in_workflow.user_id', '=', Auth::user()->id)
                        ->where('stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', $row->st_id)->orderBy('stock_in_approval_transaction.id', 'desc')->first();
                })
                ->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }

    public function approve(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = StockInApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'stock-in')->where('transaction_id', $id)->delete();
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
                $ifFind = StockInApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'stock-in')->where('transaction_id', $id)->delete();
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
                $ifFind = StockInApprovalTransactionModel::find($id);
                if ($ifFind) {
                    $currentUser = Auth::user()->id;
                    EmailVerifyKeysModel::where('doc_type', '=', 'stock-in')->where('transaction_id', $id)->delete();
                    $data = array('status' => 4, 'status_changed_by' => $currentUser);
                    $ifFind->update($data);
                    $this->changeEprStatus($ifFind, 4); //change status to re sumbited
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
        $poId = $data->epr_po_grn_warehouse_id;
        $ifdata = StockInApprovalTransactionModel::where('epr_po_grn_warehouse_id', '=', $poId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            StockInApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = StockInWorkflowModel::select('stock_in_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                ->where('stock_in_workflow.id', '=', $ifdata->stock_in_workflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('stock-in', $ifdata->epr_po_grn_warehouse_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprPoGrnWarehouseModel::find($poId);
            if ($epr) {
                $dataStatus = array('status' => 6);
                $epr->update($dataStatus);
            }
        }
        return 1;
    }
    public function deleteNextApproval($data)
    {
        $ifdata = StockInApprovalTransactionModel::where('epr_po_grn_warehouse_id', '=', $data->epr_po_grn_warehouse_id)->where('status', '=', 0)->delete();
        return 1;
    }

    public function changeEprStatus($eprAthority, $status)
    {
        $eprId = $eprAthority->epr_po_grn_warehouse_id;
        $ifFind = EprPoGrnWarehouseModel::find($eprId);
        if ($ifFind) {
            if ($status == 4)
                $this->removeOldRecords($ifFind);
            $data = array('status' => $status);
            $ifFind->update($data);
        }
    }

    public function removeOldRecords($data)
    {
        $products = EprPoGrnWareHouseProductsModel::where('epr_po_grn_warehouse_id', $data->id)->get();
        foreach ($products as $key => $value) {
            $eprPoProduct = EprPoGrnProductsModel::find($value->epr_po_grn_product_id);
            if ($eprPoProduct) {
                $newQty = $eprPoProduct->send_to_warehouse_qty - $value->quantity;
                $eprPoProduct->update(['send_to_warehouse_qty' => $newQty]);
            }
        }
    }


    public function history(Request $request)
    {
        if ($request->ajax()) {
            $stockInId = $request->id;
            $data = StockInApprovalTransactionModel::select('stock_in_approval_transaction.status', 'stock_in_approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(stock_in_approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
                ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                ->where('stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', $stockInId)->orderBy('stock_in_approval_transaction.id', 'asc')->get();
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

    public function sendMail($docType = 'stock-in', $docId, $toMailId, $transactionId, $userName, $date)
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
        $data['document_name'] = 'Stock In';
        $data['document'] = 'S-IN';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
}

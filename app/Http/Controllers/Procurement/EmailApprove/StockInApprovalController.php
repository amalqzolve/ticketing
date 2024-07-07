<?php

namespace App\Http\Controllers\Procurement\EmailApprove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\EprPoGrnWareHouseProductsModel;

use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\StockInApprovalTransactionModel;
use App\procurement\StockInWorkflowModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mail;
use DB;
use Carbon\Carbon;
use App\Mail\ActionRequired;



class StockInApprovalController extends Controller
{

    public function markStockIn(Request $request)
    {
        $action = $request->currentAction;
        if ($action == 'Approve') { //Input::get('approve')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = StockInApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 2);
                $ifFind->update($data);
                $this->updateNextApproval($ifFind);
            }
        } elseif ($action == 'Revice') { //Input::get('revice')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = StockInApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 3);
                $ifFind->update($data);
                $this->deleteNextApproval($ifFind);
                $this->changeMainStatus($ifFind, 3); //change status to re sumbited
            }
        } elseif ($action == 'Reject') { //Input::get('reject')
            $this->deleteTocken($request->token);
            $id = $request->t_id;
            $ifFind = StockInApprovalTransactionModel::find($id);
            if ($ifFind) {
                $data = array('status' => 4);
                $ifFind->update($data);
                $this->changeMainStatus($ifFind, 4); //change status to reject

            }
        }
        return back()->with('message', 'We have Marked Your decision Thankyou!');
    }

    public function updateNextApproval($data)
    {
        $grnWarehouseId = $data->epr_po_grn_warehouse_id;
        $ifdata = StockInApprovalTransactionModel::where('epr_po_grn_warehouse_id', '=', $grnWarehouseId)->where('status', '=', 0)->orderBy('id', 'asc')->first();
        if (isset($ifdata->id)) {
            $data = array('status' => 1);
            StockInApprovalTransactionModel::where('id', '=', $ifdata->id)->update($data);
            $workflow = StockInWorkflowModel::select('stock_in_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                ->where('stock_in_workflow.id', '=', $ifdata->stock_in_workflow_id)->first();
            $toMailId = $workflow->email;
            $this->sendMail('stock-in', $ifdata->epr_po_grn_warehouse_id, $toMailId, $ifdata->id, $workflow->name, $ifdata->created_at);
        } else { //no another approval athority is there so move to procurement
            $epr = EprPoGrnWarehouseModel::find($grnWarehouseId);
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
    public function changeMainStatus($eprAthority, $status)
    {
        $grnWarehouseId = $eprAthority->epr_po_grn_warehouse_id;
        $ifFind = EprPoGrnWarehouseModel::find($grnWarehouseId);
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


    public function deleteTocken($toc)
    {
        EmailVerifyKeysModel::where('token', $toc)->delete();
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

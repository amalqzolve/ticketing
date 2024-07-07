<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\procurement\EprPoGrnModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\EprPoGrnRevicedModel;
use App\procurement\EprPoGrnProductsRevicedModel;
use App\procurement\GrnWorkflowModel;
use App\procurement\GrnApprovalTransactionModel;
use App\User;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;
use App\settings\BranchSettingsModel;

class GrnController extends Controller
{
    public function grnList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnModel::select('epr_po_grn.id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), DB::raw("DATE_FORMAT(epr_po_grn.grn_date, '%d-%m-%Y') as grn_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn.status')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
                ->whereIn('epr_po_grn.status', [1, 3])->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('stock_in_status', function ($row) {
                return $this->getStockInStatus($row->id);
            });
            return $dtTble->make(true);
        } else {
            $branch = Session::get('branch');
            $supplier = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
            $po = EprPoModel::select('id')->where('po_status', '=', 3)->get();
            return view('procurement.grn.list', compact('supplier', 'po'));
        }
    }

    public function grnSendList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnModel::select('epr_po_grn.id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), DB::raw("DATE_FORMAT(epr_po_grn.grn_date, '%d-%m-%Y') as grn_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn.status')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
                ->whereIn('epr_po_grn.status', [2, 5])
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('stock_in_status', function ($row) {
                return $this->getStockInStatus($row->id);
            });
            return $dtTble->make(true);
        } else
            return null;
    }

    public function grnApprovedList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnModel::select('epr_po_grn.id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), DB::raw("DATE_FORMAT(epr_po_grn.grn_date, '%d-%m-%Y') as grn_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn.status')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
                ->where('epr_po_grn.status', 6)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('stock_in_status', function ($row) {
                return $this->getStockInStatus($row->id);
            });
            return $dtTble->make(true);
        } else
            return null;
    }
    public function grnRejectedList(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoGrnModel::select('epr_po_grn.id', DB::raw("DATE_FORMAT(epr_po_grn.grn_created_date, '%d-%m-%Y') as grn_created_date"), DB::raw("DATE_FORMAT(epr_po_grn.grn_date, '%d-%m-%Y') as grn_date"), 'epr_po.id as po_id', 'qcrm_supplier.sup_name', 'users.name', 'ma_category.name as mr_category', 'epr_po_grn.status')
                ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
                ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
                ->where('epr_po_grn.status', 4)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('stock_in_status', function ($row) {
                return $this->getStockInStatus($row->id);
            });
            return $dtTble->make(true);
        } else
            return null;
    }


    public function getStockInStatus($id)
    {
        $products =  EprPoGrnProductsModel::select('quantity', 'send_to_warehouse_qty')->where('epr_po_grn_id', $id)->get();
        $status = 0;
        $changed = 0;
        $j = 0;
        foreach ($products as $key => $value) {
            $j++;
            if (intval($value->quantity) == intval($value->send_to_warehouse_qty))
                $status++;
            if ($value->send_to_warehouse_qty != 0)
                $changed++;
        }
        if ($j == $status)
            $out = 2;
        else if ($changed != 0)
            $out = 1;
        else
            $out = 0;
        return  $out;
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnModel::select('epr_po_grn.*', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'material_request.mr_category', 'material_request.request_priority', 'material_request.request_against', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname as project', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'qcrm_supplier.sup_name', 'epr_po.supplier_id', 'qcrm_termsandconditions.description as termsdesc', 'ma_category.name as mr_categorydesc')
            ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po_grn.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->find($id);



        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();

        $MaterialRequestProducts = EprPoGrnProductsModel::where('epr_po_grn_id', '=', $id)->get();
        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $EprPoProducts = EprPoProductsModel::find($value->epr_po_product_id);
            $outArray = array(
                'poQty' => $EprPoProducts->quantity,
                'deleiverdQty' => $EprPoProducts->grn_generated_qty - $value->quantity,
                'receivedQty' => $value->quantity,
                'balanceQty' => $EprPoProducts->quantity - $EprPoProducts->grn_generated_qty,
            );
            return $outArray;
        });

        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();

        return view('procurement.grn.edit', compact('unitlist', 'termslist', 'MaterialRequest', 'MaterialRequestProducts',  'reqProduct'));
    }
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $postID = $request->id;
                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'grn_created_date' => Carbon::parse($request->grn_created_date)->format('Y-m-d  h:i'),
                    'grn_date' => Carbon::parse($request->grn_date)->format('Y-m-d  h:i'),
                    'total_qty' => $request->total_qty,
                );

                $epr_id = EprPoGrnModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                EprPoGrnProductsModel::where('epr_po_grn_id', '=', $mrId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_grn_id' => $mrId,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    $eprRfqProducts = EprPoGrnProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->deleiverdQty[$i];
                    $this->poProductQtyUpdate($request->eprPoProductId[$i], $qty);
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

    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoGrnModel::select(
            'epr_po_grn.id',
            'epr_po_grn.notes',
            'epr_po_grn.grn_date',
            'epr_po_grn.grn_created_date',
            'qcrm_termsandconditions.description',
            'qcrm_supplier.sup_name',
            'users.name as created_name',
            'epr_po_grn.status'
        )
            ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_po_grn.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po_grn.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);

        $products = EprPoGrnProductsModel::select('epr_po_grn_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_po_grn_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_po_grn_id', '=', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = GrnApprovalTransactionModel::select('epr_po_grn_approval_transaction.updated_at', 'epr_po_grn_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_grn_approval_transaction.status')
                ->leftjoin('grnworkflow', 'epr_po_grn_approval_transaction.grnworkflow_id', '=', 'grnworkflow.id')
                ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('epr_po_grn_approval_transaction.grn_id', '=', $mainData->id)
                ->where('epr_po_grn_approval_transaction.status', '!=', 0)
                ->where('epr_po_grn_approval_transaction.status', '!=', 1)
                ->get();

            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                if ($value->status_changed_by != null) {
                    $user = $this->getDescUser($value->status_changed_by);
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $user->name,
                        'sign' => $user->sign,
                        'designation' => $user->designation,
                        'department' => $user->department,
                        'status' => $value->status,
                    );
                } else {
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $value->name,
                        'sign' => $value->sign,
                        'designation' => $value->designation,
                        'department' => $value->department,
                        'status' => $value->status,
                    );
                }
                return $outArray;
            });
        } else
            $approvalLevel = array();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'GRN ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->grn_date));
        $pdf = PDF::loadView('procurement.grn.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }


    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }

    public function send(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {


                $createdBy = Auth::user()->id;
                $id = $request->id;

                $materialReq = EprPoGrnModel::find($id);
                if ($materialReq) {
                    $materialReq->mr_category;
                    $workflow =  GrnWorkflowModel::select('grnworkflow.id', 'users.email', 'users.name')
                        ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                        ->where('grnworkflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
                    $i = 0;
                    foreach ($workflow as $key => $value) {
                        $status = ($key == 0) ? 1 : 0;
                        $data = array(
                            'grnworkflow_id' => $value->id,
                            'grn_id' => $id,
                            'created_by' => $createdBy,
                            'status' => $status
                        );
                        $tData =  GrnApprovalTransactionModel::create($data);
                        if ($status == 1) {
                            $toMailId = $value->email;
                            $this->sendMail('grn', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                        }
                        $i++;
                    }
                    if ($i != 0) {
                        $data = array('status' => 2);
                        $materialReq->update($data);
                        $out = array(
                            'status' => 1,
                            'msg' => 'success',
                        );
                    } else {
                        $out = array(
                            'status' => 0,
                            'msg' => 'GRN Approval Sysnthesis Not Found Contact Admin !!',
                        );
                    }
                    echo json_encode($out);
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'error Please Try After Some time',
                    );
                    echo json_encode($out);
                }
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Saved Success'
            // );
            // echo json_encode($out);
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
        $id = $request->id;
        $branch = Session::get('branch');
        $MaterialRequest = EprPoGrnModel::select('epr_po_grn.*', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'material_request.mr_category', 'material_request.request_priority', 'material_request.request_against', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname as project', 'epr_rfq.supp_quot_id as rfq_no', 'epr_rfq.rfq_date', 'epr_rfq.id as rfq_id', 'epr_rfq.created_at as rfq_created_date', 'qcrm_supplier.sup_name', 'epr_po.supplier_id', 'qcrm_termsandconditions.description as termsdesc', 'ma_category.name as mr_categorydesc')
            ->leftjoin('material_request', 'epr_po_grn.epr_id', '=', 'material_request.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftjoin('epr_po', 'epr_po_grn.po_id', '=', 'epr_po.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po_grn.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->find($id);



        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();

        $MaterialRequestProducts = EprPoGrnProductsModel::where('epr_po_grn_id', '=', $id)->get();
        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $EprPoProducts = EprPoProductsModel::find($value->epr_po_product_id);
            $outArray = array(
                'poQty' => $EprPoProducts->quantity,
                'deleiverdQty' => $EprPoProducts->grn_generated_qty - $value->quantity,
                'receivedQty' => $value->quantity,
                'balanceQty' => $EprPoProducts->quantity - $EprPoProducts->grn_generated_qty,
            );
            return $outArray;
        });

        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();

        return view('procurement.grn.resubmit', compact('unitlist', 'termslist', 'MaterialRequest', 'MaterialRequestProducts',  'reqProduct'));
    }
    public function resubmitUpdate(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                if ($request->id != '') {
                    $postID = $request->id;
                    $this->backupOldRequest($postID);
                } else
                    return 'false';

                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'version' => $request->version + 1,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'grn_created_date' => Carbon::parse($request->grn_created_date)->format('Y-m-d  h:i'),
                    'grn_date' => Carbon::parse($request->grn_date)->format('Y-m-d  h:i'),
                    'total_qty' => $request->total_qty,
                    'status' => 5
                );
                $postID = $request->id;

                $epr_id = EprPoGrnModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                EprPoGrnProductsModel::where('epr_po_grn_id', '=', $mrId)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_grn_id' => $mrId,
                        'epr_po_product_id' => $request->eprPoProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];
                    $eprRfqProducts = EprPoGrnProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->deleiverdQty[$i];
                    $this->poProductQtyUpdate($request->eprPoProductId[$i], $qty);
                }
                $this->sendReq($postID);
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

    public function  backupOldRequest($postID)
    {
        $grn = EprPoGrnModel::find($postID);
        $products = EprPoGrnProductsModel::where('epr_po_grn_id', '=', $postID)->get();
        $data = array(
            'version' => $grn->version,
            'epr_id' => $grn->epr_id,
            'po_id' => $grn->po_id,
            'quotedate' => $grn->quotedate,
            'dateofsupply' => $grn->dateofsupply,
            'request_type' => $grn->request_type,
            'mr_category' => $grn->mr_category,
            'request_priority' => $grn->request_priority,
            'request_against' => $grn->request_against,
            'client' => $grn->client,
            'project' => $grn->project,
            'supplier_id' => $grn->supplier_id,
            'internalreference' => $grn->internalreference,
            'notes' => $grn->notes,
            'terms' => $grn->terms,
            'totalamount' => $grn->totalamount,
            'discount' => $grn->discount,
            'amountafterdiscount' => $grn->amountafterdiscount,
            'totalvatamount' => $grn->totalvatamount,
            'grandtotalamount' => $grn->grandtotalamount,
            'user_id' => $grn->user_id,
            'status' => $grn->status,
            'po_status' => $grn->po_status
        );
        $reviced = EprPoGrnRevicedModel::create($data);
        // 
        foreach ($products as $key => $value) {
            $data = array(
                'epr_po_grn_id' => $reviced->id,
                'epr_po_product_id' => $value->epr_po_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'quantity' => $value->quantity,
            );
            EprPoGrnProductsRevicedModel::create($data);
        }
        return true;
    }

    public function sendReq($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = EprPoGrnModel::find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  GrnWorkflowModel::select('grnworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
                ->where('cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'grnworkflow_id' => $value->id,
                    'grn_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = GrnApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('grn', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            echo 1;
        } else
            echo 0;
    }

    public function poProductQtyUpdate($id, $qty)
    {
        EprPoProductsModel::find($id)->update(['grn_generated_qty' => $qty]);
    }

    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = EprPoGrnProductsModel::where('epr_po_grn_id', $postID)->where('epr_po_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = EprPoProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('grn_generated_qty', $product->quantity);
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
}

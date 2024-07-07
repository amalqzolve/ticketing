<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\PoApprovalTransactionModel;
use App\MaterialCategoryModel;
use App\procurement\MaterialRequestProductsModel;

use App\crm\CustomerModel;

use App\procurement\StockTransferModel;
use App\procurement\StockTransferProductsModel;

use App\procurement\StockTransferRevisedModel;
use App\procurement\StockTransferProductsRevicedModel;

use App\procurement\StockTransferWorkflowModel;
use App\procurement\StockTransferApprovalTransactionModel;
use App\User;

use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;
use Illuminate\Support\Facades\Crypt;


class StockTransferController extends Controller
{



    public function generate(Request $request, $id)
    {
        // $id = $request->id;
        $branch = Session::get('branch');
        $projectId = Crypt::decryptString($id);
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = DB::table('qprojects_projects')
            ->select('projectname', 'id', 'client')
            ->where('id', $projectId)
            ->first();
        // $MaterialRequest = array();
        return view('projects.materialRequest.generate', compact('materialCategory', 'unitlist', 'termslist', 'customers',  'projects'));
    }

    public function save(Request $request)
    {
        if ($request->ajax()) {

            try {
                DB::transaction(function () use ($request) {
                    $useasr_id = Auth::user()->id;
                    $branch = Session::get('branch');
                    $data = [
                        'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                        'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                        'request_type' => $request->request_type,
                        'mr_category' => $request->mr_category,
                        'request_priority' => $request->request_priority,
                        'request_against' => $request->request_against,
                        'client' => $request->client,
                        'project' => $request->project,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id,
                        'sorce' => 'From Direct Project'
                    ];
                    $mr = MaterialRequestModel::updateOrCreate(['id' => $request->epr_id], $data);
                    $mrId = $mr->id;
                    $productid = array();
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'mr_id'       => $mrId,
                            'product_id'  => $request->product_id[$i],
                            'itemname'    => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'        => $request->unit[$i],
                            'quantity'    => $request->quantity[$i],
                            'po_assigned_qty' => $request->quantity[$i],
                            'branch'      => $branch
                        ];
                        $materialRequestProducts = MaterialRequestProductsModel::Create($data);
                        $productid[$i] = $materialRequestProducts->id;
                    }

                    $data = array(
                        'epr_id' => $mrId, //$request->epr_id,
                        'warehouse' => $request->warehouse,
                        't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
                        'delivery_terms' => $request->delivery_terms,
                        'total_qty' => $request->total_qty,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id,
                        'source' => 'From Direct Project'
                    );
                    $postID = '';

                    $trnsfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
                    $trnsferId = $trnsfer->id;
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'epr_stock_transfer_id' => $trnsferId,
                            'epr_product_id' => $productid[$i], //$request->eprProductId[$i],
                            'itemname' => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'         => $request->unit[$i],
                            'quantity'   => $request->quantity[$i],
                            'branch' => $branch
                        ];
                        $eprRfqProducts = StockTransferProductsModel::Create($data);
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Success',
                    'project_id' => Crypt::encryptString($request->project)
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
        // ./ stock transfer
    }


    public function editView(Request $request, $id)
    {
        $branch = Session::get('branch');
        // $id = $request->id;
        $MaterialRequest = StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'epr_stock_transfer.warehouse', 'epr_stock_transfer.t_req_date', 'epr_stock_transfer.delivery_terms', 'epr_stock_transfer.total_qty', 'epr_stock_transfer.internalreference', 'epr_stock_transfer.notes', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.description', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.mr_category', 'material_request.request_type', 'material_request.request_priority', 'material_request.request_against', 'ma_category.name as mr_category_name', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname', 'material_request.project')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.id')
            ->find($id);


        $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'qinventory_products.product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name', 'qinventory_warehouse.warehouse_name', 'qinventory_warehouse.id as warehouse_id')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('material_request_products', 'epr_stock_transfer_products.epr_product_id', 'material_request_products.id')
            ->leftJoin('qinventory_products', 'material_request_products.product_id', 'qinventory_products.product_id')
            ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
            ->where('epr_stock_transfer_id', $id)->get();

        $projectId = $MaterialRequest->project;
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = DB::table('qprojects_projects')
            ->select('projectname', 'id', 'client')
            ->where('id', $projectId)
            ->first();

        return view('projects.materialRequest.edit', compact('termslist', 'MaterialRequest', 'unitlist', 'materialCategory', 'customers', 'products', 'projects'));
    }

    public function Update(Request $request)
    {

        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $useasr_id = Auth::user()->id;
                    $branch = Session::get('branch');
                    $data = [
                        'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                        'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                        'request_type' => $request->request_type,
                        'mr_category' => $request->mr_category,
                        'request_priority' => $request->request_priority,
                        'request_against' => $request->request_against,
                        'client' => $request->client,
                        'project' => $request->project,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id,
                        'sorce' => 'From Direct Project'
                    ];
                    $mr = MaterialRequestModel::updateOrCreate(['id' => $request->epr_id], $data);
                    $mrId = $mr->id;
                    $productid = array();
                    MaterialRequestProductsModel::where('mr_id', $request->epr_id)->delete();
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'mr_id'       => $mrId,
                            'product_id'  => $request->product_id[$i],
                            'itemname'    => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'        => $request->unit[$i],
                            'quantity'    => $request->quantity[$i],
                            'po_assigned_qty' => $request->quantity[$i],
                            'branch'      => $branch
                        ];
                        $materialRequestProducts = MaterialRequestProductsModel::Create($data);
                        $productid[$i] = $materialRequestProducts->id;
                    }

                    $data = array(
                        'epr_id' => $mrId, //$request->epr_id,
                        'warehouse' => $request->warehouse,
                        't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
                        'delivery_terms' => $request->delivery_terms,
                        'total_qty' => $request->total_qty,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id,
                        'source' => 'From Direct Project'
                    );
                    $postID = $request->id;
                    $trnsfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
                    $trnsferId = $trnsfer->id;
                    StockTransferProductsModel::where('epr_stock_transfer_id', $postID)->delete();
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'epr_stock_transfer_id' => $trnsferId,
                            'epr_product_id' => $productid[$i], //$request->eprProductId[$i],
                            'itemname' => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'         => $request->unit[$i],
                            'quantity'   => $request->quantity[$i],
                            'branch' => $branch
                        ];
                        $eprRfqProducts = StockTransferProductsModel::Create($data);
                    }
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Success',
                    'project_id' => Crypt::encryptString($request->project)
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }


    public function resubmit(Request $request, $id)
    {
        $branch = Session::get('branch');
        // $id = $request->id;
        $MaterialRequest = StockTransferModel::select('epr_stock_transfer.id', 'epr_stock_transfer.epr_id', 'epr_stock_transfer.warehouse', 'epr_stock_transfer.t_req_date', 'epr_stock_transfer.delivery_terms', 'epr_stock_transfer.total_qty', 'epr_stock_transfer.internalreference', 'epr_stock_transfer.notes', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.description', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.mr_category', 'material_request.request_type', 'material_request.request_priority', 'material_request.request_against', 'ma_category.name as mr_category_name', 'qcrm_customer_details.cust_name as client_name', 'qprojects_projects.projectname', 'material_request.project')
            ->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')
            ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
            ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
            ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
            ->leftJoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', 'qcrm_termsandconditions.id')
            ->find($id);


        $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'qinventory_products.product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name', 'qinventory_warehouse.warehouse_name', 'qinventory_warehouse.id as warehouse_id')
            ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('material_request_products', 'epr_stock_transfer_products.epr_product_id', 'material_request_products.id')
            ->leftJoin('qinventory_products', 'material_request_products.product_id', 'qinventory_products.product_id')
            ->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')
            ->where('epr_stock_transfer_id', $id)->get();

        $projectId = $MaterialRequest->project;
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $projects = DB::table('qprojects_projects')
            ->select('projectname', 'id', 'client')
            ->where('id', $projectId)
            ->first();

        return view('projects.materialRequest.resubmit', compact('termslist', 'MaterialRequest', 'unitlist', 'materialCategory', 'customers', 'products', 'projects'));
    }

    public function resubmitUpdate(Request $request)
    {
        // $useasr_id = Auth::user()->id;
        // $branch = Session::get('branch');
        // if ($request->id != '') {
        //     $postID = $request->id;
        //     $this->backupOldRequest($postID);
        // } else
        //     return 'false';

        // if ($request->deleted_elements != '')
        //     $this->trashedItemUpdate($postID, $request->deleted_elements);

        // $data = array(
        //     'version' => $request->version + 1,
        //     'warehouse' => $request->warehouse,
        //     't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
        //     'delivery_terms' => $request->delivery_terms,
        //     'total_qty' => $request->total_qty,
        //     'internalreference' => $request->internalreference,
        //     'notes' => $request->notes,
        //     'terms' => $request->terms,
        //     'status' => 5,
        // );

        // $trnsfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
        // $trnsferId = $trnsfer->id;
        // StockTransferProductsModel::where('epr_stock_transfer_id', '=', $trnsferId)->delete();
        // for ($i = 0; $i < count($request->productname); $i++) {
        //     $data = [
        //         'epr_stock_transfer_id' => $trnsferId,
        //         'epr_product_id' => $request->eprProductId[$i],
        //         'itemname' => $request->productname[$i],
        //         'description' => $request->product_description[$i],
        //         'unit'         => $request->unit[$i],
        //         'quantity'   => $request->quantity[$i],
        //         'branch' => $branch
        //     ];
        //     $eprRfqProducts = StockTransferProductsModel::Create($data);
        //     $qty = $request->quantity[$i] + $request->po_assigned_qty[$i];
        //     $this->updateEprQty($request->eprProductId[$i], $qty);
        // }
        // $this->sendReq($postID);
        // $out = array('status' => 1, 'data' => $trnsferId);
        // echo json_encode($out);

        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $useasr_id = Auth::user()->id;
                    $branch = Session::get('branch');
                    $data = [
                        'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                        'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                        'request_type' => $request->request_type,
                        'mr_category' => $request->mr_category,
                        'request_priority' => $request->request_priority,
                        'request_against' => $request->request_against,
                        'client' => $request->client,
                        'project' => $request->project,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id,
                        'sorce' => 'From Direct Project'
                    ];
                    $mr = MaterialRequestModel::updateOrCreate(['id' => $request->epr_id], $data);
                    $mrId = $mr->id;
                    $productid = array();
                    MaterialRequestProductsModel::where('mr_id', $request->epr_id)->delete();
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'mr_id'       => $mrId,
                            'product_id'  => $request->product_id[$i],
                            'itemname'    => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'        => $request->unit[$i],
                            'quantity'    => $request->quantity[$i],
                            'po_assigned_qty' => $request->quantity[$i],
                            'branch'      => $branch
                        ];
                        $materialRequestProducts = MaterialRequestProductsModel::Create($data);
                        $productid[$i] = $materialRequestProducts->id;
                    }

                    $data = array(
                        'epr_id' => $mrId, //$request->epr_id,
                        'warehouse' => $request->warehouse,
                        't_req_date' => Carbon::parse($request->t_req_date)->format('Y-m-d  h:i'),
                        'delivery_terms' => $request->delivery_terms,
                        'total_qty' => $request->total_qty,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id,
                        'source' => 'From Direct Project',
                        'status' => 5,
                    );
                    $postID = $request->id;
                    $trnsfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
                    $trnsferId = $trnsfer->id;
                    StockTransferProductsModel::where('epr_stock_transfer_id', $postID)->delete();
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'epr_stock_transfer_id' => $trnsferId,
                            'epr_product_id' => $productid[$i], //$request->eprProductId[$i],
                            'itemname' => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'         => $request->unit[$i],
                            'quantity'   => $request->quantity[$i],
                            'branch' => $branch
                        ];
                        $eprRfqProducts = StockTransferProductsModel::Create($data);
                    }
                    $this->sendReq($postID);
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Saved Success',
                    'project_id' => Crypt::encryptString($request->project)
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return null;
    }

    public function backupOldRequest($eprId)
    {
        $materialReq = StockTransferModel::find($eprId);
        $data = array(
            'version' => $materialReq->version,
            'warehouse' => $materialReq->warehouse,
            't_req_date' => $materialReq->t_req_date,
            'delivery_terms' => $materialReq->delivery_terms,
            'total_qty' => $materialReq->total_qty,
            'internalreference' => $materialReq->internalreference,
            'notes' => $materialReq->notes,
            'terms' => $materialReq->terms,
        );
        $postID = '';
        $inserted = StockTransferRevisedModel::updateOrCreate(['id' => $postID], $data);
        $newMrId = $inserted->id;
        $products = StockTransferProductsModel::where('epr_stock_transfer_id', $eprId)->get();
        foreach ($products as $key => $value) {
            $prData = array(
                'epr_stock_transfer_id' => $newMrId,
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit'   => $value->unit,
                'quantity' => $value->quantity,
                'branch' => $value->branch
            );
            StockTransferProductsRevicedModel::insert($prData);
        }
        $this->sendReq($postID);
        return 'true';
    }




    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }

    public function send(Request $request)
    {
        $createdBy = Auth::user()->id;
        $id = $request->id;

        $materialReq = StockTransferModel::select('material_request.mr_category')->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')->find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  StockTransferWorkflowModel::select('epr_stock_transfer_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->where('epr_stock_transfer_workflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            $i = 0;
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'stock_transfer_workflow_id' => $value->id,
                    'stock_transfer_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = StockTransferApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('stock-transfer', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
                $i++;
            }
            if ($i != 0) {
                $data = array('status' => 2);
                StockTransferModel::find($id)->update($data);
                $out = array(
                    'status' => 1,
                    'msg' => 'success',
                );
            } else {
                $out = array(
                    'status' => 0,
                    'msg' => 'Stock Transfer Sysnthesis Not Found Contact Admin !!',
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
    }

    public function sendReq($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = StockTransferModel::select('material_request.mr_category')->leftjoin('material_request', 'epr_stock_transfer.epr_id', '=', 'material_request.id')->find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  StockTransferWorkflowModel::select('epr_stock_transfer_workflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                ->where('epr_stock_transfer_workflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'stock_transfer_workflow_id' => $value->id,
                    'stock_transfer_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = StockTransferApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('stock-transfer', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            return 1;
        }
    }


    public function updateEprQty($id, $qty)
    {
        MaterialRequestProductsModel::find($id)->update(['po_assigned_qty' => $qty]);
    }

    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = StockTransferProductsModel::where('epr_stock_transfer_id', $postID)->where('epr_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = MaterialRequestProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('po_assigned_qty', $product->quantity);
            }
        }
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

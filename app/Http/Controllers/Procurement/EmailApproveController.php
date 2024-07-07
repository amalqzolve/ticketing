<?php

namespace App\Http\Controllers\Procurement;

use DB;
use App\Http\Controllers\Controller;
use App\procurement\EmailVerifyKeysModel;
use App\procurement\MaterialRequestModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EprApprovalTransactionModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\procurement\PoApprovalTransactionModel;
use App\procurement\EprPoGrnModel;
use App\procurement\EprPoGrnProductsModel;
use App\procurement\GrnApprovalTransactionModel;
use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\EprPoGrnWareHouseProductsModel;
use App\procurement\StockInApprovalTransactionModel;
use App\procurement\EprPoInvoiceModel;
use App\procurement\EprPoInvoiceProductsModel;
use App\procurement\InvoiceApprovalTransactionModel;
use App\procurement\EprSupplierPaymentModel;
use App\procurement\EprSupplierPaymentProductsModel;
use App\procurement\SupplierPaymentApprovalTransactionModel;
use App\procurement\StockTransferModel;
use App\procurement\StockTransferProductsModel;
use App\procurement\StockTransferApprovalTransactionModel;

// 
use App\Tender\TenderModel;
use App\Tender\ApprovalTransactionModel;
// 
use App\Tender\SalesProposalModel;
use App\Tender\SalesProposalItemsModel;
use App\Tender\SalesProposalApprovalTransactionModel;

use App\projects\ProjectModel;
use App\projects\ProjectApprovalTransactionModel;

use App\RequestAndApproval\RequestApprovalModel;
use App\RequestAndApproval\RequestModel;
use App\RequestAndApproval\RequestItemsModel;

use App\User;


class EmailApproveController extends Controller
{

    public function loadDocument($key)
    {

        $ifDocument = EmailVerifyKeysModel::select('*')->where('token', $key)->first();
        if (!isset($ifDocument->id))
            return view('procurement.email.alreadyActionTaken');
        else {
            switch ($ifDocument->doc_type) {
                case 'epr':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    $MaterialRequest = MaterialRequestModel::select('material_request.id', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'ma_category.name as mr_category_name', 'qcrm_termsandconditions.description', 'material_request.notes', 'users.name as created_name', 'material_request.status')
                        ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                        ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                        ->leftjoin('qcrm_termsandconditions', 'material_request.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);
                    $MaterialRequestProducts = MaterialRequestProductsModel::select('material_request_products.itemname', 'material_request_products.description', 'material_request_products.quantity', 'qinventory_product_unit.unit_name')
                        ->leftjoin('qinventory_product_unit', 'material_request_products.unit', '=', 'qinventory_product_unit.id')->where('mr_id', '=', $id)->get();

                    if (($MaterialRequest->status != 1) || $MaterialRequest->status != 0) {
                        $approvalLevel = EprApprovalTransactionModel::select('epr_approval_transaction.updated_at', 'epr_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_approval_transaction.status')
                            ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
                            ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('epr_approval_transaction.epr_id', '=', $MaterialRequest->id)
                            ->where('epr_approval_transaction.status', '!=', 0)
                            ->where('epr_approval_transaction.status', '!=', 1)
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

                    return view('procurement.email.epr', compact('MaterialRequest', 'MaterialRequestProducts', 'token', 'transactionId', 'approvalLevel'));
                    break;

                case 'po':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    $mainData = EprPoModel::select(
                        'epr_po.id',
                        'epr_po.po_date',
                        'epr_po.po_valid_till',
                        'epr_po.delivery_terms',
                        'epr_po.notes',
                        'epr_po.totalamount',
                        'epr_po.totalvatamount',
                        'epr_po.grandtotalamount',
                        'qcrm_termsandconditions.description',
                        'qcrm_supplier.sup_name',
                        'users.name as created_name',
                        'epr_po.status'
                    )
                        ->leftjoin('users', 'epr_po.user_id', '=', 'users.id')
                        ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                        ->leftjoin('qcrm_termsandconditions', 'epr_po.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);

                    $products = EprPoProductsModel::select('epr_po_products.*', 'qinventory_product_unit.unit_name')
                        ->leftjoin('qinventory_product_unit', 'epr_po_products.unit', '=', 'qinventory_product_unit.id')
                        ->where('epr_po_id', '=', $id)->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = PoApprovalTransactionModel::select('epr_po_approval_transaction.updated_at', 'epr_po_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_approval_transaction.status')
                            ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                            ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('epr_po_approval_transaction.po_id', '=', $mainData->id)
                            ->where('epr_po_approval_transaction.status', '!=', 0)
                            ->where('epr_po_approval_transaction.status', '!=', 1)
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

                    return view('procurement.email.po', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'grn':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
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

                    return view('procurement.email.grn', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'stock-in':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    $mainData = EprPoGrnWarehouseModel::select(
                        'epr_po_grn_warehouse.id',
                        'epr_po_grn_warehouse.warehouse_transfer_date',
                        'qinventory_warehouse.warehouse_name',
                        'epr_po_grn_warehouse.notes',
                        'qcrm_termsandconditions.description',
                        'qcrm_supplier.sup_name',
                        'users.name as created_name',
                        'epr_po_grn_warehouse.status'
                    )
                        ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
                        ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')

                        ->leftjoin('epr_po', 'epr_po_grn_warehouse.po_id', '=', 'epr_po.id')
                        ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                        ->leftjoin('qcrm_termsandconditions', 'epr_po_grn_warehouse.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);

                    $products = EprPoGrnWareHouseProductsModel::select('epr_po_grn_warehouse_products.*', 'qinventory_product_unit.unit_name')
                        ->leftjoin('qinventory_product_unit', 'epr_po_grn_warehouse_products.unit', '=', 'qinventory_product_unit.id')
                        ->where('epr_po_grn_warehouse_id', '=', $id)->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = StockInApprovalTransactionModel::select('stock_in_approval_transaction.updated_at', 'stock_in_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'stock_in_approval_transaction.status')
                            ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
                            ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', $mainData->id)
                            ->where('stock_in_approval_transaction.status', '!=', 0)
                            ->where('stock_in_approval_transaction.status', '!=', 1)
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

                    return view('procurement.email.stockIn', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'invoice':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    $mainData = EprPoInvoiceModel::select(
                        'epr_po_invoice.id',
                        'epr_po_invoice.supplier_invoice_number',
                        'epr_po_invoice.supplier_invoice_date',
                        'epr_po_invoice.supplier_invoice_over_due_date',
                        'epr_po_invoice.supplier_invoice_credit_period',
                        'epr_po_invoice.bill_entry_date',
                        'epr_po_invoice.notes',
                        'epr_po_invoice.grandtotalamount',
                        'qcrm_termsandconditions.description',
                        'qcrm_supplier.sup_name',
                        'users.name as created_name',
                        'epr_po_invoice.status'
                    )
                        ->leftjoin('users', 'epr_po_invoice.user_id', '=', 'users.id')
                        ->leftjoin('qcrm_supplier', 'epr_po_invoice.supplier_id', '=', 'qcrm_supplier.id')
                        ->leftjoin('qcrm_termsandconditions', 'epr_po_invoice.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);

                    $products = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $id)->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.updated_at', 'epr_po_invoice_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_invoice_approval_transaction.status')
                            ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
                            ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('epr_po_invoice_approval_transaction.invoice_id', '=', $mainData->id)
                            ->where('epr_po_invoice_approval_transaction.status', '!=', 0)
                            ->where('epr_po_invoice_approval_transaction.status', '!=', 1)
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

                    return view('procurement.email.invoice', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'payment':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    $mainData = EprSupplierPaymentModel::select(
                        'epr_supplier_payment.id',
                        'epr_supplier_payment.payement_book_date',
                        'epr_supplier_payment.internalreference',
                        'epr_supplier_payment.notes',
                        'epr_supplier_payment.grandtotalamount',
                        'qcrm_termsandconditions.description',
                        'qcrm_supplier.sup_name',
                        'users.name as created_name',
                        'epr_supplier_payment.status'
                    )
                        ->leftjoin('users', 'epr_supplier_payment.user_id', '=', 'users.id')
                        ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                        ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                        ->leftjoin('qcrm_termsandconditions', 'epr_supplier_payment.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);
                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = SupplierPaymentApprovalTransactionModel::select('epr_po_supplier_payment_approval_transaction.updated_at', 'epr_po_supplier_payment_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_supplier_payment_approval_transaction.status')
                            ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
                            ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', $mainData->id)
                            ->where('epr_po_supplier_payment_approval_transaction.status', '!=', 0)
                            ->where('epr_po_supplier_payment_approval_transaction.status', '!=', 1)
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

                    $products = EprSupplierPaymentProductsModel::select('epr_supplier_payment_products.*', 'epr_po_products.itemname', 'epr_po_products.description')
                        ->leftjoin('epr_po_products', 'epr_supplier_payment_products.epr_po_product_id', '=', 'epr_po_products.id')
                        ->where('epr_supplier_payment_products.epr_supplier_payment_id', '=', $id)
                        ->get();
                    return view('procurement.email.payment', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'stock-transfer':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    $mainData = StockTransferModel::select(
                        'epr_stock_transfer.id',
                        'epr_stock_transfer.t_req_date',
                        'epr_stock_transfer.delivery_terms',
                        'epr_stock_transfer.total_qty',
                        'epr_stock_transfer.notes',
                        'epr_stock_transfer.terms',
                        'qcrm_termsandconditions.description',
                        'qinventory_warehouse.warehouse_name',
                        'users.name as created_name',
                        'epr_stock_transfer.status'
                    )
                        ->leftjoin('users', 'epr_stock_transfer.user_id', '=', 'users.id')
                        ->leftjoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', '=', 'qcrm_termsandconditions.id')
                        ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                        ->find($id);
                    $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name')
                        ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
                        ->where('epr_stock_transfer_id', $id)->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.updated_at')
                            ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                            ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('epr_stock_transfer_approval_transaction.stock_transfer_id', '=', $id)
                            ->whereIn('epr_stock_transfer_approval_transaction.status', [2, 3, 4])
                            ->orderBy('epr_stock_transfer_approval_transaction.id', 'asc')
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

                    return view('procurement.email.stockTransfer', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'TNDR':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;
                    // $mainData = StockTransferModel::select(
                    //     'epr_stock_transfer.id',
                    //     'epr_stock_transfer.t_req_date',
                    //     'epr_stock_transfer.delivery_terms',
                    //     'epr_stock_transfer.total_qty',
                    //     'epr_stock_transfer.notes',
                    //     'epr_stock_transfer.terms',
                    //     'qcrm_termsandconditions.description',
                    //     'qinventory_warehouse.warehouse_name',
                    //     'users.name as created_name',
                    //     'epr_stock_transfer.status'
                    // )
                    //     ->leftjoin('users', 'epr_stock_transfer.user_id', '=', 'users.id')
                    //     ->leftjoin('qcrm_termsandconditions', 'epr_stock_transfer.terms', '=', 'qcrm_termsandconditions.id')
                    //     ->leftjoin('qinventory_warehouse', 'epr_stock_transfer.warehouse', '=', 'qinventory_warehouse.id')
                    //     ->find($id);

                    $mainData = TenderModel::select('tenders.*', 'users.name as created_name', 'category.name as category', 'qcrm_customer_details.cust_name as client')
                        ->leftjoin('qcrm_customer_details', 'tenders.client', '=', 'qcrm_customer_details.id')
                        ->leftjoin('category', 'tenders.category_id', '=', 'category.id')
                        ->leftjoin('users', 'tenders.user_id', '=', 'users.id')
                        ->find($id);
                    // echo json_encode($mainData);
                    // die();

                    // $products = StockTransferProductsModel::select('epr_stock_transfer_products.epr_product_id', 'epr_stock_transfer_products.itemname', 'epr_stock_transfer_products.description', 'epr_stock_transfer_products.unit', 'epr_stock_transfer_products.quantity', 'qinventory_product_unit.unit_name')
                    //     ->leftJoin('qinventory_product_unit', 'epr_stock_transfer_products.unit', 'qinventory_product_unit.id')
                    //     ->where('epr_stock_transfer_id', $id)->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        // $approvalLevel = StockTransferApprovalTransactionModel::select('epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_stock_transfer_approval_transaction.status', 'epr_stock_transfer_approval_transaction.updated_at')
                        //     ->leftjoin('epr_stock_transfer_workflow', 'epr_stock_transfer_approval_transaction.stock_transfer_workflow_id', '=', 'epr_stock_transfer_workflow.id')
                        //     ->leftjoin('users', 'epr_stock_transfer_workflow.user_id', '=', 'users.id')
                        //     ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                        //     ->where('epr_stock_transfer_approval_transaction.stock_transfer_id', '=', $id)
                        //     ->whereIn('epr_stock_transfer_approval_transaction.status', [2, 3, 4])
                        //     ->orderBy('epr_stock_transfer_approval_transaction.id', 'asc')
                        //     ->get();

                        $approvalLevel = ApprovalTransactionModel::select('approval_transaction.status', 'approval_transaction.status_changed_by', 'users.name', DB::raw("DATE_FORMAT(approval_transaction.updated_at, '%d-%m-%Y %H:%i:%s') as status_changed"))
                            ->leftjoin('category_synthesis', 'approval_transaction.category_synthesis_id', '=', 'category_synthesis.id')
                            ->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')
                            ->whereIn('approval_transaction.status', [2, 3, 4])
                            ->where('approval_transaction.tender_id', '=', $id)
                            ->orderBy('approval_transaction.id', 'asc')
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

                    $products = array();

                    return view('tenders.email.tender', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));

                    break;

                case 'PROP':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;

                    $mainData = SalesProposalModel::select(
                        'sales_proposal.id',
                        'sales_proposal.quotedate',
                        'sales_proposal.valid_till',
                        'sales_proposal.attention',
                        'sales_proposal.reference',
                        'sales_proposal.internalreference',
                        'sales_proposal.notes',
                        'sales_proposal.linetotalamount',
                        'sales_proposal.estimated_amount',
                        'sales_proposal.net_amount',
                        'sales_proposal.profit_percenatge',
                        'sales_proposal.profit_amount',
                        'sales_proposal.total_amount_including_profit',
                        'sales_proposal.discount_percenatge',
                        'sales_proposal.discount_amount',
                        'sales_proposal.amount_after_discount',
                        'sales_proposal.vat_percenatge',
                        'sales_proposal.vat_amount',
                        'sales_proposal.grandtotalamount',
                        'sales_proposal.status',
                        'qcrm_termsandconditions.description',
                        'users.name as created_name',
                        'qcrm_salesman_details.name as salesman',
                        'sales_proposal_category.name as category',
                    )
                        ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                        ->leftjoin('qcrm_salesman_details', 'sales_proposal.salesman', '=', 'qcrm_salesman_details.id')
                        ->leftjoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', '=', 'sales_proposal_category.id')
                        ->leftjoin('qcrm_termsandconditions', 'sales_proposal.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);


                    $products = SalesProposalItemsModel::select('sales_proposal_items.*')
                        ->where('sales_proposal_id', '=', $id)->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = SalesProposalApprovalTransactionModel::select('sales_proposal_approval_transaction.updated_at', 'sales_proposal_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'sales_proposal_approval_transaction.status')
                            ->leftjoin('sales_proposal_category_synthesis', 'sales_proposal_approval_transaction.sales_proposal_category_synthesis_id', '=', 'sales_proposal_category_synthesis.id')
                            ->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('sales_proposal_approval_transaction.sales_proposal_id', '=', $mainData->id)
                            ->where('sales_proposal_approval_transaction.status', '!=', 0)
                            ->where('sales_proposal_approval_transaction.status', '!=', 1)
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

                    $products = array();

                    return view('tenders.email.sales_proposal', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;

                case 'PROJECT':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;

                    $mainData = ProjectModel::select('qprojects_projects.id', 'qprojects_projects.status', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"), 'qprojects_projects.notes', 'qcrm_customer_details.cust_name as client', 'poject_category.name as poject_category', 'users.name as created_name', DB::raw("DATE_FORMAT(qprojects_projects.created_at, '%d-%m-%Y') as created_on"))
                        ->leftjoin('qcrm_customer_details', 'qprojects_projects.client',  'qcrm_customer_details.id')
                        ->leftjoin('poject_category', 'qprojects_projects.poject_category_id',  'poject_category.id')
                        ->leftjoin('users', 'qprojects_projects.user_id', '=', 'users.id')
                        ->where('qprojects_projects.id', $id)
                        ->first();

                    $products = array();

                    if (($mainData->status != 1) || $mainData->status != 0) {

                        $approvalLevel = ProjectApprovalTransactionModel::select('project_approval_transaction.id', 'project_approval_transaction.updated_at', 'project_approval_transaction.status_changed_by', 'project_approval_transaction.comment', 'project_category_synthesis.if_accepted_note', 'project_category_synthesis.if_rejected_note', 'project_approval_transaction.status')
                            ->leftjoin('qprojects_projects', 'project_approval_transaction.project_id', '=', 'qprojects_projects.id')
                            ->leftjoin('project_category_synthesis', 'project_approval_transaction.project_category_synthesis_id', '=', 'project_category_synthesis.id')
                            ->leftjoin('users', 'qprojects_projects.user_id', '=', 'users.id')
                            ->where('project_approval_transaction.project_id', '=', $id)
                            ->where('project_approval_transaction.status', '!=', 0)
                            ->where('project_approval_transaction.status', '!=', 1)
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
                                    'if_accepted_note' => $value->if_accepted_note,
                                    'if_rejected_note' => $value->if_rejected_note,
                                    'comments' => $value->comment,
                                );
                            } else {
                                $outArray = array(
                                    'updated_at' => $value->updated_at,
                                    'name' => $value->name,
                                    'sign' => $value->sign,
                                    'designation' => $value->designation,
                                    'department' => $value->department,
                                    'status' => $value->status,
                                    'if_accepted_note' => $value->if_accepted_note,
                                    'if_rejected_note' => $value->if_rejected_note,
                                    'comments' => $value->comments,
                                );
                            }
                            return $outArray;
                        });
                    } else
                        $approvalLevel = array();

                    $products = array();
                    return view('projects.email.projectApprove', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;
                case 'REQ':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;

                    $mainData = RequestModel::select('requests.*', 'users.name')
                        ->where('requests.id', $id)
                        ->leftjoin('users', 'requests.creted_by', 'users.id')
                        ->first();
                    $products = RequestItemsModel::where('request_id', $id)->orderBy('id', 'asc')->get();

                    $approvalLevel = RequestApprovalModel::select('request_approval.approve_type', 'request_approval.status', 'request_approval.comment', 'users.name', 'users.sign', 'qcrm_department.name as department', 'request_approval.updated_at')
                        ->where('request_approval.request_id', $id)
                        ->where('request_approval.status', '!=', 0)
                        ->where('request_approval.status', '!=', 1)
                        ->orderBy('request_approval.id', 'asc')
                        ->leftjoin('users', 'request_approval.user', '=', 'users.id')
                        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                        ->get();

                    $approvalLevel = $approvalLevel->map(function ($value, $key) {
                        $outArray = array(
                            'updated_at' => $value->updated_at,
                            'name' =>  $value->name,
                            'sign' =>  $value->sign,
                            'designation' => $value->designation,
                            'department' => $value->department,
                            'status' => $value->status,
                            'if_accepted_note' => ($value->approve_type == 1) ? 'Approved' : 'Notifiyed',
                            'if_rejected_note' => 'Rejected',
                            'comments' => $value->comment,
                        );

                        return $outArray;
                    });

                    return view('request_and_approval.email.request', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
                    break;

                default:
                    # code...
                    break;
            }
        }
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }
}

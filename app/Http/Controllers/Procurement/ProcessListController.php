<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\procurement\MaterialRequestModel;
use App\procurement\EprApprovalTransactionModel;

use App\procurement\EprRfqModel;

use App\procurement\EprPoModel;
use App\procurement\PoApprovalTransactionModel;

use App\procurement\EprPoGrnModel;
use App\procurement\GrnApprovalTransactionModel;

use App\procurement\EprPoGrnWarehouseModel;
use App\procurement\StockInApprovalTransactionModel;

use App\procurement\EprPoInvoiceModel;
use App\procurement\InvoiceApprovalTransactionModel;

use App\procurement\EprSupplierPaymentModel;
use App\procurement\SupplierPaymentApprovalTransactionModel;
use App\procurement\EprPaymentVoucherModel;
use App\procurement\EprIssuedPaymentVoucherModel;


class ProcessListController extends Controller
{

  public function getEprFullProcess(Request $request)
  {
    $id = $request->id;
    $epr = $this->getEprDetails($id);
    $rfq = $this->getRfqDetails($id);
    $po = $this->getPoDetails($id);
    $grn = $this->getGrnDetails($id);
    $stockIn = $this->getStockInDetails($id);
    $invoice = $this->getInvoiceDetails($id);
    $pay = $this->getPayDetails($id);
    $voucher = $this->getVoucherDetails($id);
    $issupay = $this->getIssPayDetails($id);
    return view('procurement.processList.epr', compact('epr', 'rfq', 'po', 'grn', 'stockIn', 'invoice', 'pay', 'voucher', 'issupay'));
  }

  public function getEprFullProcessList($id)
  {
    $id = decrypt($id);
    // $id = $request->id;
    $epr = $this->getEprDetails($id);
    $rfq = $this->getRfqDetails($id);
    $po = $this->getPoDetails($id);
    $grn = $this->getGrnDetails($id);
    $stockIn = $this->getStockInDetails($id);
    $invoice = $this->getInvoiceDetails($id);
    $pay = $this->getPayDetails($id);
    $voucher = $this->getVoucherDetails($id);
    $issupay = $this->getIssPayDetails($id);
    return view('procurement.processList.epr1', compact('epr', 'rfq', 'po', 'grn', 'stockIn', 'invoice', 'pay', 'voucher', 'issupay'));
  }

  public function getEprDetails($id)
  {
    $MaterialRequest = MaterialRequestModel::select('material_request.id', 'material_request.quotedate', 'material_request.dateofsupply', 'material_request.request_type', 'ma_category.name as mr_category_name', 'request_priority', 'request_against', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'users.name as created_name', 'material_request.status')
      ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
      ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
      ->leftjoin('qprojects_projects', 'material_request.project', '=', 'qprojects_projects.id')
      ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')

      ->find($id);
    if (($MaterialRequest->status != 1) || $MaterialRequest->status != 0) {
      $approvalLevel = EprApprovalTransactionModel::select('epr_approval_transaction.updated_at', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_approval_transaction.status','epr_approval_transaction.comments','mrworkflow.if_accepted_note', 'mrworkflow.if_rejected_note')
        ->leftjoin('mrworkflow', 'epr_approval_transaction.mrworkflow_id', '=', 'mrworkflow.id')
        ->leftjoin('users', 'mrworkflow.user_id', '=', 'users.id')
        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
        ->where('epr_approval_transaction.epr_id', '=', $MaterialRequest->id)
        // ->where('epr_approval_transaction.status', '!=', 0)
        ->get();
    } else
      $approvalLevel = array();

    $out = array(
      'data' => $MaterialRequest,
      'synt' => $approvalLevel
    );
    return $out;
  }

  public function getRfqDetails($id)
  {

    $rfq = EprRfqModel::select(
      'epr_rfq.id',
      'epr_rfq.rfq_date',
      'epr_rfq.rfq_valid_till',
      'epr_rfq.supp_quot_id',
      'epr_rfq.quot_date',
      'epr_rfq.quote_valid_date',
      'epr_rfq.totalamount',
      'epr_rfq.totalvatamount',
      'epr_rfq.grandtotalamount',
      'users.name as created_name',
      'qcrm_supplier.sup_name',
      'epr_rfq.status',
    )
      ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
      ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
      ->where('epr_id', $id)->get();
    return $rfq;
  }
  public function getPoDetails($id)
  {
    $poDetails = EprPoModel::select(
      'epr_po.id',
      'epr_po.po_date',
      'epr_po.po_valid_till',
      'epr_po.delivery_terms',
      'epr_po.totalamount',
      'epr_po.totalvatamount',
      'epr_po.grandtotalamount',
      'qcrm_supplier.sup_name',
      'users.name as created_name',
      'epr_po.status'
    )
      ->leftjoin('users', 'epr_po.user_id', '=', 'users.id')
      ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
      ->where('epr_id', $id)->get();
    $outArray = array();
    foreach ($poDetails as $key => $value) {
      $approvalLevel = PoApprovalTransactionModel::select('epr_po_approval_transaction.updated_at', 'users.name',  'epr_po_approval_transaction.status')
        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
        ->where('epr_po_approval_transaction.po_id', '=', $value->id)
        // ->where('epr_po_approval_transaction.status', '!=', 0)
        ->get();
      $inArray = array(
        'po' => $value,
        'syn' => $approvalLevel,
      );
      array_push($outArray, $inArray);
    }
    return $outArray;
  }
  public function getGrnDetails($id)
  {
    $grn = EprPoGrnModel::select(
      'epr_po_grn.id',
      'epr_po_grn.notes',
      'epr_po_grn.grn_date',
      'epr_po_grn.grn_created_date',
      'qcrm_supplier.sup_name',
      'users.name as created_name',
      'epr_po_grn.status'
    )
      ->leftjoin('users', 'epr_po_grn.user_id', '=', 'users.id')
      ->leftjoin('qcrm_supplier', 'epr_po_grn.supplier_id', '=', 'qcrm_supplier.id')
      ->where('epr_id', $id)
      ->get();
    $outArray = array();
    foreach ($grn as $key => $value) {
      $approvalLevel = GrnApprovalTransactionModel::select('epr_po_grn_approval_transaction.updated_at', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_grn_approval_transaction.status')
        ->leftjoin('grnworkflow', 'epr_po_grn_approval_transaction.grnworkflow_id', '=', 'grnworkflow.id')
        ->leftjoin('users', 'grnworkflow.user_id', '=', 'users.id')
        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
        ->where('epr_po_grn_approval_transaction.grn_id', '=', $value->id)
        // ->where('epr_po_grn_approval_transaction.status', '!=', 0)
        ->get();

      $inArray = array(
        'grn' => $value,
        'syn' => $approvalLevel,
      );
      array_push($outArray, $inArray);
    }
    return $outArray;
  }
  public function getStockInDetails($id)
  {
    $mainData = EprPoGrnWarehouseModel::select(
      'epr_po_grn_warehouse.id',
      'epr_po_grn_warehouse.warehouse_transfer_date',
      'qinventory_warehouse.warehouse_name',
      'epr_po_grn_warehouse.notes',
      'qcrm_supplier.sup_name',
      'users.name as created_name',
      'epr_po_grn_warehouse.status'
    )
      ->leftjoin('users', 'epr_po_grn_warehouse.user_id', '=', 'users.id')
      ->leftjoin('qinventory_warehouse', 'epr_po_grn_warehouse.warehouse_id', '=', 'qinventory_warehouse.id')
      ->leftjoin('epr_po', 'epr_po_grn_warehouse.po_id', '=', 'epr_po.id')
      ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
      ->where('epr_po_grn_warehouse.epr_id', $id)
      ->get();
    $outArray = array();
    foreach ($mainData as $key => $value) {
      $approvalLevel = StockInApprovalTransactionModel::select('stock_in_approval_transaction.updated_at', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'stock_in_approval_transaction.status')
        ->leftjoin('stock_in_workflow', 'stock_in_approval_transaction.stock_in_workflow_id', '=', 'stock_in_workflow.id')
        ->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')
        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
        ->where('stock_in_approval_transaction.epr_po_grn_warehouse_id', '=', $value->id)
        ->get();
      $inArray = array(
        'stockIn' => $value,
        'syn' => $approvalLevel,
      );
      array_push($outArray, $inArray);
    }
    return $outArray;
  }
  // public function receiveToWarehouseDetails($id)
  // {
  // }

  public function getInvoiceDetails($id)
  {

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
      ->where('epr_po_invoice.epr_id', $id)
      ->get();

    $outArray = array();
    foreach ($mainData as $key => $value) {
      $approvalLevel = InvoiceApprovalTransactionModel::select('epr_po_invoice_approval_transaction.updated_at', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_invoice_approval_transaction.status')
        ->leftjoin('invoiceworkflow', 'epr_po_invoice_approval_transaction.invoiceworkflow_id', '=', 'invoiceworkflow.id')
        ->leftjoin('users', 'invoiceworkflow.user_id', '=', 'users.id')
        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
        ->where('epr_po_invoice_approval_transaction.invoice_id', '=', $value->id)
        ->get();
      $inArray = array(
        'invoice' => $value,
        'syn' => $approvalLevel,
      );
      array_push($outArray, $inArray);
    }
    return $outArray;
  }

  public function getPayDetails($id)
  {
    $mainData = EprSupplierPaymentModel::select(
      'epr_supplier_payment.id',
      'epr_supplier_payment.payement_book_date',
      'epr_supplier_payment.internalreference',
      'epr_supplier_payment.notes',
      'epr_supplier_payment.grandtotalamount',
      'qcrm_supplier.sup_name',
      'users.name as created_name',
      'epr_supplier_payment.status'
    )
      ->leftjoin('users', 'epr_supplier_payment.user_id', '=', 'users.id')
      ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
      ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
      ->where('epr_supplier_payment.epr_id', $id)
      ->get();

    $outArray = array();
    foreach ($mainData as $key => $value) {
      $approvalLevel = SupplierPaymentApprovalTransactionModel::select('epr_po_supplier_payment_approval_transaction.updated_at', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_supplier_payment_approval_transaction.status')
        ->leftjoin('supplier_paymentworkflow', 'epr_po_supplier_payment_approval_transaction.supplier_paymentworkflow_id', '=', 'supplier_paymentworkflow.id')
        ->leftjoin('users', 'supplier_paymentworkflow.user_id', '=', 'users.id')
        ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
        ->where('epr_po_supplier_payment_approval_transaction.supplier_payment_id', '=', $value->id)
        ->get();
      $inArray = array(
        'pay' => $value,
        'syn' => $approvalLevel,
      );
      array_push($outArray, $inArray);
    }
    return $outArray;
  }
  public function getVoucherDetails($id)
  {
    $mainData = EprPaymentVoucherModel::select(
      'epr_payment_voucher.id',
      'epr_payment_voucher.payment_cr_account',
      'epr_payment_voucher.voucher_date',
      'epr_payment_voucher.voucher_notes',
      'epr_payment_voucher.voucher_reference',
      'epr_payment_voucher.amount',
      'epr_payment_voucher.payment_method',
      'epr_payment_voucher.cash_transaction_id',
      'epr_payment_voucher.cash_transaction_referance',
      'epr_payment_voucher.bank_account',
      'qcrm_supplier_bank_details.bank_name',
      'qcrm_supplier_bank_details.iban_swift_code',
      'epr_payment_voucher.bank_transaction_id',
      'epr_payment_voucher.bank_transaction_referance',
      'epr_payment_voucher.cheque_number',
      'epr_payment_voucher.cheque_date',
      'epr_payment_voucher.cheque_transaction_id',
      'epr_payment_voucher.cheque_transaction_referance',
      'epr_payment_voucher.card_transaction_id',
      'epr_payment_voucher.card_transaction_reference',
      'epr_payment_voucher.internalreference',
      'epr_payment_voucher.notes',
      'epr_payment_voucher.status',
      'qcrm_supplier.sup_name',
      'users.name as created_name',
    )
      ->leftjoin('users', 'epr_payment_voucher.created_by', '=', 'users.id')
      ->leftjoin('qcrm_supplier', 'epr_payment_voucher.supplier_id', '=', 'qcrm_supplier.id')
      ->leftjoin('qcrm_supplier_bank_details', 'epr_payment_voucher.bank_account', '=', 'qcrm_supplier_bank_details.id')
      ->where('epr_payment_voucher.epr_id', $id)->get();
    return $mainData;
  }
  public function getIssPayDetails($id)
  {
    $mainData = EprIssuedPaymentVoucherModel::select(
      'epr_issued_payment_voucher.id',
      'epr_issued_payment_voucher.receiver_name',
      'epr_issued_payment_voucher.relation_with_supplier',
      'epr_issued_payment_voucher.designation',
      'epr_issued_payment_voucher.department',
      'epr_issued_payment_voucher.national_id',
      'epr_issued_payment_voucher.phone_number',
      'epr_issued_payment_voucher.issued_date',
      'epr_issued_payment_voucher.comments',
      'epr_issued_payment_voucher.internalreference',
      'epr_issued_payment_voucher.notes',
      'epr_issued_payment_voucher.status',
      'qcrm_termsandconditions.description',
      'qcrm_supplier.sup_name',
      'users.name as created_name',
    )
      ->leftjoin('users', 'epr_issued_payment_voucher.created_by', '=', 'users.id')
      ->leftjoin('qcrm_supplier', 'epr_issued_payment_voucher.supplier_id', '=', 'qcrm_supplier.id')
      ->leftjoin('qcrm_termsandconditions', 'epr_issued_payment_voucher.terms', '=', 'qcrm_termsandconditions.id')
      ->where('epr_issued_payment_voucher.epr_id', $id)->get();
    return  $mainData;
  }
}

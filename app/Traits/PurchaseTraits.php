<?php

namespace App\Traits;

use Carbon\Carbon;
use DB;

use Session;

trait PurchaseTraits
{

    //********************************************Purchase****************************************************************/
    public function insertPurchaseInvoiceToSOA($id, $branch)
    {
        $invoice = DB::table('qbuy_purchase_pi')->where('id', $id)->select('id', 'grandtotalamount', 'advance_amt', 'paid_amount', 'bill_entry_date', 'supplier_id', 'soa_id')->first(); //'paid_amount','paid_from_adwance'
        $soa = [
            'doc_type'        => 'Invoice',
            'doc_id'          => $invoice->id,
            // 'doc_id_new'          => $invoice->code . '/' . $invoice->br_id,
            'doc_transaction' => Carbon::parse($invoice->bill_entry_date)->format('Y-m-d'),
            'transaction_type' => 'Invoice', //Credit or Debit
            'totalamount'     => $invoice->grandtotalamount,
            'supplier_id'     => $invoice->supplier_id,
            'branch'          => $branch,
            // 'dr_amount'          => 0, //$invoice->paid_amount - $invoice->paid_from_adwance
            // 'cr_amount'          => $invoice->grandtotalamount,
            'dr_amount'          => $invoice->paid_amount - $invoice->advance_amt,
            'cr_amount'          => $invoice->grandtotalamount,
        ];
        if ($invoice->soa_id == null) { //insert SOA Entry
            $soa_id = DB::table('qbuy_purchaseorder_soa')->insertGetId($soa);
            DB::table('qbuy_purchase_pi')->where('id', $id)->update(array('soa_id' => $soa_id));
        } else //update
            $soa_id = DB::table('qbuy_purchaseorder_soa')->where('id', $invoice->soa_id)->update($soa);
        return true;
    }

    public function purchaseReturnSOAInsertion($id, $branch)
    {
        $return = DB::table('qbuy_purchase_return')->where('id', $id)->select('id',  'grandtotalamount', 'returndate', 'supplier_id', 'soa_id')->first();
        $soa = [
            'doc_type'        => 'Purchase Return',
            'doc_id'          => $return->id,
          //  'doc_id_new'          => '',
            'doc_transaction' => Carbon::parse($return->returndate)->format('Y-m-d'),
            'transaction_type' => 'Purchase Return', //Credit or Debit
            'totalamount'     => $return->grandtotalamount,
            'supplier_id'     => $return->supplier_id,
            'branch'          => $branch,
            'dr_amount'          => $return->grandtotalamount,
            'cr_amount'          => 0,
        ];
        if ($return->soa_id == null) { //insert SOA Entry
            $soa_id = DB::table('qbuy_purchaseorder_soa')->insertGetId($soa);
            DB::table('qbuy_purchase_return')->where('id', $id)->update(array('soa_id' => $soa_id));
        } else //update
            $soa_id = DB::table('qbuy_purchaseorder_soa')->where('id', $return->soa_id)->update($soa);
        return true;
    }
    public function purchaseBillSettilementSOAInsertion($id, $branch)
    {
        $bills = DB::table('qbuy_billsettlement')->select('id', 'transactiondate', 'supplier', 'paidamount', 'advance_amt', 'notes', 'soa_id')->where('id', $id)->first();
        $soa = [
            'doc_type'        => 'Bill Settlement',
            'doc_id'          => $bills->id,
          //  'doc_id_new'          => $bills->code . '/' . $bills->br_id,
            'doc_transaction' => Carbon::parse($bills->transactiondate)->format('Y-m-d'),
            'transaction_type' => 'Bill Settlement',
            'notes' => $bills->notes,
            'supplier_id'     => $bills->supplier,
            'branch'          => $branch,
            'dr_amount'          => $bills->paidamount - $bills->advance_amt,
            'cr_amount'          => 0,
        ];
        $currentSupplierPay = $bills->paidamount - $bills->advance_amt;
        $soa_id = '';
        if ($bills->soa_id == null) { //insert SOA Entry
            if ($currentSupplierPay > 0) //amount not fully from advance
                $soa_id = DB::table('qbuy_purchaseorder_soa')->insertGetId($soa);
        } else //update
            if ($currentSupplierPay > 0) //amount not fully from advance
                $soa_id = DB::table('qbuy_purchaseorder_soa')->where('id', $bills->soa_id)->update($soa);
            else
                DB::table('qbuy_purchaseorder_soa')->where('id', $bills->soa_id)->delete();

        DB::table('qbuy_billsettlement')->where('id', $id)->update(array('soa_id' => $soa_id));
    }

    public function purchaseAdvanceSOAInsertion($id, $branch)
    {
        $adwance = DB::table('qbuy_advancepayment')->select('id', 'date', 'total_amount', 'supplier_id', 'notes', 'supplier_payment_id', 'soa_id')->where('id', $id)->first();
        if (isset($adwance->id)) {
            $supplierPaymentData = [
                'supplier_id' => $adwance->supplier_id,
                'payment_date' => Carbon::parse($adwance->date)->format('Y-m-d  h:i'),
                'payment_type' => 'Advance',
                'doc_id' => $id,
                'dr_amount' => $adwance->total_amount,
                'cr_amount' => 0
            ];
            if ($adwance->supplier_payment_id == null) { //insert supplier_payment
                $supplierPaymentId = DB::table('qbuy_supplier_payments')->insertGetId($supplierPaymentData);
                DB::table('qbuy_advancepayment')->where('id', $id)->update(array('supplier_payment_id' => $supplierPaymentId));
            } else //update
                $soa_id = DB::table('qbuy_supplier_payments')->where('id', $adwance->supplier_payment_id)->update($supplierPaymentData);

            $soa = [
                'doc_type'        => 'Advance',
                'doc_id'          => $id,
              //  'doc_id_new'          => $adwance->code . '/' . $adwance->br_id,
                'doc_transaction' => Carbon::parse($adwance->date)->format('Y-m-d  h:i'),
                'transaction_type' => 'Advance',
                'totalamount'     => $adwance->total_amount,
                'supplier_id'     => $adwance->supplier_id,
                'notes' => $adwance->notes,
                'branch'          => $branch,
                'dr_amount'       => $adwance->total_amount,
                'cr_amount'       => 0,
            ];
            if ($adwance->soa_id == null) { //insert SOA Entry
                $soa_id = DB::table('qbuy_purchaseorder_soa')->insertGetId($soa);
                DB::table('qbuy_advancepayment')->where('id', $id)->update(array('soa_id' => $soa_id));
            } else //update
                $soa_id = DB::table('qbuy_purchaseorder_soa')->where('id', $adwance->soa_id)->update($soa);
            return true;
        }
        return false;
    }

    public function deletePurchaseSOA($id)
    {
        DB::table('qbuy_purchaseorder_soa')->where('id', $id)->delete();
        return true;
    }

    public function deleteSupplierPayment($id)
    {
        DB::table('qbuy_supplier_payments')->where('id', $id)->delete();
        return true;
    }

    //********************************************Purchase****************************************************************/



}

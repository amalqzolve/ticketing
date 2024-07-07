<?php

namespace App\Traits;

use Carbon\Carbon;
use DB;

use Session;

trait AccountingActionsTrait
{

    public function connectToAccounting()
    {
        $account_credentials = Session::get('account_credentials');
        config([
            'database.connections.mysql_accounting.driver' => $account_credentials->db_datasource, //'mysql',
            'database.connections.mysql_accounting.host' => $account_credentials->db_host, //'127.0.0.1',
            'database.connections.mysql_accounting.port' => $account_credentials->db_port, //3306,
            'database.connections.mysql_accounting.database' => $account_credentials->db_schema, //'accountant_new1',
            'database.connections.mysql_accounting.username' => $account_credentials->db_login, //'root',
            'database.connections.mysql_accounting.password' => $account_credentials->db_password, //'123456',
        ]);
    }

    //********************************************Sales****************************************************************/
    public function salesInvoiceAccountingEnrty($invoiceId) //done
    {
        DB::transaction(function () use ($invoiceId) {
            $this->connectToAccounting();
            $invoice = DB::table('qsell_saleinvoice')->where('id', $invoiceId)->select('id', 'customer', 'quotedate', 'vatamount', 'amountafterdiscount', 'grandtotalamount')->first();
            $customerAccountLedger = DB::table('qcrm_customer_details')->where('id', $invoice->customer)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                // 'tag_id' => '',
                'entrytype_id' => $accounting_settings->sales_invoice_entry_type,
                //'number'=>$invoiceId,
                'date' => $invoice->quotedate,
                'dr_total' => $invoice->grandtotalamount,
                'cr_total' => $invoice->grandtotalamount,
            );
            $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $customerAccountLedger->account_ledger, 'amount' => $invoice->grandtotalamount, 'dc' => 'D', 'narration' => 'Invoice-' . $invoiceId], //customer CR           
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->sales_invoice_ledger, 'amount' => $invoice->amountafterdiscount, 'dc' => 'C', 'narration' => 'Invoice Amount Exclude Vat-' . $invoiceId], //Amount After Discount DR            
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->sales_invoice_vat_ledger, 'amount' => $invoice->vatamount, 'dc' => 'C', 'narration' => 'Invoice Vat-' . $invoiceId] //vat DR
            );
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }

    public function creditNoteAccountingEnrty($returnId)
    {
        DB::transaction(function () use ($returnId) {
            $this->connectToAccounting();
            $return = DB::table('qsell_creditnote')->where('id', $returnId)->select('id',  'amountafterdiscount', 'vatamount', 'grandtotalamount', 'quotedate', 'customer')->first();
            $customerAccountLedger = DB::table('qcrm_customer_details')->where('id', $return->customer)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                // 'tag_id' => '',
                'entrytype_id' => $accounting_settings->sales_return_entry_type,
                //'number'=>$invoiceId,
                'date' => $return->quotedate,
                'dr_total' => $return->grandtotalamount,
                'cr_total' => $return->grandtotalamount,
            );
            $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $customerAccountLedger->account_ledger, 'amount' => $return->grandtotalamount, 'dc' => 'C', 'narration' => 'Credit Note-' . $returnId], //customer CR           
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->sales_return_ledger, 'amount' => $return->amountafterdiscount, 'dc' => 'D', 'narration' => 'Credit Note Amount Exclude Vat-' . $returnId], //Amount After Discount DR            
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->sales_return_vat_ledger, 'amount' => $return->vatamount, 'dc' => 'D', 'narration' => 'Credit Note Vat-' . $returnId] //vat DR
            );
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }

    public function salesInvoiceBillSettlementAccountingEnrty($setId) //done
    {
        DB::transaction(function () use ($setId) {
            $this->connectToAccounting();
            $bills = DB::table('qsell_billsettlement')->select('id', 'transactiondate', 'customer', 'paidamount', 'depositaccount')->where('id', $setId)->first();
            $customerAccountLedger = DB::table('qcrm_customer_details')->where('id', $bills->customer)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                // 'tag_id' => '',
                'entrytype_id' => $accounting_settings->sales_billsettilement_entry_type,
                //'number'=>$invoiceId,
                'date' => $bills->transactiondate,
                'dr_total' => $bills->paidamount,
                'cr_total' => $bills->paidamount,
            );
            $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $customerAccountLedger->account_ledger, 'amount' => $bills->paidamount, 'dc' => 'C', 'narration' => 'Invoice Bill Settlement-' . $setId],
                ['entry_id' => $entries, 'ledger_id' => $bills->depositaccount, 'amount' => $bills->paidamount, 'dc' => 'D', 'narration' => 'Invoice Bill Settlement-' . $setId],
            );
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }

    public function salesAdwancePaymentAccountingEnrty($advId) //done
    {
        DB::transaction(function () use ($advId) {
            $this->connectToAccounting();
            $adwance = DB::table('qsell_advancepayment')->select('id', 'date', 'customer', 'total_amount', 'notes', 'accountledger_depositaccount')->where('id', $advId)->first();
            // $adwanceTotal = DB::table('qsell_advancepayment_payment_method')->where('payid', $advId)->sum('amounts');
            $customerAccountLedger = DB::table('qcrm_customer_details')->where('id', $adwance->customer)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                // 'tag_id' => '',
                'entrytype_id' => $accounting_settings->sales_adwance_entry_type,
                //'number'=>$invoiceId,
                'date' => Carbon::parse($adwance->date)->format('Y-m-d'),
                'dr_total' => $adwance->total_amount,
                'cr_total' => $adwance->total_amount,
            );
            $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $customerAccountLedger->account_ledger, 'amount' => $adwance->total_amount, 'dc' => 'C', 'narration' => 'Adwance Payment-' . $advId],
                ['entry_id' => $entries, 'ledger_id' => $adwance->accountledger_depositaccount, 'amount' => $adwance->total_amount, 'dc' => 'D', 'narration' => 'Adwance Payment-' . $advId],
            );
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }

    //./********************************************Sales****************************************************************/

    //********************************************purchase****************************************************************/

    public function purchaseInvoiceAccountingEnrty($invoiceId)
    {
        DB::transaction(function () use ($invoiceId) {
            $this->connectToAccounting();
            $invoice = DB::table('qbuy_purchase_pi')->where('id', $invoiceId)->select('id', 'supplier_id', 'bill_entry_date', 'vatamount', 'amountafterdiscount', 'mark_payments', 'use_advance', 'advance_amt', 'paid_amount', 'grandtotalamount', 'acc_entries_id')->first();

            $supplierAccountLedger = DB::table('qcrm_supplier')->where('id', $invoice->supplier_id)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                'entrytype_id' => $accounting_settings->purchase_invoice_entry_type,
                'date' => $invoice->bill_entry_date,
                'dr_total' => $invoice->grandtotalamount,
                'cr_total' => $invoice->grandtotalamount,
            );

            if ($invoice->acc_entries_id == null) { //insert accounting Entry
                $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
                DB::table('qbuy_purchase_pi')->where('id', $invoiceId)->update(array('acc_entries_id' => $entries)); //update entry id to Purchase Invoice
            } else { // update Accounting Entry
                DB::connection('mysql_accounting')->table('entries')->where('id', $invoice->acc_entries_id)->update($entrysArray);
                $entries = $invoice->acc_entries_id;
                DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $invoice->acc_entries_id)->delete();
            }

            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $supplierAccountLedger->account_ledger, 'amount' => $invoice->grandtotalamount, 'dc' => 'C', 'narration' => 'Purchase Invoice-' . $invoiceId], //customer CR
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->purchase_invoice_ledger, 'amount' => $invoice->amountafterdiscount, 'dc' => 'D',  'narration' => 'Purchase Invoice Amount Exclude Vat-' . $invoiceId], //Amount After Discount DR
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->purchase_invoice_vat_ledger, 'amount' => $invoice->vatamount, 'dc' => 'D', 'narration' => 'Purchase Invoice Vat-' . $invoiceId] //vat DR
            );

            if ($invoice->mark_payments == 1) {
                $amt = $invoice->paid_amount - $invoice->advance_amt;
                if ($amt > 0) {
                    array_push($entryitemsArray, ['entry_id' => $entries, 'ledger_id' => $supplierAccountLedger->account_ledger, 'amount' => $amt, 'dc' => 'D', 'narration' => 'bill settle at invoice creation']); //Supplier Dr  
                    $saleinvoice_payments =  DB::table('qbuy_purchase_pi_payments')->select('*')->where('qbuy_purchase_pi_id', $invoiceId)->get(); //invoice payments
                    // Log::info('dddd');
                    foreach ($saleinvoice_payments as $key => $payment) {
                        array_push($entryitemsArray, ['entry_id' => $entries, 'ledger_id' => $payment->debitaccount, 'amount' => $payment->pay_amount, 'dc' => 'C', 'narration' => 'Purchase bill settle at invoice creation']);
                    }
                }
            }
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }
    public function purchaseReturnAccountingEnrty($returnId)
    {
        DB::transaction(function () use ($returnId) {
            $this->connectToAccounting();
            $return = DB::table('qbuy_purchase_return')->where('id', $returnId)->select('id', 'amountafterdiscount', 'totalvatamount', 'grandtotalamount', 'returndate', 'supplier_id', 'acc_entries_id')->first();
            $supplierAccountLedger = DB::table('qcrm_supplier')->where('id', $return->supplier_id)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                'entrytype_id' => $accounting_settings->purchase_return_entry_type,
                'date' => $return->returndate,
                'dr_total' => $return->grandtotalamount,
                'cr_total' => $return->grandtotalamount,
            );

            if ($return->acc_entries_id == null) { //insert accounting Entry
                $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
                DB::table('qbuy_purchase_return')->where('id', $returnId)->update(array('acc_entries_id' => $entries)); //update entry id to Purchase return
            } else { // update Accounting Entry
                DB::connection('mysql_accounting')->table('entries')->where('id', $return->acc_entries_id)->update($entrysArray);
                $entries = $return->acc_entries_id;
                DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $return->acc_entries_id)->delete();
            }

            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $supplierAccountLedger->account_ledger, 'amount' => $return->grandtotalamount, 'dc' => 'D', 'narration' => 'Purchase Return-' . $returnId], //customer CR           
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->purchase_return_ledger, 'amount' => $return->amountafterdiscount, 'dc' => 'C', 'narration' => 'Purchase Return Amount Exclude Vat-' . $returnId], //Amount After Discount DR            
                ['entry_id' => $entries, 'ledger_id' => $accounting_settings->purchase_return_vat_ledger, 'amount' => $return->totalvatamount, 'dc' => 'C', 'narration' => 'Purchase Return Vat-' . $returnId] //vat DR
            );
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }


    public function purchaseInvoiceBillSettlementAccountingEnrty($setId)
    {
        DB::transaction(function () use ($setId) {
            $this->connectToAccounting();
            $bills = DB::table('qbuy_billsettlement')->select('id', 'transactiondate', 'supplier', 'paidamount', 'credit_from_another', 'credit_from_ledjer', 'advance_amt', 'notes', 'acc_entries_id')->where('id', $setId)->first();
            $payment_method = DB::table('qbuy_billsettlement_payment_method')->select('debitaccount', 'amount')->where('bill_id', $setId)->get();
            $supplierAccountLedger = DB::table('qcrm_supplier')->where('id', $bills->supplier)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                'entrytype_id' => $accounting_settings->purchase_billsettilement_entry_type,
                'date' => $bills->transactiondate,
                'dr_total' => $bills->paidamount - $bills->advance_amt,
                'cr_total' => $bills->paidamount - $bills->advance_amt,
            );
            $curAccountEntry = $bills->paidamount - $bills->advance_amt; //without advance recive amount
            if ($bills->acc_entries_id == null) { //insert accounting Entry
                if ($curAccountEntry > 0) {
                    $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
                    DB::table('qbuy_billsettlement')->where('id', $setId)->update(array('acc_entries_id' => $entries)); //update entry id to Purchase Bill Settlement
                }
            } else { // update Accounting Entry
                if ($curAccountEntry > 0) {
                    DB::connection('mysql_accounting')->table('entries')->where('id', $bills->acc_entries_id)->update($entrysArray);
                    $entries = $bills->acc_entries_id;
                    DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $bills->acc_entries_id)->delete();
                } else {
                    DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $bills->acc_entries_id)->delete();
                    DB::connection('mysql_accounting')->table('entries')->where('id', $bills->acc_entries_id)->delete();
                    DB::table('qbuy_billsettlement')->where('id', $setId)->update(array('acc_entries_id' => ''));
                }
            }


            if ($curAccountEntry > 0) {
                if ($bills->credit_from_another == 1)
                    $debitLedger = $bills->credit_from_ledjer;
                else
                    $debitLedger = $supplierAccountLedger->account_ledger;

                $entryitemsArray = array(
                    ['entry_id' => $entries, 'ledger_id' => $debitLedger, 'amount' => $curAccountEntry, 'dc' => 'D', 'narration' => 'Purchase Invoice Bill Settlement-' . $setId]
                ); //depositaccount=>debit account

                foreach ($payment_method as $key => $value) {
                    array_push($entryitemsArray, ['entry_id' => $entries, 'ledger_id' => $value->debitaccount, 'amount' => $value->amount, 'dc' => 'C', 'narration' => 'Purchase Invoice Bill Settlement-' . $setId],);
                }
                $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            }
            return true;
        });
    }

    public function purchaseAdwancePaymentAccountingEnrty($advId)
    {
        DB::transaction(function () use ($advId) {
            $this->connectToAccounting();
            $adwance = DB::table('qbuy_advancepayment')->select('id', 'date', 'total_amount', 'supplier_id', 'notes', 'acc_entries_id')->where('id', $advId)->first();
            $advancepayment_payment_method = DB::table('qbuy_advancepayment_payment_method')->select('accountledger_debitaccount', 'amounts')->where('payid', $advId)->get();
            $supplierAccountLedger = DB::table('qcrm_supplier')->where('id', $adwance->supplier_id)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                'entrytype_id' => $accounting_settings->purchase_adwance_entry_type,
                'date' => Carbon::parse($adwance->date)->format('Y-m-d'),
                'dr_total' => $adwance->total_amount,
                'cr_total' => $adwance->total_amount,
            );
            if ($adwance->acc_entries_id == null) { //insert accounting Entry
                $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
                DB::table('qbuy_advancepayment')->where('id', $advId)->update(array('acc_entries_id' => $entries)); //update entry id to Purchase Adwance
            } else { // update Accounting Entry
                DB::connection('mysql_accounting')->table('entries')->where('id', $adwance->acc_entries_id)->update($entrysArray);
                $entries = $adwance->acc_entries_id;
                DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $adwance->acc_entries_id)->delete();
            }
            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $supplierAccountLedger->account_ledger, 'amount' => $adwance->total_amount, 'dc' => 'D', 'narration' => 'Purchase Adwance Payment-' . $advId]
            );

            foreach ($advancepayment_payment_method as $key => $meth) {
                array_push($entryitemsArray, ['entry_id' => $entries, 'ledger_id' => $meth->accountledger_debitaccount, 'amount' => $meth->amounts, 'dc' => 'C', 'narration' => 'Purchase Adwance Payment-' . $advId]);
            }

            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }

    public function purchaseRefundAccountingEnrty($refundId)
    {
        $this->connectToAccounting();
        DB::connection('mysql_accounting')->transaction(function () use ($refundId) {
            $refund = DB::table('qbuy_refund')->select('id', 'date', 'addtotal', 'supplier_id', 'notes', 'acc_entries_id')->where('id', $refundId)->first();
            $refund_items = DB::table('qbuy_refund_items')->select('debitaccount', 'amount')->where('qbuy_refund_id', $refundId)->get();
            $supplierAccountLedger = DB::table('qcrm_supplier')->where('id', $refund->supplier_id)->select('account_ledger')->first();
            $accounting_settings = Session::get('branch_settings');
            $entrysArray = array(
                'entrytype_id' => $accounting_settings->purchase_return_refund_entry_type,
                'date' => Carbon::parse($refund->date)->format('Y-m-d'),
                'dr_total' => $refund->addtotal,
                'cr_total' => $refund->addtotal,
            );
            if ($refund->acc_entries_id == null) { //insert accounting Entry
                $entries = DB::connection('mysql_accounting')->table('entries')->insertGetId($entrysArray);
                DB::table('qbuy_refund')->where('id', $refundId)->update(array('acc_entries_id' => $entries)); //update entry id to refund
            } else { //update Accounting Entry
                DB::connection('mysql_accounting')->table('entries')->where('id', $refund->acc_entries_id)->update($entrysArray);
                $entries = $refund->acc_entries_id;
                DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $refund->acc_entries_id)->delete();
            }
            $entryitemsArray = array(
                ['entry_id' => $entries, 'ledger_id' => $supplierAccountLedger->account_ledger, 'amount' => $refund->addtotal, 'dc' => 'C', 'narration' => 'Purchase  Return Refund-' . $refundId]
            );
            foreach ($refund_items as $key => $meth) {
                array_push($entryitemsArray, ['entry_id' => $entries, 'ledger_id' => $meth->debitaccount, 'amount' => $meth->amount, 'dc' => 'D', 'narration' => 'Purchase  Return Refund-' . $refundId]);
            }
            $entryitems = DB::connection('mysql_accounting')->table('entryitems')->insert($entryitemsArray);
            return true;
        });
    }

    //./********************************************purchase****************************************************************/



    public function entryItemsDelete($entryId)
    {
        $this->connectToAccounting();
        DB::connection('mysql_accounting')->transaction(function () use ($entryId) {
            DB::connection('mysql_accounting')->table('entryitems')->where('entry_id', $entryId)->delete();
            DB::connection('mysql_accounting')->table('entries')->where('id', $entryId)->delete();
        });
    }
}

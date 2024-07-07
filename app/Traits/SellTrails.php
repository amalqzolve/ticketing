<?php

namespace App\Traits;

use Carbon\Carbon;
use DB;

use Session;

trait SellTrails
{
    public function salesAdvanceSoaInsertion($id, $branch)
    {
        $adwance = DB::table('qsell_advancepayment')->select('id', 'date', 'total_amount', 'customer', 'notes')->where('id', $id)->first();
        // $adwanceTotal = DB::table('qsell_advancepayment_payment_method')->where('payid', $id)->sum('amounts');
        if (isset($adwance->id)) {
            $data = [
                'customer_id' => $adwance->customer,
                'payment_date' => Carbon::parse($adwance->date)->format('Y-m-d  h:i'),
                'payment_type' => 'Advance',
                'doc_id' => $id,
                'dr_amount' => 0,
                'cr_amount' => $adwance->total_amount
            ];
            $custPayid = DB::table('qsell_customer_payments')->insertGetId($data);
            // $soa = [
            //     'doc_type'        => 'Advance',
            //     'doc_id'          => $id,
            //     'doc_transaction' => Carbon::parse($adwance->date)->format('Y-m-d  h:i'),
            //     'transaction_type' => 'Advance',
            //     'totalamount'     => $adwance->total_amount,
            //     'customer_id'     => $adwance->customer,
            //     'notes' => $adwance->notes,
            //     'branch'          => $branch,
            //     'dr_amount'       => 0,
            //     'cr_amount'       => $adwance->total_amount,
            // ];
            // DB::table('qsell_salesorder_soa')->insert($soa);
            return true;
        }
        return false;
    }
    public function insertInvoiceSOA($id)
    {
        $invoice = DB::table('qsell_saleinvoice')->select('*')->where('id', $id)->first();
        if (isset($invoice->id)) {
            $branch = Session::get('branch');
            $soa = [
                'doc_type'        => 'Invoice',
                'doc_id'          => $invoice->id,
                'doc_transaction' => Carbon::parse($invoice->quotedate)->format('Y-m-d'),
                'transaction_type' => 'credit',
                'totalamount'     => $invoice->grandtotalamount,
                'customer_id'     => $invoice->customer,
                'paid_amount'     => 0,
                'branch'          => $branch,
                'cr_amount'          => $invoice->grandtotalamount,
                'dr_amount'          => 0,
            ];
            DB::table('qsell_salesorder_soa')->insert($soa);
        }
    }
}

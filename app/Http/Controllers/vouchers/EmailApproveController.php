<?php

namespace App\Http\Controllers\vouchers;

use App\Http\Controllers\Controller;
use App\vouchers\EmailVerifyKeysVoucherModel;
use App\vouchers\VoucherModel;
use App\vouchers\VoucherSynthesisModel;
use App\vouchers\VoucherApprovalTransactionModel;
use DB;

use App\User;


class EmailApproveController extends Controller
{

    public function loadDocument($key)
    {

        $ifDocument = EmailVerifyKeysVoucherModel::select('*')->where('token', $key)->first();
        if (!isset($ifDocument->id))
            return view('procurement.email.alreadyActionTaken');
        else {
            switch ($ifDocument->doc_type) {
                case 'Voucher':
                    $id = $ifDocument->doc_id;
                    $token = $ifDocument->token;
                    $transactionId = $ifDocument->transaction_id;

                    $mainData = VoucherModel::select(
                        'buy_voucher.id',
                        'qsettings_voucher.voucher_name as voucher_type',
                        'buy_voucher.purchase_type',
                        'buy_voucher.bill_id',
                        'buy_voucher.quotedate',
                        'buy_voucher.entrydate',
                        'buy_voucher.dateofsupply',
                        'buy_voucher.po_wo_ref',
                        'qcrm_salesman_details.name as salesman',
                        'qpurchase_currency.currency_name as currency',
                        'buy_voucher.currencyvalue',
                        'buy_voucher.cust_name',
                        'buy_voucher.totalamount',
                        'buy_voucher.discount',
                        'buy_voucher.amountafterdiscount',
                        'buy_voucher.totalvatamount',
                        'buy_voucher.grandtotalamount',
                        'buy_voucher.paidamount',
                        'buy_voucher.balanceamount',
                        'buy_voucher.notes',
                        'qcrm_termsandconditions.description',
                        'buy_voucher.status'
                    )
                        ->leftjoin('qcrm_salesman_details', 'buy_voucher.salesman', '=', 'qcrm_salesman_details.id')
                        ->leftjoin('qpurchase_currency', 'buy_voucher.currency', '=', 'qpurchase_currency.id')
                        ->leftjoin('qsettings_voucher', 'buy_voucher.voucher_type', '=', 'qsettings_voucher.id')
                        ->leftjoin('qcrm_termsandconditions', 'buy_voucher.terms', '=', 'qcrm_termsandconditions.id')
                        ->find($id);

                    $products = DB::table('buy_voucher_products')->select('qinventory_product_unit.unit_name', 'buy_account_head.head_name', 'buy_voucher_products.ledger', 'buy_voucher_products.product_description', 'buy_voucher_products.quantity', 'buy_voucher_products.rate', 'buy_voucher_products.amount', 'buy_voucher_products.vatamount', 'buy_voucher_products.vat_percentage', 'buy_voucher_products.rdiscount', 'buy_voucher_products.row_total')
                        ->leftJoin('qinventory_product_unit', 'buy_voucher_products.unit', 'qinventory_product_unit.id')
                        ->leftJoin('buy_account_head', 'buy_voucher_products.head_name', 'buy_account_head.id')
                        ->where('buy_voucher_products.main_voucher_id', '=', $id)
                        ->get();

                    if (($mainData->status != 1) || $mainData->status != 0) {
                        $approvalLevel = VoucherApprovalTransactionModel::select('voucher_approval_transaction.status', 'voucher_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'voucher_approval_transaction.updated_at')
                            ->leftjoin('voucher_synthesis', 'voucher_approval_transaction.voucher_synthesis_id', '=', 'voucher_synthesis.id')
                            ->leftjoin('users', 'voucher_synthesis.user_id', '=', 'users.id')
                            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                            ->where('voucher_approval_transaction.voucher_id', '=', $id)
                            ->where('voucher_approval_transaction.status', '!=', 0)
                            ->where('voucher_approval_transaction.status', '!=', 1)
                            ->orderBy('voucher_approval_transaction.id', 'asc')
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


                    return view('vouchers.email.voucher', compact('mainData', 'products', 'token', 'transactionId', 'approvalLevel'));
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

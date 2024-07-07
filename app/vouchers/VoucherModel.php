<?php

namespace App\vouchers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class VoucherModel extends Authenticatable
{
    protected $table = 'buy_voucher';
    protected $fillable = [
        'id',
        'voucher_type',
        'purchase_type',
        'bill_id',
        'quotedate',
        'entrydate',
        'dateofsupply',
        'po_wo_ref',
        'salesman',
        'currency',
        'currencyvalue',
        'terms',
        'notes',
        'internalreference',
        'tpreview',
        'cust_category',
        'cust_code',
        'cust_type',
        'cust_name',
        'cust_id',
        'cust_country',
        'building_no',
        'cust_region',
        'cust_district',
        'cust_city',
        'cust_zip',
        'mobile',
        'vatno',
        'buyerid_crno',
        'totalamount',
        'discount',
        'amountafterdiscount',
        'totalvatamount',
        'grandtotalamount',
        'paidamount',
        'balanceamount',
        'del_flag',
        'branch',
        'status',
        'payment_voucher_status'
    ];
    protected static $logOnlyDirty = true;
}

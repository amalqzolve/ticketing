<?php

namespace App\procurement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SupplierPaymentApprovalTransactionModel extends Authenticatable
{
    protected $table = 'epr_po_supplier_payment_approval_transaction';
    protected $fillable = [
        'supplier_paymentworkflow_id',
        'supplier_payment_id',
        'created_by',
        'status',
        'del_flag',
        'status_changed_by'
    ];
    protected static $logOnlyDirty = true;
}

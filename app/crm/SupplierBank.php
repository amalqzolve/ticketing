<?php

namespace App\crm;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SupplierBank extends Authenticatable
{
    protected $table = 'qcrm_supplier_bank_details';
    protected $fillable = [
        'suppler_id',
        'beneficiary_name',
        'bank_name',
        'branch_name',
        'branch_code',
        'bank_address',
        'account_number',
        'iban_swift_code',
        'notes',
        'created_by',
        'status'
    ];
    protected static $logOnlyDirty = true;
}

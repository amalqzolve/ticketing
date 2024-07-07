<?php

namespace App\CarRental;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatementOfAccountsModel extends Model
{
    use SoftDeletes;
    protected $table = 'car_rent_statement_of_accounts';
    protected $fillable = [
        'car_in_out_id',
        'car_rent_payment_id',
        'car_rent_invoice_id',
        'type',
        'transcation_date',
        'trans_type',
        'notes',
        'debit_amount',
        'credit_amount',
        'balance_amount',
        'branch',
    ];
}

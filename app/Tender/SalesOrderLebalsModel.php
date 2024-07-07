<?php

namespace App\Tender;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class SalesOrderLebalsModel extends Authenticatable
{
    protected $table = 'sales_orders_labels';
    protected $fillable = [
        'sales_orders_id',
        'label_id',
        'del_flag',
        'user_id'
    ];
}

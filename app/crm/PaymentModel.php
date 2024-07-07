<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class PaymentModel extends Authenticatable
{
    protected $table    = 'qcrm_payment_terms';
    protected $fillable = ['term', 'description','branch'];
    protected static $logOnlyDirty = true;
}


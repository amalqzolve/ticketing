<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
class VendorCreditLLimitModel extends Authenticatable
{
    use Notifiable;
    use LogsActivity;
    protected $table    = 'qcrm_vendor_credit_limits';
    protected $fillable = ['vendor_id', 'number_invoices', 'total_amount', 'period', 'penal_charges', 'status'];
    protected static $logOnlyDirty = true;
}


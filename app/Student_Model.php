<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Student_Model extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sales_order';
    protected $fillable = ['inv_no','inv_issuedate', 'inv_dateofsupply','inv_qtn_ref','inv_po_wo_ref','inv_cr_no','inv_vat_id','st_name','st_buildingno','st_streetname','district','city','country','postalcode','mobileno','vatno','buyerid_crno','totalamount','discount','amountafterdiscount','vatamount','grandtotalamount','terms','notes','preparedby','approvedby'];
}
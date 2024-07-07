<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Boq extends Model
{
    use NodeTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref', 'category_name', 'projectname', 'category_code',  'productname', 'unit', 'quantity', 'rate', 'amount',  'estimation_amount', 'total_amount', 'description', 'is_parent', 'epr_requested_quantity', 'client', 'type', 'tender_id', 'date', 'estimation_status', 'sales_proposal_entered', 'status'
    ];
    // 'discountamount','profit_amount', 'net_amount', 'vat_percentage', 'vatamount', 'totalamount','profit',
    // NULL=>edit mode 0=> deleteed 1=> Cost Estimation 2 => Cost Estimation Completed 3 => Send to Tender 

    public function stations()
    {
        return $this->hasMany(Station::class);
    }

    public function parent()
    {
        return $this->belongsTo(Company::class, 'parent_id ');
    }

    public function children()
    {
        return $this->hasMany(Boq::class, 'parent_id', 'totalamount');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Costs extends Model
{
    use NodeTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boq_id','category_name', 'projectname','client', 'category_code', 'amount', 'productname', 'unit', 'quantity', 'rate', 'discountamount', 'amount1', 'vat_percentage', 'vatamount', 'totalamount', 'description', 'is_parent', 'epr_requested_quantity','parent_id'
    ];

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
        return $this->hasMany(Costs::class, 'parent_id', 'totalamount');
    }
}

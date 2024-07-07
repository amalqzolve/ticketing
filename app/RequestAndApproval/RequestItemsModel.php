<?php

namespace App\RequestAndApproval;

use Illuminate\Database\Eloquent\Model;

class RequestItemsModel extends Model
{

    protected $table = 'request_items';
    protected $fillable = ['itemname', 'item_description', 'request_id'];
}

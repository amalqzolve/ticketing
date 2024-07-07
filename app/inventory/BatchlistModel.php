<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class BatchlistModel extends Model
{
    protected $table = 'qpurchase_batch';
    protected $fillable = ['batchname','description','branch'];
    protected static $logOnlyDirty = true;
}

<?php

namespace App\operations;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class EntryModel extends Model
{
    protected $table    = 'qsales_entries';
    protected $fillable = ['date', 'number','dr_total','cr_total','notes','pstatus'];
    protected static $logOnlyDirty = true;
}

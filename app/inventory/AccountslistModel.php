<?php

namespace App\inventory;

use Illuminate\Database\Eloquent\Model;

class AccountslistModel extends Model
{
    //
     protected $table = 'qinventory_accounts';
    protected $fillable = ['account_name','account_code','group_name'];
    protected static $logOnlyDirty = true;
}

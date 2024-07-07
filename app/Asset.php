<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Authenticatable
{
    use Notifiable;

    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'assets';
    protected $fillable = ['asset_name', 'asset_type','consumable','asset_code','barcode','tag','inv_type','asgroup','category','warehouse','type','store','rack','unit','manufaturer','supplier','brand','asset_cost'];

   
    protected static $logOnlyDirty = true;
}

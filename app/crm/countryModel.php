<?php
namespace App\crm;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class countryModel extends Authenticatable
{
				protected $table = 'countries';
				protected $fillable = ['id','cntry_name'];
}


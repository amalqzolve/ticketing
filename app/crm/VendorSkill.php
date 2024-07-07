<?php

namespace App\crm;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class VendorSkill extends Authenticatable
{
    public $table    = "qcrm_vendor_skills";
    public $fillable = ['info_id', 'contact_person_incharges', 'mobiles', 'offices', 'emails', 'departments', 'locations'];
}

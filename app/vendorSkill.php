<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class vendorSkill extends Authenticatable
{
  use Notifiable;

  use LogsActivity;

  public $table = "vendor_skills";

  public $fillable = ['info_id', 'contact_person_incharges', 'mobiles', 'offices', 'emails', 'departments', 'locations'];
}

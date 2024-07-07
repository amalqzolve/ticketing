<?php
namespace App\crm;
use Illuminate\Database\Eloquent\Model;
class Skillmore extends Model
{
      public $table = "qcrm_skill_more";
      public $fillable = ['info_id','skill','value'];
}

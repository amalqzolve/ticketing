<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketMembers extends Model
{
      public $table = "ticket_members";
      public $fillable =
      [
            'ticket_id',
            'add_passenger_name',
            'add_passenger_passport',
            'add_passenger_passport_issue_date',
            'add_passenger_passport_exp_date',
            'add_passenger_ticket_number',
            'add_passenger_booking_id',
            'add_fare',
            'updated_at',
            'created_at',
      ];
}

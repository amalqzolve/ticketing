<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

      public $table = "tickets";

      public $fillable =
      [
            'sales_order_id',
            'name',
            'address',
            'phone',
            'email',
            'country',
            'passport_no',
            'issue_date',
            'expiry_date',
            'trip_details',
            'booking_id',
            'booking_status',
            'class',
            'type',
            'seat',
            'boarding_time',
            'notes',
            'baggage_allowances',
            'extra_services',
            'ticket_no',
            'airlines',
            'airline_booking_reference',
            'agency',
            'departure',
            'departure_date',
            'arrival',
            'arrival_date',
            'show_fair',
            'total_amount',

      ];
}
